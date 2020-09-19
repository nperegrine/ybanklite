<?php

namespace App\Http\Responses;

use Illuminate\Http\Response as HttpStatusCode;

/**
 * Class StdEmptyResponse
 *
 * @package App\Api\Response
 */
class StdEmptyResponse implements StdEmptyResponseInterface
{
    /**
     * Initialize with a status code
     *
     * @param int|null $statusCode
     */
    public function __construct(int $statusCode = null)
    {
        if (!is_null($statusCode)) {
            $this->statusCode = $statusCode;
        }
    }

    /**
     * Stores the status code that will be outputted.
     * Override in child classes to change the value.
     * @var int
     */
    protected $statusCode = HttpStatusCode::HTTP_OK;

    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    public function setStatusCode(int $statusCode)
    {
        $this->statusCode = $statusCode;
    }
}
