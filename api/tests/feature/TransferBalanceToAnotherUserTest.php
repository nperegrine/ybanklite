<?php

namespace Tests\Feature;

use App\Models\Account;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class TransferBalanceToAnotherUserTest extends TestCase
{
    use RefreshDatabase, DatabaseMigrations;
    /**
     * A feature test to ensure that a user can transfer their 
     * balance to another user (while not overspending of course :) )
     * 
     * (PS: This test will not pass when using SQLite in-memory database as it does
     * not support DB::transactions, so in this case the test will fail with a 500 status code.
     * Make sure to use MySQL database option when running this test or be sure to comment out the
     * DB::transactions code block in the TransactionController)
     *
     * @return void
     */
    public function test_can_transfer_balance_to_another_user()
    {
        $this->withoutExceptionHandling();

        $mockAccount1 = factory(Account::class)->create(['id' => 1, 'currency' => 'usd']);
        $mockAccount2 = factory(Account::class)->create(['id' => 2, 'currency' => 'usd']);

        $response = $this->postJson('/api/transactions/', [
           'from' => $mockAccount1->id,
           'to' => $mockAccount2->id,
           'amount' => 2000,
           'details' => 'yBank test transfer payment'
        ]);

        $response->assertStatus(200);
    }
}