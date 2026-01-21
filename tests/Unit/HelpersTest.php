<?php

declare(strict_types=1);

use Kossa\AlgerianCities\Models\Commune;
use Kossa\AlgerianCities\Models\Wilaya;

it('returns a list of communes', function (): void {
    $wilaya = Wilaya::factory()->create();
    $commune = Commune::factory()->create(['wilaya_id' => $wilaya->id]);

    $communesList = communes();

    expect($communesList)->toBeArray()
        ->and(array_key_exists($commune->id, $communesList))->toBeTrue();
});

it('returns communes filtered by wilaya_id', function (): void {
    $wilaya1 = Wilaya::factory()->create();
    $wilaya2 = Wilaya::factory()->create();

    $commune1 = Commune::factory()->create(['wilaya_id' => $wilaya1->id]);
    $commune2 = Commune::factory()->create(['wilaya_id' => $wilaya2->id]);

    $filteredCommunes = communes($wilaya1->id);

    expect($filteredCommunes)->toHaveCount(1)
        ->and(array_key_exists($commune1->id, $filteredCommunes))->toBeTrue();
});

it('returns communes with wilaya', function (): void {
    $wilaya = Wilaya::factory()->create(['name' => 'Tizi Ouzou']);
    $commune = Commune::factory()->create(['name' => 'Azeffoun', 'wilaya_id' => $wilaya->id]);

    $communesWithWilaya = communes(null, true);

    expect($communesWithWilaya)->toBeArray()
        ->and(in_array('Azeffoun, Tizi Ouzou', $communesWithWilaya))->toBeTrue();
});

it('returns a list of wilayas', function (): void {
    $wilaya = Wilaya::factory()->create();

    $wilayasList = wilayas();

    expect($wilayasList)->toBeArray()
        ->and(array_key_exists($wilaya->id, $wilayasList))->toBeTrue();
});

it('returns a single commune', function (): void {
    $wilaya = Wilaya::factory()->create();
    $commune = Commune::factory()->create(['wilaya_id' => $wilaya->id]);

    $result = commune($commune->id);

    expect($result)->toBeInstanceOf(Commune::class)
        ->and($result->id)->toBe($commune->id);
});

it('returns a single commune with wilaya', function (): void {
    $wilaya = Wilaya::factory()->create(['name' => 'Tizi Ouzou']);
    $commune = Commune::factory()->create(['name' => 'Azeffoun', 'wilaya_id' => $wilaya->id]);

    $result = commune($commune->id, true);

    expect($result)->toBeInstanceOf(Commune::class)
        ->and($result->wilaya)->toBeInstanceOf(Wilaya::class)
        ->and($result->wilaya->name)->toBe('Tizi Ouzou');
});

it('returns a single wilaya', function (): void {
    $wilaya = Wilaya::factory()->create();

    $result = wilaya($wilaya->id);

    expect($result)->toBeInstanceOf(Wilaya::class)
        ->and($result->id)->toBe($wilaya->id);
});
