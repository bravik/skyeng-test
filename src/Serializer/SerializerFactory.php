<?php
/**
 * @author Roman Naumenko <naumenko_subscr@mail.ru>
 */

declare(strict_types=1);

namespace Api\Serializer;

use Api\Exception\UnknownApiFormatException;

class SerializerFactory
{
    public const XML = 'xml';
    public const JSON = 'json';

    /**
     * @param string $format
     * @return AbstractSerializer
     * @throws UnknownApiFormatException
     */
    public static function getForFormat(string $format): AbstractSerializer
    {
        switch ($format) {
            case self::JSON:
                return new JsonSerializer();
                break;
            case self::XML:
                return new SimpleXMLSerializer();
                break;
            default:
                throw new UnknownApiFormatException();
        }
    }
}
