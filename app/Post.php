<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Post extends Model
{
  protected $fillable = ['autor', 'titulo', 'data', 'noticia'];

  protected $dates = [ 'data' ];

  public function getDataAttribute($value) {
    return Carbon::parse($value)->format('d/m/Y');
  }

  public function setDataAttribute($value) {
    $this->attributes['data'] = Carbon::createFromFormat('d/m/Y', $value)->format('Y-m-d');
  }
}
