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
            <li><a href="Home"><i class="fa fa-dashboard"></i> Home</a></li>
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
                            <h3 class="box-title">User -> Create</h3>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->
                        <form role="form" action="{{ route('user.store')}}" method="POST">
                            {{ csrf_field() }}
                            <div class="box-body">
                                <div class="col-lg-offset-3 col-lg-6">
                                        <div class="form-group">
                                            <label for="name">Username</label>  
                                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter your name" value="{{ old('name') }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="password">Password</label>  
                                            <input type="password" class="form-control" id="password" name="password" placeholder="Enter Password">
                                        </div>
                                        <div class="form-group">
                                            <label for="password_confirmation">Confirm Password</label>  
                                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Confirm Password">
                                        </div>


                                        <div class="form-group">
                                            <label for="status">Status</label>  
                                            <div class="checkbox">
                                                <label><input name="status" type="checkbox" value="1"
                                                    @if(old('status') == 1) {{'checked'}} @endif
                                                    >Active</label>
                                            </div>
                                        </div>
                                         
                                        <div class="form-group">
                                            <label for="email">Email</label>    
                                            <input value="{{ old('email') }}" type="text" class="form-control" id="email" name="email" placeholder="Enter Email Address">
                                        </div>

                                        <div class="form-group">
                                            <label for="phone">Phone</label>    
                                            <input value="{{ old('phone') }}" type="text" class="form-control" id="phone" name="phone" placeholder="Enter Phone number">
                                        </div>
                                        <div class="form-group">
                                            <label>Assign Role</label>
                                            <div class="row">
                                                @foreach ($roles as $role)
                                                    <div class="col-lg-3">
                                                            <div class="checkbox">
                                                                <label><input name="role[]" type="checkbox" value="{{ $role->id }}">{{$role->name}}</label>
                                                            </div> 
                                                    </div>
                                                @endforeach         
                                            </div>
                                        </div>

                                        <div class="form-group col-lg-offset-5">
                                            <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                                            
                                            <a href="{{route('user.index')}}" class="btn btn-default btn-sm">Back</a>
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