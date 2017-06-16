<?php

namespace Omnipay\Atol\Message;

/**
 * Class ActionRequest
 * @package Omnipay\Atol\Message
 * @method $this setParameter($name, $value);
 * @method ActionResponse send()
 */
class ActionRequest extends AbstractRestRequest
{
    public function getData()
    {

        $data = [
            'external_id' => (string)$this->getExternalId(),
            'service' => [
                'callback_url' => $this->getCallBackUrl(),
                'inn' => $this->getInn(),
                'payment_address' => $this->getPaymentAddress()
            ],
            'timestamp' => $this->getDatePayment(),// '29.05.2017 17:56:18',
        ];
        if ($this->getAction() == 'sell_correction' || $this->getAction() == 'buy_correction') {
            $data['correction'] = [
                'attributes' => [
                    'tax' => $this->getTax(),
                    'sno' => $this->getSno(),
                ],
                'payments' => [
                    [
                        'sum' => $this->getTotalSum(),
                        'type' => $this->getTypeSum()
                    ]
                ],
            ];
        } else {
            $data['receipt'] = [
                'attributes' => [
                    'email' => (string)$this->getEmail(),
                    'phone' => (string)$this->getPhone(),
                    'sno' => $this->getSno(),
                ],
                'payments' => [
                    [
                        'sum' => $this->getTotalSum(),
                        'type' => $this->getTypeSum()
                    ]
                ],
                'total' => $this->getTotalSum(),
            ];
        }

        /** @var Item $item */
        foreach ($this->getItems() as $item) {
            $data['receipt']['items'][] = [
                'name' => $item->getName(),
                'price' => $item->getPrice(),
                'quantity' => $item->getQuantity(),
                'sum' => $item->getSum(),
                'tax' => $item->getTax(),
                'tax_sum' => $item->getTaxSum(),
            ];
        }
        return $data;
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
        return parent::getEndpoint() . '/' . $this->getGroupCode() . '/' . $this->getAction();
    }

    protected function createResponse($data, $statusCode)
    {
        return $this->response = new ActionResponse($this, $data, $statusCode);
    }

    public function getAction()
    {
        return $this->getParameter('action');
    }

    public function setAction($value)
    {
        return $this->setParameter('action', $value);
    }

    public function getExternalId()
    {
        return $this->getParameter('externalId');
    }

    public function setExternalId($value)
    {
        return $this->setParameter('externalId', $value);
    }

    public function getEmail()
    {
        return $this->getParameter('email');
    }

    public function setEmail($value)
    {
        return $this->setParameter('email', $value);
    }

    public function getPhone()
    {
        return $this->getParameter('phone');
    }

    public function setPhone($value)
    {
        return $this->setParameter('phone', $value);
    }

    public function getSno()
    {
        return $this->getParameter('sno');
    }

    public function setSno($value)
    {
        return $this->setParameter('sno', $value);
    }

    public function getTypeSum()
    {
        return $this->getParameter('typeSum');
    }

    public function setTypeSum($value)
    {
        return $this->setParameter('typeSum', $value);
    }

    public function getCallBackUrl()
    {
        return $this->getParameter('callBackUrl');
    }

    public function setCallBackUrl($value)
    {
        return $this->setParameter('callBackUrl', $value);
    }

    public function getInn()
    {
        return $this->getParameter('inn');
    }

    public function setInn($value)
    {
        return $this->setParameter('inn', $value);
    }

    public function getPaymentAddress()
    {
        return $this->getParameter('paymentAddress');
    }

    public function setPaymentAddress($value)
    {
        return $this->setParameter('paymentAddress', $value);
    }

    public function getTotalSum()
    {
        return $this->getSumFormat('totalSum');
    }

    public function setTotalSum($value)
    {
        return $this->setParameter('totalSum', $value);
    }

    public function getTax()
    {
        return $this->getSumFormat('tax');
    }

    public function setTax($value)
    {
        return $this->setParameter('tax', $value);
    }

    public function getDatePayment($format = 'd.m.Y H:i:s')// '29.05.2017 17:56:18',
    {
        $date = $this->getParameter('datePayment');
        if (!($date instanceof \DateTime)) {
            $date = new \DateTime($date);
        }
        return $date->format($format);
    }

    public function setDatePayment($value)
    {
        return $this->setParameter('datePayment', $value);
    }

    /**
     * «osn» – общая СН;
     *
     * @return ActionRequest
     */
    public function setSnoOsn()
    {
        return $this->setSno('osn');
    }

    /**
     * «usn_income» – упрощенная СН (доходы);
     *
     * @return ActionRequest
     */
    public function setSnoUsnIncome()
    {
        return $this->setSno('usn_income');
    }

    /**
     * «usn_income_outcome» – упрощенная СН (доходы минус расходы);
     *
     * @return ActionRequest
     */
    public function setSnoUsnIncomeOutcome()
    {
        return $this->setSno('usn_income_outcome');
    }

    /**
     * «envd» – единый налог на вмененный доход;
     *
     * @return ActionRequest
     */
    public function setSnoEnvd()
    {
        return $this->setSno('envd');
    }

    /**
     * «esn» – единый сельскохозяйственный налог;
     *
     * @return ActionRequest
     */
    public function setSnoEsn()
    {
        return $this->setSno('esn');
    }

    /**
     * «patent» – патентная СН.
     *
     * @return ActionRequest
     */
    public function setSnoPatent()
    {
        return $this->setSno('patent');
    }
}
