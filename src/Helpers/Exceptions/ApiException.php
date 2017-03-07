<?php

namespace Afosto\ShopCtrl\Helpers\Exceptions;

use GuzzleHttp\Exception\ClientException;

class ApiException extends \Exception {

    /**
     * @var ClientException
     */
    private $previous;

    public function getResponse() {
        return (string)$this->previous->getResponse()->getBody();
    }

}