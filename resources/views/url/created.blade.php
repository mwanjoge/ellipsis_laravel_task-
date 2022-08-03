@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Short URLs</div>
                <div class="card-body">
                    <div class="alert alert-success">
                        Url successful created<br>
                        <a href="{{$url->destination_url}}">{{$url->default_short_url}}</a>
                    </div>
                    <a href="{{route('home')}}" class="btn btn-secondary">
                        Back
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
