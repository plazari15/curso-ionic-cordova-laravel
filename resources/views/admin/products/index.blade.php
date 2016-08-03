@extends('app')

@section('content')
    <div class="container">
        <h3>Produtos</h3>

        <br>

        <a href="{{ route('admin.products.create') }}" class="btn btn-default">Novo Produto</a>

        <br>

        <table class="table table-bordered table-responsive">
            <thead>
            <tr>
                <th>ID</th>
                <th>Produto</th>
                <th>Categoria</th>
                <th>Ação</th>
            </tr>
            </thead>

            <tbody>
            @foreach($products as $product)
            <tr>
                <td>{{ $product->id }}</td>
                <td>{{ $product->name }}</td>
                <td>{{ $product->category->name }}</td>
                <td>
                    <a href="{{route('admin.products.edit', ['id'=>$product->id])}}" class="btn btn-default btn-small">
                        Editar
                    </a>
                </td>
            </tr>
            @endforeach
            </tbody>

        </table>

        {!! $products->render() !!}

    </div>

@endsection