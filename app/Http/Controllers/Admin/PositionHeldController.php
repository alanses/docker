<?php

namespace App\Http\Controllers\Admin;

use App\Entity\PositionHeld;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PositionHeldController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = PositionHeld::all();
        return view('admin.position_held.position_helds', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.position_held.create');
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
        PositionHeld::create($request->all());
        return redirect('admin/position-held')->with('message', 'Посада добавлена');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = PositionHeld::findOrFail($id);
        return view('admin.position_held.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = PositionHeld::findOrFail($id);
        return view('admin.position_held.edit', compact('data'));
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
        $data = $request->all();
        $item = PositionHeld::findOrFail($id);
        $item->update($data);
        return redirect('admin/position-held')->withSuccess('Посада зміненна');
        //
    }

    public function destroy($id)
    {
        $item = PositionHeld::findOrFail($id);
        $item->delete();
        return redirect('admin/position-held')->with('message', "Посада " . $item->title . " видаленна");
    }
}
