<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
define("PAGINATON",1);

class JobController extends Controller
{

    protected function checkOrder(Request $request, $id)
    {
        if ($request->input('select') == "NewestToOldest") {
            $new = Job::where('id', $id)->latest()->paginate(PAGINATON);
            return $new;
        }
        if ($request->input('select') == "OldestToNewest") {
            $old = Job::where('id', $id)->oldest()->paginate(PAGINATON);
            return $old;
        }
        return null;
    }

    public function indexMainPage() {
        $jobs = DB::table('jobs')->limit(4);
        $jobs = $jobs->get();
        $array = [
            'jobs' => $jobs
        ];
        return view('mainpage',['array' => $array]); 
    } 


    public function indexSearch(Request $request) {
        $search = $request->input('search');
        $result = DB::table('jobs')->where('name', 'like', '%' . $search . '%');
        return view('catalogue/displaySearch')->with('abc', $result->paginate(PAGINATON)); //paginaçao nao está a funcionar aq
    }

    /*
    public function addToCart($id) {
        $product = Product::findorFail($id);
        $cart = session()->get('shoppingCart'); //ir buscar á sessão o nosso carinho
        if ($product->stock > 0) {
            if (!$cart) { //se carrinho não existir criar [3] => quantidade
                $cart = [$id => [0 => $product->picture, 1 => $product->name, 2 => $product->price, 3 => 1, 4 => $product->id]];
                session()->put('shoppingCart', $cart); // guardar o carrinho na pos shoppingCart da sessao
                return redirect()->back()->with('sucess', 'Added to Cart Sucessfully!');
            }
            if (!empty($cart[$id])) { // se produto existir no carrinho aumentar a quantidade
                $cart[$id][3]++;
                session()->put('shoppingCart', $cart);
                return redirect()->back()->with('sucess', 'Added to Cart Sucessfully!');
            }
            // se não existir o item adiciona-lo ao carrinho com quantide 1
            $cart[$id] = [0 => $product->picture, 1 => $product->name, 2 => $product->price, 3 => 1, 4 => $product->id];
            session()->put('shoppingCart', $cart);
            return redirect()->back()->with('sucess', 'Added to Cart Sucessfully!');
        } else {
            return redirect()->back()->with('error', 'No Stock');
        }
        //stock --; qnd adicionado qnd removido --;
    }

    public function removeFromCart(Request $request)
    {
        if ($request->idRemove) {
            $cart = session()->get('shoppingCart');
            if (isset($cart[$request->idRemove])) {
                unset($cart[$request->idRemove]);
                session()->put('shoppingCart', $cart);
            }
            session()->flash('sucess', 'Removed from Cart Sucessfully!');
            return redirect('account/shoppingCart');
        }
    }

    public function updateCart(Request $request)
    {
        if ($request->idSub && $request->quantityProd && $request->quantityProd > 0) {
            $cart = session()->get('shoppingCart');
            $cart[$request->idSub][3] = $request->quantityProd; //alterar a quantidade
            session()->put('shoppingCart', $cart);
        }
        session()->flash('sucess', 'Updated Cart Sucessfully!');
        return redirect('account/shoppingCart');
    }
*/
         
}