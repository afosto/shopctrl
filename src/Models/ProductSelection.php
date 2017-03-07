<?php
namespace Afosto\ShopCtrl\Models;

use Afosto\ShopCtrl\Components\Operations\FindAll;
use Afosto\ShopCtrl\Components\Model;
use Afosto\ShopCtrl\Components\App;

/**
 * @property integer $id                    Gets or sets the identifier.
 * @property boolean $active                Gets or sets a value indicating whether this is active.
 * @property integer $productId             Gets or sets the product identifier.
 * @property string  $productCode           Gets or sets the product code.
 * @property float   $foreignPriceExVAT     Gets or sets the foreign price (exclude VAT).
 * @property float   $foreignPriceIncVAT    Gets or sets the foreign price (include VAT).
 * @property float   $qtyAvailable          Gets or sets the qty available.
 * @property float   $qtyOnHand             Gets or sets the qty on hand.
 * @property float   $qtyReserved           Gets or sets the qty reserved.
 */
class ProductSelection extends Model {

    use FindAll;

    public function getMap() {
        return [
            'id'                 => 'Id',
            'active'             => 'Active',
            'productId'          => 'ProductId',
            'productCode'        => 'ProductCode',
            'foreignPriceExVAT'  => 'ForeignPriceExVAT',
            'foreignPriceIncVAT' => 'ForeignPriceIncVAT',
            'qtyAvailable'       => 'QtyAvailable',
            'qtyOnHand'          => 'QtyOnHand',
            'qtyReserved'        => 'QtyReserved',
        ];
    }

    public function getRules() {
        return [
            ['id', 'integer', true],
            ['active', 'boolean', true],
            ['productId', 'integer', true],
            ['productCode', 'string', false],
            ['foreignPriceExVAT', 'float', false],
            ['foreignPriceIncVAT', 'float', false],
            ['qtyAvailable', 'float', true],
            ['qtyOnHand', 'float', true],
            ['qtyReserved', 'float', true],
        ];
    }

    protected function findAllUri() {
        return "/v1/Shops/" . App::getInstance()->getSetting('shopId') . "/ActiveProductSelectionProducts";
    }

}