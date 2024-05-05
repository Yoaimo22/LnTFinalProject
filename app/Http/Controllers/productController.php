<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Carbon;

class productController extends Controller
{
    public function createProduct(){
        $categories = Category::all();

        return view('createProduct', [
            'title' => 'Add Product',
            'categories' => $categories
        ]);
    }

    public function store(Request $request){

        $request->validate([
            'name' => 'required|min:3|max:50',
            'category_id' => 'required|integer',
            'price' => 'required',
            'amount' => 'required',
            'image' => 'required|mimes:jpg,png'
        ]);

        $extension = $request->file('image')->getClientOriginalExtension();
        $filename = $request->name.'-'.$request->category_id.'.'.$extension;
        $request->file('image')->storeAs('/public/product_images', $filename);

        Product::create([
            'name' => $request->name,
            'category_id' =>$request->category_id,
            'price' => $request->price,
            'amount' => $request->amount,
            'image' => $filename
        ]);

        return redirect('/');
    }

    public function index(){
        $products = Product::all();

        return view('dashboard', [
            'title' => 'Dashboard',
            'products' => $products
        ]);
    }

    public function display(Product $product){
        return view('displayProduct', [
            'title' => 'Products Display',
            'product' => $product           
        ]);
    }

    public function delete(Product $product){
        $product->delete();
        return redirect('/dashboard');
    }

    public function edit(Product $product){
        return view('editProduct', [
            'title' => 'Edit Product',
            'product' => $product
        ]);
    }

    public function update(Product $product, Request $request){
        $request->validate([
            'name' => 'required|min:5|max:80',
            'amount' => 'required',
            'price' => 'required'
        ]);

        $product->update([
            'name' => $request->name,
            'amount' => $request->amount,
            'price' => $request->price
        ]);

        return redirect('/dashboard');
    }

    public function Addcart($id, Request $request)
    {
        $product = Product::findOrFail($id);
        $cart = session()->get('cart', []);

        $quantity = $request->input('amount', 1);
        $user = auth()->user();

        if ($user) {
            $userCart = json_decode($user->cart, true) ?? []; 
            $userCart[$id] = [
            "name" => $product->name,
            "qty" => $quantity,
            "price" => $product->price,
            "image" => $product->image
            ];
            $user->cart = json_encode($userCart); 
            $user->save();
        }

        if (isset($cart[$id])) {
            $cart[$id]['qty'] += $quantity;
        } else {
            $cart[$id] = [
                "name" => $product->name,
                "qty" => $quantity,
                "price" => $product->price,
                "image" => $product->image
            ];
        }
        session()->put('cart', $cart);
        return redirect()->back()->with('message', 'Product Added Successfully');
    }


    public function checkout(){
        $orderID = 'ORD' . Str::random(8);
        return view('checkout', [
            'title' => 'Checkout',
            'orderID' => $orderID
        ]);
    }

    public function Cart(){
        return view('viewCart', [
            'title' => 'Add To Cart'
        ]);
    }

    public function deleteProduct(Request $request){
        if($request->id){
            $cart = session()->get('cart');
            if(isset($cart[$request->id])){
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
            session()->flash('message', 'Product deleted');
        }
    }

    public function viewInvoice($orderId) {
        return view('generateInvoice', ['orderId' => $orderId]);
    }
    
    public function receipt($orderID){
        $cart = session('cart');

        foreach ($cart as $productId => $details) {
            $product = Product::findOrFail($productId);
            $newStock = $product->amount - $details['qty'];
            $product->amount = max(0, $newStock);
            $product->save();
        }

        // session()->forget('cart');

        $orderID = $orderID;
        return view('placeOrder', [
            'title'=>'Receipt',
            'orderID' => $orderID
        ]);
    }

    public function downloadInvoice($orderID){
        $data = [
            'orderId' => $orderID,
        ];   

        $time = Carbon::now()->format('Y-m-d');
        $pdf = Pdf::loadView('generateInvoice', $data);
        return $pdf->download('invoice'.$orderID.'-'.$time.'.pdf'); 
    }

    public function clearCart(Request $request)
    {
        $request->session()->forget('cart');
        return redirect('/')->with('success', 'Cart cleared successfully');
    }
}


