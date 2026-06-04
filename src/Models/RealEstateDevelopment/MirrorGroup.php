<?php

namespace Bildvitta\IssProduto\Models\RealEstateDevelopment;

use Bildvitta\IssProduto\Models\RealEstateDevelopment;
use Bildvitta\IssProduto\Traits\UsesProdutoDB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Ramsey\Uuid\Uuid;

class MirrorGroup extends Model
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

    public function mirror(): BelongsTo
    {
        return $this->belongsTo(Mirror::class, 'mirror_id');
    }
}