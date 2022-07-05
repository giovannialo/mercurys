<?php

namespace Source\Models;

use LandKit\Model\Model;

class ModelModel extends Model
{
    /**
     * @var string
     */
    protected string $table = 'modelo';

    /**
     * @var array|string[]|null
     */
    protected ?array $required = [
        'nome',
        'conteudo'
    ];

    /**
     * @const string
     */
    public const CREATED_AT = 'criado_em';

    /**
     * @const string
     */
    public const UPDATED_AT = 'atualizado_em';
}