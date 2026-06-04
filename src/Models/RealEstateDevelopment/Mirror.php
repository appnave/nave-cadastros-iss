<?php

namespace Bildvitta\IssProduto\Models\RealEstateDevelopment;

use Bildvitta\IssProduto\Models\RealEstateDevelopment;
use Bildvitta\IssProduto\Traits\UsesProdutoDB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Ramsey\Uuid\Uuid;

class Mirror extends Model
{
    use SoftDeletes, UsesProdutoDB;

    protected $connection = 'iss-produto';

    public static function boot(): void
    {
        parent::boot();

        self::creating(function ($model) {
            $model->uuid = (string) Uuid::uuid4();
        });
    }

    public function real_estate_development(): BelongsTo
    {
        return $this->belongsTo(RealEstateDevelopment::class, 'real_estate_development_id');
    }
}