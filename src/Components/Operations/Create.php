<?php

namespace Afosto\ShopCtrl\Components\Operations;

use Afosto\ShopCtrl\Components\App;
use Afosto\ShopCtrl\Helpers\Exceptions\ApiException;
use GuzzleHttp\Exception\ClientException;
use Psr\Http\Message\ResponseInterface;

trait Create {

    abstract protected function getMethod();

    abstract protected function validateResponse(ResponseInterface $response);

    /**
     * @return static
     * @throws ApiException
     */
    public function create() {
        try {
            $response = App::getInstance()
                           ->getClient()
                           ->post($this->createUri(), ['json' => $this->getModel()]);
        } catch (ClientException $previous) {
            $e = new ApiException((string)$previous->getResponse()->getBody());
            $e->exception = $previous;
            throw $e;
        }

        $this->validateResponse($response);
        $this->setAttributes(\GuzzleHttp\json_decode((string)$response->getBody(), true));
        $this->validate();
    }

    /**
     * @return string
     */
    protected function createUri() {
        return 'v1/' . $this->getMethod();
    }
}