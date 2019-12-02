<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Element extends Model
{
    protected $fillable = ['type', 'x', 'y'];

    public function elementable()
    {
        return $this->morphTo();
    }
}
