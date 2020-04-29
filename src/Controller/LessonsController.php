<?php
declare(strict_types=1);

namespace Api\Controller;

use Api\ApiInterface;
use Api\Exception\ApiException;
use Api\Serializer\AbstractSerializer;
use Psr\Http\Message\ResponseInterface;
use Psr\Log\LoggerInterface;

class LessonsController
{
    /** @var ApiInterface */
    private $api;

    /** @var AbstractSerializer */
    private $serializer;

    /** @var LoggerInterface */
    private $logger;

    public function __construct(
        ApiInterface $api,
        AbstractSerializer $serializer,
        LoggerInterface $logger
    ) {
        $this->api = $api;
        $this->serializer = $serializer;
        $this->logger = $logger;
    }

    public function getLessons(string $category = null): ResponseInterface
    {
        try {
            $lessons = $this->api->getLessons($category);

            return new Response($this->serializer->serializeAll($lessons));
        } catch (ApiException $e) {
            $this->logger->error($e->getMessage());

            return new ErrorResponse($e->getCode(), $e->getMessage());
        }
    }
}
