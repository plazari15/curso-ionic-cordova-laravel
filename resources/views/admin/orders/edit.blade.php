@extends('app')

@section('content')
    <div class="container">
        <h2>Pedido #{{$order->id}} - R$ {{$order->total}}</h2>
        <h3>Cliente: {{$order->client->user->name}}</h3>
        <h4>Data: {{$order->created_at->diffForHumans()}}</h4>

        <p>
            <b>Entregar em:</b><br>
            {{$order->client->address}}<br>
            {{$order->client->city}} - {{$order->client->state}}<br>
            CEP: {{$order->client->zipcode}}
        </p>
        <br>

        {!! Form::model($order, ['route' => ['admin.orders.update', $order->id]]) !!}
        @include('admin.orders._form')

        <div class="form-group">
            {!! Form::submit('Salvar', ['class' => 'btn btn-primary']) !!}
        </div>



        {!! Form::close() !!}

        @include('errors._check')


    </div>

@endsection