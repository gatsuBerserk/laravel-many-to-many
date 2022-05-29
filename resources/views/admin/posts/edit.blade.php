@extends('layouts.app')

@section('title', 'Add Post')

@section('content')

<section class="container-fluid p-5" id="add-form">

	<div class="row">
		<div class="col-12 mb-3">
			<a href="{{ route('admin.posts.index') }}" class="btn btn-secondary" tabindex="-1" role="button" aria-disabled="true">Back</a>
		</div>
	</div>


    <form class="row row-cols-4 g-3 flex-column align-items-center" action="{{route("admin.posts.update", $post)}}" method="POST">
      @method('PUT')  
			@csrf
        <div class="col">
            <h2>
             Modifica Post
            </h2>
            @if ( $errors->any() )
            <ul class="alert alert-danger">
                @foreach ( $errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            @endif
        </div>
        <div class="col">
            <label for="title">Title</label>
            <input type="text" name="title" id="title" class="form-control" value="{{$post->title}}">
			</div>
        <div class="col py-2">
            <label for="content">Description</label>
            <textarea type="text" name="content" id="content" class="form-control">{{$post->content}}</textarea>
        </div>
        <div class="col">
            <label for="image_url">Image url</label>
            <input type="text" name="image_url" id="image_url" class="form-control" value="{{$post->image_url}}">
        </div>

        <div class="col py-2">
            <select class="form-select" name="category">
                <option selected>Open this select menu</option>
                @foreach ($categories as $category)
                <option 
                    value="{{$category->id}}" {{ ($category->id === $post->categories[0]->id) ? 'selected' : ''}}>
                    {{$category->name}}
                </option>
                @endforeach
            </select>
        </div> 

        <div class="col text-center">
            <button type="submit" class="btn btn-primary">Send</button>
        </div>  
    </form>

</section>

@endsection