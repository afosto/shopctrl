<?php

namespace Afosto\ShopCtrl\Components;

use Afosto\ShopCtrl\Helpers\Exceptions\AppException;
use Afosto\ShopCtrl\Models\Culture;
use Afosto\ShopCtrl\Models\ExchangeRate;
use Afosto\ShopCtrl\Models\OrderStatus;
use Afosto\ShopCtrl\Models\PaymentType;
use Afosto\ShopCtrl\Models\Currency;

/**
 * Class Settings
 * @package Afosto\ShopCtrl\Components
 * @property integer        $shopId
 * @property string         $baseUrl
 * @property string         $username
 * @property string         $password
 * @property integer        $cultureId
 * @property integer        $shopOwnerId
 * @property integer        $shopGroupId
 * @property Culture[]      $cultures
 * @property PaymentType[]  $paymentTypes
 * @property OrderStatus[]  $orderStatusses
 * @property ExchangeRate[] $exchangeRates
 * @property Currency[]     $currencies
 */
class Settings extends Model {

    public function getRules() {
        return [
            ['shopId', 'integer', false],
            ['baseUrl', 'string', true],
            ['username', 'string', true],
            ['password', 'string', true],
            ['cultureId', 'integer', false],
            ['shopGroupId', 'integer', false],
            ['shopOwnerId', 'integer', false],
            ['cultures', 'Culture[]', false],
            ['paymentTypes', 'PaymentType[]', false],
            ['orderStatusses', 'OrderStatus[]', false],
            ['exchangeRates', 'ExchangeRate[]', false],
            ['currencies', 'Currency[]', false],
        ];
    }

    public function init() {
        $this->paymentTypes = PaymentType::model()->findAll();
        $this->orderStatusses = OrderStatus::model()->findAll();
        $this->exchangeRates = ExchangeRate::model()->findAll();
        $this->currencies = Currency::model()->findAll();
        $this->cultures = Culture::model()->findAll();
    }

    public function getPaymentTypeId($code) {
        foreach ($this->paymentTypes as $paymentType) {
            if (strtolower($paymentType->code) == strtolower($code)) {
                return $paymentType->id;
            }
        }
        throw new AppException('Payment type not found for code: ' . $code);
    }

    public function getOrderStatus($code) {
        foreach ($this->orderStatusses as $orderStatus) {
            if (strtolower($orderStatus->code) == strtolower($code)) {
                return $orderStatus->id;
            }
        }
        throw new AppException('OrderStatus for given code unknown:' . $code);
    }

}