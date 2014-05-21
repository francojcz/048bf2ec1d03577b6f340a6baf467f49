<?php

/**
 * reporte_graficosemanal actions.
 *
 * @package    tpmlabs
 * @subpackage reporte_graficosemanal
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class reporte_graficosemanalActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
  }
	public function obtenerConexionDia($dia) {
		$metodo_codigo=$this->getRequestParameter('metodo_codigo');
		$analista_codigo=$this->getRequestParameter('analista_codigo');

		$conexion = new Criteria();
		$conexion->add(RegistroUsoMaquinaPeer::RUM_FECHA,$dia,CRITERIA::EQUAL);
                
		//Cambios: 24 de febrero de 2014
                //Se obtienen los códigos de los equipos seleccionados
                $temp = $this->getRequestParameter('cods_equipos');
                $cods_equipos = json_decode($temp);
                if($cods_equipos != ''){
                    foreach ($cods_equipos as $cod_equipo) {
                        $conexion -> addOr(RegistroUsoMaquinaPeer::RUM_MAQ_CODIGO, $cod_equipo, CRITERIA::EQUAL);
                    }
                }
                
                //Cambios: 24 de febrero de 2014
                //Se obtienen los códigos de los grupos de equipos seleccionados
                $temp2 = $this->getRequestParameter('cods_grupos');
                $cods_grupos = json_decode($temp2);
                if($cods_grupos != ''){
                    foreach ($cods_grupos as $cod_grupo) {
                        $criteria1 = new Criteria();
                        $criteria1->add(GrupoPorEquipoPeer::GREQ_GRU_CODIGO, $cod_grupo);
                        $grupoporequipo = GrupoPorEquipoPeer::doSelect($criteria1);
                        foreach ($grupoporequipo as $equipo) {
                            $conexion -> addOr(RegistroUsoMaquinaPeer::RUM_MAQ_CODIGO, $equipo->getGreqMaqCodigo(), CRITERIA::EQUAL);
                        }                
                    }
                }
                
		if($metodo_codigo!='') {
                    $conexion->add(RegistroUsoMaquinaPeer::RUM_MET_CODIGO,$metodo_codigo,CRITERIA::EQUAL);
                }
		if($analista_codigo!='') {
                    $conexion->add(RegistroUsoMaquinaPeer::RUM_USU_CODIGO,$analista_codigo,CRITERIA::EQUAL);
                }
		$conexion->add(RegistroUsoMaquinaPeer::RUM_ELIMINADO, false);
		return $conexion;
	}

	public function obtenerConexionMes($anio,$mes) {
		$metodo_codigo=$this->getRequestParameter('metodo_codigo');
		$analista_codigo=$this->getRequestParameter('analista_codigo');

		$conexion = new Criteria();
		$conexion->add(RegistroUsoMaquinaPeer::RUM_FECHA,$anio.'-'.$mes.'-01',CRITERIA::GREATER_EQUAL);
		$conexion->addAnd(RegistroUsoMaquinaPeer::RUM_FECHA,$anio.'-'.$mes.'-31',CRITERIA::LESS_EQUAL);
                
		//Cambios: 24 de febrero de 2014
                //Se obtienen los códigos de los equipos seleccionados
                $temp = $this->getRequestParameter('cods_equipos');
                $cods_equipos = json_decode($temp);
                if($cods_equipos != ''){
                    foreach ($cods_equipos as $cod_equipo) {
                        $conexion -> addOr(RegistroUsoMaquinaPeer::RUM_MAQ_CODIGO, $cod_equipo, CRITERIA::EQUAL);
                    }
                }
                
                //Cambios: 24 de febrero de 2014
                //Se obtienen los códigos de los grupos de equipos seleccionados
                $temp2 = $this->getRequestParameter('cods_grupos');
                $cods_grupos = json_decode($temp2);
                if($cods_grupos != ''){
                    foreach ($cods_grupos as $cod_grupo) {
                        $criteria1 = new Criteria();
                        $criteria1->add(GrupoPorEquipoPeer::GREQ_GRU_CODIGO, $cod_grupo);
                        $grupoporequipo = GrupoPorEquipoPeer::doSelect($criteria1);
                        foreach ($grupoporequipo as $equipo) {
                            $conexion -> addOr(RegistroUsoMaquinaPeer::RUM_MAQ_CODIGO, $equipo->getGreqMaqCodigo(), CRITERIA::EQUAL);
                        }                
                    }
                }
                
		if($metodo_codigo!='') {
                    $conexion->add(RegistroUsoMaquinaPeer::RUM_MET_CODIGO,$metodo_codigo,CRITERIA::EQUAL);
                }
		if($analista_codigo!='') {
                    $conexion->add(RegistroUsoMaquinaPeer::RUM_USU_CODIGO,$analista_codigo,CRITERIA::EQUAL);
                }
		$conexion->add(RegistroUsoMaquinaPeer::RUM_ELIMINADO, false);
		return $conexion;
	}
        
        public function obtenerConexionSemana($fecha_inicio, $fecha_fin) {
		$metodo_codigo=$this->getRequestParameter('metodo_codigo');
		$analista_codigo=$this->getRequestParameter('analista_codigo');

		$conexion = new Criteria();
		$conexion->add(RegistroUsoMaquinaPeer::RUM_FECHA, $fecha_inicio, CRITERIA::GREATER_EQUAL);
		$conexion->addAnd(RegistroUsoMaquinaPeer::RUM_FECHA, $fecha_fin, CRITERIA::LESS_EQUAL);
                
		//Cambios: 24 de febrero de 2014
                //Se obtienen los códigos de los equipos seleccionados
                $temp = $this->getRequestParameter('cods_equipos');
                $cods_equipos = json_decode($temp);
                if($cods_equipos != ''){
                    foreach ($cods_equipos as $cod_equipo) {
                        $conexion -> addOr(RegistroUsoMaquinaPeer::RUM_MAQ_CODIGO, $cod_equipo, CRITERIA::EQUAL);
                    }
                }
                
                //Cambios: 24 de febrero de 2014
                //Se obtienen los códigos de los grupos de equipos seleccionados
                $temp2 = $this->getRequestParameter('cods_grupos');
                $cods_grupos = json_decode($temp2);
                if($cods_grupos != ''){
                    foreach ($cods_grupos as $cod_grupo) {
                        $criteria1 = new Criteria();
                        $criteria1->add(GrupoPorEquipoPeer::GREQ_GRU_CODIGO, $cod_grupo);
                        $grupoporequipo = GrupoPorEquipoPeer::doSelect($criteria1);
                        foreach ($grupoporequipo as $equipo) {
                            $conexion -> addOr(RegistroUsoMaquinaPeer::RUM_MAQ_CODIGO, $equipo->getGreqMaqCodigo(), CRITERIA::EQUAL);
                        }                
                    }
                }
                
		if($metodo_codigo!='') {
                    $conexion->add(RegistroUsoMaquinaPeer::RUM_MET_CODIGO,$metodo_codigo,CRITERIA::EQUAL);
                }
		if($analista_codigo!='') {
                    $conexion->add(RegistroUsoMaquinaPeer::RUM_USU_CODIGO,$analista_codigo,CRITERIA::EQUAL);
                }
		$conexion->add(RegistroUsoMaquinaPeer::RUM_ELIMINADO, false);
		return $conexion;
	}

	public function agregarGuiaGrafica($titulo,$posicion) {
		if($posicion==0){
			$posicion=8;
		}
		$guia='<guide>';
		$guia.='<start_value>'.$posicion.'</start_value>';
		$guia.='<title>'.$titulo.'</title>';
		$guia.='<color>#00CC00</color>';
		$guia.='<inside>true</inside>';
		$guia.='<width>0</width>';
		$guia.='</guide>';

		return $guia;
	}

	public function obtenerCantidadDiasMes($mes,$anio) {
		$cant_dias=0;

		for ($dia=31;$dia>0;$dia--){
			if(checkdate($mes, $dia, $anio)){
				$cant_dias=$dia;
				$dia=0;
			}
		}
		return $cant_dias+1;
	}
	/**************************************Reporte de inyecciones*******************/
	public function executeGenerarDatosGraficoInyecciones(sfWebRequest $request)
	{
            //Calculo de la fecha de inicio y fin de cada semana                
            $fecha_inicio = $this->getRequestParameter('fecha_inicio');
            $fecha_fin = $this->getRequestParameter('fecha_fin');
            $rango_fechas = $this->rango($fecha_inicio, $fecha_fin);

            //Calculo de indicadores por semana
            /*Se calculan los indicadores por día pero se van sumando de acuerdo con el rango de cada semana*/
            $datos = array();
            for($i=0; $i<sizeof($rango_fechas); $i++) {
                $fecha_inicio = $rango_fechas[$i]['fecha_inicio'];
                $fecha_fin = $rango_fechas[$i]['fecha_fin'];
                $fecha = $this->fecha($fecha_inicio);
                $temp = $this->calcularInyecciones($fecha[0], $fecha[1], $fecha[2]);
                $datos[$i]['inyecciones'] = $temp['inyecciones'];
                $datos[$i]['reinyecciones'] = $temp['reinyecciones'];
                while($fecha_inicio < $fecha_fin) {
                        $fecha_inicio = date('Y-m-d',strtotime('+1 day', strtotime($fecha_inicio)));
                        $fecha = $this->fecha($fecha_inicio);
                        $temp = $this->calcularInyecciones($fecha[0], $fecha[1], $fecha[2]);
                        $datos[$i]['inyecciones'] += $temp['inyecciones'];
                        $datos[$i]['reinyecciones'] += $temp['reinyecciones'];
                }
            }

            $total_inyecciones_realiza_mes=0;
            $total_reinyecciones_mes=0;
            $max_numero_inyecc=0;

            $xml='<?xml version="1.0"?>';
            $xml.='<chart>';

            $xml.='<series>';
            for($diasmes=0; $diasmes<sizeof($rango_fechas); $diasmes++)
            {
                    $xml.='<value xid="'.$this->mes($rango_fechas[$diasmes]['fecha_inicio']).'">'.$this->mes($rango_fechas[$diasmes]['fecha_inicio']).'</value>';
            }
            $xml.='</series>';
            $xml.='<graphs>';
            $xml.='<graph color="#72a8cd" title="Número inyecciones realizadas" bullet="round">';
            for($diasmes=0; $diasmes<sizeof($rango_fechas); $diasmes++){
                    $total_inyecciones_realiza=$datos[$diasmes]['inyecciones'];
                    $xml.='<value xid="'.$this->mes($rango_fechas[$diasmes]['fecha_inicio']).'">'.round($total_inyecciones_realiza, 2).'</value>';

                    $total_inyecciones_realiza_mes+=$total_inyecciones_realiza ;

                    if($total_inyecciones_realiza>$max_numero_inyecc){
                            $max_numero_inyecc=$total_inyecciones_realiza;
                    }
            }
            $xml.='</graph>';

            $xml.='<graph color="#ff5454" title="Número reinyecciones" bullet="round">';
            for($diasmes=0; $diasmes<sizeof($rango_fechas); $diasmes++){
                    $total_reinyecciones=$datos[$diasmes]['reinyecciones'];
                    $xml.='<value xid="'.$this->mes($rango_fechas[$diasmes]['fecha_inicio']).'">'.round($total_reinyecciones, 2).'</value>';
                    $total_reinyecciones_mes+=$total_reinyecciones ;

                    if($total_reinyecciones>$max_numero_inyecc){
                            $max_numero_inyecc=$total_reinyecciones;
                    }
            }
            $xml.='</graph>';

            $xml.='</graphs>';
            $xml.='<guides>';

            $porcen_inyecciones_realizadas=0;
            $porcen_reinyecciones_realizadas=0;
            $total_inyecciones=$total_inyecciones_realiza_mes+$total_reinyecciones_mes;

            $unidad_separancion=($max_numero_inyecc/8);
            $xml.=$this->agregarGuiaGrafica('Total inyecciones : '.$total_inyecciones,$max_numero_inyecc+ ($unidad_separancion*3));
            if($total_inyecciones!=0){
                    $porcen_inyecciones_realizadas=round((($total_inyecciones_realiza_mes/$total_inyecciones)*100),2);
                    $porcen_reinyecciones_realizadas=round((($total_reinyecciones_mes/$total_inyecciones)*100),2);
                    $xml.=$this->agregarGuiaGrafica('Inyecciones         : '.round($total_inyecciones_realiza_mes,2).' ('.$porcen_inyecciones_realizadas.' %)',$max_numero_inyecc+($unidad_separancion*2));
                    $xml.=$this->agregarGuiaGrafica('Reinyecciones     : '.round($total_reinyecciones_mes,2).' ('.$porcen_reinyecciones_realizadas.' %)',$max_numero_inyecc+($unidad_separancion*1));
            }
            $xml.='</guides>';
            $xml.='</chart>';

            $this->getRequest()->setRequestFormat('xml');
            $response = $this->getResponse();
            $response->setContentType('text/xml');
            $response->setHttpHeader('Content-length', strlen($xml), true);

            return $this->renderText($xml);
	}

	public function calcularInyecciones($ano, $mes, $dia)
	{
            $datos = array();
            try{
                $suma_numero_inyecciones_dia= 0;
                $suma_numero_reinyecciones_dia= 0;

                $conexion=$this->obtenerConexionDia($ano.'-'.$mes.'-'.$dia);
                $registros_uso_maquinas = RegistroUsoMaquinaPeer::doSelect($conexion);

                foreach($registros_uso_maquinas as $temporal)
                {
                        $suma_numero_inyecciones_dia += $temporal->contarNumeroInyeccionesObligatorias();
                        $suma_numero_reinyecciones_dia += $temporal->contarNumeroTotalReinyecciones();
                }
                $datos['inyecciones'] = $suma_numero_inyecciones_dia;
                $datos['reinyecciones'] = $suma_numero_reinyecciones_dia;
            }catch (Exception $excepcion)
            {
                echo "(exception: 'Excepci&oacute;n en reporte-calcularInyecciones ',error:'".$excepcion->getMessage()."')";
            }
            return $datos;
	}
        
        public function calcularInyeccionesSemana($fecha_inicio, $fecha_fin)
	{
            $datos = array();
            try{
                $suma_numero_inyecciones_dia= 0;
                $suma_numero_reinyecciones_dia= 0;

                $conexion=$this->obtenerConexionSemana($fecha_inicio, $fecha_fin);
                $registros_uso_maquinas = RegistroUsoMaquinaPeer::doSelect($conexion);

                foreach($registros_uso_maquinas as $temporal)
                {
                        $suma_numero_inyecciones_dia += $temporal->contarNumeroInyeccionesObligatorias();
                        $suma_numero_reinyecciones_dia += $temporal->contarNumeroTotalReinyecciones();
                }
                $datos['inyecciones'] = $suma_numero_inyecciones_dia;
                $datos['reinyecciones'] = $suma_numero_reinyecciones_dia;
            }catch (Exception $excepcion)
            {
                echo "(exception: 'Excepci&oacute;n en reporte-calcularInyecciones ',error:'".$excepcion->getMessage()."')";
            }
            return $datos;
	}
        
        public function calcularInyeccionesDiarias($ano, $mes, $dia)
	{
		$datos = array();
		try{
			$numeroInyeccionesMes = 0;
			$numeroReinyeccionesMes = 0;
                        $suma_numero_inyecciones_dia= 0;
                        $suma_numero_reinyecciones_dia= 0;

                        $conexion=$this->obtenerConexionDia($ano.'-'.$mes.'-'.$dia);
                        $registros_uso_maquinas = RegistroUsoMaquinaPeer::doSelect($conexion);

                        foreach($registros_uso_maquinas as $temporal)
                        {
                                $suma_numero_inyecciones_dia+= $temporal->contarNumeroInyeccionesObligatorias();
                                $suma_numero_reinyecciones_dia+= $temporal->contarNumeroTotalReinyecciones();
                        }
                        $datos['inyecciones'] = $suma_numero_inyecciones_dia;
                        $numeroInyeccionesMes += $suma_numero_inyecciones_dia;
                        $datos['reinyecciones'] = $suma_numero_reinyecciones_dia;
                        $numeroReinyeccionesMes += $suma_numero_reinyecciones_dia;                        
			$datos['inyeccionesMes'] = $numeroInyeccionesMes;
			$datos['reinyeccionesMes'] = $numeroReinyeccionesMes;
		}catch (Exception $excepcion)
		{
			echo "(exception: 'Excepci&oacute;n en reporte-calcularInyecciones ',error:'".$excepcion->getMessage()."')";
		}
		return $datos;
	}

	/**************************************Reporte de lotes*******************/
	public function executeGenerarDatosGraficoMuestras(sfWebRequest $request)
	{            
            //Calculo de la fecha de inicio y fin de cada semana                
            $fecha_inicio = $this->getRequestParameter('fecha_inicio');
            $fecha_fin = $this->getRequestParameter('fecha_fin');
            $rango_fechas = $this->rango($fecha_inicio, $fecha_fin);

            //Calculo de indicadores por semana
            /*Se calculan los indicadores por día pero se van sumando de acuerdo con el rango de cada semana*/
            $datos = array();
            for($i=0; $i<sizeof($rango_fechas); $i++) {
                $fecha_inicio = $rango_fechas[$i]['fecha_inicio'];
                $fecha_fin = $rango_fechas[$i]['fecha_fin'];
                $fecha = $this->fecha($fecha_inicio);
                $temp = $this->calcularMuestras($fecha[0], $fecha[1], $fecha[2]);
                $datos[$i]['analizadas'] = $temp['analizadas'];
                $datos[$i]['reanalizadas'] = $temp['reanalizadas'];
                while($fecha_inicio < $fecha_fin) {
                        $fecha_inicio = date('Y-m-d',strtotime('+1 day', strtotime($fecha_inicio)));
                        $fecha = $this->fecha($fecha_inicio);
                        $temp = $this->calcularMuestras($fecha[0], $fecha[1], $fecha[2]);
                        $datos[$i]['analizadas'] += $temp['analizadas'];
                        $datos[$i]['reanalizadas'] += $temp['reanalizadas'];
                }
            }

            $total_muestras_analizadas_mes=0;
            $total_muestras_reanalizadas_mes=0;
            $max_numero_muestra=0;

            $xml='<?xml version="1.0"?>';
            $xml.='<chart>';
            $xml.='<series>';
            for($diasmes=0; $diasmes<sizeof($rango_fechas); $diasmes++) {
                $xml.='<value xid="'.$this->mes($rango_fechas[$diasmes]['fecha_inicio']).'">'.$this->mes($rango_fechas[$diasmes]['fecha_inicio']).'</value>';
            }
            $xml.='</series>';
            $xml.='<graphs>';
            $xml.='<graph color="#ffdc44" title="Número lotes analizados" bullet="round">';
            for($diasmes=0; $diasmes<sizeof($rango_fechas); $diasmes++) {
                $numero_muestras_analizadas_dia=$datos[$diasmes]['analizadas'];
                $xml.='<value xid="'.$this->mes($rango_fechas[$diasmes]['fecha_inicio']).'">'.$numero_muestras_analizadas_dia.'</value>';
                $total_muestras_analizadas_mes+=$numero_muestras_analizadas_dia;

                if($numero_muestras_analizadas_dia>$max_numero_muestra){
                        $max_numero_muestra=$numero_muestras_analizadas_dia;
                }
            }
            $xml.='</graph>';

            $xml.='<graph color="#47d552" title="Número lotes reanalizados" bullet="round" >';
            for($diasmes=0; $diasmes<sizeof($rango_fechas); $diasmes++) {
                $numero_muestras_reanalizadas_dia=$datos[$diasmes]['reanalizadas'];
                $xml.='<value xid="'.$this->mes($rango_fechas[$diasmes]['fecha_inicio']).'">'.$numero_muestras_reanalizadas_dia.'</value>';
                $total_muestras_reanalizadas_mes+=$numero_muestras_reanalizadas_dia;
                if($numero_muestras_reanalizadas_dia>$max_numero_muestra){
                        $max_numero_muestra=$numero_muestras_reanalizadas_dia;
                }
            }
            $xml.='</graph>';
            $xml.='</graphs>';
            $xml.='<guides>';

            $porcen_muestras_analizadas=0;
            $porcen_muestras_reanalizadas=0;
            $total_muestras_mes=$total_muestras_analizadas_mes+$total_muestras_reanalizadas_mes;
            if($total_muestras_mes!=0) {
                $porcen_muestras_analizadas=round((($total_muestras_analizadas_mes/$total_muestras_mes)*100),2);
                $porcen_muestras_reanalizadas=round((($total_muestras_reanalizadas_mes/$total_muestras_mes)*100),2);
            }
            $unidad_separancion=($max_numero_muestra/8);          
            
            $xml.=$this->agregarGuiaGrafica('Total lotes : '.round($total_muestras_mes,2),$max_numero_muestra+(3*$unidad_separancion));
            if($total_muestras_mes!=0){
                    $xml.=$this->agregarGuiaGrafica('Lotes analizados : '.round($total_muestras_analizadas_mes,2).' ('.$porcen_muestras_analizadas .' %)',$max_numero_muestra+(2*$unidad_separancion));
                    $xml.=$this->agregarGuiaGrafica('Lotes reanalizados : '.round($total_muestras_reanalizadas_mes,2).' ('.$porcen_muestras_reanalizadas.' %)',$max_numero_muestra+(1*$unidad_separancion));
            }
            $xml.='</guides>';
            $xml.='</chart>';

            $this->getRequest()->setRequestFormat('xml');
            $response = $this->getResponse();
            $response->setContentType('text/xml');
            $response->setHttpHeader('Content-length', strlen($xml), true);
            return $this->renderText($xml);
	}

	public function calcularMuestras($ano, $mes, $dia)
	{
            $datos = array();
            try {
                $suma_numero_muestras_analizadas_dia= 0;
                $suma_numero_muestras_reanalizadas_dia= 0;

                $conexion=$this->obtenerConexionDia($ano.'-'.$mes.'-'.$dia);
                $registros_uso_maquinas = RegistroUsoMaquinaPeer::doSelect($conexion);

                foreach($registros_uso_maquinas as $temporal)
                {
                    $suma_numero_muestras_analizadas_dia+= $temporal->contarNumeroMuestrasProgramadas();
                    $suma_numero_muestras_reanalizadas_dia+= $temporal->contarNumeroMuestrasReAnalizadas();
                }
                $datos['analizadas'] = round($suma_numero_muestras_analizadas_dia,2);
                $datos['reanalizadas'] = round($suma_numero_muestras_reanalizadas_dia,2);                
            }catch (Exception $excepcion)
            {
                return "(exeption: 'Excepci&oacute;n en reporte-calcularLotes ',error:'".$excepcion->getMessage()."')";
            }
            return $datos;
	}

	/**************************************Reporte de perdidas diarias del mes *******************/
	public function executeGenerarDatosGraficoPerdidas(sfWebRequest $request)
	{
            $user = $this->getUser();
            $codigo_usuario = $user->getAttribute('usu_codigo');
            $conexion = new Criteria();
            $conexion -> add(EmpleadoPeer::EMPL_USU_CODIGO, $codigo_usuario);
            $operario = EmpleadoPeer::doSelectOne($conexion);
            $criteria = new Criteria();
            $criteria -> add(EmpresaPeer::EMP_CODIGO, $operario->getEmplEmpCodigo());
            $empresa = EmpresaPeer::doSelectOne($criteria);
            $inyeccionesEstandarPromedio = $empresa->getEmpInyectEstandarPromedio();

            //Calculo de la fecha de inicio y fin de cada semana                
            $fecha_inicio = $this->getRequestParameter('fecha_inicio');
            $fecha_fin = $this->getRequestParameter('fecha_fin');
            $rango_fechas = $this->rango($fecha_inicio, $fecha_fin);

            //Calculo de indicadores por semana
            /*Se calculan los indicadores por día pero se van sumando de acuerdo con el rango de cada semana*/
            $datos = array();
            for($i=0; $i<sizeof($rango_fechas); $i++) {
                $fecha_inicio = $rango_fechas[$i]['fecha_inicio'];
                $fecha_fin = $rango_fechas[$i]['fecha_fin'];
                $fecha = $this->fecha($fecha_inicio);
                $temp = $this->calcularPerdidasDiarias($fecha[0], $fecha[1], $fecha[2], $inyeccionesEstandarPromedio);
//                $datos[$i]['fallas'] = $temp['fallas'];
                $datos[$i]['paros'] = $temp['paros'];
                $datos[$i]['retrabajos'] = $temp['retrabajos'];
                $datos[$i]['perdida_rendimiento'] = $temp['perdida_rendimiento'];
                while($fecha_inicio < $fecha_fin) {
                    $fecha_inicio = date('Y-m-d',strtotime('+1 day', strtotime($fecha_inicio)));
                    $fecha = $this->fecha($fecha_inicio);
                    $temp = $this->calcularPerdidasDiarias($fecha[0], $fecha[1], $fecha[2], $inyeccionesEstandarPromedio);
//                    $datos[$i]['fallas'] += $temp['fallas'];
                    $datos[$i]['paros'] += $temp['paros'];
                    $datos[$i]['retrabajos'] += $temp['retrabajos'];
                    $datos[$i]['perdida_rendimiento'] += $temp['perdida_rendimiento'];
                }
            }

            $xml='<?xml version="1.0"?>';
            $xml.='<chart>';
            $xml.='<series>';
            for($diasmes=0; $diasmes<sizeof($rango_fechas); $diasmes++) {
                    $xml.='<value xid="'.$this->mes($rango_fechas[$diasmes]['fecha_inicio']).'">'.$this->mes($rango_fechas[$diasmes]['fecha_inicio']).'</value>';
            }
            $xml.='</series>';

            $xml.='<graphs>';
//            $xml.='<graph color="#72a8cd" title="Fallas" bullet="round">';
//            for($diasmes=0; $diasmes<sizeof($rango_fechas); $diasmes++) {
//                    $numero_fallas_dia=$datos[$diasmes]['fallas'];
//                    $xml.='<value xid="'.$this->mes($rango_fechas[$diasmes]['fecha_inicio']).'">'.$numero_fallas_dia.'</value>';
//            }
//            $xml.='</graph>';

            $xml.='<graph color="#ff5454" title="Paros menores y fallas" bullet="round" >';
            for($diasmes=0; $diasmes<sizeof($rango_fechas); $diasmes++) {
                    $numero_paros_dia=$datos[$diasmes]['paros'];
                    $xml.='<value xid="'.$this->mes($rango_fechas[$diasmes]['fecha_inicio']).'">'.$numero_paros_dia.'</value>';
            }
            $xml.='</graph>';

            $xml.='<graph color="#47d552" title="Reensayos" bullet="round" >';
            for($diasmes=0; $diasmes<sizeof($rango_fechas); $diasmes++){
                    $numero_retrabajos_dia=$datos[$diasmes]['retrabajos'];
                    $xml.='<value xid="'.$this->mes($rango_fechas[$diasmes]['fecha_inicio']).'">'.$numero_retrabajos_dia.'</value>';
            }
            $xml.='</graph>';


            $xml.='<graph color="#47d599" title="Pérdidas de velocidad" bullet="round" >';
            for($diasmes=0; $diasmes<sizeof($rango_fechas); $diasmes++){
                    $numero_retrabajos_dia=$datos[$diasmes]['perdida_rendimiento'];
                    $xml.='<value xid="'.$this->mes($rango_fechas[$diasmes]['fecha_inicio']).'">'.$numero_retrabajos_dia.'</value>';
            }
            $xml.='</graph>';
            $xml.='</graphs>';
            $xml.='</chart>';

            $this->getRequest()->setRequestFormat('xml');
            $response = $this->getResponse();
            $response->setContentType('text/xml');
            $response->setHttpHeader('Content-length', strlen($xml), true);
            return $this->renderText($xml);
	}

	public function calcularPerdidasDiarias($ano,$mes,$dia,$inyeccionesEstandarPromedio)
	{
            $datos = array();

            try{
//                $suma_fallas_dia= 0;
                $suma_paros_dia= 0;
                $suma_retrabajos_dia= 0;
                $suma_perdidarendimiento_dia= 0;
                
                $conexion=$this->obtenerConexionDia($ano.'-'.$mes.'-'.$dia);
                $registros_uso_maquinas = RegistroUsoMaquinaPeer::doSelect($conexion);

                foreach($registros_uso_maquinas as $temporal)
                {
                        //Cambios: 24 de febrero de 2014
                        //Se quitó la columna fallas de la interfaz de ingreso de datos
//                      $suma_fallas_dia+= $temporal->getRumFallas();
                        /* Los tiempos que aparecen como pérdidas se suman a los TPNP siempre y cuando sean positivos,
                           pues los tiempos negativos se toman como ahorros y se van a mostrar de manera independiente */
                        //$suma_paros_dia+= $temporal->calcularParosMenoresMinutos(8)+$temporal->calcularPerdidaCambioMetodoAjusteMinutos();
                        $tpnp_temp = $temporal->calcularPerdidaCambioMetodoAjusteMinutos();
                        if($tpnp_temp > 0) {
                            $suma_paros_dia+= $temporal->calcularParosMenoresMinutos(8)+$temporal->calcularPerdidaCambioMetodoAjusteMinutos();
                        }
                        else {
                            $suma_paros_dia+= $temporal->calcularParosMenoresMinutos(8);
                        }                        
                        $suma_retrabajos_dia+= $temporal->calcularRetrabajosMinutos(8);
                        $suma_perdidarendimiento_dia+=$temporal->calcularPerdidasVelocidadMinutos($inyeccionesEstandarPromedio);
                }

//                $datos['fallas'] = round($suma_fallas_dia/60,2);
                $datos['paros'] = round($suma_paros_dia/60,2);
                $datos['retrabajos'] = round($suma_retrabajos_dia/60,2);
                $datos['perdida_rendimiento'] = round($suma_perdidarendimiento_dia/60,2);
            }catch (Exception $excepcion)
            {
                return "(exeption: 'Excepci&oacute;n en reporte-calcularFallas ',error:'".$excepcion->getMessage()."')";
            }
            return $datos;
	}

	/************************************** Reporte de perdidas del mes *******************/
	public function executeGenerarDatosGraficoPerdidasTorta(sfWebRequest $request)
	{
            $user = $this->getUser();
            $codigo_usuario = $user->getAttribute('usu_codigo');
            $conexion = new Criteria();
            $conexion->add(EmpleadoPeer::EMPL_USU_CODIGO, $codigo_usuario);
            $operario = EmpleadoPeer::doSelectOne($conexion);
            $criteria = new Criteria();
            $criteria->add(EmpresaPeer::EMP_CODIGO, $operario->getEmplEmpCodigo());
            $empresa = EmpresaPeer::doSelectOne($criteria);
            $inyeccionesEstandarPromedio = $empresa->getEmpInyectEstandarPromedio();

            //Calculo de la fecha de inicio y fin de cada semana                
            $fecha_inicio = $this->getRequestParameter('fecha_inicio');
            $fecha_fin = $this->getRequestParameter('fecha_fin');
            $rango_fechas = $this->rango($fecha_inicio, $fecha_fin);

            //Día de inicio y fin del ranto total de semanas
            $fecha_in = $rango_fechas[0]['fecha_inicio'];
            $fecha_fn = $rango_fechas[sizeof($rango_fechas)-1]['fecha_fin'];

            $datos=$this->calcularPerdidasSemana($fecha_in,$fecha_fn,$inyeccionesEstandarPromedio);

            $xml='<?xml version="1.0"?>';
            $xml.='<pie>';
//            $xml.='<slice title="Fallas " color="#72a8cd" pull_out="true">'.$datos['fallas'].'</slice>';
            $xml.='<slice title="Paros menores y fallas" color="#ff5454" pull_out="false">'.$datos['paros'].'</slice>';
            $xml.='<slice title="Reensayos" color="#47d552" pull_out="false">'.$datos['retrabajos'].'</slice>';
            $xml.='<slice title="Pérdidas de velocidad" color="#47d599" pull_out="false">'.$datos['perdida_rendimiento'].'</slice>';
            $xml.='</pie>';

            $this->getRequest()->setRequestFormat('xml');
            $response = $this->getResponse();
            $response->setContentType('text/xml');
            $response->setHttpHeader('Content-length', strlen($xml), true);
            return $this->renderText($xml);
	}

	public function calcularPerdidasSemana($fecha_inicio, $fecha_fin, $inyeccionesEstandarPromedio)
	{
            $datos = array();
            try{
//                    $suma_fallas_dia= 0;
                    $suma_paros_dia= 0;
                    $suma_retrabajos_dia= 0;
                    $suma_perdidarendimiento_dia=0;

                    $conexion = $this->obtenerConexionSemana($fecha_inicio, $fecha_fin);
                    $registros_uso_maquinas = RegistroUsoMaquinaPeer::doSelect($conexion);

                    foreach($registros_uso_maquinas as $temporal)
                    {
                        //Cambios: 24 de febrero de 2014
                        //Se quitó la columna fallas de la interfaz de ingreso de datos
//                      $suma_fallas_dia+= $temporal->getRumFallas();
                        /* Los tiempos que aparecen como pérdidas se suman a los TPNP siempre y cuando sean positivos,
                           pues los tiempos negativos se toman como ahorros y se van a mostrar de manera independiente */
                        //$suma_paros_dia+= $temporal->calcularParosMenoresMinutos(8)+$temporal->calcularPerdidaCambioMetodoAjusteMinutos();
                        $tpnp_temp = $temporal->calcularPerdidaCambioMetodoAjusteMinutos();
                        if($tpnp_temp > 0) {
                            $suma_paros_dia+= $temporal->calcularParosMenoresMinutos(8)+$temporal->calcularPerdidaCambioMetodoAjusteMinutos();
                        }
                        else {
                            $suma_paros_dia+= $temporal->calcularParosMenoresMinutos(8);
                        }                        
                        $suma_retrabajos_dia+= $temporal->calcularRetrabajosMinutos(8);
                        $suma_perdidarendimiento_dia+=$temporal->calcularPerdidasVelocidadMinutos($inyeccionesEstandarPromedio);
                    }
//                    $datos['fallas']=round($suma_fallas_dia/60,2);
                    $datos['paros']=round(($suma_paros_dia/60),2);
                    $datos['retrabajos']=round($suma_retrabajos_dia/60,2);
                    $datos['perdida_rendimiento']=round($suma_perdidarendimiento_dia/60,2);


            }catch (Exception $excepcion)
            {
                    return "(exeption: 'Excepci&oacute;n en reporte-calcularPerdidasSemana ',error:'".$excepcion->getMessage()."')";
            }
            return $datos;
	}

	/**************************************Reporte de tiempos diarios *******************/
	public function executeGenerarDatosGraficoTiempos(sfWebRequest $request)
	{       
                //Calculo de la fecha de inicio y fin de cada semana                
                $fecha_inicio = $this->getRequestParameter('fecha_inicio');
		$fecha_fin = $this->getRequestParameter('fecha_fin');
                $rango_fechas = $this->rango($fecha_inicio, $fecha_fin);
                
                //Calculo de indicadores por semana
                /*Se calculan los indicadores por día pero se van sumando de acuerdo con el rango de cada semana*/
                $datos = array();
                for($i=0; $i<sizeof($rango_fechas); $i++) {
                    $fecha_inicio = $rango_fechas[$i]['fecha_inicio'];
                    $fecha_fin = $rango_fechas[$i]['fecha_fin'];
                    $fecha = $this->fecha($fecha_inicio);
                    $temp = $this->calcularTiemposDiarios($fecha[0], $fecha[1], $fecha[2]);
                    $datos[$i]['TP'] = $temp['TP'];
                    $datos[$i]['TNP'] = $temp['TNP'];
                    $datos[$i]['TPNP'] = $temp['TPNP'];
                    $datos[$i]['TPP'] = $temp['TPP'];
                    $datos[$i]['TO'] = $temp['TO'];
                    $datos[$i]['TF'] = $temp['TF'];
                    $datos[$i]['HorasActivas'] = $temp['HorasActivas'];
                    while($fecha_inicio < $fecha_fin) {
                            $fecha_inicio = date('Y-m-d',strtotime('+1 day', strtotime($fecha_inicio)));
                            $fecha = $this->fecha($fecha_inicio);
                            $temp = $this->calcularTiemposDiarios($fecha[0], $fecha[1], $fecha[2]);
                            $datos[$i]['TP'] += $temp['TP'];
                            $datos[$i]['TNP'] += $temp['TNP'];
                            $datos[$i]['TPNP'] += $temp['TPNP'];
                            $datos[$i]['TPP'] += $temp['TPP'];
                            $datos[$i]['TO']  += $temp['TO'];
                            $datos[$i]['TF'] += $temp['TF'];
                            $datos[$i]['HorasActivas'] += $temp['HorasActivas'];
                    }
                }
                
		$indicadores_tiempo=array('TPP', 'TNP', 'TPNP', 'TF', 'TO');
		$indicadores_colores=array('47d552','ffdc44','ff5454','f0a05f','72a8cd');

		$xml='<?xml version="1.0"?>';
		$xml.='<chart>';

		$xml.='<series>';
		for($rango=0;$rango<sizeof($rango_fechas);$rango++)
		{
			$xml.='<value xid="'.$this->mes($rango_fechas[$rango]['fecha_inicio']).'">'.$this->mes($rango_fechas[$rango]['fecha_inicio']).'</value>';
		}
		$xml.='</series>';
		$xml.='<graphs>';
		for ($indicador=0;$indicador<5;$indicador++){
			$xml.='<graph color="#'.$indicadores_colores[$indicador].'" title="'.$indicadores_tiempo[$indicador].'" bullet="round">';
			for($rango=0;$rango<sizeof($rango_fechas);$rango++){
                            $numero_tiempos_dia=$datos[$rango][$indicadores_tiempo[$indicador]];
                            $xml.='<value xid="'.$this->mes($rango_fechas[$rango]['fecha_inicio']).'">'.round($numero_tiempos_dia, 2).'</value>';
			}
			$xml.='</graph>';
		}
		$xml.='</graphs>';
		$xml.='</chart>';
		return $this->renderText($xml);
	}

        public function calcularTiemposDiarios($ano, $mes, $dia)
	{
            $datos = array();
            try {
                $params = array();                   
                $horasActivas = 0;                                    
                $criteria = new Criteria();
                
                //Cambios: 24 de febrero de 2014
                //Se obtienen los códigos de los equipos seleccionados
                $temp = $this->getRequestParameter('cods_equipos');
                $cods_equipos = json_decode($temp);
                if($cods_equipos != ''){
                    foreach ($cods_equipos as $cod_equipo) {
                        $criteria -> addOr(MaquinaPeer::MAQ_CODIGO, $cod_equipo);                                        
                    }
                }
                
                //Cambios: 24 de febrero de 2014
                //Se obtienen los códigos de los grupos de equipos seleccionados
                $temp2 = $this->getRequestParameter('cods_grupos');
                $cods_grupos = json_decode($temp2);
                if($cods_grupos != ''){
                    foreach ($cods_grupos as $cod_grupo) {
                        $criteria1 = new Criteria();
                        $criteria1->add(GrupoPorEquipoPeer::GREQ_GRU_CODIGO, $cod_grupo);
                        $grupoporequipo = GrupoPorEquipoPeer::doSelect($criteria1);
                        foreach ($grupoporequipo as $equipo) {
                            $criteria -> addOr(MaquinaPeer::MAQ_CODIGO, $equipo->getGreqMaqCodigo());
                        }                
                    }
                }
                
                $maquinas = MaquinaPeer::doSelect($criteria);
                $tpnp_dia = 0;
                $tnp_dia = 0;
                $tpp_dia = 0;
                $tp_dia = 0;
                foreach($maquinas as $maquina) {
                        $codigoTemporalMaquina = $maquina->getMaqCodigo();
                        $tpnp_dia += RegistroUsoMaquinaPeer::calcularTPNPDiaEnHoras($codigoTemporalMaquina, $dia, $mes, $ano, $params, 8);
                        $tnp_dia += RegistroUsoMaquinaPeer::calcularTNPDiaEnHoras($codigoTemporalMaquina, $dia, $mes, $ano, $params, 8);
                        $tpp_dia += RegistroUsoMaquinaPeer::calcularTPPDiaEnHoras($codigoTemporalMaquina, $dia, $mes, $ano, $params, 8);
                        $horasActivas += $maquina->calcularNumeroHorasActivasDelDia($dia, $mes, $ano);
                        $tp_dia += RegistroUsoMaquinaPeer::calcularTPDiaEnHoras($codigoTemporalMaquina, $dia, $mes, $ano, $params, 8);
                }
                $tf_dia = $horasActivas - $tpp_dia - $tnp_dia;
                $to_dia = RegistroUsoMaquinaPeer::calcularTODiaMesAño($tf_dia, $tpnp_dia);

                $datos['TP'] = $tp_dia;
                $datos['TNP'] = $tnp_dia;
                $datos['TPNP'] = $tpnp_dia;
                $datos['TPP'] = $tpp_dia;
                $datos['TO'] = $to_dia;
                $datos['TF'] = $tf_dia;
                $datos['HorasActivas'] = $horasActivas;
            }catch (Exception $excepcion)
            {
                    return "(exception: 'Excepci&oacute;n en reporte-calcularTiemposDiariosMes ',error:'".$excepcion->getMessage()."')";
            }
            return $datos;
	}

        /**************************************Reporte de tiempos del mes *******************/
	public function executeGenerarDatosGraficoTiemposTorta(sfWebRequest $request)
	{            
            //Códigos de los equipos seleccionados
            $cod_equipos = $this->getRequestParameter('cods_equipos');
            //Códigos de los grupos seleccionados
            $cod_grupos = $this->getRequestParameter('cods_grupos');
            //Fecha de inicio y fin de cada semana
            $fecha_inicio = $this->getRequestParameter('fecha_inicio');
            $fecha_fin = $this->getRequestParameter('fecha_fin');
            $rango_fechas = $this->rango($fecha_inicio, $fecha_fin);
            
            //Día de inicio y fin del ranto total de semanas
            $fecha_in = $rango_fechas[0]['fecha_inicio'];
            $fecha_fn = $rango_fechas[sizeof($rango_fechas)-1]['fecha_fin'];

            $datos=$this->calcularTiemposDiariosSemanaTorta($fecha_in, $fecha_fn, $cod_equipos, $cod_grupos);
            $indicadores_tiempo=array('TPP', 'TNP', 'TPNP', 'TO');
            $indicadores_colores=array('47d552','ffdc44','ff5454','72a8cd');

            $xml='<?xml version="1.0"?>';
            $xml.='<pie>';
            for ($ind=0;$ind<4;$ind++){
                    $xml.='<slice title="'.$indicadores_tiempo[$ind].'" color="#'.$indicadores_colores[$ind].'"  pull_out="false">'.round($datos[$indicadores_tiempo[$ind]], 2).'</slice>';
            }
            $xml.='</pie>';

            $this->getRequest()->setRequestFormat('xml');
            $response = $this->getResponse();
            $response->setContentType('text/xml');
            $response->setHttpHeader('Content-length', strlen($xml), true);
            return $this->renderText($xml);
	}

	public function calcularTiemposDiariosSemanaTorta($fecha_inicio, $fecha_fin, $cod_equipos, $cod_grupos)
	{
            $datos = array();
            $params = array();

            $tp_sem = 0;
            $tnp_sem = 0;
            $tpnp_sem = 0;
            $tpp_sem = 0;
            $to_sem = 0;
            $tf_sem = 0;
            $tiempoCalendario = 0;

            try{
                $criteria = new Criteria();
                
                //Cambios: 24 de febrero de 2014
                //Se obtienen los códigos de los equipos seleccionados
                $temp = $cod_equipos;
                $cods_equipos = json_decode($temp);
                if($cods_equipos != ''){
                    foreach ($cods_equipos as $cod_equipo) {
                        $criteria -> addOr(MaquinaPeer::MAQ_CODIGO, $cod_equipo);                                        
                    }
                }
                
                //Cambios: 24 de febrero de 2014
                //Se obtienen los códigos de los grupos de equipos seleccionados
                $temp2 = $cod_grupos;
                $cods_grupos = json_decode($temp2);
                if($cods_grupos != ''){
                    foreach ($cods_grupos as $cod_grupo) {
                        $criteria1 = new Criteria();
                        $criteria1->add(GrupoPorEquipoPeer::GREQ_GRU_CODIGO, $cod_grupo);
                        $grupoporequipo = GrupoPorEquipoPeer::doSelect($criteria1);
                        foreach ($grupoporequipo as $equipo) {
                            $criteria -> addOr(MaquinaPeer::MAQ_CODIGO, $equipo->getGreqMaqCodigo());
                        }                
                    }
                }
                
                $maquinas = MaquinaPeer::doSelect($criteria);
                foreach($maquinas as $maquina) {
                    $codigoTemporalMaquina = $maquina->getMaqCodigo();
                    $tpp_sem += RegistroUsoMaquinaPeer::calcularTPPSemanaEnHoras($codigoTemporalMaquina, $fecha_inicio, $fecha_fin, $params, 8);
                    $tnp_sem += RegistroUsoMaquinaPeer::calcularTNPSemanaEnHoras($codigoTemporalMaquina, $fecha_inicio, $fecha_fin, $params, 8);
                    $tpnp_sem += RegistroUsoMaquinaPeer::calcularTPNPSemanaEnHoras($codigoTemporalMaquina, $fecha_inicio, $fecha_fin, $params, 8);
                    $tiempoCalendario += $maquina->calcularNumeroHorasActivasSemana($fecha_inicio, $fecha_fin);
                    $tp_sem += RegistroUsoMaquinaPeer::calcularTPSemanaEnHoras($codigoTemporalMaquina, $fecha_inicio, $fecha_fin, $params, 8);
                }
                $tf_sem += RegistroUsoMaquinaPeer::calcularTFDiaMesAño($tiempoCalendario, $tpp_sem, $tnp_sem);
                $to_sem += RegistroUsoMaquinaPeer::calcularTODiaMesAño($tf_sem, $tpnp_sem);                

                $datos['TP'] = $tp_sem;
                $datos['TNP'] = $tnp_sem;
                $datos['TPNP'] = $tpnp_sem;
                $datos['TPP'] = $tpp_sem;
                $datos['TO'] = $to_sem;
                $datos['TF'] = $tf_sem;
                $datos['HorasActivas'] = $tiempoCalendario;
            }catch (Exception $excepcion)
            {
                    echo "(exeption: 'Excepci&oacute;n en reporte-calcularTiemposDiariosMes ',error:'".$excepcion->getMessage()."')";
            }
            return $datos;
	}

	/**************************************Reporte de indicadores diarios del mes *******************/
	public function executeGenerarDatosGraficoIndicadores(sfWebRequest $request)
	{
            //Calculo de la fecha de inicio y fin de cada semana                
            $fecha_inicio = $this->getRequestParameter('fecha_inicio');
            $fecha_fin = $this->getRequestParameter('fecha_fin');
            $rango_fechas = $this->rango($fecha_inicio, $fecha_fin);
            $datos = $this->calcularIndicadoresDiarios($rango_fechas);
            
            $indicadores_tiempo = array('D', 'E', 'C', 'A', 'OEE', 'PTEE');
            $indicadores_colores = array('ff5454','47d552','f0a05f','ffdc44','72a8cd','b97a57');

            $xml='<?xml version="1.0"?>';
            $xml.='<chart>';

            $xml.='<series>';
            for($diasmes=0; $diasmes<sizeof($rango_fechas); $diasmes++) {
                $xml.='<value xid="'.$this->mes($rango_fechas[$diasmes]['fecha_inicio']).'">'.$this->mes($rango_fechas[$diasmes]['fecha_inicio']).'</value>';
            }
            $xml.='</series>';
            $xml.='<graphs>';
            for ($indicador=0;$indicador<6;$indicador++) {
                $xml.='<graph color="#'.$indicadores_colores[$indicador].'" title="'.$indicadores_tiempo[$indicador].'" bullet="round">';
                for($diasmes=0; $diasmes<sizeof($rango_fechas); $diasmes++){
                        $numero_indicadores_dia = $datos[$diasmes][$indicadores_tiempo[$indicador]];
                        $xml.='<value xid="'.$this->mes($rango_fechas[$diasmes]['fecha_inicio']).'">'.$numero_indicadores_dia.'</value>';
                }
                $xml.='</graph>';
            }
            $xml.='</graphs>';
            $xml.='</chart>';

            $this->getRequest()->setRequestFormat('xml');
            $response = $this->getResponse();
            $response->setContentType('text/xml');
            $response->setHttpHeader('Content-length', strlen($xml), true);
            return $this->renderText($xml);
	}

	public function calcularIndicadoresDiarios($rango_fechas)
	{
            $datos = array();
            $datosTiempos = array();

            try{                
                //Calculo de indicadores por semana
                /*Se calculan los indicadores por día pero se van sumando de acuerdo con el rango de cada semana*/                
                for($i=0; $i<sizeof($rango_fechas); $i++) {
                    $fecha_inicio = $rango_fechas[$i]['fecha_inicio'];
                    $fecha_fin = $rango_fechas[$i]['fecha_fin'];
                    $fecha = $this->fecha($fecha_inicio);
                    $temp = $this->calcularTiemposDiarios($fecha[0], $fecha[1], $fecha[2]);
                    $datosTiempos[$i]['TP'] = $temp['TP'];
                    $datosTiempos[$i]['TNP'] = $temp['TNP'];
                    $datosTiempos[$i]['TPNP'] = $temp['TPNP'];
                    $datosTiempos[$i]['TPP'] = $temp['TPP'];
                    $datosTiempos[$i]['TO'] = $temp['TO'];
                    $datosTiempos[$i]['TF'] = $temp['TF'];
                    $datosTiempos[$i]['HorasActivas'] = $temp['HorasActivas'];
                    while($fecha_inicio < $fecha_fin) {
                            $fecha_inicio = date('Y-m-d',strtotime('+1 day', strtotime($fecha_inicio)));
                            $fecha = $this->fecha($fecha_inicio);
                            $temp = $this->calcularTiemposDiarios($fecha[0], $fecha[1], $fecha[2]);
                            $datosTiempos[$i]['TP'] += $temp['TP'];
                            $datosTiempos[$i]['TNP'] += $temp['TNP'];
                            $datosTiempos[$i]['TPNP'] += $temp['TPNP'];
                            $datosTiempos[$i]['TPP'] += $temp['TPP'];
                            $datosTiempos[$i]['TO']  += $temp['TO'];
                            $datosTiempos[$i]['TF'] += $temp['TF'];
                            $datosTiempos[$i]['HorasActivas'] += $temp['HorasActivas'];
                    }
                }
                
                for($i=0; $i<sizeof($rango_fechas); $i++) {
                    $fecha_inicio = $rango_fechas[$i]['fecha_inicio'];
                    $fecha_fin = $rango_fechas[$i]['fecha_fin'];
                    $datosInyecciones = $this->calcularInyeccionesSemana($fecha_inicio, $fecha_fin);
                    $criteria = new Criteria();
                    
                    //Cambios: 24 de febrero de 2014
                    //Se obtienen los códigos de los equipos seleccionados
                    $temp = $this->getRequestParameter('cods_equipos');
                    $cods_equipos = json_decode($temp);
                    if($cods_equipos != ''){
                        foreach ($cods_equipos as $cod_equipo) {
                            $criteria -> addOr(MaquinaPeer::MAQ_CODIGO, $cod_equipo);
                        }
                    }
                    
                    //Cambios: 24 de febrero de 2014
                    //Se obtienen los códigos de los grupos de equipos seleccionados
                    $temp2 = $this->getRequestParameter('cods_grupos');
                    $cods_grupos = json_decode($temp2);
                    if($cods_grupos != ''){
                        foreach ($cods_grupos as $cod_grupo) {
                            $criteria1 = new Criteria();
                            $criteria1->add(GrupoPorEquipoPeer::GREQ_GRU_CODIGO, $cod_grupo);
                            $grupoporequipo = GrupoPorEquipoPeer::doSelect($criteria1);
                            foreach ($grupoporequipo as $equipo) {
                                $criteria -> addOr(MaquinaPeer::MAQ_CODIGO, $equipo->getGreqMaqCodigo());
                            }                
                        }
                    }

                    $tf_dia = $datosTiempos[$i]['TF'];
                    $to_dia = $datosTiempos[$i]['TO'];
                    $tp_dia = $datosTiempos[$i]['TP'];
                                        
                    $numeroInyecciones = $datosInyecciones['inyecciones'];
                    $numeroReinyecciones = $datosInyecciones['reinyecciones'];

                    $d_dia = RegistroUsoMaquinaPeer::calcularDisponibilidad($to_dia, $tf_dia);
                    $e_dia = RegistroUsoMaquinaPeer::calcularEficiencia($tp_dia, $to_dia);
                    $c_dia = RegistroUsoMaquinaPeer::calcularCalidad($numeroInyecciones, $numeroReinyecciones);
                    $horasActivas = $datosTiempos[$i]['HorasActivas'];
                    $a_dia = RegistroUsoMaquinaPeer::calcularAprovechamiento($tf_dia, $horasActivas);
                    $oee_dia = RegistroUsoMaquinaPeer::calcularEfectividadGlobalEquipo($d_dia, $e_dia, $c_dia);
                    $ptee_dia = RegistroUsoMaquinaPeer::calcularProductividadTotalEfectiva($a_dia,$oee_dia);

                    $datos[$i]['D'] = round($d_dia,2);
                    $datos[$i]['E'] = round($e_dia,2);
                    $datos[$i]['C'] = round($c_dia,2);
                    $datos[$i]['A'] = round($a_dia,2);
                    $datos[$i]['OEE'] = round($oee_dia,2);
                    $datos[$i]['PTEE'] = round($ptee_dia,2);
                }                                     
            }catch (Exception $excepcion)
            {
                return "(exeption: 'Excepci&oacute;n en reporte-calcularTiemposDiariosMes ',error:'".$excepcion->getMessage()."')";
            }
            return $datos;
	}
        
	/**************************************Reporte de indicadores barra del mes *******************/
	public function executeGenerarDatosGraficoIndicadoresBarras(sfWebRequest $request)
	{            
            //Códigos de los equipos seleccionados
            $cod_equipos = $this->getRequestParameter('cods_equipos');
            //Códigos de los grupos seleccionados
            $cod_grupos = $this->getRequestParameter('cods_grupos');
            //Calculo de la fecha de inicio y fin de cada semana                
            $fecha_inicio = $this->getRequestParameter('fecha_inicio');
            $fecha_fin = $this->getRequestParameter('fecha_fin');
            $rango_fechas = $this->rango($fecha_inicio, $fecha_fin);
            
            //Día de inicio y fin del ranto total de semanas
            $fecha_in = $rango_fechas[0]['fecha_inicio'];
            $fecha_fn = $rango_fechas[sizeof($rango_fechas)-1]['fecha_fin'];
            
            $fecha_ind = strtotime($fecha_inicio);
            $ano = date('Y', $fecha_ind);

            $datos=$this->calcularIndicadoresDiariosSemanaBarras($fecha_in, $fecha_fn, $cod_equipos, $cod_grupos);
            $datos_metas=$this->obtenerIndicadoresMetasMesBarras($ano);
            $indicadores_porcentaje=array(      'D',     'E',     'C',    'A',   'OEE',   'PTEE');
            $indicadores_descripcion=array('Disponibilidad','Eficiencia','Calidad','Aprovechamiento','Efectividad global','PTEE');
            $indicadores_colores=array('ff5454','47d552','f0a05f','ffdc44','72a8cd','b97a57');

            $xml='<?xml version="1.0"?>';
            $xml.='<chart>';

            $xml.='<series>';
            for($ind=0;$ind<6;$ind++)
            {
                    $xml.='<value xid="'.$ind.'" >'.$indicadores_descripcion[$ind].'</value>';
            }
            $xml.='</series>';
            $xml.='<graphs>';
            $xml.='<graph  title="Resultado Indicador " color="F0A05F" >';
            for ($ind=0;$ind<6;$ind++){
                    $resultado=$datos[$indicadores_porcentaje[$ind]];
                    $xml.='<value xid="'.$ind.'" color="F0A05F">'.$resultado.'</value>';
            }
            $xml.='</graph>';

            $xml.='<graph  title="Meta Indicador " color="7F8DA9" >';
            for ($ind=0;$ind<6;$ind++){
                    $resultado=$datos_metas[$indicadores_porcentaje[$ind]];
                    $xml.='<value xid="'.$ind.'" color="7F8DA9">'.$resultado.'</value>';
            }
            $xml.='</graph>';
            $xml.='</graphs>';
            $xml.='</chart>';

            $this->getRequest()->setRequestFormat('xml');
            $response = $this->getResponse();
            $response->setContentType('text/xml');
            $response->setHttpHeader('Content-length', strlen($xml), true);
            return $this->renderText($xml);
	}

	public function calcularIndicadoresDiariosSemanaBarras($fecha_inicio, $fecha_fin, $cod_equipos, $cod_grupos)
	{
            $datos = array();
            $datosInyecciones = array();
            
            try {                                
                $datosTiempos = $this->calcularTiemposDiariosSemanaTorta($fecha_inicio, $fecha_fin, $cod_equipos, $cod_grupos);

                $tp_sem = $datosTiempos['TP'];
                $tf_sem = $datosTiempos['TF'];
                $to_sem = $datosTiempos['TO'];
                
                $fecha_in = strtotime($fecha_inicio);
                $dia = (int) date('d', $fecha_in);
                $mes = (int) date('m', $fecha_in);
                $ano = (int) date('Y', $fecha_in);
                $temp = $this->calcularInyeccionesDiarias($ano, $mes, $dia);
                $datosInyecciones['inyeccionesMes'] = $temp['inyeccionesMes'];
                $datosInyecciones['reinyeccionesMes'] = $temp['reinyeccionesMes'];
                while($fecha_inicio < $fecha_fin) {
                    $fecha_inicio = date('Y-m-d',strtotime('+1 day', strtotime($fecha_inicio)));
                    $fecha_in = strtotime($fecha_inicio);
                    $dia = (int) date('d', $fecha_in);
                    $mes = (int) date('m', $fecha_in);
                    $ano = (int) date('Y', $fecha_in);
                    $temp = $this->calcularInyeccionesDiarias($ano, $mes, $dia);
                    $datosInyecciones['inyeccionesMes'] += $temp['inyeccionesMes'];
                    $datosInyecciones['reinyeccionesMes'] += $temp['reinyeccionesMes'];
                }

                $numeroInyeccionesMes = $datosInyecciones['inyeccionesMes'];
                $numeroReinyeccionesMes = $datosInyecciones['reinyeccionesMes'];

                $d_mes = RegistroUsoMaquinaPeer::calcularDisponibilidad($to_sem, $tf_sem);
                $e_mes = RegistroUsoMaquinaPeer::calcularEficiencia($tp_sem, $to_sem);
                $c_mes = RegistroUsoMaquinaPeer::calcularCalidad($numeroInyeccionesMes, $numeroReinyeccionesMes);
                $cantidadHoras = $datosTiempos['HorasActivas'];
                $a_mes = RegistroUsoMaquinaPeer::calcularAprovechamiento($tf_sem, $cantidadHoras);
                $oee_mes = RegistroUsoMaquinaPeer::calcularEfectividadGlobalEquipo($d_mes, $e_mes, $c_mes);
                $ptee_mes = RegistroUsoMaquinaPeer::calcularProductividadTotalEfectiva($a_mes, $oee_mes);

                $datos['D'] = round($d_mes, 2);
                $datos['E'] = round($e_mes, 2);
                $datos['C'] = round($c_mes, 2);
                $datos['A'] = round($a_mes, 2);
                $datos['OEE'] = round($oee_mes, 2);
                $datos['PTEE'] = round($ptee_mes, 2);
            }catch (Exception $excepcion)
            {
                echo "(exeption: 'Excepci&oacute;n en reporte-calcularTiemposDiariosMes ',error:'".$excepcion->getMessage()."')";
            }
            return $datos;
	}

	public function obtenerIndicadoresMetasMesBarras($anio)
	{
		$datos;
		try{
			$emp_codigo=$this->getUser()->getAttribute('empl_emp_codigo');

			$datos['A'] = $this->obtenerMetaPorIndicador($anio,'A',$emp_codigo);
			$datos['E'] = $this->obtenerMetaPorIndicador($anio,'E',$emp_codigo);
			$datos['C'] = $this->obtenerMetaPorIndicador($anio,'C',$emp_codigo);
			$datos['D'] = $this->obtenerMetaPorIndicador($anio,'D',$emp_codigo);
			$datos['OEE'] = $this->obtenerMetaPorIndicador($anio,'OEE',$emp_codigo);
			$datos['PTEE'] = $this->obtenerMetaPorIndicador($anio,'PTEE',$emp_codigo);

		}catch (Exception $excepcion)
		{
			echo "(exeption: 'Excepci&oacute;n en reporte-obtenerIndicadoresMetasMesBarras ',error:'".$excepcion->getMessage()."')";
		}

		return $datos;
	}

	public function obtenerMetaPorIndicador($anio,$ind_sigla,$emp_codigo)
	{
		$salida=0;
		try{
			//echo($anio);
			if($anio!='' && $emp_codigo!='' && $ind_sigla!='')
			{
				$conexion = new Criteria();
				$conexion->add(MetaAnualXIndicadorPeer::MEA_ANIO,$anio);
				$conexion->add(MetaAnualXIndicadorPeer::MEA_EMP_CODIGO,$emp_codigo);
				$conexion->addJoin(MetaAnualXIndicadorPeer::MEA_IND_CODIGO,IndicadorPeer::IND_CODIGO);
				$conexion->add(IndicadorPeer::IND_SIGLA,$ind_sigla,Criteria::EQUAL);

				$metaanualxindicador = MetaAnualXIndicadorPeer::doSelectOne($conexion);

				if($metaanualxindicador){
					$salida= $metaanualxindicador->getMeaValor();
				}

			}
		}
		catch (Exception $excepcion)
		{
			echo "({success: false, errors: { reason: 'Hubo una excepci&oacute;n en obtenerMetaPorIndicador',error:'".$excepcion->getMessage()."'}})";
		}
		return $salida;
	}



	/**
	 *@author:maryit sanchez
	 *@date:6 de enero de 2011
	 *Esta funcion retorna  un listado de los analaistas
	 */
	public function executeListarAnalistas(sfWebRequest $request)
	{

		$salida='({"total":"0", "results":""})';
		$datos=EmpleadoPeer::listarAnalistas();
		$cant=count($datos);
		if (count($datos)>0){
			$jsonresult = json_encode($datos);
			$salida= '({"total":"'.$cant.'","results":'.$jsonresult.'})';
		}
		return $this->renderText($salida);
	}

	public function executeListarEquiposActivos(sfWebRequest $request)
	{
		$salida = '({"total":"0", "results":""})';
		$datos = MaquinaPeer::listarEquiposActivos();
		$cant = count($datos);
		if (count($datos)>0){
			$jsonresult = json_encode($datos);
			$salida= '({"total":"'.$cant.'","results":'.$jsonresult.'})';
		}
		return $this->renderText($salida);
	}

	/**
	 *@author:maryit sanchez
	 *@date:6 de enero de 2011
	 *Esta funcion retorna  un listado de los maquinas
	 */
	public function executeListarMaquinas(sfWebRequest $request)
	{
		$salida='({"total":"0", "results":""})';
		$datos=MaquinaPeer::listarMaquinasBuenas();
		$cant=count($datos);
		if (count($datos)>0){
			$jsonresult = json_encode($datos);
			$salida= '({"total":"'.$cant.'","results":'.$jsonresult.'})';
		}
		return $this->renderText($salida);
	}


	/**
	 *@author:maryit sanchez
	 *@date:6 de enero de 2011
	 *Esta funcion retorna  un listado de los metodos
	 */
	public function executeListarMetodos(sfWebRequest $request)
	{
		$salida='({"total":"0", "results":""})';
		$datos=MetodoPeer::listarMetodosActivos();
		$cant=count($datos);
		if ($cant>0){
			$jsonresult = json_encode($datos);
			$salida= '({"total":"'.$cant.'","results":'.$jsonresult.'})';
		}
		return $this->renderText($salida);
	}
        
        //Reemplaza el número del mes por el nombre
        public function mes($fecha_original) {
            $fecha = strtotime($fecha_original);
            $dia = (int) date('d', $fecha);
            $mes = (int) date('m', $fecha);
            $ano = (int) date('Y', $fecha);
            if($mes == 1) { return ($dia.'-Ene-'.$ano); }
            if($mes == 2) { return ($dia.'-Feb-'.$ano); }
            if($mes == 3) { return ($dia.'-Mar-'.$ano); }
            if($mes == 4) { return ($dia.'-Abr-'.$ano); }
            if($mes == 5) { return ($dia.'-May-'.$ano); }
            if($mes == 6) { return ($dia.'-Jun-'.$ano); }
            if($mes == 7) { return ($dia.'-Jul-'.$ano); }
            if($mes == 8) { return ($dia.'-Ago-'.$ano); }
            if($mes == 9) { return ($dia.'-Sep-'.$ano); }
            if($mes == 10) { return ($dia.'-Oct-'.$ano); }
            if($mes == 11) { return ($dia.'-Nov-'.$ano); }
            if($mes == 12) { return ($dia.'-Dic-'.$ano); }
        }
        
        //Retorna por el separado el día, el mes y el ano de una fecha
        public function fecha($fecha_original) {
            $fecha = strtotime($fecha_original);
            $ano = (int) date('Y', $fecha);
            $mes = (int) date('m', $fecha);
            $dia = (int) date('d', $fecha);
            return array($ano, $mes, $dia);
        }
        
        //Calcula la fecha de inicio y fin de cada semana
        public function rango($fecha_inicio, $fecha_fin) {
            
            $rango_fechas = array();
            $pos = 0;                 		               
            $posicionDia = date("w", strtotime($fecha_inicio));
            $fechaInicial = date('Y-m-d',strtotime('-'.($posicionDia-1).' day', strtotime($fecha_inicio)));
            $fechaFinal = date('Y-m-d',strtotime('+6 day', strtotime($fechaInicial)));
            $rango_fechas[$pos]['fecha_inicio'] = $fechaInicial;
            $rango_fechas[$pos]['fecha_fin'] = $fechaFinal;
            while($fechaFinal < $fecha_fin) {
                $fechaInicial = date('Y-m-d',strtotime('+1 week', strtotime($fechaInicial)));
                $fechaFinal = date('Y-m-d',strtotime('+1 week', strtotime($fechaFinal)));
                $pos++;
                $rango_fechas[$pos]['fecha_inicio'] = $fechaInicial;
                $rango_fechas[$pos]['fecha_fin'] = $fechaFinal;
            }
            return $rango_fechas;
        }
        
        public function executeListarGruposActivos(sfWebRequest $request)
	{                
		$salida = '({"total":"0", "results":""})';
		$datos = GrupoEquipoPeer::listarGruposActivos();
		$cant = count($datos);
		if (count($datos)>0){
			$jsonresult = json_encode($datos);
			$salida= '({"total":"'.$cant.'","results":'.$jsonresult.'})';
		}
		return $this->renderText($salida);
	}
        
        //Cambios: 24 de febrero de 2014
        //Retorna el nombre de los equipos seleccionados
        public function executeEquiposSeleccionados(sfWebRequest $request)
	{           
            $salida = '({"total":"0", "results":""})';
            $fila = 0;
            $datos = array();
            
            //Cambios: 24 de febrero de 2014
            //Se obtienen los códigos de los equipos seleccionados
            $temp = $this->getRequestParameter('cods_equipos');
            $cods_equipos = json_decode($temp);
            if($cods_equipos != ''){
                foreach ($cods_equipos as $cod_equipo) {                    
                    $equipo = MaquinaPeer::retrieveByPK($cod_equipo);
                    $datos[$fila]['maq_sem_nombre'] = $equipo->getMaqNombre();
                    $fila++;
                }
            }
            
            if($fila>0){
                $jsonresult = json_encode($datos);
                $salida= '({"total":"'.$fila.'","results":'.$jsonresult.'})';
            }
            
            return $this->renderText($salida);                        
	}
        
        //Cambios: 24 de febrero de 2014
        //Retorna el nombre de los grupos de equipos seleccionados
        public function executeGruposSeleccionados(sfWebRequest $request)
	{           
            $salida = '({"total":"0", "results":""})';
            $fila = 0;
            $datos = array();
            
            //Cambios: 24 de febrero de 2014
            //Se obtienen los códigos de los equipos seleccionados
            $temp = $this->getRequestParameter('cods_grupos');
            $cods_grupos = json_decode($temp);
            if($cods_grupos != ''){
                foreach ($cods_grupos as $cod_grupo) {                    
                    $grupo = GrupoEquipoPeer::retrieveByPK($cod_grupo);
                    $datos[$fila]['gru_sem_nombre'] = $grupo->getGruNombre();
                    $fila++;
                }
            }
            
            if($fila>0){
                $jsonresult = json_encode($datos);
                $salida= '({"total":"'.$fila.'","results":'.$jsonresult.'})';
            }
            
            return $this->renderText($salida);                        
	}
        
        //Cambios: 24 de febrero de 2014
        //Calcula el consolidado total por tiempo (TP - TPNP - TO - TNP)
        public function executeConsolidadoTiemposSemana(sfWebRequest $request)
	{            
            //Códigos de los equipos seleccionados
            $cod_equipos = $this->getRequestParameter('cods_equipos');
            //Códigos de los grupos seleccionados
            $cod_grupos = $this->getRequestParameter('cods_grupos');
            //Fecha de inicio y fin de cada semana
            $fecha_inicio = $this->getRequestParameter('fecha_inicio');
            $fecha_fin = $this->getRequestParameter('fecha_fin');
            $rango_fechas = $this->rango($fecha_inicio, $fecha_fin);
            
            //Día de inicio y fin del rango total de semanas
            $fecha_in = $rango_fechas[0]['fecha_inicio'];
            $fecha_fn = $rango_fechas[sizeof($rango_fechas)-1]['fecha_fin'];

            $datos_ind = $this->calcularTiemposDiariosSemanaTorta($fecha_in, $fecha_fn, $cod_equipos, $cod_grupos);
            $indicadores = array('TPP', 'TNP', 'TPNP', 'TO');
            
            //Se calcula la suma de horas de los cuatro indicadores para el cálculo del porcentaje
            $total_horas = $datos_ind[$indicadores[0]]+$datos_ind[$indicadores[1]]+$datos_ind[$indicadores[2]]+$datos_ind[$indicadores[3]];
            
            $salida = '({"total":"0", "results":""})';
            $fila = 0;
            $datos = array();
            
            for($i=0; $i<sizeof($indicadores); $i++) {
                $datos[$fila]['sem_tiempo'] = $indicadores[$i];
                $datos[$fila]['sem_horas'] = number_format($datos_ind[$indicadores[$i]], 2, ',', '.');
                //Se calcula el porcentaje para cada indicador
                $porcentaje = (($datos_ind[$indicadores[$i]]*100))/$total_horas;
                $datos[$fila]['sem_porcentaje'] = number_format($porcentaje, 2, ',', '.');
                $fila++;
            }
            if($fila>0){
                $jsonresult = json_encode($datos);
                $salida= '({"total":"'.$fila.'","results":'.$jsonresult.'})';
            }
            
            return $this->renderText($salida);                        
	}
        
        
        //Cambios: 24 de febrero de 2014
        //Calcula el consolidado total por indicador (D - E - C - A - OEE - PTEE)
        public function executeConsolidadoIndicadoresSemana(sfWebRequest $request)
	{            
            //Códigos de los equipos seleccionados
            $cod_equipos = $this->getRequestParameter('cods_equipos');
            //Códigos de los grupos seleccionados
            $cod_grupos = $this->getRequestParameter('cods_grupos');
            //Fecha de inicio y fin de cada semana
            $fecha_inicio = $this->getRequestParameter('fecha_inicio');
            $fecha_fin = $this->getRequestParameter('fecha_fin');
            $rango_fechas = $this->rango($fecha_inicio, $fecha_fin);
            
            //Día de inicio y fin del rango total de semanas
            $fecha_in = $rango_fechas[0]['fecha_inicio'];
            $fecha_fn = $rango_fechas[sizeof($rango_fechas)-1]['fecha_fin'];
            
            //Obtener el año del las fechas seleccionadas
            $fecha_ind = strtotime($fecha_inicio);            
            $ano = date('Y', $fecha_ind);
            
            $datos_ind = $this->calcularIndicadoresDiariosSemanaBarras($fecha_in, $fecha_fn, $cod_equipos, $cod_grupos);
            $datos_metas = $this->obtenerIndicadoresMetasMesBarras($ano);
            $indicadores = array('D', 'E', 'C', 'A', 'OEE', 'PTEE');
            $ind_nombres = array('Disponibilidad', 'Eficiencia', 'Calidad', 'Aprovechamiento', 'OEE', 'PTEE');
            
            $salida = '({"total":"0", "results":""})';
            $fila = 0;
            $datos = array();
            
            for($i=0; $i<sizeof($indicadores); $i++) {
                $datos[$fila]['sem_indicador'] = $ind_nombres[$i];
                $datos[$fila]['sem_actual'] = $datos_ind[$indicadores[$i]];
                $datos[$fila]['sem_meta'] = $datos_metas[$indicadores[$i]];
                $fila++;
            }
            if($fila>0){
                $jsonresult = json_encode($datos);
                $salida= '({"total":"'.$fila.'","results":'.$jsonresult.'})';
            }
            
            return $this->renderText($salida);                        
	}
        
        
        //Cambios: 24 de febrero de 2014
        //Calcula el consolidado total por indicador (Paros - Reensayos - Pérdidas)
        public function executeConsolidadoPerdidasSemana(sfWebRequest $request)
	{            
            $user = $this->getUser();
            $codigo_usuario = $user->getAttribute('usu_codigo');
            $conexion = new Criteria();
            $conexion->add(EmpleadoPeer::EMPL_USU_CODIGO, $codigo_usuario);
            $operario = EmpleadoPeer::doSelectOne($conexion);
            $criteria = new Criteria();
            $criteria->add(EmpresaPeer::EMP_CODIGO, $operario->getEmplEmpCodigo());
            $empresa = EmpresaPeer::doSelectOne($criteria);
            $inyeccionesEstandarPromedio = $empresa->getEmpInyectEstandarPromedio();
            
            //Fecha de inicio y fin de cada semana
            $fecha_inicio = $this->getRequestParameter('fecha_inicio');
            $fecha_fin = $this->getRequestParameter('fecha_fin');
            $rango_fechas = $this->rango($fecha_inicio, $fecha_fin);
            
            //Día de inicio y fin del rango total de semanas
            $fecha_in = $rango_fechas[0]['fecha_inicio'];
            $fecha_fn = $rango_fechas[sizeof($rango_fechas)-1]['fecha_fin'];
            
            $datos_ind = $this->calcularPerdidasSemana($fecha_in, $fecha_fn, $inyeccionesEstandarPromedio);
            $indicadores = array('paros', 'retrabajos', 'perdida_rendimiento');
            $ind_nombres = array('Paros menores', 'Reensayos', 'Pérd. velocidad');
            
            //Se calcula la suma de horas de los tres indicadores para el cálculo del porcentaje
            $total_horas = $datos_ind[$indicadores[0]]+$datos_ind[$indicadores[1]]+$datos_ind[$indicadores[2]];
            
            $salida = '({"total":"0", "results":""})';
            $fila = 0;
            $datos = array();
            
            for($i=0; $i<sizeof($indicadores); $i++) {
                $datos[$fila]['sem_perdida'] = $ind_nombres[$i];
                $datos[$fila]['sem_horas_perd'] = number_format($datos_ind[$indicadores[$i]], 2, ',', '.');                
                $porcentaje = (($datos_ind[$indicadores[$i]]*100))/$total_horas;
                $datos[$fila]['sem_porcentaje_perd'] = number_format($porcentaje, 2, ',', '.');
                $fila++;
            }
            if($fila>0){
                $jsonresult = json_encode($datos);
                $salida= '({"total":"'.$fila.'","results":'.$jsonresult.'})';
            }
            
            return $this->renderText($salida);                        
	} 
}