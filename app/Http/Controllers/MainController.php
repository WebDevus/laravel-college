<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function contacts()
    {
        return view('contacts');
    }

    public function catalog(Request $r)
    {
        $categories = Category::get();

        $year = $r->year;
        $name = $r->name;
        $category = $r->category;

        $query = Product::query();

        $query->when($year, function ($query) use ($r) {
            $query->where('year', $r->year);
        })
        ->when($name, function($query) use ($r) {
            $query->where('name', 'LIKE', '%'.$r->name.'%');
        })
        ->when($category, function($query) use ($r) {
            $query->where('category_id', $r->category);
        });

        $products = $query->get();

        return view('catalog', compact('products', 'categories'));
    }

    public function product(Product $product)
    {
        return view('product', compact('product'));
    }
    
    public function cart()
    {
        $carts = Cart::where('user_id', auth()->user()->id)->where('status', 0)->get();
        return view('cart', compact('carts'));
    }

    public function addToCart(Request $r)
    {
        $product = $r->id;
        $productFind = Product::find($product);

        $cart = Cart::where('user_id', auth()->user()->id)->where('product_id', $product)->where('status', '<=', 0)->first();

        if($cart) {
            if($cart->count > $productFind->count) return back()->with('error', 'Нет такого количества');
            $cart->increment('count', 1);
            $cart->update();

            return back()->with('success', 'Товар добавлен в корзину');
        }

        if(!$cart) {
            Cart::create([
                'product_id' => $product,
                'user_id' => auth()->user()->id,
                'count' => 1
            ]);
            return back()->with('success', 'Товар добавлен в корзину');
        }
    }

    public function removeFromCart(Request $r)
    {
        $cart = Cart::find($r->id);
        $cart->decrement('count', 1);
        
        if($cart->count < 1) {
            $cart->delete();
        }

        return back()->with('success', 'Товар убран');
    }

    public function deleteFromCart(Request $r)
    {
        $id = $r->id;
        Cart::destroy($id);

        return back()->with('success', 'Товар удалён из корзины');
    }

    public function cartNext(Request $r)
    {
        $password = $r->password;

        if(auth()->user()->password != $password) return back()->with('error', 'Вы указали неверный пароль');

        $cart = Cart::where('user_id', auth()->user()->id)->get();

        foreach($cart as $c) {
            $c->status = 1;
            $c->update();
        }

        return back()->with('Ваш заказ оформлен');
    }
}
