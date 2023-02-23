<?php
namespace Lube\Exceptions;

use Throwable;

/**
 * RuntimeException
 */
class RuntimeException extends LubyeException
{
    /**
     * @param string $message
     * @param Throwable|null $previous
     */
    public function __construct($message = "", Throwable $previous = null)
    {
        parent::__construct(ErrorCode::RUNTIME_EXCEPTION, $message, $previous);
    }
}
