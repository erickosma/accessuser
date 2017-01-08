<?php

namespace Zoy\Accessuser\Models;


class Access extends AccessModel
{
    protected $fillable = ["id",
        'uuid',
        'client_ip'];


}
