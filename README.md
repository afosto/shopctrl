# ShopCtrl

Use this client to convieniently interact with ShopCtrl. This PHP package was developed by Afosto to make a reliable connection between Afosto (Retail Software) and ShopCtrl and provides the following functionality:

- get product data from ShopCtrl
- get order data from ShopCtrl
- create new orders at ShopCtrl

## Getting Started

Simply follow the installation instructions. You will need an account at ShopCtrl that is set up for you to use.

### Prerequisites

What things you need to install the software and how to install them
- PHP5.5+
- Composer (for installation)

### Installing

Installing is easy through [Composer](http://www.getcomposer.org/). 

```
composer require afosto/shopctrl
```
## Examples

Now, to fetch productdata from ShopCtrl use the following code.

First set some configuration parameters:

```php
$settings = new Settings();
```
Define the settings with data obtained from ShopCtrl
```php
$settings->shopId = '';
$settings->baseUrl = '';
$settings->username = '';
$settings->password = '';
$settings->cultureId = '';
```
Initialze the application:
```php
App::init($settings);
```

### Get a product (from shop context)

Run a foreach for ProductSelections to get shop-context-related data and the full product that belongs to the productSelection data
```php
foreach (ProductSelection::model()->findAll() as $productSelection) {
    $product = Product::model()->find($productSelection->productId);
    
    //Use the product data
    dump($productSelection, $product);
}
```


### Generate an order
To create an order use the following sample. First set the contact data.
```php
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
```
Create an order row.
```php
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
```
Create an order.
```php
$order = new Order();
$order->id = 0;
$order->shipToContact = $contact;
$order->billToContact = $contact;
$order->date = (new DateTime())->format('Y/m/d H:i:s');
$order->viewModusIncVAT = true;
$order->paymentFeeIncVat = 0;
$order->shippingCostsIncVat = 0;
$order->customerNote = '';
$order->syncSource = 'Afosto';
$order->discountIncVat = 0;
$order->orderRows[] = $orderRow;
$order->orderCode = 'test' . time();
$order->orderTotalIncVat = 5.00;
$order->currencyId = 1;
$order->currencyCode = 'EUR';
```
Set some specific data for the order based on the context / settings
```php
$order->paymentTypeId = App::getInstance()->getSettings()->getPaymentTypeId('iDeal');
$order->cultureId = App::getInstance()->getSetting('cultureId');
$order->shopId = App::getInstance()->getSetting('shopId');
$order->mainStatusId = App::getInstance()->getSettings()->getOrderStatus('Active');
```
Now create the order
```php
$order->create();
```
Now use the new data (model is updated with the results from the server)
```php
$order->id;
```

### Other examples
In the examples directory you will find more examples of this project.


## Versioning

We use [SemVer](http://semver.org/) for versioning. For the versions available, see the [tags on this repository](https://github.com/afosto/dnl/tags). 


## License

This project is licensed under the Apache License 2.0 - see the [LICENSE.md](LICENSE.md) file for details