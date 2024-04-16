<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
  use HasFactory;

  protected $guarded = ['id'];

  public function getRouteKeyName()
  {
    return 'code';
  }

  public function user()
  {
    return $this->belongsTo(User::class);
  }

  public function service()
  {
    return $this->belongsTo(Service::class);
  }
}
