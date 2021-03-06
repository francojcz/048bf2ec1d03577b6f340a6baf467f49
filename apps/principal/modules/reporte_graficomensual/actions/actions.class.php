﻿<?php

/**
 * reporte_graficomensual actions.
 *
 * @package    tpmlabs
 * @subpackage reporte_graficomensual
 * @author     maryit sanchez
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class reporte_graficomensualActions extends sfActions
{
	/**
	 * Executes index action
	 *
	 * @param sfRequest $request A request object
	 */
	public function executeIndex(sfWebRequest $request)
	{
	}

	public function obtenerConexionSinFecha() {
		$metodo_codigo=$this->getRequestParameter('metodo_codigo');
		$analista_codigo=$this->getRequestParameter('analista_codigo');

		$conexion = new Criteria();
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
	/**************************************Reporte de inyecciones *******************/
	public function executeGenerarDatosGraficoInyecciones(sfWebRequest $request)
	{
		$anio=$this->getRequestParameter('anio');
		$mes=$this->getRequestParameter('mes');
		$cant_dias=$this->obtenerCantidadDiasMes($mes,$anio);

		$total_inyecciones_realiza_mes=0;
		$total_reinyecciones_mes=0;
		$datos=$this->calcularInyecciones($anio,$mes,$cant_dias);
		$max_numero_inyecc=0;

		$xml='<?xml version="1.0"?>';
		$xml.='<chart>';

		$xml.='<series>';
		for($diasmes=1;$diasmes<$cant_dias;$diasmes++)
		{
			$xml.='<value xid="'.$diasmes.'">'.$diasmes.'</value>';
		}
		$xml.='</series>';
		$xml.='<graphs>';
		$xml.='<graph color="#72a8cd" title="Número inyecciones realizadas" bullet="round">';
		for($diasmes=1;$diasmes<$cant_dias;$diasmes++){

			$total_inyecciones_realiza=$datos[$diasmes]['inyecciones'];
			$xml.='<value xid="'.$diasmes.'">'.round($total_inyecciones_realiza, 2).'</value>';

			$total_inyecciones_realiza_mes+=$total_inyecciones_realiza ;

			if($total_inyecciones_realiza>$max_numero_inyecc){
				$max_numero_inyecc=$total_inyecciones_realiza;
			}
		}
		$xml.='</graph>';

		$xml.='<graph color="#ff5454" title="Número reinyecciones" bullet="round">';
		for($diasmes=1;$diasmes<$cant_dias;$diasmes++){
			$total_reinyecciones=$datos[$diasmes]['reinyecciones'];
			$xml.='<value xid="'.$diasmes.'">'.round($total_reinyecciones, 2).'</value>';
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

	public function calcularInyecciones($anio,$mes,$cant_dias)
	{
		$datos;
		try{
			$numeroInyeccionesMes = 0;
			$numeroReinyeccionesMes = 0;
			for($dia=1;$dia<$cant_dias;$dia++){
				$suma_numero_inyecciones_dia= 0;
				$suma_numero_reinyecciones_dia= 0;

				$conexion=$this->obtenerConexionDia($anio.'-'.$mes.'-'.$dia);
				$registros_uso_maquinas = RegistroUsoMaquinaPeer::doSelect($conexion);

				foreach($registros_uso_maquinas as $temporal)
				{
					$suma_numero_inyecciones_dia+= $temporal->contarNumeroInyeccionesObligatorias();
					$suma_numero_reinyecciones_dia+= $temporal->contarNumeroTotalReinyecciones();
				}
				$datos[$dia]['inyecciones'] = $suma_numero_inyecciones_dia;
				$numeroInyeccionesMes += $suma_numero_inyecciones_dia;
				$datos[$dia]['reinyecciones'] = $suma_numero_reinyecciones_dia;
				$numeroReinyeccionesMes += $suma_numero_reinyecciones_dia;
			}
			$datos['inyeccionesMes'] = $numeroInyeccionesMes;
			$datos['reinyeccionesMes'] = $numeroReinyeccionesMes;
		}catch (Exception $excepcion)
		{
			echo "(exception: 'Excepci&oacute;n en reporte-calcularInyecciones ',error:'".$excepcion->getMessage()."')";
		}
		return $datos;
	}

	/**************************************Reporte de muestras *******************/
	public function executeGenerarDatosGraficoMuestras(sfWebRequest $request)
	{
		//$anio='2011';
		//$mes='02';
		$anio=$this->getRequestParameter('anio');
		$mes=$this->getRequestParameter('mes');
		$cant_dias=$this->obtenerCantidadDiasMes($mes,$anio);

		$total_muestras_analizadas_mes=0;
		$total_muestras_reanalizadas_mes=0;
		$max_numero_muestra=0;
		$datos=$this->calcularMuestras($anio,$mes,$cant_dias);

		$xml='<?xml version="1.0"?>';
		$xml.='<chart>';
		$xml.='<series>';
		for($diasmes=1;$diasmes<$cant_dias;$diasmes++)
		{
			$xml.='<value xid="'.$diasmes.'">'.$diasmes.'</value>';
		}
		$xml.='</series>';
		$xml.='<graphs>';
		$xml.='<graph color="#ffdc44" title="Número lotes analizados" bullet="round">';
		for($diasmes=1;$diasmes<$cant_dias;$diasmes++){
			$numero_muestras_analizadas_dia=$datos[$diasmes]['analizadas'];
			$xml.='<value xid="'.$diasmes.'">'.$numero_muestras_analizadas_dia.'</value>';
			$total_muestras_analizadas_mes+=$numero_muestras_analizadas_dia;

			if($numero_muestras_analizadas_dia>$max_numero_muestra){
				$max_numero_muestra=$numero_muestras_analizadas_dia;
			}
		}
		$xml.='</graph>';

		$xml.='<graph color="#47d552" title="Número lotes reanalizados" bullet="round" >';
		for($diasmes=1;$diasmes<$cant_dias;$diasmes++){
			$numero_muestras_reanalizadas_dia=$datos[$diasmes]['reanalizadas'];
			$xml.='<value xid="'.$diasmes.'">'.$numero_muestras_reanalizadas_dia.'</value>';
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
		if($total_muestras_mes!=0){
			$porcen_muestras_analizadas=round((($total_muestras_analizadas_mes/$total_muestras_mes)*100),2);
			$porcen_muestras_reanalizadas=round((($total_muestras_reanalizadas_mes/$total_muestras_mes)*100),2);
		}
		$unidad_separancion=($max_numero_muestra/8);

		$xml.=$this->agregarGuiaGrafica('Total lotes               : '.round($total_muestras_mes,2),$max_numero_muestra+(3*$unidad_separancion));
		if($total_muestras_mes!=0){
			$xml.=$this->agregarGuiaGrafica('Lotes analizados    : '.round($total_muestras_analizadas_mes,2).' ('.$porcen_muestras_analizadas .' %)',$max_numero_muestra+(2*$unidad_separancion));
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

	public function calcularMuestras($anio,$mes,$cant_dias)
	{
		$datos;
		try{

			for($dia=0;$dia<$cant_dias;$dia++){
				$suma_numero_muestras_analizadas_dia= 0;
				$suma_numero_muestras_reanalizadas_dia= 0;

				$conexion=$this->obtenerConexionDia($anio.'-'.$mes.'-'.$dia);
				$registros_uso_maquinas = RegistroUsoMaquinaPeer::doSelect($conexion);

				foreach($registros_uso_maquinas as $temporal)
				{
					$suma_numero_muestras_analizadas_dia+= $temporal->contarNumeroMuestrasProgramadas();
					$suma_numero_muestras_reanalizadas_dia+= $temporal->contarNumeroMuestrasReAnalizadas();
				}
				$datos[$dia]['analizadas']=round($suma_numero_muestras_analizadas_dia,2);
				$datos[$dia]['reanalizadas']=round($suma_numero_muestras_reanalizadas_dia,2);
			}
		}catch (Exception $excepcion)
		{
			return "(exeption: 'Excepci&oacute;n en reporte-calcularMuestras ',error:'".$excepcion->getMessage()."')";
		}
		return $datos;
	}

	/**************************************Reporte de perdidas diarias del mes *******************/
	public function executeGenerarDatosGraficoPerdidas(sfWebRequest $request)
	{
		$user = $this->getUser();
		$codigo_usuario = $user->getAttribute('usu_codigo');
		$criteria = new Criteria();
		$criteria->add(EmpleadoPeer::EMPL_USU_CODIGO, $codigo_usuario);
		$operario = EmpleadoPeer::doSelectOne($criteria);
		$criteria = new Criteria();
		$criteria->add(EmpresaPeer::EMP_CODIGO, $operario->getEmplEmpCodigo());
		$empresa = EmpresaPeer::doSelectOne($criteria);

		$inyeccionesEstandarPromedio = $empresa->getEmpInyectEstandarPromedio();

		//$anio='2011';
		//$mes='02';
		$anio=$this->getRequestParameter('anio');
		$mes=$this->getRequestParameter('mes');
		$cant_dias=$this->obtenerCantidadDiasMes($mes,$anio);

		$datos=$this->calcularPerdidasDiariasMes($anio,$mes,$cant_dias, $inyeccionesEstandarPromedio);

		$xml='<?xml version="1.0"?>';
		$xml.='<chart>';

		$xml.='<series>';
		for($diasmes=1;$diasmes<$cant_dias;$diasmes++)
		{
			$xml.='<value xid="'.$diasmes.'">'.$diasmes.'</value>';
		}
		$xml.='</series>';

		$xml.='<graphs>';
//		$xml.='<graph color="#72a8cd" title="Fallas" bullet="round">';
//		for($diasmes=1;$diasmes<$cant_dias;$diasmes++){
//			$numero_fallas_dia=$datos[$diasmes]['fallas'];
//			$xml.='<value xid="'.$diasmes.'">'.$numero_fallas_dia.'</value>';
//		}
//		$xml.='</graph>';

		$xml.='<graph color="#ff5454" title="Paros menores y fallas" bullet="round" >';
		for($diasmes=1;$diasmes<$cant_dias;$diasmes++){
			$numero_paros_dia=$datos[$diasmes]['paros'];
			$xml.='<value xid="'.$diasmes.'">'.$numero_paros_dia.'</value>';
		}
		$xml.='</graph>';

		$xml.='<graph color="#47d552" title="Reensayos" bullet="round" >';
		for($diasmes=1;$diasmes<$cant_dias;$diasmes++){
			$numero_retrabajos_dia=$datos[$diasmes]['retrabajos'];
			$xml.='<value xid="'.$diasmes.'">'.$numero_retrabajos_dia.'</value>';
		}
		$xml.='</graph>';


		$xml.='<graph color="#47d599" title="Pérdidas de velocidad" bullet="round" >';
		for($diasmes=1;$diasmes<$cant_dias;$diasmes++){
			$numero_retrabajos_dia=$datos[$diasmes]['perdida_rendimiento'];
			$xml.='<value xid="'.$diasmes.'">'.$numero_retrabajos_dia.'</value>';
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

	public function calcularPerdidasDiariasMes($anio,$mes,$cant_dias,$inyeccionesEstandarPromedio)
	{
		$datos;
		try{
			for($dia=1;$dia<$cant_dias;$dia++){
//				$suma_fallas_dia= 0;
				$suma_paros_dia= 0;
				$suma_retrabajos_dia= 0;
				$suma_perdidarendimiento_dia= 0;

				$conexion=$this->obtenerConexionDia($anio.'-'.$mes.'-'.$dia);
				$registros_uso_maquinas = RegistroUsoMaquinaPeer::doSelect($conexion);

				foreach($registros_uso_maquinas as $temporal)
				{
                                        //Cambios: 24 de febrero de 2014
                                        //Se quitó la columna fallas de la interfaz de ingreso de datos
                                        //$suma_fallas_dia+= $temporal->getRumFallas();
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

//				$datos[$dia]['fallas'] = round($suma_fallas_dia/60,2);
				$datos[$dia]['paros'] = round($suma_paros_dia/60,2);
				$datos[$dia]['retrabajos'] = round($suma_retrabajos_dia/60,2);
				$datos[$dia]['perdida_rendimiento'] = round($suma_perdidarendimiento_dia/60,2);

					
			}
		}catch (Exception $excepcion)
		{
			return "(exeption: 'Excepci&oacute;n en reporte-calcularFallas ',error:'".$excepcion->getMessage()."')";
		}
		return $datos;
	}

	/**************************************Reporte de perdidas del mes *******************/
	public function executeGenerarDatosGraficoPerdidasTorta(sfWebRequest $request)
	{
		$user = $this->getUser();
		$codigo_usuario = $user->getAttribute('usu_codigo');
		$criteria = new Criteria();
		$criteria->add(EmpleadoPeer::EMPL_USU_CODIGO, $codigo_usuario);
		$operario = EmpleadoPeer::doSelectOne($criteria);
		$criteria = new Criteria();
		$criteria->add(EmpresaPeer::EMP_CODIGO, $operario->getEmplEmpCodigo());
		$empresa = EmpresaPeer::doSelectOne($criteria);

		$inyeccionesEstandarPromedio = $empresa->getEmpInyectEstandarPromedio();

		//$anio='2011';
		//$mes='01';
		$anio=$this->getRequestParameter('anio');
		$mes=$this->getRequestParameter('mes');

		$datos=$this->calcularPerdidasMes($anio,$mes,$inyeccionesEstandarPromedio);

		$xml='<?xml version="1.0"?>';
		$xml.='<pie>';
//		$xml.='<slice title="Fallas " color="#72a8cd" pull_out="true">'.$datos['fallas'].'</slice>';
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

	public function calcularPerdidasMes($anio,$mes,$inyeccionesEstandarPromedio)
	{
		$datos;
		try{
//			$suma_fallas_dia= 0;
			$suma_paros_dia= 0;
			$suma_retrabajos_dia= 0;
			$suma_perdidarendimiento_dia=0;

			$conexion=$this->obtenerConexionMes($anio,$mes);
			$registros_uso_maquinas = RegistroUsoMaquinaPeer::doSelect($conexion);

			foreach($registros_uso_maquinas as $temporal)
			{
                                //Cambios: 24 de febrero de 2014
                                //Se eliminó la columna fallas de la interfaz de ingreso de datos
                                //$suma_fallas_dia+= $temporal->getRumFallas();
                                
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
//			$datos['fallas']=round($suma_fallas_dia/60,2);
			$datos['paros']=round(($suma_paros_dia/60),2);
			$datos['retrabajos']=round($suma_retrabajos_dia/60,2);
			$datos['perdida_rendimiento']=round($suma_perdidarendimiento_dia/60,2);


		}catch (Exception $excepcion)
		{
			return "(exeption: 'Excepci&oacute;n en reporte-calcularPerdidasMes ',error:'".$excepcion->getMessage()."')";
		}
		return $datos;
	}

	/**************************************Reporte de tiempos diarios del mes *******************/
	public function executeGenerarDatosGraficoTiempos(sfWebRequest $request)
	{
		$user = $this->getUser();
		$codigo_usuario = $user->getAttribute('usu_codigo');
		$criteria = new Criteria();
		$criteria->add(EmpleadoPeer::EMPL_USU_CODIGO, $codigo_usuario);
		$operario = EmpleadoPeer::doSelectOne($criteria);
		$criteria = new Criteria();
		$criteria->add(EmpresaPeer::EMP_CODIGO, $operario->getEmplEmpCodigo());
		$empresa = EmpresaPeer::doSelectOne($criteria);

		$inyeccionesEstandarPromedio = $empresa->getEmpInyectEstandarPromedio();

		//$anio='2011';
		//$mes='02';
		$anio=$this->getRequestParameter('anio');
		$mes=$this->getRequestParameter('mes');
		$cant_dias=$this->obtenerCantidadDiasMes($mes,$anio);

		$datos=$this->calcularTiemposDiariosMes($anio,$mes,$cant_dias,$inyeccionesEstandarPromedio);
		$indicadores_tiempo=array(    'TPP',     'TNP',   'TPNP',  'TF',   'TO');
		$indicadores_colores=array('47d552','ffdc44','ff5454','f0a05f','72a8cd');

		$xml='<?xml version="1.0"?>';
		$xml.='<chart>';

		$xml.='<series>';
		for($diasmes=1;$diasmes<$cant_dias;$diasmes++)
		{
			$xml.='<value xid="'.$diasmes.'">'.$diasmes.'</value>';
		}
		$xml.='</series>';
		$xml.='<graphs>';
		for ($indicador=0;$indicador<5;$indicador++){
			$xml.='<graph color="#'.$indicadores_colores[$indicador].'" title="'.$indicadores_tiempo[$indicador].'" bullet="round">';
			for($diasmes=1;$diasmes<$cant_dias;$diasmes++){
				$numero_tiempos_dia=$datos[$diasmes][$indicadores_tiempo[$indicador]];
				$xml.='<value xid="'.$diasmes.'">'.round($numero_tiempos_dia, 2).'</value>';
			}
			$xml.='</graph>';
		}
		$xml.='</graphs>';

		$xml.='</chart>';

		return $this->renderText($xml);
	}

	public function calcularTiemposDiariosMes($anio,$mes,$cant_dias,$inyeccionesEstandarPromedio)
	{
		$datos = array();

		try{

			$params = array();

			for($dia=1;$dia<$cant_dias;$dia++){
				$año = $anio;

				$tpnp_dia = null;
				$tnp_dia = null;
				$tpp_dia = null;
				$tf_dia = null;
				$to_dia = null;
				$tp_dia = null;

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
                                $tf_dia = 0;
                                $to_dia = 0;
                                $tp_dia = 0;
                                foreach($maquinas as $maquina) {
                                        $codigoTemporalMaquina = $maquina->getMaqCodigo();

                                        $tpnp_dia += RegistroUsoMaquinaPeer::calcularTPNPDiaEnHoras($codigoTemporalMaquina, $dia, $mes, $año, $params, 8);
                                        $tnp_dia += RegistroUsoMaquinaPeer::calcularTNPDiaEnHoras($codigoTemporalMaquina, $dia, $mes, $año, $params, 8);
                                        $tpp_dia += RegistroUsoMaquinaPeer::calcularTPPDiaEnHoras($codigoTemporalMaquina, $dia, $mes, $año, $params, 8);
                                        $horasActivas += $maquina->calcularNumeroHorasActivasDelDia($dia, $mes, $año);
                                        $tp_dia += RegistroUsoMaquinaPeer::calcularTPDiaEnHoras($codigoTemporalMaquina, $dia, $mes, $año, $params, 8);
                                }
                                $tf_dia = $horasActivas - $tpp_dia - $tnp_dia;
                                $to_dia = RegistroUsoMaquinaPeer::calcularTODiaMesAño($tf_dia, $tpnp_dia);
				
				$datos[$dia]['TP'] = $tp_dia;
				$datos[$dia]['TNP'] = $tnp_dia;
				$datos[$dia]['TPNP'] = $tpnp_dia;
				$datos[$dia]['TPP'] = $tpp_dia;
				$datos[$dia]['TO'] = $to_dia;
				$datos[$dia]['TF'] = $tf_dia;
				$datos[$dia]['HorasActivas'] = $horasActivas;
			}
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
		$user = $this->getUser();
		$codigo_usuario = $user->getAttribute('usu_codigo');
		$criteria1 = new Criteria();
		$criteria1->add(EmpleadoPeer::EMPL_USU_CODIGO, $codigo_usuario);
		$operario = EmpleadoPeer::doSelectOne($criteria1);
		$criteria2 = new Criteria();
		$criteria2->add(EmpresaPeer::EMP_CODIGO, $operario->getEmplEmpCodigo());
		$empresa = EmpresaPeer::doSelectOne($criteria2);

		$inyeccionesEstandarPromedio = $empresa->getEmpInyectEstandarPromedio();

		//$anio='2011';
		//$mes='02';
		$anio=$this->getRequestParameter('anio');
		$mes=$this->getRequestParameter('mes');

		$datos=$this->calcularTiemposDiariosMesTorta($anio,$mes,$inyeccionesEstandarPromedio,$cod_equipos,$cod_grupos);
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

	public function calcularTiemposDiariosMesTorta($anio,$mes,$inyeccionesEstandarPromedio, $cod_equipos, $cod_grupos)
	{
		$datos;
		$tp_mes = 0;
		$tnp_mes = 0;
		$tpnp_mes = 0;
		$tpp_mes = 0;
		$to_mes = 0;
		$tf_mes = 0;
		$params = array();
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
                        $tpp_mes = 0;
                        $tnp_mes = 0;
                        $tpnp_mes = 0;
                        $tf_mes = 0;
                        $tp_mes = 0;
                        $tiempoCalendario = 0;
                        foreach($maquinas as $maquina) {
                                //                    $maquina = new Maquina();

                                $codigoTemporalMaquina = $maquina->getMaqCodigo();

                                $tpp_mes += RegistroUsoMaquinaPeer::calcularTPPMesEnHoras($codigoTemporalMaquina, $mes, $anio, $params, 8);
                                $tnp_mes += RegistroUsoMaquinaPeer::calcularTNPMesEnHoras($codigoTemporalMaquina, $mes, $anio, $params, 8);
                                $tpnp_mes += RegistroUsoMaquinaPeer::calcularTPNPMesEnHoras($codigoTemporalMaquina, $mes, $anio, $params, 8);
                                $tiempoCalendario += $maquina->calcularNumeroHorasActivasDelMes($mes, $anio);
                                $tp_mes += RegistroUsoMaquinaPeer::calcularTPMesEnHoras($codigoTemporalMaquina, $mes, $anio, $params, 8);
                        }
                        $tf_mes = RegistroUsoMaquinaPeer::calcularTFDiaMesAño($tiempoCalendario, $tpp_mes, $tnp_mes);
                        $to_mes = RegistroUsoMaquinaPeer::calcularTODiaMesAño($tf_mes, $tpnp_mes);
			
			$datos['TP'] = $tp_mes;
			$datos['TNP'] = $tnp_mes;
			$datos['TPNP'] = $tpnp_mes;
			$datos['TPP'] = $tpp_mes;
			$datos['TO'] = $to_mes;                        
			$datos['TF'] = $tf_mes;//Linea descomentada
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
		$user = $this->getUser();
		$codigo_usuario = $user->getAttribute('usu_codigo');
		$criteria = new Criteria();
		$criteria->add(EmpleadoPeer::EMPL_USU_CODIGO, $codigo_usuario);
		$operario = EmpleadoPeer::doSelectOne($criteria);
		$criteria = new Criteria();
		$criteria->add(EmpresaPeer::EMP_CODIGO, $operario->getEmplEmpCodigo());
		$empresa = EmpresaPeer::doSelectOne($criteria);

		$inyeccionesEstandarPromedio = $empresa->getEmpInyectEstandarPromedio();

		//$anio='2011';
		//$mes='02';
		$anio=$this->getRequestParameter('anio');
		$mes=$this->getRequestParameter('mes');

		$cant_dias=$this->obtenerCantidadDiasMes($mes,$anio);

		$datos=$this->calcularIndicadoresDiariosMes($anio,$mes,$cant_dias, $inyeccionesEstandarPromedio);
		$indicadores_tiempo=array(      'D',     'E',     'C',    'A',   'OEE',   'PTEE');
		$indicadores_colores=array('ff5454','47d552','f0a05f','ffdc44','72a8cd','b97a57');

		$xml='<?xml version="1.0"?>';
		$xml.='<chart>';

		$xml.='<series>';
		for($diasmes=1;$diasmes<$cant_dias;$diasmes++)
		{
			$xml.='<value xid="'.$diasmes.'">'.$diasmes.'</value>';
		}
		$xml.='</series>';
		$xml.='<graphs>';
		for ($indicador=0;$indicador<6;$indicador++){

			$xml.='<graph color="#'.$indicadores_colores[$indicador].'" title="'.$indicadores_tiempo[$indicador].'" bullet="round">';
			for($diasmes=1;$diasmes<$cant_dias;$diasmes++){
				$numero_indicadores_dia=$datos[$diasmes][$indicadores_tiempo[$indicador]];
				$xml.='<value xid="'.$diasmes.'">'.$numero_indicadores_dia.'</value>';
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

	public function calcularIndicadoresDiariosMes($anio,$mes,$cant_dias, $inyeccionesEstandarPromedio)
	{
		$datos = array();
		try{
			$datosTiempos = $this->calcularTiemposDiariosMes($anio, $mes, $cant_dias, $inyeccionesEstandarPromedio);
			$datosInyecciones = $this->calcularInyecciones($anio, $mes, $cant_dias);
                        
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
                        
                        $cantidadMaquinas = MaquinaPeer::doCount($criteria);
			$cantidadHoras = $cantidadMaquinas * 24;

			for($dia=1;$dia<$cant_dias;$dia++){
				$tf_dia = $datosTiempos[$dia]['TF'];
				$to_dia = $datosTiempos[$dia]['TO'];
				$tp_dia = $datosTiempos[$dia]['TP'];

				$numeroInyecciones = $datosInyecciones[$dia]['inyecciones'];
				$numeroReinyecciones = $datosInyecciones[$dia]['reinyecciones'];

				$d_dia = RegistroUsoMaquinaPeer::calcularDisponibilidad($to_dia, $tf_dia);
				$e_dia = RegistroUsoMaquinaPeer::calcularEficiencia($tp_dia, $to_dia);
				$c_dia = RegistroUsoMaquinaPeer::calcularCalidad($numeroInyecciones,$numeroReinyecciones);
				$horasActivas = $datosTiempos[$dia]['HorasActivas'];
				$a_dia = RegistroUsoMaquinaPeer::calcularAprovechamiento($tf_dia, $horasActivas);
				$oee_dia = RegistroUsoMaquinaPeer::calcularEfectividadGlobalEquipo($d_dia, $e_dia, $c_dia);
				$ptee_dia = RegistroUsoMaquinaPeer::calcularProductividadTotalEfectiva($a_dia,$oee_dia);

				$datos[$dia]['D'] = round($d_dia,2);
				$datos[$dia]['E'] = round($e_dia,2);
				$datos[$dia]['C'] = round($c_dia,2);
				$datos[$dia]['A'] = round($a_dia,2);
				$datos[$dia]['OEE'] = round($oee_dia,2);
				$datos[$dia]['PTEE'] = round($ptee_dia,2);
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
		$user = $this->getUser();
		$codigo_usuario = $user->getAttribute('usu_codigo');
		$criteria = new Criteria();
		$criteria->add(EmpleadoPeer::EMPL_USU_CODIGO, $codigo_usuario);
		$operario = EmpleadoPeer::doSelectOne($criteria);
		$criteria = new Criteria();
		$criteria->add(EmpresaPeer::EMP_CODIGO, $operario->getEmplEmpCodigo());
		$empresa = EmpresaPeer::doSelectOne($criteria);

		$inyeccionesEstandarPromedio = $empresa->getEmpInyectEstandarPromedio();

		//$anio='2011';
		//$mes='02';
		$anio=$this->getRequestParameter('anio');
		$mes=$this->getRequestParameter('mes');

		$cant_dias=$this->obtenerCantidadDiasMes($mes,$anio);

		$datos=$this->calcularIndicadoresDiariosMesBarras($anio,$mes,$cant_dias,$cod_equipos,$cod_grupos,$inyeccionesEstandarPromedio);
		$datos_metas=$this->obtenerIndicadoresMetasMesBarras($anio,$mes);
		$indicadores_porcentaje=array(      'D',     'E',     'C',    'A',   'OEE',   'PTEE');
		$indicadores_descripcion=array('Disponibilidad','Eficiencia','Calidad','Aprovechamiento','Efectividad global','PTEE');
		$indicadores_colores=array('ff5454','47d552','f0a05f','ffdc44','72a8cd','b97a57');

		$xml='<?xml version="1.0"?>';
		$xml.='<chart>';

		$xml.='<series>';
		for($ind=0;$ind<6;$ind++)
		{
			//$xml.='<value xid="'.$ind.'" >'.$indicadores_porcentaje[$ind].'</value>';
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
			//$xml.='<value xid="'.$ind.'" color="'.$indicadores_colores[$ind].',ffffff">'.$resultado.'</value>';
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

	public function calcularIndicadoresDiariosMesBarras($anio,$mes,$cant_dias,$cod_equipos,$cod_grupos,$inyeccionesEstandarPromedio)
	{
		$datos;
		$d_mes = 0;
		$e_mes = 0;
		$c_mes = 0;
		$a_mes = 0;
		$oee_mes = 0;
		$ptee_mes = 0;

		try{
			$cant_dias = $this->obtenerCantidadDiasMes($mes,$anio);

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
                        
                        $cantidadMaquinas = MaquinaPeer::doCount($criteria);

			$cantidadDias = RegistroUsoMaquinaPeer::calcularNumeroDiasDelMes($mes, $anio);
			$cantidadHoras = $cantidadDias * $cantidadMaquinas * 24;

			$datosTiempos = $this->calcularTiemposDiariosMesTorta($anio, $mes, 8, $temp, $temp2);

			$tp_mes = $datosTiempos['TP'];
			$tpp_mes = $datosTiempos['TPP'];
			$tnp_mes = $datosTiempos['TNP'];
			$tpnp_mes = $datosTiempos['TPNP'];
			$tf_mes = $datosTiempos['TF'];
			$to_mes = $datosTiempos['TO'];

			$datosInyecciones = $this->calcularInyecciones($anio, $mes, $cant_dias);

			$numeroInyeccionesMes = $datosInyecciones['inyeccionesMes'];
			$numeroReinyeccionesMes = $datosInyecciones['reinyeccionesMes'];

			$d_mes = RegistroUsoMaquinaPeer::calcularDisponibilidad($to_mes, $tf_mes);
			$e_mes = RegistroUsoMaquinaPeer::calcularEficiencia($tp_mes, $to_mes);
			$c_mes = RegistroUsoMaquinaPeer::calcularCalidad($numeroInyeccionesMes, $numeroReinyeccionesMes);
			$cantidadHoras = $datosTiempos['HorasActivas'];
			$a_mes = RegistroUsoMaquinaPeer::calcularAprovechamiento($tf_mes, $cantidadHoras);
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


	public function obtenerIndicadoresMetasMesBarras($anio,$mes)
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
        
        //Cambios: 24 de febrero de 2014
        //La siguiente función retorna un listado de los grupos de equipos activos
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
        //Calcula el consolidado total de tiempos de los indicadores (TP -TPNP - TNO - TO) por mes
        public function executeConsolidadoTiemposMes(sfWebRequest $request)
	{            
            //Códigos de los equipos seleccionados
            $cod_equipos = $this->getRequestParameter('cods_equipos');
            //Códigos de los grupos seleccionados
            $cod_grupos = $this->getRequestParameter('cods_grupos');
            //Fecha de inicio y fin de cada semana
            $user = $this->getUser();
            $codigo_usuario = $user->getAttribute('usu_codigo');
            $criteria1 = new Criteria();
            $criteria1->add(EmpleadoPeer::EMPL_USU_CODIGO, $codigo_usuario);
            $operario = EmpleadoPeer::doSelectOne($criteria1);
            $criteria2 = new Criteria();
            $criteria2->add(EmpresaPeer::EMP_CODIGO, $operario->getEmplEmpCodigo());
            $empresa = EmpresaPeer::doSelectOne($criteria2);

            $inyeccionesEstandarPromedio = $empresa->getEmpInyectEstandarPromedio();

            $anio = $this->getRequestParameter('anio');
            $mes = $this->getRequestParameter('mes');

            $datos_ind = $this->calcularTiemposDiariosMesTorta($anio,$mes,$inyeccionesEstandarPromedio,$cod_equipos, $cod_grupos);                
            $indicadores = array('TPP', 'TNP', 'TPNP', 'TO');
            
            //Se calcula la suma de horas de los cuatro indicadores para el cálculo del porcentaje
            $total_horas = $datos_ind[$indicadores[0]]+$datos_ind[$indicadores[1]]+$datos_ind[$indicadores[2]]+$datos_ind[$indicadores[3]];
            
            $salida = '({"total":"0", "results":""})';
            $fila = 0;
            $datos = array();
            
            for($i=0; $i<sizeof($indicadores); $i++) {
                $datos[$fila]['mes_tiempo'] = $indicadores[$i];
                $datos[$fila]['mes_horas'] = number_format($datos_ind[$indicadores[$i]], 2, ',', '.');
                //Se calcula el porcentaje para cada indicador
                $porcentaje = (($datos_ind[$indicadores[$i]]*100))/$total_horas;
                $datos[$fila]['mes_porcentaje'] = number_format($porcentaje, 2, ',', '.');
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
        public function executeConsolidadoIndicadoresMes(sfWebRequest $request)
	{            
            //Códigos de los equipos seleccionados
            $cod_equipos = $this->getRequestParameter('cods_equipos');
            //Códigos de los grupos seleccionados
            $cod_grupos = $this->getRequestParameter('cods_grupos');
            //Fecha de inicio y fin de cada semana
            $user = $this->getUser();
            $codigo_usuario = $user->getAttribute('usu_codigo');
            $criteria1 = new Criteria();
            $criteria1->add(EmpleadoPeer::EMPL_USU_CODIGO, $codigo_usuario);
            $operario = EmpleadoPeer::doSelectOne($criteria1);
            $criteria2 = new Criteria();
            $criteria2->add(EmpresaPeer::EMP_CODIGO, $operario->getEmplEmpCodigo());
            $empresa = EmpresaPeer::doSelectOne($criteria2);

            $inyeccionesEstandarPromedio = $empresa->getEmpInyectEstandarPromedio();

            $anio = $this->getRequestParameter('anio');
            $mes = $this->getRequestParameter('mes');
            $cant_dias = $this->obtenerCantidadDiasMes($mes,$anio);
            
            $datos_ind = $this->calcularIndicadoresDiariosMesBarras($anio, $mes, $cant_dias, $cod_equipos, $cod_grupos, $inyeccionesEstandarPromedio);
            $datos_metas = $this->obtenerIndicadoresMetasMesBarras($anio);
            $indicadores = array('D', 'E', 'C', 'A', 'OEE', 'PTEE');
            $ind_nombres = array('Disponibilidad', 'Eficiencia', 'Calidad', 'Aprovechamiento', 'OEE', 'PTEE');
            
            $salida = '({"total":"0", "results":""})';
            $fila = 0;
            $datos = array();
            
            for($i=0; $i<sizeof($indicadores); $i++) {
                $datos[$fila]['mes_indicador'] = $ind_nombres[$i];
                $datos[$fila]['mes_actual'] = $datos_ind[$indicadores[$i]];
                $datos[$fila]['mes_meta'] = $datos_metas[$indicadores[$i]];
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
        public function executeConsolidadoPerdidasMes(sfWebRequest $request)
	{
            $user = $this->getUser();
            $codigo_usuario = $user->getAttribute('usu_codigo');
            $criteria1 = new Criteria();
            $criteria1->add(EmpleadoPeer::EMPL_USU_CODIGO, $codigo_usuario);
            $operario = EmpleadoPeer::doSelectOne($criteria1);
            $criteria2 = new Criteria();
            $criteria2->add(EmpresaPeer::EMP_CODIGO, $operario->getEmplEmpCodigo());
            $empresa = EmpresaPeer::doSelectOne($criteria2);

            $inyeccionesEstandarPromedio = $empresa->getEmpInyectEstandarPromedio();

            $anio = $this->getRequestParameter('anio');
            $mes = $this->getRequestParameter('mes');
            
            $datos_ind = $this->calcularPerdidasMes($anio, $mes, $inyeccionesEstandarPromedio);
            $indicadores = array('paros', 'retrabajos', 'perdida_rendimiento');
            $ind_nombres = array('Paros menores', 'Reensayos', 'Pérd. velocidad');
            
            //Se calcula la suma de horas de los tres indicadores para el cálculo del porcentaje
            $total_horas = $datos_ind[$indicadores[0]]+$datos_ind[$indicadores[1]]+$datos_ind[$indicadores[2]];
            
            $salida = '({"total":"0", "results":""})';
            $fila = 0;
            $datos = array();
            
            for($i=0; $i<sizeof($indicadores); $i++) {
                $datos[$fila]['mes_perdida'] = $ind_nombres[$i];
                $datos[$fila]['mes_horas_perd'] = number_format($datos_ind[$indicadores[$i]], 2, ',', '.');                
                $porcentaje = (($datos_ind[$indicadores[$i]]*100))/$total_horas;                
                $datos[$fila]['mes_porcentaje_perd'] = number_format($porcentaje, 2, ',', '.');
                $fila++;
            }
            if($fila>0){
                $jsonresult = json_encode($datos);
                $salida= '({"total":"'.$fila.'","results":'.$jsonresult.'})';
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
                    $datos[$fila]['maq_men_nombre'] = $equipo->getMaqNombre();
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
                    $datos[$fila]['gru_men_nombre'] = $grupo->getGruNombre();
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
        //Reporte de ahorros del mes para el gráfico de dispersión
        public function executeGenerarDatosGraficoAhorros(sfWebRequest $request)
	{
		//$anio='2011';
		//$mes='02';
		$anio=$this->getRequestParameter('anio');
		$mes=$this->getRequestParameter('mes');
		$cant_dias=$this->obtenerCantidadDiasMes($mes,$anio);

		$datos=$this->calcularAhorrosDiariosMes($anio, $mes, $cant_dias);

		$xml='<?xml version="1.0"?>';
		$xml.='<chart>';

		$xml.='<series>';
		for($diasmes=1;$diasmes<$cant_dias;$diasmes++)
		{
                    $xml.='<value xid="'.$diasmes.'">'.$diasmes.'</value>';
		}
		$xml.='</series>';

		$xml.='<graphs>';

		$xml.='<graph color="#5cd65c" title="Ahorros alistamiento" bullet="round" >';
		for($diasmes=1;$diasmes<$cant_dias;$diasmes++){
                    $numero_alistamiento_dia=$datos[$diasmes]['ahorros_alistamiento'];
                    $xml.='<value xid="'.$diasmes.'">'.$numero_alistamiento_dia.'</value>';
		}
		$xml.='</graph>';

		$xml.='<graph color="#33add6" title="Ahorros método" bullet="round" >';
		for($diasmes=1;$diasmes<$cant_dias;$diasmes++){
                    $numero_metodo_dia=$datos[$diasmes]['ahorros_metodo'];
                    $xml.='<value xid="'.$diasmes.'">'.$numero_metodo_dia.'</value>';
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

        //Cambios: 24 de febrero de 2014
        //Calcula los ahorros por alistamiento y por método para cada día del mes
	public function calcularAhorrosDiariosMes($anio, $mes, $cant_dias)
	{
		$datos = array();
		try{
			for($dia=1; $dia<$cant_dias; $dia++) {
                            $ahorros_alistamiento= 0;
                            $ahorros_metodo= 0;

                            $conexion=$this->obtenerConexionDia($anio.'-'.$mes.'-'.$dia);
                            $registro_uso_maquina = RegistroUsoMaquinaPeer::doSelect($conexion);

                            foreach($registro_uso_maquina as $registro)
                            {
                                //Ahorros alistamiento
                                $ahorros_alistamiento += number_format(round($registro -> calcularAhorrosAlistamientoMinutos(), 2), 2);

                                //Ahorros Método
                                //Ahorros en el método cuando la hora ingresada es inferior a la hora en la cual debe finalizar la corrida
                                $maq_tiempo_inyeccion = $registro -> obtenerTiempoInyeccionMaquina();
                                $TF = $registro -> obtenerTFMetodo();
                                $TO = $registro -> obtenerTOMetodo($maq_tiempo_inyeccion);
                                $TPNP = round($registro -> calcularTPNPMinutos(8) / 60, 2);
                                $ahorros_metodo += number_format(round($registro -> calcularAhorrosMetodoMinutos($TF, $TO, $TPNP), 2), 2);

                                //Ahorros en el método cuando se cambia el tiempo de corrida del método
                                $TP = $registro -> obtenerTPMetodo($maq_tiempo_inyeccion);
                                $ahorros_tc = $TP - $TO;
                                //Se tiene en cuenta sólo si la diferencia entre el TP y el TO es positiva
                                if($ahorros_tc > 0) {
                                    //Se pasan los ahorros a minutos
                                    $ahorros_tc *= 60;
                                    $ahorros_metodo += $ahorros_tc;
                                }
                            }
                            $datos[$dia]['ahorros_alistamiento'] = round($ahorros_alistamiento/60, 2);
                            $datos[$dia]['ahorros_metodo'] = round($ahorros_metodo/60, 2);
					
			}
		}catch (Exception $excepcion)
		{
			return "(exeption: 'Excepci&oacute;n en reporte-calcularFallas ',error:'".$excepcion->getMessage()."')";
		}
		return $datos;
	}
        
        //Cambios: 24 de febrero de 2014
        //Reporte de ahorros del mes  para el gráfico de torta
	public function executeGenerarDatosGraficoAhorrosTorta(sfWebRequest $request)
	{
            //$anio='2011';
            //$mes='01';
            $anio=$this->getRequestParameter('anio');
            $mes=$this->getRequestParameter('mes');

            $datos=$this->calcularAhorrosMes($anio, $mes);

            $xml='<?xml version="1.0"?>';
            $xml.='<pie>';
            $xml.='<slice title="Ahorros alistamiento" color="#5cd65c" pull_out="false">'.$datos['ahorros_alistamiento'].'</slice>';
            $xml.='<slice title="Ahorros método" color="#33add6" pull_out="false">'.$datos['ahorros_metodo'].'</slice>';		
            $xml.='</pie>';

            $this->getRequest()->setRequestFormat('xml');
            $response = $this->getResponse();
            $response->setContentType('text/xml');
            $response->setHttpHeader('Content-length', strlen($xml), true);
            return $this->renderText($xml);
	}

        //Cambios: 24 de febrero de 2014
        //Calcula los ahorros por alistamiento y por método para un mes específico
	public function calcularAhorrosMes($anio, $mes)
	{
            $datos = array();
            try {
                $ahorros_alistamiento = 0;
                $ahorros_metodo = 0;

                $conexion = $this->obtenerConexionMes($anio,$mes);
                $registro_uso_maquina = RegistroUsoMaquinaPeer::doSelect($conexion);

                foreach($registro_uso_maquina as $registro)
                {      
                    //Ahorros alistamiento
                    $ahorros_alistamiento += number_format(round($registro -> calcularAhorrosAlistamientoMinutos(), 2), 2);

                    //Ahorros Método
                    //Ahorros en el método cuando la hora ingresada es inferior a la hora en la cual debe finalizar la corrida
                    $maq_tiempo_inyeccion = $registro -> obtenerTiempoInyeccionMaquina();
                    $TF = $registro -> obtenerTFMetodo();
                    $TO = $registro -> obtenerTOMetodo($maq_tiempo_inyeccion);
                    $TPNP = round($registro -> calcularTPNPMinutos(8) / 60, 2);
                    $ahorros_metodo += number_format(round($registro -> calcularAhorrosMetodoMinutos($TF, $TO, $TPNP), 2), 2);
                    
                    //Ahorros en el método cuando se cambia el tiempo de corrida del método
                    $TP = $registro -> obtenerTPMetodo($maq_tiempo_inyeccion);
                    $ahorros_tc = $TP - $TO;
                    //Se tiene en cuenta sólo si la diferencia entre el TP y el TO es positiva
                    if($ahorros_tc > 0) {
                        //Se pasan los ahorros a minutos
                        $ahorros_tc *= 60;
                        $ahorros_metodo += $ahorros_tc;
                    }
                }
                $datos['ahorros_alistamiento']=round(($ahorros_alistamiento/60),2);
                $datos['ahorros_metodo']=round($ahorros_metodo/60,2);
            }catch (Exception $excepcion)
            {
                return "(exeption: 'Excepci&oacute;n en reporte-calcularAhorrosMes ',error:'".$excepcion->getMessage()."')";
            }
            return $datos;
	}        
        
        //Cambios: 24 de febrero de 2014
        //Calcula el consolidado total por indicador (A. alistamiento - A. método)
	public function executeConsolidadoAhorrosMes(sfWebRequest $request)
	{
            //$anio='2011';
            //$mes='01';
            $anio = $this->getRequestParameter('anio');
            $mes = $this->getRequestParameter('mes');

            $datos_ind = $this->calcularAhorrosMes($anio, $mes);

            $indicadores = array('ahorros_alistamiento', 'ahorros_metodo');
            $ind_nombres = array('Alistamiento', 'Método');
            
            //Se calcula la suma de horas de los dos indicadores para el cálculo del porcentaje
            $total_horas = $datos_ind[$indicadores[0]]+$datos_ind[$indicadores[1]];
            
            $salida = '({"total":"0", "results":""})';
            $fila = 0;
            $datos = array();
            
            for($i=0; $i<sizeof($indicadores); $i++) {
                $datos[$fila]['mes_ahorro'] = $ind_nombres[$i];
                $datos[$fila]['mes_horas_ahorro'] = number_format($datos_ind[$indicadores[$i]], 2, ',', '.');                
                $porcentaje = (($datos_ind[$indicadores[$i]]*100))/$total_horas;
                $datos[$fila]['mes_porcentaje_ahorro'] = number_format($porcentaje, 2, ',', '.');
                $fila++;
            }
            if($fila>0){
                $jsonresult = json_encode($datos);
                $salida= '({"total":"'.$fila.'","results":'.$jsonresult.'})';
            }
            
            return $this->renderText($salida); 
	}
}
