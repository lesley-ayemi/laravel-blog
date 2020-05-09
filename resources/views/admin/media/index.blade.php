@extends('layouts.admin')


@section('content')

<h1>Media</h1>

@if ($photos)
    
<form action="delete/media" method="POST" class="form-inline">

    {{ csrf_field() }}

    {{method_field('delete')}}

    <div class="form-group">
        <select name="checkBoxArray" id="" class="form-control">

            <option value="">Delete</option>

        </select>
    </div>
    <div class="form-group">
        <input type="submit" name="delete_all" class="btn btn-danger">
    </div>

<table class="table">
    <thead>
        <tr>
            <th><input type="checkbox" id="options"></th>
            <th>Id</th>
            <th>Name</th>
            <th>Created</th>
        </tr>
    </thead>

@foreach ($photos as $photo)
<tbody>
    <tr>
    <td><input class="checkBoxes" type="checkbox" name="checkBoxArray[]" value="{{$photo->id}}" ></td>
    <td>{{$photo->id}}</td>
    <td><img height="50" src="{{$photo->file ? $photo->file : 'No Image'}}" alt=""></td>
    <td>{{$photo->created_at ? $photo->created_at : 'No Date'}}</td>
    <td>

        <input type="hidden" name="photo" value="{{$photo->id}}">
    

        {{-- <div class="form-group">
            <input type="submit" name="delete_single" value="Delete" class="btn btn-danger">
        </div> --}}





    </td>
    </tr>
</tbody>

    @endforeach
</table>
</form>

@endif

{{$photos->render()}}



    
@endsection


@section('scripts')

<script>

    $(document).ready(function(){
    
        $('#options').click(function(){

            if(this.checked){
                $('.checkBoxes').each(function(){

                    this.checked = true;

                });
            }
            else{

                $('.checkBoxes').each(function(){

                this.checked = false;

                });
                
            }



        });
    
    });
    
    
    </script>
    
@endsection