<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $table = new Payment();
        $table->title = $request->title;
        $table->amount = $request->amount;
        $table->date = $request->date;
        $table->status = $request->status;
        $table->task_id = $request->task_id;
        $table->save();
        return redirect()->back();
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Payment $payment)
    {
        $payment->title = $request->title;
        $payment->amount = $request->amount;
        $payment->status = $request->status;
        if($request->date){
            $payment->date = $request->date;
        }
        $payment->save();
        return redirect()->back();
    }

    public function paid(Payment $payment){
        $payment->status = 'paid';
        $payment->save();
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Payment $payment)
    {
        $payment->delete();
        return redirect()->back();
    }
}
