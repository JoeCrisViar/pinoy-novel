@extends('user/app')

@section('bg-img', Storage::disk('local')->url($post->cover_image))

@section('title', $post->title )

@section('sub-heading', $post->subtitle )
 
@section('main')
      {{-- FB comment script --}}
      <div id="fb-root"></div>
        <script>(function(d, s, id) 
          {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s); js.id = id;
            js.src = 'https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.1';
            fjs.parentNode.insertBefore(js, fjs);
          }(document, 'script', 'facebook-jssdk'));
        </script>
      {{-- End FB comment script --}}

    <!-- Post Content -->
    <article>
            <div class="container">

              <div class="row">
                  
                <div class="col-lg-8 col-md-10 col-sm-12 mx-auto">
                    <small><i>Posted By: Urek Mazino</i></small><br>
                    <small><i>{{ $post->created_at->diffForHumans() }}</i></small>
                      
                    {!! htmlspecialchars_decode($post->body) !!}
                                
                </div>
                <div class="col-lg-6 col-md-10 col-sm-12">
                  <center>
                  <h4>TAGS</h4>
                    @foreach($post->tags as $tag)
                      <a href="{{ route('tag', $tag->slug) }}" class="">| {{$tag->name}} |</a>
                    @endforeach
                  </center>
                </div>
                <div class="col-lg-6 col-md-10 col-sm-12">
                  <center>
                    <h4>CATEGORIES</h4>
                    @foreach($post->categories as $category)
                      <a href="{{ route('category', $category->slug) }}" class="">| {{$category->name}} |</a>
                    @endforeach
                  </center>
                </div>
                <br><br><br><br>
                <div class="col-lg-8 col-md-10 mx-auto">
                    {{-- FB Actual Comment section --}}
                  <div class="fb-comments" data-href="{{ Request::url() }}" data-numposts="5" data-width="750">
                  </div>
                </div>
              </div>
            </div>
          
      </article>
      
          <hr>
@endsection
@section('user_css')
<link href="{{asset('user/css/prism.css')}}" rel="stylesheet">
@endsection
@section('user_js')
<script src="{{asset('user/js/prism.js')}}"></script>
@endsection