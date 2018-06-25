<?php

namespace Afosto\ShopCtrl\Models;

use Afosto\ShopCtrl\Components\Model;
use Afosto\ShopCtrl\Components\Operations\FindAll;

/**
 * @property integer $id        Gets or sets the identifier.
 * @property string  $code      Gets or sets the code.
 * @property string  $name      Gets or sets the name.
 * @property string  $symbol    Gets or sets the symbol.
 */
class Currency extends Model
{

    use FindAll;

    public function getMap()
    {
        return [
            'id'     => 'Id',
            'code'   => 'Code',
            'name'   => 'Name',
            'symbol' => 'Symbol',
        ];
    }

    public function getRules()
    {
        return [
            ['id', 'integer', true],
            ['code', 'string', true, 10],
            ['name', 'string', true, 50],
            ['symbol', 'string', true, 50],
        ];
    }

}