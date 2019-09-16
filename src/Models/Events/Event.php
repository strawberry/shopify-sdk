<?php

declare(strict_types=1);

namespace Strawberry\Shopify\Models\Events;

use Carbon\Carbon;
use Strawberry\Shopify\Models\Model;

/**
 * @property  string  $arguments
 * @property  string|null  $body
 * @property  Carbon  $created_at
 * @property  int  $id
 * @property  string  $description
 * @property  string  $path
 * @property  string  $message
 * @property  int  $subject_id
 * @property  string  $subject_type
 * @property  string  $verb
 *
 * @see https://help.shopify.com/en/api/reference/events/event#properties-2019-07
 */
final class Event extends Model
{
}
