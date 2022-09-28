<?php

require_once dirname(__FILE__) . '/../vendor/autoload.php';

use Afosto\ShopCtrl\Models\ProductSelection;
use Afosto\ShopCtrl\Models\Product;
use Afosto\ShopCtrl\Components\App;
use Afosto\ShopCtrl\Components\Settings;

$settings = new Settings();
$settings->shopId = '';
$settings->baseUrl = '';
$settings->username = '';
$settings->password = '';
$settings->cultureId = '';

App::init($settings,new \Cache\Adapter\PHPArray\ArrayCachePool());

foreach (ProductSelection::model()->findAll() as $productSelection) {

    $inventoryForShop = $productSelection->qtyAvailable;
    $stateForShop = $productSelection->active;
    $priceForShop = $productSelection->foreignPriceIncVAT;

    //Full product data
    $product = Product::model()->find($productSelection->productId);

    //Use the data
    dump($inventoryForShop, $stateForShop, $priceForShop, $product);

    break;
}