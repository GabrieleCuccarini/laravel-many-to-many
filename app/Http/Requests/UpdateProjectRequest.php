<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProjectRequest extends FormRequest

{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        /*
        L'azione di update dovrebbe essere eseguita solo da admin o da chi ha creato il post
        In questo posso controllare se l'utente è un admin o se è il proprietario del post.
        Se non è nulla di quanto sopra, lo blocco ritornando false
        */
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            "name" => "required|min:5|max:255",
            "description" => "required|string",
            "cover_img" => "image",
            "link" => "required|string",
            "type_id" => "nullable|exists:types,id",
            "technologies" => "nullable|array|exists:technologies,id"
        ];
    }
    
    public function messages() {
        return [
            "name.required" => "Il titolo è obbligatorio",
            "name.min" =>  "Il titolo deve avere almeno :min caratteri",
            "name.max" =>  "Il titolo deve avere massimo :max caratteri",
            "description.required" => "Il progetto deve avere un contenuto",
            "link.required" => "Il progetto deve avere un link github",
            "link.string" => "Il campo 'Link' deve essere una stringa"
        ];
    }
}