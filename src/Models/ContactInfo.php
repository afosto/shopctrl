<?php

namespace Afosto\ShopCtrl\Models;

use Afosto\ShopCtrl\Components\Model;

/**
 * @property integer $id                        Gets or sets the identifier.
 * @property string  $companyName               Gets or sets the name of the company.
 * @property string  $vatNumber                 Gets or sets the VAT number of the company.
 * @property string  $fullName                  Gets or sets the full name.
 * @property string  $gender                    Gets or sets the gender.
 * @property string  $personTitle               Gets or sets the person title.
 * @property string  $middleName                Gets or sets the middle name.
 * @property string  $firstName                 Gets or sets the first name.
 * @property string  $lastName                  Gets or sets the last name.
 * @property string  $lastNamePrefix            Gets or sets the prefix of the last name .
 * @property string  $address                   Gets or sets the address.
 * @property string  $address2                  Gets or sets the address2.
 * @property string  $streetAddress             Gets or sets the street address.
 * @property string  $streetAddressNumber       Gets or sets the street address number.
 * @property string  $streetAddressExtension    Gets or sets the street address extension.
 * @property string  $postalCode                Gets or sets the postal code.
 * @property string  $city                      Gets or sets the city.
 * @property integer $countryId                 Gets or sets the country identifier.
 * @property string  $countryCode               Gets or sets the country code.
 * @property string  $eMail                     Gets or sets the email.
 * @property string  $phone                     Gets or sets the phone.
 * @property string  $phone2                    Gets or sets the 2nd phone.
 * @property string  $stateProvince             Gets or sets the state or province.
 */
class ContactInfo extends Model
{

    public function getMap()
    {
        return [
            'id'                     => 'Id',
            'companyName'            => 'CompanyName',
            'vatNumber'              => 'VatNumber',
            'fullName'               => 'FullName',
            'gender'                 => 'Gender',
            'personTitle'            => 'PersonTitle',
            'middleName'             => 'MiddleName',
            'firstName'              => 'FirstName',
            'lastName'               => 'LastName',
            'lastNamePrefix'         => 'LastNamePrefix',
            'address'                => 'Address',
            'address2'               => 'Address2',
            'streetAddress'          => 'StreetAddress',
            'streetAddressNumber'    => 'StreetAddressNumber',
            'streetAddressExtension' => 'StreetAddressExtension',
            'postalCode'             => 'PostalCode',
            'city'                   => 'City',
            'countryId'              => 'CountryId',
            'countryCode'            => 'CountryCode',
            'eMail'                  => 'EMail',
            'phone'                  => 'Phone',
            'phone2'                 => 'Phone2',
            'stateProvince'          => 'StateProvince',
        ];
    }

    public function getRules()
    {
        return [
            ['id', 'integer', false],
            ['companyName', 'string', false, 100],
            ['vatNumber', 'string', false, 50],
            ['fullName', 'string', false, 200],
            ['gender', 'string', false, 1],
            ['personTitle', 'string', false, 50],
            ['middleName', 'string', false, 50],
            ['firstName', 'string', false, 50],
            ['lastName', 'string', false, 50],
            ['lastNamePrefix', 'string', false, 50],
            ['address', 'string', false],
            ['address2', 'string', false],
            ['streetAddress', 'string', false, 100],
            ['streetAddressNumber', 'string', false, 20],
            ['streetAddressExtension', 'string', false, 20],
            ['postalCode', 'string', false, 50],
            ['city', 'string', false, 100],
            ['countryId', 'integer', false],
            ['countryCode', 'string', false],
            ['eMail', 'string', false],
            ['phone', 'string', false, 50],
            ['phone2', 'string', false, 50],
            ['stateProvince', 'string', false, 100],
        ];
    }
}