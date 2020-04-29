<?php
/**
 * @author Roman Naumenko <naumenko_subscr@mail.ru>
 */

declare(strict_types=1);

namespace Api\Exception;

use Throwable;

class UnknownApiFormatException extends ApiException
{
    public function __construct($message = 'Unrecognized API format', $code = 400, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
