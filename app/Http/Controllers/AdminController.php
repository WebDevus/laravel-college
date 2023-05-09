<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Category;
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

    public function categories()
    {
        $categories = Category::get();
        return view('admin.categories', compact('categories'));
    }

    public function categoriesCreate(Request $r)
    {
        $name = $r->category;

        if(!$name) return back()->with('error', 'Вы не указали название категории');

        Category::create([
            'name' => $name
        ]);

        return back()->with('success', 'Категория добавлена');
    }

    public function categoriesDelete($id)
    {
        Category::destroy($id);

        return back()->with('success', 'Категория удалена');
    }
}
