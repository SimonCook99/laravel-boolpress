<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Lead;
use App\Mail\NewContact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    public function store(Request $request){

        $data = $request->all();

        //la classe "Validator" di Laravel ha le stesse regole della Request->validate, 
        //ma permette di eseguire un codice personalizzato, qualora la validazione non riesca
        $validator = Validator::make($data, [
            "name" => "required",
            "email" => "required|email",
            "message" => "required|min:10"
        ]);

        //la funzione fails controlla se la validazione è fallita, in caso ci facciamo restituire un json con la lista degli errori
        if($validator->fails()){
            return response()->json([

                "errors" => $validator->errors(), //funzione di validator che ritorna la lista degli errori
                "success" => false

            ]);
        }else{ //se la validazione va a buon fine, creo un nuovo Lead con i dati passati, dopodichè mando una mail all'amministratore

            $lead = new Lead();
            $lead->fill($data);
            $lead->save();

            //con questa sintassi mando una mail all'amministratore, e al metodo send passiamo l'oggetto Mailable creato in precedenza
            Mail::to("info@boolpress.com")->send(new NewContact($lead));

            return response()->json([
                "success" => true
            ]);

        }
    }
}
