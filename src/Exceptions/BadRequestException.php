<?php
namespace Lubed\Exceptions;

use Throwable;

/**
 * BadRequestException
 */
class BadRequestException extends LubyeException
{
    /**
     * @param string $message
     * @param Throwable|null $previous
     */
    public function __construct($message = "", Throwable $previous = null)
    {
        parent::__construct(ErrorCode::BAD_REQUEST_EXCEPTION, $message, $previous);
    }
}
