<?php

namespace Source\Models;

use LandKit\Model\Model;

class TrackingModel extends Model
{
    /**
     * @var string
     */
    protected string $table = 'rastreamento';

    /**
     * @var array|string[]|null
     */
    protected ?array $required = [
        'mala_direta',
        'canal_id',
        'arquivo_linha_id',
        'status_id',
        'hash'
    ];

    /**
     * @const string
     */
    public const CREATED_AT = 'criado_em';

    /**
     * @const string
     */
    public const UPDATED_AT = '';
}