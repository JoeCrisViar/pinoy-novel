@extends('admin.app')

<!--Main Content of the page-->
@section('main')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        @include('includes.content_header')

        <!-- Main content -->
        <section class="content">

        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Permission</h3>
                <a class="col-lg-offset-5 btn btn-primary" href="{{route('permission.create')}}">Add New</a>

            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                        title="Collapse">
                <i class="fa fa-minus"></i></button>
                <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                <i class="fa fa-times"></i></button>
            </div>
            </div>
            <div class="box-body">
                {{-- Data Tables --}}
                <div class="box">
                    <div class="box-header">
                        <!-- Display Errors -->
                         @include('includes.messages')
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                      <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                          <th>S.No</th>
                          <th>Permission</th>
                          <th>Permission for</th>
                          <th>Edit</th>
                          <th>Delete</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach ($permissions as $permission)
                                <tr>
                                    <td>{{ $loop->index + 1 }}</td>
                                    <td>{{ $permission->name }}</td>
                                    <td>{{ $permission->for }}</td>
                                    <td>
                                            <a href="{{ route('permission.edit', $permission->id) }}" class="btn btn-primary">
                                                <span class="glyphicon glyphicon-edit"></span>
                                            </a>
                                        </td>
                                        <td>
                                            <form id="delete-form-{{$permission->id}}" action="{{ route('permission.destroy', $permission->id) }}" method="POST" >
                                                {{ csrf_field() }}

                                                {{ method_field('DELETE') }}
                                                
                                                <a  href="" 
                                                        onclick=" if(confirm('Delete this permission?'))
                                                            {   event.preventDefault(); 
                                                                document.getElementById('delete-form-{{$permission->id}}').submit();
                                                            }else{
                                                                event.preventDefault();
                                                            }" 
                                                        class="btn btn-danger">
                                                    <span class="glyphicon glyphicon-trash"></span>
                                                </a>
                                            </form>
                                        </td>
                                </tr>
                            @endforeach   
                        
                        </tbody>
                        <tfoot>
                        <tr>
                            <th>S.No</th>
                            <th>permission Name</th>
                            <th>Permission for</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                        </tfoot>
                      </table>
                    </div>
                    <!-- /.box-body -->
                  </div>
                </div>
            <!-- /.box-body -->
            <div class="box-footer">
            Footer
            </div>
            <!-- /.box-footer-->
        </div>
        <!-- /.box -->

        </section>
        <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection

@section('admin_css')
<!--Specific css exclusive for this page-->
<link rel="stylesheet" href="{{ asset('admin/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}} ">

@endsection


@section('admin_js')
<!--Specific js exclusive for this page-->
<script src="{{ asset('admin/bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('admin/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>

<script>
        $(function () {
          $('#example1').DataTable()
          $('#example2').DataTable({
            'paging'      : true,
            'lengthChange': false,
            'searching'   : false,
            'ordering'    : true,
            'info'        : true,
            'autoWidth'   : false
          })
        })
      </script>
@endsection