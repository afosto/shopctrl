<?php

namespace Afosto\ShopCtrl\Models;

use Afosto\ShopCtrl\Components\Model;
use Afosto\ShopCtrl\Components\Operations\Create;
use Afosto\ShopCtrl\Components\Operations\Delete;
use Afosto\ShopCtrl\Components\Operations\Find;
use Afosto\ShopCtrl\Components\Operations\FindAll;
use Afosto\ShopCtrl\Components\App;
use Afosto\ShopCtrl\Components\Operations\Update;

/**
 * @property boolean             $recalculateTotalsOnSave       Gets or sets a value indicating whether we should recalculate the totals.
 * @property boolean             $synchronizeOrderParameters    Gets or sets a value indicating whether we should synchronize the order parameters.
 * @property boolean             $autoCreateCustomer            Gets or sets a value indicating whether a Customer must be created when not provided and can't be linked to an existing customer.
 * @property \DateTime           $preferredDeliveryDate         Gets or sets the preferred delivery date
 * @property OrderStatus         $mainStatus                    Gets or sets the main status.
 * @property OrderStatus         $paymentStatus                 Gets or sets the payment status.
 * @property OrderStatus         $stockStatus                   Gets or sets the stock status.
 * @property OrderStatus         $fulfilmentStatus              Gets or sets the Fulfilment status.
 * @property OrderStatus         $shipmentStatus                Gets or sets the shipment status.
 * @property OrderStatus         $customStatus                  Gets or sets the custom status.
 * @property string              $cultureCode                   Gets or sets the culture code. When adding/updating an Order, ShopCtrl will first try to find the Culture based on the provided CultureId. If not provided, the culture will be determined based on the provided CultureCode.
 * @property integer             $cultureId                     Gets or sets the culture identifier. When adding/updating an Order, ShopCtrl will first try to find the Culture based on the provided CultureId. If not provided, the culture will be determined based on the provided CultureCode.
 * @property float               $exchangeRate                  Gets or sets the exchange rate.
 * @property integer             $shopId                        Gets or sets the shop identifier.
 * @property boolean             $viewModusIncVAT               Gets or sets a value indicating the view modus (the VAT is included).
 * @property string              $externalOrderKey              Gets or sets the external order key.
 * @property string              $couponCode                    Gets or sets the coupon code.
 * @property float               $paymentFeeIncVat              Gets or sets the payment fee (include VAT).
 * @property float               $paymentFeeExVat               Gets or sets the payment fee (excluded VAT).
 * @property float               $shippingCostsIncVat           Gets or sets the shipping costs (include VAT).
 * @property float               $shippingCostsExVat            Gets or sets the shipping costs (exclude VAT).
 * @property integer             $paymentTypeId                 Gets or sets the payment type identifier.
 * @property integer             $carrierAccountId              Gets or sets the Carrier Account identifier.
 * @property integer             $customerId                    Gets or sets the customer identifier. When adding/updating an Order, ShopCtrl will first try to find the Customer based on the provided CustuomerId.
 * @property string              $customerCode                  Gets or sets the CustomerCode, as defined for the Customer. When adding/updating an Order, ShopCtrl will first try to find the Customer based on the provided CustuomerId. If not provided, the customer will be determined based on the provided CustomerCode.
 * @property string              $customerReference             Gets or sets the reference provided by the customer.
 * @property string              $customerNote                  Gets or sets the customer note.
 * @property integer             $customerRating                This field is used for rating by the customer.
 * @property string              $shopNote                      Gets or sets the shop note.
 * @property string              $syncSource                    Gets or sets the synchronize source.
 * @property string              $customerIpaddress             Gets or sets the customer ipaddress.
 * @property float               $discountExVat                 Gets or sets the discount (exclude VAT).
 * @property float               $discountIncVat                Gets or sets the discount (include VAT).
 * @property ContactInfo         $billToContact                 Gets or sets the bill to contact.
 * @property ContactInfo         $shipToContact                 Gets or sets the ship to contact.
 * @property OrderParameter[]    $params                        Gets or sets the parameters.
 * @property OrderRow[]          $orderRows                     Gets or sets the order rows.
 * @property ShipmentBasicInfo[] $shipments                     Gets the order Shipment infos.
 * @property integer             $id                            Gets or sets the identifier.
 * @property string              $orderCode                     Gets or sets the order code.
 * @property \DateTime           $date                          Gets or sets the date.
 * @property float               $orderTotalIncVat              Gets or sets the order total with the 'VAT'.
 * @property float               $orderTotalExVat               Gets or sets the order total without the 'VAT'.
 * @property integer             $currencyId                    Gets or sets the currency identifier.
 * @property string              $currencyCode                  Gets or sets the currency code.
 * @property boolean             $deleted                       Gets or sets a value indicating whether this is deleted.
 * @property \DateTime           $changeTimestamp               Gets or sets the change timestamp.
 * @property integer             $mainStatusId                  Gets or sets the main status identifier.
 * @property integer             $affiliateId                   Gets or sets the Affiliate identifier.
 */
class Order extends Model
{
    const REVIEW_DISABLE_INVITE = -3;

    use Find, FindAll, Create, Update, Delete;

    public function getMap()
    {
        return [
            'recalculateTotalsOnSave'    => 'RecalculateTotalsOnSave',
            'synchronizeOrderParameters' => 'SynchronizeOrderParameters',
            'autoCreateCustomer'         => 'AutoCreateCustomer',
            'preferredDeliveryDate'      => 'PreferredDeliveryDate',
            'mainStatus'                 => 'MainStatus',
            'paymentStatus'              => 'PaymentStatus',
            'stockStatus'                => 'StockStatus',
            'fulfilmentStatus'           => 'FulfilmentStatus',
            'shipmentStatus'             => 'ShipmentStatus',
            'customStatus'               => 'CustomStatus',
            'cultureCode'                => 'CultureCode',
            'cultureId'                  => 'CultureId',
            'exchangeRate'               => 'ExchangeRate',
            'shopId'                     => 'ShopId',
            'viewModusIncVAT'            => 'ViewModusIncVAT',
            'externalOrderKey'           => 'ExternalOrderKey',
            'couponCode'                 => 'CouponCode',
            'paymentFeeIncVat'           => 'PaymentFeeIncVat',
            'paymentFeeExVat'            => 'PaymentFeeExVat',
            'shippingCostsIncVat'        => 'ShippingCostsIncVat',
            'shippingCostsExVat'         => 'ShippingCostsExVat',
            'paymentTypeId'              => 'PaymentTypeId',
            'carrierAccountId'           => 'CarrierAccountId',
            'customerId'                 => 'CustomerId',
            'customerCode'               => 'CustomerCode',
            'customerReference'          => 'CustomerReference',
            'customerNote'               => 'CustomerNote',
            'customerRating'             => 'CustomerRating',
            'shopNote'                   => 'ShopNote',
            'syncSource'                 => 'SyncSource',
            'customerIpaddress'          => 'CustomerIpaddress',
            'discountExVat'              => 'DiscountExVat',
            'discountIncVat'             => 'DiscountIncVat',
            'billToContact'              => 'BillToContact',
            'shipToContact'              => 'ShipToContact',
            'params'                     => 'Params',
            'orderRows'                  => 'OrderRows',
            'shipments'                  => 'Shipments',
            'id'                         => 'Id',
            'orderCode'                  => 'OrderCode',
            'date'                       => 'Date',
            'orderTotalIncVat'           => 'OrderTotalIncVat',
            'orderTotalExVat'            => 'OrderTotalExVat',
            'currencyId'                 => 'CurrencyId',
            'currencyCode'               => 'CurrencyCode',
            'deleted'                    => 'Deleted',
            'changeTimestamp'            => 'ChangeTimestamp',
            'mainStatusId'               => 'MainStatusId',
            'affiliateId'                => 'AffiliateId',
        ];
    }

    public function getRules()
    {
        return [
            ['recalculateTotalsOnSave', 'boolean', false],
            ['synchronizeOrderParameters', 'boolean', false],
            ['autoCreateCustomer', 'boolean', false],
            ['preferredDeliveryDate', '\DateTime', false],
            ['mainStatus', 'OrderStatus', false],
            ['paymentStatus', 'OrderStatus', false],
            ['stockStatus', 'OrderStatus', false],
            ['fulfilmentStatus', 'OrderStatus', false],
            ['shipmentStatus', 'OrderStatus', false],
            ['customStatus', 'OrderStatus', false],
            ['cultureCode', 'string', false],
            ['cultureId', 'integer', false],
            ['exchangeRate', 'float', false],
            ['shopId', 'integer', false],
            ['viewModusIncVAT', 'boolean', false],
            ['externalOrderKey', 'string', false, 50],
            ['couponCode', 'string', false, 50],
            ['paymentFeeIncVat', 'float', false],
            ['paymentFeeExVat', 'float', false],
            ['shippingCostsIncVat', 'float', false],
            ['shippingCostsExVat', 'float', false],
            ['paymentTypeId', 'integer', false],
            ['carrierAccountId', 'integer', false],
            ['customerId', 'integer', false],
            ['customerCode', 'string', false],
            ['customerReference', 'string', false, 50],
            ['customerNote', 'string', false, 2147483647],
            ['customerRating', 'integer', false],
            ['shopNote', 'string', false, 2147483647],
            ['syncSource', 'string', false, 50],
            ['customerIpaddress', 'string', false, 40],
            ['discountExVat', 'float', false],
            ['discountIncVat', 'float', false],
            ['billToContact', 'ContactInfo', false],
            ['shipToContact', 'ContactInfo', false],
            ['params', 'OrderParameter[]', false],
            ['orderRows', 'OrderRow[]', false],
            ['shipments', 'ShipmentBasicInfo[]', false],
            ['id', 'integer', false],
            ['orderCode', 'string', true, 50],
            ['date', '\DateTime', true],
            ['orderTotalIncVat', 'float', true],
            ['orderTotalExVat', 'float', false],
            ['currencyId', 'integer', false],
            ['currencyCode', 'string', false],
            ['deleted', 'boolean', false],
            ['changeTimestamp', '\DateTime', false],
            ['mainStatusId', 'integer', false],
            ['affiliateId', 'integer', false],
        ];
    }

    /**
     * Do not send an invitation to review the order process
     */
    public function disableReviewInvitation()
    {
        $this->customerRating = self::REVIEW_DISABLE_INVITE;
    }

    protected function findAllUri()
    {
        return 'v1/Shops/' . App::getInstance()->getSetting('shopId') . '/' . $this->getMethod();
    }

    protected function createUri()
    {
        return $this->findAllUri();
    }

    protected function updateUri()
    {
        return 'v1/Orders';
    }
}
