<?php

namespace Zoy\Accessuser\Models;


class AccessUserLog extends AccessModel
{
    protected $fillable = ["access_id", "user_id"];


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
            'name' => 'access_id',
            'sortField' => 'access_id',
            'title' => 'Access',
            'callback' =>'',
            'dataClass' =>'',
            'titleClass' =>'',
            'visible' =>true
        ],
        [
            'name' => 'user_id',
            'sortField' => 'user_id',
            'title' => 'User',
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
