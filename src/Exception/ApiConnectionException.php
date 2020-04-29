<?php
/**
 * @author Roman Naumenko <naumenko_subscr@mail.ru>
 */

declare(strict_types=1);

namespace Api\Exception;

use Throwable;

class ApiConnectionException extends ApiException
{
    public function __construct($message = '', $code = 500, Throwable $previous = null)
    {
        parent::__construct("Error while trying to connect to API: $message", $code, $previous);
    }
}
