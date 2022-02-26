<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function city()
    {

        //$data= $request->all();
        //return dd($data);
        $data= City::distinct()->get(['governorate']);
        //distinct('governorate')->get();
        $response=[
            'data'=>$data,
            'error'=>'test'
        ];
        return response($response,200);


        //return Product::paginate(4);
        //return Product::all();


    }
    public function findcity($gov)
    {
        $data= City::where('governorate',$gov)->get();
        $response=[
            'data'=>$data,
            'error'=>'test'
        ];
        return response($response,200);



    }



    public function index()
    {

        //$data= $request->all();
        //return dd($data);
        $data= Product::all();
        $response=[
            'data'=>$data,
            'error'=>'test'
        ];
        return response($response,200);

        //return Product::paginate(4);
        //return Product::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=> 'required',
            'slug'=> 'required',
            'price'=> 'required',
        ]);
        return Product::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Product::find($id);
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
        $product = Product::find($id);
        $product->update($request->all());
        return $product;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return Product::destroy($id);
    }
    /**
     * Search For name.
     *
     * @param  str  $name
     * @return \Illuminate\Http\Response
     */

    /*
    public function search($name,$price)
    {
        return Product::where('name','like','%'.$name.'%')->where('price',$price)->get();
    }
    */

    //public function search($name,$price)
    //{
        //dd($request->all());
        /*
        if ($request->has('name')&& $request->has('price')){
            return Product::where('name','like','%'.$request->input('name').'%')->where('price',$request->input('price'))->get();
        }
        */
     //   return Product::where('name','like','%'.$name.'%')->where('price',$price)->get();
    //}

    /*
    public function search_product(Request $request){
        //return 'hello';

        if ($request->has('name')){

            if($request->has('price'))
            {
                return Product::where('name','like','%'.$request['name'].'%')->where('price',$request['price'])->get();
            }
            else
            {
                return Product::where('name','like','%'.$request['name'].'%')->get();
            }
        }
        elseif ($request->has('price'))
        {
            return Product::where('price',$request['price'])->get();
        }
        else
        {
            return 'Choose Any Thing';
        }




        //return $request['test'];
        //$query=Product::query();
        //$data = $request->input('product');

        //if ($data){
          //  return Product::where('name','like','%'.$data.'%')->get();
            //$query->whereRaw("id LIKE '%".$data."%'");
        //}
        //return $query->get();

    }
    */

    public function search_product(Request $request){
        //return 'hello';

        if ($request->has('name')){

            if($request->has('max')&& $request->has('min'))
            {
                $data = Product::where('name','like','%'.$request['name'].'%')->whereBetween('price',[$request['min'],$request['max']])->get();
                $response=[
                    'data'=>$data,
                    'error'=>''
                ];
                return response($response,201);
            }
            else
            {
                $data = Product::where('name','like','%'.$request['name'].'%')->get();
                $response=[
                    'data'=>$data,
                    'error'=>''
                ];
                return response($response,201);
            }
        }
        elseif ($request->has('max')&& $request->has('min'))
        {
            $data = Product::whereBetween('price',[$request['min'],$request['max']])->get();
            $response=[
                'data'=>$data,
                'error'=>''
            ];
            return response($response,201);
        }
        else
        {
            $response=[
                'data'=>'',
                'error'=>'You Missed Search '
            ];
            return response($response,400);
        }
    }
}
