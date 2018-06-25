<?php

namespace Afosto\ShopCtrl\Models;

use Afosto\ShopCtrl\Components\Model;

/**
 * @property integer $id                      Gets or sets the identifier.
 * @property integer $name                    Gets or sets the name.
 * @property integer $logoFileID              Gets or sets the ID of the Logo File.
 */
class ProductBrand extends Model
{

    public function getMap()
    {
        return [
            'id'         => 'Id',
            'name'       => 'Name',
            'logoFileID' => 'LogoFileID',
        ];
    }

    public function getRules()
    {
        return [
            ['id', 'integer', false],
            ['logoFileID', 'integer', false],
            ['name', 'string', false],
        ];
    }

}