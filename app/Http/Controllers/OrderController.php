<?php

namespace App\Http\Controllers;

use App\Http\Resources\OrderCollection;
use App\Http\Resources\OrderResource;
use App\Models\Order;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return new OrderCollection(Order::all());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOrderRequest $request)
    {
        $order = new Order();
        $order->order_date = now();
        $order->user_id = $request->user_id;
        $order->total_price = $request->total_price;
        $order->save();

        return new OrderResource($order);
    }

    /**
     * Display the specified resource.
     */
    public function show($order_id)
    {
        if ($order = Order::where('order_id', $order_id)->first()) {
            return new OrderResource($order);
        }else{
            return response()->json(['message' => 'Order not found'], 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOrderRequest $request, $order_id)
    {
        if ($order = Order::where('order_id', $order_id)->first()) {
            $order->update($request->all());
            return new OrderResource($order);
        }else{
            return response()->json(['message' => 'Order not found'], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($order_id)
    {
        if ($order = Order::where('order_id', $order_id)->first()) {
            $order->delete();
            return response()->json(['message' => 'Order deleted'], 200);
        }else{
            return response()->json(['message' => 'Order not found'], 404);
        }
    }
}
