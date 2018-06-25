<?php

namespace Afosto\ShopCtrl\Models;

use Afosto\ShopCtrl\Components\Operations\FindAll;
use Afosto\ShopCtrl\Components\Model;

/**
 * @property integer $id             Gets or sets the identifier.
 * @property string  $cultureCode    Gets or sets the culture code.
 */
class Culture extends Model
{

    use FindAll;

    public function getMap()
    {
        return [
            'id'          => 'Id',
            'cultureCode' => 'CultureCode',
        ];
    }

    public function getRules()
    {
        return [
            ['id', 'integer', true],
            ['cultureCode', 'string', true, 8],
        ];
    }
}