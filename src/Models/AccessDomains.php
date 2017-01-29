<?php

namespace Zoy\Accessuser\Models;


class AccessDomains extends AccessModel
{

    protected $fillable =  ["access_id", "url", "host" ,  "search_terms_hash"];


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
            'name' => 'url',
            'sortField' => 'url',
            'callback' =>'',
            'dataClass' =>'',
            'titleClass' =>'',
            'visible' =>true
        ],
        [
            'name' => 'host',
            'sortField' => 'host',
            'callback' =>'',
            'dataClass' =>'',
            'titleClass' =>'',
            'visible' =>true
        ],
        [
            'name' => 'search_terms_hash',
            'sortField' => 'search_terms_hash',
            'titleClass' => '',
            'dataClass' => '',
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
