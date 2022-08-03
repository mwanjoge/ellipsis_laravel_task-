@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">Short URLs</div>

                <div class="card-body">
                    <form action="{{route('url.generate')}}" method="POST">
                        @csrf
                        <div class="input-group">
                            <span class="input-group-text">URL</span>
                            <input type="text" name="url" class="form-control @error('url') is-invalid @enderror" value="{{ old('url') }}" placeholder="Enter full URL">
                            <label class="input-group-text">Expires in</label>
                            <input type="date" class="form-control @error('expires') is-invalid @enderror" value="{{ old('expires') }}"  name="expires">
                            <button type="submit" class="btn btn-primary" type="button">Generate</button>
                        </div>

                        <div class="d-flex flex-row">
                            @error('url')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            @error('expires')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </form>

                    <a href="{{route('url.exit')}}" class="btn btn-outline-primary m-2">URL Exits</a>
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
                                <tr>
                                    <td>{{$url->destination_url}}</td>
                                    <td>{{$url->default_short_url}}</td>
                                    <td>{{$url->deactivated_at}}</td>
                                    <td>
                                        <form action="{{ route('url.destroy', $url->id) }}" method="post">
                                            @csrf
                                            @method("DELETE")
                                            <a href="{{route('url.disable',$url->id)}}" class="btn btn-warning btn-sm">Disable</a>
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
