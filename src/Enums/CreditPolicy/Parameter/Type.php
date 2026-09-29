<?php

namespace Bildvitta\IssProduto\Enums\CreditPolicy\Parameter;

enum Type: string
{
    case PRO_SOLUTO = 'pro_soluto';
    case AFTER_KEY_DELIVERY = 'after_key_delivery';
    case INCOME = 'income';
    case INCOME_COMMITMENT = 'income_commitment';
    case THIRD_PARTY_ASSET_DISCOUNT = 'third_party_asset_discount';
}
