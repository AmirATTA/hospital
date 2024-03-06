<?php

namespace App\Http\Controllers\admin;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Doctor;
use App\Models\Invoice;
use App\Models\Payment;
use App\Models\Surgery;
use Illuminate\Http\Request;
use App\Traits\RedirectNotify;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Spatie\Activitylog\Models\Activity;

class DashboardController extends Controller
{
    use RedirectNotify;

    public function index()
    {
        $activityLogs = Activity::select('id', 'description', 'subject_type', 'causer_id')->take(5)->get();

        $doctorSum = Doctor::count();
        $latestDoctor = Doctor::select('created_at')->latest()->first();

        $userSum = User ::count();

        $surgeries = Surgery::select('id', 'created_at')->latest()->take(10)->get();

        $invoices = Invoice::select('amount')->get();
        $invoiceSum = 0;
        foreach($invoices as $invoice) {
            $invoiceSum += intval($invoice->amount);
        }

        $amountsArray = [];
        $datesArray = [];
        foreach($surgeries as $surgery) {
            $amountsArray[] = $surgery->getTotalPrice();

            $formattedDate = '20' . Carbon::parse($surgery->created_at)->format('y-m-d');
            $datesArray[] = $formattedDate;
        }

        $jsonAmount = json_encode($amountsArray);
        $jsonDate = json_encode($datesArray );

        $payments = Payment::select('id', 'amount', 'pay_type', 'created_at')->take(5)->get();

        return view('admin.dashboard')->with([
            'activityLogs' => $activityLogs,

            'amount' => $jsonAmount,
            'date' => $jsonDate,

            'userSum' => $userSum,

            'doctorSum' => $doctorSum,
            'latestDoctor' => $latestDoctor,

            'invoiceSum' => $invoiceSum,

            'payments' => $payments,
        ]);
    }
}
