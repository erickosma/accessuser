<?php

namespace Zoy\Accessuser\Models;


class AccessAgents extends AccessModel
{
    protected $fillable = ["access_id",
        'name',
        'browser',
        'browser_version'];

    public $fields = [
        [
            'name' => 'access_id',
            'sortField' => 'access_id',
            'title' => 'Access',
            'callback' =>'',
            'dataClass' =>'',
            'titleClass' =>'',
            'visible' =>true
        ],
        [
            'name' => 'name',
            'sortField' => 'name',
            'callback' =>'',
            'dataClass' =>'',
            'titleClass' =>'',
            'visible' =>true
        ],
        [
            'name' => 'browser',
            'sortField' => 'browser',
            'callback' =>'',
            'dataClass' =>'',
            'titleClass' =>'',
            'visible' =>true
        ],
        [
            'name' => 'browser_version',
            'sortField' => 'browser_version',
            'callback' =>'',
            'dataClass' =>'',
            'titleClass' =>'',
            'visible' =>true
        ],
        [
            'name' => 'created_at',
            'sortField' => 'created_at',
            'titleClass' => 'text-center',
            'dataClass' => 'text-center',
            'title' => 'Data',
            'callback' =>'',
            'visible' =>true
            // 'callback' => 'formatDate|D/MM/Y'
        ]
    ];
}
