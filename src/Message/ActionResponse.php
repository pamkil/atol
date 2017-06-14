<?php

namespace Omnipay\Atol\Message;

class ActionResponse extends RestResponse
{
    public function getUuid()
    {
        return $this->getParam('uuid');
    }

    public function getStatus()
    {
        return $this->getParam('status');
    }

    public function getError()
    {
        return $this->getParam('error');
    }

    public function getTimestamp()
    {
        return $this->getParam('timestamp');
    }
}
