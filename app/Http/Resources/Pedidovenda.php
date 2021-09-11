<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Pedidovenda extends JsonResource
{

    public function toArray($request){
        //return parent::toArray($request);
        return [
          'pedidovendaid' => $this->pedidovendaid,
          'status' => $this->status_pedidovenda,
          'valor_pedido' => $this->vl_totalprod_pedidovenda,
          'data_pedido' => $this->dt_pedidovenda,
          'cadcftv_id' => $this->cadcftvid,
          'cadcftv_nome' => utf8_encode($this->nome_cadcftv),
          'cadcftv_cnpjcpf' => $this->cnpjcpf_cadcftv,
          'itens_pedido' => utf8_encode($this->itens),
        ];
      }

}
