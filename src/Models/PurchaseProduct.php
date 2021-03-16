<?php

namespace Afosto\ShopCtrl\Models;

use Afosto\ShopCtrl\Components\App;
use Afosto\ShopCtrl\Components\Model;

/**
 * @property integer $id                                Gets or sets the identifier.
 * @property integer $supplierId                        Gets or sets the supplier identifier.
 * @property string  $supplierSKU                       Gets or sets the supplier stock keeping unit.
 * @property string  $name                              Gets or sets the name
 * @property float   $purchasePriceExVAT                Gets or sets the purchase price (exclude VAT).
 * @property boolean $available                         Gets or sets the purchase price (exclude VAT).
 * @property boolean $canDropship                       Gets or sets a value indicating whether this is endoflife.
 * @property boolean $endOfLife                         Gets or sets a value indicating whether this is available.
 * @property float   $exchangeRate                      Gets or sets a value indicating whether this is available.
 */
class PurchaseProduct extends Model {

    public function getMap() {
        return [
            'id'                 => 'Id',
            'supplierId'         => 'SupplierId',
            'supplierSKU'        => 'SupplierSKU',
            'name'               => 'Name',
            'purchasePriceExVAT' => 'PurchasePriceExVAT',
            'exchangeRate'       => 'ExchangeRate',
            'canDropship'        => 'CanDropship',
            'endOfLife'          => 'EndOfLife',
            'available'          => 'Available',
        ];
    }

    public function getRules() {
        return [
            ['id', 'integer', false],
            ['supplierId', 'integer', true],
            ['supplierSKU', 'string', false],
            ['name', 'string', false],
            ['purchasePriceExVAT', 'float', false],
            ['exchangeRate', 'float', false],
            ['canDropship', 'boolean', false],
            ['endOfLife', 'boolean', false],
            ['available', 'boolean', false],
        ];
    }

}