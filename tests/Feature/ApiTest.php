<?php

declare(strict_types=1);

it('checks if all API endpoints work', function (): void {
    $this->get('/api/wilayas')
        ->assertStatus(200)
        ->assertJsonCount(58);

    $this->get('/api/wilayas/1')
        ->assertStatus(200)
        ->assertJsonFragment(['name' => 'Adrar']);

    $this->get('/api/wilayas/1/communes')
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
});
