<?php
namespace App\Models; use Illuminate\Database\Eloquent\Model;
class Expense extends Model { protected $fillable=['voucher_no','expense_date','category','description','amount','payment_mode','payee','reference','is_capital']; protected $casts=['expense_date'=>'date','amount'=>'decimal:2','is_capital'=>'boolean']; }
