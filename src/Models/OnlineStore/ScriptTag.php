<?php

declare(strict_types=1);

namespace Strawberry\Shopify\Models\OnlineStore;

use Carbon\Carbon;
use Strawberry\Shopify\Models\Model;

/**
 * @property  Carbon  $created_at
 * @property  string  $event
 * @property  int  $id
 * @property  string  $src
 * @property  string  $display_scope
 * @property  Carbon  $updated_at
 *
 * @see https://help.shopify.com/en/api/reference/online-store/scripttag#properties-2019-07
 */
final class ScriptTag extends Model
{
}
