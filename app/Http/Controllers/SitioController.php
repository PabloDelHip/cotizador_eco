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
        // $pregunta_uno = $request->pregunta_uno;
        $count = 1;
        $info_contenedores= $request->info_contenedores;
        $datos = $request->all();
        $informacion_servicios = "";
        $servicios = $request->num_servicios;

        $informacion_servicios ="LOS NUMEROS DE SERVICIOS SON : <b>".$servicios."</b><br><br>";
        foreach ($info_contenedores as $info_contenedor) {

            $informacion_servicios.= "DIAS DE SERVICIO NUMERO ".($count).": ";

            foreach ($info_contenedor["dias"] as $info_dias) {
                $informacion_servicios .= "<b>".$info_dias.",</b> ";
            }

            $informacion_servicios.= "<br><br>";
            $informacion_servicios .= "El contenedor solicitado es: <b>".$info_contenedor["contenedor"]."</b>";
            $informacion_servicios.= "<br><hr>";
           $count++;
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
            $msj->to("gerencia.ventas@ecolomovil.com");
            $msj->to("callcenter2@ecolomovil.com");
            $msj->to("pablodelhip@gmail.com");
        });

        return response()->json([
            'datos' => $datos,
            'informacion' => $informacion_servicios 
        ]);
    }

    public function email()
    {
        

        echo "Enviado mi amigo";
    }
}
