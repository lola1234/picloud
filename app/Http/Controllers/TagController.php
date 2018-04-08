<?php

namespace App\Http\Controllers;

use App\Tag;
use App\Pic;

use Illuminate\Http\Request;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('tags',['tags'=>Tag::latest()->paginate(10)]);
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
        $pic = Pic::findOrFail($request->pic);
		$tags = explode(",",$request->tags);
		$tagsIds = array();

		foreach($tags as $t){
            $t=trim(strtolower($t)); 
            
            //check if tag name already exist in the database
            $tagAlreadyExist=Tag::where('tag',$t)->first();
            //check if the picture already tagged with this tag name
            $picTaggedwithThistag = Pic::find($pic->id)->tags()->where('tag',$t)->first();
            
            if($tagAlreadyExist && !$picTaggedwithThistag){              
                array_push($tagsIds, $tagAlreadyExist->id);
            }
            //create a new tag model
            if(!$tagAlreadyExist){                            
     			$tag = Tag::create(['tag' => $t]);
    			array_push($tagsIds, $tag->id);
            }
		}

		$pic->tags()->attach($tagsIds);	
		return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tag=Tag::findOrFail($id);
        return view('index',['pics'=>$tag->pics()->latest()->paginate(10)]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $search=$request->search;    
        $tag=Tag::where('tag','LIKE', "%$search%")->first();
        return view('search')->with('pics', $tag->pics()->latest()->paginate(10))
                              ->with('title', $search);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tag $tag)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function detach($id,Pic $pic)
    {
        $pic->tags()->detach($id);
        return redirect()->back();
    }

     public function destroy($id)
    {
        $tag=Tag::find($id);
        $tag->pics()->detach($id);
        $tag->delete();
        return redirect()->back();
    }
}
