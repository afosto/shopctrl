<?php

namespace Afosto\ShopCtrl\Models;

use Afosto\ShopCtrl\Components\Operations\FindAll;
use Afosto\ShopCtrl\Components\Model;

/**
 * @property integer $id      Gets or sets the identifier.
 * @property string  $code    Gets or sets the code.
 */
class OrderStatus extends Model
{

    use FindAll;

    public function getMap()
    {
        return [
            'id'   => 'Id',
            'code' => 'Code',
        ];
    }

    public function getRules()
    {
        return [
            ['id', 'integer', false],
            ['code', 'string', false],
        ];
    }

    protected function getMethod()
    {
        return 'BaseOrderStatuses';
    }
}