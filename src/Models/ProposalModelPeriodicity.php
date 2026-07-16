<?php

namespace Bildvitta\IssProduto\Models;

use Bildvitta\IssProduto\Traits\UsesProdutoDB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProposalModelPeriodicity extends Model
{
    use SoftDeletes, UsesProdutoDB;

    protected $connection = 'iss-produto';

    public const array PERIODICITY_LIST = [
        'financing' => 'Financiamento',
        'fgts' => 'FGTS',
        'subsidy' => 'Subsídio',
        'down_payment' => 'Entrada',
        'intermediate' => 'Intermediária',
        'post_construction' => 'Pós-obra',
        'monthly' => 'Mensal',
        'bimonthly' => 'Bimestral',
        'quarterly' => 'Trimestral',
        'semiannual' => 'Semestral',
        'yearly' => 'Anual',
        'conclusion_balance' => 'Saldo Conclusão',
        'final' => 'Final',
        'conclusion_keys' => 'Conclusão Chaves',
        'signal' => 'Sinal',
        'periodicity' => 'Periodicidade',
        'single' => 'Única',
        'single_financing' => 'Única - Financiamento',
        'vehicle_exchange' => 'Dação em pagamento - Veículo',
        'real_estate_development_exchange' => 'Dação em pagamento - Imóvel',
    ];

    public const array DUE_DATE_TYPE_LIST = [
        'construction_over_in' => 'Data de entrega da obra',
        'pre_launch_in' => 'Data de breve lançamento',
        'ready_to_live_in' => 'Data de entrega real',
        'hand_over_keys_in' => 'Data de entrega das chaves',
        'vmd_in' => 'Valor Minimo de Desligamento',
    ];

    public const array ADD_ON_TYPE_LIST = [
        'fixed_value' => 'Valor fixo',
        'percentage' => 'Porcentagem',
    ];

    protected $fillable = [
        'uuid',
        'proposal_model_id',
        'update_installments_quantity',
        'installments',
        'periodicity',
        'pin_value',
        'add_on_type',
        'add_on_value',
        'editable',
        'due_date_type',
        'due_dates',
        'has_price_table',
    ];

    protected $casts = [
        'update_installments_quantity' => 'boolean',
        'pin_value' => 'boolean',
        'editable' => 'boolean',
        'has_price_table' => 'boolean',
    ];

    public function proposal_model(): BelongsTo
    {
        return $this->belongsTo(ProposalModel::class);
    }
}
