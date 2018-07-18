<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Enrolled;
use App\EnrolledLog;
use Carbon\Carbon;

class StudentExtraController extends Controller
{
    /**
     * Set the tutorial as paid form the said resource.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function pay_tutorial(Request $request){
        $enrolled = Enrolled::find($request->input('enrolled_id'));
        
        $amount = $request->input('amount');
        
        while($amount > $enrolled->credit) {
            $amount -= $enrolled->credit;
            $this->pay_enrolled_log($enrolled, $enrolled->credit);
        }
        
        $this->pay_enrolled_log($enrolled, $amount);
        
        return back();
    }

    /**
     * Save the enrolled log as pay
     *
     * @param  \App\Enrolled $enrolled
     * @param  double $amount
     */
    private function pay_enrolled_log(Enrolled $enrolled, $amount) {
        $enrolled_log = new EnrolledLog();
        $enrolled_log->enrolled_id = $enrolled->id;
        $enrolled_log->amount = $amount;
        $enrolled_log->transaction_type = 'pay';
        $enrolled_log->save();
    }

    public function drop(Request $request) {
        $tutorial_id = $request->input('tutorial_id');
        $student_id = $request->input('student_id');

        $link = Enrolled::where('tutorial_id', $tutorial_id)
            ->where('student_id', $student_id)
            ->first();
        $link->delete();
        
        return back();
    }

    public function get_tutorial($enrolled_id) {
        $enrolled = Enrolled::find($enrolled_id);
        $enrolled->tutorial;
        $enrolled->enrolled_logs;

        $enrolled->credit = $enrolled->enrolled_logs->where('transaction_type', 'pay')->count() >= 0 
            ? $enrolled->enrolled_logs
                ->where('transaction_type', 'credit')
                ->sum('amount') 
                - $enrolled->enrolled_logs
                ->where('transaction_type', 'pay')
                ->sum('amount')
            : $enrolled->credit;

        // return '<pre>' . json_encode($enrolled, 128) . '</pre>';
        return response()->json($enrolled, 200);
    }

    public function get_tutorial_due($enrolled_id) {
        $enrolled = Enrolled::find($enrolled_id);
        $enrolled->tutorial;
        $formattedEnrollDate = new Carbon($enrolled->created_at);
        $enrolled->totalDue = $enrolled->enrolled_logs->where('transaction_type', 'credit')->sum('amount');
        $enrolled->totalPaid = $enrolled->enrolled_logs->where('transaction_type', 'pay')->sum('amount');
        $paid = 0;
        $credit = 0;
        $enrolled = $this->set_date_format($enrolled);
        
        $logs = $enrolled->enrolled_logs;

        for($i = 0; $i < count($logs); $i++) {
            if($logs[$i]->transaction_type == 'credit') {
                $payment = 0;
                for($j = $i + 1; $j < count($logs); $j++) {
                    if($logs[$j]->transaction_type == 'pay' && $logs[$j]->used == false) {
                        $payment += $logs[$j]->amount;
                        $logs[$j]->used = true;
                        if($payment < $logs[$i]->amount) {
                            continue;
                        }
                        $logs[$i]->paid = $payment >= $logs[$i]->amount;
                        $logs[$i]->payment = $payment;
                    } else {
                        continue;
                    }
                    break;
                }
                continue;
            }
        }
        $enrolled->enrolled_logs = $logs;
        
        // return '<pre>' . json_encode($enrolled->enrolled_logs, 128) . '</pre>';
        return response()->json($enrolled, 200);
    }

    private function set_date_format(Enrolled $enrolled) {
        foreach($enrolled->enrolled_logs as $log) {
            $log->created_at = new Carbon($log->created_at);
            $log->yearMonth = $log->created_at->year . $log->created_at->month;
            if($log->transaction_type == 'credit') {
                $log->paid = false;
                $formattedDueDate = new Carbon($log->created_at);
                $log->formattedEnrollDate = $formattedDueDate->toDayDateTimeString();
                $formattedDueDate->addMonth();
                $log->formattedDueDate = $formattedDueDate->toDayDateTimeString();
                continue;
            }
            $formattedPayDate = new Carbon($log->created_at);
            $log->formattedPayDate = $formattedPayDate->toDayDateTimeString();
        }
        return $enrolled;
    }

    public function re_enroll($enrolled_id) {
        $enrolled = Enrolled::find($enrolled_id);
        $last_enrolled_date = EnrolledLog::where([
            'transaction_type' => 'credit',
            'enrolled_id' => $enrolled_id,
        ])->latest()->first()->created_at;
        $enrolled_log = new EnrolledLog();
        $enrolled_log->enrolled_id = $enrolled->id;
        $enrolled_log->amount = $enrolled->credit;
        $enrolled_log->transaction_type = 'credit';
        $new_enroll_date = new Carbon($last_enrolled_date);
        $new_enroll_date = $new_enroll_date->addMonth();
        $enrolled_log->created_at = $new_enroll_date;
        $enrolled_log->save();

        return back();
    }
}