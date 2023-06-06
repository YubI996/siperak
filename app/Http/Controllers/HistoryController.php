<?php

namespace App\Http\Controllers;

use App\Models\History;
use App\Models\Recipient;
use App\Http\Requests\StoreHistoryRequest;
use App\Http\Requests\UpdateHistoryRequest;

class HistoryController extends Controller
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreHistoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreHistoryRequest $request)
    {
        $idrec = Recipient::where('slug', $request->slug)->value('id');
        $rec = Recipient::find($idrec);
        // dd($request->slug);
        $input[] = $request->all();
        $input= $input[0];
        unset($input["slug"]);
        $input["recipient"] = $idrec;
        if($input["status_trima"] == "Menerima"){
            $rec->status_trima = "Menerima";
            $rec->save();
        }
        else{
            $rec->status_trima = "Tidak Menerima";
            $rec->save();

        }
        $hasil = History::create($input);
        if ($hasil) {
            return back()->with(['success' => 'Status berhasil diperbarui!']);
        }
        else{
            return back()->with(['warning' => 'Status gagal diperbarui!']);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\History  $history
     * @return \Illuminate\Http\Response
     */
    public function show(History $history)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\History  $history
     * @return \Illuminate\Http\Response
     */
    public function edit(History $history)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateHistoryRequest  $request
     * @param  \App\Models\History  $history
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateHistoryRequest $request, History $history)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\History  $history
     * @return \Illuminate\Http\Response
     */
    public function destroy(History $history)
    {
        //
    }
}
