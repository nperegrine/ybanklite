<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Transaction;
use App\Repository\TransactionRepositoryInterface;

use App\Http\Requests\Transactions\StoreRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\JsonResponse;
use App\Traits\ResponseUtils;

class TransactionController extends Controller
{
    use ResponseUtils;
    
    protected $transactionRepository;
    
    public function __construct(TransactionRepositoryInterface $transactionRepository)
    {
        $this->transactionRepository = $transactionRepository;
    }
    

    /**
     * Fetch all transactions
     * 
     * @return JsonResponse
     */
    public function index() : JsonResponse {

        $transactionsFetch = $this->transactionRepository->all();
        
        if ($transactionsFetch->hasError()) {
            return $this->errorResponse(
                $transactionsFetch->getErrorMessage()
            );
        }

        return $this->successListResponse($transactionsFetch->getItems()->all());
    }

    /**
     * Returns the transactionRepository with id passed in param
     *
     * @param int $id
     *
     * @return JsonResponse
     */
    public function show($id): JsonResponse
    {                
        $transactionFetch = $this->transactionRepository->find($id);
        
        if ($transactionFetch->hasError()) {
            return $this->errorResponse($transactionFetch->getErrorMessage(), 400);
        }

        return $this->successResponse($transactionFetch->getItems());
    }

    /**
     * Create(store) transactionRepository
     *
     * @param StoreRequest $request
     *
     * @return JsonResponse
     */
    public function store(StoreRequest $request)
    {
        $transactionStore = $this->transactionRepository->store($request);

        if ($transactionStore->hasError()) {
            return $this->errorResponse(
                $transactionStore->getErrorMessage()
            );
        }

        return $this->successResponse($transactionStore->getItems());
    }
}