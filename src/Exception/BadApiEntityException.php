<?php
/**
 * @author Roman Naumenko <naumenko_subscr@mail.ru>
 */

declare(strict_types=1);

namespace Api\Exception;

use Throwable;

class BadApiEntityException extends ApiException
{
    public function __construct($message = 'Unable to parse object from API', $code = 500, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
