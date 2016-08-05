<?php

namespace CodeDelivery\Http\Controllers;

use CodeDelivery\Http\Requests\AdminCategoryRequest;
use CodeDelivery\Repositories\CategoryRepository;
use CodeDelivery\Repositories\OrderRepository;
use CodeDelivery\Repositories\UserRepository;
use Illuminate\Http\Request;
use Jenssegers\Date\Date;
use Symfony\Component\VarDumper\Cloner\Data;


class OrdersController extends Controller
{
    private $repository;

    public function __construct(OrderRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        $orders = $this->repository->paginate();
        return view('admin.orders.index', compact('orders'));
    }


    public function edit($id, UserRepository $userRepository)
    {
        $list_status = [
            0 => 'Pendente',
            1 => 'A Caminho',
            2 => 'Entregue'
        ];
        $order = $this->repository->find($id);
        $deliveryman = $userRepository->getDeliveryMen();
        return view('admin.orders.edit', compact('order', 'list_status', 'deliveryman'));
    }

    public function update(Request $request, $id)
    {
        $all = $request->all();
        $this->repository->update($all, $id);

        return redirect(route('admin.orders.index'));
    }



}
