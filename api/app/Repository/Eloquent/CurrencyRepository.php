<?php 

namespace App\Repository\Eloquent;

use App\Models\Currency;
use App\Repository\CurrencyRepositoryInterface;
use App\Repository\Repository;
use App\Http\Resources\Currency as CurrencyResource;

use Illuminate\Support\Facades\Log;

class CurrencyRepository extends Repository implements CurrencyRepositoryInterface {

    /**      
     * @var Model      
     */     
    protected $model;     

     /**
    * AccountRepository constructor.
    *
    * @param App\Models\Currency $model
    */
   public function __construct(Currency $model)
   {
       $this->model = $model;
   }

   /**
    * @return
    */
    public function all() {
        try {
            $currencies = $this->model->all();
            $currenciesList = CurrencyResource::collection($currencies);

        } catch (\Exception $exception) {
           
            Log::error(
                'Error fetching currencies',
                [
                    'message' => $exception->getMessage()
                ]
            );
            $error = true;
            $errorMessage = $exception->getMessage();

        }

        return (new Repository())
        ->setItems($currenciesList ?? [])
        ->setError($error ?? false)
        ->setErrorMessage($errorMessage ?? '');
    }
}