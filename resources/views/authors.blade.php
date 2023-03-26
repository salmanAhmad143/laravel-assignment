@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <a href="{{route('book.create')}}" class="btn btn-primary mb-3">Add New Book</a>
            <div class="card">
                <div class="card-header">{{ __('Author List') }}</div>

                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if(!empty($authors))
                        <table class="table">
                            <thead>
                                <tr>
                                <th scope="col">#</th>
                                <th scope="col">Author Name</th>
                                <th scope="col">Birthday</th>
                                <th scope="col">Gender</th>
                                <th scope="col">Birth Place</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($authors['items'] as $key => $author)
                                <tr>
                                    <th scope="row">{{++$key}}</th>
                                    <td><a href="{{route('author.detail', $author['id'])}}">{{$author['first_name']}} {{$author['last_name']}}</a></td>
                                    <td>{{date("Y-m-d", strtotime($author['birthday']))}}</td>
                                    <td>{{$author['gender']}}</td>
                                    <td>{{$author['place_of_birth']}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
