<?php

declare(strict_types=1);

namespace Strawberry\Shopify\Models\Customers;

use Strawberry\Shopify\Models\Model;

/**
 * @property  string  $to
 * @property  string  $from
 * @property  string  $subject
 * @property  string  $custom_message
 * @property  array  $bcc
 *
 * @see https://help.shopify.com/en/api/reference/customers/customer#send_invite-2019-07
 */
final class Invitation extends Model
{
}
