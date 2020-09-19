<?php

namespace App\Http\Responses;

use Illuminate\Http\Response as HttpStatusCode;

abstract class StdResponse extends StdEmptyResponse implements StdResponseInterface
{
    /**
     * Stores the status code that will be outputted.
     * Override in child classes to change the value.
     * @var int
     */
    protected $statusCode = HttpStatusCode::HTTP_OK;

    /**
     * Stores the list of warnings to output
     * @var array
     */
    public $warnings;

    public function addWarning($warning)
    {
        $this->warnings[] = $warning;
    }

    public function setWarnings(array $warnings)
    {
        $this->warnings = $warnings;
    }

    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    public function setStatusCode(int $statusCode = null)
    {
        if (!is_null($statusCode)) {
            $this->statusCode = $statusCode;
        }
    }
}
