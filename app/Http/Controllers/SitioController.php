<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;

class SitioController extends Controller
{
    public function index()
    {
        return view('home');
    }

    public function informacion(Request $request)
    {
        //$contenedores = $request->pequenos;
        $dias =  $request->dias;
        $contenedores_pequenos=$request->pequenos;
        $contenedores_grandes=$request->grandes;
        $contenedores_pipas=$request->pipas;
        // $pregunta_uno = $request->pregunta_uno;
        $contenedores_pequenos_info="";
        $datos = $request->all();
        // $post = Post::create($request->all());
        
        $dia_info="";
        $servicios = $request->num_servicios;
        $informacion_servicios ="LOS NUMEROS DE SERVICIOS SON : <b>".$servicios."</b><br><br>";

        for ($i=0; $i <$servicios ; $i++) { 
            
            $informacion_servicios.= "DIAS DE SERVICIO NUMERO ".($i+1).": ";
            foreach ($dias as $dia) {

                // $posicion = (strpos($dia, "_")+1);
                $posicion = strpos($dia, "_");
                $dia_info = substr($dia,0,$posicion);
                if($dia_info==$i)
                { 
                    $nombre_dia = substr($dia,($posicion+1));
                    $informacion_servicios.= "<b>".$nombre_dia.", </b>";
                }     
            }
            $informacion_servicios.= "<br><br>";
            $informacion_servicios.="Los contenedores pequenos son: ";            
            foreach ($contenedores_pequenos as $contenedor_pequeno) {
                $posicion = strpos($contenedor_pequeno, "-");
                $pequeno_info = substr($contenedor_pequeno,0,$posicion);
                $num_servicio = substr($contenedor_pequeno,($posicion+1),1);

                if($num_servicio == $i)
                {
                    $informacion_servicios.="<b>".$pequeno_info.", </b>";
                }
               
            }

            $informacion_servicios.= "<br><br>";

            $informacion_servicios.="Los contenedores Grandes son: ";            
            foreach ($contenedores_grandes as $contenedor_grande) {
                $posicion = strpos($contenedor_grande, "-");
                $grande_info = substr($contenedor_grande,0,$posicion);
                $num_servicio = substr($contenedor_grande,($posicion+1),1);

                if($num_servicio == $i)
                {
                    $informacion_servicios.="<b>".$grande_info.", </b>";
                }
               
            }

            $informacion_servicios.= "<br><br>";

            $informacion_servicios.="Las Pipas son: ";            
            foreach ($contenedores_pipas as $contenedor_pipa) {
                $posicion = strpos($contenedor_pipa, "-");
                $pipa_info = substr($contenedor_pipa,0,$posicion);
                $num_servicio = substr($contenedor_pipa,($posicion+1),1);

                if($num_servicio == $i)
                {
                    $informacion_servicios.="<b>".$pipa_info.", </b>";
                }
               
            }


            $informacion_servicios.= "<br><br><hr>";
        }

        //Mail::send('emails.contact', $data, function ($message) {});

        
        $subject = "Cotizacion desde el sitio web";
        $for = "pablo.delfin@editorialogmios.com";
        $data = [ 'informacion' => $informacion_servicios,
                    'pregunta_uno' => $request->pregunta_uno,
                    'pregunta_dos' => $request->pregunta_dos,
                    'pregunta_tres' => $request->pregunta_tres,
                    'pregunta_cuatro' => $request->pregunta_cuatro,
                    'razon_social'=> $request->razon_social,
                    'ciudad_servicio'=> $request->ciudad_servicio,
                    'rfc'=> $request->rfc,
                    'tipo_contribuyente'=> $request->tipo_contribuyente,
                    'calle'=> $request->calle,
                    'numero'=> $request->numero,
                    'codigo_postal'=> $request->codigo_postal,
                    'colonia'=> $request->colonia,
                    'ciudad'=> $request->ciudad,
                    'nombre'=> $request->nombre,
                    'apellido_paterno'=> $request->apellido_paterno,
                    'apellido_materno'=> $request->apellido_materno,
                    'email'=> $request->email,
                    'telefono'=> $request->telefono,
                    'direccion_map'=> $request->direccion_map,
                    'comentarios'=> $request->comentarios,
                    ];
        Mail::send('emails.contact', $data,function($msj) use($subject,$for){
            $msj->from("soporte@ment-travel.com","Soporte");
            $msj->subject($subject);
            $msj->to($for);
        });
        

        

        // // return response()->json($post);
         return response()->json([
             'num_servicios' => $servicios,
             'informacion' => $informacion_servicios ,
             'pequenos'=>$contenedores_pequenos,
             'dias' => $dia_info,
             'pequeno_info'=>$contenedores_pequenos_info,
             'datos' => $datos,
         ]);
    }

    public function email()
    {
        

        echo "Enviado mi amigo";
    }
}
