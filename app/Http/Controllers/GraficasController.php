<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use App\Project;
use App\Profile;
use App\ProjectUser;
use App\Incident;
use App\Category;
use App\Level;

class GraficasController extends Controller
{
    /**
     * Funcion que determina cual es el ultimo dia de un mes
     * dependiendo del año.
     *
     * @return un valor de tipo date identificandonos el ultimo dia del año
     */
    public function getUltimoDiaMes($elAnio,$elMes) {
     return date("d",(mktime(0,0,0,$elMes+1,1,$elAnio)-1));
    }
    /**
     * Muestra los registros de incidencias, usuarios y proyectos, dado un mes y un año
     * @param type $anio 
     * @param type $mes 
     * @return type json collection en formato json
     */
    public function registros_mes($anio,$mes)
    {
        $primer_dia=1;
        $ultimo_dia=$this->getUltimoDiaMes($anio,$mes);
        $fecha_inicial=date("Y-m-d H:i:s", strtotime($anio."-".$mes."-".$primer_dia) );
        $fecha_final=date("Y-m-d H:i:s", strtotime($anio."-".$mes."-".$ultimo_dia) );

        $incidencias = Incident::whereBetween('created_at', [$fecha_inicial,  $fecha_final])->get();        
        $total_incidencias = count($incidencias);
        for($d=1;$d<=$ultimo_dia;$d++){
            $inc_registradas[$d]=0;     
        }
        foreach($incidencias as $incidencia){
            $diasel=intval(date("d",strtotime($incidencia->created_at) ) );
            $inc_registradas[$diasel]++;    
        }

        $usuarios_registrados=User::whereBetween('created_at', [$fecha_inicial,  $fecha_final])->get();
        $total_usuarios=count($usuarios_registrados);
        for($i=1;$i<=$ultimo_dia;$i++){
            $user_register[$i]=0;     
        }
        foreach($usuarios_registrados as $usuarios){
            $diasel=intval(date("d",strtotime($usuarios->created_at) ) );
            $user_register[$diasel]++;    
        }

        $clientes_registrados=User::whereBetween('created_at', [$fecha_inicial,  $fecha_final])->where('profile_id', 3)->get();
        $total_clientes=count($clientes_registrados);
        for($i=1;$i<=$ultimo_dia;$i++){
            $client_register[$i]=0;     
        }
        foreach($clientes_registrados as $clientes){
            $diasel=intval(date("d",strtotime($clientes->created_at) ) );
            $client_register[$diasel]++;    
        }

        $proyectos_registrados=Project::whereBetween('created_at', [$fecha_inicial,  $fecha_final])->get();
        $total_proyectos=count($proyectos_registrados);
        for($i=1;$i<=$ultimo_dia;$i++){
            $projects_register[$i]=0;     
        }
        foreach($proyectos_registrados as $proyectos){
            $diasel=intval(date("d",strtotime($proyectos->created_at) ) );
            $projects_register[$diasel]++;    
        }

        $data=array("totaldias"=>$ultimo_dia, "incidenciasdia" =>$inc_registradas, "usuariosdia" => $user_register, "clientesdia" => $client_register, "proyectosdia" => $projects_register);
        return   json_encode($data);
    }

    /**
     * Muestra datos referentes a las incidencias
     * @param type $anio 
     * @param type $mes 
     * @return type Json collection en formato json
     */
    public function total_incidencias($anio,$mes){

        $primer_dia=1;
        $primer_proyecto=1;
        $ultimo_dia=$this->getUltimoDiaMes($anio,$mes);
        $fecha_inicial=date("Y-m-d H:i:s", strtotime($anio."-".$mes."-".$primer_dia) );
        $fecha_final=date("Y-m-d H:i:s", strtotime($anio."-".$mes."-".$ultimo_dia) );        
        $proyectos = Project::groupBy('id')->get();
        foreach ($proyectos as $project){ $numproyectos = count($proyectos); }        
        
        $incidencias_de_proyectos = Incident::whereBetween('project_id', [$primer_proyecto,  $numproyectos])->whereBetween('created_at', [$fecha_inicial,  $fecha_final])->get();
        for($i=1;$i<=$numproyectos;$i++){
            $incid_projects[$i]=0;     
        }
        foreach($incidencias_de_proyectos as $proyectos){            
            $projsel=$proyectos->project_id;
            $incid_projects[$projsel]++;    
        }

        $incidencias_resueltas = Incident::whereBetween('project_id', [$primer_proyecto,  $numproyectos])->where('active', 0)->whereBetween('created_at', [$fecha_inicial,  $fecha_final])->get();
        for($i=1;$i<=$numproyectos;$i++){
            $incid_resueltas[$i]=0;     
        }
        foreach($incidencias_resueltas as $resueltas){            
            $projsel=$resueltas->project_id;
            $incid_resueltas[$projsel]++;    
        }

        $incidencias_pendientes = Incident::whereBetween('project_id', [$primer_proyecto,  $numproyectos])->whereBetween('created_at', [$fecha_inicial,  $fecha_final])->where('active', 1)->get();
        for($i=1;$i<=$numproyectos;$i++){
            $incid_pendientes[$i]=0;     
        }
        foreach($incidencias_pendientes as $pendientes){            
            $projsel=$pendientes->project_id;
            $incid_pendientes[$projsel]++;    
        }

        $inc_sevr_menor = Incident::whereBetween('project_id', [$primer_proyecto,  $numproyectos])->whereBetween('created_at', [$fecha_inicial,  $fecha_final])->where('severity', 'M')->get();
        for($i=1;$i<=$numproyectos;$i++){
            $seve_menor[$i]=0;     
        }
        foreach($inc_sevr_menor as $menor){            
            $projsel=$menor->project_id;
            $seve_menor[$projsel]++;    
        }

        $inc_sevr_normal = Incident::whereBetween('project_id', [$primer_proyecto,  $numproyectos])->whereBetween('created_at', [$fecha_inicial,  $fecha_final])->where('severity', 'N')->get();
        for($i=1;$i<=$numproyectos;$i++){
            $seve_normal[$i]=0;     
        }
        foreach($inc_sevr_normal as $normal){            
            $projsel=$normal->project_id;
            $seve_normal[$projsel]++;    
        }

        $inc_sevr_alta = Incident::whereBetween('project_id', [$primer_proyecto,  $numproyectos])->whereBetween('created_at', [$fecha_inicial,  $fecha_final])->where('severity', 'A')->get();
        for($i=1;$i<=$numproyectos;$i++){
            $seve_alta[$i]=0;     
        }
        foreach($inc_sevr_alta as $alta){            
            $projsel=$alta->project_id;
            $seve_alta[$projsel]++;    
        }

        $num_niveles_asignados = Level::whereBetween('project_id', [$primer_proyecto,  $numproyectos])->whereBetween('created_at', [$fecha_inicial,  $fecha_final])->get();
        for($i=1;$i<=$numproyectos;$i++){
            $niveles[$i]=0;     
        }
        foreach($num_niveles_asignados as $nivel){            
            $projsel=$nivel->project_id;
            $niveles[$projsel]++;    
        }

        $num_categorias_asignados = Category::whereBetween('project_id', [$primer_proyecto,  $numproyectos])->whereBetween('created_at', [$fecha_inicial,  $fecha_final])->get();
        for($i=1;$i<=$numproyectos;$i++){
            $categorias[$i]=0;     
        }
        foreach($num_categorias_asignados as $category){            
            $projsel=$category->project_id;
            $categorias[$projsel]++;    
        }
        
        $data=array("numproyectos" => $numproyectos, "proyectosinc" => $incid_projects, "resueltas" => $incid_resueltas, 'pendientes' => $incid_pendientes, "menor" => $seve_menor , "normal" => $seve_normal , "alta" => $seve_alta, "niveles" => $niveles, "categorias" => $categorias);
        return   json_encode($data);
    }

    /**
     * Muestra informacion referente a los modulos o categorias de cada proyecto
     * @param type $anio 
     * @param type $mes 
     * @return type type Json collection en formato json
     */
    public function total_modulos($anio,$mes){

        $primer_dia=1;
        $primer_modulo=1;
        $ultimo_dia=$this->getUltimoDiaMes($anio,$mes);
        $fecha_inicial=date("Y-m-d H:i:s", strtotime($anio."-".$mes."-".$primer_dia) );
        $fecha_final=date("Y-m-d H:i:s", strtotime($anio."-".$mes."-".$ultimo_dia) );

        
        $modulos = Category::groupBy('id')->get();
        foreach ($modulos as $modulo) { $nummodulos = count($modulos); }        
        
        $incidencias_de_modulos = Incident::whereBetween('category_id', [$primer_modulo,  $nummodulos])->whereBetween('created_at', [$fecha_inicial,  $fecha_final])->get();
        for($i=1;$i<=$nummodulos;$i++){
            $incid_modul[$i]=0;     
        }
        foreach($incidencias_de_modulos as $inc_modulos){            
            $projsel=$inc_modulos->category_id;
            $incid_modul[$projsel]++;    
        }        
        
        $data=array("nummodulos" => $nummodulos, "modulosinc" => $incid_modul);
        return   json_encode($data);
    }
    /**
     * Funcion index que nos imprime las variables año y mes en la viste principal
     * para determinar que año y mes se selecciona y asi mostrar los datos estadisticos
     * @return type
     */
    public function index()
    {        

        $anio=date("Y");
        $mes=date("m");
        return view("statistics")->with(compact('anio','mes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {



    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
