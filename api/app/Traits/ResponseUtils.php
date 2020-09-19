<?php

namespace App\Traits;

use App\Http\Responses\Std200ListResponse;
use App\Http\Responses\Std200Response;
use App\Http\Responses\Std400Response;
use App\Http\Responses\Std500Response;
use App\Http\Responses\StdEmptyResponse;
use App\Http\Responses\StdEmptyResponseInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response as HttpStatusCode;

trait ResponseUtils
{
    /**
     * Returns a JSON response with a status code based on the provided response object
     *
     * @param StdEmptyResponseInterface $response An object that implements
     * the StdEmptyResponseInterface
     *
     * @return JsonResponse
     */
    private function response(StdEmptyResponseInterface $response): JsonResponse
    {
        return response()->json($response, $response->getStatusCode());
    }

    /**
     * A helper method that returns error responses for requests that have been
     * validated but failed at another step
     *
     * @param string $error
     * @param int $type The type of error response (400 or 500).
     *
     * @return JsonResponse
     */
    public function errorResponse(string $error, int $type = 500): JsonResponse
    {
        $response = $type === 400 ? new Std400Response() : new Std500Response();
        $response->addError($error);

        return $this->response($response);
    }

    /**
     * A helper method for success response that returns lists
     *
     * @param array $data
     * @return JsonResponse
     */
    public function successListResponse($data): JsonResponse
    {
        $response = new Std200ListResponse();
        $response->setItems($data);
        $response->setStatusCode(HttpStatusCode::HTTP_OK);

        return $this->response($response);
    }

    /**
     * A helper method for success response that returns a single item
     *
     * @param mixed $data
     * @return JsonResponse
     */
    public function successResponse($data): JsonResponse
    {
        $response = new Std200Response();
        $response->setItem($data);
        $response->setStatusCode(HttpStatusCode::HTTP_OK);

        return $this->response($response);
    }

    /**
     * A helper method for success response that returns empty response
     *
     * @return JsonResponse
     */
    public function successEmptyResponse(): JsonResponse
    {
        $response = new StdEmptyResponse();
        $response->setStatusCode(HttpStatusCode::HTTP_OK);

        return $this->response($response);
    }
}
