<?php

namespace Bayurifkialghifari\WuzApi\Exceptions;

use Exception;

class WuzApiException extends Exception
{
    public function __construct(
        string $message,
        int $code = 0,
        public readonly mixed $details = null,
    ) {
        parent::__construct($message, $code);
    }
}
