<?php

namespace App\Http\Controllers;

//use App\Http\Resources\OrderResource;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\OrderResource;
use App\Http\Resources\OrderCollection;
use App\Models\User;



class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::all();
        return new OrderCollection($orders);
    }


    public function userOrder($user)
{
    $orders=Order::get()->where('user_id',$user);
    return new OrderCollection($orders);
}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'product_id' => 'required|exists:products,id',
            'order_date' => 'required|date',
        ]);

        $order = new Order();
        $order->user_id = $request->user_id;
        $order->product_id = $request->product_id;
        $order->order_date = $request->order_date;
        $order->save();

        return response()->json(['message' => 'Narudžba je uspješno spremljena'], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show($order_id)
    {
        $order = Order::find($order_id);
        if (is_null($order)) {
            return response()->json('Order not found', 404);
        }
        return new OrderResource($order);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
   

    public function update(Request $request, Order $order)
{
    $validatedData = $request->validate([
        'user_id' => 'required|integer',
        'product_id' => 'required|integer',
        'order_date' => 'required|date'
    ]);

    $order->update($validatedData);

    return response()->json(['Reservation is updated successfully.', new OrderResource($order)]);

}


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        $order->delete();

        return response()->json('Order was deleted');
    }
}
