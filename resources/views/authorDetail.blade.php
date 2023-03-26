@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="panel-heading">
                <div class="pull-right hidden-xs mb-4">
                    <a href="{{route('authors')}}" class="btn btn-block btn-primary btn-xs">Back</a>
                </div>
                @if (session('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                @endif
            </div>
            <div class="card">
                <div class="card-header">{{ __('Author Details') }}</div>
                <div class="card-body">
                <div class="panel-body">
                    <div class="form-content">
                        <div class="panel with-nav-tabs panel-default">
                            <div class="panel-body">
                                <div class="col-xs-12">
                                    <div class="table-responsive">
                                        <div class="col-xs-6">
                                            <p class="lead"> 
                                                @if(count($detail['books']) == 0)
                                                    <a href="{{route('author.delete', $detail['id'])}}" onclick="return confirm('Are you sure?')" class="btn btn-sm btn-danger">Delete Author</a>
                                                @endif
                                            </p>
                                            <table class="table table-responsive">
                                                <tr>
                                                    <th>Author Name:</th>
                                                    <td>{{ucfirst($detail['first_name'])}} {{ucfirst($detail['last_name'])}}</td>
                                                </tr>
                                                <tr>
                                                    <th>Birthday:</th>
                                                    <td>{{($detail['birthday'])}}</td>
                                                </tr>
                                                <tr>
                                                    <th>Gender:</th>
                                                    <td>{{$detail['gender']}}</td>
                                                </tr>
                                                <tr>
                                                    <th>Birth Place:</th>
                                                    <td>{{$detail['place_of_birth']}}</td>
                                                </tr>
                                            </table>
                                        </div>                                    
                                    </div>
                                    <div class="card">
                                    <div class="card-header">{{ __('Book Details') }}</div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <div class="col-xs-6">
                                                @if(!empty($detail['books']))
                                                    <table class="table">
                                                        <thead>
                                                            <tr>
                                                            <th scope="col">#</th>
                                                            <th scope="col">Book Title</th>
                                                            <th scope="col">Descrition</th>
                                                            <th scope="col">Release Date:</th>
                                                            <th scope="col">Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach($detail['books'] as $key => $book)
                                                            <tr>
                                                                <th scope="row">{{++$key}}</th>
                                                                <td>{{ucfirst($book['title'])}}</td>
                                                                <td>{{$book['description']}}</td>
                                                                <td>{{date("Y-m-d", strtotime($book['release_date']))}}</td>
                                                                <td><a href="{{route('book.delete', $book['id'])}}" onclick="return confirm('Are you sure?')" class="btn btn-sm btn-danger">Delete</a></td>
                                                            </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                @else
                                                    Books not found of this author.
                                                @endif
                                            </div>                                    
                                        </div>                                   
                                    </div>                                   
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
