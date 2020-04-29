<?php
/**
 * @author Roman Naumenko <naumenko_subscr@mail.ru>
 */

declare(strict_types=1);

namespace Api\Serializer;

use Api\Entity\ArrayableInterface;
use Api\Exception\ApiException;

abstract class AbstractSerializer
{
    abstract protected function serialize(array $data): string;

    public function serializeOne(ArrayableInterface $data): string
    {
        return $this->serialize($data->toArray());
    }

    /**
     * @param array $data
     * @return string
     * @throws ApiException
     */
    public function serializeAll(array $data): string
    {
        $preparedData = [];
        foreach ($data as $object) {
            if (!$object instanceof ArrayableInterface) {
                throw new ApiException("Serialization error. Provided object doesn't implement ArrayableInterface");
            }

            $preparedData[] = $object->toArray();
        }

        return $this->serialize($preparedData);
    }
}
