<?php

declare(strict_types=1);

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Kossa\AlgerianCities\Models\Wilaya;
use Kossa\AlgerianCities\Traits\HasWilaya;

it('ensures that the model has a wilaya relationship', function (): void {
    // Create a test model that uses the HasWilaya trait
    $model = new class extends Model
    {
        use HasWilaya;

        protected $table = 'dummy_models';
    };

    // Mock a Wilaya instance
    $wilaya = Wilaya::factory()->create();

    // Associate the model with a Wilaya
    $model->wilaya()->associate($wilaya);

    // Assert that the relation is a BelongsTo instance
    expect($model->wilaya())->toBeInstanceOf(BelongsTo::class);

    // Assert that the related model is indeed the correct Wilaya
    expect($model->wilaya->id)->toBe($wilaya->id);
});
