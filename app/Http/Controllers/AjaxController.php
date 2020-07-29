<?php

namespace App\Http\Controllers;

use App\Micrositio;
use App\municipio;
use App\Producto;
use Illuminate\Support\Facades\DB;
class AjaxController extends Controller

{
    public function getMunicipios($estado){

        //se filtran los municipios del estado seleccionado
        $municipios = municipio::where('estado','=',$estado)->get();
        //se retornan como objeto json
        return json_encode($municipios);
    }


    public function getMicrositios($categoria){
       
        if($categoria == -1){
            $micrositios = Micrositio::where('id_estatus',1)->get();
        }
        else{
              $micrositios = Micrositio::where([['id_estatus',1],['id_categoria','=',$categoria]])->get();
        }    


        return json_encode($micrositios);
    }

    
    public function getBySearch($categoria,$palabra){
        if($categoria == -1){                //se obtienen solo los productos y micrositios que estén en estatus activo == 1   
            $micrositios = Micrositio::where([['id_estatus',1],
                                              ['nombre','like',$palabra.'%']])->get();
            $productos = Producto::
                                join('micrositios as m','m.id','productos.id_micrositio')
                                ->where([['productos.nombre','like',$palabra.'%'],
                                        ['productos.id_estatus',1] ]) 
                                ->select("productos.nombre as producto","productos.precio","productos.imagen_url",
                                         'm.id as id_micrositio','m.nombre as nombre','m.lat','m.lng')
                                ->get();
        }
        else{
            $micrositios = Micrositio::where([['id_categoria',$categoria],['nombre','like',$palabra.'%']])->get();
            $productos = Producto::
                            join('micrositios as m','m.id','productos.id_micrositio')
                            ->where([ ['m.id_categoria',$categoria],
                                      ['productos.nombre','like',$palabra.'%'],
                                      ['productos.id_estatus',1] ]) 
                            ->select("productos.nombre as producto","productos.precio","productos.imagen_url",
                                      'm.id as id_micrositio','m.nombre as nombre','m.descripcion','m.lat','m.lng')
                            ->get();
        }    

        $respuesta = array('micrositios'=>$micrositios, 'productos'=>$productos);

        return json_encode($respuesta);
    }

    //contabiliza la data para ser enviada a las graficas de donut
    function getDataDonut(){
        //conteo de estatus de Productos
         $p_activos = Producto::where('id_estatus',1)->count();
         $p_incativos = Producto::where('id_estatus',2)->count();

         //condeo de estatus de micrositios
         $m_activos = Micrositio::where('id_estatus',1)->count();
         $m_incativos = Micrositio::where('id_estatus',2)->count();
         $m_suspendidos = Micrositio::where('id_estatus',3)->count();
         $m_rechazados = Micrositio::where('id_estatus',4)->count();


         $contadores = array('p_activos'=>$p_activos,'p_inactivos'=>$p_incativos,
                             'm_activos'=>$m_activos,'m_inactivos'=>$m_incativos,'m_suspendidos'=>$m_suspendidos,'m_rechazados'=>$m_rechazados);  
                              
         return json_encode($contadores);

    }
}
