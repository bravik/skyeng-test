<?php
/**
 * @author Roman Naumenko <naumenko_subscr@mail.ru>
 */

declare(strict_types=1);

namespace Api\Serializer;

use SimpleXMLElement;

class SimpleXMLSerializer extends AbstractSerializer
{
    public function serialize(array $data): string
    {
        $xml = new SimpleXMLElement('<root/>');
        array_walk_recursive($data, [$xml, 'addChild']);

        return $xml->asXML();
    }
}
