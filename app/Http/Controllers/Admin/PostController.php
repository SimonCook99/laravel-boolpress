<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use App\Post;
use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();

        return view("admin.post.index", compact("posts"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();

        return view("admin.post.create", compact("categories", "tags"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) //aggiunta di un nuovo post, e controllo degli attributi inseriti (soprattutto la category_id)
    {
        //controllo i parametri passati dall'interno della form di creazione post, negli attributi "name" (views/admin/post/create.blade.php),
        //e verifico che rispettino i seguenti parametri.
        //In particolare, l'attributo "category_id" deve esistere all'interno della colonna "id" di "categories"
        $request->validate(
            [
                "title" => "required|min:5",
                "content" => "required|min:10",
                "category_id" => "nullable|exists:categories,id",
                "tags" => "nullable|exists:tags,id",
                "image" => "nullable|image|max:2048" //nel caso di image, max si riferisce al massimo di KB del file (in questo caso 2 MB)
            ]
        );

        $data = $request->all();


        if(isset($data["image"])){

            //crea una sottocartella 'post_covers' in 'storage/app/public'
            $cover_path= Storage::put("post_covers", $data["image"]);
            $data["cover"] = $cover_path;

        }
        

        $slug = Str::slug($data["title"]);
        $counter = 1;

        //se trovo un doppione dello slug, modifico $slug concantenando il contatore, che sar?? incrementato in modo da essere sempre univoco
        while(Post::where("slug", $slug)->first()){
            $slug = Str::slug($data["title"]) . "-" . $counter;
            $counter++;
        }

        $data["slug"] = $slug;
        $post = new Post();

        $post->fill($data);
        $post->save();

        //sincronizzo i tag di quel post, con i tag che hanno gli ID indicati nel campo "tags" di $data
        $post->tags()->sync($data["tags"]);

        return redirect()->route("admin.posts.index");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post) //Post con l'id specifico come parametro
    {
        return view("admin.post.show", compact("post"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post) //Post con l'id specifico come parametro
    {
        $categories = Category::all();

        $tags = Tag::all();

        return view("admin.post.edit", compact("categories", "post", "tags"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $request->validate(
            [
                "title" => "required|min:5",
                "content" => "required|min:10",
                "category_id" => "nullable|exists:categories,id",
                "tags" => "nullable|exists:tags,id",
                "image" => "nullable|image|max:2048"
            ]
        );

        $data = $request->all();

        //se l'utente ha caricato una nuova immagine nel form di update
        if(isset($data["image"])){

            //se c'era gi?? un'immagine in precedenza, allora la cancello anche all'interno di storage
            if($post->cover){
                Storage::delete($post->cover);
            }

            //crea una sottocartella 'post_covers' in 'storage/app/public'
            $cover_path= Storage::put("post_covers", $data["image"]);
            $data["cover"] = $cover_path;

        }

        $slug = Str::slug($data["title"]);

        if ($post->slug != $slug) {
            $counter = 1;
            while (Post::where('slug', $slug)->first()) {
                $slug = Str::slug($data['title']) . '-' . $counter;
                $counter++;
            }
            $data['slug'] = $slug;
        }

        $post->update($data);
        $post->save();


        if(isset($data["tags"])){
            //sincronizzo i tag di quel post, con i tag che hanno gli ID indicati nel campo "tags" di $data
            $post->tags()->sync($data["tags"]);
        }
        

        return redirect()->route("admin.posts.index");


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {

        if($post->cover){
            Storage::delete($post->cover);
        }

        $post->delete();
        return redirect()->route("admin.posts.index");
    }
}
