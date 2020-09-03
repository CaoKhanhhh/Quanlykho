<?php

namespace App\Http\Controllers\Admin;

use App\Stock_detail;
use Illuminate\Http\Request;
use App\Product;
use App\Product_detail;
use App\Stock;
use App\User;
use App\Http\Controllers\Controller;

class StockController extends Controller
{
    public function viewStock(Request $request){
        $stock=Stock::all();
        $product_detail=Product_detail::where('id_stock','=',$request->id)
            ->join('product','id_product','=','product.id')
            ->select('product_detail.*','product.*')
            ->orderBy('product.id','asc')->paginate(5);
        $user=Stock::where('stock.id','=',$request->id)
            ->join('users','users.id','=','stock.id_users')->get();
        if($request->id){
            return view('admin.product')->with(['product' => $product_detail,'stock' => $stock]);
        }
        if($request->user){
            $user=Stock::where('stock.id','=',$request->user)
                ->join('users','users.id','=','stock.id_users')->get();
            return view('admin.selectQuankho')->with(['user'=> $user]);
        }
        if(!$request->id){
            $request->id=1;
            $product_detail=Product_detail::where('id_stock','=',$request->id)
                ->join('product','id_product','=','product.id')
                ->select('product_detail.*','product.*')
                ->orderBy('product.id','asc')
                ->paginate(5);
            $user=Stock::where('stock.id','=',$request->id)
                ->join('users','users.id','=','stock.id_users')->get();
            return view('admin.kho_view')->with(['product' => $product_detail,'stock' => $stock,'user'=> $user]);
        }

    }
    public function addStock(Request $request){
        $stock=new Stock();
        $stock->name=$request->stock_name;
        $stock->id_users=$request->user_assign;
        $stock->save();
        return redirect()->route('kho.view');
    }
    public function getUser(Request $request){
        return view('admin.form_assignQuankho');
    }
}
