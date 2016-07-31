@extends('app')

@section('content')
    <div class="container">
        <h3>Nova Categoria</h3>

        <br>

        @if($errors->any())
            <ul class="alert">
                @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        @endif
        <br>

        {!! Form::open(['route' => 'admin.categories.store']) !!}
            <!-- Name form input -->
            <div class="form-group">
                {!! Form::label('Name','Nome:') !!}
                {!! Form::text('name',null, ['class' => 'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::submit('Criar Categoria', ['class' => 'btn btn-primary']) !!}
            </div>



        {!! Form::close() !!}

    </div>

@endsection