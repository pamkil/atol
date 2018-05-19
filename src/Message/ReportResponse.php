<?php

namespace Omnipay\Atol\Message;

class ReportResponse extends RestResponse
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
        $date = $this->getParam('timestamp');
        if (!empty($date)) {
            $date = (new \DateTime($date))->format('Y-m-d H:i:s');
        }

        return $date;
    }

    public function getGroupCode()
    {
        return $this->getParam('group_code');
    }

    public function getDaemonCode()
    {
        return $this->getParam('daemon_code');
    }

    public function getDeviceCode()
    {
        return $this->getParam('device_code');
    }

    public function getCallback_url()
    {
        return $this->getParam('callback_url');
    }

    public function getPayload()
    {
        return $this->getParam('payload');
    }
}
