<?php

namespace pamkil\atol\Message;

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
//          "error": {
//              "code": 2,
//              "text": "Некорректный запрос",
//              "type": "system"
//          },
    }

    public function getTimestamp()
    {
        return $this->getParam('timestamp');
    }

    public function getGroup_code()
    {
        return $this->getParam('group_code');
    }

    public function getDaemon_code()
    {
        return $this->getParam('daemon_code');
    }

    public function getDevice_code()
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
//      "payload": {
//          "total": 1598,
//          "fns_site": "www.nalog.ru",
//          "fn_number": "1110000100238211",
//          "shift_number": 23,
//          "receipt_datetime": "12.04.2017 20:16:00",
//          "fiscal_receipt_number": 6,
//          "fiscal_document_number": 133,
//          "ecr_registration_number": "0000111118041361",
//          "fiscal_document_attribute": 3449555941
//      },
    }
}
