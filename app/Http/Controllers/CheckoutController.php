<?php

namespace CodeDelivery\Http\Controllers;


use CodeDelivery\Repositories\OrderRepository;
use CodeDelivery\Repositories\ProductRepository;
use CodeDelivery\Repositories\UserRepository;
use CodeDelivery\Services\OrderService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class CheckoutController extends Controller
{
    private $repository;
    /**
     * @var UserRepository
     */
    private $userRepository;
    /**
     * @var ProductRepository
     */
    private $productRepository;
    /**
     * @var OrderService
     */
    private $orderService;

    /**
     * CheckoutController constructor.
     * @param OrderRepository $repository
     * @param UserRepository $userRepository
     * @param ProductRepository $productRepository
     * @param OrderService $orderService
     */
    public function __construct(
        OrderRepository $repository,
        UserRepository $userRepository,
        ProductRepository $productRepository,
        OrderService $orderService
    )
    {
        $this->repository = $repository;
        $this->userRepository = $userRepository;
        $this->productRepository = $productRepository;
        $this->orderService = $orderService;
    }

    public function index(){
        $client_id = $this->userRepository->find(Auth::user()->id)->client->id;
        $orders = $this->repository->scopeQuery(function ($query) use($client_id){
           return $query->where('client_id', '=', $client_id);
        })->paginate();

        dd($orders);
    }

    public function create()
    {
        $products = $this->productRepository->list();

        return view('customer.order.create', compact('products'));
    }

    public function store(Request $request){
        $data = $request->all();
        $client_id = $this->userRepository->find(Auth::user()->id)->client->id;
        $data['client_id'] = $client_id;
        $this->orderService->Create($data);

        return redirect()->route('customer.order.index');
    }


}
