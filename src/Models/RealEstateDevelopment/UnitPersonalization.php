<?php

namespace Bildvitta\IssProduto\Models\RealEstateDevelopment;

use Bildvitta\IssProduto\Traits\UsesProdutoDB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Ramsey\Uuid\Uuid;

class UnitPersonalization extends Model
{
    use SoftDeletes, UsesProdutoDB;

    protected $connection = 'iss-produto';

    protected $table = 'unit_personalization';

    public static function boot(): void
    {
        parent::boot();

        self::creating(function ($model) {
            $model->uuid = (string)Uuid::uuid4();
        });
    }

    protected $casts = [
        'value' => 'decimal:2',
    ];

    public function unit(): BelongsTo
    {
        return $this->belongsTo(Unit::class);
    }
}
