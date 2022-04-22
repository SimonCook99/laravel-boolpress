<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function edit(){

        $user = Auth::user();
        return view("admin.user.edit", compact("user"));
    }

    public function update(Request $request){

        $user = Auth::user();

        $request->validate([
            "name" => "required|min:2",
            "email" => "required|email",
            "image" => "nullable|max:2048|image",
            "new_password" => "nullable|confirmed|min:8" //grazie alla verifica confirmed, Laravel cerca in automatico l'attributo "new_password_confirmation" e si assicurerà che i 2 campi coincidano
        ]);

        $data = $request->all();

        if(isset($data["image"])){

            //crea una sottocartella 'post_covers' in 'storage/app/public'
            $avatar_path= Storage::disk('local')->put("avatars", $data["image"]);
            $data["avatar"] = $avatar_path;

        }

        if($data["new_password"]){ //se è stata inserita una nuova password, allora aggiorna il campo password dell'utente
            
            $new_password = Hash::make($data["new_password"]); //faccio l'hash della nuova password, dopodichè aggiorno il campo "password" di data
            
            $data["password"] = $new_password;
        }

        $user->update($data);


        return redirect()->route("admin.users.edit")->with("message", "informazioni aggiornate correttamente");


    }

    
    public function getMyAvatar() {

        $user = Auth::user();

        if ($user) {
            
            
            if ($user->avatar) {

                //return Storage::disk('local')->download($user->avatar); // soluzione per un download forzato del file

                return response()->file(storage_path('app') . '/' . $user->avatar); //soluzione per uno stream del file (si apre nel browser)
            
            } else {
                abort(404); //se l'utente loggato non ha l'immagine, allora torno un errore di risorsa non trovata
            }

        } else { //se l'utente non è loggato, allora non è autorizzato ad accedere alla risorsa
            abort(403);
        }

    }
}
