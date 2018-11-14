@extends('admin.app')

@section('main')
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Text Editors
            <small>Advanced form element</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="home"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Forms</a></li>
            <li class="active">Editors</li>
          </ol>
        </section>

        <!-- Display Errors -->
        @include('includes.messages')
    
        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-md-12">
              
                <!-- general form elements -->
                <div class="box box-primary">
                        <div class="box-header with-border">
                                <h3 class="box-title">Category -> Create</h3>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->
                        <form role="form" action="{{ route('category.store')}}" method="POST">
                            {{ csrf_field() }}
                            <div class="box-body">    
                                <div class="col-lg-offset-3 col-lg-6">
                                        <div class="form-group">
                                            <center><label for="name">Category Title</label></center>
                                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter Category title">
                                        </div>
                                        <div class="form-group ">
                                            <center><label for="slug">Slug</label></center>
                                            <input type="text" class="form-control" id="slug" name="slug" placeholder="Enter slug">
                                        </div>
                                        <div class="form-group col-lg-offset-5">
                                            <button type="submit" class="btn btn-primary btn-sm ">Submit</button>
                                            <a href="{{route('category.index')}}" class="btn btn-default btn-sm ">Back</a>
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