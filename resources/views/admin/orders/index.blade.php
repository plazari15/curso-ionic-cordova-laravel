@extends('app')

@section('content')
    <div class="container">
        <h3>Pedidos</h3>



        <br>

        <table class="table table-bordered table-responsive">
            <thead>
            <tr>
                <th>ID</th>
                <th>Total</th>
                <th>Data</th>
                <th>Modificado</th>
                <th>Itens</th>
                <th>Entregador</th>
                <th>Status</th>
                <th>Ação</th>
            </tr>
            </thead>

            <tbody>
            @foreach($orders as $order)
            <tr>
                <td>#{{ $order->id }}</td>
                <td>R$ {{ $order->total }}</td>
                <td>{{ $order->created_at->format('d/m/Y H:i:s') }}</td>
                <td>{{$order->updated_at->format('d/m/Y H:i:s')}}</td>
                <td>
                    <ul>
                    @foreach($order->items as $item)
                        <li>{{ $item->product->name }} - R$ {{$item->product->price}}</li>
                    @endforeach
                    </ul>
                </td>
                <td>
                    @if($order->deliveryman)
                        {{$order->deliveryman->name}}
                    @else
                        Nenhum cadastrado
                    @endif
                </td>
                <td>{{$order->status}}</td>
                <td>
                    <a href="{{route('admin.orders.edit', ['id'=>$order->id])}}" class="btn btn-default btn-small">
                        Editar
                    </a>
                </td>
            </tr>
            @endforeach
            </tbody>

        </table>

        {!! $orders->render() !!}

    </div>

@endsection