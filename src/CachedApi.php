<?php
/**
 * @author Roman Naumenko <naumenko_subscr@mail.ru>
 */

declare(strict_types=1);

namespace Api;

use DateTime;
use Psr\Cache\CacheItemPoolInterface;

class CachedApi extends ApiDecorator
{
    public const CACHE_PREFIX = 'api-';

    /** @var CacheItemPoolInterface **/
    private $cache;

    public function __construct(ApiInterface $api, CacheItemPoolInterface $cache)
    {
        parent::__construct($api);
        $this->cache = $cache;
    }

    public function getLessons(string $category = null): array
    {
        $cacheKey = self::CACHE_PREFIX . "get-lessons-$category";
        $cacheItem = $this->cache->getItem($cacheKey);

        if ($cacheItem->isHit()) {
            return $cacheItem->get();
        }


        $lessons = $this->api->getLessons($category);

        $cacheItem
            ->set($lessons)
            ->expiresAt(
                (new DateTime())->modify('+1 day')
            );

        return $lessons;
    }
}
