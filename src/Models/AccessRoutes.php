<?php

namespace Zoy\Accessuser\Models;


class AccessRoutes extends AccessModel
{
    protected $fillable = ["access_id", "controller", "action", "name", "path", "is_ajax", "time"];

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
            'name' => 'controller',
            'sortField' => 'controller',
            'callback' =>'',
            'dataClass' =>'',
            'titleClass' =>'',
            'visible' =>true
        ],
        [
            'name' => 'action',
            'sortField' => 'action',
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
            'name' => 'path',
            'sortField' => 'path',
            'callback' =>'',
            'dataClass' =>'',
            'titleClass' =>'',
            'visible' =>true
        ],
        [
            'name' => 'is_ajax',
            'sortField' => 'is_ajax',
            'titleClass' => 'text-center',
            'dataClass' => 'text-center',
            'title' => 'Ajax',
            'callback' =>'',
            'visible' =>true
            // callback: 'formatDate|D/MM/Y'
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
        /*[
            'name' => '__actions',
            'title' => '',
            'titleClass' => 'text-center',
            'dataClass' => 'text-center'
        ]*/
    ];


}
