<?php

namespace Afosto\ShopCtrl\Components;

use Doctrine\Common\Inflector\Inflector;
use Psr\Http\Message\ResponseInterface;
use Afosto\ShopCtrl\Helpers\Exceptions\ApiException;

abstract class Model extends \Afosto\Bp\Components\Model
{

    /**
     * @var string
     */
    private $_method;

    /**
     * @return mixed
     */
    public function getModel()
    {
        return $this->_cleanup(parent::getModel());
    }

    /**
     * @param ResponseInterface $response
     *
     * @throws ApiException
     */
    protected function validateResponse(ResponseInterface $response)
    {
        if (substr($response->getStatusCode(), 0, 1) != 2) {
            throw new ApiException($response->getReasonPhrase());
        }
    }

    /***
     * @return string
     */
    protected function getMethod()
    {
        if ($this->_method === null) {
            $this->_method = Inflector::pluralize((new \ReflectionClass(new static()))->getShortName());
        }

        return $this->_method;
    }

    /**
     * Remove empty values from dataset
     *
     * @param $modelData
     *
     * @return mixed
     */
    private function _cleanup($modelData)
    {
        foreach ($modelData as $key => $value) {
            if (is_array($value)) {
                $data[$key] = $this->_cleanup($modelData[$key]);
            }

            if ($modelData[$key] === null) {
                unset($modelData[$key]);
            }
        }

        return $modelData;
    }

}