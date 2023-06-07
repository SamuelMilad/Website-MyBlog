@extends('layouts.app')

@section('admin_content')
<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>

<script>
    tinymce.init({
      selector: '#mytextarea'
    });
  </script>


    <div class="card-header">{{ __('Edit an Article') }}</div>

    <div class="card-body">
        <form enctype="multipart/form-data" class="form-horizontal" action="{{url('/admin/update/'.$article->id)}}"  method="post">
            {{csrf_field()}}
            <input type="hidden" name="_method" value="PUT"/>
            <div class="form-group">
                <input class="form-control" type="text" name="title" placeholder=" The Title" value="{{$article->title}}"/>
            </div>
            <div class="form-group">
                <textarea name="body" id="mytextarea">{{$article->body}}</textarea>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-md-12"> <img width="100%" class="bd-placeholder-img card-img-top" src="{{url('uploads/'.$article->thumbnall)}}"/></div>
                    <div class="col-md-12"><input class="form-control" type="file" name="thumbnall" accept="image/*"></div>
                </div>
            </div>
            <div class="form-group">
                <input type="submit" value="to edit"/>
            </div>
        </form>
    </div>

@endsection

