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
        
        $posts = Post::with(["category"])->get();

        $posts = Post::paginate(2);


        //ritorno la risposta, in forma di json cos' da poterla usare all'interno del programma con axios
        return response()->json(
            [
                "results" => $posts,
                /* "category" => $posts->category()->get(), */
                "success" => true
            ]
        );
    }
}
