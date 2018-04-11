<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'portfolio';
    protected $fillable = [
        'port_titulo', 'port_desc', 'port_thumb'
    ];
}
