<?php

declare(strict_types=1);

namespace Strawberry\Shopify\Rest;

use BadMethodCallException;
use GuzzleHttp\ClientInterface;
use Illuminate\Support\Str;
use Strawberry\Shopify\Http\Client as HttpClient;
use Strawberry\Shopify\Rest\Resources\Access;
use Strawberry\Shopify\Rest\Resources\Analytics;
use Strawberry\Shopify\Rest\Resources\Billing;
use Strawberry\Shopify\Rest\Resources\Customers;
use Strawberry\Shopify\Rest\Resources\Discounts;
use Strawberry\Shopify\Rest\Resources\Events;
use Strawberry\Shopify\Rest\Resources\Inventory;
use Strawberry\Shopify\Rest\Resources\Misc;
use Strawberry\Shopify\Rest\Resources\OnlineStore;
use Strawberry\Shopify\Rest\Resources\Orders;
use Strawberry\Shopify\Rest\Resources\Plus;
use Strawberry\Shopify\Rest\Resources\Products;
use Strawberry\Shopify\Rest\Resources\Sales;
use Strawberry\Shopify\Rest\Resources\Shipping;
use Strawberry\Shopify\Rest\Resources\ShopifyPayments;
use Strawberry\Shopify\Rest\Resources\Store;

/**
 * @method  Orders\AbandonedCheckoutResource   abandonedCheckouts()
 * @method  Billing\ApplicationChargeResource   applicationCharges()
 * @method  Billing\ApplicationCreditResource   applicationCredits()
 * @method  OnlineStore\ArticleResource   articles()
 * @method  ShopifyPayments\BalanceResource   balance()
 * @method  OnlineStore\BlogResource   blogs()
 * @method  OnlineStore\BlogResource   blog(int $id)
 * @method  Shipping\CarrierServiceResource   carrierServices()
 * @method  Sales\CheckoutResource   checkouts()
 * @method  Sales\CheckoutResource   checkout(string $token)
 * @method  Sales\CollectionListingResource   collectionListings()
 * @method  Products\CollectResource   collects()
 * @method  OnlineStore\CommentResource   comments()
 * @method  Store\CountryResource   countries()
 * @method  Store\CountryResource   country(int $id)
 * @method  Store\CurrencyResource   currencies()
 * @method  Products\CustomCollectionResource   customCollections()
 * @method  Customers\CustomerResource   customers()
 * @method  Customers\CustomerResource   customer(int $id)
 * @method  ShopifyPayments\DisputeResource   disputes()
 * @method  Orders\DraftOrderResource   draftOrders()
 * @method  Events\EventResource   events()
 * @method  Shipping\FulfillmentServiceResource   fulfillmentServices()
 * @method  Plus\GiftCardResource   giftCards()
 * @method  Inventory\InventoryItemResource   inventoryItems()
 * @method  Inventory\InventoryLevelResource   inventoryLevels()
 * @method  Inventory\LocationResource   locations()
 * @method  Misc\MarketingEventResource   marketingEvents()
 * @method  Misc\MetafieldResource   metafields()
 * @method  Orders\OrderResource   orders()
 * @method  Orders\OrderResource   order(int $id)
 * @method  OnlineStore\PageResource   pages()
 * @method  ShopifyPayments\PayoutResource   payouts()
 * @method  Store\PolicyResource   policies()
 * @method  Discounts\PriceRuleResource   priceRules()
 * @method  Discounts\PriceRuleResource   priceRule(int $id)
 * @method  Sales\ProductListingResource   productListings()
 * @method  Products\ProductResource   products()
 * @method  Products\ProductResource   product(int $id)
 * @method  Billing\RecurringApplicationChargeResource   recurringApplicationCharges()
 * @method  Billing\RecurringApplicationChargeResource   recurringApplicationCharge(int $id)
 * @method  OnlineStore\RedirectResource   redirects()
 * @method  Analytics\ReportResource   reports()
 * @method  Sales\ResourceFeedbackResource   resourceFeedback()
 * @method  Customers\SavedSearchResource   savedSearches()
 * @method  OnlineStore\ScriptTagResource   scriptTags()
 * @method  Store\ShopResource   shop()
 * @method  Products\SmartCollectionResource   smartCollections()
 * @method  Access\StorefrontAccessTokenResource   storefrontAccessTokens()
 * @method  Misc\TenderTransactionResource   tenderTransactions()
 * @method  OnlineStore\ThemeResource   themes()
 * @method  OnlineStore\ThemeResource   theme(int $id)
 * @method  ShopifyPayments\TransactionResource   transactions()
 * @method  Billing\UsageChargeResource   usageCharges()
 * @method  Plus\UserResource   users()
 * @method  Products\VariantResource   variants()
 * @method  Events\WebhookResource   webhooks()
 */
final class Client
{
    /**
     * The HTTP client for making requests to the API.
     *
     * @var HttpClient
     */
    private $httpClient;

    /**
     * A list of the registered resources for each client.
     *
     * @var string[]
     */
    private $resources = [
        'abandonedCheckouts' => Orders\AbandonedCheckoutResource::class,
        'applicationCharges' => Billing\ApplicationChargeResource::class,
        'applicationCredits' => Billing\ApplicationCreditResource::class,
        'articles' => OnlineStore\ArticleResource::class,
        'balance' => ShopifyPayments\BalanceResource::class,
        'blogs' => OnlineStore\BlogResource::class,
        'carrierServices' => Shipping\CarrierServiceResource::class,
        'checkouts' => Sales\CheckoutResource::class,
        'collectionListings' => Sales\CollectionListingResource::class,
        'collects' => Products\CollectResource::class,
        'comments' => OnlineStore\CommentResource::class,
        'countries' => Store\CountryResource::class,
        'currencies' => Store\CurrencyResource::class,
        'customCollections' => Products\CustomCollectionResource::class,
        'customers' => Customers\CustomerResource::class,
        'disputes' => ShopifyPayments\DisputeResource::class,
        'draftOrders' => Orders\DraftOrderResource::class,
        'events' => Events\EventResource::class,
        'fulfillmentServices' => Shipping\FulfillmentServiceResource::class,
        'giftCards' => Plus\GiftCardResource::class,
        'inventoryItems' => Inventory\InventoryItemResource::class,
        'inventoryLevels' => Inventory\InventoryLevelResource::class,
        'locations' => Inventory\LocationResource::class,
        'marketingEvents' => Misc\MarketingEventResource::class,
        'metafields' => Misc\MetafieldResource::class,
        'orders' => Orders\OrderResource::class,
        'pages' => OnlineStore\PageResource::class,
        'payouts' => ShopifyPayments\PayoutResource::class,
        'policies' => Store\PolicyResource::class,
        'priceRules' => Discounts\PriceRuleResource::class,
        'productListings' => Sales\ProductListingResource::class,
        'products' => Products\ProductResource::class,
        'recurringApplicationCharges' => Billing\RecurringApplicationChargeResource::class,
        'redirects' => OnlineStore\RedirectResource::class,
        'reports' => Analytics\ReportResource::class,
        'resourceFeedback' => Sales\ResourceFeedbackResource::class,
        'savedSearches' => Customers\SavedSearchResource::class,
        'scriptTags' => OnlineStore\ScriptTagResource::class,
        'shop' => Store\ShopResource::class,
        'smartCollections' => Products\SmartCollectionResource::class,
        'storefrontAccessTokens' => Access\StorefrontAccessTokenResource::class,
        'tenderTransactions' => Misc\TenderTransactionResource::class,
        'themes' => OnlineStore\ThemeResource::class,
        'transactions' => ShopifyPayments\TransactionResource::class,
        'usageCharges' => Billing\UsageChargeResource::class,
        'users' => Plus\UserResource::class,
        'variants' => Products\VariantResource::class,
        'webhooks' => Events\WebhookResource::class,
    ];

    public function __construct(ClientInterface $guzzleClient)
    {
        $this->httpClient = new HttpClient($guzzleClient);
    }

    /**
     * Determine whether the given resource exists.
     */
    private function hasResource(string $key): bool
    {
        return array_key_exists($key, $this->resources);
    }

    /**
     * Determine whether the given key should be proxied.
     */
    private function shouldBeProxied(string $key): bool
    {
        $resource = Str::plural($key);

        return $this->hasResource($resource);
    }

    /**
     * Returns a resource instance from the cache. If no instance exists
     * already, then we create a new instance and add that to the cache.
     */
    private function getResourceInstance(string $key): Resource
    {
        $resource = $this->resources[$key];

        return new $resource($this->httpClient);
    }

    /**
     * Returns a proxy instance for the given resource.
     */
    private function getProxyInstance(string $key, array $params): ResourceProxy
    {
        return new ResourceProxy(
            $this->getResourceInstance(Str::plural($key)),
            $params[0]
        );
    }

    /**
     * Magic method for loading the resources.
     *
     * @return mixed
     *
     * @throws BadMethodCallException
     */
    public function __call(string $method, array $params)
    {
        if ($this->hasResource($method)) {
            return $this->getResourceInstance($method);
        }

        if ($this->shouldBeProxied($method)) {
            return $this->getProxyInstance($method, $params);
        }

        throw new BadMethodCallException(
            "Method [{$method}] does not exist on class [" . self::class . "]"
        );
    }
}
