<?php

declare(strict_types=1);

namespace Strawberry\Shopify\Models\ShopifyPayments;

use Carbon\Carbon;
use Strawberry\Shopify\Models\Model;

/**
 * @property  int  $id
 * @property  int  $order_id
 * @property  string  $type
 * @property  string  $currency
 * @property  float  $amount
 * @property  string  $reason
 * @property  int  $network_reason_code
 * @property  string  $status
 * @property  Carbon  $evidence_due_by
 * @property  Carbon  $evidence_sent_on
 * @property  Carbon  $finalized_on
 *
 * @see https://help.shopify.com/en/api/reference/shopify_payments/dispute#properties-2019-07
 */
final class Dispute extends Model
{
}
