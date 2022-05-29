@extends('layouts.app')

@section('content')
    <div class="container m-auto">
        <div class="row">
            @if(session('message'))
                <div class="col-12">
                    <div class="alert alert-success">
                        {{session('message')}}
                    </div>
                </div>
            @endif
            <div class="col-12 text-end d-flex justify-content-end">
                @if(Auth::check())
                <a class="btn btn-warning mx-2" href="{{route("admin.posts.edit", $post)}}">Modifica</a>
                <div>
                     <form action="{{route("admin.posts.destroy", $post->id)}}" method="POST" class="delete-form delete" post-title="{{$post->title}}">
                        @csrf
                        @method("DELETE")

                        <button class="btn btn-danger" type="submit" >Elimina</button>
                    </form>
                </div>
                @endif
            </div>
            <div class="col-12 text-center">
                <h1>
                    {{ucfirst($post->title)}}
                </h1>
                <figure>
                    <img src="{{$post->image_url}}" alt="{{$post->title}}">
                </figure>
            </div>
            <div class="text-center">
                <p>
                    {{$post->content}}
                </p>
                <h6>
                    Scritto da: {{$user->name}}
                </h6>
                @foreach ($post->categories as $category)
                    <p class="badge" style="background-color: {{$category->color}}">{{$category->name }}</p>
                    @endforeach
                <p class="card-text"><small class="text-muted">Last updated {{$post->created_at}}</small></p>                
            </div>
            <div>
                Altri Articoli scritti da {{$user->name}}:
            </div>
            <div>
                @forelse ($user->posts as $relatedPost)
                    <a class="btn btn-success mx-2 mt-2" href="{{route("admin.posts.show", $relatedPost)}}">
                        {{$relatedPost->title}}
                    </a>
                @empty
                    <h3>
                        L'utente{{$user->name}} non ha postato altri articoli
                    </h3>
                @endforelse
                
            </div>
        </div>
    </div>
@endsection

@section('script-delete')
    <script defer>
        const deleteForms = document.querySelectorAll('.delete');
            deleteForms.forEach(singleForm => {
                singleForm.addEventListener('submit', function (event) {
                    event.preventDefault(); // § blocchiamo l'invio del form
                    userConfirmation = window.confirm(`Sei sicuro di voler eliminare ${this.getAttribute(' post-title')}?` );
                    if (userConfirmation) {
                        this.submit();
                    }
                })
            });
    </script>
@endsection
