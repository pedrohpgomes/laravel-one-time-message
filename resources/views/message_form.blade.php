@extends('layouts.app_layout')

@section('content')
    <div class="row">
        <div class="col-sm-4 offset-sm-4">
            <form action="{{route('main_init')}}" method="POST">
                @csrf

                <div class="form-group my-3">
                    <label for="text-from">From:</label>
                    <input type="email" name="text_from" id="text_from" class="form-control" value="{{old('text_from')}}">
                </div>
                
                <div class="form-group my-3">
                    <label for="text-from">To:</label>
                    <input type="email" name="text_to" id="text_to" class="form-control" value="{{old('text_to')}}">
                </div>

                <div class="form-group my-3">
                    <label for="text-message">Message:</label>
                    <textarea name="text_message" id="text_message" cols="30" maxlength="250" rows="5" class="form-control">{{old('text_message')}}</textarea>
                </div>

                <div class="text-center">
                    <input type="submit" value="Send one time message" class="btn btn-primary">
                </div>

            </form>

            @if ($errors->any())
                <div class="alert alert-danger my-2 p-2">
                    <ul>
                        @foreach ( $errors->all() as $error )
                            <li>{{$error}}</li>
                        @endforeach                        
                    </ul>
                </div>                
            @endif

        </div>
    </div>
@endsection