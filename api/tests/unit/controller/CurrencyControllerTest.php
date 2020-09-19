<?php

namespace Tests\Unit;

use App\Models\Currency;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CurrencyControllerTest extends TestCase
{
    use RefreshDatabase, DatabaseMigrations;

    /**
     * Test to verify we can get currency list
     * 
     * @return void
     */
    public function test_can_get_currencies()
    {
        $response = $this->getJson('/api/currencies');
 
        $response->assertStatus(200);
       
    }
}