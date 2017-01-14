<?php

namespace Zoy\Accessuser\Models;


class AccessDomains extends AccessModel
{

    protected $fillable =  ["access_id", "url", "host" ,  "search_terms_hash"];
}
