<?php

namespace App\Http\Controllers\Admin;

use App\Entity\Specialization;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SpecializationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Specialization::all();
        return view('admin.specialization.specialization', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.specialization.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Specialization::create($request->all());
        return redirect('admin/specializations')->with('message', 'Посада добавлена');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Specialization::findOrFail($id);
        return view('admin.specialization.show', compact('data'));
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Specialization::findOrFail($id);
        return view('admin.specialization.edit', compact('data'));
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
        $item = Specialization::findOrFail($id);
        $item->update($data);
        return redirect('admin/specializations')->withSuccess('Посада зміненна');
        //
    }


    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $item = Specialization::findOrFail($id);
        $item->delete();
        return redirect('admin/specializations')->withSuccess("Спеціалізація " . $item->title . " видаленна");
    }
}
