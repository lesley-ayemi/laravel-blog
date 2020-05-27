@extends('layouts.blog-home')


@section('content')


<div class="row">

    <div class="col-md-8">

    <!-- Blog Post -->

    <!-- Title -->
    <h1>{{$post->title}}</h1>

    <!-- Author -->
    <p class="lead">
        by {{$post->user->name}}
    </p>   

    <hr>

    <!-- Date/Time -->
    <p><span class="glyphicon glyphicon-time"></span>Posted {{$post->created_at->diffForHumans()}}</p>

    <hr>

    <!-- Preview Image -->
    <img class="img-responsive" src="{{$post->photo ? $post->photo->file : 'http://placehold.it/900x300'}}" alt="">

    <hr>

    <!-- Post Content -->
{{-- filtering the images from file manager   --}}
    <p>{!! $post->body !!}</p> 

    {{-- <p class="lead">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ducimus, vero, obcaecati, aut, error quam sapiente nemo saepe quibusdam sit excepturi nam quia corporis eligendi eos magni recusandae laborum minus inventore?</p> --}}

    <hr>



    
    <!-- Blog Comments -->
    
    <!-- Comments Form -->
    @if (Auth::check())
        
    
    <div class="well">
        <h4>Leave a comment</h4>
    
    {!! Form::open(['method'=>'POST', 'action'=>'PostCommentsController@store']) !!}
    
    <input type="hidden" name="post_id" value="{{$post->id}}">
    
    <div class="form-group">
    {!! Form::label('body', 'Leave a Comment') !!}
    {!! Form::textarea('body', null, ['class'=>'form-control', 'rows'=>3]) !!}
    
    </div>
    
    {!! Form::submit('Submit Comment', ['class'=>'btn btn-primary']) !!}
    
    
    {!! Form::close() !!}
    </div>
    @endif
    
    {{-- <div class="well">
        <h4>Leave a Comment:</h4>
        <form role="form">
            <div class="form-group">
                <textarea class="form-control" rows="3"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div> --}}
    
    <hr>
    
    <!-- Posted Comments -->
    
    @if (count($comments) > 0)
    
    @foreach ($comments as $comment)
        
    
        
    <!-- Comment -->
    <div class="media">
        <a class="pull-left" href="#">
            <img height="64" class="media-object" src="{{Auth::user()->gravatar}}" alt="">
        </a>
        <div class="media-body">
            <h4 class="media-heading">{{$comment->author}}
                <small>{{$comment-> created_at->diffForHumans()}}</small>
            </h4>
            <p>{{$comment->body}}</p>
    
                 <!-- Nested Comment -->
                @if (count($comment->replies) > 0)
    
                @foreach ($comment->replies as $reply)
    
                @if ($reply->is_active == 1)
                                
    
    
                <div id="nested-comment" class="media">
                    <a class="pull-left" href="#">
                        <img height="50" class="media-object" src="{{$reply->photo}}" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading">{{$reply->author}}
                            <small>{{$reply->created_at->diffForHumans()}}</small>
                        </h4>
                    <p>{{$reply->body}}</p> 
                    </div>
    
                    <div class="comment-reply-container">
    
                        <button class="toggle-reply btn btn-primary pull-right">Reply</button>
    
                        <div class="comment-reply col-md-8">
    
                            {!! Form::open(['method'=>'POST', 'action'=>'CommentRepliesController@createReply']) !!}
    
                                <div class="form-group">
                                    <input type="hidden" name="comment_id" value="{{$comment->id}}">
                                    {!! Form::label('body', 'Reply:') !!}
                                    {!! Form::textarea('body', null, ['class'=>'form-control', 'rows'=>1]) !!}
                                </div>
    
                                <div class="form-group">
                                    {!! Form::submit('Submit', ['class'=>'btn btn-primaey']) !!}
                                </div>
    
                                {!! Form::close() !!}
                                <!-- End Nested Comment -->
                        </div>
                    </div>
    
                </div>
    
                @else
                <h1 class="text-center">No replies</h1>
    
                
    
            @endif 
    
            @endforeach
            @endif
        </div>
    </div>
    @endforeach
    @endif
    
    
    <!-- Comment -->

    
<!-- Disqus comment starts here!-->

</div> <!--col-md-8 !-->


@include('includes.front_sidebar')

</div> <!-- Row div !-->

    
@endsection



@section('scripts')

<script>

$(".comment-reply-container .toggle-reply ").click(function(){
    
    $(this).next().slideToggle("slow");

})


</script>

@endsection

    {{-- <div id="disqus_thread"></div> --}}
{{-- <script>

    /**
    *  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
    *  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables*/
    /*
    var disqus_config = function () {
    this.page.url = PAGE_URL;  // Replace PAGE_URL with your page's canonical URL variable
    this.page.identifier = PAGE_IDENTIFIER; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
    };
    */
    (function() { // DON'T EDIT BELOW THIS LINE
    var d = document, s = d.createElement('script');
    s.src = 'https://blog-wjc4adyu2q.disqus.com/embed.js';
    s.setAttribute('data-timestamp', +new Date());
    (d.head || d.body).appendChild(s);
    })();
</script> --}}
{{-- <noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
                            
<script id="dsq-count-scr" src="//blog-wjc4adyu2q.disqus.com/count.js" async></script> --}}