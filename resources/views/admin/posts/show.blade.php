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
            <div class="col-12 text-end">
                <a class="btn btn-warning" href="{{route("admin.posts.edit", $post)}}">Modifica</a>
                <div>
                     <form action="{{route("admin.posts.destroy", $post->id)}}" method="POST" class="delete-form" post-title="{{$post->title}}">
                        @csrf
                        @method("DELETE")

                        <button class="btn btn-danger" type="submit" >Elimina</button>
                    </form>
                </div>
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
                <p class="card-text"><small class="text-muted">Last updated {{$post->created_at}}</small></p>
                
            </div>
            <div>
                Altri Articoli scritti da {{$user->name}}:
                @dump($user->name)
            </div>
            <div>
                @forelse ($user->posts as $relatedPost)
                    <a class="btn btn-success mx-2 mt-2" href="{{route("admin.posts.show", $relatedPost)}}">
                        {{$relatedPost->title}}
                        @dump($user->posts)
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
@dump($user->posts)