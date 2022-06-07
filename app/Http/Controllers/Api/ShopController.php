<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ShopRequest;
use App\Repository\Eloquent\ShopRepository;
use Illuminate\Http\Request;


class ShopController extends Controller
{
    public function __construct(private ShopRepository $shopRepository)
    {
    }

    /**
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(ShopRequest $request)
    {
        return $this->shopRepository->search($request);
    }
}
