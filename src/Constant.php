<?php

namespace Omnipay\Atol;

class Constant
{
    const OPERATION_SELL = 'sell'; // чек «Приход»;
    const OPERATION_SELL_REFUND = 'sell_refund'; // чек «Возврат прихода»;
    const OPERATION_SELL_CORRECTION = 'sell_correction'; // чек «Коррекция прихода»;
    const OPERATION_BUY = 'buy'; // чек «Расход»;
    const OPERATION_BUY_REFUND = 'buy_refund'; // чек «Возврат расхода»;
    const OPERATION_BUY_CORRECTION = 'buy_correction'; // чек «Коррекция расхода»

    const SNO_OSN = 'osn'; //– общая СН;
    const SNO_USN_INCOME = 'usn_income'; //– упрощенная СН (доходы);
    const SNO_USN_INCOME_OUTCOME = 'usn_income_outcome'; //– упрощенная СН (доходы минус расходы);
    const SNO_ENVD = 'envd'; //– единый налог на вмененный доход;
    const SNO_ESN = 'esn'; //– единый сельскохозяйственный налог;
    const SNO_PATENT = 'patent'; //– патентная СН

    const AGENT_TYPE_BANK_PAYING_AGENT = 'bank_paying_agent'; // – банковский платежный агент. Оказание услуг покупателю (клиенту) пользователем, являющимся банковским платежным агентом.
    const AGENT_TYPE_BANK_PAYING_SUBAGENT = 'bank_paying_subagent'; // – банковский платежный субагент. Оказание услуг покупателю (клиенту) пользователем, являющимся банковским платежным субагентом.
    const AGENT_TYPE_PAYING_AGENT = 'paying_agent'; // – платежный агент. Оказание услуг покупателю (клиенту) пользователем, являющимся платежным агентом.
    const AGENT_TYPE_PAYING_SUBAGENT = 'paying_subagent'; // – платежный субагент. Оказание услуг покупателю (клиенту) пользователем, являющимся платежным субагентом.
    const AGENT_TYPE_ATTORNEY = 'attorney'; // – поверенный. Осуществление расчета с покупателем (клиентом) пользователем, являющимся поверенным.
    const AGENT_TYPE_COMMISSION_AGENT = 'commission_agent'; // – комиссионер. Осуществление расчета с покупателем (клиентом) пользователем, являющимся комиссионером.
    const AGENT_TYPE_ANOTHER = 'another'; // – другой тип агента. Осуществление расчета с покупателем (клиентом) пользователем, являющимся агентом и не являющимся банковским платежным агентом (субагентом), платежным агентом (субагентом), поверенным, комиссионером.

    const PAYMENT_METHOD_FULL_PREPAYMENT = 'full_prepayment'; //– предоплата 100%. Полная предварительная оплата до момента передачи предмета расчета.
    const PAYMENT_METHOD_PREPAYMENT = 'prepayment'; //– предоплата. Частичная предварительная оплата до момента передачи предмета расчета.
    const PAYMENT_METHOD_ADVANCE = 'advance'; //– аванс.
    const PAYMENT_METHOD_FULL_PAYMENT = 'full_payment'; //– полный расчет. Полная оплата, в том числе с учетом аванса (предварительной оплаты) в момент передачи предмета расчета.
    const PAYMENT_METHOD_PARTIAL_PAYMENT = 'partial_payment'; //– частичный расчет и кредит. Частичная оплата предмета расчета в момент его передачи с последующей оплатой в кредит.
    const PAYMENT_METHOD_CREDIT = 'credit'; //– передача в кредит. Передача предмета расчета без его оплаты в момент его передачи с последующей оплатой в кредит.
    const PAYMENT_METHOD_CREDIT_PAYMENT = 'credit_payment'; //– оплата кредита. Оплата предмета расчета после его передачи с оплатой в кредит (оплата кредита).

    const PAYMENT_OBJECT_COMMODITY = 'commodity'; //– товар. О реализуемом товаре, за исключением подакцизного товара (наименование и иные сведения, описывающие товар).
    const PAYMENT_OBJECT_EXCISE = 'excise'; //– подакцизный товар. О реализуемом подакцизном товаре (наименование и иные сведения, описывающие товар).
    const PAYMENT_OBJECT_JOB = 'job'; //– работа. О выполняемой работе (наименование и иные сведения, описывающие работу).
    const PAYMENT_OBJECT_SERVICE = 'service'; //– услуга. Об оказываемой услуге (наименование и иные сведения, описывающие услугу).
    const PAYMENT_OBJECT_GAMBLING_BET = 'gambling_bet'; //– ставка азартной игры. О приеме ставок при осуществлении деятельности по проведению азартных игр.
    const PAYMENT_OBJECT_GAMBLING_PRIZE = 'gambling_prize'; //– выигрыш азартной игры. О выплате денежных средств в виде выигрыша при осуществлении деятельности по проведению азартных игр.
    const PAYMENT_OBJECT_LOTTERY = 'lottery'; //– лотерейный билет. О приеме денежных средств при реализации лотерейных билетов, электронных лотерейных билетов, приеме лотерейных ставок при осуществлении деятельности по проведению лотерей.
    const PAYMENT_OBJECT_LOTTERY_PRIZE = 'lottery_prize'; //– выигрыш лотереи. О выплате денежных средств в виде выигрыша при осуществлении деятельности по проведению лотерей.
    const PAYMENT_OBJECT_INTELLECTUAL_ACTIVITY = 'intellectual_activity'; //– предоставление результатов интеллектуальной деятельности. О предоставлении прав на использование результатов интеллектуальной деятельности или средств индивидуализации.
    const PAYMENT_OBJECT_PAYMENT = 'payment'; //– платеж. Об авансе, задатке, предоплате, кредите, взносе в счет оплаты, пени, штрафе, вознаграждении, бонусе и ином аналогичном предмете расчета.
    const PAYMENT_OBJECT_AGENT_COMMISSION = 'agent_commission'; //– агентское вознаграждение. О вознаграждении пользователя, являющегося платежным агентом (субагентом), банковским платежным агентом (субагентом), комиссионером, поверенным или иным агентом.
    const PAYMENT_OBJECT_COMPOSITE = 'composite'; //– составной предмет расчета. О предмете расчета, состоящем из предметов, каждому из которых может быть присвоено значение выше перечисленных признаков.
    const PAYMENT_OBJECT_ANOTHER = 'another'; //– иной предмет расчета. О предмете расчета, не относящемуся к выше перечисленным предметам расчета.
    const PAYMENT_OBJECT_PROPERTY_RIGHT = 'property_right'; //– имущественное право. О передаче имущественных прав.
    const PAYMENT_OBJECT_NON_OPERATING_GAIN = 'non-operating_gain'; //– внереализационный доход. О внереализационном доходе.
    const PAYMENT_OBJECT_INSURANCE_PREMIUM = 'insurance_premium'; //– страховые взносы. О суммах расходов, уменьшающих сумму налога (авансовых платежей) в соответствии с пунктом 3.1 статьи 346.21 Налогового кодекса Российской Федерации.
    const PAYMENT_OBJECT_SALES_TAX = 'sales_tax'; //– торговый сбор. О суммах уплаченного торгового сбора.
    const PAYMENT_OBJECT_RESORT_FEE = 'resort_fee'; //– курортный сбор. О курортном сборе.

    const VAT_TYPE_NONE = 'none'; // – без НДС;
    const VAT_TYPE_VAT0 = 'vat0'; // – НДС по ставке 0%;
    const VAT_TYPE_VAT10 = 'vat10'; // – НДС чека по ставке 10%;
    const VAT_TYPE_VAT18 = 'vat18'; // – НДС чека по ставке 18%;
    const VAT_TYPE_VAT110 = 'vat110'; // – НДС чека по расчетной ставке 10/110;
    const VAT_TYPE_VAT118 = 'vat118'; // – НДС чека по расчетной ставке 18/118;
    const VAT_TYPE_VAT20 = 'vat20'; // – НДС чека по ставке 20%;
    const VAT_TYPE_VAT120 = 'vat120'; // – НДС чека по расчетной ставке 20/120.

    const PAYMENT_TYPE_CASHLESS = 1; //безналичный;
    const PAYMENT_TYPE_ADVANCE = 2; //предварительная оплата (аванс);
    const PAYMENT_TYPE_CREDIT = 3; //постоплата (кредит);
    const PAYMENT_TYPE_ANOTHER = 4; //иная форма оплаты (встречное предоставление);
    const PAYMENT_TYPE_EXTEND_5 = 5; //«5»-«9» – расширенные виды оплаты. Для каждого фискального типа оплаты можно указать расширенный вид оплаты.
    const PAYMENT_TYPE_EXTEND_6 = 6;
    const PAYMENT_TYPE_EXTEND_7 = 7;
    const PAYMENT_TYPE_EXTEND_8 = 8;
    const PAYMENT_TYPE_EXTEND_9 = 9;

    public static function getOperations()
    {
        return [
            static::OPERATION_SELL => 'чек «Приход»',
            static::OPERATION_SELL_REFUND => 'чек «Возврат прихода»',
            static::OPERATION_SELL_CORRECTION => 'чек «Коррекция прихода»',
            static::OPERATION_BUY => 'чек «Расход»',
            static::OPERATION_BUY_REFUND => 'чек «Возврат расхода»',
            static::OPERATION_BUY_CORRECTION => 'чек «Коррекция расхода»',
        ];
    }

    public static function getSnos()
    {
        return [
            static::SNO_OSN => 'общая СН',
            static::SNO_USN_INCOME => 'упрощенная СН (доходы)',
            static::SNO_USN_INCOME_OUTCOME => 'упрощенная СН (доходы минус расходы)',
            static::SNO_ENVD => 'единый налог на вмененный доход',
            static::SNO_ESN => 'единый сельскохозяйственный налог',
            static::SNO_PATENT => 'патентная СН',
        ];
    }

    public static function getAgentTypes()
    {
        return [
            static::AGENT_TYPE_BANK_PAYING_AGENT => 'банковский платежный агент',
            static::AGENT_TYPE_BANK_PAYING_SUBAGENT => 'банковский платежный субагент',
            static::AGENT_TYPE_PAYING_AGENT => 'платежный агент',
            static::AGENT_TYPE_PAYING_SUBAGENT => 'платежный субагент.',
            static::AGENT_TYPE_ATTORNEY => 'поверенный',
            static::AGENT_TYPE_COMMISSION_AGENT => 'комиссионер',
            static::AGENT_TYPE_ANOTHER => 'другой тип агента',
        ];
    }

    public static function getPaymentMethods()
    {
        return [
            static::PAYMENT_METHOD_FULL_PREPAYMENT => 'предоплата 100%',
            static::PAYMENT_METHOD_PREPAYMENT => 'предоплата',
            static::PAYMENT_METHOD_ADVANCE => 'аванс',
            static::PAYMENT_METHOD_FULL_PAYMENT => 'полный расчет',
            static::PAYMENT_METHOD_PARTIAL_PAYMENT => 'частичный расчет и кредит',
            static::PAYMENT_METHOD_CREDIT => 'передача в кредит',
            static::PAYMENT_METHOD_CREDIT_PAYMENT => 'оплата кредита',
        ];
    }

    public static function getPaymentObjects()
    {
        return [
            static::PAYMENT_OBJECT_COMMODITY => 'товар',
            static::PAYMENT_OBJECT_EXCISE => 'подакцизный товар',
            static::PAYMENT_OBJECT_JOB => 'работа',
            static::PAYMENT_OBJECT_SERVICE => 'услуга',
            static::PAYMENT_OBJECT_GAMBLING_BET => 'ставка азартной игры',
            static::PAYMENT_OBJECT_GAMBLING_PRIZE => 'выигрыш азартной игры',
            static::PAYMENT_OBJECT_LOTTERY => 'лотерейный билет',
            static::PAYMENT_OBJECT_LOTTERY_PRIZE => 'выигрыш лотереи',
            static::PAYMENT_OBJECT_INTELLECTUAL_ACTIVITY => 'предоставление результатов интеллектуальной деятельности',
            static::PAYMENT_OBJECT_PAYMENT => 'платеж',
            static::PAYMENT_OBJECT_AGENT_COMMISSION => 'агентское вознаграждение',
            static::PAYMENT_OBJECT_COMPOSITE => 'составной предмет расчета',
            static::PAYMENT_OBJECT_ANOTHER => 'иной предмет расчета',
            static::PAYMENT_OBJECT_PROPERTY_RIGHT => 'имущественное право',
            static::PAYMENT_OBJECT_NON_OPERATING_GAIN => 'внереализационный доход',
            static::PAYMENT_OBJECT_INSURANCE_PREMIUM => 'страховые взносы',
            static::PAYMENT_OBJECT_SALES_TAX => 'торговый сбор',
            static::PAYMENT_OBJECT_RESORT_FEE => 'курортный сбор',
        ];
    }

    public static function getVats()
    {
        return [
            static::VAT_TYPE_NONE => 'без НДС',
            static::VAT_TYPE_VAT0 => 'НДС по ставке 0%',
            static::VAT_TYPE_VAT10 => 'НДС чека по ставке 10%',
            static::VAT_TYPE_VAT18 => 'НДС чека по ставке 18%',
            static::VAT_TYPE_VAT110 => 'НДС чека по расчетной ставке 10/110',
            static::VAT_TYPE_VAT118 => 'НДС чека по расчетной ставке 18/118',
            static::VAT_TYPE_VAT20 => 'НДС чека по ставке 20%',
            static::VAT_TYPE_VAT120 => 'НДС чека по расчетной ставке 20/120',
        ];
    }

    public static function getPaymentTypes()
    {
        return [
            static::PAYMENT_TYPE_CASHLESS => 'безналичный',
            static::PAYMENT_TYPE_ADVANCE => 'предварительная оплата (аванс)',
            static::PAYMENT_TYPE_CREDIT => 'постоплата (кредит)',
            static::PAYMENT_TYPE_ANOTHER => 'иная форма оплаты (встречное предоставление)',
            static::PAYMENT_TYPE_EXTEND_5 => '«5» расширенные виды оплаты',
            static::PAYMENT_TYPE_EXTEND_6 => '«6» расширенные виды оплаты',
            static::PAYMENT_TYPE_EXTEND_7 => '«7» расширенные виды оплаты',
            static::PAYMENT_TYPE_EXTEND_8 => '«8» расширенные виды оплаты',
            static::PAYMENT_TYPE_EXTEND_9 => '«9» расширенные виды оплаты',
        ];
    }
}