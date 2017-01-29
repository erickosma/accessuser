<?php

namespace Zoy\Accessuser\Models;


class AccessDevices extends AccessModel
{

    protected $fillable = ["access_id", "kind", "model", "platform", "platform_version", "is_mobile", "is_robot"];

    public $fields = [
        [
            'name' => 'id',
            'sortField' => 'id',
            'callback' =>'',
            'dataClass' =>'',
            'titleClass' =>'',
            'visible' =>true
        ],
        [
            'name' => 'kind',
            'sortField' => 'kind',
            'callback' =>'',
            'dataClass' =>'',
            'titleClass' =>'',
            'visible' =>true
        ],
        [
            'name' => 'model',
            'sortField' => 'model',
            'callback' =>'',
            'dataClass' =>'',
            'titleClass' =>'',
            'visible' =>true
        ],
        [
            'name' => 'platform',
            'sortField' => 'platform',
            'titleClass' => '',
            'dataClass' => '',
            'callback' =>'',
            'visible' =>true
            // 'callback' => 'formatDate|D/MM/Y'
        ],
        [
            'name' => 'platform_version',
            'sortField' => 'platform_version',
            'titleClass' => '',
            'dataClass' => '',
            'title' => 'Verssion',
            'callback' =>'',
            'visible' =>true
            // 'callback' => 'formatDate|D/MM/Y'
        ],
        [
            'name' => 'is_mobile',
            'sortField' => 'is_mobile',
            'titleClass' => '',
            'dataClass' => '',
            'title' => 'Mobile',
            'callback' =>'',
            'visible' =>true
            // 'callback' => 'formatDate|D/MM/Y'
        ],
        [
            'name' => 'is_robot',
            'sortField' => 'is_robot',
            'titleClass' => '',
            'dataClass' => '',
            'title' => 'Robot',
            'callback' =>'',
            'visible' =>true
            // 'callback' => 'formatDate|D/MM/Y'
        ],
        [
            'name' => 'created_at',
            'sortField' => 'created_at',
            'titleClass' => 'text-center',
            'dataClass' => 'text-center',
            'title' => 'Date',
            'callback' =>'',
            'visible' =>true
            // 'callback' => 'formatDate|D/MM/Y'
        ]

    ];

}
