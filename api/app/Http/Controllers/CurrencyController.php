<?php

namespace App\Http\Controllers;

use App\Models\Currency;
use App\Repository\CurrencyRepositoryInterface;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Traits\ResponseUtils;

class CurrencyController extends Controller
{
    use ResponseUtils;
    
    protected $currencyRepository;
    
    public function __construct(CurrencyRepositoryInterface $currencyRepository)
    {
        $this->currencyRepository = $currencyRepository;
    }

    /**
     * Return a list of all currencies
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $currenciesFetch = $this->currencyRepository->all();
        
        if ($currenciesFetch->hasError()) {
            return $this->errorResponse(
                $currenciesFetch->getErrorMessage()
            );
        }

        return $this->successResponse($currenciesFetch->getItems());
    }
}