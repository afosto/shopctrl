<?php

namespace Afosto\ShopCtrl\Models;

use Afosto\ShopCtrl\Components\Model;

/**
 * @property integer $id                   Gets or sets the identifier.
 * @property string  $companyName          Gets or sets the name of the company.
 * @property integer $defaultCurrencyId    Gets or sets the default currency identifier.
 * @property integer $defaultCultureId     Gets or sets the default culture identifier.
 * @property boolean $active               Gets or sets a value indicating whether this is active.
 */
class ShopOwner extends Model {

    public function getMap() {
        return [
            'id'                => 'Id',
            'companyName'       => 'CompanyName',
            'defaultCurrencyId' => 'DefaultCurrencyId',
            'defaultCultureId'  => 'DefaultCultureId',
            'active'            => 'Active',
        ];
    }

    public function getRules() {
        return [
            ['id', 'integer', true],
            ['companyName', 'string', true, 50],
            ['defaultCurrencyId', 'integer', true],
            ['defaultCultureId', 'integer', true],
            ['active', 'boolean', true],
        ];
    }

}