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
	 *Esta funcion exporta en formato excel un listado con información de las columnas utilizadas
	*/
        public function executeExportar(sfWebRequest $request) {
                // Send Header
		header("Pragma: public");
		header("Expires: 0");
		header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
		header("Content-Type: application/force-download");
		header("Content-Type: application/octet-stream");
		header("Content-Type: application/download");
		header("Content-Disposition: attachment;filename=datos.xls ");
		header("Content-Transfer-Encoding: binary ");
                
                $conexion = $this->obtenerConexion();
                $registros = RegistroUsoMaquinaPeer::doSelect($conexion);
                
                $this->renderText('<?xml version="1.0"?>
            <?mso-application progid="Excel.Sheet"?>
            <Workbook xmlns="urn:schemas-microsoft-com:office:spreadsheet"
             xmlns:o="urn:schemas-microsoft-com:office:office"
             xmlns:x="urn:schemas-microsoft-com:office:excel"
             xmlns:ss="urn:schemas-microsoft-com:office:spreadsheet"
             xmlns:html="http://www.w3.org/TR/REC-html40">
             <DocumentProperties xmlns="urn:schemas-microsoft-com:office:office">
              <Created>2006-09-16T00:00:00Z</Created>
              <LastSaved>2011-02-01T00:11:48Z</LastSaved>
              <Version>14.00</Version>
             </DocumentProperties>
             <OfficeDocumentSettings xmlns="urn:schemas-microsoft-com:office:office">
              <AllowPNG/>
              <RemovePersonalInformation/>
             </OfficeDocumentSettings>
             <ExcelWorkbook xmlns="urn:schemas-microsoft-com:office:excel">
              <WindowHeight>8010</WindowHeight>
              <WindowWidth>14805</WindowWidth>
              <WindowTopX>240</WindowTopX>
              <WindowTopY>105</WindowTopY>
              <ProtectStructure>False</ProtectStructure>
              <ProtectWindows>False</ProtectWindows>
             </ExcelWorkbook>
             <Styles>
              <Style ss:ID="Default" ss:Name="Normal">
               <Alignment ss:Vertical="Bottom"/>
               <Borders/>
               <Font ss:FontName="Calibri" x:Family="Swiss" ss:Size="8" ss:Color="#000000"/>
               <Interior/>
               <NumberFormat/>
               <Protection/>
              </Style>
              <Style ss:ID="s62">
               <NumberFormat ss:Format="Fixed"/>
              </Style>
              <Style ss:ID="s65">
               <Alignment ss:Horizontal="Center"/>
               <Interior ss:Color="#FFDF4C" ss:Pattern="Solid"/>
              </Style>
              <Style ss:ID="s64">
               <Alignment ss:Horizontal="Left"/>
               <Interior ss:Color="#DDD9C4" ss:Pattern="Solid"/>
              </Style>
              <Style ss:ID="s66">
               <Interior ss:Color="#4CD774" ss:Pattern="Solid"/>
               <NumberFormat ss:Format="Fixed"/>
              </Style>
              <Style ss:ID="s68">
               <Interior ss:Color="#71A7CD" ss:Pattern="Solid"/>
               <NumberFormat ss:Format="Fixed"/>
              </Style>
              <Style ss:ID="s70">
               <Interior ss:Color="#4F81BD" ss:Pattern="Solid"/>
              </Style>
              <Style ss:ID="s69">
               <Interior ss:Color="#FF4C4C" ss:Pattern="Solid"/>
               <NumberFormat ss:Format="Fixed"/>
              </Style>
              <Style ss:ID="s71">
               <Interior ss:Color="#FF4C4C" ss:Pattern="Solid"/>
              </Style>
              <Style ss:ID="s72">
               <Interior ss:Color="#71A7CD" ss:Pattern="Solid"/>
              </Style>
              <Style ss:ID="s73">
               <Alignment ss:Horizontal="Center" ss:Vertical="Center" ss:WrapText="1"/>
               <Font ss:FontName="Calibri" x:Family="Swiss" ss:Size="8" ss:Color="#000000"
                ss:Bold="1"/>
               <Interior ss:Color="#4F81BD" ss:Pattern="Solid"/>
              </Style>
              <Style ss:ID="s74">
               <Alignment ss:Horizontal="Center"/>
               <Interior ss:Color="#f0a05f" ss:Pattern="Solid"/>
              </Style>
             </Styles>
             <Worksheet ss:Name="Hoja1"> 
              <Table ss:ExpandedColumnCount="38" ss:ExpandedRowCount="'.((count($registros)*2)+1).'" x:FullColumns="1"
               x:FullRows="1" ss:DefaultRowHeight="15">');
                $this->renderText('
                <Column ss:AutoFitWidth="0" ss:Width="100"/>
                <Column ss:AutoFitWidth="0" ss:Width="120"/>
                <Column ss:AutoFitWidth="0" ss:Width="70"/>
                <Column ss:AutoFitWidth="0" ss:Width="130"/>
                <Column ss:AutoFitWidth="0" ss:Width="90"/>
                <Column ss:AutoFitWidth="0" ss:Width="100"/>
                <Column ss:AutoFitWidth="0" ss:Width="90"/>
                <Column ss:AutoFitWidth="0" ss:Width="90"/>
                <Row ss:AutoFitHeight="0" ss:Height="40">
                <Cell ss:StyleID="s73"><Data ss:Type="String">Máquina</Data></Cell>
                <Cell ss:StyleID="s73"><Data ss:Type="String">Analista</Data></Cell>
                <Cell ss:StyleID="s73"><Data ss:Type="String">Fecha</Data></Cell>
                <Cell ss:StyleID="s73"><Data ss:Type="String">Columna</Data></Cell>
                <Cell ss:StyleID="s73"><Data ss:Type="String">Platos Teóricos (N)</Data></Cell>
                <Cell ss:StyleID="s73"><Data ss:Type="String">Tiempo de Retención (min)</Data></Cell>
                <Cell ss:StyleID="s73"><Data ss:Type="String">Resolución (R)</Data></Cell>
                <Cell ss:StyleID="s73"><Data ss:Type="String">Tailing (T)</Data></Cell>
               </Row>');
                
                foreach($registros as $registro) {
                        $col_codigo = $registro -> getRumColCodigo();
                        $columna  = ColumnaPeer::retrieveByPk($col_codigo);
                        
			$this->renderText('<Row>			
			<Cell ss:StyleID="s64"><Data ss:Type="String">'.$registro->obtenerMaquina().'</Data></Cell>
                        <Cell ss:StyleID="s64"><Data ss:Type="String">'.$registro->obtenerAnalista().'</Data></Cell>
                        <Cell ss:StyleID="s64"><Data ss:Type="String">'.$registro->getRumFecha('d-m-Y').'</Data></Cell>
			<Cell ss:StyleID="s64"><Data ss:Type="String">'.$columna->getColConsecutivo().' - '.$columna->getColMarca().'</Data></Cell>
			<Cell ss:StyleID="s64"><Data ss:Type="String">'.number_format($registro->getRumPlatosTeoricos(), 2, '.', '').'</Data></Cell>
			<Cell ss:StyleID="s64"><Data ss:Type="String">'.number_format($registro->getRumTiempoRetencion(), 2, '.', '').'</Data></Cell>
			<Cell ss:StyleID="s64"><Data ss:Type="String">'.number_format($registro->getRumResolucion(), 2, '.', '').'</Data></Cell>
			<Cell ss:StyleID="s64"><Data ss:Type="String">'.number_format($registro->getRumTailing(), 2, '.', '').'</Data></Cell>			
			</Row>');			
		}
                
                $this->renderText('</Table>
			<WorksheetOptions xmlns="urn:schemas-microsoft-com:office:excel">
			<PageSetup>
			<Header x:Margin="0.3"/>
			<Footer x:Margin="0.3"/>
			<PageMargins x:Bottom="0.75" x:Left="0.7" x:Right="0.7" x:Top="0.75"/>
			</PageSetup>
			<Selected/>
			<Panes>
			<Pane>
			<Number>3</Number>
			<ActiveRow>3</ActiveRow>
			<ActiveCol>5</ActiveCol>
			</Pane>
			</Panes>
			<ProtectObjects>False</ProtectObjects>
			<ProtectScenarios>False</ProtectScenarios>
			</WorksheetOptions>
			</Worksheet>
			<Worksheet ss:Name="Hoja2">
			<Table ss:ExpandedColumnCount="1" ss:ExpandedRowCount="1" x:FullColumns="1"
			x:FullRows="1" ss:DefaultRowHeight="15">
			</Table>
			<WorksheetOptions xmlns="urn:schemas-microsoft-com:office:excel">
			<PageSetup>
			<Header x:Margin="0.3"/>
			<Footer x:Margin="0.3"/>
			<PageMargins x:Bottom="0.75" x:Left="0.7" x:Right="0.7" x:Top="0.75"/>
			</PageSetup>
			<ProtectObjects>False</ProtectObjects>
			<ProtectScenarios>False</ProtectScenarios>
			</WorksheetOptions>
			</Worksheet>
			<Worksheet ss:Name="Hoja3">
			<Table ss:ExpandedColumnCount="1" ss:ExpandedRowCount="1" x:FullColumns="1"
			x:FullRows="1" ss:DefaultRowHeight="15">
			</Table>
			<WorksheetOptions xmlns="urn:schemas-microsoft-com:office:excel">
			<PageSetup>
			<Header x:Margin="0.3"/>
			<Footer x:Margin="0.3"/>
			<PageMargins x:Bottom="0.75" x:Left="0.7" x:Right="0.7" x:Top="0.75"/>
			</PageSetup>
			<ProtectObjects>False</ProtectObjects>
			<ProtectScenarios>False</ProtectScenarios>
			</WorksheetOptions>
			</Worksheet>
			</Workbook>
                ');

		return $this->renderText('');
        }
        

	/**
	 *Esta funcion retorna un listado con información de las columnas utilizadas
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
					$datos[$fila]['rum_col_nombre'] = $columna->getColConsecutivo().' - '.$columna->getColMarca();
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
