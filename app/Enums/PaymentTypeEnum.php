<?php

namespace App\Enums;

enum PaymentTypeEnum: string
{
    //
    case CASH_ON_DELIVERY = 'cash-on-delivery';
    case CARD = 'card';
    case EBANK_TRANSFER = 'e-bank-transfer';
}
