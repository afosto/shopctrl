<?php

namespace Afosto\ShopCtrl\Models;

use Afosto\ShopCtrl\Components\Model;

/**
 * @property string  $key         Gets or sets the key.
 * @property string  $value       Gets or sets the value.
 * @property integer $dataType    Specify the data type. Default type is String.
 */
class OrderParameter extends Model
{

    public function getMap()
    {
        return [
            'key'      => 'Key',
            'value'    => 'Value',
            'dataType' => 'DataType',
        ];
    }

    public function getRules()
    {
        return [
            ['key', 'string', true, 50],
            ['value', 'string', false, 2147483647],
            ['dataType', 'integer', false, 1],
        ];
    }

}