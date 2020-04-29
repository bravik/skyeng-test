<?php
/**
 * @author Roman Naumenko <naumenko_subscr@mail.ru>
 */

declare(strict_types=1);

namespace Api\Entity;

interface ArrayableInterface
{
    public function toArray(): array;
}
