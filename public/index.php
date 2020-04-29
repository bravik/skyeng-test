<?php
// Main app
use Api\BasicApi;
use Api\CachedApi;
use Api\Controller\LessonsController;
use Api\Exception\UnknownApiFormatException;
use Api\Serializer\SerializerFactory;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Log\LoggerInterface;

// Configure dependencies

// Using decorated API to separate basic api functionality and caching feature
$api = new CachedApi(
    new BasicApi('https://api.example.com/v1', 'user', 'password'),
    new SomePsrCache()
);

// We could use another decorator for API:
// e.g. LoggedApi to configure some separate log for API
// But I prefer to do logging in controller
/** @var LoggerInterface $logger */
$logger = new SomePsrLogger();


// Parse HTTP request to PSR message
/** @var ServerRequestInterface $request */
$request = SomePsrRequest::createFromGlobals();

// Get some global API params from HTTP request such as API format and configure additional dependencies
// This could probably go to some event, or BaseController or something like ApiKernel class
// but I will leave it here for simplicity
try {
    $serializer = SerializerFactory::getForFormat(
        $request->getQueryParams()['format'] ?? SerializerFactory::JSON
    );
} catch (UnknownApiFormatException $e) {
    $logger->error($e->getMessage());

    /** @var ResponseInterface $response */
    $response = new SomePsrResponse();
    $response->withStatus(400, $e->getMessage());

    // @todo Send response and terminate
}


// Configure controller and run action
$basicResponse = (new LessonsController($api, $serializer, $logger))
                    ->getLessons();

// @todo Also we should add some formatting for response:
//         e.g. appropriate headers for JSON or XML response
//         Or create some ResponseFactory(format) and pass it to controller as a dependency.
//         But I will skip it here.

// @todo Send response and terminate
