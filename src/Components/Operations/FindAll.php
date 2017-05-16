<?php

namespace Afosto\ShopCtrl\Components\Operations;

use Afosto\ShopCtrl\Components\App;
use Afosto\ShopCtrl\Helpers\Exceptions\ApiException;
use GuzzleHttp\Exception\ClientException;
use Psr\Http\Message\ResponseInterface;

trait FindAll {

    private $_method;

    /**
     * @param ResponseInterface $response
     *
     * @return mixed
     */
    abstract protected function validateResponse(ResponseInterface $response);

    /**
     * @return mixed
     */
    abstract protected function getMethod();

    /**
     * Limit the amount of results that should me formatted / returned
     * @var integer
     */
    protected $limit;

    /**
     * Use in combination with limit
     * @var integer
     */
    protected $offset;

    /**
     * Use to define limits
     *
     * @param $limit
     * @param $offset
     *
     * @return $this
     */
    public function setLimit($limit, $offset) {
        $this->offset = $offset;
        $this->limit = $limit;

        return $this;
    }

    /**
     * Find all method
     *
     * @param string $uri
     *
     * @return static[]
     * @throws ApiException
     */
    public function findAll($uri = null) {
        try {
            $response = App::getInstance()->getClient()->get(($uri === null) ? $this->findAllUri() : $uri);
        } catch (ClientException $e) {
            throw new ApiException((string)$e->getRequest()->getUri() . ' | ' . (string)$e->getResponse()->getBody());
        }

        $this->validateResponse($response);

        $models = [];
        foreach ($this->_getResults($response) as $attributes) {
            $model = new static();

            $model->setAttributes($attributes);

            $model->validate();
            $models[] = $model;
        }

        return $models;
    }

    /**
     * @return string
     */
    protected function findAllUri() {
        return 'v1/' . $this->getMethod();
    }

    /**
     * @param ResponseInterface $response
     *
     * @return array
     */
    private function _getResults(ResponseInterface $response) {
        if ($this->offset !== null && $this->limit !== null) {
            return array_slice(\GuzzleHttp\json_decode((string)$response->getBody(), true), (int)$this->offset, (int)$this->limit);
        } else {
            return \GuzzleHttp\json_decode((string)$response->getBody(), true);
        }
    }

}