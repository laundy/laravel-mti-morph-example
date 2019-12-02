<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TextElement extends Model
{
    protected $table = 'textelements';

    protected $fillable = ['color', 'font', 'size'];

    public function element()
    {
        return $this->morphOne('App\Element', 'elementable');
    }
}
