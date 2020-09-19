<?php

namespace App\Http\Responses;

/**
 * Defines common methods that must exist on every response.
 */
interface StdEmptyResponseInterface
{
    /**
     * Returns the HTTP status code
     * @return int
     */
    public function getStatusCode(): int;

    /**
     * Allows override the status code that will be sent on output
     * @param int $statusCode The status to set
     * @return int
     */
    public function setStatusCode(int $statusCode);

    public function __construct(int $statusCode);
}
