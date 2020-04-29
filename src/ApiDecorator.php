<?php
/**
 * @author Roman Naumenko <naumenko_subscr@mail.ru>
 */

declare(strict_types=1);

namespace Api;

class ApiDecorator implements ApiInterface
{
    /** @var ApiInterface **/
    protected $api;

    public function __construct(ApiInterface $api)
    {
        $this->api = $api;
    }

    public function getLessons(string $category = null): array
    {
        return $this->api->getLessons();
    }
}
