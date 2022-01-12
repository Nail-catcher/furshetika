<?php

namespace App\Http\Controllers;

use App\Models\AltOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

use App\Mail\AltOrderMailer;
class AltOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('altorder');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $alt_order = new AltOrder();
        $alt_order->fill($request->all());
        $alt_order->save();
        $phone = preg_replace("/[^.0-9]/", '', $request['phone']);
        $data = [
            'peoples'=>(string)$request['peoples'],
            'name'=>(string)$request['name'],
            'phone'=>(string)$phone,
            'address'=> (string)$request['address'],
            'date'=> (string)$request['date'],
            'email'=> (string)$request['email'],
            'menu'=> (string)$request['menu'],
            'event'=> (string)$request['event'],
            'comm'=> (string)$request['comm'],
        ];
        //,'89884602288@mail.ru'
        Mail::to(['nikita-mokin@mail.ru','89884602288@mail.ru'])->send(new AltOrderMailer($data));
        return redirect()->to('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
