<?php
namespace App\Models; use Illuminate\Database\Eloquent\Model;
class Notice extends Model { protected $fillable=['title','body','date','pinned']; protected $casts=['pinned'=>'boolean','date'=>'date:Y-m-d']; }
