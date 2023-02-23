<?php
namespace Lubed\Exceptions;

use Throwable;

/**
 * InvalidConfigException
 */
class InvalidConfigException extends LubyeException
{
    /**
     * @param string $message
     * @param Throwable|null $previous
     */
    public function __construct($message = "", Throwable $previous = null)
    {
        parent::__construct(ErrorCode::INVALID_CONFIG, $message, $previous);
    }
}
