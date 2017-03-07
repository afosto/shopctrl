<?php
namespace Afosto\ShopCtrl\Models;

use Afosto\ShopCtrl\Components\Model;
use Afosto\ShopCtrl\Components\Operations\FindAll;

/**
 * @property integer $id                     Gets or sets the identifier.
 * @property integer $baseCurrencyId         Gets or sets the base currency identifier.
 * @property string  $baseCurrencyCode       Gets or sets the base currency code.
 * @property integer $foreignCurrencyId      Gets or sets the foreign currency identifier.
 * @property string  $foreignCurrencyCode    Gets or sets the foreign currency code.
 * @property float   $rate                   Gets or sets the rate.
 */
class ExchangeRate extends Model {

    use FindAll;

    public function getMap() {
        return [
            'id'                  => 'Id',
            'baseCurrencyId'      => 'BaseCurrencyId',
            'baseCurrencyCode'    => 'BaseCurrencyCode',
            'foreignCurrencyId'   => 'ForeignCurrencyId',
            'foreignCurrencyCode' => 'ForeignCurrencyCode',
            'rate'                => 'Rate',
        ];
    }

    public function getRules() {
        return [
            ['id', 'integer', true],
            ['baseCurrencyId', 'integer', true],
            ['baseCurrencyCode', 'string', false],
            ['foreignCurrencyId', 'integer', true],
            ['foreignCurrencyCode', 'string', false],
            ['rate', 'float', true],
        ];
    }

}