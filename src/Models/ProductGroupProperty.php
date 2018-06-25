<?php

namespace Afosto\ShopCtrl\Models;

use Afosto\ShopCtrl\Components\Model;

/**
 * @property integer $cultureId               Gets or sets the culture identifier.
 * @property string  $code                    Gets or sets the code.
 * @property string  $value                   Gets or sets the value.
 */
class ProductGroupProperty extends Model
{

    public function getMap()
    {
        return [
            'cultureId' => 'CultureId',
            'code'      => 'Code',
            'value'     => 'Value',
        ];
    }

    public function getRules()
    {
        return [
            ['cultureId', 'integer', false],
            ['code', 'string', false],
            ['value', 'string', false, 2147483647],
        ];
    }

}