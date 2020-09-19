<?php

namespace App\Repository\Eloquent;

use App\Models\Account;
use App\Models\Transaction;
use App\Repository\AccountRepositoryInterface;
use App\Repository\Repository;
use App\Http\Resources\Account as AccountResource;
use App\Http\Resources\Transaction as TransactionResource;

use Illuminate\Support\Facades\Log; 

class AccountRepository extends Repository implements AccountRepositoryInterface {

     /**      
     * @var Model      
     */     
    protected $model;     

     /**
    * AccountRepository constructor.
    *
    * @param App\Models\Account $model
    */
   public function __construct(Account $model)
   {
       $this->model = $model;
   }


    /**
     * @return 
     */
    public function all() : BaseRepository {
        try {
            $accounts = $this->model->all();
            $accountsList = AccountResource::collection($accounts);

        } catch (\Exception $exception) {
           
            Log::error(
                'Error fetching all accounts',
                [
                    'message' => $exception->getMessage()
                ]
            );

            $error = true;
            $errorMessage = $exception->getMessage();
        }
        
        return (new Repository())
            ->setItems($accountsList ?? [])
            ->setError($error ?? false)
            ->setErrorMessage($errorMessage ?? '');

    }

    /**
     * @param $id
     */
    public function find($id) {
       try {
          $account = $this->model->findOrFail($id);
          $singleItem = new AccountResource($account);

        } catch (\Exception $exception) {
           
            Log::error(
                'Error finding that account',
                [
                    'message' => $exception->getMessage(),
                    'id' => $id
                ]
            );
            $error = true;
            
        }
        return (new Repository())
        ->setItems($singleItem ?? [])
        ->setError($error ?? false)
        ->setErrorMessage($errorMessage ?? '');

    }

    /**
     * @param $data
     */
    public function store($data) {

        try {
            $account = $this->model->create($data);

            $singleItem = new AccountResource($account);

        } catch (\Exception $exception) {
            Log::error(
                'Error creating account',
                [
                    'message' => $exception->getMessage(),
                    'data' => $data
                ]
            );
            $error = true;
        }

        return (new Repository())
        ->setItems($singleItem ?? [])
        ->setError($error ?? false)
        ->setErrorMessage($errorMessage ?? '');
    }

    /**
     * @param $data
     */
    public function update($data, $id) {

       try {
        $account = $this->model->findOrFail($id);
        $account->update($data->all());
        $singleItem = new AccountResource($account);

       } catch (\Exception $exception) {
            Log::error(
                'Error updating account',
                [
                    'message' => $exception->getMessage(),
                    'data' => $data,
                    'id' => $id
                ]
            );
            $error = true;

        }
        
        return (new Repository())
        ->setItems($singleItem ?? [])
        ->setError($error ?? false)
        ->setErrorMessage($errorMessage ?? '');
    }

    /**
     * @param $id
     */
    public function delete($id) {

    try {
        $account = $this->model->findOrFail($id);

        $account->delete();

     } catch (\Exception $exception) {
            Log::error(
                'Error deleting account from database',
                [
                    'message' => $exception->getMessage(),
                    'id' => $id
                ]
            );
            $error = true;
        }

        return (new Repository())
            ->setError($error ?? false)
            ->setErrorMessage($errorMessage ?? '');
    }

    /**
     * @param $id
     */
    public function getTransactionsByAccount($id) {

    try {
        $account = $this->model->findOrFail($id);
        $transactions = Transaction::where('from', $account->id)
            ->orWhere('to', $account->id)
            ->get();
        $transactionsList = TransactionResource::collection($transactions);
    
        } catch (\Exception $exception) {
            Log::error(
                'Error fetching account transactions from database',
                [
                    'message' => $exception->getMessage(),
                    'id' => $id
                ]
            );

            $error = true;
            $errorMessage = $exception->getMessage();
        }

        return (new Repository())
            ->setItems($transactionsList ?? [])
            ->setError($error ?? false)
            ->setErrorMessage($errorMessage ?? '');
            
    }
}