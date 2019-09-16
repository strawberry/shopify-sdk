<?php

declare(strict_types=1);

namespace Strawberry\Shopify\Models\Events;

use Carbon\Carbon;
use Strawberry\Shopify\Models\Model;

/**
 * @property  string  $address
 * @property  string  $api_version
 * @property  Carbon  $created_at
 * @property  array  $fields
 * @property  string  $format
 * @property  int  $id
 * @property  array  $metafield_namespaces
 * @property  string  $topic
 * @property  Carbon  $updated_at
 *
 * @see https://help.shopify.com/en/api/reference/events/webhook#properties-2019-07
 */
final class Webhook extends Model
{
}
