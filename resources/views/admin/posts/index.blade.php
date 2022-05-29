@extends('layouts.app')

@section('content')
<div class="container-fluid">
  <div class="row">
        @if(session('deleted-message'))
                <div class="col-12">
                    <div class="alert alert-warning">
                        {{session('deleted-message')}}
                    </div>
                </div>
          @endif
          @if (session('message'))
            <div class="alert alert-success">{{session('message')}}</div>
          @endif
      @foreach ($posts as $post)
        <div class="col-4">
            <div class="card mb-3" style="max-width: 540px;">
                <div class="row g-0">
                <div class="col-md-4">
                    <img  src="{{$post->image_url}}" class="img-fluid rounded-start" alt="{{$post->title}}">
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                    <h5 class="card-title">{{$post->title}}</h5>
                    <p class="card-text">{{$post->content}}</p>
                    @dump($post->id)
                    @foreach ($post->categories as $category)
                    <p class="badge" style="background-color: {{$category->color}}">{{$category->name }}</p>
                    @endforeach
                    <p class="card-text"><small class="text-muted">Last updated {{$post->created_at}}</small></p>
                    <a class="btn btn-success" href="{{route("admin.posts.show", $post->id)}}">Continua a leggere...</a>
                    </div>
                </div>
                </div>
            </div>
            </div>
      @endforeach
  </div>
</div>
    
@endsection