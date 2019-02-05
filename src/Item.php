<?php

namespace Omnipay\Atol;

use Omnipay\Common\Exception\InvalidRequestException;
use Omnipay\Common\Item as ItemCommon;

class Item extends ItemCommon
{
    /**
     * Return total sum for item product
     * @return float|mixed
     */
    public function getSum()
    {
        $sum = $this->getParameter('sum');

        if (!isset($sum)) {
            $sum = round($this->getPrice() * $this->getQuantity(), 2);
        }

        return $sum;
    }

    /**
     * Set the item total price
     *
     * @param float $value
     * @return Item
     */
    public function setSum(float $value)
    {
        return $this->setParameter('sum', $value);
    }

    /**
     * Return total sum for item product
     * @return float|mixed
     */
    public function getMeasurementUnit()
    {
        $sum = $this->getParameter('measurementUnit');

        if (!isset($sum)) {
            $sum = round($this->getPrice() * $this->getQuantity(), 2);
        }

        return $sum;
    }

    /**
     * Set the item measurement unit
     *
     * @param string $value
     * @return Item
     */
    public function setMeasurementUnit(string $value)
    {
        return $this->setParameter('measurementUnit', $value);
    }

    /**
     * Return type of tax for item product
     * @return float|mixed
     */
    public function getVatType()
    {
        $sum = $this->getParameter('vatType');

        return $sum;
    }

    /**
     * Set the item type of tax
     *
     * @param string $value
     * @return Item
     * @throws InvalidRequestException
     */
    public function setVatType(string $value)
    {
        $this->validateValue($value, Constant::getVats(), 'vat_type');

        return $this->setParameter('vatType', $value);
    }

    /**
     * Return sum tax for item product
     * @return float|mixed
     */
    public function getVatSum()
    {
        $sum = $this->getParameter('vatSum');

        return $sum;
    }

    /**
     * Set the item tax sum
     *
     * @param float $value
     * @return Item
     */
    public function setVatSum(float $value)
    {
        return $this->setParameter('vatSum', $value);
    }

    /**
     * Set the item type of tax
     *
     * @param string $value
     * @return Item
     * @throws InvalidRequestException
     */
    public function setPaymentMethod(string $value)
    {
        $this->validateValue($value, Constant::getPaymentObjects(), 'payment_object');

        return $this->setParameter('paymentMethod', $value);
    }

    /**
     * Return sum tax for item product
     * @return float|mixed
     */
    public function getPaymentMethod()
    {
        $sum = $this->getParameter('paymentMethod');

        return $sum;
    }

    /**
     * Set the item type of tax
     *
     * @param string $value
     * @return Item
     * @throws InvalidRequestException
     */
    public function setPaymentObject(string $value)
    {
        $this->validateValue($value, Constant::getPaymentObjects(), 'payment_object');

        return $this->setParameter('paymentObject', $value);
    }

    /**
     * Return sum tax for item product
     * @return float|mixed
     */
    public function getPaymentObject()
    {
        $sum = $this->getParameter('paymentObject');

        return $sum;
    }

    /**
     * Validate the item product.
     * This method is called internally by Request.
     *
     * @param array $data
     * @param array $keys
     * @throws InvalidRequestException
     */
    /**
     * Validate the request.
     *
     * This method is called internally by gateways to avoid wasting time with an API call
     * when the request is clearly invalid.
     *
     * @param string ... a variable length list of required parameters
     * @throws InvalidRequestException
     */
    public function validate()
    {
        foreach (func_get_args() as $key) {
            $value = $this->parameters->get($key);
            if (!isset($value)) {
                throw new InvalidRequestException("The $key parameter is required");
            }
        }
    }

    private function validateValue($value, array $data, string $key)
    {
        if (!isset($data[$value])) {
            throw new InvalidRequestException("The $key parameter is required");
        }
    }
}