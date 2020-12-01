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

    use Create, Update;

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
        return 'v1/Products/' . App::getInstance()->getSetting('productId') . '/Properties';
    }

    /**
     * @return string
     */
    protected function createUri()
    {
        return 'v1/Products/' . App::getInstance()->getSetting('productId') . '/Properties';
    }

    /**
     * @return static
     * @throws ApiException
     */
    public function create()
    {
        try {
            $response = App::getInstance()
                           ->getClient()
                           ->post($this->createUri(), ['json' => $this->getModel()]);
        } catch (ClientException $previous) {
            $e = new ApiException((string)$previous->getResponse()->getBody());
            $e->exception = $previous;
            throw $e;
        }

        return $this;
    }

}
