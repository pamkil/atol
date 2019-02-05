<?php

namespace Omnipay\Atol\Message;

use DateTime;
use Omnipay\Atol\Constant;
use Omnipay\Common\Exception\InvalidRequestException;

/**
 * Class ActionRequest
 * @package Omnipay\Atol\Message
 * @method $this setParameter($name, $value);
 * @method ActionResponse send()
 */
class ActionRequest extends AbstractRestRequest
{
    /**
     * @return array|mixed
     * @throws InvalidRequestException
     * @throws \Exception
     */
    public function getData(): array
    {
        $this->validate('externalId', 'inn', 'datePayment', 'paymentAddress', 'totalSum', 'typeSum', 'totalSum');
        $data = [
            'external_id' => (string)$this->getExternalId(),
            'service' => [
                'callback_url' => $this->getCallBackUrl(),
            ],
            'timestamp' => $this->getDatePayment(),
        ];

        if ($this->getAction() == 'sell_correction' || $this->getAction() == 'buy_correction') {
            $data['correction'] = $this->getDataCorrection();
        } else {
            $data['receipt'] = $this->getDataReceipt();
        }

        return $data;
    }

    /**
     * @return array
     * @throws InvalidRequestException
     */
    private function getDataReceipt(): array
    {
        $this->setEmail($this->getTestMode() ? $this->getTestEmail() : $this->getEmail());
        $this->setPhone($this->getTestMode() ? $this->getTestPhone() : $this->getPhone());
        if (empty($this->getEmail()) && empty($this->getPhone())) {
            $this->validate('email', 'phone');
        }

        $data = [
            'client' => [
                'email' => (string) $this->getEmail(),
                'phone' => (string) $this->getPhone(),
            ],
            'company' => $this->getDataCompany(true),
            'payments' => [
                [
                    'sum' => $this->getTotalSum(),
                    'type' => $this->getTypeSum(),
                ]
            ],
            'total' => $this->getTotalSum(),
        ];

        /** @var \Omnipay\Atol\Item $item */
        foreach ($this->getItems() as $item) {
            $item->validate('name', 'price', 'quantity', 'sum', 'vatType');

            $product = [
                'name' => $item->getName(),
                'price' => $item->getPrice(),
                'quantity' => $item->getQuantity(),
                'sum' => $item->getSum(),
                'vat' => [
                    'type' => $item->getVatType(),
                    'sum' => $item->getVatSum(),
                ],
            ];

            if ($item->getMeasurementUnit() !== null) {
                $product['measurement_unit'] = $item->getMeasurementUnit();
            }

            if ($item->getPaymentMethod() !== null) {
                $product['payment_method'] = $item->getPaymentMethod();
            }

            $data['items'][] = $product;
        }

        return $data;
    }

    /**
     * @return array
     * @throws InvalidRequestException
     * @throws \Exception
     */
    private function getDataCorrection(): array
    {
        $this->validate('tax', 'sumTax', 'correctionName', 'correctionNum', 'correctionType', 'correctionDate');
        $data = [
            'company' => $this->getDataCompany(),
            'correction_info' => [
                'type' => $this->getCorrectionType(),
                'base_date' => $this->getCorrectionDate(),
                'base_number' => $this->getCorrectionNum(),
                'base_name' => $this->getCorrectionName(),
            ],
            'payments' => [
                [
                    'sum' => $this->getTotalSum(),
                    'type' => $this->getTypeSum(),
                ]
            ],
            'vats' => [
                'tax' => $this->getTax(),
                'sum' => $this->getSumTax(),
            ],
        ];

        if (!empty($this->getCashier())) {
            $data['cashier'] = $this->getCashier();
        }

        return $data;
    }

    /**
     * @param bool $withEmail
     * @return array
     * @throws InvalidRequestException
     */
    private function getDataCompany(bool $withEmail = false)
    {
        $company = [
            'sno' => $this->getSno(),
            'inn' => $this->getInn(),
            'payment_address' => $this->getPaymentAddress(),
        ];

        if ($withEmail) {
            $this->validate('emailCompany');
            $company['email'] = $this->getEmailCompany();
        }

        return $company;
    }

    /**
     * Get transaction endpoint.
     * Authorization of payments is done using the /payment resource.
     *
     * @return string
     * @throws InvalidRequestException
     */
    protected function getEndpoint()
    {
        $this->validate('groupCode', 'action');

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

    /**
     * @param string $value
     * @return ActionRequest
     * @throws InvalidRequestException
     */
    public function setAction(string $value)
    {
        $this->validateValue($value, Constant::getOperations(), 'action');

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

    public function getEmailCompany()
    {
        return $this->getParameter('emailCompany');
    }

    public function setEmailCompany($value)
    {
        return $this->setParameter('emailCompany', $value);
    }

    public function getSumTax()
    {
        return $this->getParameter('sumTax');
    }

    public function setSumTax($value)
    {
        return $this->setParameter('sumTax', $value);
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
        $this->validateValue($value, Constant::getSnos(), 'sno');

        return $this->setParameter('sno', $value);
    }

    public function getTypeSum()
    {
        return $this->getParameter('typeSum');
    }

    public function setTypeSum($value)
    {
        $this->validateValue($value, Constant::getPaymentTypes(), 'payment_type');

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

    public function getCorrectionName()
    {
        return $this->getParameter('correctionName');
    }

    public function setCorrectionName($value)
    {
        return $this->setParameter('correctionName', $value);
    }

    public function getCorrectionNum()
    {
        return $this->getParameter('correctionNum');
    }

    public function setCorrectionNum($value)
    {
        return $this->setParameter('correctionNum', $value);
    }

    /**
     * @param string $format
     * @return string
     * @throws \Exception
     */
    public function getCorrectionDate($format = 'd.m.Y H:i:s')
    {
        $date = $this->getParameter('correctionDate');
        if (!($date instanceof DateTime)) {
            $date = new DateTime($date);
        }

        return $date->format($format);
    }

    public function setCorrectionDate($value)
    {
        return $this->setParameter('correctionDate', $value);
    }

    public function getCorrectionType()
    {
        return $this->getParameter('correctionType');
    }

    public function setCorrectionType($value)
    {
        return $this->setParameter('correctionType', $value);
    }

    public function getCashier()
    {
        return $this->getParameter('cashier');
    }

    public function setCashier($value)
    {
        return $this->setParameter('cashier', $value);
    }

    /**
     * @param string $format
     * @return string
     * @throws \Exception
     */
    public function getDatePayment($format = 'd.m.Y H:i:s')// '29.05.2017 17:56:18',
    {
        $date = $this->getParameter('datePayment');
        if (!($date instanceof DateTime)) {
            $date = new DateTime($date);
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
