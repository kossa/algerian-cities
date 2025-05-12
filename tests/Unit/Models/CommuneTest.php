<?php

declare(strict_types=1);

use Kossa\AlgerianCities\Models\Commune;
use Kossa\AlgerianCities\Models\Wilaya;

it('has fillable attributes', function (): void {
    $commune = new Commune;
    expect($commune->getFillable())->toBe([
        'name', 'arabic_name', 'post_code', 'wilaya_id', 'longitude', 'latitude',
    ]);
});

it('returns correct validation rules', function (): void {
    expect(Commune::rules())->toBe([
        'name' => 'required',
        'wilaya_id' => 'required|numeric',
    ]);
});

it('belongs to a wilaya', function (): void {
    $wilaya = Wilaya::factory()->create();
    $commune = Commune::factory()->create(['wilaya_id' => $wilaya->id]);

    expect($commune->wilaya)->toBeInstanceOf(Wilaya::class);
    expect($commune->wilaya->id)->toBe($wilaya->id);
});

it('returns correct wilaya name attribute', function (): void {
    $wilaya = Wilaya::factory()->create(['name' => 'Tizi Ouzou']);
    $commune = Commune::factory()->create(['wilaya_id' => $wilaya->id]);

    expect($commune->wilaya_name)->toBe('Tizi Ouzou');
});

it('applies scopeWithWilaya correctly', function (): void {
    $wilaya = Wilaya::where(['name' => 'Algiers'])->first();

    $result = Commune::query()->withWilaya()->first();

    expect($result)->not->toBeNull();
    expect($result->name)->toBe('Adrar, Adrar');
});

it('checks if the commune count is correct', function (): void {
    expect(Commune::count())->toBe(1541);
});

it('checks if commune details are correct', function (): void {
    $sampleCommune = Commune::where('name', 'Alger Centre')
        ->firstOrFail(['id', 'name', 'post_code', 'longitude', 'latitude']);

    expect($sampleCommune->toJson())->toBeJson()
        ->toBe('{"id":554,"name":"Alger Centre","post_code":"16001","longitude":3.061224,"latitude":36.771225}');
});
