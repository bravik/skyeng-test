<?php
/**
 * @author Roman Naumenko <naumenko_subscr@mail.ru>
 */

declare(strict_types=1);

namespace Api\Serializer;

class JsonSerializer extends AbstractSerializer
{
    public function serialize(array $data): string
    {
        return json_encode($data);
    }
}
