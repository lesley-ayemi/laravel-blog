@extends('layouts.admin');


@section('content')

<h1>Media</h1>

@if ($photos)
    


<table class="table">
    <thead>
        <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Created</th>
        </tr>
    </thead>

@foreach ($photos as $photo)
<tbody>
    <tr>
    <td>{{$photo->id}}</td>
    <td><img height="50" src="{{$photo->file ? $photo->file : 'No Image'}}" alt=""></td>
    <td>{{$photo->created_at ? $photo->created_at : 'No Date'}}</td>
    </tr>
</tbody>

    @endforeach
</table>

@endif
    
@endsection