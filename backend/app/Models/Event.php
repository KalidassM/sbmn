<?php
namespace App\Models; use Illuminate\Database\Eloquent\Model;
class Event extends Model { protected $fillable=['title','date','venue','desc']; protected $casts=['date'=>'date:Y-m-d']; }
