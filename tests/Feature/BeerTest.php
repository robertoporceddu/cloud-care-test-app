<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Http;
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
        Http::fake([
            'api.punkapi.com/v2/beers' => Http::response([[
                'id'       => '111',
                'name'     => 'example beer 1',
                'tagline'  => 'example beer 1 flavour'
            ],
            [
                'id'       => '222',
                'name'     => 'example beer 2',
                'tagline'  => 'example beer 2 flavour'
            ],
            [
                'id'       => '333',
                'name'     => 'example beer 3',
                'tagline'  => 'example beer 3 flavour'
            ]], 200),
        ]);

        Sanctum::actingAs(
            User::factory()->create(),
            ['*']
        );

        $response = $this->get('/api/beers',[
            'Accept' => 'application/json'
        ]);

        $response->assertJsonFragment(['name' => 'example beer 1']);
        $response->assertOk();
    }

    /**
     * User can retrieve beer list paginated
     *
     * @return void
     */
    public function test_beer_list_paginated_can_be_retrieved()
    {
        Http::fake([
            'api.punkapi.com/v2/beers?page=3&per_page=1' => Http::response([[
                'id'       => '333',
                'name'     => 'example beer 3',
                'tagline'  => 'example beer 3 flavour'
            ]], 200),
        ]);

        Sanctum::actingAs(
            User::factory()->create(),
            ['*']
        );

        $response = $this->get('/api/beers?page=3&per_page=1',[
            'Accept' => 'application/json'
        ]);

        $response->assertJsonFragment(['name' => 'example beer 3']);
        $response->assertOk();
    }

    /**
     * User cant be retrieve beer list paginated
     *
     * @return void
     */
    public function test_beer_list_paginated_cant_be_retrieved()
    {
        Http::fake([
            'api.punkapi.com/v2/beers?page=1&per_page=1' => Http::response([], 404),
        ]);

        Sanctum::actingAs(
            User::factory()->create(),
            ['*']
        );

        $response = $this->get('/api/beer?page=1&per_page=1',[
            'Accept' => 'application/json'
        ]);

        $response->assertNotFound();
    }

    /**
     * User cant be retrieve beer list while not loggedin
     *
     * @return void
     */
    public function test_beer_list_paginated_cant_be_retrieved_if_user_not_logged()
    {
        Http::fake([
            'api.punkapi.com/v2/beers?page=1&per_page=1' => Http::response([[
                'id'       => '333',
                'name'     => 'example beer 3',
                'tagline'  => 'example beer 3 flavour'
            ]], 200),
        ]);

        $response = $this->get('/api/beers?page=1&per_page=1', [
            'Accept' => 'application/json'
        ]);

        $response->assertUnauthorized();
    }
}
