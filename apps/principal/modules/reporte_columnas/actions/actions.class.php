<?php

/**
 * reporte_columnas actions.
 *
 * @package    tpmlabs
 * @subpackage reporte_columnas
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class reporte_columnasActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
//    $this->forward('default', 'module');
  }
  
      public function obtenerConexion(){

		$desde_fecha=$this->getRequestParameter('desde_fecha');
		$hasta_fecha=$this->getRequestParameter('hasta_fecha');
		$analista_codigo=$this->getRequestParameter('analista_codigo');

		$conexion = new Criteria();
		if($desde_fecha!='') {
                    $conexion->add(RegistroUsoMaquinaPeer::RUM_FECHA,$desde_fecha,CRITERIA::GREATER_EQUAL);
                }
		if($hasta_fecha!='') {
			if($desde_fecha!='') {
                            $conexion->addAnd(RegistroUsoMaquinaPeer::RUM_FECHA,$hasta_fecha,CRITERIA::LESS_EQUAL);
                        }
			else {
                            $conexion->add(RegistroUsoMaquinaPeer::RUM_FECHA,$hasta_fecha,CRITERIA::LESS_EQUAL);
                        }
		}
                              
                //Codigos de los equipos seleccionados
                $temp = $this->getRequestParameter('cods_equipos');
                $cods_equipos = json_decode($temp);
                if($cods_equipos != ''){
                    foreach ($cods_equipos as $cod_equipo) {
                        $conexion -> addOr(RegistroUsoMaquinaPeer::RUM_MAQ_CODIGO, $cod_equipo, CRITERIA::EQUAL);
                    }
                } 
                
		if($analista_codigo!='') {
                    $conexion->add(RegistroUsoMaquinaPeer::RUM_USU_CODIGO,$analista_codigo,CRITERIA::EQUAL);
                }

		$conexion->add(RegistroUsoMaquinaPeer::RUM_ELIMINADO, false);
                
		return $conexion;
	}

	/**
	 *@author:maryit sanchez
	 *@date:21 de enero de 2010
	 *Esta funcion retorna un listado de los eventos por indicador
	 */
	public function executeListarReporteColumnasUtilizadas(sfWebRequest $request)
	{
		$salida = '({"total":"0", "results":""})';
		$fila = 0;
		$datos = array();

		try{
			$conexion = $this->obtenerConexion();
			$datos_columnas = RegistroUsoMaquinaPeer::doSelect($conexion);

			foreach($datos_columnas as $temporal)
			{
                                $datos[$fila]['rum_col_maquina'] = $temporal->obtenerMaquina();
                                $datos[$fila]['rum_col_analista'] = $temporal->obtenerAnalista();
                                $datos[$fila]['rum_col_fecha'] = $temporal->getRumFecha();				

				$col_codigo = $temporal -> getRumColCodigo();
				$columna  = ColumnaPeer::retrieveByPk($col_codigo);
				if($columna){
					$datos[$fila]['rum_col_nombre'] = $columna->getColConsecutivo();
				}

				$datos[$fila]['rum_col_platos_teoricos'] = number_format($temporal->getRumPlatosTeoricos(), 2, '.', '');
				$datos[$fila]['rum_col_tiempo_retencion'] = number_format($temporal->getRumTiempoRetencion(), 2, '.', '');
				$datos[$fila]['rum_col_resolucion'] = number_format($temporal->getRumResolucion(), 2, '.', '');
				$datos[$fila]['rum_col_tailing'] = number_format($temporal->getRumTailing(), 2, '.', '');
                                
				$fila++;
			}

			if($fila>0){
				$jsonresult = json_encode($datos);
				$salida= '({"total":"'.$fila.'","results":'.$jsonresult.'})';
			}
		}
		catch (Exception $excepcion)
		{
			return "({success: false, errors: { reason: 'Excepci&oacute;n  en registro columnas utilizadas ',error:'".$excepcion->getMessage()."'}})";
		}
		return $this->renderText($salida);
	}

	public function executeGenerarDatosOcurrenciaEventosBarra(sfWebRequest $request)
	{
		$criteria = new Criteria();
		$criteria->addJoin(EventoPeer::EVE_CODIGO, EventoEnRegistroPeer::EVRG_EVE_CODIGO);
		$criteria->addJoin(EventoEnRegistroPeer::EVRG_RUM_CODIGO, RegistroUsoMaquinaPeer::RUM_CODIGO);
		$criteria->clearSelectColumns();
		$criteria->addSelectColumn(EventoPeer::EVE_NOMBRE);
		$criteria->addSelectColumn('COUNT(*)');
		$criteria->addGroupByColumn(EventoPeer::EVE_CODIGO);
		$criteria->addDescendingOrderByColumn('COUNT(*)');
		$criteria->add(RegistroUsoMaquinaPeer::RUM_ELIMINADO, false);

		if($request->getParameter('desde_fecha')!='') {
			$criteria->add(RegistroUsoMaquinaPeer::RUM_FECHA, $request->getParameter('desde_fecha'), Criteria::GREATER_EQUAL);
		}

		if($request->getParameter('hasta_fecha')!='') {
			$criteria->addAnd(RegistroUsoMaquinaPeer::RUM_FECHA, $request->getParameter('hasta_fecha'), Criteria::LESS_EQUAL);
		}

		if($request->getParameter('analista_codigo')!='') {
			$criteria->add(RegistroUsoMaquinaPeer::RUM_USU_CODIGO, $request->getParameter('analista_codigo'));
		}

		//Codigos de los equipos seleccionados
                $temp = $this->getRequestParameter('cods_equipos');
                $cods_equipos = json_decode($temp);
                if($cods_equipos != ''){
                    foreach ($cods_equipos as $cod_equipo) {
                        $criteria -> addOr(RegistroUsoMaquinaPeer::RUM_MAQ_CODIGO, $cod_equipo);
                    }
                }

		$statement = EventoPeer::doSelectStmt($criteria);
		$eventos = $statement->fetchAll(PDO::FETCH_NUM);

		$xml='<?xml version="1.0"?>';
		$xml.='<chart>';

		$colores = array();
		$colores[] = 'FF6600';
		$colores[] = 'FCD202';
		$colores[] = 'B0DE09';
		$colores[] = '0D8ECF';
		$colores[] = '2A0CD0';
		$colores[] = 'CD0D74';
		$colores[] = 'CC0000';
		$colores[] = '00CC00';
		$colores[] = '0000CC';

		$cantidadColores = count($colores);

		$xmlSeries = '<series>';
		$xmlGraphs = '<graphs><graph  title="Cantidad total de eventos ">';

		$i = 0;
		foreach($eventos as $evento) {
                        //Valor del eje X
			$xmlSeries .= '<value xid="'.$i.'" >'.$evento[0].' : '.$evento[1].' (veces)</value>';                        
			$xmlGraphs .= '<value xid="'.$i.'" color="'.$colores[($i%$cantidadColores)].'">'.$evento[1].'</value>';
			$i++;
		}

		$xmlSeries .= '</series>';
		$xmlGraphs .= '</graph></graphs>';

		$xml .= $xmlSeries;
		$xml .= $xmlGraphs;
		$xml .= '</chart>';

		return $this->renderText($xml);
	}

	public function executeGenerarDatosOcurrenciaEventosTiempo(sfWebRequest $request)
	{
		$criteria = new Criteria();
		$criteria->addJoin(EventoPeer::EVE_CODIGO, EventoEnRegistroPeer::EVRG_EVE_CODIGO);
		$criteria->addJoin(EventoEnRegistroPeer::EVRG_RUM_CODIGO, RegistroUsoMaquinaPeer::RUM_CODIGO);
		$criteria->clearSelectColumns();
		$criteria->addSelectColumn(EventoPeer::EVE_NOMBRE);
		$criteria->addSelectColumn('SUM('.EventoEnRegistroPeer::EVRG_DURACION.')');
		$criteria->addGroupByColumn(EventoPeer::EVE_CODIGO);
		$criteria->addDescendingOrderByColumn('SUM('.EventoEnRegistroPeer::EVRG_DURACION.')');
		$criteria->add(RegistroUsoMaquinaPeer::RUM_ELIMINADO, false);

		if($request->getParameter('desde_fecha')!='') {
			$criteria->add(RegistroUsoMaquinaPeer::RUM_FECHA, $request->getParameter('desde_fecha'), Criteria::GREATER_EQUAL);
		}

		if($request->getParameter('hasta_fecha')!='') {
			$criteria->addAnd(RegistroUsoMaquinaPeer::RUM_FECHA, $request->getParameter('hasta_fecha'), Criteria::LESS_EQUAL);
		}

		if($request->getParameter('analista_codigo')!='') {
			$criteria->add(RegistroUsoMaquinaPeer::RUM_USU_CODIGO, $request->getParameter('analista_codigo'));
		}

		//Codigos de los equipos seleccionados
                $temp = $this->getRequestParameter('cods_equipos');
                $cods_equipos = json_decode($temp);
                if($cods_equipos != ''){
                    foreach ($cods_equipos as $cod_equipo) {
                        $criteria -> addOr(RegistroUsoMaquinaPeer::RUM_MAQ_CODIGO, $cod_equipo, CRITERIA::EQUAL);
                    }
                }

		$statement = EventoPeer::doSelectStmt($criteria);
		$eventos = $statement->fetchAll(PDO::FETCH_NUM);

		$xml='<?xml version="1.0"?>';
		$xml.='<chart>';

		$colores = array();
		$colores[] = 'FF6600';
		$colores[] = 'FCD202';
		$colores[] = 'B0DE09';
		$colores[] = '0D8ECF';
		$colores[] = '2A0CD0';
		$colores[] = 'CD0D74';
		$colores[] = 'CC0000';
		$colores[] = '00CC00';
		$colores[] = '0000CC';

		$cantidadColores = count($colores);

		$xmlSeries = '<series>';
		$xmlGraphs = '<graphs><graph  title="Tiempo total de eventos ">';

		$i = 0;
		foreach($eventos as $evento) {
                        //Valor del eje x                    
			$xmlSeries .= '<value xid="'.$i.'" >'.$evento[0].' : '.((int)$evento[1]).' (minutos)</value>';
			$xmlGraphs .= '<value xid="'.$i.'" color="'.$colores[($i%$cantidadColores)].'">'.$evento[1].'</value>';
			$i++;
		}

		$xmlSeries .= '</series>';
		$xmlGraphs .= '</graph></graphs>';

		$xml .= $xmlSeries;
		$xml .= $xmlGraphs;
		$xml .= '</chart>';

		return $this->renderText($xml);
	}


	/**
	 *@author:maryit sanchez
	 *@date:21 de enero de 2010
	 *Esta funcion retorna  arreglo con los datos totales de ocurrencias por evento
	 */
	public function obtenerDatosTotalEventos()
	{
		$fila=0;
		$datos;

		try{

			$conexion_eventoenregistro=$this->obtenerConexion();

			$conexion = new Criteria();
			$eventos = EventoPeer::doSelect($conexion);

			foreach($eventos as $evento){

				$conexion_evento=$conexion_eventoenregistro;
				$conexion_eventoenregistro->add(EventoEnRegistroPeer::EVRG_EVE_CODIGO,$evento->getEveCodigo());
				$conexion_eventoenregistro->setDistinct();
				$cant_eventoenregistro = EventoEnRegistroPeer::doCount($conexion_evento);

				$datos[$fila]['codigo']=$evento->getEveCodigo();
				$datos[$fila]['nombre']=$evento->getEveNombre();                                
				$datos[$fila]['ocurrecias']=$cant_eventoenregistro;
				$fila++;
			}
		}
		catch (Exception $excepcion)
		{
			return "({success: false, errors: { reason: 'Excepci&oacute;n  en registro de eventos ocurridos ',error:'".$excepcion->getMessage()."'}})";
		}
		return $datos;
	}

	/**
	 *@author:maryit sanchez
	 *@date:22 de marzo de 2011
	 *Esta funcion retorna arreglo con los datos totales de tiempos por tipos de eventos
	 */
	public function obtenerDatosTotalMinutosPorEvento()
	{
		$fila=0;
		$datos = array();

		try{
			$desde_fecha=$this->getRequestParameter('desde_fecha');
			$hasta_fecha=$this->getRequestParameter('hasta_fecha');
			$analista_codigo=$this->getRequestParameter('analista_codigo');

			$consulta="SELECT evrg_eve_codigo, ";
			$consulta.=" sum(evrg_duracion) ";
			$consulta.=" FROM evento_en_registro , registro_uso_maquina ";

			$consulta.=" WHERE evrg_rum_codigo=rum_codigo ";

			if($desde_fecha!=''){$consulta.=" and rum_fecha>='".$desde_fecha."' "; }
			if($hasta_fecha!=''){$consulta.=" and rum_fecha<='".$hasta_fecha."' "; }
                        
                        //Codigos de los equipos seleccionados
                        $temp = $this->getRequestParameter('cods_equipos');
                        $cods_equipos = json_decode($temp);
                        if($cods_equipos != ''){
                            foreach ($cods_equipos as $cod_equipo) {                                
                                $consulta.=" or rum_maq_codigo='".$cod_equipo."' ";
                            }
                        }                        
			if($analista_codigo!=''){$consulta.=" and rum_usu_codigo='".$analista_codigo."' ";}
			if($hasta_fecha!=''){$consulta.=" and rum_eliminado=false"; }
			if($hasta_fecha!=''){$consulta.=" group by (evrg_eve_codigo) "; }

			$con = Propel::getConnection();
			$stmt = $con->prepare($consulta);
			$stmt->execute();
			while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
					
				$datos[$fila]['evento'] = $row[0];//evento codigo
				$datos[$fila]['cantidad'] = $row[1];//cantidad minutos
				//echo($row[0].'-'.$row[1]);
				$fila++;
			}

		}
		catch (Exception $excepcion)
		{
			return "({success: false, errors: { reason: 'Excepci&oacute;n en reporte de eventos tiempo vs evento ',error:'".$excepcion->getMessage()."'}})";
		}
		return $datos;
	}



	/**
	 *@author:maryit sanchez
	 *@date:6 de enero de 2011
	 *Esta funcion retorna  un listado de los analistas
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
		return $this->renderText($salida);	}

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
}
