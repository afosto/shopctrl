<?php

namespace Afosto\ShopCtrl\Components\Operations;

use Afosto\ShopCtrl\Components\App;
use Afosto\ShopCtrl\Helpers\Exceptions\ApiException;
use GuzzleHttp\Exception\ClientException;
use Psr\Http\Message\ResponseInterface;

trait Update
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
     * @param null $uri
     *
     * @throws ApiException
     */
    public function update()
    {
        try {
            $response = App::getInstance()
                ->getClient()
                ->put($this->updateUri(), ['json' => $this->getModel()]);
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
    protected function updateUri()
    {
        return 'v1/' . $this->getMethod();
    }

}