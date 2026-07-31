<?php
namespace App\Models; use Illuminate\Database\Eloquent\Model;
class Member extends Model { protected $fillable=['member_code','plot_no','owner_name','mobile','email','status','monthly_fee']; protected $casts=['monthly_fee'=>'decimal:2']; public function payments(){return $this->hasMany(Payment::class);} }
