@extends('app')

@section('content')
    <div class="container">
        <h3>Editar Categoria '{{$cupoms->name}}'</h3>

        <br>

        @include('errors._check')
        <br>

        {!! Form::model($cupoms, ['route' => ['admin.cupoms.update', $cupoms->id]]) !!}
            @include('admin.cupoms._form')

            <div class="form-group">
                {!! Form::submit('Salvar Categoria', ['class' => 'btn btn-primary']) !!}
            </div>



        {!! Form::close() !!}

    </div>

@endsection