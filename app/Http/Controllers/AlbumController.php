<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AlbumController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $store = new Photo;
        $store->url = $request->file('url')->hashName();
        $request->file('url')->storePublicly('img/', 'public');
        $store->save();

        $newEntry = new Album;
        $newEntry->name = $request->name;
        $newEntry->author = $request->author;
        $newEntry->photo_id = $store->id;
        $newEntry->save();
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function show(Album $album)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $imgID = Album::find($id);
        $edit = Photo::find($imgID->photo_id);
        return view('pages.edit', compact('edit'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {
        $imgID = Album::find($id);
        $edit = Photo::find($imgID->photo_id);
        Storage::disk('public')->delete('img/'.$edit->url);
        $request->file('url')->storePublicly('img/', 'public');
        $edit->url = $request->file('url')->hashName();
        $edit->save();
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $destroy = Album::find($id);
        $imgID = $destroy->photo_id;
        $destroyImg = Photo::find($imgID);
        Storage::disk('public')->delete('img/'.$destroyImg->url);
        $destroy->delete();
        $destroyImg->delete();
        return redirect()->back();
    }
}
