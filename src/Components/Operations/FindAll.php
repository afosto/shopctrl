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
     * @param null $uri
     *
     * @return static[]
     * @throws ApiException
     */
    public function findAll($uri = null) {
        if ($uri === null) {
            $uri = $this->findAllUri();
        }

        try {
            $response = App::getInstance()->getClient()->get($uri);
        } catch (ClientException $e) {
            throw new ApiException((string)$e->getRequest()->getUri() . ' | ' . (string)$e->getResponse()->getBody());
        }

        $this->validateResponse($response);

        $models = [];

        foreach (\GuzzleHttp\json_decode((string)$response->getBody(), true) as $attributes) {
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

}