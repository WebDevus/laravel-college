<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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

        if(!is_null($category)) {
            $query->where('category_id', $category);
        }

        if(!is_null($r->sort)) {
            if($r->sort == 'yearASC') {
                $query->orderBy('year', 'asc');
            }

            if($r->sort == 'yearDESC') {
                $query->orderBy('year', 'desc');
            }

            if($r->sort == 'nameASC') {
                $query->orderBy('name', 'asc');
            }

            if($r->sort == 'nameDESC') {
                $query->orderBy('name', 'desc');
            }

            if($r->sort == 'priceASC') {
                $query->orderBy('price', 'asc');
            }

            if($r->sort == 'priceDESC') {
                $query->orderBy('price', 'desc');
            }
        }

        $products = $query->where('count', '!=', 0)->get();

        return view('catalog', compact('products', 'categories'));
    }

    public function product(Product $product)
    {
        return view('product', compact('product'));
    }
    
    public function cart()
    {
        $carts = Cart::where('user_id', auth()->user()->id)->where('status', 0)->orderBy('id', 'desc')->get();
        $orders = Cart::where('user_id', auth()->user()->id)->where('status', '!=', 0)->get();
        return view('cart', compact('carts', 'orders'));
    }

    public function addToCart(Request $r)
    {
        $product = $r->id;
        $productFind = Product::find($product);

        $cart = Cart::where('user_id', auth()->user()->id)->where('product_id', $product)->where('status', '<=', 0)->first();

        if($cart) {
            if($cart->count >= $productFind->count) {
                return response()->json([
                    'success' => false,
                    'message' => 'Нет такого количества'
                ]);
            };

            $cart->increment('count', 1);
            $cart->update();

            return response()->json([
                'success' => true,
                'message' => 'Товар добавлен в корзину'
            ]);
        }

        if(!$cart) {
            Cart::create([
                'product_id' => $product,
                'user_id' => auth()->user()->id,
                'count' => 1
            ]);
            return response()->json([
                'success' => true,
                'message' => 'Товар добавлен в корзину'
            ]);
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

        if(!Hash::check($password, auth()->user()->password)) {
            return response()->json([
                'success' => false,
                'message' => 'Вы указали неверный пароль'
            ]);
        };

        $cart = Cart::where('user_id', auth()->user()->id)->get();

        foreach($cart as $c) {
            $c->status = 1;
            $c->update();
        }

        return response()->json([
            'success' => true,
            'message' => 'Заказ был оформлен'
        ]);
    }

    public function orderDelete($id)
    {
        Cart::destroy($id);

        return back()->with('success', 'Заказ был удалён');
    }
}
