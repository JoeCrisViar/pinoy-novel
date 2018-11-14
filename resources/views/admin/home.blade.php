@extends('admin.app')

@section('main')
     <!-- Content Wrapper. Contains page content -->
     <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        @include('includes.content_header')
        <!-- Main content -->
        <section class="content">
           
            <div class="box-body">
                {{-- Data Tables --}}
                <div class="box">
                        
                        <!-- /.box-header -->
                        <div class="box box-primary">
                                <div class="box-header with-border">
                                    <h3 class="box-title">Home</h3>
                                   
                                    <div class="box-header">
                                            <!-- Display Errors -->
                                            @include('includes.messages')
                                    </div>
                                    <div class="box-tools pull-right">
                                        <div class="has-feedback">
                                        <input type="text" class="form-control input-sm" placeholder="Search Mail">
                                        <span class="glyphicon glyphicon-search form-control-feedback"></span>
                                        </div>
                                    </div>
                                    <!-- /.box-tools -->
                                    </div>
                                    <!-- /.box-header -->
                                    <div class="box-body no-padding">
                        
                                    <div class="mailbox-controls">
                                        <!-- Check all button -->
                                        <button type="button" class="btn btn-default btn-sm checkbox-toggle"><i class="fa fa-square-o"></i>
                                        </button>
                                        <div class="btn-group">
                                        <button type="button" class="btn btn-default btn-sm" name="bulk_delete" id="bulk_delete"><i class="fa fa-trash-o"></i></button>
                                        
                                        </div>
                                        <!-- /.btn-group -->
                                        <button type="button" class="btn btn-default btn-sm"><i class="fa fa-refresh"></i></button>
                                        <div class="pull-right">
                                        1-50/200
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></button>
                                            <button type="button" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></button>
                                        </div>
                                        <!-- /.btn-group -->
                                        </div>
                                        <!-- /.pull-right -->
                                    </div>
                        
                        
                                    <div class="table-responsive mailbox-messages">
                                        <table class="table table-hover table-striped">
                                        <tbody>
                                                @foreach ($posts as $post)
                                                <tr>
                                                    
                                                    <td>
                                                        <label>
                                                                <input type="checkbox" name="status" value="1">      
                                                        </label>
                                                    </td>
                                                  
                                                    <td>{{ $post->title }}</td>
                                                    <td>{{ $post->subtitle }}</td>
                                                    <td>{{ $post->created_at }}</td>
                                                </tr>
                                            @endforeach 
                                        
                                        </tbody>
                                        </table>
                                        <!-- /.table -->
                                    </div>
                                    <!-- /.mail-box-messages -->
                                    </div>
                                    <!-- /.box-body -->
                                    <div class="box-footer no-padding">
                                        <div class="mailbox-controls">
                                            <!-- Check all button -->
                                            <button type="button" class="btn btn-default btn-sm checkbox-toggle"><i class="fa fa-square-o"></i>
                                            </button>
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i></button>
                                            </div>
                                            <!-- /.btn-group -->
                                            <button type="button" class="btn btn-default btn-sm"><i class="fa fa-refresh"></i></button>
                                            <div class="pull-right">
                                            1-50/200
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></button>
                                                <button type="button" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></button>
                                            </div>
                                            <!-- /.btn-group -->
                                            </div>
                                        <!-- /.pull-right -->
                                    </div>
                                </div>
                            </div>
                        <!-- /.box-body -->
                      </div>
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
<link rel="stylesheet" href="{{ asset('admin/plugins/iCheck/flat/blue.css') }}">
@endsection

@section('admin_js')
<!--Specific js exclusive for this page-->
<script src="{{ asset('admin/bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('admin/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
<script src="{{ asset('admin/plugins/iCheck/icheck.min.js') }}"></script>
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
<script>
        $(function () {
          //Enable iCheck plugin for checkboxes
          //iCheck for checkbox and radio inputs
          $('.mailbox-messages input[type="checkbox"]').iCheck({
            checkboxClass: 'icheckbox_flat-blue',
            radioClass: 'iradio_flat-blue'
          });
      
          //Enable check and uncheck all functionality
          $(".checkbox-toggle").click(function () {
            var clicks = $(this).data('clicks');
            if (clicks) {
              //Uncheck all checkboxes
              $(".mailbox-messages input[type='checkbox']").iCheck("uncheck");
              $(".fa", this).removeClass("fa-check-square-o").addClass('fa-square-o');
            } else {
              //Check all checkboxes
              $(".mailbox-messages input[type='checkbox']").iCheck("check");
              $(".fa", this).removeClass("fa-square-o").addClass('fa-check-square-o');
            }
            $(this).data("clicks", !clicks);
          });
      
          //Handle starring for glyphicon and font awesome
          $(".mailbox-star").click(function (e) {
            e.preventDefault();
            //detect type
            var $this = $(this).find("a > i");
            var glyph = $this.hasClass("glyphicon");
            var fa = $this.hasClass("fa");
      
            //Switch states
            if (glyph) {
              $this.toggleClass("glyphicon-star");
              $this.toggleClass("glyphicon-star-empty");
            }
      
            if (fa) {
              $this.toggleClass("fa-star");
              $this.toggleClass("fa-star-o");
            }
          });
        });
      </script>
@endsection













    
        
