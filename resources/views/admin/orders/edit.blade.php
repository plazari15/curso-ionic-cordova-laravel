@extends('app')

@section('content')
    <div class="container">
        <h3>Editar Produto '{{orders->name}}'</h3>

        <br>

        @include('errors._check')
        <br>

        {!! Form::model($product, ['route' => ['admin.products.update', $product->id]]) !!}
            @include('admin.products._form')

            <div class="form-group">
                {!! Form::submit('Salvar', ['class' => 'btn btn-primary']) !!}
            </div>



        {!! Form::close() !!}

    </div>

@endsection