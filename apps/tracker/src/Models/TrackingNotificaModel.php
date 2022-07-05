<?php

namespace Source\Models;

use LandKit\Model\Model;

class TrackingNotificaModel extends Model
{
    /**
     * @var string
     */
    protected string $table = 'rastreamento_notifica';

    /**
     * @var array|string[]|null
     */
    protected ?array $required = [
        'rastreamento_id',
        'notifica_id'
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