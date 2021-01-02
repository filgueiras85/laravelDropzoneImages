@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
                @foreach($posts as $post)
                    <ul class="list-group">
                        <li class="list-group-item">
                            {{$post->title}}
                            <a href="{{route('posts.show' , $post->id)}}" class=" btn btn-outline float-right"> Show</a>
                        </li>
                        <br>
                    </ul>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
