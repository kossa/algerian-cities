<?php

declare(strict_types=1);

use Kossa\AlgerianCities\Models\Commune;

it('checks if the commune count is correct', function (): void {
    expect(Commune::count())->toBe(1541);
});

it('checks if commune details are correct', function (): void {
    $sampleCommune = Commune::where('name', 'Alger Centre')
        ->firstOrFail(['id', 'name', 'post_code', 'longitude', 'latitude']);

    expect($sampleCommune->toJson())->toBeJson()
        ->toBe('{"id":554,"name":"Alger Centre","post_code":"16001","longitude":3.061224,"latitude":36.771225}');
});
