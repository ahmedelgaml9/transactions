<?php

namespace App\Http\Controllers\Api;
use  App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Payment;
use DB;

class ReportController extends Controller
{

    public function generateReports(Request $request)
    {
    
      $start = $request->start_date;
      $end = $request->end_date;
      $monthlyReport = DB::table('transactions')
      ->select(
        
          DB::raw('MONTH(created_at) as month'),
          DB::raw('YEAR(created_at) as year'),
          DB::raw('SUM(CASE WHEN status = "paid" THEN amount ELSE 0 END) as paid'),
          DB::raw('SUM(CASE WHEN status = "outstanding" THEN amount ELSE 0 END) as outstanding'),
          DB::raw('SUM(CASE WHEN status = "overdue" THEN amount ELSE 0 END) as overdue')
      )
      ->whereBetween('created_at', [$start ,$end])
      ->groupBy(DB::raw('MONTH(created_at)'), DB::raw('YEAR(created_at)'))
      ->orderBy('year', 'asc')
      ->orderBy('month', 'asc')
      ->get();

        return $this->sendResponse($monthlyReport , 'report generated successfully');

    }


  
}
