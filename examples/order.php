<?php

require_once dirname(__FILE__) . '/../vendor/autoload.php';

use Afosto\ShopCtrl\Models\ContactInfo;
use Afosto\ShopCtrl\Models\OrderRow;
use Afosto\ShopCtrl\Models\Order;
use Afosto\ShopCtrl\Components\App;
use Afosto\ShopCtrl\Components\Settings;

$settings = new Settings();
$settings->shopId = '';
$settings->baseUrl = '';
$settings->username = '';
$settings->password = '';
$settings->cultureId = '';

App::init($settings,new \Cache\Adapter\PHPArray\ArrayCachePool());

$contact = new ContactInfo();
$contact->streetAddress = 'Grondzijl';
$contact->streetAddressNumber = 16;
$contact->city = 'Groningen';
$contact->countryCode = 'NL';
$contact->companyName = 'Afosto SaaS BV';
$contact->eMail = 'peter@afosto.com';
$contact->firstName = 'Peter';
$contact->lastName = 'Bakker';
$contact->postalCode = '9731DG';
$contact->phone = '0507119519';

$orderRow = new OrderRow();
$orderRow->orderRowKey = 1;
$orderRow->itemQuantity = 1;
$orderRow->productName = 'TestProduct';
$orderRow->productCode = 'ProductSku';
$orderRow->productDescription = 'Description test product';
$orderRow->itemPriceIncVat = 5.00;
$orderRow->rowDiscountIncVat = 0;
$orderRow->vatperc = 21;
$orderRow->rowTotalIncVat = 5;

$order = new Order();
$order->id = 0;
$order->shipToContact = $contact;
$order->billToContact = $contact;
$order->date = (new DateTime())->format('Y/m/d H:i:s');
$order->cultureId = App::getInstance()->getSetting('cultureId');
$order->shopId = App::getInstance()->getSetting('shopId');
$order->viewModusIncVAT = true;
$order->paymentFeeIncVat = 0;
$order->shippingCostsIncVat = 0;
$order->paymentTypeId = App::getInstance()->getSettings()->getPaymentTypeId('iDeal');
$order->customerNote = '';
$order->syncSource = 'Afosto';
$order->discountIncVat = 0;
$order->orderRows[] = $orderRow;
$order->orderCode = 'test' . time();
$order->orderTotalIncVat = 5.00;
$order->currencyId = 1;
$order->currencyCode = 'EUR';
$order->mainStatusId = App::getInstance()->getSettings()->getOrderStatus('Active');

$order->create();

//Get the newly generated order id:
$order->id;