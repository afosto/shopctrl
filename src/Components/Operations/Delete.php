<?php

namespace Afosto\ShopCtrl\Components\Operations;

use Afosto\ShopCtrl\Components\App;
use Afosto\ShopCtrl\Helpers\Exceptions\ApiException;
use GuzzleHttp\Exception\ClientException;
use Psr\Http\Message\ResponseInterface;

trait Delete
{

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
     *
     * @throws ApiException
     */
    public function delete($id = null)
    {
        try {
            $response = App::getInstance()->getClient()->delete($this->deleteUri($id));
        } catch (ClientException $previous) {
            $e = new ApiException((string)$previous->getResponse()->getBody());
            $e->exception = $previous;
            throw $e;
        }

        return $response;
    }

    /**
     * @param $id
     *
     * @return string
     */
    protected function deleteUri($id)
    {
        return 'v1/' . $this->getMethod() . '/' . $id;
    }

}