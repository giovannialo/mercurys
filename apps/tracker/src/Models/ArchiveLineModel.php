<?php

namespace Source\Models;

use LandKit\Model\Model;

class ArchiveLineModel extends Model
{
    /**
     * @var string
     */
    protected string $table = 'arquivo_linha';

    /**
     * @var array|string[]|null
     */
    protected ?array $required = [
        'arquivo_id'
    ];

    /**
     * @var bool
     */
    protected bool $timestamps = false;
}