<?php
namespace Lube\Exceptions;

use Throwable;

/**
 * HttpException
 */
class HttpException extends LubyeException
{
    /**
     * @param string $message
     * @param Throwable|null $previous
     */
    public function __construct($message = "", Throwable $previous = null)
    {
        parent::__construct(ErrorCode::HTTP_EXCEPTION, $message, $previous);
    }
}
