<?php

namespace Afosto\ShopCtrl\Models;

use Afosto\ShopCtrl\Components\App;
use Afosto\ShopCtrl\Components\Model;
use Afosto\ShopCtrl\Components\Operations\Create;
use Afosto\ShopCtrl\Components\Operations\Update;
use Afosto\ShopCtrl\Helpers\Exceptions\ApiException;
use GuzzleHttp\Exception\ClientException;

/**
 * @property integer $cultureId               Gets or sets the culture identifier.
 * @property integer $shopId                  Gets or sets the shop identifier.
 * @property integer $productPropertyDefId    Gets or sets the product property definition identifier.
 * @property string  $code                    Gets or sets the code.
 * @property string  $value                   Gets or sets the value.
 */
class ProductProperty extends Model
{

    public function getMap()
    {
        return [
            'cultureId'            => 'CultureId',
            'shopId'               => 'ShopId',
            'productPropertyDefId' => 'ProductPropertyDefId',
            'code'                 => 'Code',
            'value'                => 'Value',
        ];
    }

    public function getRules()
    {
        return [
            ['cultureId', 'integer', false],
            ['shopId', 'integer', false],
            ['productPropertyDefId', 'integer', true],
            ['code', 'string', false],
            ['value', 'string', false, 2147483647],
        ];
    }

    /**
     * @return string
     */
    protected function updateUri($id)
    {
        return 'v1/Products/' . $id . '/Properties';
    }

    /**
     * @return string
     */
    protected function createUri($id)
    {
        return 'v1/Products/' . $id . '/Properties';
    }

    /**
     * @return static
     * @throws ApiException
     */
    public function create($id)
    {
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
    public function update($id)
    {
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
