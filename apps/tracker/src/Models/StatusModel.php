<?php

namespace Source\Models;

use LandKit\Model\Model;

class StatusModel extends Model
{
    /**
     * @var string
     */
    protected string $table = 'status';

    /**
     * @var array|string[]|null
     */
    protected ?array $required = ['nome'];

    /**
     * @const string
     */
    public const CREATED_AT = 'criado_em';

    /**
     * @const string
     */
    public const UPDATED_AT = 'atualizado_em';
}