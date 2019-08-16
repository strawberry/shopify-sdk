<?php

namespace Strawberry\Shopify\Models;

use Carbon\Carbon;

/**
 * @property  string  $address1
 * @property  string  $address2
 * @property  bool  $checkout_api_supported
 * @property  string  $city
 * @property  string  $country
 * @property  string  $country_code
 * @property  string  $country_name
 * @property  bool|null  $county_taxes
 * @property  Carbon  $created_at
 * @property  string  $customer_email
 * @property  string  $currency
 * @property  string  $domain
 * @property  string[]  $enabled_presentment_currencies
 * @property  bool  $eligible_for_card_reader_giveaway
 * @property  bool  $eligible_for_payments
 * @property  string  $email
 * @property  bool  $finances  Deprecated. Hardcoded to `true`.
 * @property  bool  $force_ssl
 * @property  string|null  $google_apps_domain
 * @property  bool|null  $google_apps_login_enabled
 * @property  bool  $has_discounts
 * @property  bool  $has_gift_cards
 * @property  bool  $has_storefront
 * @property  string  $iana_timezone
 * @property  int  $id
 * @property  float  $latitude
 * @property  float  $longitude
 * @property  string  $money_format
 * @property  string  $money_in_emails_format
 * @property  string  $money_with_currency_format
 * @property  string  $money_with_currency_in_emails_format
 * @property  bool  $multi_location_enabled
 * @property  string  $myshopify_domain
 * @property  string  $name
 * @property  bool  $password_enabled
 * @property  string|null  $phone
 * @property  string  $plan_display_name
 * @property  bool  $pre_launch_enabled
 * @property  string  $plan_name
 * @property  string  $primary_locale
 * @property  int  $primary_location_id  Deprecated.
 * @property  string  $province
 * @property  string  $province_code
 * @property  bool  $requires_extra_payments_agreement
 * @property  bool  $setup_required
 * @property  string  $shop_owner
 * @property  string|null  $source
 * @property  bool|null  $taxes_included
 * @property  bool  $tax_shipping
 * @property  string  $timezone
 * @property  Carbon  $updated_at
 * @property  string  $weight_unit
 * @property  string  $zip
 *
 * @see https://help.shopify.com/en/api/reference/store-properties/shop#properties-2019-07
 */
class Shop extends Model
{
}
