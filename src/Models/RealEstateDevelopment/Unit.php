<?php

namespace Bildvitta\IssProduto\Models\RealEstateDevelopment;

use Bildvitta\IssProduto\Models\RealEstateDevelopment;
use Bildvitta\IssProduto\Traits\UsesProdutoDB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Ramsey\Uuid\Uuid;

class Unit extends Model
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

    public function mirror_group(): BelongsTo
    {
        return $this->belongsTo(Mirror::class, 'mirror_id');
    }

    public function mirror_subgroup(): BelongsTo
    {
        return $this->belongsTo(MirrorGroup::class, 'mirror_group_id');
    }

    public function prices(): HasMany
    {
        return $this->hasMany(UnitPrice::class, 'unit_id');
    }

    public function tablePrice(): Attribute
    {
        return Attribute::get(function () {
            $period = date('Y-m-01');
            $query = $this->prices()->where('period', $period);

            if ($query->exists()) {
                return $query->first()->table_price;
            }

            return '0.00';
        });
    }

    public function matchUnit(string|int $externalCode): ?self
    {
        return $this->newQuery()
            ->leftJoin('mirrors', 'mirrors.id', '=', 'units.mirror_id')
            ->leftJoin('real_estate_development_modules as modules', 'modules.mirror_id', '=', 'mirrors.id')
            ->where('units.external_code', $externalCode)
            ->select([
                'units.external_code',
                'units.square_meters',
                'modules.apf',
                'modules.mega_phase_code',
                'modules.module',
                'modules.date_contract_registration',
            ])
            ->first();
    }
}
