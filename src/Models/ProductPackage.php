<?php

namespace Afosto\ShopCtrl\Models;

use Afosto\ShopCtrl\Components\Model;
use Afosto\ShopCtrl\Components\App;
use Afosto\ShopCtrl\Components\Operations\Find;
use Afosto\ShopCtrl\Components\Operations\FindAll;
use Afosto\ShopCtrl\Helpers\Exceptions\ApiException;
use GuzzleHttp\Exception\ClientException;

/**
 * Class ProductPackage
 * @package Afosto\ShopCtrl\Models
 *
 * @property integer $id                           Gets or sets identifier
 * @property integer $sizeUomId                    Gets or sets sizeUomId
 * @property string  $sizeUom                      Gets or sets sizeUom
 * @property float   $length                       Gets or sets length
 * @property float   $width                        Gets or sets width
 * @property float   $height                       Gets or sets height
 * @property integer $weightUomId                  Gets or sets weightUomId
 * @property float   $weightUom                    Gets or sets weightUom
 * @property float   $weight                       Gets or sets weight
 * @property string  $description                  Gets or sets description
 * @property boolean $requireOwnParcelPackage      Gets or sets requireOwnParcelPackage
 */
class ProductPackage extends Model {

    use FindAll;

    public function getMap() {
        return [
            'id'                      => 'Id',
            'sizeUomId'               => 'SizeUomId',
            'sizeUom'                 => 'SizeUom',
            'length'                  => 'Length',
            'width'                   => 'Width',
            'height'                  => 'Height',
            'weightUomId'             => 'WeightUomId',
            'weightUom'               => 'WeightUom',
            'weight'                  => 'Weight',
            'description'             => 'Description',
            'requireOwnParcelPackage' => 'RequireOwnParcelPackage',
        ];
    }

    public function getRules() {
        return [
            ['id', 'integer', true],
            ['sizeUomId', 'integer', false],
            ['sizeUom', 'float', false],
            ['length', 'float', false],
            ['width', 'float', false],
            ['height', 'float', false],
            ['weightUomId', 'integer', false],
            ['weightUom', 'float', false],
            ['weight', 'float', false],
            ['description', 'string', false],
            ['requireOwnParcelPackage', 'boolean', true],
        ];
    }

    /**
     * @return string
     */
    protected function updateUri($id) {
        return 'v1/Products/' . $id . '/Packages';
    }

    /**
     * @return string
     */
    protected function createUri($id) {
        return 'v1/Products/' . $id . '/Packages';
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
                           ->post($this->updateUri($id), ['json' => $this->getModel()]);
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