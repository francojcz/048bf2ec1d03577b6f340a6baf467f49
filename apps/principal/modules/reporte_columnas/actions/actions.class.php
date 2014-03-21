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
		$desde_fecha = $this->getRequestParameter('desde_fecha');
		$hasta_fecha = $this->getRequestParameter('hasta_fecha');
		$analista_codigo=$this->getRequestParameter('analista_codigo');

		$conexion = new Criteria();
                if($desde_fecha=='' && $hasta_fecha=='') {
                    $fecha_actual = date("Y-m-d");
                    $conexion->add(RegistroUsoMaquinaPeer::RUM_FECHA,$fecha_actual);
                }
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

        //Grafico Platos Teóricos
	public function executeGenerarDatosPlatosTeoricos(sfWebRequest $request)
	{
            $desde_fecha = $this->getRequestParameter('desde_fecha');
            $hasta_fecha = $this->getRequestParameter('hasta_fecha');
            $fechas = array();
            $fechas[] = $this->mes($desde_fecha);
            
            while($desde_fecha < $hasta_fecha) {
                $desde_fecha = date('Y-m-d',strtotime('+1 day', strtotime($desde_fecha)));
                $fechas[] = $this->mes($desde_fecha);
            }
                
            $indicador = array('Platos Teóricos');
            $colores = array('47d552');

            $xml = '<?xml version="1.0"?>';
            $xml .= '<chart>';
            $xml .= '<series>';
            for($dias = 0; $dias < sizeof($fechas); $dias++) {
                $xml .= '<value xid="'.$fechas[$dias].'">'.$fechas[$dias].'</value>';
            }
            $xml .= '</series>';
            $xml .= '<graphs>';
            for($ind = 0; $ind < sizeof($indicador); $ind++) {
                $xml .= '<graph color="#'.$colores[$ind].'" title="'.$indicador[$ind].'" bullet="round">';
                for($dias = 0; $dias < sizeof($fechas); $dias++) {
                    $cantidad = 50;
                    $xml .= '<value xid="'.$fechas[$dias].'">'.round($cantidad, 2).'</value>';
                }
                $xml.='</graph>';
            }
            $xml.='</graphs>';
            $xml.='</chart>';

            return $this->renderText($xml);
	}
        
        //Grafico Tiempo de Retención
	public function executeGenerarDatosTiempoRetencion(sfWebRequest $request)
	{
            $desde_fecha = $this->getRequestParameter('desde_fecha');
            $hasta_fecha = $this->getRequestParameter('hasta_fecha');
            $fechas = array();
            $fechas[] = $this->mes($desde_fecha);
            
            while($desde_fecha < $hasta_fecha) {
                $desde_fecha = date('Y-m-d',strtotime('+1 day', strtotime($desde_fecha)));
                $fechas[] = $this->mes($desde_fecha);
            }
                
            $indicador = array('Tiempo de Retención');
            $colores = array('ff5454');

            $xml = '<?xml version="1.0"?>';
            $xml .= '<chart>';
            $xml .= '<series>';
            for($dias = 0; $dias < sizeof($fechas); $dias++) {
                $xml .= '<value xid="'.$fechas[$dias].'">'.$fechas[$dias].'</value>';
            }
            $xml .= '</series>';
            $xml .= '<graphs>';
            for($ind = 0; $ind < sizeof($indicador); $ind++) {
                $xml .= '<graph color="#'.$colores[$ind].'" title="'.$indicador[$ind].'" bullet="round">';
                for($dias = 0; $dias < sizeof($fechas); $dias++) {
                    $cantidad = 50;
                    $xml .= '<value xid="'.$fechas[$dias].'">'.round($cantidad, 2).'</value>';
                }
                $xml.='</graph>';
            }
            $xml.='</graphs>';
            $xml.='</chart>';

            return $this->renderText($xml);
	}
        
        //Grafico Resolución
	public function executeGenerarDatosResolucion(sfWebRequest $request)
	{
            $desde_fecha = $this->getRequestParameter('desde_fecha');
            $hasta_fecha = $this->getRequestParameter('hasta_fecha');
            $fechas = array();
            $fechas[] = $this->mes($desde_fecha);
            
            while($desde_fecha < $hasta_fecha) {
                $desde_fecha = date('Y-m-d',strtotime('+1 day', strtotime($desde_fecha)));
                $fechas[] = $this->mes($desde_fecha);
            }
                
            $indicador = array('Resolución');
            $colores = array('ffdc44');

            $xml = '<?xml version="1.0"?>';
            $xml .= '<chart>';
            $xml .= '<series>';
            for($dias = 0; $dias < sizeof($fechas); $dias++) {
                $xml .= '<value xid="'.$fechas[$dias].'">'.$fechas[$dias].'</value>';
            }
            $xml .= '</series>';
            $xml .= '<graphs>';
            for($ind = 0; $ind < sizeof($indicador); $ind++) {
                $xml .= '<graph color="#'.$colores[$ind].'" title="'.$indicador[$ind].'" bullet="round">';
                for($dias = 0; $dias < sizeof($fechas); $dias++) {
                    $cantidad = 50;
                    $xml .= '<value xid="'.$fechas[$dias].'">'.round($cantidad, 2).'</value>';
                }
                $xml.='</graph>';
            }
            $xml.='</graphs>';
            $xml.='</chart>';

            return $this->renderText($xml);
	}
        
        //Grafico Tailing
	public function executeGenerarDatosTailing(sfWebRequest $request)
	{
            $desde_fecha = $this->getRequestParameter('desde_fecha');
            $hasta_fecha = $this->getRequestParameter('hasta_fecha');
            $fechas = array();
            $fechas[] = $this->mes($desde_fecha);
            
            while($desde_fecha < $hasta_fecha) {
                $desde_fecha = date('Y-m-d',strtotime('+1 day', strtotime($desde_fecha)));
                $fechas[] = $this->mes($desde_fecha);
            }
                
            $indicador = array('Tailing');
            $colores = array('72a8cd');

            $xml = '<?xml version="1.0"?>';
            $xml .= '<chart>';
            $xml .= '<series>';
            for($dias = 0; $dias < sizeof($fechas); $dias++) {
                $xml .= '<value xid="'.$fechas[$dias].'">'.$fechas[$dias].'</value>';
            }
            $xml .= '</series>';
            $xml .= '<graphs>';
            for($ind = 0; $ind < sizeof($indicador); $ind++) {
                $xml .= '<graph color="#'.$colores[$ind].'" title="'.$indicador[$ind].'" bullet="round">';
                for($dias = 0; $dias < sizeof($fechas); $dias++) {
                    $cantidad = 50;
                    $xml .= '<value xid="'.$fechas[$dias].'">'.round($cantidad, 2).'</value>';
                }
                $xml.='</graph>';
            }
            $xml.='</graphs>';
            $xml.='</chart>';

            return $this->renderText($xml);
	}

	/**
	 *Esta funcion retorna un listado de los analistas
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

        /**
	 *Esta funcion retorna un listado con los equipos activos
	*/
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
}
