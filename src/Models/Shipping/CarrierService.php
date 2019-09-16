<?php

declare(strict_types=1);

namespace Strawberry\Shopify\Models\Shipping;

use Strawberry\Shopify\Models\Model;

/**
 * @property  bool  $active
 * @property  string  $callback_url
 * @property  string  $carrier_service_type
 * @property  int  $id
 * @property  string  $format
 * @property  string  $name
 * @property  bool  $service_discovery
 * @property  string  $admin_graphql_api_id
 *
 * @see https://help.shopify.com/en/api/reference/shipping-and-fulfillment/carrier-service#properties-2019-07
 */
final class CarrierService extends Model
{
}
