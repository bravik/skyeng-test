<?php
/**
 * @author Roman Naumenko <naumenko_subscr@mail.ru>
 */

declare(strict_types=1);

namespace Api\Entity;

// In more complex Api we could define seriallization logic in separate class, but it's fine for a simple case
class Lesson implements ArrayableInterface
{
    private $title;

    public function __construct(string $title)
    {
        $this->title = $title;
    }

    public function toArray(): array
    {
        return [
            'title' => $this->title,
        ];
    }
}
