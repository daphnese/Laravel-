<?php

namespace App\Http\Controllers;

use App\Http\Resources\OrderProductCollection;
use App\Http\Resources\OrderProductResource;
use App\Models\OrderProduct;
use App\Http\Requests\StoreOrderProductRequest;
use App\Http\Requests\UpdateOrderProductRequest;

class OrderProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return new OrderProductCollection(OrderProduct::all());
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
    public function store(StoreOrderProductRequest $request)
    {
        return new OrderProductResource(OrderProduct::create($request->all()));
    }

    /**
     * Display the specified resource.
     */
    public function show($order_product_id)
    {
        if ($orderProduct = OrderProduct::where('order_product_id', $order_product_id)->first()) {
            return new OrderProductResource($orderProduct);
        }else{
            return response()->json(['message' => 'Order Product not found'], 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(OrderProduct $orderProduct)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOrderProductRequest $request, $order_product_id)
    {
        if ($orderProduct = OrderProduct::where('order_product_id', $order_product_id)->first()) {
            $orderProduct->update($request->all());
            return new OrderProductResource($orderProduct);
        }else{
            return response()->json(['message' => 'Order Product not found'], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($order_product_id)
    {
        if ($orderProduct = OrderProduct::where('order_product_id', $order_product_id)->first()) {
            $orderProduct->delete();
            return response()->json(['message' => 'Order Product deleted'], 200);
        }else{
            return response()->json(['message' => 'Order Product not found'], 404);
        }
    }

    public function getTotalPrice($order_id)
    {
        if ($totalPrice = OrderProduct::where('order_id', $order_id)->sum('sub_total')) {
            return response()->json(['total_price' => $totalPrice], 200);
        }else{
            return response()->json(['message' => 'Order Product not found'], 404);
        }
    }

    public function getOrderProductByOrderId($order_id)
    {
        if ($orderProducts = OrderProduct::where('order_id', $order_id)->get()) {
            return new OrderProductCollection($orderProducts);
        }else{
            return response()->json(['message' => 'Order Product not found'], 404);
        }
    }
}
