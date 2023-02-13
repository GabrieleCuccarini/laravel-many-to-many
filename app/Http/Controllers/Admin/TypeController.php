<?php

namespace App\Http\Controllers\Admin;

use App\Models\Type;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTypeRequest;
use App\Http\Requests\UpdateTypeRequest;
use Illuminate\Support\Facades\Auth;

class TypeController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //alternativa, mostra progetti in ordine di titolo  $posts = Post::orderBy("title")->get();
        $types = Type::all();
        return view("admin.types.index", compact('types'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.types.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTypeRequest $request)
    {
        //FUNZIONAMENTO BASE SENZA IMMAGINI
        $data = $request->validated();
        $type = Type::create([
            ...$data,
            // recuperiamo l'id dagli user cioé user_id é uguale all'utente loggato
            "user_id" => Auth::id() 
            ]);
        return redirect()->route('admin.types.show',compact('type'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\type  $type
     * @return \Illuminate\Http\Response
     */
    public function show(Type $type)
    {
        return view('admin.types.show',compact('type'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\type  $type
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $type = type::findOrFail($id);
        return view('admin.types.edit',compact('type'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\type  $type
     * @return \Illuminate\Http\Response
     */
    
    public function update(UpdateTypeRequest $request, $id)
    {
        $data = $request->validated();
        $type =  Type::findOrFail($id);
        $type->update([
            ...$data,
            "user_id" =>Auth::id()
        ]);
        return redirect()->route('admin.types.show', $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\type  $type
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $type = Type::findOrFail($id);
        $type->delete();
        return redirect()->route('admin.types.index');
    }
}