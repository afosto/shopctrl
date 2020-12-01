<?php

namespace Afosto\ShopCtrl\Components\Operations;

use Afosto\ShopCtrl\Components\App;
use Afosto\ShopCtrl\Helpers\Exceptions\ApiException;
use GuzzleHttp\Exception\ClientException;
use Psr\Http\Message\ResponseInterface;

trait Update
{

    abstract protected function getMethod();

    abstract protected function validateResponse(ResponseInterface $response);

    /**
     * @return static
     * @throws ApiException
     */
    public function update($id)
    {
        try {
            $response = App::getInstance()
                           ->getClient()
                           ->put($this->updateUri($id), ['json' => $this->getModel()]);
        } catch (ClientException $previous) {
            $e = new ApiException((string)$previous->getResponse()->getBody());
            $e->exception = $previous;
            throw $e;
        }

        $content = $response->getBody()->getContents();
        if ($content == "") {
            return $this;
        } else {
            $this->validateResponse($response);
            $this->setAttributes(\GuzzleHttp\json_decode((string)$response->getBody(), true));
            $this->validate();
        }

        return $this;
    }

    /**
     * @return string
     */
    protected function updateUri($id)
    {
        return 'v1/' . $this->getMethod() . '/' . $id;
    }
}