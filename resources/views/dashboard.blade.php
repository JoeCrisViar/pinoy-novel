@extends('user/app')

@section('bg-img', asset('user/img/contact-bg.jpg'))

@section('title', 'TAPI-Blog' )

@section('sub-heading', 'Please Register here!' )
 
@section('main')
      

    <!-- Post Content -->
    <article>
            <div class="container">

              <div class="row">
                    <div class="col-lg-8 col-md-10 col-sm-12 mx-auto">
                            <div class="panel panel-default">
                                    <div class="panel-heading">Dashboard</div>
                    
                                    <div class="panel-body">
                                        @if (session('status'))
                                            <div class="alert alert-success">
                                                {{ session('status') }}
                                            </div>
                                        @endif
                    
                                        Welcome {{ Auth::user()->name }}! You are logged in!
                                    </div>
                                </div>
                    </div>
              </div>
            </div>
          
      </article>
      
          <hr>
@endsection
@section('user_css')

@endsection
@section('user_js')

@endsection






