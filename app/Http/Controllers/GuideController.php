<?php

namespace App\Http\Controllers;

use App\Guide;
use Storage;
use Illuminate\Http\Request;

class GuideController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('guides.index', [
            'guides' => Guide::latest()->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('guides.create');
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
            'title' => 'required',
            'byline' => 'required',
            'description' => 'required',
            'guide' => 'required|mimes:pdf'
            ]);
    
        // If there is an uploaded file extract name and path
        if($request->file())
        {
            $guidePath = $request->file('guide');
            $guideName = $guidePath->getClientOriginalName(); // time().'_'.$request->file->getClientOriginalName()
            // Store the file and save the returned path as $path
            $path = Storage::putFile('guides',$guidePath,'public');
        }

        Guide::create([
            'title' => request('title'),
            'byline' => request('byline'),
            'description' => request('description'),
            'file_name' => $guideName,
            'file_path' => $path,
        ]);
     
        return redirect()
            ->route('guides.index')
            ->with('success',"$guideName has been uploaded.");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Guide  $guide
     * @return \Illuminate\Http\Response
     */
    public function show(Guide $guide)
    {
        return view('guides.show', [
            'guide' => $guide,
        ]);
    }
    
    /**
     * Display the specified resource.
     *
     * @param  \App\Guide  $guide
     * @return \Illuminate\Http\Response
     */
    public function download(Guide $guide)
    {
        return Storage::download($guide->file_path,$guide->file_name);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Guide  $guide
     * @return \Illuminate\Http\Response
     */
    public function edit(Guide $guide)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Guide  $guide
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Guide $guide)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Guide  $guide
     * @return \Illuminate\Http\Response
     */
    public function destroy(Guide $guide)
    {
        Storage::delete($guide->file_path);
        $guidename = $guide->name;
        $guide->delete();
        return redirect()
            ->route('guides.index')
            ->with('success',"$guidename deleted successfully");
    }
}
