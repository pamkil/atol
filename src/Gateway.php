<?php

namespace Omnipay\Atol;

use Omnipay\Atol\Message\ActionRequest;
use Omnipay\Atol\Message\ReportRequest;
use Omnipay\Atol\Message\ReportResponse;
use Omnipay\Atol\Message\RestTokenRequest;
use Omnipay\Common\AbstractGateway;

/**
 * Manual Gateway
 *
 * This gateway is useful for processing check or direct debit payments. It simply
 * authorizes every payment.
 *
 * ### Example
 *
 * #### Initialize Gateway
 *
 * ```php
 * // Create a gateway for the Manual Gateway
 * // (routes to GatewayFactory::create)
 * $gateway = Omnipay::create('Atoll');
 *
 * // Initialise the gateway
 * $gateway->initialize(array(
 *      'login' => 'atolonlinetest1',
 *      'pass' => 'jI0sW5dOW',
 *      'group_code' => 'AtolOnline1-Test',
 *      'inn' => '7729656202',
 *      'paymentAddress' => 'test1.atol.ru'
 *      'sno' => 'osn'
 * ));
 * ```
 *
 * #### Authorize
 *
 * <code>
 * // Для получения чека «Приход»
 * //
 *      $buyCorrection = $gateway->buyCorrection([
 * or
 *      $sellBuy = $gateway->buyRefund([
 * or
 *      $transaction = $gateway->sellBuy([
 * or
 *      $sellCorrection = $gateway->sellCorrection([
 * or
 *      $sellRefund = $gateway->sellRefund([
 * or
 *      $transaction = $gateway->sell([
 *          'externalId' => '12354536',
 *          'callBackUrl' => '',
 *          'inn' => '',
 *          'paymentAddress' => '',
 *          'datePayment' => '',
 *
 *          'email'   => 'df@er.ru',
 *          'phone'   => '',
 *          'sno'   => '',
 *          'totalSum'   => '',
 *          'typeSum'   => '',
 *      ]);
 *
 * or
 *
 *
 *      $buyCorrection = $gateway->buyCorrection();
 *      $buyRefund = $gateway->buyRefund();
 *      $sellBuy = $gateway->sellBuy();
 *      $sellCorrection = $gateway->sellCorrection();
 *      $sellRefund = $gateway->sellRefund();
 *      $sell = $gateway->sell();
 *
 *      $item = new Item();
 *      $item
 *          ->setSum(15)
 *          ->setTax('none')
 *          ->setPrice(15)
 *          ->setQuantity(1)
 *          ->setTaxSum(0)
 *          ->setName('Bouquet');
 *      $sell->setItems([$item]);
 *
 *      $sell->setCallBackUrl('site.ru/atoll')
 *          ->setExternalId(1234213515611)
 *          //->setInn('7729656202')
 *          //->setPaymentAddress('test1.atol.ru')
 *          ->setDatePayment('14.06.2017 15:01:01')
 *          ->setEmail('sd@df.ru')
 *          //->setPhone('9123456789') or email or phone
 *          ->setSno('osn')
 *          ->setTotalSum(15)
 *          ->setTypeSum(1);
 *      $responseSell = $sell->send();
 *      $responseSell->getMessage();
 *      $uuid = $responseSell->getUuid();
 *
 *      $responseReport = $this->gateway->operationComplete($uuid);
 *      $data = $responseReport->getData();
 *
 * </code>
 *
 * In reality, Manual Gateway authorize() requests will always be successful and
 * will never throw an exception, but the above example shows that you can treat
 * manual payments just like any other payment type for any other gateway.
 */
class Gateway extends AbstractGateway
{
    /**
     * Get gateway display name
     *
     * This can be used by carts to get the display name for each gateway.
     */
    public function getName()
    {
        return 'Atoll';
    }

    /**
     * Get OAuth 2.0 access token.
     *
     * @param bool $createIfNeeded [optional] - If there is not an active token present, should we create one?
     * @return string
     */
    public function getToken($createIfNeeded = true)
    {
        if ($createIfNeeded && !$this->hasToken()) {
            $response = $this->createToken()->send();
            if ($response->isSuccessful()) {
                $data = $response->getData();
                if (isset($data['token'])) {
                    $this->setToken($data['token']);
                    $this->setTokenExpires(time() + (24 * 60 * 60));
                }
            }
        }

        return $this->getParameter('token');
    }

    /**
     * Create OAuth 2.0 access token request.
     *
     * @return RestTokenRequest
     */
    public function createToken()
    {
        return $this->createRequest(RestTokenRequest::class);
    }

    /**
     * Set OAuth 2.0 access token.
     *
     * @param string $value
     * @return $this provides a fluent interface
     */
    public function setToken($value)
    {
        return $this->setParameter('token', $value);
    }

    /**
     * Get OAuth 2.0 access token expiry time.
     *
     * @return integer
     */
    public function getTokenExpires()
    {
        return $this->getParameter('tokenExpires');
    }

    /**
     * Set OAuth 2.0 access token expiry time.
     *
     * @param integer $value
     * @return $this provides a fluent interface
     */
    public function setTokenExpires($value)
    {
        return $this->setParameter('tokenExpires', $value);
    }

    /**
     * Is there a bearer token and is it still valid?
     *
     * @return bool
     */
    public function hasToken()
    {
        $token = $this->getTestMode() ? null : $this->getParameter('token');

        $expires = $this->getTokenExpires();
        if (!empty($expires) && !is_numeric($expires)) {
            $expires = strtotime($expires);
        }

        return !empty($token) && time() < $expires;
    }

    /**
     * Create Request
     *
     * This overrides the parent createRequest function ensuring that the OAuth
     * 2.0 access token is passed along with the request data -- unless the
     * request is a RestTokenRequest in which case no token is needed.  If no
     * token is available then a new one is created (e.g. if there has been no
     * token request or the current token has expired).
     *
     * @param string $class
     * @param array $parameters
     * @return \Omnipay\Atol\Message\AbstractRestRequest $class
     */
    public function createRequest($class, array $parameters = array())
    {
        if (!$this->hasToken() && $class != RestTokenRequest::class) {
            // This will set the internal token parameter which the parent
            // createRequest will find when it calls getParameters().
            $this->getToken(true);
        }

        return parent::createRequest($class, $parameters);
    }


    /**
     * @param array $options
     * @return ActionRequest
     */
    public function action(array $options = [])
    {
        return $this->createRequest(ActionRequest::class, $options);
    }

    /**
     * чек «Приход»
     * @return ActionRequest
     */
    public function sell()
    {
        return $this->action()->setAction('sell');
    }

    /**
     * чек «Возврат прихода»
     * @return ActionRequest
     */
    public function sellRefund()
    {
        return $this->action()->setAction('sell_refund');
    }

    /**
     * чек «Коррекция прихода»
     * @return ActionRequest
     */
    public function sellCorrection()
    {
        return $this->action()->setAction('sell_correction');
    }

    /**
     * чек «Расход»
     * @return ActionRequest
     */
    public function sellBuy()
    {
        return $this->action()->setAction('buy');
    }

    /**
     * чек «Расход»
     * @return ActionRequest
     */
    public function buyRefund()
    {
        return $this->action()->setAction('buy_refund');
    }

    /**
     * чек «Коррекция расхода»
     * @return ActionRequest
     */
    public function buyCorrection()
    {
        return $this->action()->setAction('buy_correction');
    }

    /**
     * чек «Коррекция расхода»
     * @param array $options
     * @return ReportRequest
     */
    public function report(array $options = [])
    {
        return $this->createRequest(ReportRequest::class, $options);
    }

    /**
     * чек «Коррекция расхода»
     * @param array $options
     * @return ReportResponse
     */
    public function operationComplete($uuid, array $options = [])
    {
        return $this->report($options)->setTransactionId($uuid)->send();
    }

    public function getGroupCode()
    {
        return $this->getParameter('groupCode');
    }

    public function setGroupCode($value)
    {
        return $this->setParameter('groupCode', $value);
    }

    public function getLogin()
    {
        return $this->getParameter('login');
    }

    public function setLogin($value)
    {
        return $this->setParameter('login', $value);
    }

    public function getPass()
    {
        return $this->getParameter('pass');
    }

    public function setPass($value)
    {
        return $this->setParameter('pass', $value);
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

    public function getTax()
    {
        return $this->getParameter('tax');
    }

    public function setTax($value)
    {
        return $this->setParameter('tax', $value);
    }

    public function getSno()
    {
        return $this->getParameter('sno');
    }

    public function setSno($value)
    {
        return $this->setParameter('sno', $value);
    }
}