<?php

namespace Source\Models;

use LandKit\Model\Model;

class DirectMailModel extends Model
{
    /**
     * @var string
     */
    protected string $table = 'mala_direta';

    /**
     * @var array|string[]|null
     */
    protected ?array $required = [
        'modelo_id',
        'arquivo_id',
        'unidade_interessada',
        'ativa'
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