<?php

declare(strict_types=1);

namespace Strawberry\Shopify\Models\Sales;

use Carbon\Carbon;
use Strawberry\Shopify\Models\Model;

/**
 * @property  Carbon  $created_at
 * @property  Carbon  $updated_at
 * @property  int  $resource_id
 * @property  string  $resource_type
 * @property  string  $state
 * @property  array  $messages
 * @property  Carbon  $feedback_generated_at
 *
 * @see https://help.shopify.com/en/api/reference/sales-channels/resourcefeedback#properties-2019-07
 */
final class ResourceFeedback extends Model
{
}
