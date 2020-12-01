<?php

namespace Afosto\ShopCtrl\Helpers\Exceptions;

use GuzzleHttp\Exception\ClientException;

class ApiException extends \Exception
{

    /**
     * @var \Exception|ClientException
     */
    public $exception;

    public function getResponse()
    {
        return (string)$this->exception->getResponse()->getBody();
    }

    public function getException()
    {
        return $this->exception;
    }

}