<?php

namespace Tests\Unit;

use App\Models\Account;
use App\Models\Transaction;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TransactionControllerTest extends TestCase
{
    use RefreshDatabase, DatabaseMigrations;

    /**
     * Test to verify we can fetch transaction with valid id
     * 
     * @return void
     */
    public function test_can_show_transaction_with_valid_id()
    {
        $mockTransaction = factory(Transaction::class)->create();

        $response = $this->getJson('/api/transactions'.'/'.$mockTransaction->id .'/');
 
        $response->assertStatus(200);
       
    }

    /**
     * Test to cannot show transaction with invalid id
     * 
     * @return void
     */
    public function test_cannot_show_transaction_with_invalid_id()
    {
        $mock_transaction_id = 10; // invalid transaction id

        $response = $this->getJson('/api/transactions/'.$mock_transaction_id);
 
        $response->assertStatus(400);
       
    }

    /**
     * Test to ensure we can create(store) a new transaction with valid
     * 
     * @return void
     */
    public function test_can_create_transaction_with_valid_data()
    {
        $mockAccount1 = factory(Account::class)->create(['id' => 1]);
        $mockAccount2 = factory(Account::class)->create(['id' => 2]);

        $mockData = [
            'from' => $mockAccount1->id,
            'to' => $mockAccount2->id,
            'amount' => 1000,
            'details' => 'Sample transaction details'
        ];

        $response = $this->postJson('/api/transactions', $mockData);

        $response->assertStatus(200);

    }

     /**
     * Test to ensure we cannot create(store) a new transaction with invalid data
     * 
     * @return void
     */
    public function test_cannot_create_transaction_with_invalid_data()
    {
        $mockAccount1 = factory(Account::class)->create(['id' => 1]);
        $mockAccount2 = factory(Account::class)->create(['id' => 2]);

        $mockData = [
            'from' =>  $mockAccount1->id,
            'to' => $mockAccount2->id,
            'amount' => -1000,
            'details' => 'Sample transaction details'
        ];

        $response = $this->postJson('/api/transactions', $mockData);

        $response->assertStatus(422);

    }
}