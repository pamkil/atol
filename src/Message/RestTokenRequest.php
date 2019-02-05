<?php

namespace Omnipay\Atol\Message;

class RestTokenRequest extends AbstractRestRequest
{
    public function getData()
    {
        $this->validate('login', 'pass');

        return [
            'login' => $this->getLogin(),
            'pass' => $this->getPass(),
        ];
    }

    protected function getEndpoint()
    {
        return parent::getEndpoint() . '/getToken';
    }

    public function sendData($data)
    {
        // don't throw exceptions for 4xx errors
        $this->httpClient->getEventDispatcher()->addListener(
            'request.error',
            function ($event) {
                if ($event['response']->isClientError()) {
                    $event->stopPropagation();
                }
            }
        );

        $httpRequest = $this->httpClient->createRequest(
            $this->getHttpMethod(),
            $this->getEndpoint(),
            array(
                'Accept' => 'application/json',
                'Content-type' => 'application/json; charset=utf-8',
            ),
            $this->toJSON($data)
        );

        $httpResponse = $httpRequest->send();
        // Empty response body should be parsed also as and empty array
        $body = $httpResponse->getBody(true);
        $jsonToArrayResponse = !empty($body) ? $httpResponse->json() : [];
        return $this->response = new RestResponse($this, $jsonToArrayResponse, $httpResponse->getStatusCode());
    }
}
