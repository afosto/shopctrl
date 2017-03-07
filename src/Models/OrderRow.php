<?php
namespace Afosto\ShopCtrl\Models;

use Afosto\ShopCtrl\Components\Model;

/**
 * @property integer             $id                           Gets or sets the identifier.
 * @property integer             $productSelectionProductId    Gets or sets the product selection product identifier.
 * @property string              $orderRowKey                  Gets or sets the order row key.
 * @property float               $itemQuantity
 * @property string              $productName                  Gets or sets the name of the product.
 * @property string              $productCode                  Gets or sets the product code.
 * @property string              $productDescription           Gets or sets the product description.
 * @property float               $itemPriceExVat               Gets or sets the item price (exclude VAT).
 * @property float               $itemPriceIncVat              Gets or sets the item price (include VAT).
 * @property float               $rowDiscountExVat             Gets or sets the row discount (exclude VAT).
 * @property float               $rowDiscountIncVat            Gets or sets the row discount (include VAT).
 * @property float               $vatperc                      Gets or sets the VAT percent.
 * @property integer             $vATTariffId                  Gets or sets the vat tariff identifier.
 * @property string              $vATTariffCode                Gets or sets the vat tariff code.
 * @property float               $rowTotalExVat                Gets or sets the row total (exclude VAT).
 * @property float               $rowTotalIncVat               Gets or sets the row total (include VAT).
 * @property string              $comment                      Gets or sets the comment.
 * @property integer             $supplierId                   Gets or sets the supplier identifier.
 * @property float               $itemPurchasePrice            Gets or sets the item purchase price.
 * @property integer             $creditForOrderRowId          When adding a credit row, optionally reference to an existing OrderRow.
 * @property integer             $sequence                     The display sequence. If not specified ShopCtrl will determine the sequence.
 * @property string              $shopProductUrl               Optionally specify the url to the product page on the Shop.
 * @property string              $shopProductImageUrl          Optionally specify the url to the product image. When not provided, ShopCtrl will use the image as defined with the ShopCtrl Product.
 * @property OrderRowParameter[] $params                       Gets or sets the parameters.
 */
class OrderRow extends Model {
    public function getMap() {
        return [
            'id'                        => 'Id',
            'productSelectionProductId' => 'ProductSelectionProductId',
            'orderRowKey'               => 'OrderRowKey',
            'itemQuantity'              => 'ItemQuantity',
            'productName'               => 'ProductName',
            'productCode'               => 'ProductCode',
            'productDescription'        => 'ProductDescription',
            'itemPriceExVat'            => 'ItemPriceExVat',
            'itemPriceIncVat'           => 'ItemPriceIncVat',
            'rowDiscountExVat'          => 'RowDiscountExVat',
            'rowDiscountIncVat'         => 'RowDiscountIncVat',
            'vatperc'                   => 'Vatperc',
            'vATTariffId'               => 'VATTariffId',
            'vATTariffCode'             => 'VATTariffCode',
            'rowTotalExVat'             => 'RowTotalExVat',
            'rowTotalIncVat'            => 'RowTotalIncVat',
            'comment'                   => 'Comment',
            'supplierId'                => 'SupplierId',
            'itemPurchasePrice'         => 'ItemPurchasePrice',
            'creditForOrderRowId'       => 'CreditForOrderRowId',
            'sequence'                  => 'Sequence',
            'shopProductUrl'            => 'ShopProductUrl',
            'shopProductImageUrl'       => 'ShopProductImageUrl',
            'params'                    => 'Params',
        ];
    }

    public function getRules() {
        return [
            ['id', 'integer', false],
            ['productSelectionProductId', 'integer', false],
            ['orderRowKey', 'string', false, 50],
            ['itemQuantity', 'float', true],
            ['productName', 'string', false, 500],
            ['productCode', 'string', true, 100],
            ['productDescription', 'string', false, 2147483647],
            ['itemPriceExVat', 'float', false],
            ['itemPriceIncVat', 'float', true],
            ['rowDiscountExVat', 'float', false],
            ['rowDiscountIncVat', 'float', true],
            ['vatperc', 'float', true],
            ['vATTariffId', 'integer', false],
            ['vATTariffCode', 'string', false],
            ['rowTotalExVat', 'float', false],
            ['rowTotalIncVat', 'float', true],
            ['comment', 'string', false, 2147483647],
            ['supplierId', 'integer', false],
            ['itemPurchasePrice', 'float', false],
            ['creditForOrderRowId', 'integer', false],
            ['sequence', 'integer', false],
            ['shopProductUrl', 'string', false, 200],
            ['shopProductImageUrl', 'string', false, 200],
            ['params', 'OrderRowParameter[]', false],
        ];
    }

}