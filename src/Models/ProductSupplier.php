<?php

namespace Afosto\ShopCtrl\Models;

use Afosto\ShopCtrl\Components\Model;
use Afosto\ShopCtrl\Components\App;
use Afosto\ShopCtrl\Helpers\Exceptions\ApiException;
use GuzzleHttp\Exception\ClientException;

/**
 * @property integer         $id                              Gets or sets the identifier.
 * @property PurchaseProduct $purchaseProduct                 Gets or sets the shopId.
 * @property integer         $productId                       Gets or sets the shopId.
 * @property integer         $supplierId                      Gets or sets the shopId.
 * @property integer         $priority                        Gets or sets the shopId.
 */
class ProductSupplier extends Model {

    public function getMap() {
        return [
            'id'              => 'Id',
            'purchaseProduct' => 'PurchaseProduct',
            'productId'       => 'ProductId',
            'supplierId'      => 'SupplierId',
            'priority'        => 'Priority',

        ];
    }

    public function getRules() {
        return [
            ['id', 'integer', true],
            ['purchaseProduct', 'PurchaseProduct', false],
            ['productId', 'integer', true],
            ['supplierId', 'integer', true],
            ['priority', 'integer', true],
        ];
    }

    /**
     * @return string
     */
    protected function updateUri($id) {
        return 'v1/Products/' . $id . '/Suppliers';
    }

    /**
     * @return string
     */
    protected function createUri($id) {
        return 'v1/Products/' . $id . '/Suppliers';
    }

    /**
     * @return static
     * @throws ApiException
     */
    public function create($id) {
        try {
            $response = App::getInstance()
                           ->getClient()
                           ->post($this->createUri($id), ['json' => $this->getModel()]);
        } catch (ClientException $previous) {
            $e = new ApiException((string)$previous->getResponse()->getBody());
            $e->exception = $previous;
            throw $e;
        }
        $content = $response->getBody()->getContents();
        if ($content == "") {
            return $this;
        } else {
            $this->validateResponse($response);
            $this->setAttributes(\GuzzleHttp\json_decode($content, true));
            $this->validate();
        }

        return $this;
    }

    /**
     * @return static
     * @throws ApiException
     */
    public function update($id) {
        try {
            $response = App::getInstance()
                           ->getClient()
                           ->put($this->updateUri($id), ['json' => $this->getModel()]);
        } catch (ClientException $previous) {
            $e = new ApiException((string)$previous->getResponse()->getBody());
            $e->exception = $previous;
            throw $e;
        }

        $content = $response->getBody()->getContents();
        if ($content == "") {
            return $this;
        } else {
            $this->validateResponse($response);
            $this->setAttributes(\GuzzleHttp\json_decode((string)$response->getBody(), true));
            $this->validate();
        }

        return $this;
    }

}