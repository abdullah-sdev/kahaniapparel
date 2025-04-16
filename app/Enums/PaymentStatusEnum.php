<?php

namespace App\Enums;

enum PaymentStatusEnum: string
{
    //
    case DRAFT = 'draft';
    case PENDING = 'pending';
    case ABANDONED = 'abandoned';
    case FAILED = 'failed';
    case DECLINED = 'declined';
    case RECEIVED = 'received';
    case CHARGE_BACK = 'charge-back';
    case REFUNDED = 'refunded';
    case PARTIAL_REFUND = 'partial-refund';
    case DISPUTE = 'dispute';
}
