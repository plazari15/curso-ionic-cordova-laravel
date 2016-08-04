<?php

namespace CodeDelivery\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Order extends Model implements Transformable
{
    use TransformableTrait;

    protected $fillable = [
        'client_id',
        'user_deliveryman_id',
        'total',
        'status'
    ];

    //Vai pegar todos os itens do pedido
    public function items(){
        return $this->hasMany(OrderItem::class);
    }

    //Vai acessar um determinado model de quem tem aquele id
    public function deliveryman(){
        return $this->belongsTo(User::class);
    }

    //Vai obter todos os produtos
    public function products(){
        return $this->hasMany(Product::class);
    }

}
