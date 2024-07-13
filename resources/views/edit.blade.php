@extends('_container')

@section('title')
    Todo Edit
@endsection

@section('content')
    <form action="/update/{{$todo->id}}" method="post">
        @csrf
        <div class="form-group m-3">
            <label for="name">Todo Name</label>
            <input type="text" class="form-control" value="{{$todo->title}}" name="title">
        </div>
        <div class="form-group m-3">
            <label for="description">Todo Description</label>
            <textarea class="form-control" name="description" rows="3"> {{$todo->description}} </textarea>
        </div>
        <div class="form-group m-3">
            <input type="submit" class="btn btn-primary float-end" value="Submit">
        </div>
    </form>
@endsection
