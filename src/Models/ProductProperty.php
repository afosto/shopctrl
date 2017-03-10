<?php
namespace Afosto\ShopCtrl\Models;

use Afosto\ShopCtrl\Components\Model;

/**
 * @property integer $cultureId               Gets or sets the culture identifier.
 * @property integer $shopId                  Gets or sets the shop identifier.
 * @property integer $productPropertyDefId    Gets or sets the product property definition identifier.
 * @property string  $code                    Gets or sets the code.
 * @property string  $value                   Gets or sets the value.
 */
class ProductProperty extends Model {

    public function getMap() {
        return [
            'cultureId'            => 'CultureId',
            'shopId'               => 'ShopId',
            'productPropertyDefId' => 'ProductPropertyDefId',
            'code'                 => 'Code',
            'value'                => 'Value',
        ];
    }

    public function getRules() {
        return [
            ['cultureId', 'integer', false],
            ['shopId', 'integer', false],
            ['productPropertyDefId', 'integer', true],
            ['code', 'string', false],
            ['value', 'string', false, 2147483647],
        ];
    }

}