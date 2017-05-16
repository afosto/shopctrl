<?php

namespace Afosto\ShopCtrl\Components\Operations;

use Afosto\ShopCtrl\Components\App;
use Afosto\ShopCtrl\Helpers\Exceptions\ApiException;
use GuzzleHttp\Exception\ClientException;
use Psr\Http\Message\ResponseInterface;

trait Find {

    /**
     * @param ResponseInterface $response
     */
    abstract protected function validateResponse(ResponseInterface $response);

    /**
     * @return string
     */
    abstract protected function getMethod();

    /**
     * @param null $id
     * @param null $uri
     *
     * @return static
     * @throws ApiException
     */
    public function find($id = null, $uri = null) {
        try {
            $response = App::getInstance()->getClient()->get(($uri === null) ? $this->findUri($id) : $uri);
        } catch (ClientException $e) {
            throw new ApiException((string)$e->getResponse()->getBody());
        }
        $this->validateResponse($response);

        $body = \GuzzleHttp\json_decode((string)$response->getBody());

        $model = new static();
        $model->setAttributes($body);
        $model->validate();

        return $model;
    }

    /**
     * @param $id
     *
     * @return string
     */
    protected function findUri($id) {
        return 'v1/' . $this->getMethod() . '/' . $id;
    }

}