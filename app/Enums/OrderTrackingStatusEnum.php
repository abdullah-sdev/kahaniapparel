<?php

namespace App\Enums;

enum OrderTrackingStatusEnum: string
{
    //

    case DRAFT = 'draft';
    case CONFIRMED = 'confirmed';
    case CANCELED = 'cancelled';
    case PACKAGED = 'packaged';
    case SHIPPED = 'shipped';
    case DELIVERED = 'delivered';
    case RETURNED = 'returned';

    // case DRAFT = 'draft';
    // case ABANDONED = 'abandoned';
    // case FAILED = 'Failed';
    // case DECLINED = 'Declined';
    // case RECEIVED = 'Received';
    // case CHARGEBACK = 'Chargeback';
    // case REFUNDED = 'Refunded';
    // case PARTIAL_REFUNDED = 'Partial Refunded';
    // case DISPUTE = 'Dispute';
}
