<?php

namespace pamkil\atol\Message;

/**
 * Class ActionRequest
 * @package pamkil\atol\Message
 * @method ActionRequest setParameter($key, $value)
 */
class ReportRequest extends AbstractRestRequest
{
    public function getData()
    {
        return [];
    }

    /**
     * Get transaction endpoint.
     *
     * Authorization of payments is done using the /payment resource.
     *
     * @return string
     */
    protected function getEndpoint()
    {
        return parent::getEndpoint() . '/' . $this->getGroupCode() . '/report/' . $this->getTransactionId();
    }

    public function getHttpMethod()
    {
        return 'GET';
    }

    protected function createResponse($data, $statusCode)
    {
        return $this->response = new ReportResponse($this, $data, $statusCode);
    }
}
