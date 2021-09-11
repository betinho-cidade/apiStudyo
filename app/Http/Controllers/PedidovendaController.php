<?php

namespace App\Http\Controllers;

use App\Models\Pedidovenda as PedidoVenda;
use App\Http\Resources\Pedidovenda as PedidovendaResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PedidovendaController extends Controller
{

    public function index(){
        $pedidovendas = Pedidovenda::join('cadcftv', 'pedidovenda.cadcftvid', '=', 'cadcftv.cadcftvid')
                                    ->where('pedidovenda.status_pedidovenda', '=', 'ABERTO')
                                    ->join('pedidovenda_item', 'pedidovenda_item.pedidovendaid', '=', 'pedidovenda.pedidovendaid')
                                    ->select(['pedidovenda.pedidovendaid as pedidovendaid',
                                              'pedidovenda.status_pedidovenda as status_pedidovenda',
                                              'pedidovenda.vl_totalprod_pedidovenda as vl_totalprod_pedidovenda',
                                               DB::raw("TO_CHAR(pedidovenda.dt_pedidovenda,'DD-MM-YYYY') as dt_pedidovenda"),
                                              'cadcftv.cadcftvid as cadcftvid',
                                              'cadcftv.nome_cadcftv as nome_cadcftv',
                                              'cadcftv.cnpjcpf_cadcftv as cnpjcpf_cadcftv',
                                              DB::raw("LISTAGG(pedidovenda_item.PRODUTOID  || ':?:' || pedidovenda_item.DS_PRODUTO_PEDIDOVENDA_ITEM || ':?:' || pedidovenda_item.QT_PEDIDOVENDA_ITEM || ':?:' || pedidovenda_item.VL_TOTAL_PEDIDOVENDA_ITEM, ':$:') WITHIN GROUP (ORDER BY pedidovenda_item.DS_PRODUTO_PEDIDOVENDA_ITEM) AS ITENS"),
                                              ])
                                    ->groupBy('pedidovenda.pedidovendaid',
                                              'pedidovenda.status_pedidovenda',
                                              'pedidovenda.vl_totalprod_pedidovenda',
                                              'dt_pedidovenda',
                                              'cadcftv.cadcftvid',
                                              'cadcftv.nome_cadcftv',
                                              'cadcftv.cnpjcpf_cadcftv')
                                    ->orderBy('pedidovenda.dt_pedidovenda', 'desc')
                                    ->paginate(15);

        return PedidovendaResource::collection($pedidovendas);
      }

      public function show($id){
        $pedidovendas = Pedidovenda::join('cadcftv', 'pedidovenda.cadcftvid', '=', 'cadcftv.cadcftvid')
                                    ->where('cadcftv.cnpjcpf_cadcftv', $id)
                                    ->join('pedidovenda_item', 'pedidovenda_item.pedidovendaid', '=', 'pedidovenda.pedidovendaid')
                                    ->select(['pedidovenda.pedidovendaid as pedidovendaid',
                                              'pedidovenda.status_pedidovenda as status_pedidovenda',
                                              'pedidovenda.vl_totalprod_pedidovenda as vl_totalprod_pedidovenda',
                                               DB::raw("TO_CHAR(pedidovenda.dt_pedidovenda,'DD-MM-YYYY') as dt_pedidovenda"),
                                              'cadcftv.cadcftvid as cadcftvid',
                                              'cadcftv.nome_cadcftv as nome_cadcftv',
                                              'cadcftv.cnpjcpf_cadcftv as cnpjcpf_cadcftv',
                                              DB::raw("LISTAGG(pedidovenda_item.PRODUTOID  || ':?:' || pedidovenda_item.DS_PRODUTO_PEDIDOVENDA_ITEM || ':?:' || pedidovenda_item.QT_PEDIDOVENDA_ITEM || ':?:' || pedidovenda_item.VL_TOTAL_PEDIDOVENDA_ITEM, ':$:') WITHIN GROUP (ORDER BY pedidovenda_item.DS_PRODUTO_PEDIDOVENDA_ITEM) AS ITENS"),
                                              ])
                                    ->groupBy('pedidovenda.pedidovendaid',
                                              'pedidovenda.status_pedidovenda',
                                              'pedidovenda.vl_totalprod_pedidovenda',
                                              'dt_pedidovenda',
                                              'cadcftv.cadcftvid',
                                              'cadcftv.nome_cadcftv',
                                              'cadcftv.cnpjcpf_cadcftv')
                                    ->orderBy('pedidovenda.dt_pedidovenda', 'desc')
                                    ->paginate(15);

        return PedidovendaResource::collection($pedidovendas);

      }

}
