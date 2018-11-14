@extends('user/app')

@section('bg-img', asset('user/img/home-bg.jpg'))

@section('title', 'TAPI-Blog')

@section('sub-heading', 'Learn Together and Grow Together!')

@section('main')
    <!-- Main Content -->
    <div class="container">

        <div class="row">

            <div class="col-lg-8 col-md-10 mx-auto">
                <div id="tag_container">
                    {{-- Paginated Posts --}}
                    
                    @include('user/paginate')
                
                </div>
            </div>
        </div>
    </div>

    <hr>
  @endsection

  @section('user_js')

  <script type="text/javascript">
	$(window).on('hashchange', function() {
	        if (window.location.hash) {
	            var page = window.location.hash.replace('#', '');
	            if (page == Number.NaN || page <= 0) {
	                return false;
	            }else{
	                getData(page);
	            }
	        }
	    });
	$(document).ready(function()
	{
	     $(document).on('click', '.pagination a',function(event)
	    {
	        event.preventDefault();
	        $('li').removeClass('active');
	        $(this).parent('li').addClass('active');
	        var myurl = $(this).attr('href');
	        var page=$(this).attr('href').split('page=')[1];
	        getData(page);
	    });
	});
	function getData(page){
	        $.ajax(
	        {
	            url: '?page=' + page,
	            type: "get",
	            datatype: "html"
	        })
	        .done(function(data)
	        {
	            $("#tag_container").empty().html(data);
	            location.hash = page;
	        })
	        .fail(function(jqXHR, ajaxOptions, thrownError)
	        {
	              alert('No response from server');
	        });
	}
</script>   
@endsection