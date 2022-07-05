<?php

namespace Source\Models;

use LandKit\Model\Model;

class ReadingModel extends Model
{
    /**
     * @var string
     */
    protected string $table = 'leitura';

    /**
     * @var array|string[]|null
     */
    protected ?array $required = ['rastreamento_id'];

    /**
     * @const string
     */
    public const CREATED_AT = 'criado_em';

    /**
     * @const string
     */
    public const UPDATED_AT = '';
}