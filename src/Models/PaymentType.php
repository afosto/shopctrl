<?php

namespace Afosto\ShopCtrl\Models;

use Afosto\ShopCtrl\Components\App;
use Afosto\ShopCtrl\Components\Model;
use Afosto\ShopCtrl\Components\Operations\FindAll;

/**
 * @property integer $id      Gets or sets the Payment Type identifier.
 * @property string  $code    Gets or sets the code.
 */
class PaymentType extends Model
{

    use FindAll;

    public function getMap()
    {
        return [
            'id'   => 'Id',
            'code' => 'Code',
        ];
    }

    public function getRules()
    {
        return [
            ['id', 'integer', true],
            ['code', 'string', true, 50],
        ];
    }

    protected function findAllUri()
    {
        return 'v1/Shops/' . App::getInstance()->getSetting('shopId') . '/' . $this->getMethod();
    }

}