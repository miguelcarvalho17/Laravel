<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\Product;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
define("PAGINATON",1);

class JobController extends Controller
{
    public function indexMainPage(Request $request) {
        /*
        $jobs = DB::table('jobs')->limit(4);
        $jobs = $jobs->get();
        $array = [
            'jobs' => $jobs
        ];
        return view('welcome',['array' => $array]);
        */

        $query = Job::query()
            ->where('is_active', true)
            ->latest();

        if ($request->has('s')) {
            $searchQuery = trim($request->get('s'));

            $query->where(function (Builder $builder) use ($searchQuery) {
                $builder
                    ->orWhere('title', 'like', "%{$searchQuery}%")
                    ->orWhere('company', 'like', "%{$searchQuery}%")
                    ->orWhere('location', 'like', "%{$searchQuery}%");
            });
        }

        $jobs = $query->get();

        return view('welcome', compact('jobs'));
    }

    public function show(Job $job)
    {
        return view('showJob', compact('job'));
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
