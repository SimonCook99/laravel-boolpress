@extends("admin.layouts.base")


@section("content")

    <div class="container">
        <h1>Lista tag : </h1>

        <a href="{{route("admin.tags.create")}}">Add a new tag</a>

        <table class="table">
            <thead>
              <tr>
                <th scope="col">ID</th>
                <th scope="col">Nome</th>
                <th scope="col">Slug</th>
                <th scope="col">Azioni</th>
              </tr>
            </thead>
            <tbody>

                @foreach ($tags as $tag)
                    <tr>
                        <th scope="row">{{$tag->id}}</th>
                        <td>{{$tag->name}}</td>
                        <td>{{$tag->slug}}</td>

                        <td>
                          <a href="{{route("admin.tags.show", $tag->id)}}">Vedi tag</a>


                          <form method="POST" action="{{route("admin.tags.destroy", $tag->id)}}">
                            @csrf
                            @method("DELETE")

                            <button class="btn btn-danger" type="submit">Elimina Tag</button>

                          </form>
                        </td>
                    </tr>
                @endforeach
              
              
            </tbody>
          </table>
    </div>

@endsection