@extends('admin.layouts.base')

@section('content')
    <div class="container">
        <div>
            <h1>Visualizza tag</h1>
            <h3>Titolo: {{$tag->name}}</h3>
            <h3>Slug: {{$tag->slug}}</h3>

            <!--Scorro tra tutti i post che contengono questo specifico tag-->
            <ul>
                @foreach ($tag->posts as $post)
                    <li><a href="{{route("admin.posts.show", $post->id)}}">{{$post->title}}</a></li>
                @endforeach
            </ul>
            

            <a href="{{route('admin.tags.index')}}" class="btn btn-primary">Torna alla lista</a>
        </div>
    </div>
@endsection