<?php

namespace Afosto\ShopCtrl\Components;

use Afosto\ShopCtrl\Helpers\Exceptions\AppException;
use Afosto\ShopCtrl\Models\Culture;
use Afosto\ShopCtrl\Models\ExchangeRate;
use Afosto\ShopCtrl\Models\OrderStatus;
use Afosto\ShopCtrl\Models\PaymentType;
use Afosto\ShopCtrl\Models\Currency;
use Psr\Cache\CacheItemPoolInterface;

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
class Settings extends Model
{

    public function getRules()
    {
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

    /**
     * @param $cache CacheItemPoolInterface
     *
     * @return void
     * @throws \Afosto\ShopCtrl\Helpers\Exceptions\ApiException
     */
    public function init(CacheItemPoolInterface $cache)
    {
        $item = $cache->getItem("paymentTypes");

        if (($types = $item->get()) == null) {
            $this->paymentTypes = PaymentType::model()->findAll();
            $item->set($this->paymentTypes);
            $item->expiresAfter(3600);
            $cache->save($item);
        } else {
            $this->paymentTypes = $types;
        }

        $item = $cache->getItem("orderStatusses");
        if (($types = $item->get()) == null) {
            $this->orderStatusses = OrderStatus::model()->findAll();
            $item->set($this->orderStatusses);
            $item->expiresAfter(3600);
            $cache->save($item);
        } else {
            $this->orderStatusses = $types;
        }

        $item = $cache->getItem("exchangeRates");
        if (($types = $item->get()) == null) {
            $this->exchangeRates = ExchangeRate::model()->findAll();
            $item->set($this->exchangeRates);
            $item->expiresAfter(3600);
            $cache->save($item);
        } else {
            $this->exchangeRates = $types;
        }

        $item = $cache->getItem("exchangeRates");
        if (($types = $item->get()) == null) {
            $this->currencies = Currency::model()->findAll();
            $item->set($this->currencies);
            $item->expiresAfter(3600);
            $cache->save($item);
        } else {
            $this->currencies = $types;
        }

        $item = $cache->getItem("cultures");
        if (($types = $item->get()) == null) {
            $this->cultures = Culture::model()->findAll();
            $item->set($this->cultures);
            $item->expiresAfter(3600);
            $cache->save($item);
        } else {
            $this->cultures = $types;
        }
    }

    public function getPaymentTypeId($code)
    {
        foreach ($this->paymentTypes as $paymentType) {
            if (strtolower($paymentType->code) == strtolower($code)) {
                return $paymentType->id;
            }
        }
        throw new AppException('Payment type not found for code: ' . $code);
    }

    public function getOrderStatus($code)
    {
        foreach ($this->orderStatusses as $orderStatus) {
            if (strtolower($orderStatus->code) == strtolower($code)) {
                return $orderStatus->id;
            }
        }
        throw new AppException('OrderStatus for given code unknown:' . $code);
    }

}