@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="pull-right hidden-xs mb-4">
                <a href="{{route('authors')}}" class="btn btn-block btn-primary btn-xs">Back</a>
            </div>
            <div class="card">
                <div class="card-header">{{ __('Add New Book') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('book.store') }}">
                        @csrf
                        <div class="row mb-3">
                            <label for="author" class="col-md-4 col-form-label text-md-end">{{ __('Author') }}</label>

                            <div class="col-md-6">
                                <select id="author" type="text" class="form-select" name="author" required autocomplete="author" autofocus>
                                    <option>Select</option>
                                    @foreach($authors['items'] as $author)
                                        <option value="{{$author['id']}}">{{$author['first_name']}}</option>
                                    @endforeach
                                </select>
                                @error('author')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="title" class="col-md-4 col-form-label text-md-end">{{ __('Title') }}</label>

                            <div class="col-md-6">
                                <input id="title" type="title" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') }}" required autocomplete="title" autofocus>

                                @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="description" class="col-md-4 col-form-label text-md-end">{{ __('Description') }}</label>

                            <div class="col-md-6">
                                <textarea id="description" class="form-control" name="description" value="{{ old('description') }}" required autocomplete="description"></textarea>

                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="release_date" class="col-md-4 col-form-label text-md-end">{{ __('Release Date') }}</label>

                            <div class="col-md-6">
                                <input id="release_date" type="release_date" class="form-control @error('release_date') is-invalid @enderror" name="release_date" value="{{ old('release_date') }}" placeholder="YYYY-MM-DD" required autocomplete="release_date" autofocus>

                                @error('release_date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Add') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
