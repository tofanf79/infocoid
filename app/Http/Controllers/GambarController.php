<?php

namespace App\Http\Controllers;

use App\Models\gambar;
use App\Http\Requests\StoregambarRequest;
use App\Http\Requests\UpdategambarRequest;
class GambarController extends Controller
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
     * @param  \App\Http\Requests\StoregambarRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoregambarRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\gambar  $gambar
     * @return \Illuminate\Http\Response
     */
    public function show(gambar $gambar)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\gambar  $gambar
     * @return \Illuminate\Http\Response
     */
    public function edit(gambar $gambar)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdategambarRequest  $request
     * @param  \App\Models\gambar  $gambar
     * @return \Illuminate\Http\Response
     */
    public function update(UpdategambarRequest $request, gambar $gambar)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\gambar  $gambar
     * @return \Illuminate\Http\Response
     */
    public function destroy(gambar $gambar)
    {
        //
    }
}
