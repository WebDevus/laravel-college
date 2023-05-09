<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(Request $r)
    {
        $status = $r->status;
        $query = Cart::query()->where('status', '>=', 1);

        $query->when($status, function($query) use ($r) {
            $query->where('status', $r->status);
        });

        $orders = $query->get();
        return view('admin.index', compact('orders'));
    }

    public function acceptOrder($id)
    {
        $order = Cart::find($id);

        $order->update([
            'status' => 2
        ]);

        return back()->with('success', 'Заказ подтвёрждён');
    }

    public function cancelOrder(Request $r)
    {
        $id = $r->order;
        $order = Cart::find($id);

        if(!$r->reason) return back()->with('error', 'Вы не указали причину отказа');

        $order->update([
            'status' => 3,
            'reason' => $r->reason
        ]);

        return back()->with('success', 'Заказ отменён');
    }
}
