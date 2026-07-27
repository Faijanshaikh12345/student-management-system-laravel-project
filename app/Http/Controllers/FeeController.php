<?php

namespace App\Http\Controllers;

use App\Models\Fee;
use App\Models\FeePayment;
use App\Models\Student;
use Illuminate\Http\Request;

class FeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $fees = Fee::with('student')->get();
        return view('manage_fees', compact('fees'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $students = Student::all();
        return view('create_fee', compact('students'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'student_id' => 'required',
            'amount_paid' => 'required|numeric',
            'payment_date' => 'required|date',
            'payment_mode' => 'required'
        ]);

        $receipt = 'RCPT-' . time();

        // 1️⃣ Save payment history
        FeePayment::create([
            'student_id' => $request->student_id,
            'amount_paid' => $request->amount_paid,
            'payment_date' => $request->payment_date,
            'payment_mode' => $request->payment_mode,
            'receipt_no' => $receipt,
        ]);

        // 2️⃣ Get or create fee summary
        $fee = Fee::firstOrCreate(
            ['student_id' => $request->student_id],
            [
                'total_fees' => 25000, // set your default class fee here
                'paid_amount' => 0,
                'due_amount' => 20000,
                'payment_date'     => now()->toDateString(),
                'last_payment_date' => now()->toDateString(),
            ]
        );

        // 3️⃣ Update summary
        $fee->paid_amount += $request->amount_paid;
        $fee->due_amount = $fee->total_fees - $fee->paid_amount;
        $fee->last_payment_date = $request->payment_date;
        $fee->save();

        return redirect()->route('fees.create')->with('success', 'Fee Collected Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $student = Student::findOrFail($id);

        $payments = FeePayment::where('student_id', $id)
            ->orderBy('payment_date', 'desc')
            ->get();

        return view('show_student_payment', compact('student', 'payments'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id) {}

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id) {}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $payment = FeePayment::findOrFail($id);
        $studentId = $payment->student_id;

        // 1. Delete payment
        $payment->delete();

        // 2. Recalculate totals from remaining payments
        $totalPaid = FeePayment::where('student_id', $studentId)->sum('amount_paid');

        $fee = Fee::where('student_id', $studentId)->first();

        if ($fee) {
            $fee->paid_amount = $totalPaid;
            $fee->due_amount = $fee->total_fees - $totalPaid;

            // 3. Update last payment date
            $lastPayment = FeePayment::where('student_id', $studentId)
                ->latest('payment_date')
                ->first();

            $fee->last_payment_date = $lastPayment ? $lastPayment->payment_date : null;
            $fee->save();
        }

        return redirect()->route('fees.index')->with('success', 'Payment deleted successfully');
    }
}
