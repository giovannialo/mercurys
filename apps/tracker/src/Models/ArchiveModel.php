<?php

namespace Source\Models;

use LandKit\Model\Model;

class ArchiveModel extends Model
{
    /**
     * @var string
     */
    protected string $table = 'arquivo';

    /**
     * @var array|string[]|null
     */
    protected ?array $required = ['hash'];

    /**
     * @const string
     */
    public const CREATED_AT = 'criado_em';

    /**
     * @const string
     */
    public const UPDATED_AT = '';
}