@extends('layouts.app')

@section('admin_content')
<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>

<script>
    tinymce.init({
      selector: '#mytextarea'
    });
  </script>


    <div class="card-header">{{ __('Add a new Article') }}</div>

    <div class="card-body">
        <form enctype="multipart/form-data" class="form-horizontal" action="{{url('/admin/store')}}"  method="post">
            {{csrf_field()}}
            <div class="form-group">
                <input class="form-control" type="text" name="title" placeholder=" The Title">
            </div>
            <div class="form-group">
            <textarea name="body" id="mytextarea">Hello, World!</textarea>
        </div>
        <div class="form-group">
            <input class="form-control" type="file" name="thumbnall" accept="image/*">
        </div>
        <div class="form-group">
            <input type="submit" value="to publish"/>
        </div>
          </form>
    </div>

@endsection

