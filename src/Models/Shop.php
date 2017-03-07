<?php
namespace Afosto\ShopCtrl\Models;

use Afosto\ShopCtrl\Components\Operations\FindAll;
use Afosto\ShopCtrl\Components\Model;

/**
 * @property integer $id             Gets or sets the identifier.
 * @property string  $name           Gets or sets the name.
 * @property integer $shopOwnerId    Gets or sets the shop owner identifier.
 * @property integer $shopGroupId    Gets or sets the shop group identifier.
 * @property boolean $active         Gets or sets a value indicating whether this is active.
 */
class Shop extends Model {

    use FindAll;

    public function getMap() {
        return [
            'id'          => 'Id',
            'name'        => 'Name',
            'shopOwnerId' => 'ShopOwnerId',
            'shopGroupId' => 'ShopGroupId',
            'active'      => 'Active',
        ];
    }

    public function getRules() {
        return [
            ['id', 'integer', true],
            ['name', 'string', true, 50],
            ['shopOwnerId', 'integer', true],
            ['shopGroupId', 'integer', true],
            ['active', 'boolean', false],
        ];
    }

}