<?php

namespace pamkil\atol\Message;

use Omnipay\Common\Message\AbstractResponse;
use Omnipay\Common\Message\RequestInterface;

class RestResponse extends AbstractResponse
{
    protected $statusCode;

    public function __construct(RequestInterface $request, $data, $statusCode = 200)
    {
        parent::__construct($request, $data);
        $this->statusCode = $statusCode;
    }

    public function isSuccessful()
    {
        return empty($this->data['error']) && $this->getStatusCode() < 400;
    }

    public function getMessage()
    {
        if (isset($this->data['text'])) {
            return $this->data['text'];
        }

        if (isset($this->data['message'])) {
            return $this->data['message'];
        }

        return null;
    }

    public function getCode()
    {
        return $this->getParam('code');
    }

    public function getStatusCode()
    {
        return $this->statusCode;
    }

    public function getParam($name)
    {
        if (isset($this->data[$name])) {
            return $this->data[$name];
        }

        return null;
    }
}
