<?php

namespace App\Http\Controllers;

use App\Pic;
use Auth;
use Illuminate\Http\Request;

class PicController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

       switch(request('sort')){
            case 'oldest':
                $pics = Pic::oldest()->paginate(15);
                break;
            
            case 'latest':
                $pics = Pic::latest()->paginate(15);       
                break;

            case 'randomorder':
                $pics = Pic::inRandomOrder()->paginate(15);       
                break;

            default:
                $pics = Pic::latest()->paginate(15);
                break;
        }
         return view('index',['pics'=>$pics]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pics.upload');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
  	    $img = $request->file('file');
		$imgNewName = time().$img->getClientOriginalName();
		$img->move('uploads', $imgNewName);
		$pic = new Pic();
		$pic->picimg = 'uploads/'.$imgNewName;
		$pic->save();
		
        if($pic->save()){
            return response()->json('success',200);
        }else{
            return response()->json('error',400);
        }
    }
		

    /**
     * Display the specified resource.
     *
     * @param  \App\Pic  $pic
     * @return \Illuminate\Http\Response
     */
    public function show(Pic $pic)
    {
        return view('pics.show',['pic'=>Pic::findOrFail($pic->id),
                                'randPics'=>Pic::latest()->take(4)->get()]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Pic  $pic
     * @return \Illuminate\Http\Response
     */
    public function randompic()
    { 
        $pic = Pic::all();
        return view('pics.show',['pic'=>$pic->random(),
                                'randPics'=>Pic::latest()->take(4)->get()]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Pic  $pic
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pic $pic)
    {
        $pic=Pic::findOrFail($pic->id);
        $pic->delete();
        return redirect()->route('');
    }
}
