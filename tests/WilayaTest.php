<?php declare(strict_types = 1);

use Kossa\AlgerianCities\Commune;
use Kossa\AlgerianCities\Tests\TestCase;
use Kossa\AlgerianCities\Wilaya;

final class WilayaTest extends TestCase
{
    /** @test */
    public function if_wilayas_count_is_correct()
    {
        $count = Wilaya::count();
        $this->assertEquals(58, $count);
    }

    /** @test */
    public function if_wilaya_details_are_correct()
    {
        $sampleWilaya = Wilaya::where('name', 'Alger')->first(['id', 'name', 'arabic_name', 'longitude', 'latitude']);
        $this->assertJsonStringEqualsJsonString(
            $sampleWilaya->toJson(),
            '{"id":16,"name":"Alger","arabic_name":"الجزائر","longitude":36.753768,"latitude":3.0587561}'
        );
    }

}