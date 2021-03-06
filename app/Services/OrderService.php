<?php
/**
 * Created by PhpStorm.
 * User: Plazari
 * Date: 18/08/2016
 * Time: 01:28
 */

namespace CodeDelivery\Services;


use CodeDelivery\Models\Cupom;
use CodeDelivery\Repositories\CupomRepository;
use CodeDelivery\Repositories\OrderRepository;
use CodeDelivery\Repositories\ProductRepository;

/**
 * Class OrderService
 * @package CodeDelivery\Services
 * EXPLICAÇÃO: Service é um serviço, e nele você coloca a regra de negocio da sua aplicaç~ão, por exemplo
 * se eu tenho uma aplicação que para ela acontecer ela tem que remover um item do estoque, consultar cupoms
 * e notificar um departamento e ainda enviar um email para o cliente, eu com certeza devo criar uma service!
 */
class OrderService
{

    /**
     * @var OrderRepository
     */
    private $orderRepository;
    /**
     * @var CupomRepository
     */
    private $cupomRepository;
    /**
     * @var ProductRepository
     */
    private $productRepository;

    public function __construct(OrderRepository $orderRepository, CupomRepository $cupomRepository, ProductRepository $productRepository)
    {
        $this->orderRepository = $orderRepository;
        $this->cupomRepository = $cupomRepository;
        $this->productRepository = $productRepository;
    }

    public function Create(array $data){
        \DB::beginTransaction();
        try {
            $data['satus'] = 0;
            if(isset($data['cupom_code'])){
                $cupom = $this->cupomRepository->findByField('code', $data['cupom_code'] )->first();
                $data['cupom_id'] = $cupom->id;
                $cupom->used = 1;
                $cupom->save();
                unset($data['cupom_code']);

            }

            $items = $data['items'];
            unset($data['items']);

            $order = $this->orderRepository->create($data);
            $total = 0;

            foreach ($items as $item){
                $item['price'] = $this->productRepository->find($item['product_id'])->price;
                $order->items()->create($item);
                $total += $item['price'] * $item['qtd'];
            }

            $order->total = $total;

            if(isset($cupom)){
                $order->total = $total - $cupom->value;
            }

            $order->save();
            \DB::commit();
        } catch (\Exception $e){
            \DB::rollback();
            throw $e;
        }

    }
}