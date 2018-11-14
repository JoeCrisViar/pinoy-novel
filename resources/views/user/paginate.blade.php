@foreach($posts as $post)
    <div class="post-preview">
        <a href="{{ route('post', $post->slug) }}">
            <h2 class="post-title">
                    {{$post->title}}
            </h2>
            <h3 class="post-subtitle">
                    {{$post->subtitle}}
            </h3>
        </a>
        <p class="post-meta">Posted by
            <a href="#">Urek Mazino</a><br>
            {{ $post->created_at->diffForHumans() }}</p>
    </div>
        <hr>
@endforeach

<div class="clearfix">
            <center>{!! $posts->render() !!}</center>
</div>

            
