<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Texted;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Mail\OrderMailer;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class MainController extends Controller
{
    public function index(){
        $sets = Product::where('category_id','=',2)->get();
        $products = Product::where('category_id','=',1)->get();
        $textes = Texted::where('id','=',1)->first();
        return view('main',['sets'=>$sets,'products'=>$products,'textes'=>$textes]);
    }
    public function endOrder(){
        return view('order');
    }
    public function product($id){
        $product=Product::where('id','=',$id)->first();
        return view('product',['product'=>$product]);
    }

    public function order(Request $request)
    {

        if($request['payment1']){
           $payment = "Наличные";
        } elseif ($request['payment2']){
            $payment = "Карта";
        } else {
            $payment = "Счёт организации";
        }
        $order=new Order([
            'peoples'=>$request['count'],
            'name'=>$request['name'],
            'phone'=>$request['phone'],
            'address'=> $request['address'],
            'date'=> $request['date'],
            'email'=> $request['email'],
            'comm'=> $request['comm'],
            'price'=> $request['price'],
            'payment'=> $payment,
        ]);
        $prods=array();
        $order->save();
        foreach ($request['data'] as $key=>$value){

            $order->products()->attach($key, ['count'=>$value[2]]);
            array_push($prods, $value[0]." ".$value[2]." Шт.");
        }

        $data = [
            'peoples'=>(string)$request['count'],
            'name'=>(string)$request['name'],
            'phone'=>(string)$request['phone'],
            'address'=> (string)$request['address'],
            'date'=> (string)$request['date'],
            'email'=> (string)$request['email'],
            'comm'=> (string)$request['comm'],
            'price'=> (string)$request['price'],
            'payment'=> (string)$payment,
            'prods' =>$prods,
        ];
        Mail::to('nikita-mokin@mail.ru')->send(new OrderMailer($data));


        if($request['payment1']){
        return redirect()->to('/');
        } elseif ($request['payment2']){
            return redirect()->to('/cardpay');
        } else {
            return redirect()->to('/');
        }

    }
    public function cardpay()
    {
        $order=Order::orderBy('id','DESC')->first();
        return view('cardpay',['payment'=>$order->price]);
    }

}
