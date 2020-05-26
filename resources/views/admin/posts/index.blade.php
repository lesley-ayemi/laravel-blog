@extends('layouts.admin')


@section('content')

<h1>Posts</h1>

<table class="table">
    <thead>
      <tr>
        <th>ID</th>
        <th>Photo</th>
        <th>Title</th>
        <th>Owner</th>
        <th>Category </th>
        <th>View Post</th>
        <th>Comments</th>
        <th>Created</th>
        <th>Updated</th>
        <th>Actions</th>


      </tr>
    </thead>
    <tbody>
        @if ($posts)
        @foreach ($posts as $post)
      <tr>
      <td>{{$post->id}}</td>
      <td><img height="50" src="{{$post->photo ? $post->photo->file : 'https://place-hold.it/300x500'}}" alt=""></td>
      <td>{{$post->title }}</td>
      <td class="text-success"><b>{{ $post->user ? $post->user->name : 'No User Yet' }}</b></td>
      <td>{{$post->category ? $post->category->name : 'No Category'}}</td>
      <td><a href="{{route('home.post', $post->slug)}}">View Post</a></td>
      <td><a href=" {{route('admin.comments.show', $post->id)}} ">View Comments</a></td>
      <td>{{$post->created_at->diffForHumans()}}</td>  
      <td>{{$post->updated_at->diffForHumans()}}</td>
      <td>
      <a class="btn btn-success btn-sm" type="button" href="{{route('admin.posts.edit', $post->id)}}">
        {{-- <i class="fa fa-edit fa-lg"></i> --}}
        Edit
      </a>
      /
      <a type="button" class="btn btn-danger btn-sm" href="{{route('admin.posts.edit', $post->id)}}">
        {{-- <i class="fa fa-trash fa-lg"></i> --}} Delete
      </a>
      </td>


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