<?php

declare(strict_types=1);

namespace Strawberry\Shopify\Models\Orders;

use Strawberry\Shopify\Models\Model;

/**
 * @property  string  $to
 * @property  string  $from
 * @property  array  $bcc
 * @property  string  $subject
 * @property  string|null  $custom_message
 *
 * @see https://help.shopify.com/en/api/reference/orders/draftorder#send_invoice-2019-07
 */
final class DraftOrderInvoice extends Model
{
}
