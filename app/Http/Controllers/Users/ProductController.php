<?php

namespace App\Http\Controllers\Users;
use Pusher\Pusher;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Product;
use App\Product_detail;
use App\Stock;
use App\User;
use App\Events\Notify;
use App\Notifications\ProductRequest;
use App\Http\Requests\Add_ProductForm;
class ProductController extends Controller
{
    public function homepage($id){
        $user=User::find($id);
        $stock_user=Stock::where('id_users','=',$id)->get();
        return view('users.usersDetail')->with(['user' => $user,'stock_user'=> $stock_user]);
    }
    public function index($stock,$id){
        $stock_user=Stock::where('id_users','=',$id)->get();
        $user=User::find($id);
        $stock=Stock::find($stock);
//        return response()->json($stock);
        $product=Product_detail::where('id_stock','=',$stock->id)
            ->join('product','id_product','=','product.id')
            ->select('product_detail.*','product.*')
            ->orderBy('product.id','asc')->paginate(5);
        return view('users.homepage')->with(['stock' => $stock,'user' => $user, 'product' => $product,'stock_user'=> $stock_user]);
    }
    public function add ($stock,$id){
        $user=User::find($id);
        $stock=Stock::find($stock);
        $stock_user=Stock::where('id_users','=',$id)->get();
        if(!$user || !$stock_user || !$stock){
            return response()->json('Khong tim thay trang');
        }
        return view('users.product_add')->with(['user'=>$user,'stock_user' =>$stock_user,'stock'=>$stock]);
    }
    public function insertProduct(Add_ProductForm $request){
        $stock_insert=Stock::where('id','=',$request->stock)->first();
        $user=User::find($request->id);
        $stock_user=Stock::where('id_users','=',$request->id)->get();
        $product_detail=new Product_detail();
        $product_detail->number= $request->number;
        if($request->number ==0){
            $product_detail->status=0;
        }
        if($request->number !=0){
            $product_detail->status=1;
        }
        $product_detail->id_stock=$request->stock;
        $product_detail->save();

        $product= new Product();
        if($request->hasFile('image')){
            $filename=$request->name.".".$request->image->extension();
            $path=$request->image->move('img/product',$filename);
            $product->image=$path;
        }
        $product->name=$request->name;
        $product->price=$request->price;
        $product->save();
//        $data['stock']=$stock_insert->name;
//        $data['product']=$request->name;
//        $data['type']=1;
//        event(new Notify($data));
        return redirect()->route('product.index',['stock'=>$request->stock,'id'=>$request->id,'user'=>$user,'stock_user'=>$stock_user]);
    }
    public function deleteProduct($stock,$user_id,$id){
        $stock_delete=Stock::find($stock);
        $user=User::find($user_id);
        $stock_user=Stock::where('id_users','=',$user_id)->get();
        $product_detail=Product_detail::where('id_product','=',$id)
            ->where('id_stock','=',$stock)
            ->delete();
        $product=Product::find($id);
//        $data['stock']=$stock_delete->name;
//        $data['product']=$product->name;
//        $data['type']=3;
//        event(new Notify($data));
        return redirect()->route('product.index',['stock'=>$stock,'id'=>$stock_delete->id_users,'user'=>$user,'stock_user'=>$stock_user])->with('message','Xoá thành công');
    }
    public function editProduct($stock,$user_id,$id){
        $user=User::find($user_id);
        $stock_user=Stock::where('id_users','=',$user_id)->get();
        $product_detail=Product_detail::where('id_product','=',$id)
            ->where('id_stock','=',$stock)->join('product','id_product','=','product.id')
            ->select('product.*','product_detail.*')->first();
        if(!$user || !$stock_user || !$product_detail){
            return response()->json('Khong tim thay trang');
        }
        return view('users.product_edit')->with(['stock'=> $stock ,'id'=> $id,'product_detail'=>$product_detail,'user'=>$user,'stock_user'=>$stock_user]);
    }
    public function updateProduct(Request $request){
        $user=User::find($request->user_id);
        $stock_user=Stock::where('id_users','=',$request->user_id)->get();
        $stock_current=Stock::find($request->stock);
        $product_detail=Product_detail::where('id_product','=',$request->id)
            ->where('id_stock','=',$request->stock)->first();
        $product_detail->number=$request->number;
        if($request->number ==0){
            $product_detail->status= 0;
        }
        if($request->number !=0){
            $product_detail->status= 1;
        }
        $product_detail->save();

        $product=Product::find($request->id);
//        $data['stock']=$stock_current->name;
//        $data['product']=$product->name;
//        $data['type']=2;
//        event(new Notify($data));
        if($request->hasFile('image')){
            $filename=$request->name.".".$request->image->extension();
            $path=$request->image->move('img/product',$filename);
            $product->image=$path;
        }
        $product->name=$request->name;
        $product->price=$request->price;
        $product->save();
        return redirect()->route('product.index',['stock'=>$request->stock,'id'=>$request->user_id,'user'=>$user,'stock_user'=>$stock_user])->with('message','Thay đổi thành công');
    }

}
