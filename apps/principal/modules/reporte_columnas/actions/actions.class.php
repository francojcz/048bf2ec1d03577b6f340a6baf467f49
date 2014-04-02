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
		$metodo_codigo=$this->getRequestParameter('metodo_codigo');

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
                
		if($metodo_codigo!='') {
                    $conexion->add(RegistroUsoMaquinaPeer::RUM_MET_CODIGO,$metodo_codigo,CRITERIA::EQUAL);
                }

		$conexion->add(RegistroUsoMaquinaPeer::RUM_ELIMINADO, false);
                
		return $conexion;
	}        
        
        /**
	 * Esta funcion exporta en formato excel un listado con información de las columnas utilizadas
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
                <Column ss:AutoFitWidth="0" ss:Width="70"/>
                <Column ss:AutoFitWidth="0" ss:Width="130"/>
                <Column ss:AutoFitWidth="0" ss:Width="90"/>
                <Column ss:AutoFitWidth="0" ss:Width="100"/>
                <Column ss:AutoFitWidth="0" ss:Width="90"/>
                <Column ss:AutoFitWidth="0" ss:Width="90"/>
                <Column ss:AutoFitWidth="0" ss:Width="100"/>
                <Column ss:AutoFitWidth="0" ss:Width="140"/>
                <Row ss:AutoFitHeight="0" ss:Height="40">                
                <Cell ss:StyleID="s73"><Data ss:Type="String">Fecha</Data></Cell>
                <Cell ss:StyleID="s73"><Data ss:Type="String">Cód. Interno Columna</Data></Cell>
                <Cell ss:StyleID="s73"><Data ss:Type="String">Platos Teóricos (N)</Data></Cell>
                <Cell ss:StyleID="s73"><Data ss:Type="String">Tiempo de Retención (min)</Data></Cell>
                <Cell ss:StyleID="s73"><Data ss:Type="String">Resolución (R)</Data></Cell>
                <Cell ss:StyleID="s73"><Data ss:Type="String">Tailing (T)</Data></Cell>
                <Cell ss:StyleID="s73"><Data ss:Type="String">Equipo</Data></Cell>
                <Cell ss:StyleID="s73"><Data ss:Type="String">Método</Data></Cell>
               </Row>');
                
                foreach($registros as $registro) {
                        $col_codigo = $registro -> getRumColCodigo();
                        $columna  = ColumnaPeer::retrieveByPk($col_codigo);
                        
			$this->renderText('<Row>			
                        <Cell ss:StyleID="s64"><Data ss:Type="String">'.$registro->getRumFecha('d-m-Y').'</Data></Cell>
			<Cell ss:StyleID="s64"><Data ss:Type="String">'.$columna->getColConsecutivo().'</Data></Cell>
			<Cell ss:StyleID="s64"><Data ss:Type="String">'.number_format($registro->getRumPlatosTeoricos(), 2, '.', '').'</Data></Cell>
			<Cell ss:StyleID="s64"><Data ss:Type="String">'.number_format($registro->getRumTiempoRetencion(), 2, '.', '').'</Data></Cell>
			<Cell ss:StyleID="s64"><Data ss:Type="String">'.number_format($registro->getRumResolucion(), 2, '.', '').'</Data></Cell>
			<Cell ss:StyleID="s64"><Data ss:Type="String">'.number_format($registro->getRumTailing(), 2, '.', '').'</Data></Cell>
                        <Cell ss:StyleID="s64"><Data ss:Type="String">'.$registro->obtenerMaquina().'</Data></Cell>
                        <Cell ss:StyleID="s64"><Data ss:Type="String">'.$registro->obtenerMetodo().'</Data></Cell>
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
	 * Esta funcion retorna un listado con información de las columnas utilizadas
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
                            //El registro se tiene en cuenta solo si se ha registrado alguna columna
                            if($temporal->getRumColCodigo() != '') {
                                $datos[$fila]['rum_col_fecha'] = $temporal->getRumFecha();
                                $datos[$fila]['rum_col_metodo'] = $temporal->obtenerMetodo();
                                $datos[$fila]['rum_col_maquina'] = $temporal->obtenerMaquina();                                                                				

                                //Información de columna
                                $columna  = ColumnaPeer::retrieveByPk($temporal->getRumColCodigo());                                
                                $datos[$fila]['rum_col_codigo_interno'] = $columna->getColCodigoInterno();
                                $fase = FaseLigadaPeer::retrieveByPK($columna->getColFaseCodigo());
                                $dimension = DimensionPeer::retrieveByPK($columna->getColDimCodigo());
                                $tamano = TamanoParticulaPeer::retrieveByPK($columna->getColDimCodigo());
                                $datos[$fila]['rum_col_configuracion'] = $fase->getFaseNombre().'; '.$dimension->getDimNombre().'; '.$tamano->getTamNombre();
                                $modelo = ModeloPeer::retrieveByPK($columna->getColModCodigo());
                                $datos[$fila]['rum_col_modelo'] = $modelo->getModNombre();
                                $marca = MarcaPeer::retrieveByPK($columna->getColMarCodigo());
                                $datos[$fila]['rum_col_marca'] = $marca->getMarNombre();
                                
                                //Nombre de etapa
                                if($temporal->getRumEtaCodigo() == '') {
                                    $datos[$fila]['rum_etapa_nombre'] = $temporal->getRumEtaCodigo();
                                }
                                else {
                                    $etapa = EtapaPeer::retrieveByPK($temporal->getRumEtaCodigo());
                                    $datos[$fila]['rum_etapa_nombre'] = $etapa->getEtaNombre();
                                }                                

                                $datos[$fila]['rum_col_tiempo_retencion'] = number_format($temporal->getRumTiempoRetencion(), 2, '.', '');
                                $datos[$fila]['rum_col_platos_teoricos'] = number_format($temporal->getRumPlatosTeoricos(), 2, '.', '');
                                $datos[$fila]['rum_col_tailing'] = number_format($temporal->getRumTailing(), 2, '.', '');
                                $datos[$fila]['rum_col_resolucion'] = number_format($temporal->getRumResolucion(), 2, '.', '');
                                $datos[$fila]['rum_col_presion'] = number_format($temporal->getRumPresion(), 2, '.', '');				

                                $fila++;
                            }                            
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
        
        //Consultar Platos Teóricos por Columna
        public function consultarPlatosTeoricos() {
            
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
	 * Esta funcion retorna un listado de métodos
	*/
	public function executeListarMetodos(sfWebRequest $request)
	{
		$salida = '({"total":"0", "results":""})';
		$datos = MetodoPeer::listarMetodosActivos();
		$cant = count($datos);
		if (count($datos)>0){
			$jsonresult = json_encode($datos);
			$salida= '({"total":"'.$cant.'","results":'.$jsonresult.'})';
		}
		return $this->renderText($salida);	
        }
        
        
        /**
	 * Esta funcion retorna un listado de marcas
	*/
	public function executeListarMarcas(sfWebRequest $request)
	{
                $salida = '({"total":"0", "results":""})';
		$fila = 0;
		$datos = array();

		try{

			$conexion = new Criteria();
                        $conexion->add(MarcaPeer::MAR_ELIMINADO, 0);
                        $conexion->addAscendingOrderByColumn(MarcaPeer::MAR_NOMBRE);
			$marcas = MarcaPeer::doSelect($conexion);

			foreach($marcas As $temporal)
			{
				$datos[$fila]['mar_codigo'] = $temporal->getMarCodigo();
				$datos[$fila]['mar_nombre'] = $temporal->getMarNombre();
				$fila++;
			}
                        
                        $datos[$fila]['mar_codigo']='';
			$datos[$fila]['mar_nombre'] ='TODAS';

			if($fila>0){
				$jsonresult = json_encode($datos);
				$salida= '({"total":"'.$fila.'","results":'.$jsonresult.'})';
			}
		}catch (Exception $excepcion)
		{
			$salida='Excepci&oacute;n en listar Marcas';
		}
		return $this->renderText($salida);
        }
        
        
        /**
	 * Esta funcion retorna un listado de modelos
	*/
	public function executeListarModelos(sfWebRequest $request)
	{
                $salida = '({"total":"0", "results":""})';
		$fila = 0;
		$datos = array();

		try{

			$conexion = new Criteria();
                        $conexion->add(ModeloPeer::MOD_ELIMINADO, 0);
                        $conexion->addAscendingOrderByColumn(ModeloPeer::MOD_NOMBRE);
			$modelos = ModeloPeer::doSelect($conexion);

			foreach($modelos As $temporal)
			{
				$datos[$fila]['mod_codigo'] = $temporal->getModCodigo();
				$datos[$fila]['mod_nombre'] = $temporal->getModNombre();
				$fila++;
			}
                        
                        $datos[$fila]['mod_codigo']='';
			$datos[$fila]['mod_nombre'] ='TODOS';

			if($fila>0){
				$jsonresult = json_encode($datos);
				$salida= '({"total":"'.$fila.'","results":'.$jsonresult.'})';
			}
		}catch (Exception $excepcion)
		{
			$salida='Excepci&oacute;n en listar Modelos';
		}
		return $this->renderText($salida);
        }
        
        
        /**
	 * Esta funcion retorna un listado de fases ligadas
	*/
	public function executeListarFases(sfWebRequest $request)
	{
                $salida = '({"total":"0", "results":""})';
		$fila = 0;
		$datos = array();

		try{

			$conexion = new Criteria();
                        $conexion->add(FaseLigadaPeer::FASE_ELIMINADO, 0);
                        $conexion->addAscendingOrderByColumn(FaseLigadaPeer::FASE_NOMBRE);
			$fases = FaseLigadaPeer::doSelect($conexion);

			foreach($fases As $temporal)
			{
				$datos[$fila]['fase_codigo'] = $temporal->getFaseCodigo();
				$datos[$fila]['fase_nombre'] = $temporal->getFaseNombre();
				$fila++;
			}
                        
                        $datos[$fila]['fase_codigo']='';
			$datos[$fila]['fase_nombre'] ='TODAS';

			if($fila>0){
				$jsonresult = json_encode($datos);
				$salida= '({"total":"'.$fila.'","results":'.$jsonresult.'})';
			}
		}catch (Exception $excepcion)
		{
			$salida='Excepci&oacute;n en listar Fases';
		}
		return $this->renderText($salida);
        }
        
        
        /**
	 * Esta funcion retorna un listado de dimensiones
	*/
	public function executeListarDimensiones(sfWebRequest $request)
	{
                $salida = '({"total":"0", "results":""})';
		$fila = 0;
		$datos = array();

		try{

			$conexion = new Criteria();
                        $conexion->add(DimensionPeer::DIM_ELIMINADO, 0);
                        $conexion->addAscendingOrderByColumn(DimensionPeer::DIM_NOMBRE);
			$dimensiones = DimensionPeer::doSelect($conexion);

			foreach($dimensiones As $temporal)
			{
				$datos[$fila]['dim_codigo'] = $temporal->getDimCodigo();
				$datos[$fila]['dim_nombre'] = $temporal->getDimNombre();
				$fila++;
			}
                        
                        $datos[$fila]['dim_codigo']='';
			$datos[$fila]['dim_nombre'] ='TODAS';

			if($fila>0){
				$jsonresult = json_encode($datos);
				$salida= '({"total":"'.$fila.'","results":'.$jsonresult.'})';
			}
		}catch (Exception $excepcion)
		{
			$salida='Excepci&oacute;n en listar Dimensiones';
		}
		return $this->renderText($salida);
        }
        
        
        
        /**
	 * Esta funcion retorna un listado de tamanos
	*/
	public function executeListarTamanos(sfWebRequest $request)
	{
                $salida = '({"total":"0", "results":""})';
		$fila = 0;
		$datos = array();

		try{

			$conexion = new Criteria();
                        $conexion->add(TamanoParticulaPeer::TAM_ELIMINADO, 0);
                        $conexion->addAscendingOrderByColumn(TamanoParticulaPeer::TAM_NOMBRE);
			$tamanos = TamanoParticulaPeer::doSelect($conexion);

			foreach($tamanos As $temporal)
			{
				$datos[$fila]['tam_codigo'] = $temporal->getTamCodigo();
				$datos[$fila]['tam_nombre'] = $temporal->getTamNombre();
				$fila++;
			}
                        
                        $datos[$fila]['tam_codigo']='';
			$datos[$fila]['tam_nombre'] ='TODOS';

			if($fila>0){
				$jsonresult = json_encode($datos);
				$salida= '({"total":"'.$fila.'","results":'.$jsonresult.'})';
			}
		}catch (Exception $excepcion)
		{
			$salida='Excepci&oacute;n en listar Tamanos';
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
