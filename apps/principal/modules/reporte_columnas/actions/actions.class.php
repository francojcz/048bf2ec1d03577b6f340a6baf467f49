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
                $marca_codigo=$this->getRequestParameter('marca_codigo');
                $modelo_codigo=$this->getRequestParameter('modelo_codigo');
                $fase_codigo=$this->getRequestParameter('fase_codigo');
                $dimension_codigo=$this->getRequestParameter('dimension_codigo');
                $tamano_codigo=$this->getRequestParameter('tamano_codigo');

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
                
                //Se buscan las columnas que cumplan con los criterios seleccionados
                $conexion_columna = new Criteria();
                if($marca_codigo!='') {
                    $conexion_columna->add(ColumnaPeer::COL_MAR_CODIGO, $marca_codigo);                    
                }
                if($modelo_codigo!='') {
                    $conexion_columna->add(ColumnaPeer::COL_MOD_CODIGO, $modelo_codigo);                    
                }
                if($fase_codigo!='') {
                    $conexion_columna->add(ColumnaPeer::COL_FASE_CODIGO, $fase_codigo);                    
                }
                if($dimension_codigo!='') {
                    $conexion_columna->add(ColumnaPeer::COL_DIM_CODIGO, $dimension_codigo);                    
                }
                if($tamano_codigo!='') {
                    $conexion_columna->add(ColumnaPeer::COL_TAM_CODIGO, $tamano_codigo);                    
                }
                $columnas = ColumnaPeer::doSelect($conexion_columna);
                //Si existe al menos una columna que coincida con los criterios
                if(count($columnas) > 0) {                    
                    foreach ($columnas as $columna) {
                        //Se búsca en la tabla RegistroUsoMáquina los códigos de las columnas que cumplieron con los criterios
                        $conexion->addOr(RegistroUsoMaquinaPeer::RUM_COL_CODIGO, $columna->getColCodigo());
                    }
                }
                else 
                {
                    /* No existe ninguna columna que coincida con los criterios, 
                       entonces para que no muestre ningún registro, se coloca la siguiente condición */
                    $conexion->add(RegistroUsoMaquinaPeer::RUM_COL_CODIGO, -1);
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
                <Column ss:AutoFitWidth="0" ss:Width="90"/>
                <Column ss:AutoFitWidth="0" ss:Width="120"/>
                <Column ss:AutoFitWidth="0" ss:Width="90"/>
                <Column ss:AutoFitWidth="0" ss:Width="90"/>
                <Column ss:AutoFitWidth="0" ss:Width="80"/>
                <Column ss:AutoFitWidth="0" ss:Width="100"/>
                <Column ss:AutoFitWidth="0" ss:Width="100"/>
                <Column ss:AutoFitWidth="0" ss:Width="90"/>
                <Column ss:AutoFitWidth="0" ss:Width="90"/>
                <Column ss:AutoFitWidth="0" ss:Width="100"/>
                <Column ss:AutoFitWidth="0" ss:Width="120"/>
                <Column ss:AutoFitWidth="0" ss:Width="120"/>
                <Column ss:AutoFitWidth="0" ss:Width="100"/>
                <Column ss:AutoFitWidth="0" ss:Width="100"/>
                <Row ss:AutoFitHeight="0" ss:Height="40">                
                <Cell ss:StyleID="s73"><Data ss:Type="String">Fecha</Data></Cell>
                <Cell ss:StyleID="s73"><Data ss:Type="String">C&oacute;digo Interno</Data></Cell>
                <Cell ss:StyleID="s73"><Data ss:Type="String">Configuraci&oacute;n</Data></Cell>
                <Cell ss:StyleID="s73"><Data ss:Type="String">Modelo</Data></Cell>
                <Cell ss:StyleID="s73"><Data ss:Type="String">Marca</Data></Cell>
                <Cell ss:StyleID="s73"><Data ss:Type="String">Etapa</Data></Cell>
                <Cell ss:StyleID="s73"><Data ss:Type="String">Tiempo Retenci&oacute;n (tr)</Data></Cell>
                <Cell ss:StyleID="s73"><Data ss:Type="String">Platos Te&oacute;ricos (N)</Data></Cell>
                <Cell ss:StyleID="s73"><Data ss:Type="String">Factor de Cola (T)</Data></Cell>
                <Cell ss:StyleID="s73"><Data ss:Type="String">Resoluci&oacute;n (R)</Data></Cell>
                <Cell ss:StyleID="s73"><Data ss:Type="String">Presi&oacute;n de Sistema (psi)</Data></Cell>
                <Cell ss:StyleID="s73"><Data ss:Type="String">Observaciones</Data></Cell>
                <Cell ss:StyleID="s73"><Data ss:Type="String">Método</Data></Cell>
                <Cell ss:StyleID="s73"><Data ss:Type="String">Equipo</Data></Cell>
                <Cell ss:StyleID="s73"><Data ss:Type="String">Grupo Equipo</Data></Cell>
               </Row>');
                
                foreach($registros as $registro) {
                        //El registro se tiene en cuenta solo si se ha registrado alguna columna
                        if($registro->getRumColCodigo() != '') {
                            //Información de columna
                            $columna  = ColumnaPeer::retrieveByPk($registro->getRumColCodigo());         
                            $fase = FaseLigadaPeer::retrieveByPK($columna->getColFaseCodigo());
                            $dimension = DimensionPeer::retrieveByPK($columna->getColDimCodigo());
                            $tamano = TamanoParticulaPeer::retrieveByPK($columna->getColTamCodigo());
                            $configuracion = $fase->getFaseNombre().'; '.$dimension->getDimNombre().'; '.$tamano->getTamNombre().'μm';
                            
                            $modelo = ModeloPeer::retrieveByPK($columna->getColModCodigo());
                            $marca = MarcaPeer::retrieveByPK($columna->getColMarCodigo());
                            
                            //Nombre de etapa
                            if($registro->getRumEtaCodigo() == '') {
                                $etapa = $registro->getRumEtaCodigo();
                            }
                            else {
                                $etapa_info = EtapaPeer::retrieveByPK($registro->getRumEtaCodigo());
                                $etapa = $etapa_info->getEtaNombre();
                            }

                            $this->renderText('<Row>			
                            <Cell ss:StyleID="s64"><Data ss:Type="String">'.$registro->getRumFecha('d-m-Y').'</Data></Cell>
                            <Cell ss:StyleID="s64"><Data ss:Type="String">'.$columna->getColCodigoInterno().'</Data></Cell>
                            <Cell ss:StyleID="s64"><Data ss:Type="String">'.$configuracion.'</Data></Cell>
                            <Cell ss:StyleID="s64"><Data ss:Type="String">'.$modelo->getModNombre().'</Data></Cell>
                            <Cell ss:StyleID="s64"><Data ss:Type="String">'.$marca->getMarNombre().'</Data></Cell>
                            <Cell ss:StyleID="s64"><Data ss:Type="String">'.$etapa.'</Data></Cell>
                            <Cell ss:StyleID="s64"><Data ss:Type="String">'.number_format($registro->getRumTiempoRetencion(), 2, '.', '').'</Data></Cell>
                            <Cell ss:StyleID="s64"><Data ss:Type="String">'.number_format($registro->getRumPlatosTeoricos(), 2, '.', '').'</Data></Cell>                            
                            <Cell ss:StyleID="s64"><Data ss:Type="String">'.number_format($registro->getRumTailing(), 2, '.', '').'</Data></Cell>
                            <Cell ss:StyleID="s64"><Data ss:Type="String">'.number_format($registro->getRumResolucion(), 2, '.', '').'</Data></Cell>
                            <Cell ss:StyleID="s64"><Data ss:Type="String">'.number_format($registro->getRumPresion(), 2, '.', '').'</Data></Cell>
                            <Cell ss:StyleID="s64"><Data ss:Type="String">'.$registro->getRumObservacionesCol().'</Data></Cell>
                            <Cell ss:StyleID="s64"><Data ss:Type="String">'.$registro->obtenerMetodo().'</Data></Cell>
                            <Cell ss:StyleID="s64"><Data ss:Type="String">'.$registro->obtenerMaquina().'</Data></Cell>
                            <Cell ss:StyleID="s64"><Data ss:Type="String">'.$registro->obtenerGrupo().'</Data></Cell>
                            </Row>');
                            
                        }                        			
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
                                $datos[$fila]['rum_col_grupo'] = $temporal->obtenerGrupo();

                                //Información de columna
                                $columna  = ColumnaPeer::retrieveByPk($temporal->getRumColCodigo());                                
                                $datos[$fila]['rum_col_codigo_interno'] = $columna->getColCodigoInterno();
                                $fase = FaseLigadaPeer::retrieveByPK($columna->getColFaseCodigo());
                                $dimension = DimensionPeer::retrieveByPK($columna->getColDimCodigo());
                                $tamano = TamanoParticulaPeer::retrieveByPK($columna->getColTamCodigo());
                                $datos[$fila]['rum_col_configuracion'] = $fase->getFaseNombre().'; '.$dimension->getDimNombre().'; '.$tamano->getTamNombre().'μm';
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
                                $datos[$fila]['rum_col_observaciones'] = $temporal->getRumObservacionesCol();

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
            //Se guardan en un arreglo las fechas que comprenden el rango [desde_fecha-hasta_fecha]
            $desde_fecha = $this->getRequestParameter('desde_fecha');
            $hasta_fecha = $this->getRequestParameter('hasta_fecha');
            $fechas = array();
            $fechas[] = $desde_fecha;
            while($desde_fecha < $hasta_fecha) {
                $desde_fecha = date('Y-m-d',strtotime('+1 day', strtotime($desde_fecha)));
                $fechas[] = $desde_fecha;
            }            
            
            //Obtener las columnas registradas sin repetición
            $columnas = array();
            $pos = 0;
            $conexion = $this->obtenerConexion();
            $conexion->addAscendingOrderByColumn(RegistroUsoMaquinaPeer::RUM_COL_CODIGO);
            $datos_rum = RegistroUsoMaquinaPeer::doSelect($conexion);
            foreach ($datos_rum as $dato_rum) {
                $var = false;
                for($tam=0; $tam<sizeof($columnas); $tam++) {
                    if($dato_rum->getRumColCodigo() == $columnas[$tam]['codigo']) {
                        $tam = sizeof($columnas);
                        $var = true;
                    }                    
                }
                if($var == false) {
                    $columnas[$pos]['codigo'] = $dato_rum->getRumColCodigo();
                    $columnas[$pos]['color'] = $this->randomColor();
                    $columna = ColumnaPeer::retrieveByPK($dato_rum->getRumColCodigo());
                    $modelo = ModeloPeer::retrieveByPK($columna->getColModCodigo());
                    $columnas[$pos]['informacion'] = $columna->getColCodigoInterno().'-'.$modelo->getModNombre();                    
                    $pos++;
                }
            }
            
            //Obtener platos teoricos para cada columna por día 
            $datos = array();
            for($fecha=0; $fecha<sizeof($fechas); $fecha++) {
                for($columna=0; $columna<sizeof($columnas); $columna++) {
                    $conexion = $this->obtenerConexion();
                    $conexion->add(RegistroUsoMaquinaPeer::RUM_FECHA, $fechas[$fecha]);
                    $conexion->add(RegistroUsoMaquinaPeer::RUM_COL_CODIGO, $columnas[$columna]['codigo']);
                    $datos_col = RegistroUsoMaquinaPeer::doSelect($conexion);
//                    $cant_columnas = 0;
                    foreach ($datos_col as $dato_col) {
                        $datos[$fecha][$columnas[$columna]['codigo']] += $dato_col->getRumPlatosTeoricos();
//                        $cant_columnas++;
                    }
                    //Calcula el promedio de platos teóricos de la columna para el día en análisis
//                    $datos[$fecha][$columnas[$columna]['codigo']] /= $cant_columnas;
                }
            }
            
            //Cambiar fecha de formato Y-m-d a formato texto
            $fechas_texto = array();
            for($i=0; $i<sizeof($fechas); $i++) {
                $fechas_texto[] = $this->mes($fechas[$i]);
            }            

            $xml = '<?xml version="1.0"?>';
            $xml .= '<chart>';
            $xml .= '<series>';
            for($dias = 0; $dias < sizeof($fechas); $dias++) {
                $xml .= '<value xid="'.$fechas[$dias].'">'.$fechas_texto[$dias].'</value>';
            }
            $xml .= '</series>';
            $xml .= '<graphs>';            
            for ($indicador=0; $indicador<sizeof($columnas); $indicador++){
                //Guarda el valor de los platos teóricos anterior más próximo diferente de cero
                $platos_anterior = 0;
                $xml.='<graph color="#'.$columnas[$indicador]['color'].'" title="'.$columnas[$indicador]['informacion'].'" bullet="round">';                
                for($diasmes=0;$diasmes<sizeof($fechas);$diasmes++){
                    $numero_platos = $datos[$diasmes][$columnas[$indicador]['codigo']];
                    if($numero_platos != '') {
                        $xml .= '<value xid="'.$fechas[$diasmes].'">'.round($numero_platos, 2).'</value>';
                        $platos_anterior = $numero_platos;
                    } else {
                        $xml .= '<value xid="'.$fechas[$diasmes].'">'.round($platos_anterior, 2).'</value>';
                    }                    
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
            //Se guardan en un arreglo las fechas que comprenden el rango [desde_fecha-hasta_fecha]
            $desde_fecha = $this->getRequestParameter('desde_fecha');
            $hasta_fecha = $this->getRequestParameter('hasta_fecha');
            $fechas = array();
            $fechas[] = $desde_fecha;
            while($desde_fecha < $hasta_fecha) {
                $desde_fecha = date('Y-m-d',strtotime('+1 day', strtotime($desde_fecha)));
                $fechas[] = $desde_fecha;
            }            
            
            //Obtener las columnas registradas sin repetición
            $columnas = array();
            $pos = 0;
            $conexion = $this->obtenerConexion();
            $conexion->addAscendingOrderByColumn(RegistroUsoMaquinaPeer::RUM_COL_CODIGO);
            $datos_rum = RegistroUsoMaquinaPeer::doSelect($conexion);
            foreach ($datos_rum as $dato_rum) {
                $var = false;
                for($tam=0; $tam<sizeof($columnas); $tam++) {
                    if($dato_rum->getRumColCodigo() == $columnas[$tam]['codigo']) {
                        $tam = sizeof($columnas);
                        $var = true;
                    }                    
                }
                if($var == false) {
                    $columnas[$pos]['codigo'] = $dato_rum->getRumColCodigo();
                    $columnas[$pos]['color'] = $this->randomColor();
                    $columna = ColumnaPeer::retrieveByPK($dato_rum->getRumColCodigo());
                    $modelo = ModeloPeer::retrieveByPK($columna->getColModCodigo());
                    $columnas[$pos]['informacion'] = $columna->getColCodigoInterno().'-'.$modelo->getModNombre();                    
                    $pos++;
                }
            }
            
            //Obtener tiempos de retención para cada columna por día 
            $datos = array();
            for($fecha=0; $fecha<sizeof($fechas); $fecha++) {
                for($columna=0; $columna<sizeof($columnas); $columna++) {
                    $conexion = $this->obtenerConexion();
                    $conexion->add(RegistroUsoMaquinaPeer::RUM_FECHA, $fechas[$fecha]);
                    $conexion->add(RegistroUsoMaquinaPeer::RUM_COL_CODIGO, $columnas[$columna]['codigo']);
                    $datos_col = RegistroUsoMaquinaPeer::doSelect($conexion);
//                    $cant_columnas = 0;
                    foreach ($datos_col as $dato_col) {
                        $datos[$fecha][$columnas[$columna]['codigo']] = $dato_col->getRumTiempoRetencion();
//                        $cant_columnas++;
                    }
                    //Calcula el promedio de tiempos de retención de la columna para el día en análisis
//                    $datos[$fecha][$columnas[$columna]['codigo']] /= $cant_columnas;
                }
            }
            
            //Cambiar fecha de formato Y-m-d a formato texto
            $fechas_texto = array();
            for($i=0; $i<sizeof($fechas); $i++) {
                $fechas_texto[] = $this->mes($fechas[$i]);
            }

            $xml = '<?xml version="1.0"?>';
            $xml .= '<chart>';
            $xml .= '<series>';
            for($dias = 0; $dias < sizeof($fechas); $dias++) {
                $xml .= '<value xid="'.$fechas[$dias].'">'.$fechas_texto[$dias].'</value>';
            }
            $xml .= '</series>';
            $xml .= '<graphs>';            
            for ($indicador=0; $indicador<sizeof($columnas); $indicador++){
                //Guarda el tiempo de retención anterior más próximo diferente de cero
                $tiempo_anterior = 0;
                $xml.='<graph color="#'.$columnas[$indicador]['color'].'" title="'.$columnas[$indicador]['informacion'].'" bullet="round">';                
                for($diasmes=0;$diasmes<sizeof($fechas);$diasmes++) {                    
                    $tiempos_retencion = $datos[$diasmes][$columnas[$indicador]['codigo']];
                    if($tiempos_retencion != '') {
                        $xml .= '<value xid="'.$fechas[$diasmes].'">'.round($tiempos_retencion, 2).'</value>';
                        $tiempo_anterior = $tiempos_retencion;
                    } else {
                        $xml .= '<value xid="'.$fechas[$diasmes].'">'.round($tiempo_anterior, 2).'</value>';
                    }
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
            //Se guardan en un arreglo las fechas que comprenden el rango [desde_fecha-hasta_fecha]
            $desde_fecha = $this->getRequestParameter('desde_fecha');
            $hasta_fecha = $this->getRequestParameter('hasta_fecha');
            $fechas = array();
            $fechas[] = $desde_fecha;
            while($desde_fecha < $hasta_fecha) {
                $desde_fecha = date('Y-m-d',strtotime('+1 day', strtotime($desde_fecha)));
                $fechas[] = $desde_fecha;
            }            
            
            //Obtener las columnas registradas sin repetición
            $columnas = array();
            $pos = 0;
            $conexion = $this->obtenerConexion();
            $conexion->addAscendingOrderByColumn(RegistroUsoMaquinaPeer::RUM_COL_CODIGO);
            $datos_rum = RegistroUsoMaquinaPeer::doSelect($conexion);
            foreach ($datos_rum as $dato_rum) {
                $var = false;
                for($tam=0; $tam<sizeof($columnas); $tam++) {
                    if($dato_rum->getRumColCodigo() == $columnas[$tam]['codigo']) {
                        $tam = sizeof($columnas);
                        $var = true;
                    }                    
                }
                if($var == false) {
                    $columnas[$pos]['codigo'] = $dato_rum->getRumColCodigo();
                    $columnas[$pos]['color'] = $this->randomColor();
                    $columna = ColumnaPeer::retrieveByPK($dato_rum->getRumColCodigo());
                    $modelo = ModeloPeer::retrieveByPK($columna->getColModCodigo());
                    $columnas[$pos]['informacion'] = $columna->getColCodigoInterno().'-'.$modelo->getModNombre();                    
                    $pos++;
                }
            }
            
            //Obtener factor de cola de cada columna por día 
            $datos = array();
            for($fecha=0; $fecha<sizeof($fechas); $fecha++) {
                for($columna=0; $columna<sizeof($columnas); $columna++) {
                    $conexion = $this->obtenerConexion();
                    $conexion->add(RegistroUsoMaquinaPeer::RUM_FECHA, $fechas[$fecha]);
                    $conexion->add(RegistroUsoMaquinaPeer::RUM_COL_CODIGO, $columnas[$columna]['codigo']);
                    $datos_col = RegistroUsoMaquinaPeer::doSelect($conexion);
//                    $cant_columnas = 0;
                    foreach ($datos_col as $dato_col) {
                        $datos[$fecha][$columnas[$columna]['codigo']] += $dato_col->getRumTailing();
//                        $cant_columnas++;
                    }
                    //Calcula el promedio de factor de cola de la columna para el día en análisis
//                    $datos[$fecha][$columnas[$columna]['codigo']] /= $cant_columnas;
                }
            }
            
            //Cambiar fecha de formato Y-m-d a formato texto
            $fechas_texto = array();
            for($i=0; $i<sizeof($fechas); $i++) {
                $fechas_texto[] = $this->mes($fechas[$i]);
            }            

            $xml = '<?xml version="1.0"?>';
            $xml .= '<chart>';
            $xml .= '<series>';
            for($dias = 0; $dias < sizeof($fechas); $dias++) {
                $xml .= '<value xid="'.$fechas[$dias].'">'.$fechas_texto[$dias].'</value>';
            }
            $xml .= '</series>';
            $xml .= '<graphs>';            
            for ($indicador=0; $indicador<sizeof($columnas); $indicador++){
                //Guarda el factor de cola anterior más próximo diferente de cero
                $factor_anterior = 0;
                $xml.='<graph color="#'.$columnas[$indicador]['color'].'" title="'.$columnas[$indicador]['informacion'].'" bullet="round">';                
                for($diasmes=0;$diasmes<sizeof($fechas);$diasmes++){
                    $factor_cola = $datos[$diasmes][$columnas[$indicador]['codigo']];
                    if($factor_cola != '') {
                        $xml .= '<value xid="'.$fechas[$diasmes].'">'.round($factor_cola, 2).'</value>';
                        $factor_anterior = $factor_cola;
                    } else {
                        $xml .= '<value xid="'.$fechas[$diasmes].'">'.round($factor_anterior, 2).'</value>';
                    }
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
            //Se guardan en un arreglo las fechas que comprenden el rango [desde_fecha-hasta_fecha]
            $desde_fecha = $this->getRequestParameter('desde_fecha');
            $hasta_fecha = $this->getRequestParameter('hasta_fecha');
            $fechas = array();
            $fechas[] = $desde_fecha;
            while($desde_fecha < $hasta_fecha) {
                $desde_fecha = date('Y-m-d',strtotime('+1 day', strtotime($desde_fecha)));
                $fechas[] = $desde_fecha;
            }            
            
            //Obtener las columnas registradas sin repetición
            $columnas = array();
            $pos = 0;
            $conexion = $this->obtenerConexion();
            $conexion->addAscendingOrderByColumn(RegistroUsoMaquinaPeer::RUM_COL_CODIGO);
            $datos_rum = RegistroUsoMaquinaPeer::doSelect($conexion);
            foreach ($datos_rum as $dato_rum) {
                $var = false;
                for($tam=0; $tam<sizeof($columnas); $tam++) {
                    if($dato_rum->getRumColCodigo() == $columnas[$tam]['codigo']) {
                        $tam = sizeof($columnas);
                        $var = true;
                    }                    
                }
                if($var == false) {
                    $columnas[$pos]['codigo'] = $dato_rum->getRumColCodigo();
                    $columnas[$pos]['color'] = $this->randomColor();
                    $columna = ColumnaPeer::retrieveByPK($dato_rum->getRumColCodigo());
                    $modelo = ModeloPeer::retrieveByPK($columna->getColModCodigo());
                    $columnas[$pos]['informacion'] = $columna->getColCodigoInterno().'-'.$modelo->getModNombre();                    
                    $pos++;
                }
            }
            
            //Obtener la resolución para cada columna por día 
            $datos = array();
            for($fecha=0; $fecha<sizeof($fechas); $fecha++) {
                for($columna=0; $columna<sizeof($columnas); $columna++) {
                    $conexion = $this->obtenerConexion();
                    $conexion->add(RegistroUsoMaquinaPeer::RUM_FECHA, $fechas[$fecha]);
                    $conexion->add(RegistroUsoMaquinaPeer::RUM_COL_CODIGO, $columnas[$columna]['codigo']);
                    $datos_col = RegistroUsoMaquinaPeer::doSelect($conexion);
//                    $cant_columnas = 0;
                    foreach ($datos_col as $dato_col) {
                        $datos[$fecha][$columnas[$columna]['codigo']] += $dato_col->getRumResolucion();
//                        $cant_columnas++;
                    }
                    //Calcula el promedio de resoluciones de la columna para el día en análisis
//                    $datos[$fecha][$columnas[$columna]['codigo']] /= $cant_columnas;
                }
            }
            
            //Cambiar fecha de formato Y-m-d a formato texto
            $fechas_texto = array();
            for($i=0; $i<sizeof($fechas); $i++) {
                $fechas_texto[] = $this->mes($fechas[$i]);
            }            

            $xml = '<?xml version="1.0"?>';
            $xml .= '<chart>';
            $xml .= '<series>';
            for($dias = 0; $dias < sizeof($fechas); $dias++) {
                $xml .= '<value xid="'.$fechas[$dias].'">'.$fechas_texto[$dias].'</value>';
            }
            $xml .= '</series>';
            $xml .= '<graphs>';
            for ($indicador=0; $indicador<sizeof($columnas); $indicador++){
                //Guarda la resolución anterior más próxima diferente de cero
                $resolucion_anterior = 0;
                $xml.='<graph color="#'.$columnas[$indicador]['color'].'" title="'.$columnas[$indicador]['informacion'].'" bullet="round">';                
                for($diasmes=0;$diasmes<sizeof($fechas);$diasmes++){
                    $resoluciones = $datos[$diasmes][$columnas[$indicador]['codigo']];
                    if($resoluciones != '') {
                        $xml .= '<value xid="'.$fechas[$diasmes].'">'.round($resoluciones, 2).'</value>';
                        $resolucion_anterior = $resoluciones;
                    } else {
                        $xml .= '<value xid="'.$fechas[$diasmes].'">'.round($resolucion_anterior, 2).'</value>';
                    }                    
                }
                $xml.='</graph>';
            }
            $xml.='</graphs>';
            $xml.='</chart>';

            return $this->renderText($xml);
	}
        
        //Grafico Presion de Sistema
	public function executeGenerarDatosPresionSistema(sfWebRequest $request)
	{
            //Se guardan en un arreglo las fechas que comprenden el rango [desde_fecha-hasta_fecha]
            $desde_fecha = $this->getRequestParameter('desde_fecha');
            $hasta_fecha = $this->getRequestParameter('hasta_fecha');
            $fechas = array();
            $fechas[] = $desde_fecha;
            while($desde_fecha < $hasta_fecha) {
                $desde_fecha = date('Y-m-d',strtotime('+1 day', strtotime($desde_fecha)));
                $fechas[] = $desde_fecha;
            }            
            
            //Obtener las columnas registradas sin repetición
            $columnas = array();
            $pos = 0;
            $conexion = $this->obtenerConexion();
            $conexion->addAscendingOrderByColumn(RegistroUsoMaquinaPeer::RUM_COL_CODIGO);
            $datos_rum = RegistroUsoMaquinaPeer::doSelect($conexion);
            foreach ($datos_rum as $dato_rum) {
                $var = false;
                for($tam=0; $tam<sizeof($columnas); $tam++) {
                    if($dato_rum->getRumColCodigo() == $columnas[$tam]['codigo']) {
                        $tam = sizeof($columnas);
                        $var = true;
                    }                    
                }
                if($var == false) {
                    $columnas[$pos]['codigo'] = $dato_rum->getRumColCodigo();
                    $columnas[$pos]['color'] = $this->randomColor();
                    $columna = ColumnaPeer::retrieveByPK($dato_rum->getRumColCodigo());
                    $modelo = ModeloPeer::retrieveByPK($columna->getColModCodigo());
                    $columnas[$pos]['informacion'] = $columna->getColCodigoInterno().'-'.$modelo->getModNombre();                    
                    $pos++;
                }
            }
            
            //Obtener la presión del sistema para cada columna por día 
            $datos = array();
            for($fecha=0; $fecha<sizeof($fechas); $fecha++) {
                for($columna=0; $columna<sizeof($columnas); $columna++) {
                    $conexion = $this->obtenerConexion();
                    $conexion->add(RegistroUsoMaquinaPeer::RUM_FECHA, $fechas[$fecha]);
                    $conexion->add(RegistroUsoMaquinaPeer::RUM_COL_CODIGO, $columnas[$columna]['codigo']);
                    $datos_col = RegistroUsoMaquinaPeer::doSelect($conexion);
//                    $cant_columnas = 0;
                    foreach ($datos_col as $dato_col) {
                        $datos[$fecha][$columnas[$columna]['codigo']] += $dato_col->getRumPresion();
//                        $cant_columnas++;
                    }
                    //Calcula el promedio de presiones de sistema de la columna para el día en análisis
//                    $datos[$fecha][$columnas[$columna]['codigo']] /= $cant_columnas;
                }
            }
            
            //Cambiar fecha de formato Y-m-d a formato texto
            $fechas_texto = array();
            for($i=0; $i<sizeof($fechas); $i++) {
                $fechas_texto[] = $this->mes($fechas[$i]);
            }            

            $xml = '<?xml version="1.0"?>';
            $xml .= '<chart>';
            $xml .= '<series>';
            for($dias = 0; $dias < sizeof($fechas); $dias++) {
                $xml .= '<value xid="'.$fechas[$dias].'">'.$fechas_texto[$dias].'</value>';
            }
            $xml .= '</series>';
            $xml .= '<graphs>';
            for ($indicador=0; $indicador<sizeof($columnas); $indicador++){
                //Guarda la presión del sistema anterior más próxima diferente de cero
                $presion_anterior = 0;
                $xml.='<graph color="#'.$columnas[$indicador]['color'].'" title="'.$columnas[$indicador]['informacion'].'" bullet="round">';                
                for($diasmes=0;$diasmes<sizeof($fechas);$diasmes++){
                    $presion_sistema = $datos[$diasmes][$columnas[$indicador]['codigo']];
                    if($presion_sistema != '') {
                        $xml .= '<value xid="'.$fechas[$diasmes].'">'.round($presion_sistema, 2).'</value>';
                        $presion_anterior = $presion_sistema;
                    } else {
                        $xml .= '<value xid="'.$fechas[$diasmes].'">'.round($presion_anterior, 2).'</value>';
                    }
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
            if($mes == 1) { return ($dia.' Ene'); }
            if($mes == 2) { return ($dia.' Feb'); }
            if($mes == 3) { return ($dia.' Mar'); }
            if($mes == 4) { return ($dia.' Abr'); }
            if($mes == 5) { return ($dia.' May'); }
            if($mes == 6) { return ($dia.' Jun'); }
            if($mes == 7) { return ($dia.' Jul'); }
            if($mes == 8) { return ($dia.' Ago'); }
            if($mes == 9) { return ($dia.' Sep'); }
            if($mes == 10) { return ($dia.' Oct'); }
            if($mes == 11) { return ($dia.' Nov'); }
            if($mes == 12) { return ($dia.' Dic'); }
        }
        
        //Genera un color de forma aleatoria
        public function randomColor() {
            $str = '';
            for($i = 0 ; $i < 6 ; $i++) {
                $randNum = rand(0 , 15);
                switch ($randNum) {
                    case 10: $randNum = 'A'; break;
                    case 11: $randNum = 'B'; break;
                    case 12: $randNum = 'C'; break;
                    case 13: $randNum = 'D'; break;
                    case 14: $randNum = 'E'; break;
                    case 15: $randNum = 'F'; break;
                }
                $str .= $randNum;
            }
            return $str;
        }
}
