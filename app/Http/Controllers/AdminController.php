<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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

    public function products()
    {
        $products = Product::get();
        $categories = Category::get();
        return view('admin.products', compact('products', 'categories'));
    }

    public function product(Product $product)
    {
        $categories = Category::get();
        return view('admin.product', compact('product', 'categories'));
    }

    public function productEdit(Product $product, Request $r)
    {
        $valid = Validator::make($r->all(),
            [
            'name' => 'required',
            'desc' => 'required',
            'year' => 'required',
            'country' => 'required',
            'price' => 'required',
            'count' => 'required',
            'category_id' => 'required'
            ],
            [
            'name.required' => 'Вы не указали название товара',
            'desc.required' => 'Вы не указали описание товара',
            'year.required' => 'Вы не указали год выпуска товара',
            'country.required' => 'Вы не указали страну выпуска товара',
            'price.required' => 'Вы не указали цену товара',
            'count.required' => 'Вы не указали кол-во товара',
            'category_id.required' => 'Вы не указали категорию товара'
            ]
        );

        $errors = $valid->errors();

        if ($valid->fails()) {
            return back()->with('error', $errors->first());
        }

        $product->update([
            'name' => $r->name,
            'desc' => $r->desc,
            'year' => $r->year,
            'country' => $r->country,
            'price' => $r->price,
            'count' => $r->count,
            'category_id' => $r->category_id,
        ]);

        if($r->file('image')){
            $old = public_path().'/assets/images/products/'.$product->image;
            if($old) {
                unlink($old);
            }

            $imageName = $r->file('image')->getClientOriginalName();
            $r->file('image')->move(public_path('assets/images/products'), $imageName);
            $product->update([
                'image' => $imageName
            ]);
        }

        return to_route('admin.products')->with('success', 'Товар отредактирован');
    }

    public function productNew(Request $r)
    {
        $valid = Validator::make($r->all(),
            [
            'name' => 'required',
            'desc' => 'required',
            'year' => 'required',
            'country' => 'required',
            'price' => 'required',
            'count' => 'required',
            'category_id' => 'required',
            'image' => 'required'
            ],
            [
            'name.required' => 'Вы не указали название товара',
            'desc.required' => 'Вы не указали описание товара',
            'year.required' => 'Вы не указали год выпуска товара',
            'country.required' => 'Вы не указали страну выпуска товара',
            'price.required' => 'Вы не указали цену товара',
            'count.required' => 'Вы не указали кол-во товара',
            'category_id.required' => 'Вы не указали категорию товара'
            ]
        );

        $errors = $valid->errors();

        if ($valid->fails()) {
            return back()->with('error', $errors->first());
        }

        $imageName = $r->file('image')->getClientOriginalName();
        $r->file('image')->move(public_path('assets/images/products'), $imageName);

        Product::create([
            'name' => $r->name,
            'desc' => $r->desc,
            'image' => $imageName,
            'year' => $r->year,
            'country' => $r->country,
            'price' => $r->price,
            'count' => $r->count,
            'category_id' => $r->category_id
        ]);

        return back()->with('success', 'Товар добавлен');
    }

    public function productDelete(Product $product)
    {
        $old = public_path('assets/images/products/'.$product->image);
        if($old) {
            unlink($old);
        }

        foreach(Cart::where('product_id', $product->id)->get() as $item) {
            $item->delete();
        }
        
        $product->delete();
        return back()->with('success', 'Товар удалён');
    }
}
