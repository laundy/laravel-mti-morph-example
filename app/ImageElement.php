<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ImageElement extends Model
{
    protected $table = 'imageelements';

    protected $fillable = ['format', 'height', 'width'];

    public function element()
    {
        return $this->morphOne('App\Element', 'elementable');
    }
}
