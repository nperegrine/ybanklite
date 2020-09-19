<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Transaction;
use App\Repository\AccountRepositoryInterface;

use App\Http\Requests\Accounts\StoreRequest;
use App\Http\Requests\Accounts\UpdateRequest;
use Illuminate\Http\JsonResponse;
use App\Traits\ResponseUtils;

class AccountController extends Controller
{
    use ResponseUtils;
    
    protected $accountRepository;
    
    public function __construct(AccountRepositoryInterface $accountRepository)
    {
        $this->accountRepository = $accountRepository;
    }

    /**
     * Returns a list of all accounts
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $accountsFetch = $this->accountRepository->all();
        
        if ($accountsFetch->hasError()) {
            return $this->errorResponse(
                $accountsFetch->getErrorMessage()
            );
        }

        return $this->successListResponse($accountsFetch->getItems()->all());
        
    }

    /**
     * Find the account with id passed in params
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show($id): JsonResponse
    {
        $accountFetch = $this->accountRepository->find($id);

        if ($accountFetch->hasError()) {
            return $this->errorResponse($accountFetch->getErrorMessage(), 400);
        }

        return $this->successResponse($accountFetch->getItems());
    }

    /**
     * Store a new account and return stored account
     *
     * @param StoreRequest $request
     * @return JsonResponse
     */
    public function store(StoreRequest $request): JsonResponse
    {
        $accountStore = $this->accountRepository->store($request->all());
        
        if ($accountStore->hasError()) {
            return $this->errorResponse(
                $accountStore->getErrorMessage()
            );
        }

        return $this->successResponse($accountStore->getItems());
    }

    /**
     * Update an account and return updated account
     *
     * @param int $id
     * @param UpdateRequest $request
     * @return JsonResponse
     */
    public function update(UpdateRequest $request, $id): JsonResponse
    {
        $accountUpdate = $this->accountRepository->update($request, $id);
        
        if ($accountUpdate->hasError()) {
            return $this->errorResponse(
                $accountUpdate->getErrorMessage()
            );
        }

        return $this->successResponse($accountUpdate->getItems());
    }

    /**
    * Delete an account
    *
    * @param int $id
    * @return JsonResponse
    */
    public function delete($id): JsonResponse
    {
        $accountDelete = $this->accountRepository->delete($id);
                
        if ($accountDelete->hasError()) {
            return $this->errorResponse(
                $accountDelete->getErrorMessage()
            );
        }

        return $this->successResponse($accountDelete->getItems());
    }


    /**
     * Fetch transactions for account ID passed in params
     *
     * @param int $id
     */
    public function getAccountTransactions($id)
    {
        $transactionsFetch = $this->accountRepository->getTransactionsByAccount($id);

        if ($transactionsFetch->hasError()) {
            return $this->errorResponse(
                $transactionsFetch->getErrorMessage()
            );
        }

        return $this->successListResponse($transactionsFetch->getItems()->all());
    }
}