<?php

namespace Tests\Unit;

use App\Models\Account;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AccountControllerTest extends TestCase
{
    use RefreshDatabase, DatabaseMigrations;

    /**
     * A unit test to ensure that a user
     * is not allowed to overspend their balance
     *
     * @return void
     */
    public function test_user_cannot_overspend_balance()
    {
        $mockAccount = factory(Account::class)->create();
        
        $amount = 6000;

        $this->assertTrue($mockAccount->isOverspendingBalance($amount));
       
    }

    /**
     * Test to verify we can get account with valid
     * 
     * @return void
     */
    public function test_can_show_account_with_valid_id()
    {
        $mockAccount = factory(Account::class)->create(['id' => 1]);
        
        $response = $this->getJson('/api/accounts'.'/'.$mockAccount->id);
 
        $response->assertStatus(200);
       
    }

    /**
     * Test to cannot show account with invalid id
     * 
     * @return void
     */
    public function test_cannot_show_account_with_invalid_id()
    {
        // use a transaction id that doesn't exist
        $mock_account_id = 10;

        $response = $this->getJson('/api/accounts'.'/'.$mock_account_id .'/');
 
        $response->assertStatus(400);
       
    }

    /**
     * Test to ensure we can create(store) a new account with valid
     * 
     * @return void
     */
    public function test_can_create_account_with_valid_data()
    {
        $mockData = [
            'name' => 'Jane',
            'balance' => 0,
            'currency' => 'usd',
            'user_id' => 2
        ]; 

        $response = $this->postJson('/api/accounts', $mockData);

        $response->assertStatus(200);

    }

     /**
     * Test to ensure we cannot create(store) a new account with invalid data
     * 
     * @return void
     */
    public function test_cannot_create_account_with_invalid_data()
    {
        $mockData = [
            'name' => 'Doe',
            'balance' => -10000, // invalid data (amount)
            'user_id' => 2
        ];

        $response = $this->postJson('/api/accounts', $mockData);

        $response->assertStatus(422);

    }

    /**
     * Test to ensure we can update an account with valid data
     * 
     * @return void
     */
    public function test_can_update_account_with_valid_data()
    {        
        $mockAccount = factory(Account::class)->create(['id' => 1]);

        $mockData = [
            'name' => 'Jane Doe',
            'currency' => 'usd'
        ];

        $response = $this->putJson('/api/accounts' .'/'.$mockAccount->id, $mockData);

        $response->assertStatus(200);

    }

     /**
     * Test to ensure we cannot update an account with invalid data
     * 
     * @return void
     */
    public function test_cannot_update_account_with_invalid_data()
    {
        
        $mockAccount = factory(Account::class)->create(['id' => 1]); 

        $mockData = [
            'name' => 'Jane Doe',
            'currency' => -50000 // invalid data (currency)
        ];

        $response = $this->putJson('/api/accounts' .'/'.$mockAccount->id , $mockData);

        $response->assertStatus(422);

    }

    /**
     * Test to ensure we can delete account with valid id
     * 
     * @return void
     */
    public function test_can_delete_account_with_valid_id()
    {
        $mockAccount = factory(Account::class)->create(['id' => 1]); 

        $response = $this->deleteJson('/api/accounts'. '/'.$mockAccount->id);

        $response->assertStatus(200);

    }
}