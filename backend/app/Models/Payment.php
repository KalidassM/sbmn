<?php
namespace App\Models; use Illuminate\Database\Eloquent\Model;
class Payment extends Model { protected $fillable=['member_id','receipt_no','payment_date','maintenance_month','amount','payment_mode','reference','remarks']; protected $casts=['payment_date'=>'date','amount'=>'decimal:2']; public function member(){return $this->belongsTo(Member::class);} }
