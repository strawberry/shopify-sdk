<?php

declare(strict_types=1);

namespace Strawberry\Shopify\Models\Sales;

use Strawberry\Shopify\Models\Model;
use Strawberry\Shopify\Models\Orders\Transaction;

/**
 * @property  object  $credit_card
 * @property  int  $id
 * @property  string  $payment_processing_error_message
 * @property  Transaction  $transaction
 * @property  string  $unique_token
 *
 * @see https://help.shopify.com/en/api/reference/sales-channels/payment#properties-2019-07
 */
final class Payment extends Model
{
}
