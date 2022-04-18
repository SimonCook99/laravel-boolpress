@extends("admin.layouts.base")


@section("content")

    <div class="container">
      <h1>Modifica post</h1>

      <form method="POST" action="{{route("admin.posts.update", $post->id)}}" enctype="multipart/form-data">
        @csrf
        @method("PUT")


        @if ($post->cover)
          <p>Immagine attualmente presente:</p>
          <img class="img-thumbnail" src="{{asset('storage/' . $post->cover)}}" alt="{{$post->title}}">
        @endif


        <div class="form-group">
          <label for="image">Modifica immagine di copertina</label>

          <!--l'attributo name in questo caso specifico non ha diretto colegamento con l'attributo cover del database, quindi usiamo un nome diverso-->
          <input class="form-control" type="file" id="image" name="image"> 
        </div>

        <div class="form-group">
          <label for="title">Titolo post</label>
          <input type="text" class="form-control" id="title" name="title" value="{{old("title", $post->title)}}">
        </div>

        <div class="form-group">
          <label for="content">Contenuto post</label>
          <textarea class="form-control" id="content" rows="10" name="content">{{old("content", $post->content)}}</textarea>
        </div>

        <div class="form-group">
          <label for="category_id">Categoria</label>
          <select class="form-control" id="category_id" name="category_id">

            <option value="">Nessuna categoria</option>

            @foreach ($categories as $category)
              <option {{(old("category_id", $post->category_id) == $category->id) ? 'selected' : '' }} value="{{$category->id}}">{{$category->name}}</option>
            @endforeach

            @foreach ($tags as $tag)
              @if ($errors->any())
                <div class="custom-control custom-checkbox">
                    <input name="tags[]" type="checkbox" class="custom-control-input" id="tag_{{$tag->id}}" value={{$tag->id}} {{in_array($tag->id, old('tags'))?'checked':''}}>
                    <label class="custom-control-label" for="tag_{{$tag->id}}">{{$tag->name}}</label>
                </div>
              @else
                <div class="custom-control custom-checkbox">
                    <input name="tags[]" type="checkbox" class="custom-control-input" id="tag_{{$tag->id}}" value={{$tag->id}} {{$post->tags->contains($tag->id)?'checked':''}}  >
                    <label class="custom-control-label" for="tag_{{$tag->id}}">{{$tag->name}}</label>
                </div>
              @endif
            @endforeach
          </select>
        </div>
        
        <button type="submit" class="btn btn-primary">Salva Modifiche</button>
      </form>

    </div>

@endsection