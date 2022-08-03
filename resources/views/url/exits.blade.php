@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">Short URLs Exits</div>

                <div class="card-body">
                    <a href="{{route('url.exit')}}" class="btn btn-outline-secondary m-2">Home</a>
                    <table class="mt-2 table table-striped">
                        <thead>
                            <tr>
                                <th>URL</th>
                                <th>Short URL</th>
                                <th>Expires</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($urls as $url)
                                <tr class="{{$url->deactivated_at > now() ? diaabled :''}}">
                                    <td>{{$url->destination_url}}</td>
                                    <td>
                                        @if($url->deactivated_at > now())
                                            <a href="{{$url->destination_url}}" target="_blank">
                                                {{$url->default_short_url}}
                                            </a>
                                        @else
                                            URL Disabled
                                        @endif
                                    </td>
                                    <td>{{$url->deactivated_at}}</td>
                                    <td>
                                        <form action="{{ route('url.destroy', $url->id) }}" method="post">
                                            @csrf
                                            @method("DELETE")
                                            @if($url->deactivated_at > now() || $url->deactivated_at == null)
                                                <a href="{{route('url.disable',$url->id)}}" class="btn btn-warning btn-sm">Disable</a>
                                            @endif
                                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                          </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
