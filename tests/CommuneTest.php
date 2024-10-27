<?php

declare(strict_types=1);

use Kossa\AlgerianCities\Commune;
use Kossa\AlgerianCities\Tests\TestCase;

final class CommuneTest extends TestCase
{
    /** @test */
    public function if_commune_count_is_correct()
    {
        $count = Commune::count();
        $this->assertEquals(1541, $count);
    }

    /** @test */
    public function if_commune_details_are_correct()
    {
        $sampleCommune = Commune::where('name', 'Alger Centre')
            ->first(['id', 'name', 'arabic_name', 'post_code', 'longitude', 'latitude']);

        $this->assertJsonStringEqualsJsonString(
            $sampleCommune->toJson(),
            '{"id":554,"name":"Alger Centre","arabic_name":"الجزائر الوسطى","longitude":3.0612244,"latitude":36.7712246,"post_code": "16001"}'
        );
    }
}
