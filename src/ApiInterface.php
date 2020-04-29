<?php
/**
 * @author Roman Naumenko <naumenko_subscr@mail.ru>
 */

declare(strict_types=1);

namespace Api;

use Api\Entity\Lesson;
use Api\Exception\ApiException;

interface ApiInterface
{
    /**
     * @param string|null $category
     * @return Lesson[]
     * @throws ApiException
     */
    public function getLessons(string $category = null): array;
}
