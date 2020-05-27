@if (Session::has('comment_message'))

{{session('comment_message')}}
    
@endif

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




