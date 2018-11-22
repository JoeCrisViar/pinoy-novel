@extends('admin.app')

@section('main')
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        @include('includes.content_header')
        
        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-md-12">
              
                <!-- general form elements -->
                <div class="box box-primary">
                        <div class="box-header with-border">
                                <h3 class="box-title">Post -> Create</h3>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->
                    <form role="form" action="{{ route('post.store')}}" method="POST" enctype="multipart/form-data">
                                
                        {{ csrf_field() }}
                            <div class="box-body">
                                    <div class="col-lg-6">
                                            <div class="form-group">
                                                    <label for="title">Title</label>
                                                    <select   class="form-control select2 select2-hidden-accessible"
                                                      data-placeholder="Select a Title" style="width: 100%;" 
                                                     tabindex="-1" aria-hidden="true" name="title_id" id="title_id">
                                                            <option value="" selected>Choose Title</option>
                                                        @foreach ($titles as $title)
                                                            <option value="{{$title->id}}">{{$title->title}}</option>
                                                        @endforeach
                                                    </select>
                                            </div>
                
                                            <div class="form-group">
                                                <label for="title">Subtitle</label>
                                                <input type="text" class="form-control" id="subtitle" name="subtitle" placeholder="Enter subtitle" value="{{ old('subtitle') }}">
                                            </div>
                
                                                <div class="form-group">
                                                <label for="slug">Slug</label>
                                                <input type="text" class="form-control" id="slug" name="slug" placeholder="Enter slug" value="{{ old('slug') }}">
                                            </div>
                                    </div>
                                    <div class="col-lg-6">
                                            <div class="form-group" style="margin-top:5px;">
                                                @can('posts.publish', Auth::user())
                                                    <div class="checkbox" style="margin-left:25px">
                                                       
                                                        <input style="width: 25px; height: 25px;" type="checkbox" name="status" value="1"
                                                            @if(old('status') == 1) {{'checked'}} @endif> 
                                                         <label style="font-size:18px;">    
                                                             Publish
                                                        </label>
                                                    </div>
                                                @else
                                                <div class="checkbox pull-mid">
                                                    <label>
                                                       {{-- Show Nothing --}}
                                                    </label>
                                                </div>
                                                @endcan
                                            </div>
                                            <br>
                                            <div class="form-group" style="margin-top:10px;">
                                                <label>Select Tags</label>
                                                <select  class="form-control select2 select2-hidden-accessible"
                                                        multiple="" data-placeholder="Select a State" style="width: 100%;" 
                                                        tabindex="-1" aria-hidden="true" name="tags[]">
                                                    @foreach ($tags as $tag)
                                                        <option value="{{$tag->id}}">{{$tag->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group" style="margin-top:18px;">
                                                <label>Select Genre</label>
                                                <select  class="form-control select2 select2-hidden-accessible"
                                                 multiple="" data-placeholder="Select a State" style="width: 100%;" 
                                                 tabindex="-1" aria-hidden="true" name="categories[]">
                                                    @foreach ($categories as $category)
                                                        <option value="{{$category->id}}">{{$category->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>  
                                    </div>
                                </div>
                                <!-- /.box-body -->
                                
                                <div class="box">
                                    <div class="box-header">
                                        <h3 class="box-title">Write Post
                                        <small>Simple and fast</small>
                                        </h3>
                                        <!-- tools box -->
                                        <div class="pull-right box-tools">
                                        <button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip"
                                                title="Collapse">
                                            <i class="fa fa-minus"></i></button>
                                        </div>
                                        <!-- /. tools -->
                                    </div>
                                    <!-- /.box-header -->
                                    <div class="box-body pad">
                                        <textarea id="editor1" name="body"
                                        style="width: 100%; height: 500px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{ old('body') }}</textarea>                              
                                    </div>
                                </div>
                                <div class="box-footer">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                    <a href="{{route('post.index')}}" class="btn btn-default ">Back</a>
                                </div>
                        </form>
                </div>
                    <!-- /.box -->
            </div>
            <!-- /.col-->
          </div>
          <!-- ./row -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection

@section('admin_css')
<link rel="stylesheet" href="{{asset('admin/bower_components/select2/dist/css/select2.min.css')}}">
<link rel="stylesheet" href="{{asset('admin/custom/post_title_select.css')}}">
@endsection

@section('admin_js')
<script src="{{asset('admin/bower_components/select2/dist/js/select2.full.min.js')}}"></script>
<script src="{{asset('admin/ckeditor/ckeditor.js')}}"></script>

<script>
    $(document).ready(function () 
    {
        //Initialize Select2 Elements
        $('.select2').select2()
    });
</script>
<script>
    $(function () {
      // Replace the <textarea id="editor1"> with a CKEditor
      // instance, using default configuration.
      CKEDITOR.replace('editor1')
      //bootstrap WYSIHTML5 - text editor
      $('.textarea').wysihtml5()
    })
</script>
@endsection