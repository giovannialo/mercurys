<?php

namespace Source\Models;

use LandKit\Model\Model;

class ArchiveLineValueModel extends Model
{
    /**
     * @var string
     */
    protected string $table = 'arquivo_linha_valor';

    /**
     * @var array|string[]|null
     */
    protected ?array $required = [
        'arquivo_linha_id',
        'arquivo_coluna_id'
    ];

    /**
     * @var bool
     */
    protected bool $timestamps = false;
}