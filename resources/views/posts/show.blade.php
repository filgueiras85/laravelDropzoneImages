@extends('layouts.app')

@section('content')

@push('js')

    <script>
        Dropzone.options.myDropzoneForm = {
            acceptedFiles: 'image/*',
            init:function (){
                this.on('success' , function (){
                    if (this.getQueuedFiles().length == 0  && this.getUploadingFiles().length == 0 ){
                        console.log('finish');
                        location.reload()
                    }
                });
            }
        }
    </script>
@endpush

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">

            <p>{{$post->title}}</p>
            <br>
            <p>{{$post->description}}</p>
            <br>

            @if(Session::has('success'))
                <div class="alert alert-success">
                    {{Session('success')}}
                </div>
            @endif

            @if ($post->images()->count() > 0)
                <div class="row">
                    @foreach($post->images as $image)
                        <div class="col-md-4">
                            <div class="card">
                                <a href="{{asset('storage/images') .'/' . $image->path }}" data-lity>
                                    <img src="{{asset('storage/images') .'/' . $image->path }}" alt="" height="240px" width="284px" class="card-img-top mb-3">
                                </a>
                                <div class="card-body">

                                </div>
                                <div class="card-footer">
                                    @can('delete_image' , $image)
                                    <form action="{{route('image.destroy' , $image)}}" method="post" style="margin-left: 33%;">
                                        @csrf
                                        @method('DELETE')
                                        <button  type="submit" class="btn btn-danger center">Delete</button>
                                    </form>
                                    @endcan
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <br>
            @else
                <p>no images to show</p>
            @endif

        </div>
    </div>
</div>


<div class="row justify-content-center">
    <div class="col-md-10">

        @can('upload_image' , $post)
        <form action="{{route('posts.upload' , $post)}}" method="post" class="dropzone" id="myDropzoneForm">
            @csrf
        </form>
        @endcan
    </div>
</div>

@endsection
