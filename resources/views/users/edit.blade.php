@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <form action="/user/{{ $user->id }}" method="post">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}
                        <div class="form-group pd10">
                            <label for="first_name">First Name</label>
                            <input class="form-control" id="first_name" name="first_name" value="{{ $user->first_name }}">
                            @if ($errors->has('first_name'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('first_name') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group pd10">
                            <label for="last_name">Last Name</label>
                            <input class="form-control" id="last_name" name="last_name" value="{{ $user->last_name }}">
                            @if ($errors->has('last_name'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('last_name') }}</strong>
                                    </span>
                            @endif
                        </div>
                        <div class="form-group pd10">
                            <label for="description">Description</label>
                            <textarea id="description" class="form-control rounded-0" rows="3"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary mglb10">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection