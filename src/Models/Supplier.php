<?php

namespace Afosto\ShopCtrl\Models;

use Afosto\ShopCtrl\Components\Operations\Create;
use Afosto\ShopCtrl\Components\Operations\Find;
use Afosto\ShopCtrl\Components\Operations\FindAll;
use Afosto\ShopCtrl\Components\Model;

/**
 * @property integer $id                  Gets or sets the identifier.
 * @property string  $cultureCode         Gets or sets the culture code.
 * @property string  $fullName            Gets or sets the culture code.
 * @property string  $companyName         Gets or sets the culture code.
 * @property string  $eMail               Gets or sets the culture code.
 * @property string  $contactReference    Gets or sets the culture code.
 */
class Supplier extends Model {

    use FindAll,Find,Create;

    public function getMap() {
        return [
            'id'               => 'Id',
            'fullName'         => 'FullName',
            'companyName'      => 'CompanyName',
            'eMail'            => 'EMail',
            'contactReference' => 'ContactReference',
        ];
    }

    public function getRules() {
        return [
            ['id', 'integer', true],
            ['fullName', 'string', false, 100],
            ['companyName', 'string', false, 100],
            ['eMail', 'string', false, 100],
            ['contactReference', 'string', false, 100],
        ];
    }
}