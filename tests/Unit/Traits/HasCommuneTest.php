<?php

declare(strict_types=1);

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Kossa\AlgerianCities\Models\Commune;
use Kossa\AlgerianCities\Traits\HasCommune;

it('ensures that the model belongs to a commune', function (): void {
    // Create a test model that uses the HasCommune trait
    $model = new class extends Model
    {
        use HasCommune;

        protected $table = 'dummy_models'; // Fake table (not actually in DB)

        public $exists = true; // Trick Laravel into thinking it's persisted
    };

    // Create a Commune instance
    $commune = Commune::factory()->make(); // Use `make()` to avoid DB queries

    // Fake the belongsTo relationship
    $model->setRelation('commune', $commune);

    // Assert that the relation is a BelongsTo instance
    expect($model->commune())->toBeInstanceOf(BelongsTo::class);

    // Assert that the related model is the correct Commune
    expect($model->commune->id)->toBe($commune->id);
});
