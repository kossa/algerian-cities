<?php

declare(strict_types=1);

use Kossa\AlgerianCities\Models\Commune;
use Kossa\AlgerianCities\Models\Wilaya;

it('has fillable attributes', function (): void {
    $wilaya = new Wilaya;
    expect($wilaya->getFillable())->toBe([
        'name', 'arabic_name', 'longitude', 'latitude',
    ]);
});

it('returns correct validation rules', function (): void {
    expect(Wilaya::rules())->toBe([
        'name' => 'required',
    ]);
});

it('has many communes', function (): void {
    $wilaya = Wilaya::factory()->create();
    $communes = Commune::factory()->count(3)->create(['wilaya_id' => $wilaya->id]);

    expect($wilaya->communes)->toHaveCount(3);
    expect($wilaya->communes->first())->toBeInstanceOf(Commune::class);
});
