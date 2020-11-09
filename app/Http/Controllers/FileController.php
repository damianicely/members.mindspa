<?php

namespace App\Http\Controllers;

use App\File;
use Illuminate\Http\Request;

class FileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function index()
    {
        return view('files.index', [
            'files' => File::latest()->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function upload()
    {
        return view('files.upload');
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
            'file' => 'required|mimes:png,txt,xlx,xls,pdf|max:2048'
            ]);
    
        // If there is an uploaded file extract name and path
        if($request->file())
        {
            $filePath = $request->file('file');
            $fileName = $filePath->getClientOriginalName(); // time().'_'.$request->file->getClientOriginalName()
            // Store the file and save the returned path as $path
            $path = $request->file('file')->storeAs('uploads', $fileName, 'public');
        }

        $newfile = new File;

        $newfile->name = time().'_'.$request->file('file')->getClientOriginalName();
        $newfile->file_path = '/storage/'.$path;
        $newfile->save();
    
        return back()
            ->with('success','File has been uploaded.')
            ->with('File', $fileName);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\File  $file
     * @return \Illuminate\Http\Response
     */
    public function show(File $file)
    {
            return view('files.show', [
            'file' => $file,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\File  $file
     * @return \Illuminate\Http\Response
     */
    public function edit(File $file)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\File  $file
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, File $file)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\File  $file
     * @return \Illuminate\Http\Response
     */
    public function destroy(File $file)
    {
        $filename= $file->name;
        $file->delete();
        return redirect()
            ->route('files.index')
            ->with('success',"$filename deleted successfully");
    }
}