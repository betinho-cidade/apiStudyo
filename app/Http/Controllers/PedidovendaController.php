<?php

namespace App\Http\Controllers;

use App\Models\Pedidovenda as PedidoVenda;
use App\Http\Resources\Pedidovenda as PedidovendaResource;
use Illuminate\Http\Request;

class PedidovendaController extends Controller
{

    public function index(){
        $pedidovendas = Pedidovenda::join('cadcftv', 'pedidovenda.cadcftvid', '=', 'cadcftv.cadcftvid')
                                    ->where('pedidovenda.status_pedidovenda', '=', 'ABERTO')
                                    ->select(['pedidovenda.pedidovendaid as pedidovendaid',
                                              'pedidovenda.status_pedidovenda as status_pedidovenda',
                                              'pedidovenda.vl_totalprod_pedidovenda as vl_totalprod_pedidovenda',
                                              'cadcftv.cadcftvid as cadcftvid',
                                              'cadcftv.nome_cadcftv as nome_cadcftv',
                                              'cadcftv.cnpjcpf_cadcftv as cnpjcpf_cadcftv'
                                              ])
                                    ->paginate(15);

        return PedidovendaResource::collection($pedidovendas);
      }

      public function show($id){
        $pedidovendas = Pedidovenda::join('cadcftv', 'pedidovenda.cadcftvid', '=', 'cadcftv.cadcftvid')
                                    ->where('cadcftv.cnpjcpf_cadcftv', $id)
                                    ->select(['pedidovenda.pedidovendaid as pedidovendaid',
                                              'pedidovenda.status_pedidovenda as status_pedidovenda',
                                              'pedidovenda.vl_totalprod_pedidovenda as vl_totalprod_pedidovenda',
                                              'cadcftv.cadcftvid as cadcftvid',
                                              'cadcftv.nome_cadcftv as nome_cadcftv',
                                              'cadcftv.cnpjcpf_cadcftv as cnpjcpf_cadcftv'
                                              ])
                                    ->paginate(15);

        return PedidovendaResource::collection($pedidovendas);

      }


}
