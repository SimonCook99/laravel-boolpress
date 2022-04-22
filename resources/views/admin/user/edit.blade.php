@extends("admin.layouts.base")


@section("content")

    <div class="container">
        <h1>Modifica informazioni utente</h1>

        @if (session('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif

      <form method="POST" action="{{route("admin.users.update")}}" enctype="multipart/form-data">
        @csrf
        @method("PUT")


        @if ($user->avatar)
          <h2>Immagine attualmente presente:</h2>
          <img src="{{route("admin.user.getAvatar")}}" alt="{{$user->name}}" class="img-fluid">

          {{-- Ho provato cosi ma non funziona  --}}
          {{-- <img src="{{url(storage_path('app') . "/" . $user->avatar)}}" alt="{{$user->name}}"> --}}
        @endif


        <div class="form-group">
          <label for="image">Carica nuovo avatar</label>

          <!--l'attributo name in questo caso specifico non ha diretto colegamento con l'attributo cover del database, quindi usiamo un nome diverso-->
          <input class="form-control" type="file" id="image" name="image"> 
        </div>

        <div class="form-group">
          <label for="name">Nome e cognome</label>
          <input type="text" class="form-control" id="name" name="name" value="{{old("name", $user->name)}}">
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="{{old("email", $user->email)}}">
        </div>

        <div>
            <h1>La tua nuova password - lascia in bianco per non aggiornare</h1>

            <div class="form-group">
                <label for="new_password">Nuova password</label>
                <input type="password" class="form-control" id="new_password" name="new_password">
            </div>

            <div class="form-group">
                <label for="new_password_confirmation">Conferma nuova password</label>
                <input type="password" class="form-control" id="new_password_confirmation" name="new_password_confirmation">
            </div>
        </div>

        

        
        
        <button type="submit" class="btn btn-primary">Salva Modifiche</button>
      </form>

    </div>

@endsection