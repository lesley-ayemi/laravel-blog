@extends('layouts.admin')


@section('content')

<h1>Posts</h1>

<table class="table">
    <thead>
      <tr>
        <th>ID</th>
        <th>Photo</th>
        <th>Owner</th>
        <th>Category </th>
        <th>Title</th>
        <th>Body</th>
        <th>View Post</th>
        <th>Comments</th>
        <th>Created</th>
        <th>Updated</th>


      </tr>
    </thead>
    <tbody>
        @if ($posts)
        @foreach ($posts as $post)
      <tr>
      <td>{{$post->id}}</td>
      <td><img height="50" src="{{$post->photo ? $post->photo->file : 'https://place-hold.it/300x500'}}" alt=""></td>
      <td><a href="{{route('admin.posts.edit', $post->id)}}">{{ $post->user ? $post->user->name : 'No User Yet' }}</a></td>
      <td>{{$post->category ? $post->category->name : 'No Category'}}</td>
      <td>{{$post->title }}</td>
      <td>{{ str_limit($post->body, 20) }}</td>
      <td><a href="{{route('home.post', $post->id)}}">View Post</a></td>
      <td><a href=" {{route('admin.comments.show', $post->id)}} ">View Comments</a></td>
      <td>{{$post->created_at->diffForHumans()}}</td>  
      <td>{{$post->updated_at->diffForHumans()}}</td>


{{-- added carbon to the time stamp to make it more readable --}}
      </tr>
      @endforeach
      @endif
    </tbody>
  </table>

  <div class="row">
    <div class="col-sm-6 col-sm-offset-5">
      {{$posts->render()}}
    </div>
  </div>
    
    
@endsection