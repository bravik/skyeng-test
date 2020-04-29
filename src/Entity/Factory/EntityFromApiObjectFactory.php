<?php
/**
 * @author Roman Naumenko <naumenko_subscr@mail.ru>
 */

declare(strict_types=1);

namespace Api\Entity\Factory;

use Api\Entity\Lesson;
use Api\Exception\BadApiEntityException;
use Throwable;

class EntityFromApiObjectFactory
{
    /**
     * @param $object
     * @return Lesson
     * @throws BadApiEntityException
     */
    public static function createLesson($object): Lesson
    {
        try {
            return new Lesson($object->title);
        } catch (Throwable $e) {
            throw new BadApiEntityException();
        }
    }

    /**
     * @param array $objects
     * @return Lesson[]
     * @throws BadApiEntityException
     */
    public static function createLessonsFromArray(array $objects): array
    {
        $lessons = [];

        foreach ($objects as $object) {
            $lessons[] = static::createLesson($object);
        }

        return  $lessons;
    }
}
