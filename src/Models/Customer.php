<?php

namespace Afosto\ShopCtrl\Models;

use Afosto\ShopCtrl\Components\Operations\FindAll;
use Afosto\ShopCtrl\Components\Model;

/**
 * @property integer $id                  Gets or sets the identifier.
 * @property string  $fullName            Gets or sets the full name.
 * @property string  $companyName         Gets or sets the name of the company.
 * @property string  $eMail               Gets or sets the e mail.
 * @property string  $contactReference    Gets or sets the contact reference.
 */
class Customer extends Model
{

    use FindAll;

    public function getMap()
    {
        return [
            'id'               => 'Id',
            'fullName'         => 'FullName',
            'companyName'      => 'CompanyName',
            'eMail'            => 'EMail',
            'contactReference' => 'ContactReference',
        ];
    }

    public function getRules()
    {
        return [
            ['id', 'integer', true],
            ['fullName', 'string', false, 100],
            ['companyName', 'string', false, 100],
            ['eMail', 'string', false],
            ['contactReference', 'string', false],
        ];
    }

}