<!-- Name form input -->

<div class="form-group">
    {!! Form::label('Status','Status:') !!}
    {!! Form::select('status',$list_status,  null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('Entregador','Entregador:') !!}
    {!! Form::select('user_deliveryman_id',$deliveryman,  null, ['class' => 'form-control']) !!}
</div>

