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
                                <h3 class="box-title">Title -> Create</h3>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->
                    <form role="form" action="{{ route('title.store')}}" method="POST" enctype="multipart/form-data">
                                
                        {{ csrf_field() }}
                            <div class="box-body">
                                    <div class="col-lg-8">
                                            <div class="form-group">
                                                    <label class="title_label" for="title">Title</label>
                                                    <input  type="text" class="form-control" id="title" name="title" placeholder="Enter New Title" value="{{ old('title') }}">
                                                </div>
                                            <div class="form-group" style="margin-top:5px;">
                                                <div>
                                                    <label for="cover_image">Upload Cover image   </label>
                                                    <input type="file" name="cover_image" id="cover_image">
                                                </div>
                                               
                                            </div>
                                            
                                            <div class="form-group" style="margin-top:20px;">
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
                                                <label>Select Categories</label>
                                                <select  class="form-control select2 select2-hidden-accessible"
                                                 multiple="" data-placeholder="Select a State" style="width: 100%;" 
                                                 tabindex="-1" aria-hidden="true" name="categories[]">
                                                    @foreach ($categories as $category)
                                                        <option value="{{$category->id}}">{{$category->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>  
                                            <div class="form-group btn_create">
                                                <button type="submit" class="btn btn-primary">Submit</button>
                                                <a href="{{route('title.index')}}" class="btn btn-default ">Back</a>
                                            </div>
                                    </div>
                                </div>
                                <!-- /.box-body -->
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
<link rel="stylesheet" href="{{asset('admin/custom/title_create.css')}}">
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