<?php

declare(strict_types=1);

use Kossa\AlgerianCities\Commune;
use Kossa\AlgerianCities\Tests\TestCase;

final class CommuneTest extends TestCase
{
    public function test_if_commune_count_is_correct(): void
    {
        $count = Commune::count();
        $this->assertEquals(1541, $count);
    }

    public function test_if_commune_details_are_correct(): void
    {
        $sampleCommune = Commune::where('name', 'Alger Centre')
            ->firstOrFail(['id', 'name', 'arabic_name', 'post_code', 'longitude', 'latitude']);

        $this->assertJsonStringEqualsJsonString(
            $sampleCommune->toJson(),
            '{"id":554,"name":"Alger Centre","arabic_name":"الجزائر الوسطى","longitude":3.061224,"latitude":36.771225,"post_code": "16001"}'
        );
    }
}
