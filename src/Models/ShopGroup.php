<?php

namespace Afosto\ShopCtrl\Models;

use Afosto\ShopCtrl\Components\App;
use Afosto\ShopCtrl\Components\Model;
use Afosto\ShopCtrl\Components\Operations\FindAll;

/**
 * @property integer $id             Gets or sets the identifier.
 * @property string  $name           Gets or sets the name.
 * @property integer $shopOwnerId    Gets or sets the shop owner identifier.
 */
class ShopGroup extends Model
{

    use FindAll;

    public function getMap()
    {
        return [
            'id'          => 'Id',
            'name'        => 'Name',
            'shopOwnerId' => 'ShopOwnerId',
        ];
    }

    public function getRules()
    {
        return [
            ['id', 'integer', true],
            ['name', 'string', true, 50],
            ['shopOwnerId', 'integer', true],
        ];
    }

    public function findAllUri()
    {
        return 'v1/ShopOwners/' . App::getInstance()->getSetting('shopOwnerId') . '/ShopGroups';
    }

}