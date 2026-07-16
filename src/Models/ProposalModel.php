<?php

namespace Bildvitta\IssProduto\Models;

use Bildvitta\IssProduto\Traits\UsesProdutoDB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ProposalModel extends Model
{
    use SoftDeletes, UsesProdutoDB;

    protected $connection = 'iss-produto';

    protected $fillable = ['uuid', 'name'];

    public function hub_company(): BelongsTo
    {
        return $this->belongsTo(HubCompany::class);
    }

    public function periodicities(): HasMany
    {
        return $this->hasMany(ProposalModelPeriodicity::class);
    }

    public function real_estate_developments(): BelongsToMany
    {
        return $this->belongsToMany(RealEstateDevelopment::class);
    }
}
