<?php 

namespace App\Repository\Eloquent;

use App\Models\Account;
use App\Models\Transaction;
use App\Repository\TransactionRepositoryInterface;
use App\Repository\Repository;
use App\Http\Resources\Transaction as TransactionResource;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class TransactionRepository extends Repository implements TransactionRepositoryInterface {

    /**      
     * @var Model      
     */     
    protected $model;     

     /**
    * AccountRepository constructor.
    *
    * @param App\Models\Transaction $model
    */
   public function __construct(Transaction $model)
   {
       $this->model = $model;
   }

    /**
     * @return 
     */
    public function all() {
      try {
        $transactions = $this->model->all();
        $transactionsList = TransactionResource::collection($transactions);

      } catch (\Exception $exception) {
           
        Log::error(
            'Error fetching all transactions',
            [
                'message' => $exception->getMessage()
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

    /**
     * @param $id
     */
    public function find($id) {
        try {
            
          $transaction = $this->model->findOrFail($id);
          $singleItem = new TransactionResource($transaction);

        } catch (\Exception $exception) {
            Log::error(
                'Error finding that transaction',
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
    public function store($request) {
        try {
            
          // Extract necessary fields from the request inputs
          $from = $request->input('from');
          $to = $request->input('to');
          $amount = $request->input('amount');
          $details = $request->input('details');

          $sender_account = Account::findOrFail($from);

        /**
         * yBank needs to verify and make sure user is not overspending their balance
        */
        // If transaction balance is less than amount to be sent then we must forbid and prevent
        // overspending of transaction balance by stopping and sending a 403 error message
        if ($sender_account->isOverspendingBalance($amount)) {
            return response()->json(['message' => 'Error, insufficient balance!'], 403);
        }

        /**
         * Initiate a Database Transaction to ensure Data Integrity:
         * If an exception is thrown within the transaction Closure,
         * the transaction will automatically be rolled back.
         */
       // DB::transaction(function () use ($sender_account, $to, $amount, $request) {
            $sender_account->debitAccountBalance($amount);

            $receiver_account = Account::findOrFail($to);

            $receiver_account->creditAccountBalance($amount);

            $transaction = $this->model->create($request->all());

            $singleItem = new TransactionResource($transaction);

     //   });

        } catch (\Exception $exception) {
            Log::error(
                'Error creating transaction',
                [
                    'message' => $exception->getMessage(),
                    'data' => $request->all()
                ]
            );

            $error = true;

        }

        return (new Repository())
            ->setItems($singleItem ?? [])
            ->setError($error ?? false)
            ->setErrorMessage($errorMessage ?? '');
    }
}