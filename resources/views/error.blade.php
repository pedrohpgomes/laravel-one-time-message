@extends('layouts.app_layout')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col text-center">
                <h5>Aconteceu um erro inesperado.</h5>
                <div class="my-5">
                    <a href="{{route('main_index')}}" class="btn btn-primary">Voltar</a>
                </div>
            </div>
        </div>
    </div>
@endsection