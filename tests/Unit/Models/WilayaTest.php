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

it('checks if wilayas count is correct', function (): void {
    expect(Wilaya::count())->toBe(58);
});

it('checks if wilaya details are correct', function (): void {
    $sampleWilaya = Wilaya::where('name', 'Alger')->firstOrFail([
        'id', 'name', 'arabic_name', 'longitude', 'latitude',
    ]);

    expect($sampleWilaya->toJson())->toBeJson()
        ->toBe('{"id":16,"name":"Alger","arabic_name":"\u0627\u0644\u062c\u0632\u0627\u0626\u0631","longitude":36.753768,"latitude":3.0587561}');
});
