<?php

namespace App\Http\Responses;

use Illuminate\Http\Response as HttpStatusCode;

/**
 * A response that will show the consumer the errors.
 */
class Std400Response extends StdResponse
{
    /**
     * The status code for a standard 400 response.
     * @var int
     */
    protected $statusCode = HttpStatusCode::HTTP_BAD_REQUEST;

    /**
     * The list of errors on the response
     * @var array
     */
    public $errors;

    /**
     * Add a single error to the response
     * @param string $warning
     */
    public function addError($warning)
    {
        $this->errors[] = $warning;
    }

    /**
     * Add a list of errors to the response
     * @param array $warnings
     */
    public function setErrors($warnings)
    {
        $this->errors = $warnings;
    }
}
