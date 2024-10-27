<?php

declare(strict_types=1);

namespace Kossa\AlgerianCities\Tests;

final class ApiTest extends TestCase
{
    /** @test */
    public function if_all_endpoint_works()
    {
        $this->get('/api/wilayas')
            ->assertStatus(200)
            ->assertJsonCount(58);

        $this->get('/api/wilayas/1')
            ->assertStatus(200)
            ->assertJsonFragment(['name' => 'Adrar']);

        $this->get('/api/search/wilaya/adrar')
            ->assertStatus(200)
            ->assertJsonFragment(['name' => 'Adrar']);

        $this->get('/api/communes')
            ->assertStatus(200)
            ->assertJsonCount(1541);

        $this->get('/api/communes/1')
            ->assertStatus(200)
            ->assertJsonFragment(['name' => 'Adrar']);

        $this->get('/api/search/commune/adrar')
            ->assertStatus(200)
            ->assertJsonFragment(['name' => 'Adrar']);

    }
}
