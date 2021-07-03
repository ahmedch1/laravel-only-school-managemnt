<?php

namespace App\Http\Controllers;

use App\Parents;
use App\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $payment = Payment::latest()->paginate(10);

        return view('backend.payment.index', compact('payment'));
    }

/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function Pindex()
    {
        $payments = Payment::where("user_id", "=", Auth::id())->get();
        return view('backend.payment.index', compact('payments'));
    }

    public function Pcheck(Payment $payment)
    {
        $payment->state = true;
        $payment->save();
            
        return redirect()->route('payment.parent')
            ->with('success', 'Your Payment proceded successfully');
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $payment = Payment::latest()->paginate(10);
        $parents = Parents::latest()->get();

        return view('backend.payment.create', compact('payment', 'parents'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Payment $payment
     * @return \Illuminate\Http\Response
     */
    public function edit(Payment $payment)
    {
        $parents = Parents::latest()->get();

        return view('backend.payment.edit', compact('payment', 'parents'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Payment $payment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Payment $payment)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'amount'=>'required',
            'description'=>'required'

        ]);

        $payment->update([
            'name' => $request->name,
            'amount'=>$request->amount,
            'description'=>$request->description
        ]);

        return redirect()->route('payment.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'amount' => 'required|string|max:255',
            'description' => 'string'
        ]);

        $payment = new Payment();
        $payment->user_id = $request->input('user_id');
        $payment->amount = $request->input('amount');
        $payment->description = $request->input('description');
        $payment->state = false;

        $payment->save();


        return redirect()->route('payment.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Payment $payment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Payment $payment)
    {
        $payment->delete();

        return back();
    }
}
