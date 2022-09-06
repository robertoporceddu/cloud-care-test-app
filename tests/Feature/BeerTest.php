<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class BeerTest extends TestCase
{
    /**
     * User can retrieve beer list
     *
     * @return void
     */
    public function test_beer_list_can_be_retrieved()
    {
        Sanctum::actingAs(
            User::factory()->create(),
            ['*']
        );

        $response = $this->get('/api/beers');

        $response->assertOk();
    }

    /**
     * User can retrieve beer list paginated
     *
     * @return void
     */
    public function test_beer_list_paginated_can_be_retrieved()
    {
        Sanctum::actingAs(
            User::factory()->create(),
            ['*']
        );

        $response = $this->get('/api/beers?page=3&per_page=1');

        $response->assertOk();
    }
}
