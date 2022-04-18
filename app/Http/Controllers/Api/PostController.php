<?php

namespace App\Http\Controllers\Api;

use App\Category;
use App\Http\Controllers\Controller;
use App\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //ricavo tutte le informazioni del post, con category_id uguale all'ID della categoria, senza altri dettagli
        /* $posts = Post::all(); */

        //aggiungo le informazioni della categoria associata al post, 
        //chiamando la funzione "category" del Model "Post.php" nelle parentesi quadre
        
        $posts = Post::with(["category", "tags"])->paginate(2);


        //rapida versione di un ciclo foreach
        $posts->each(function ($post){

            //la funzione url ci permette di ricavare l'url assoluto dell'immagine, per poterla usare nel frontendù
            //la funzione url punta alla cartella public del progetto, esattamente come la funzione 'asset' in blade
            if($post->cover){ 
                $post->cover = url("storage/" . $post->cover);
            }else{
                $post->cover = url("img/idea-gdba13e8a8_1920.jpg");
            }
        });


        //ritorno la risposta, in forma di json cos' da poterla usare all'interno del programma con axios
        return response()->json(
            [
                "results" => $posts,
                /* "category" => $posts->category()->get(), */
                "success" => true
            ]
        );
    }

    //funzione in frontend per mostrare i dettagli di un singolo post
    public function show($slug){

        $post = Post::where('slug', '=', $slug)->with(['category', 'tags'])->first();


        if($post->cover){ 
            $post->cover = url("storage/" . $post->cover);
        }else{
            $post->cover = url("img/idea-gdba13e8a8_1920.jpg");
        }

        

        if ($post) {
            return response()->json(
                [
                    'result' => $post,
                    'success' => true
                ]
            );
        } else {
            return response()->json(
                [
                    'result' => 'Nessun risultato trovato',
                    'success' => false
                ]
            );
        }
    }
}
