@extends('app')

@section('content')
    <div class="container">
        <h3>Nova Categoria</h3>

        <br>

        @include('errors._check')
        <br>

        {!! Form::open(['route' => 'admin.categories.store']) !!}

        @include('admin.categories._form')

            <div class="form-group">
                {!! Form::submit('Criar Categoria', ['class' => 'btn btn-primary']) !!}
            </div>



        {!! Form::close() !!}

    </div>

@endsection