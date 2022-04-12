@extends('admin.layouts.base')

@section('content')
    <div class="container">
        <div>
            <h1>Visualizza post</h1>
            <h3>Titolo: {{$post->title}}</h3>
            <h3>Contenuto: {!! $post->content !!}</h3>
            <h3>Slug: {{$post->slug}}</h3>
            <h3>Categoria: {{isset($post->category->name) ? $post->category->name : "N.D"}}</h3>

            <!--url()->previous serve a tornare alla precedente view in cui l'utente si trovava-->
            <!--L'utente può arrivare in questa view sia vedendo i dettagli del post, sia tramite la lista di post che hanno uno specifico tag-->
            <!--In questo modo l'utente tornerà indietro indipendentemente da dove si trovava-->
            <a href="{{ url()->previous() }}" class="btn btn-primary">Torna indietro</a>
        </div>
    </div>
@endsection