<?php
namespace App\Http\Controllers\Api; use App\Http\Controllers\Controller; use App\Models\{Member,Payment,Expense};
class DashboardController extends Controller { public function index(){ return response()->json(['members'=>Member::where('status','Active')->count(),'receipts'=>Payment::sum('amount'),'expenses'=>Expense::where('is_capital',false)->sum('amount'),'capital_assets'=>Expense::where('is_capital',true)->sum('amount'),'balance'=>Payment::sum('amount')-Expense::sum('amount')]); } }
