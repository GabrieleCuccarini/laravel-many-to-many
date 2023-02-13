<?php

namespace App\Http\Controllers\Admin;

use App\Models\Project;
// use App\Models\Type;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //alternativa, mostra progetti in ordine di titolo  $posts = Post::orderBy("title")->get();
        $projects = Project::all();
        return view("admin.projects.index", compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.projects.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProjectRequest $request)
    {
        //FUNZIONAMENTO BASE SENZA IMMAGINI
        // $data = $request->validated();
        // $project = Project::create($data);
        // dd($project);
        // return redirect()->route('admin.projects.show',compact('project'));

        //FUNZIONAMENTO CON IMMAGINI IN UPLOAD
        $data = $request->validated();
        if (key_exists("cover_img", $data)){

            $path = Storage::put("projects", $data["cover_img"]);
        }
 
       $project = Project::create([
        ...$data,
        //a bd vado a salvare solamente il percorso 
        "cover_img" => $path ?? '',
        // recuperiamo l'id dagli user cioé user_id é uguale all'utente loggato
        "user_id" => Auth::id() 
        ]);

        return redirect()->route('admin.projects.show',compact('project'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        return view('admin.projects.show',compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $project = project::findOrFail($id);
        // recupero un array con TUTTI i types del db
        // $types = Type::all();

        return view('admin.projects.edit',compact('project'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\project  $project
     * @return \Illuminate\Http\Response
     */
    
    public function update(UpdateProjectRequest $request, $id)
    {
        $data = $request->validated();
        //FUNZIONAMENTO CON IMMAGINI IN UPLOAD
        $project =  Project::findOrFail($id);  
        if (key_exists("cover_img", $data)){   
            $path = Storage::put("projects", $data["cover_img"]);
            Storage::delete($project->cover_img);
        }
        $project->update([
            ...$data,
            "user_id" =>Auth::id(),
            "cover_img"=>$path ?? $project->cover_img,
        ]);
        return redirect()->route('admin.projects.show', $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $project = Project::findOrFail($id);
        $project->delete();
        return redirect()->route('admin.projects.index');
    }
}

    // private function validation($data) {
    //     // $result = Validator::make($data, $this->validationRules, [
    //     $result = Validator::make($data, [
    //         "name" => "required|min:5|max:255",
    //         "description" => "required|string",
    //         "cover_img" => "file",
    //         "link" => "required|string|url",
    //         ], 
    //         ["name.required" => "Il titolo è obbligatorio",
    //         "name.min" =>  "Il titolo deve avere almeno :min caratteri",
    //         "name.max" =>  "Il titolo deve avere massimo :max caratteri",
    //         "description.required" => "Il progetto deve avere un contenuto",
    //         "link.required" => "Il progetto deve avere un link github"
    //         ])->validate();
    //     return $result;
    // }

