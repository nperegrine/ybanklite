<?php

namespace App\Http\Responses;

/**
 * A response object used for lists
 */
class Std200Response extends StdResponse
{
    /**
     * The list of items that will be sent on the response
     * @var mixed
     */
    public $item;

    /**
     * @param mixed $item
     */
    public function setItem($item)
    {
        $this->item = $item;
    }
}
