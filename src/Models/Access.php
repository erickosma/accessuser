<?php

namespace Zoy\Accessuser\Models;



class Access extends AccessModel
{
    protected $fillable = ["id",
        'uuid',
        'client_ip'];



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
            'name' => 'client_ip',
            'sortField' => 'client_ip',
            'title' => 'Ip',
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
            'visible' =>true,
            // 'callback' => 'formatDate|D/MM/Y'
        ],
        [
            'name' => 'updated_at',
            'sortField' => 'updated_at',
            'titleClass' => 'text-center',
            'dataClass' => 'text-center',
            'title' => 'Update',
            'callback' =>'',
            'visible' =>true
            // 'callback' => 'formatDate|D/MM/Y'
        ]
    ];

}
