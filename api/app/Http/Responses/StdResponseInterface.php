<?php

namespace App\Http\Responses;

/**
 * Defines common methods that must exist on every response.
 */
interface StdResponseInterface extends StdEmptyResponseInterface
{
    /**
     * Set an array of warnings into the response
     * @param array $warnings
     *
     * @return void
     */
    public function setWarnings(array $warnings);

    /**
     * Add a single warning to the response
     * @param string $warning
     *
     * @return void
     */
    public function addWarning($warning);
}
