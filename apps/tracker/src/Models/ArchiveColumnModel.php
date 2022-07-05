<?php

namespace Source\Models;

use LandKit\Model\Model;

class ArchiveColumnModel extends Model
{
    /**
     * @var string
     */
    protected string $table = 'arquivo_coluna';

    /**
     * @var array|string[]|null
     */
    protected ?array $required = [
        'arquivo_id',
        'nome'
    ];

    /**
     * @var bool
     */
    protected bool $timestamps = false;
}