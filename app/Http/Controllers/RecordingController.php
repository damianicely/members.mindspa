<?php

namespace App\Http\Controllers;

use App\Recording;
use Storage;
use Illuminate\Http\Request;

class RecordingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function index()
    {
        return view('recordings.index', [
            'recordings' => Recording::latest()->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('recordings.create');
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
            'recording' => 'required|mimes:mp3'
            ]);
    
        // If there is an uploaded file extract name and path
        if($request->file())
        {
            $recordingPath = $request->file('recording');
            $recordingName = $recordingPath->getClientOriginalName(); // time().'_'.$request->file->getClientOriginalName()
            // Store the file and save the returned path as $path
            $path = Storage::putFile('recordings',$recordingPath,'public');
        }

        Recording::create([
            'title' => request('title'),
            'byline' => request('byline'),
            'description' => request('description'),
            'file_name' => $recordingName,
            'file_path' => $path,
        ]);
     
        return redirect()
            ->route('recordings.index')
            ->with('success',"$recordingName has been uploaded.");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Recording  $recording
     * @return \Illuminate\Http\Response
     */
    public function show(Recording $recording)
    {
        return view('recordings.show', [
            'recording' => $recording,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Recording  $recording
     * @return \Illuminate\Http\Response
     */
    public function download(Recording $recording)
    {
        return Storage::download($recording->file_path,$recording->file_name);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Recording  $recording
     * @return \Illuminate\Http\Response
     */
    public function edit(Recording $recording)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Recording  $recording
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Recording $recording)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Recording  $recording
     * @return \Illuminate\Http\Response
     */
    public function destroy(Recording $recording)
    {
        Storage::delete($recording->file_path);
        $recordingname = $recording->name;
        $recording->delete();
        return redirect()
            ->route('recordings.index')
            ->with('success',"$recordingname deleted successfully");
    }
}
