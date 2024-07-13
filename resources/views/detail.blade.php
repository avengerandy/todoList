@extends('_container')

@section('title')
    Todo Details
@endsection

@section('content')
    <form action="/delete/{{$todo->id}}" method="post">
        @csrf
        <div class="card text-center mt-5">
            <div class="card-header">
                <b>TODO DETAILS</b>
            </div>
            <div class="card-body">
                <h5 class="card-title">{{$todo->title}}</h5>
                <p class="card-text" style="white-space: pre-line">{{$todo->description}}.</p>
                <a href="/edit/{{$todo->id}}"><span class="btn btn-primary">Edit</span></a>
                <input type="submit" class="btn btn-danger" value="Delete">
            </div>
        </div>
    </form>
@endsection
