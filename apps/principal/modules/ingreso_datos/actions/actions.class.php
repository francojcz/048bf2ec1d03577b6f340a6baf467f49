<?php

/**
 * ingreso_datos actions.
 *
 * @package    tpmlabs
 * @subpackage ingreso_datos
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ingreso_datosActions extends sfActions
{
    public function executeDividirRegistro(sfWebRequest $request)
    {
        $codigoMaquina = $request -> getParameter('codigo_maquina');
        $user = $this -> getUser();
        $codigo_usuario = $user -> getAttribute('usu_codigo');
        
        $criteria = new Criteria();
        $criteria -> add(MaquinaPeer::MAQ_CODIGO, $codigoMaquina);
        $maquina = MaquinaPeer::doSelectOne($criteria);
        
        $criteria = new Criteria();
        $criteria -> add(EmpleadoPeer::EMPL_USU_CODIGO, $codigo_usuario);
        $operario = EmpleadoPeer::doSelectOne($criteria);
        $criteria = new Criteria();
        $criteria -> add(EmpresaPeer::EMP_CODIGO, $operario -> getEmplEmpCodigo());
        $empresa = EmpresaPeer::doSelectOne($criteria);
        $inyeccionesEstandarPromedio = $empresa -> getEmpInyectEstandarPromedio();

        $criteria = new Criteria();
        $codigoMaquina = $request -> getParameter('codigo_maquina');
        $criteria -> add(RegistroUsoMaquinaPeer::RUM_MAQ_CODIGO, $codigoMaquina);
        $fecha = $request -> getParameter('fecha');
        $criteria -> add(RegistroUsoMaquinaPeer::RUM_FECHA, $fecha);
        $criteria -> add(RegistroUsoMaquinaPeer::RUM_ELIMINADO, false);
        $criteria -> addDescendingOrderByColumn(RegistroUsoMaquinaPeer::RUM_TIEMPO_ENTRE_MODELO);
        $registro = RegistroUsoMaquinaPeer::doSelectOne($criteria);

        $segundosFallas = $registro -> getRumFallas() * 60;
        $segundosInicio = ($registro -> getRumHoraInicioTrabajo('H') * 3600) + $registro -> getRumHoraInicioTrabajo('i') * 60 + $registro -> getRumHoraInicioTrabajo('s');
        $segundosFin = ($registro -> getRumHoraFinTrabajo('H') * 3600) + $registro -> getRumHoraFinTrabajo('i') * 60 + $registro -> getRumHoraFinTrabajo('s');

        $deficitTiempo = null;

        $tiempoDisponible = RegistroUsoMaquinaPeer::calcularTiempoDisponibleMinutos($codigoMaquina, $fecha, $inyeccionesEstandarPromedio, TRUE);
//        $t = RegistroUsoMaquinaPeer::calcularTiempoDisponibleMinutos($codigoMaquina, $fecha, $inyeccionesEstandarPromedio, TRUE); 
        if ($tiempoDisponible < 0)
        {
            $deficitTiempo = 0 - ($tiempoDisponible * 60);
        } else
        {
            return $this -> renderText('1');
        }
//        return $this -> renderText('Disp. '.$t[0].'-TNP '.$t[1].'-TPP '.$t[2].'-TPNP '.$t[3].'- TO'.$t[4].'');
        
        $registroSegundoDia = new RegistroUsoMaquina();
        $datetimeSegundoDia = new DateTime('@' . ($registro -> getRumFecha('U') + 86400));
        $timezone = date_default_timezone_get();
        $datetimeSegundoDia -> setTimezone(new DateTimeZone($timezone));
        $registroSegundoDia -> setRumTiempoEntreModelo('00:00:00');
        $registroSegundoDia -> setRumFecha($datetimeSegundoDia -> format('Y-m-d'));
        $registroSegundoDia -> setRumMaqCodigo($registro -> getRumMaqCodigo());
        $registroSegundoDia -> setRumMetCodigo($registro -> getRumMetCodigo());
        $registroSegundoDia -> setRumEliminado(FALSE);
	$registroSegundoDia -> setRumUsuCodigo($registro -> getRumUsuCodigo());
        
        //Cambios: 16 de Septiembre de 2013
        $registroSegundoDia -> setRumTiempoCorridaSistema($registro ->getRumTiempoCorridaSistema());
        $registroSegundoDia -> setRumTiempoCorridaCurvas($registro ->getRumTiempoCorridaCurvas());
        $registroSegundoDia -> setRumTiempoCorridaSistemaEst($registro ->getRumTiempoCorridaSistemaEst());
        $registroSegundoDia -> setRumTiempoCorridaCurvasEsta($registro ->getRumTiempoCorridaCurvasEsta());
        $registroSegundoDia -> setRumTcProductoTerminadoEsta($registro ->getRumTcProductoTerminadoEsta());
        $registroSegundoDia -> setRumTcEstabilidadEstandar($registro ->getRumTcEstabilidadEstandar());
        $registroSegundoDia -> setRumTcMateriaPrimaEstandar($registro ->getRumTcMateriaPrimaEstandar());
        $registroSegundoDia -> setRumTcPurezaEstandar($registro ->getRumTcPurezaEstandar());
        $registroSegundoDia -> setRumTcDisolucionEstandar($registro ->getRumTcDisolucionEstandar());
        $registroSegundoDia -> setRumTcUniformidadEstandar($registro ->getRumTcUniformidadEstandar());
        
        //Cambios: 24 de febrero de 2014
        //Datos que se pasan al segundo día cuando hay división de registro
        //Información Columna:
        $registroSegundoDia ->setRumColCodigo($registro ->getRumColCodigo());
        $registroSegundoDia ->setRumEtaCodigo($registro ->getRumEtaCodigo());
        $registroSegundoDia ->setRumTiempoRetencion($registro ->getRumTiempoRetencion());
        $registroSegundoDia ->setRumPlatosTeoricos($registro ->getRumPlatosTeoricos());
        $registroSegundoDia ->setRumTailing($registro ->getRumTailing());
        $registroSegundoDia ->setRumResolucion($registro ->getRumResolucion());        
        $registroSegundoDia ->setRumPresion($registro ->getRumPresion());
        $registroSegundoDia ->setRumObservacionesCol($registro ->getRumObservacionesCol());
        //Información Corrida:
        $registroSegundoDia ->setRumLote($registro ->getRumLote());
        $registroSegundoDia ->setRumObservaciones($registro ->getRumObservaciones());

//        list($registro, $registroSegundoDia, $deficitTiempo) = RegistroUsoMaquinaPeer::dividirFallas($deficitTiempo, $registro, $registroSegundoDia);

        list($registro, $registroSegundoDia, $deficitTiempo) = RegistroUsoMaquinaPeer::dividirParosMenores($deficitTiempo, $registro, $registroSegundoDia);

        // Después del proceso de división, la hora de fin de corrida del registro original debe corresponder a la medianoche
//        $registro -> setRumHoraFinTrabajo('00:00:00');

        list($registro, $registroSegundoDia, $deficitTiempo) = RegistroUsoMaquinaPeer::dividirMuestras($deficitTiempo, $registro, $registroSegundoDia, $maquina -> getMaqTiempoInyeccion(), 'RumTcUniformidad', 'RumNumMuestrasUniformidad', 'RumNumInyecXMuestraUnifor');
        list($registro, $registroSegundoDia, $deficitTiempo) = RegistroUsoMaquinaPeer::dividirRetrabajosMuestras($deficitTiempo, $registro, $registroSegundoDia, $maquina -> getMaqTiempoInyeccion(), 'RumTcUniformidad', 'RumNumMuestrasUniformidadP', 'RumNumInyecXMuUniforPerd');

        list($registro, $registroSegundoDia, $deficitTiempo) = RegistroUsoMaquinaPeer::dividirMuestras($deficitTiempo, $registro, $registroSegundoDia, $maquina -> getMaqTiempoInyeccion(), 'RumTcDisolucion', 'RumNumMuestrasDisolucion', 'RumNumInyecXMuestraDisolu');
        list($registro, $registroSegundoDia, $deficitTiempo) = RegistroUsoMaquinaPeer::dividirRetrabajosMuestras($deficitTiempo, $registro, $registroSegundoDia, $maquina -> getMaqTiempoInyeccion(), 'RumTcDisolucion', 'RumNumMuestrasDisolucionPe', 'RumNumInyecXMuDisoluPerd');

        list($registro, $registroSegundoDia, $deficitTiempo) = RegistroUsoMaquinaPeer::dividirMuestras($deficitTiempo, $registro, $registroSegundoDia, $maquina -> getMaqTiempoInyeccion(), 'RumTcPureza', 'RumNumMuestrasPureza', 'RumNumInyecXMuestraPureza');
        list($registro, $registroSegundoDia, $deficitTiempo) = RegistroUsoMaquinaPeer::dividirRetrabajosMuestras($deficitTiempo, $registro, $registroSegundoDia, $maquina -> getMaqTiempoInyeccion(), 'RumTcPureza', 'RumNumMuestrasPurezaPerdid', 'RumNumInyecXMuPurezaPerd');

        list($registro, $registroSegundoDia, $deficitTiempo) = RegistroUsoMaquinaPeer::dividirMuestras($deficitTiempo, $registro, $registroSegundoDia, $maquina -> getMaqTiempoInyeccion(), 'RumTcMateriaPrima', 'RumNumMuestrasMateriaPrima', 'RumNumInyecXMuestraMateri');
        list($registro, $registroSegundoDia, $deficitTiempo) = RegistroUsoMaquinaPeer::dividirRetrabajosMuestras($deficitTiempo, $registro, $registroSegundoDia, $maquina -> getMaqTiempoInyeccion(), 'RumTcMateriaPrima', 'RumNumMuMateriaPrimaPerdi', 'RumNumInyecXMuMateriPerd');

        list($registro, $registroSegundoDia, $deficitTiempo) = RegistroUsoMaquinaPeer::dividirMuestras($deficitTiempo, $registro, $registroSegundoDia, $maquina -> getMaqTiempoInyeccion(), 'RumTcEstabilidad', 'RumNumMuestrasEstabilidad', 'RumNumInyecXMuestraEstabi');
        list($registro, $registroSegundoDia, $deficitTiempo) = RegistroUsoMaquinaPeer::dividirRetrabajosMuestras($deficitTiempo, $registro, $registroSegundoDia, $maquina -> getMaqTiempoInyeccion(), 'RumTcEstabilidad', 'RumNumMuEstabilidadPerdida', 'RumNumInyecXMuEstabiPerd');

        list($registro, $registroSegundoDia, $deficitTiempo) = RegistroUsoMaquinaPeer::dividirMuestras($deficitTiempo, $registro, $registroSegundoDia, $maquina -> getMaqTiempoInyeccion(), 'RumTcProductoTerminado', 'RumNumMuestrasProducto', 'RumNumInyecXMuestraProduc');
        list($registro, $registroSegundoDia, $deficitTiempo) = RegistroUsoMaquinaPeer::dividirRetrabajosMuestras($deficitTiempo, $registro, $registroSegundoDia, $maquina -> getMaqTiempoInyeccion(), 'RumTcProductoTerminado', 'RumNumMuProductoPerdida', 'RumNumInyecXMuProducPerd');

        list($registro, $registroSegundoDia, $deficitTiempo) = RegistroUsoMaquinaPeer::dividirCurvasCalibracion($deficitTiempo, $registro, $registroSegundoDia, $maquina -> getMaqTiempoInyeccion(), '6');
        list($registro, $registroSegundoDia, $deficitTiempo) = RegistroUsoMaquinaPeer::dividirRetrabajosCurvasCalibracion($deficitTiempo, $registro, $registroSegundoDia, $maquina -> getMaqTiempoInyeccion(), '6');

        list($registro, $registroSegundoDia, $deficitTiempo) = RegistroUsoMaquinaPeer::dividirCurvasCalibracion($deficitTiempo, $registro, $registroSegundoDia, $maquina -> getMaqTiempoInyeccion(), '5');
        list($registro, $registroSegundoDia, $deficitTiempo) = RegistroUsoMaquinaPeer::dividirRetrabajosCurvasCalibracion($deficitTiempo, $registro, $registroSegundoDia, $maquina -> getMaqTiempoInyeccion(), '5');

        list($registro, $registroSegundoDia, $deficitTiempo) = RegistroUsoMaquinaPeer::dividirCurvasCalibracion($deficitTiempo, $registro, $registroSegundoDia, $maquina -> getMaqTiempoInyeccion(), '4');
        list($registro, $registroSegundoDia, $deficitTiempo) = RegistroUsoMaquinaPeer::dividirRetrabajosCurvasCalibracion($deficitTiempo, $registro, $registroSegundoDia, $maquina -> getMaqTiempoInyeccion(), '4');

        list($registro, $registroSegundoDia, $deficitTiempo) = RegistroUsoMaquinaPeer::dividirCurvasCalibracion($deficitTiempo, $registro, $registroSegundoDia, $maquina -> getMaqTiempoInyeccion(), '3');
        list($registro, $registroSegundoDia, $deficitTiempo) = RegistroUsoMaquinaPeer::dividirRetrabajosCurvasCalibracion($deficitTiempo, $registro, $registroSegundoDia, $maquina -> getMaqTiempoInyeccion(), '3');

        list($registro, $registroSegundoDia, $deficitTiempo) = RegistroUsoMaquinaPeer::dividirCurvasCalibracion($deficitTiempo, $registro, $registroSegundoDia, $maquina -> getMaqTiempoInyeccion(), '2');
        list($registro, $registroSegundoDia, $deficitTiempo) = RegistroUsoMaquinaPeer::dividirRetrabajosCurvasCalibracion($deficitTiempo, $registro, $registroSegundoDia, $maquina -> getMaqTiempoInyeccion(), '2');

        list($registro, $registroSegundoDia, $deficitTiempo) = RegistroUsoMaquinaPeer::dividirCurvasCalibracion($deficitTiempo, $registro, $registroSegundoDia, $maquina -> getMaqTiempoInyeccion(), '1');
        list($registro, $registroSegundoDia, $deficitTiempo) = RegistroUsoMaquinaPeer::dividirRetrabajosCurvasCalibracion($deficitTiempo, $registro, $registroSegundoDia, $maquina -> getMaqTiempoInyeccion(), '1');

        list($registro, $registroSegundoDia, $deficitTiempo) = RegistroUsoMaquinaPeer::dividirSystemSuitability($deficitTiempo, $registro, $registroSegundoDia, $maquina -> getMaqTiempoInyeccion());
        list($registro, $registroSegundoDia, $deficitTiempo) = RegistroUsoMaquinaPeer::dividirRetrabajosSystemSuitability($deficitTiempo, $registro, $registroSegundoDia, $maquina -> getMaqTiempoInyeccion());

        list($registro, $registroSegundoDia, $deficitTiempo) = RegistroUsoMaquinaPeer::dividirPerdidaAlistamiento($deficitTiempo, $registro, $registroSegundoDia);
	        
        if($deficitTiempo > 0)
        {            
                list($registro, $registroSegundoDia, $deficitTiempo) = RegistroUsoMaquinaPeer::dividirTiempoAlistamientoConDeficit($deficitTiempo, $registro, $registroSegundoDia);
        }
        else
        {
                list($registro, $registroSegundoDia, $deficitTiempo) = RegistroUsoMaquinaPeer::dividirTiempoAlistamientoSinDeficit($deficitTiempo, $registro, $registroSegundoDia);
        }
        
        $registro -> setRumHoraFinTrabajo('23:59:59.999');
        $registro -> setRumHoraFinTrabajoOriginal('23:59:59.999');
        $registro -> save();
        $registroSegundoDia -> save();
        
        return $this -> renderText('Ok');
    }

    public function executeListarRegistrosHistorial(sfWebRequest $request)
    {
        $result = array();
        $data = array();

        $criteria = new Criteria();
        $criteria -> clearSelectColumns();
        $criteria -> addJoin(RegistroModificacionPeer::REM_USU_CODIGO, UsuarioPeer::USU_CODIGO);
        $criteria -> addSelectColumn(UsuarioPeer::USU_LOGIN);
        $criteria -> addSelectColumn(RegistroModificacionPeer::REM_NOMBRE_CAMPO);
        $criteria -> addSelectColumn(RegistroModificacionPeer::REM_VALOR_ANTIGUO);
        $criteria -> addSelectColumn(RegistroModificacionPeer::REM_VALOR_NUEVO);
        $criteria -> addSelectColumn(RegistroModificacionPeer::REM_CAUSA);
        $criteria -> addSelectColumn(RegistroModificacionPeer::REM_FECHA_HORA);
        $criteria -> addAscendingOrderByColumn(RegistroModificacionPeer::REM_FECHA_HORA);

        if ($request -> hasParameter('codigo_rum'))
        {
            $criteria -> add(RegistroModificacionPeer::REM_RUM_CODIGO, $request -> getParameter('codigo_rum'));
        }

        $statement = RegistroModificacionPeer::doSelectStmt($criteria);

        $registros = $statement -> fetchAll(PDO::FETCH_NUM);

        foreach ($registros as $registro)
        {
            $fields = array();

            $fields['username'] = $registro[0];
            $fields['nombre_campo'] = $registro[1];
            $fields['valor_antiguo'] = $registro[2];
            $fields['valor_nuevo'] = $registro[3];
            $fields['causa'] = $registro[4];

            $dateTime = new DateTime($registro[5]);
            $timestamp = $dateTime -> getTimestamp();

            $fields['fecha'] = date('Y-m-d', $timestamp);
            $fields['hora'] = date('H:i:s', $timestamp);

            $data[] = $fields;
        }

        $result['data'] = $data;
        return $this -> renderText(json_encode($result));
    }

    public function executeListarOperarios()
    {
        $result = array();
        $data = array();

        $criteria = new Criteria();
        $criteria -> add(UsuarioPeer::USU_PER_CODIGO, 3);
        $operarios = UsuarioPeer::doSelect($criteria);

        foreach ($operarios as $operario)
        {
            $fields = array();
            $fields['codigo'] = $operario -> getUsuCodigo();

            $criteria = new Criteria();
            $criteria -> add(EmpleadoPeer::EMPL_USU_CODIGO, $operario -> getUsuCodigo());
            $empleado = EmpleadoPeer::doSelectOne($criteria);

            $fields['nombre'] = $empleado -> getNombreCompleto();
            $fields['identificacion'] = $empleado -> getEmplNumeroIdentificacion();

            $data[] = $fields;
        }

        $result['data'] = $data;
        return $this -> renderText(json_encode($result));
    }

    public function executeConsultarTiempoInyeccionMaquina(sfWebRequest $request)
    {
        $codigoMaquina = $request -> getParameter('codigo_maquina');
        $maquina = MaquinaPeer::retrieveByPK($codigoMaquina);

        return $this -> renderText($maquina -> getMaqTiempoInyeccion());
    }

    public function executeCalcularTiempoDisponibleDia(sfWebRequest $request)
    {
        $codigoMaquina = $request -> getParameter('codigo_maquina');
        $fecha = $request -> getParameter('fecha');

        $user = $this -> getUser();
        $codigo_usuario = $user -> getAttribute('usu_codigo');
        $criteria = new Criteria();
        $criteria -> add(EmpleadoPeer::EMPL_USU_CODIGO, $codigo_usuario);
        $operario = EmpleadoPeer::doSelectOne($criteria);
        $criteria = new Criteria();
        $criteria -> add(EmpresaPeer::EMP_CODIGO, $operario -> getEmplEmpCodigo());
        $empresa = EmpresaPeer::doSelectOne($criteria);

        $inyeccionesEstandarPromedio = $empresa -> getEmpInyectEstandarPromedio();

        $tiempoDisponibleHoras = RegistroUsoMaquinaPeer::calcularTiempoDisponibleHoras($codigoMaquina, $fecha, $inyeccionesEstandarPromedio);
        $tiempoDisponibleHoras = round($tiempoDisponibleHoras, 2);
        return $this -> renderText('' . $tiempoDisponibleHoras);
    }

    //Configuración Gráfico en Minutos
    public function executeGenerarConfiguracionGraficoMinutos(sfWebRequest $request)
    {
        $this -> renderText('<?xml version="1.0" encoding="UTF-8"?>');
        $this -> renderText('<settings>');
        $this -> renderText('<type>bar</type>');
        $this -> renderText('<data_type>csv</data_type>');
        $this -> renderText('<font>Tahoma</font>');
        $this -> renderText('<depth>10</depth>');
        $this -> renderText('<angle>45</angle>');
        
        $this -> renderText('
		<column>
			<type>stacked</type>
			<width>50</width>
			<spacing>0</spacing>
			<grow_time>1</grow_time>
			<grow_effect>regular</grow_effect>
			<data_labels><![CDATA[<b>{value}</b>]]></data_labels>
			<balloon_text><![CDATA[{title}: {value} minutos ]]></balloon_text>
		</column>');
        $this -> renderText('<background><border_alpha>15</border_alpha></background>');
        $this -> renderText('<plot_area>
                                <margins>
                                    <left>14</left>
                                    <top>40</top>
                                    <right>25</right>
                                    <bottom>0</bottom>
                                </margins>
                            </plot_area>');
        $this -> renderText('<grid>
                                <category>
                                 <alpha>5</alpha>
                                </category>
                                <value>
                                 <alpha>15</alpha>
                                 <approx_count>15</approx_count>
                                </value>
                            </grid>');
        $this -> renderText('<values>
                                <value>
                                    <min>0</min>
                                    <max>1440</max>
                                </value>
                            </values>');
        $this -> renderText('<axes>
		<category>
		  <width>1</width>
		</category>
		    <value>
			 <width>1</width>
		    </value>
		</axes>');
        $this -> renderText('<balloon>
		<alpha>80</alpha>
		<text_color>#000000</text_color>
		<max_width>300</max_width>
		<corner_radius>5</corner_radius>
		<border_width>3</border_width>
		<border_alpha>60</border_alpha>
		<border_color>#000000</border_color>
		</balloon>');
        $this -> renderText('<legend><width>1024</width>
		<max_columns>4</max_columns><spacing>5</spacing></legend>');

    require_once (dirname(__FILE__) . '/../../../../../config/variablesGenerales.php');
    $this -> renderText('<export_as_image>
    <file>' . $urlWeb . 'flash/amcolumn/export.php</file>     
    <color>#CC0000</color>                      
    <alpha>50</alpha>                           
    </export_as_image>');

    //Cambios: 24 de febrero de 2014
    //Modificaciones para que la gráfica incluya los TPNP registrados en eventos
    $codigoMaquina = $request -> getParameter('codigo_maquina');        
    $fecha = $request -> getParameter('fecha');
    $resultado = $this->generarTiemposGraficoMinutos($codigoMaquina, $fecha);
    $orden_tiempos = $resultado[1];    
    $tiempos_anteriores = array();
    $this -> renderText('<graphs>');   
    for($i=0; $i<sizeof($orden_tiempos); $i++) {
        if($orden_tiempos[$i] == 'TNP') {
            /* Verifica si el tiempo ha sido previamente grafico a fin de no colocar la etiqueta
               en la parte inferior de la gráfica*/
            $verificar = $this->verificarTiempo('TNP', $tiempos_anteriores);
            if($verificar == true) {
                $this -> renderText('<graph>
                <type>column</type>
                <title>TNP</title>
                <color>#ffdc44</color>
                <visible_in_legend>false</visible_in_legend>
                </graph>');
            } else {
                $this -> renderText('<graph>
                <type>column</type>
                <title>TNP</title>
                <color>#ffdc44</color>
                </graph>');
            }
              
        }
        if($orden_tiempos[$i] == 'TPP') {
            $verificar = $this->verificarTiempo('TPP', $tiempos_anteriores);
            if($verificar == true) {
                $this -> renderText('<graph>
                <type>column</type>
                <title>TPP</title>
                <color>#47d552</color>
                <visible_in_legend>false</visible_in_legend>
                </graph>');
            } else {
                $this -> renderText('<graph>
                <type>column</type>
                <title>TPP</title>
                <color>#47d552</color>
                </graph>');
            }
              
        }
        if($orden_tiempos[$i] == 'TPNP') {
            $verificar = $this->verificarTiempo('TPNP', $tiempos_anteriores);
            if($verificar == true) {
                $this -> renderText('<graph>
                <type>column</type>
                <title>TPNP</title>
                <color>#ff5454</color>
                <visible_in_legend>false</visible_in_legend>
                </graph>');
            } else {
                $this -> renderText('<graph>
                <type>column</type>
                <title>TPNP</title>
                <color>#ff5454</color>
                </graph>');
            }
              
        }
        if($orden_tiempos[$i] == 'TO') {
            $verificar = $this->verificarTiempo('TO', $tiempos_anteriores);
            if($verificar == true) {
                $this -> renderText('<graph>
                <type>column</type>
                <title>TO</title>
                <color>#72a8cd</color>
                <visible_in_legend>false</visible_in_legend>
                </graph>');
            } else {
                $this -> renderText('<graph>
                <type>column</type>
                <title>TO</title>
                <color>#72a8cd</color>
                </graph>');
            }
              
        }
        //Se guardan los tiempos que ya han sido graficados
        $tiempos_anteriores[] = $orden_tiempos[$i];
    }
    
      $this -> renderText('</graphs>');
      $this -> renderText('<labels>
      <label lid="1">
      <x>50%</x> 
      <y>10</y>
      <width>200</width>
      <align>left</align>
      <text>
      <![CDATA[<b>Tiempo (minutos)</b>]]>
      </text> 
      </label>
      </labels>');
      $this -> renderText('<guides>
      <guide>
      <behind>true</behind>
      <width>3</width>
      <start_value>1440</start_value>
      </guide>
      </guides>');
      return $this -> renderText('<settings>');
    }
    
    //Configuración Gráfico en Horas
    public function executeGenerarConfiguracionGraficoHoras(sfWebRequest $request)
    {
        $this -> renderText('<?xml version="1.0" encoding="UTF-8"?>');
        $this -> renderText('<settings>');
        $this -> renderText('<type>bar</type>');
        $this -> renderText('<data_type>csv</data_type>');
        $this -> renderText('<font>Tahoma</font>');
        $this -> renderText('<depth>10</depth>');
        $this -> renderText('<angle>45</angle>');
        
        $this -> renderText('
		<column>
			<type>stacked</type>
			<width>50</width>
			<spacing>0</spacing>
			<grow_time>1</grow_time>
			<grow_effect>regular</grow_effect>
			<data_labels><![CDATA[<b>{value}</b>]]></data_labels>
			<balloon_text><![CDATA[{title}: {value} horas ]]></balloon_text>
		</column>');
        $this -> renderText('<background><border_alpha>15</border_alpha></background>');
        $this -> renderText('<plot_area>
                                <margins>
                                    <left>14</left>
                                    <top>40</top>
                                    <right>25</right>
                                    <bottom>0</bottom>
                                </margins>
                            </plot_area>');
        $this -> renderText('<grid>
                                <category>
                                 <alpha>5</alpha>
                                </category>
                                <value>
                                 <alpha>15</alpha>
                                 <approx_count>15</approx_count>
                                </value>
                            </grid>');
        $this -> renderText('<values>
                                <value>
                                    <min>0</min>
                                    <max>24</max>
                                </value>
                            </values>');
        $this -> renderText('<axes>
		<category>
		  <width>1</width>
		</category>
		    <value>
			 <width>1</width>
		    </value>
		</axes>');
        $this -> renderText('<balloon>
		<alpha>80</alpha>
		<text_color>#000000</text_color>
		<max_width>300</max_width>
		<corner_radius>5</corner_radius>
		<border_width>3</border_width>
		<border_alpha>60</border_alpha>
		<border_color>#000000</border_color>
		</balloon>');
        $this -> renderText('<legend><width>1024</width>
		<max_columns>4</max_columns><spacing>5</spacing></legend>');

    require_once (dirname(__FILE__) . '/../../../../../config/variablesGenerales.php');
    $this -> renderText('<export_as_image>
    <file>' . $urlWeb . 'flash/amcolumn/export.php</file>     
    <color>#CC0000</color>                      
    <alpha>50</alpha>                           
    </export_as_image>');

    //Cambios: 24 de febrero de 2014
    //Modificaciones para que la gráfica incluya los TPNP registrados en eventos
    $codigoMaquina = $request -> getParameter('codigo_maquina');        
    $fecha = $request -> getParameter('fecha');
    $resultado = $this->generarTiemposGraficoMinutos($codigoMaquina, $fecha);
    $orden_tiempos = $resultado[1];    
    $tiempos_anteriores = array();
    $this -> renderText('<graphs>');   
    for($i=0; $i<sizeof($orden_tiempos); $i++) {
        if($orden_tiempos[$i] == 'TNP') {
            /* Verifica si el tiempo ha sido previamente grafico a fin de no colocar la etiqueta
               en la parte inferior de la gráfica*/
            $verificar = $this->verificarTiempo('TNP', $tiempos_anteriores);
            if($verificar == true) {
                $this -> renderText('<graph>
                <type>column</type>
                <title>TNP</title>
                <color>#ffdc44</color>
                <visible_in_legend>false</visible_in_legend>
                </graph>');
            } else {
                $this -> renderText('<graph>
                <type>column</type>
                <title>TNP</title>
                <color>#ffdc44</color>
                </graph>');
            }
              
        }
        if($orden_tiempos[$i] == 'TPP') {
            $verificar = $this->verificarTiempo('TPP', $tiempos_anteriores);
            if($verificar == true) {
                $this -> renderText('<graph>
                <type>column</type>
                <title>TPP</title>
                <color>#47d552</color>
                <visible_in_legend>false</visible_in_legend>
                </graph>');
            } else {
                $this -> renderText('<graph>
                <type>column</type>
                <title>TPP</title>
                <color>#47d552</color>
                </graph>');
            }
              
        }
        if($orden_tiempos[$i] == 'TPNP') {
            $verificar = $this->verificarTiempo('TPNP', $tiempos_anteriores);
            if($verificar == true) {
                $this -> renderText('<graph>
                <type>column</type>
                <title>TPNP</title>
                <color>#ff5454</color>
                <visible_in_legend>false</visible_in_legend>
                </graph>');
            } else {
                $this -> renderText('<graph>
                <type>column</type>
                <title>TPNP</title>
                <color>#ff5454</color>
                </graph>');
            }
              
        }
        if($orden_tiempos[$i] == 'TO') {
            $verificar = $this->verificarTiempo('TO', $tiempos_anteriores);
            if($verificar == true) {
                $this -> renderText('<graph>
                <type>column</type>
                <title>TO</title>
                <color>#72a8cd</color>
                <visible_in_legend>false</visible_in_legend>
                </graph>');
            } else {
                $this -> renderText('<graph>
                <type>column</type>
                <title>TO</title>
                <color>#72a8cd</color>
                </graph>');
            }
              
        }
        //Se guardan los tiempos que ya han sido graficados
        $tiempos_anteriores[] = $orden_tiempos[$i];
    }
    
      $this -> renderText('</graphs>');
      $this -> renderText('<labels>
      <label lid="1">
      <x>50%</x> 
      <y>10</y>
      <width>200</width>
      <align>left</align>
      <text>
      <![CDATA[<b>Tiempo (horas)</b>]]>
      </text> 
      </label>
      </labels>');
      $this -> renderText('<guides>
      <guide>
      <behind>true</behind>
      <width>3</width>
      <start_value>24</start_value>
      </guide>
      </guides>');
      return $this -> renderText('<settings>');
    }
    
    //Cambios: 24 de febrero de 2014
    //Calcula el orden y el valor de los tiempos que se grafican en la barra de tiempo
    public function generarTiemposGraficoMinutos($codigoMaquina, $fecha)
    {
        $user = $this -> getUser();
        $codigo_usuario = $user -> getAttribute('usu_codigo');

        $criteria1 = new Criteria();
        $criteria1 -> add(RegistroUsoMaquinaPeer::RUM_MAQ_CODIGO, $codigoMaquina);
        $criteria1 -> add(RegistroUsoMaquinaPeer::RUM_FECHA, $fecha);
        $criteria1 -> add(RegistroUsoMaquinaPeer::RUM_ELIMINADO, false);
        $criteria1 -> addAscendingOrderByColumn(RegistroUsoMaquinaPeer::RUM_TIEMPO_ENTRE_MODELO);
        $registros = RegistroUsoMaquinaPeer::doSelect($criteria1);

        $criteria2 = new Criteria();
        $criteria2 -> add(EmpleadoPeer::EMPL_USU_CODIGO, $codigo_usuario);
        $operario = EmpleadoPeer::doSelectOne($criteria2);
        
        $criteria3 = new Criteria();
        $criteria3 -> add(EmpresaPeer::EMP_CODIGO, $operario -> getEmplEmpCodigo());
        $empresa = EmpresaPeer::doSelectOne($criteria3);

        $criteria4 = new Criteria();
        $criteria4 -> add(MaquinaPeer::MAQ_CODIGO, $codigoMaquina);
        $maquina = MaquinaPeer::doSelectOne($criteria4);
        
        //Guarda la hora de inicio y la duración de los eventos
        $eventos = array();
        $pos_evento = 0;
        //Arreglo que guarda el orden en que se ejecutan los TNP, TPP, TPNP Y TO
        $orden_tiempos = array();
        //Guarda todos los tiempos TNP, TP, TO Y TPNP
        $tiempos = array();

        if (count($registros) == 0)
        {
            $tiempos[] = 0;
            $tiempos[] = 0;
            $tiempos[] = 0;
            $tiempos[] = 0;
            $orden_tiempos[] = 'TNP';
            $orden_tiempos[] = 'TPP';
            $orden_tiempos[] = 'TO';
            $orden_tiempos[] = 'TPNP';
        }
        
        $minutosActuales = 0;
        foreach ($registros as $registro)
        {
            $minutosTiempoNoProgramado = 0;
            $minutosTiempoNoProgramado += round($registro -> getRumTiempoEntreModelo('H') * 60 + $registro -> getRumTiempoEntreModelo('i') + ($registro -> getRumTiempoEntreModelo('s') / 60), 2);
            $minutosTiempoNoProgramado -= $minutosActuales;
            if(round($minutosTiempoNoProgramado, 2) != 0.00) {
                $tiempos[] = round($minutosTiempoNoProgramado, 2);
                $orden_tiempos[] = 'TNP';
            }            
            
            $minutosTiempoParadaProgramada = 0;
            $minutosTiempoParadaProgramada += $registro -> getRumTiempoCambioModelo();            
            //Verificar si existe un ahorro en el tiempo de alistamiento de la corrida analítica
            $tpnp_temp = $registro -> calcularPerdidaCambioMetodoAjusteMinutos();
            //Los tiempos que son negativos se toman como ahorros y se deben restar a los tiempos de alistamiento
            if($tpnp_temp < 0) {
                $minutosTiempoParadaProgramada += $tpnp_temp;
            }            
            if(round($minutosTiempoParadaProgramada, 2) != 0.00) {
                $tiempos[] = round($minutosTiempoParadaProgramada, 2);
                $orden_tiempos[] = 'TPP';
            }
            
            $minutosTiempoParadaNoProgramada1 = 0;
            //Cambios: 24 de febrero de 2014
            //Los tiempos que aparecen como pérdidas se suman a los TPNP siempre y cuando sean positivos
            if($tpnp_temp > 0) {
                $minutosTiempoParadaNoProgramada1 += $tpnp_temp;
            }
            //Se resta la duración de los eventos ocurridos a las pérdidas en el tiempo de alistamiento
            $duracion = $registro->calcularDuracionEventosCambioMetodo($registro->getRumCodigo()); 
            $minutosTiempoParadaNoProgramada1 -= $duracion;
            if(round($minutosTiempoParadaNoProgramada1) != 0) {
                $tiempos[] = round($minutosTiempoParadaNoProgramada1, 2);
                $orden_tiempos[] = 'TPNP';
            }            

            $ahorro = 0;
            //Se verifica si existe algún ahorro en los tiempos de funcionamiento solo si se ha ingresado la hora de finalización de la corrida
            if(($registro->getRumHoraInicioTrabajo()!='') && ($registro->getRumHoraFinTrabajo()!='')) {
                $maq_tiempo_inyeccion = $registro -> obtenerTiempoInyeccionMaquina();
                $TF_temp = ($registro->obtenerTFMetodo())*60;
                $TO_temp = ($registro->obtenerTOMetodo($maq_tiempo_inyeccion))*60;
                $TPNP_temp = $registro->calcularDuracionEventos($registro->getRumCodigo());
                //Se verifica si TF es menor a (TO+TPNP).  Si es menor, existe un ahorro en el TF
                $ahorro = $TF_temp - $TO_temp - $TPNP_temp;
                if(round($ahorro) < 0) {
                    $tiempos[] = round($ahorro, 2);
                    $orden_tiempos[] = 'TPNP';
                }
            }
            
            $minutosTiempoProgramado = 0;
            $inyeccionesEstandarPromedio = $empresa -> getEmpInyectEstandarPromedio();
            $minutosTiempoProgramado += ($registro -> getRumTiempoCorridaSistema() + $maquina -> getMaqTiempoInyeccion()) * $registro -> getRumNumeroInyeccionEstandar();            
            for ($i = 1; $i <= $inyeccionesEstandarPromedio; $i++)
            {
                $minutosTiempoProgramado += ($registro -> getRumTiempoCorridaCurvas() + $maquina -> getMaqTiempoInyeccion()) * eval('return $registro->getRumNumeroInyeccionEstandar' . $i . '();');
            }

            $minutosTiempoProgramado += ($registro -> getRumTcProductoTerminado() + $maquina -> getMaqTiempoInyeccion()) * $registro -> getRumNumMuestrasProducto() * $registro -> getRumNumInyecXMuestraProduc();
            $minutosTiempoProgramado += ($registro -> getRumTcEstabilidad() + $maquina -> getMaqTiempoInyeccion()) * $registro -> getRumNumMuestrasEstabilidad() * $registro -> getRumNumInyecXMuestraEstabi();
            $minutosTiempoProgramado += ($registro -> getRumTcMateriaPrima() + $maquina -> getMaqTiempoInyeccion()) * $registro -> getRumNumMuestrasMateriaPrima() * $registro -> getRumNumInyecXMuestraMateri();
            $minutosTiempoProgramado += ($registro -> getRumTcPureza() + $maquina -> getMaqTiempoInyeccion()) * $registro -> getRumNumMuestrasPureza() * $registro -> getRumNumInyecXMuestraPureza();
            $minutosTiempoProgramado += ($registro -> getRumTcDisolucion() + $maquina -> getMaqTiempoInyeccion()) * $registro -> getRumNumMuestrasDisolucion() * $registro -> getRumNumInyecXMuestraDisolu();
            $minutosTiempoProgramado += ($registro -> getRumTcUniformidad() + $maquina -> getMaqTiempoInyeccion()) * $registro -> getRumNumMuestrasUniformidad() * $registro -> getRumNumInyecXMuestraUnifor();
            //Se resta al TO el ahorro en el Tiempo de Funcionamiento
            if(round($ahorro) < 0) {
                $minutosTiempoProgramado += $ahorro;
            }            
            if(round($minutosTiempoProgramado, 2) != 0.00) {
                $tiempos[] = round($minutosTiempoProgramado, 2);
                $orden_tiempos[] = 'TO';
            }            
            
            //Cambios: 24 de febrero de 2014
            //Las reinyecciones se deben ingresar como evento para que sean tenidas en cuenta en la barra de tiempo
//            $minutosTiempoParadaNoProgramada2 += $registro -> calcularRetrabajosMinutos($inyeccionesEstandarPromedio);            
            //Cambios: 24 de febrero de 2014
            //Se quitó la columna fallas de la interfaz de ingreso de datos
//            $minutosTiempoParadaNoProgramada2 += $registro -> getRumFallas();
            //Cambios: 24 de febrero de 2014
            //Se calcula la duración de los eventos y se muestran en la barra de tiempos como TPNP
            $minutosTiempoParadaNoProgramada2 = $registro -> calcularParosMenoresMinutosConEvento($inyeccionesEstandarPromedio);
            if(round($minutosTiempoParadaNoProgramada2) != 0) {
                $tiempos[] = round($minutosTiempoParadaNoProgramada2, 2);
                $orden_tiempos[] = 'TPNP';
            }
            
            $minutosActuales = ($registro -> getRumHoraFinTrabajo('H') * 60) + $registro -> getRumHoraFinTrabajo('i') + ($registro -> getRumHoraFinTrabajo('s') / 60);
            
            //Cambios: 24 de febrero de 2014
            //Identificación de eventos por registro para sumarlos a los TPNP
            $criteria = new Criteria();
            $criteria->add(EventoEnRegistroPeer::EVRG_RUM_CODIGO, $registro->getRumCodigo());
            $criteria->addAscendingOrderByColumn(EventoEnRegistroPeer::EVRG_HORA_OCURRIO);
            $eventos_rum = EventoEnRegistroPeer::doSelect($criteria);
            foreach ($eventos_rum as $evento_rum) {
                if(round($evento_rum->getEvrgDuracion(), 2) != 0.00) {
                    $eventos[$pos_evento]['hora_inicio'] = $evento_rum->getEvrgHoraOcurrio();
                    $eventos[$pos_evento]['duracion'] = round($evento_rum->getEvrgDuracion(), 2);
                    $pos_evento++;
                }
            }
        }
        if (count($registros) != 0)
        {
            $tiempoDisponible = 0;
            $tiempoDisponible += RegistroUsoMaquinaPeer::calcularTiempoDisponibleHoras($codigoMaquina, $fecha, $inyeccionesEstandarPromedio, TRUE) * 60;
            if(round($tiempoDisponible, 2) != 0.00) {
                $tiempos[] = round($tiempoDisponible, 2);
                $orden_tiempos[] = 'TNP';
            }            
        }
        
        //Ingresar los tiempos de los eventos en la barra de tiempo
        for($i=0; $i<sizeof($eventos); $i++) {
            $total = 0;
            $temp_tiempos = array();
            $temp_orden = array();
            $horas = date('H', strtotime($eventos[$i]['hora_inicio']));
            $minutos = date('i', strtotime($eventos[$i]['hora_inicio']));
            //Hora de inicio del evento en minutos
            $hora_inicio = ($horas*60) + $minutos;            
            for($j=0; $j<sizeof($tiempos); $j++) {
                //Va sumando todos los tiempos TP, TPNP, TNP y TO
                $total += $tiempos[$j];
                if($total > $hora_inicio) {
                    /* Subir tres posiciones los elementos de $tiempos desde la posicion $j.
                       Lo mismo con el orden de los tiempos*/
                    for($k=($j+1); $k<sizeof($tiempos); $k++) {
                        $temp_tiempos[] = $tiempos[$k];
                        $temp_orden[] = $orden_tiempos[$k];
                    }
                    $var = $j+3;
                    for($m=0; $m<sizeof($temp_tiempos); $m++) {
                        $tiempos[$var] = $temp_tiempos[$m];
                        $orden_tiempos[$var] = $temp_orden[$m];
                        $var++;
                    }
                                        
                    /* Guardar los tiempos divididos y el tiempo del evento en el arreglo $tiempos.
                       Lo mismo con el orden de los tiempos */
                    $tiempo1 = $hora_inicio - ($total - $tiempos[$j]);
                    $tiempo2 = $tiempos[$j] - $tiempo1;                    
                    $tiempos[$j] = round($tiempo1, 2);
                    $tiempos[$j+1] = round($eventos[$i]['duracion'], 2);
                    $tiempos[$j+2] = round($tiempo2, 2);                    
                    $orden_tiempos[$j+1] = 'TPNP';
                    $orden_tiempos[$j+2] = $orden_tiempos[$j];
                    
                    $j = sizeof($tiempos);
                }
            }            
        }
        
        $resultado = array();
        $resultado[] = $tiempos;
        $resultado[] = $orden_tiempos;
        
        return $resultado;
    }
    
    //Generación de Datos Gráfico en Minutos
    public function executeGenerarDatosGraficoMinutos(sfWebRequest $request)
    {
        $codigoMaquina = $request -> getParameter('codigo_maquina');        
        $fecha = $request -> getParameter('fecha');
                
        $resultado = $this->generarTiemposGraficoMinutos($codigoMaquina, $fecha);
        $tiempos = $resultado[0];
        
        for($i=0; $i<sizeof($tiempos); $i++) {
            $this -> renderText(';' . $tiempos[$i]);
        }
        
        return $this -> renderText('');
    }
    
    //Generación de Datos Gráfico en Horas
    public function executeGenerarDatosGraficoHoras(sfWebRequest $request)
    {
        $codigoMaquina = $request -> getParameter('codigo_maquina');        
        $fecha = $request -> getParameter('fecha');
                
        $resultado = $this->generarTiemposGraficoMinutos($codigoMaquina, $fecha);
        $tiempos = $resultado[0];
        
        for($i=0; $i<sizeof($tiempos); $i++) {
            $this -> renderText(';' . round($tiempos[$i]/60, 2));
        }
        
        return $this -> renderText('');
    }
    
    public function executeIndex(sfWebRequest $request)
    {
        $user = $this -> getUser();
        $codigo_usuario = $user -> getAttribute('usu_codigo');
        $criteria = new Criteria();
        $criteria -> add(EmpleadoPeer::EMPL_USU_CODIGO, $codigo_usuario);
        $operario = EmpleadoPeer::doSelectOne($criteria);
        $criteria = new Criteria();
        $criteria -> add(EmpresaPeer::EMP_CODIGO, $operario -> getEmplEmpCodigo());
        $empresa = EmpresaPeer::doSelectOne($criteria);

        $this -> nombreEmpresa = $empresa -> getEmpNombre();
        $this -> urlLogo = $empresa -> getEmpLogoUrl();
        $this -> inyeccionesEstandarPromedio = $empresa -> getEmpInyectEstandarPromedio();

        $this -> esAdministrador = ($user -> getAttribute('usu_per_codigo') == '2') ? 'true' : 'false';
        $this -> esCoordinador = ($user -> getAttribute('usu_per_codigo') == '4') ? 'true' : 'false';
        
        //Cambios: 24 de febrero de 2014
        //Retorna el nombre del perfil de usuario en sesión
        $codigo_perfil = $user -> getAttribute('usu_per_codigo');
        if($codigo_perfil == 1) {
            $this -> perfilUsuario = 'Super Administrador';
        } else if($codigo_perfil == 2) {
            $this -> perfilUsuario = 'Administrador';
        } else if($codigo_perfil == 3) {
            $this -> perfilUsuario = 'Analista';
        } else if($codigo_perfil == 4) {
            $this -> perfilUsuario = 'Coordinador o Supervisor';
        }
    }

    public function executeConsultarDatosOperario()
    {
        $user = $this -> getUser();

        $result = array();
        $data = array();
        $fields = array();

        if ($user -> getAttribute('usu_per_codigo') == '3')
        {
            $codigo_usuario = $user -> getAttribute('usu_codigo');

            $criteria = new Criteria();
            $criteria -> add(EmpleadoPeer::EMPL_USU_CODIGO, $codigo_usuario);
            $operario = EmpleadoPeer::doSelectOne($criteria);

            $fields['codigo'] = $operario -> getEmplCodigo();
            $fields['nombre'] = $operario -> getNombreCompleto();
            $fields['identificacion'] = $operario -> getEmplNumeroIdentificacion();
        } else
        {
            $fields['codigo'] = '';
            $fields['nombre'] = '';
            $fields['identificacion'] = '';
        }

        $data[] = $fields;
        $result['data'] = $data;
        return $this -> renderText(json_encode($result));
    }

    public function executeListarEquiposPorComputador()
    {
        $user = $this -> getUser();
        $criteria = new Criteria();
        if ($user -> getAttribute('usu_per_codigo') == '3')
        {
            $criteria -> add(MaquinaPeer::MAQ_COM_CERTIFICADO, $user -> getAttribute('certificado'));
        }
        $criteria -> add(MaquinaPeer::MAQ_ELIMINADO, false);
        $maquinas = MaquinaPeer::doSelect($criteria);

        $result = array();
        $data = array();

        foreach ($maquinas as $maquina)
        {
            $fields = array();

            $fields['codigo'] = $maquina -> getMaqCodigo();
            $fields['nombre'] = $maquina -> getMaqNombre();
            $fields['codigo_inventario'] = $maquina -> getMaqCodigoInventario();

            $data[] = $fields;
        }

        $result['data'] = $data;
        return $this -> renderText(json_encode($result));
    }

    public function executeListarMaquinasPorComputador()
    {
        $user = $this -> getUser();
        $criteria = new Criteria();
        if ($user -> getAttribute('usu_per_codigo') == '3')
        {
            $criteria -> add(MaquinaPeer::MAQ_COM_CERTIFICADO, $user -> getAttribute('certificado'));
        }
        $maquinas = MaquinaPeer::doSelect($criteria);

        $result = array();
        $data = array();

        foreach ($maquinas as $maquina)
        {
            $fields = array();
            
            $fields['codigo'] = $maquina -> getMaqCodigo();
            $fields['nombre'] = $maquina -> getMaqNombre();
            $fields['codigo_inventario'] = $maquina -> getMaqCodigoInventario();

            $data[] = $fields;
        }

        $result['data'] = $data;
        return $this -> renderText(json_encode($result));
    }

    public function executeEliminarRegistroEvento(sfWebRequest $request)
    {        
        $user = $this -> getUser();
        $codigo_perfil_usuario = $user -> getAttribute('usu_per_codigo');
        
        if ($request -> hasParameter('codigo'))
        {
            $registroEvento = EventoEnRegistroPeer::retrieveByPK($request -> getParameter('codigo'));

            $registro = RegistroUsoMaquinaPeer::retrieveByPK($registroEvento -> getEvrgRumCodigo());

            $dateTimeFechaUso = new DateTime($registro -> getRumFecha('Y-m-d'));
            $timeStampFechaUso = $dateTimeFechaUso -> getTimestamp();
            $dateTimeFechaActual = new DateTime(date('Y-m-d'));
            $timeStampFechaActual = $dateTimeFechaActual -> getTimestamp();

            if (($timeStampFechaUso < $timeStampFechaActual) && ($codigo_perfil_usuario!='2'))
            {
                return $this -> renderText('No es posible eliminar un evento con fecha pasada');
            }

            $registroEvento -> delete();
        }
        return $this -> renderText('Ok');
    }

    public function executeListarCategoriasEventos()
    {
        $criteria = new Criteria();
        $criteria -> add(CategoriaEventoPeer::CAT_ELIMINADO, 0);        
        $categorias = CategoriaEventoPeer::doSelect($criteria);

        $result = array();
        $data = array();

        foreach ($categorias as $categoria)
        {
            $fields = array();

            $fields['codigo'] = $categoria -> getCatCodigo();
            $fields['nombre'] = $categoria -> getCatNombre();

            $data[] = $fields;
        }

        $result['data'] = $data;
        return $this -> renderText(json_encode($result));
    }

    public function executeListarEventosPorCategoria(sfWebRequest $request)
    {        
        $criteria = new Criteria();
        $criteria -> addJoin(EventoPeer::EVE_CODIGO, EventoPorCategoriaPeer::EVCA_EVE_CODIGO);
        $criteria -> add(EventoPorCategoriaPeer::EVCA_CAT_CODIGO, $request -> getParameter('codigo_categoria'));
        $criteria -> add(EventoPeer::EVE_ELIMINADO, 0);
        $eventos = EventoPeer::doSelect($criteria);

        $result = array();
        $data = array();

        foreach ($eventos as $evento)
        {
            $fields = array();
            $fields['codigo'] = $evento -> getEveCodigo();
            $fields['nombre'] = $evento -> getEveNombre();

            $data[] = $fields;
        }

        $result['data'] = $data;
        return $this -> renderText(json_encode($result));
    }

    public function executeListarEventos()
    {
        $criteria = new Criteria();
        $criteria->add(EventoPeer::EVE_ELIMINADO, 0);
        $eventos = EventoPeer::doSelect($criteria);

        $result = array();
        $data = array();

        foreach ($eventos as $evento)
        {
            $fields = array();
            $fields['codigo'] = $evento -> getEveCodigo();
            $fields['nombre'] = $evento -> getEveNombre();

            $data[] = $fields;
        }

        $result['data'] = $data;
        return $this -> renderText(json_encode($result));
    }

    public function executeModificarRegistroEvento(sfWebRequest $request)
    {
        $user = $this -> getUser();
        $codigo_perfil_usuario = $user -> getAttribute('usu_per_codigo');
        $registro = RegistroUsoMaquinaPeer::retrieveByPK($request -> getParameter('codigo_rum'));

        $dateTimeFechaUso = new DateTime($registro -> getRumFecha('Y-m-d'));
        $timeStampFechaUso = $dateTimeFechaUso -> getTimestamp();
        $dateTimeFechaActual = new DateTime(date('Y-m-d'));
        $timeStampFechaActual = $dateTimeFechaActual -> getTimestamp();

        if (($timeStampFechaUso < $timeStampFechaActual) && ($codigo_perfil_usuario!='2'))
        {
            return $this -> renderText('No es posible adicionar/modificar un evento con una fecha pasada');
        }

        $registroEvento = null;
        if ($request -> getParameter('codigo') == '')
        {
            $registroEvento = new EventoEnRegistro();
            $registroEvento -> setEvrgRumCodigo($request -> getParameter('codigo_rum'));
            $registroEvento -> setEvrgHoraRegistro(date('H:i'));
            $registroEvento -> setEvrgEveCodigo($request -> getParameter('codigo_evento'));
        } else
        {
            $registroEvento = EventoEnRegistroPeer::retrieveByPK($request -> getParameter('codigo'));
        }
        $registroEvento -> setEvrgEveCodigo($request -> getParameter('id_evento'));

        
        $registroEvento -> setEvrgHoraOcurrio($request->getParameter('hora_inicio'));
        $hora_inicio = $registroEvento -> getEvrgHoraOcurrio('H:i');
        
        
        //Cambios: 24 de febrero de 2014
        //Se obtiene la hora de inicio del tiempo de alistamiento de la corrida
        $tiempo_inicio = $registro->getRumTiempoEntreModelo('H:i:s');
        //Se calcula la hora de fin del tiempo de alistamiento de la corrida
        $tiempo_cambio = round($registro->getRumTiempoCambioModelo());
        //Se verifica si hubo ahorros en los tiempos de alistamiento y se lo suma a la duración del tiempo de alistamiento
        $perdidas = $registro -> calcularPerdidaCambioMetodoAjusteMinutos();
        if($perdidas < 0) {
            $tiempo_cambio += $perdidas;
        }
        $tiempo_fin = date('H:i:s',strtotime($tiempo_cambio.' minute', strtotime($tiempo_inicio)));
        
        //Cambios: 24 de febrero de 2014        
        $hora_fin = $request -> getParameter('hora_fin');
        if($hora_fin != '') {
            //Se verifica si el evento ocurrió en un tiempo de alistamiento. Si así fue, se registra tal cual se ingresó
            if(($hora_inicio>=$tiempo_inicio) && ($hora_inicio<=$tiempo_fin)){
                $hora_fin_total = $hora_fin;
            }
             //Se resta a la hora de fin ingresada el tiempo de inyección de la máquina
            else {
                $hora_fin_total = $this->operarHoraTiempoInyeccion($registro, $hora_fin, '-');            
            }            
            $registroEvento -> setEvrgHoraFin($hora_fin_total);
        }
        else {
            $registroEvento -> setEvrgHoraFin($request -> getParameter('hora_fin'));
        }
        
        
        //Cambios: 24 de febrero de 2014
        //Cálculo de la duración del evento
        $horaInicio = $hora_inicio;
        $horaFin = $hora_fin_total;
        $horas1 = date('H', strtotime($horaInicio));
        $horas2 = date('H', strtotime($horaFin));
        $minutos1 = date('i', strtotime($horaInicio));
        $minutos2 = date('i', strtotime($horaFin));
        $duracion = 0;
        //Tienen la misma hora pero pueden tener diferentes minutos
        if(($horas2 - $horas1) == 0) {
            //Se restan los segundos entre la hora de fin y la hora de inicio
            $duracion = $minutos2 - $minutos1;
        }
        //Tienen diferente hora
        else {
            $duracion = ((60 - $minutos1)+$minutos2)+((($horas2-$horas1)-1)*60);
        }
        $registroEvento -> setEvrgDuracion($duracion);
        
        
        $registroEvento -> setEvrgObservaciones($request -> getParameter('observaciones'));
        $registroEvento -> save();
        return $this -> renderText('Ok');
    }

    public function executeListarRegistrosEventos(sfWebRequest $request)
    {
        $criteria = new Criteria();
        if ($request -> hasParameter('codigo_rum'))
        {
            $criteria -> add(EventoEnRegistroPeer::EVRG_RUM_CODIGO, $request -> getParameter('codigo_rum'));
        }
        $registrosEventos = EventoEnRegistroPeer::doSelect($criteria);
        
        $registro = RegistroUsoMaquinaPeer::retrieveByPK($request -> getParameter('codigo_rum'));

        $result = array();
        $data = array();

        foreach ($registrosEventos as $registroEvento)
        {
            $fields = array();
            $fields['codigo'] = $registroEvento -> getEvrgCodigo();
            $fields['id_evento'] = $registroEvento -> getEvrgEveCodigo();   
            
            $hora_inicio = $registroEvento -> getEvrgHoraOcurrio('H:i');
            $fields['hora_inicio'] = $hora_inicio;
            
            //Cambios: 24 de febrero de 2014
            //Se obtiene la hora de inicio del tiempo de alistamiento de la corrida
            $tiempo_inicio = $registro->getRumTiempoEntreModelo('H:i:s');
            //Se calcula la hora de fin del tiempo de alistamiento de la corrida
            $tiempo_cambio = round($registro->getRumTiempoCambioModelo());
            //Se verifica si hubo ahorros en los tiempos de alistamiento y se lo suma a la duración del tiempo de alistamiento
            $perdidas = $registro -> calcularPerdidaCambioMetodoAjusteMinutos();
            if($perdidas < 0) {
                $tiempo_cambio += $perdidas;
            }
            $tiempo_fin = date('H:i:s',strtotime($tiempo_cambio.' minute', strtotime($tiempo_inicio)));

            //Cambios: 24 de febrero de 2014        
            $hora_fin = $registroEvento -> getEvrgHoraFin('H:i:s');
            if($hora_fin != '') {
                //Se verifica si el evento ocurrió en un tiempo de alistamiento.  Si así fue, se registra tal cual se ingresó
                //Si((hora de inicio del evento >= hora de inicio del tiempo de alistamiento)&&(hora de inicio del evento <= hora de finalización del tiempo de alistamiento))
                if(($hora_inicio>=$tiempo_inicio) && ($hora_inicio<=$tiempo_fin)){
                    $hora_fin_total = $hora_fin;
                }
                 //Se resta a la hora de fin ingresada el tiempo de inyección de la máquina
                else {
                    $hora_fin_total = $this->operarHoraTiempoInyeccion($registro, $hora_fin, '+');            
                }            
                $fields['hora_fin'] = date('H:i', strtotime($hora_fin_total));
            }
            else {
                $fields['hora_fin'] = $registroEvento -> getEvrgHoraFin('H:i:s');
            }
            
            $fields['hora_fin_corregida'] = $registroEvento -> getEvrgHoraFin('H:i');
            $fields['evrg_duracion'] = number_format($registroEvento -> getEvrgDuracion(), 2, '.', '');
            $fields['observaciones'] = $registroEvento -> getEvrgObservaciones();

            $data[] = $fields;
        }

        $result['data'] = $data;
        return $this -> renderText(json_encode($result));
    }

    public function executeEliminarRegistroUsoMaquina(sfWebRequest $request)
    {
        $user = $this -> getUser();
        $codigo_perfil_usuario = $user -> getAttribute('usu_per_codigo');
        
        if ($request -> hasParameter('id_registro_uso_maquina'))
        {
            $registro = RegistroUsoMaquinaPeer::retrieveByPK($request -> getParameter('id_registro_uso_maquina'));

            $dateTimeFechaUso = new DateTime($registro -> getRumFecha('Y-m-d'));
            $timeStampFechaUso = $dateTimeFechaUso -> getTimestamp();
            $dateTimeFechaActual = new DateTime(date('Y-m-d'));
            $timeStampFechaActual = $dateTimeFechaActual -> getTimestamp();
            
            if (($timeStampFechaUso < $timeStampFechaActual) && ($codigo_perfil_usuario!='2'))
            {
                return $this -> renderText('No es posible eliminar un registro con una fecha pasada');
            }

            $user = $this -> getUser();
            $codigo_usuario = $user -> getAttribute('usu_codigo');
            $registro -> setRumUsuCodigoElimino($codigo_usuario);
            $registro -> setRumCausaEliminacion($request -> getParameter('causa'));
            $registro -> setRumFechaHoraElimSistema(date('Y-m-d H:i:s'));
            $registro -> setRumEliminado(true);
            $registro -> save();
            //			$registro->delete();
        }
        return $this -> renderText('Ok');
    }

    public function executeModificarRegistroUsoMaquina(sfWebRequest $request)
    {
        if ($request -> hasParameter('id_registro_uso_maquina'))
        {
            $registro = RegistroUsoMaquinaPeer::retrieveByPK($request -> getParameter('id_registro_uso_maquina'));

            $dateTimeFechaUso = new DateTime($registro -> getRumFecha('Y-m-d'));
            $timeStampFechaUso = $dateTimeFechaUso -> getTimestamp();
            $dateTimeFechaActual = new DateTime(date('Y-m-d'));
            $timeStampFechaActual = $dateTimeFechaActual -> getTimestamp();
            $timeStampDiaAnterior = $timeStampFechaActual - 86400;

            $user = $this -> getUser();

            if ($timeStampFechaUso < $timeStampDiaAnterior && $user -> getAttribute('usu_per_codigo') == '3')
            {
                return $this -> renderText('1');
            }

            $codigo_usuario = $user -> getAttribute('usu_codigo');
            $usuario = $this -> getUser();
            $codigo_perfil = $usuario -> getAttribute('usu_per_codigo');
            
            //Cambios: 24 de febrero de 2014
            //El usuario con perfil Coordinador puede visualizar pero no puede modificar datos de corridas analíticas
            if($codigo_perfil == '4') {
                return $this -> renderText('2');
            }

            $registroModificacion = new RegistroModificacion();
            $registroModificacion -> setRemUsuCodigo($codigo_usuario);
            $registroModificacion -> setRemRumCodigo($registro -> getRumCodigo());
            $registroModificacion -> setRemFechaHora(date('Y-m-d H:i:s'));

            if ($request -> hasParameter('tiempo_entre_metodos'))
            {
                $registroModificacion -> setRemNombreCampo('Tiempo entre metodos');
                $registroModificacion -> setRemValorAntiguo('' . $registro -> getRumTiempoEntreModelo('H:i:s'));
                $registro -> setRumTiempoEntreModelo($request -> getParameter('tiempo_entre_metodos'));
                $registroModificacion -> setRemValorNuevo('' . $registro -> getRumTiempoEntreModelo('H:i:s'));
            }
            if ($request -> hasParameter('tiempo_corrida_ss'))
            {
                $registroModificacion -> setRemNombreCampo('Tiempo de corrida - System suitability');
                $registroModificacion -> setRemValorAntiguo('' . $registro -> getRumTiempoCorridaSistema());
                $registro -> setRumTiempoCorridaSistema($request -> getParameter('tiempo_corrida_ss'));
                $registroModificacion -> setRemValorNuevo('' . $registro -> getRumTiempoCorridaSistema());
            }
            if ($request -> hasParameter('tiempo_corrida_cc'))
            {
                $registroModificacion -> setRemNombreCampo('Tiempo de corrida - Curva de calibración');
                $registroModificacion -> setRemValorAntiguo('' . $registro -> getRumTiempoCorridaCurvas());
                $registro -> setRumTiempoCorridaCurvas($request -> getParameter('tiempo_corrida_cc'));
                $registroModificacion -> setRemValorNuevo('' . $registro -> getRumTiempoCorridaCurvas());
            }
            //Estándares            
            if($codigo_perfil == '2' || $codigo_perfil == '3')
            {
                //Cambios: 24 de febrero de 2014
                /* El número de estándares de un método puede modificarse por un usuario administrador o analista
                 * siempre y cuando el valor ingresado sea menor al valor original de estándar */
                //Se obtiene el método registrado
                $metodo = MetodoPeer::retrieveByPK($registro->getRumMetCodigo());
                if($request->hasParameter('numero_inyecciones_estandar1') && ($request->getParameter('numero_inyecciones_estandar1') <= $metodo->getMetNumInyeccionEstandar1()))
                {
                    $registroModificacion -> setRemNombreCampo('Número de Inyecciones Estándar 1');
                    $registroModificacion -> setRemValorAntiguo('' . $registro ->getRumNumeroInyeccionEstandar1());
                    $registro -> setRumNumeroInyeccionEstandar1($request -> getParameter('numero_inyecciones_estandar1'));
                    $registroModificacion -> setRemValorNuevo('' . $registro -> getRumNumeroInyeccionEstandar1());
                }
                if($request->hasParameter('numero_inyecciones_estandar2') && ($request->getParameter('numero_inyecciones_estandar2') <= $metodo->getMetNumInyeccionEstandar2()))
                {
                    $registroModificacion -> setRemNombreCampo('Número de Inyecciones Estándar 2');
                    $registroModificacion -> setRemValorAntiguo('' . $registro ->getRumNumeroInyeccionEstandar2());
                    $registro -> setRumNumeroInyeccionEstandar2($request -> getParameter('numero_inyecciones_estandar2'));
                    $registroModificacion -> setRemValorNuevo('' . $registro -> getRumNumeroInyeccionEstandar2());
                }
                if($request->hasParameter('numero_inyecciones_estandar3') && ($request->getParameter('numero_inyecciones_estandar3') <= $metodo->getMetNumInyeccionEstandar3()))
                {
                    $registroModificacion -> setRemNombreCampo('Número de Inyecciones Estándar 3');
                    $registroModificacion -> setRemValorAntiguo('' . $registro ->getRumNumeroInyeccionEstandar3());
                    $registro -> setRumNumeroInyeccionEstandar3($request -> getParameter('numero_inyecciones_estandar3'));
                    $registroModificacion -> setRemValorNuevo('' . $registro -> getRumNumeroInyeccionEstandar3());
                }
                if($request->hasParameter('numero_inyecciones_estandar4') && ($request->getParameter('numero_inyecciones_estandar4') <= $metodo->getMetNumInyeccionEstandar4()))
                {
                    $registroModificacion -> setRemNombreCampo('Número de Inyecciones Estándar 4');
                    $registroModificacion -> setRemValorAntiguo('' . $registro ->getRumNumeroInyeccionEstandar4());
                    $registro -> setRumNumeroInyeccionEstandar4($request -> getParameter('numero_inyecciones_estandar4'));
                    $registroModificacion -> setRemValorNuevo('' . $registro -> getRumNumeroInyeccionEstandar4());
                }
                if($request->hasParameter('numero_inyecciones_estandar5') && ($request->getParameter('numero_inyecciones_estandar5') <= $metodo->getMetNumInyeccionEstandar5()))
                {
                    $registroModificacion -> setRemNombreCampo('Número de Inyecciones Estándar 5');
                    $registroModificacion -> setRemValorAntiguo('' . $registro ->getRumNumeroInyeccionEstandar5());
                    $registro -> setRumNumeroInyeccionEstandar5($request -> getParameter('numero_inyecciones_estandar5'));
                    $registroModificacion -> setRemValorNuevo('' . $registro -> getRumNumeroInyeccionEstandar5());
                }
                if($request->hasParameter('numero_inyecciones_estandar6') && ($request->getParameter('numero_inyecciones_estandar6') <= $metodo->getMetNumInyeccionEstandar6()))
                {
                    $registroModificacion -> setRemNombreCampo('Número de Inyecciones Estándar 6');
                    $registroModificacion -> setRemValorAntiguo('' . $registro ->getRumNumeroInyeccionEstandar6());
                    $registro -> setRumNumeroInyeccionEstandar6($request -> getParameter('numero_inyecciones_estandar6'));
                    $registroModificacion -> setRemValorNuevo('' . $registro -> getRumNumeroInyeccionEstandar6());
                }
            }
            
            if ($request -> hasParameter('tiempo_corrida_producto'))
            {
                $registroModificacion -> setRemNombreCampo('Tiempo de corrida - Producto');
                $registroModificacion -> setRemValorAntiguo('' . $registro -> getRumTcProductoTerminado());

                $registro -> setRumTcProductoTerminado($request -> getParameter('tiempo_corrida_producto'));

                $registroModificacion -> setRemValorNuevo('' . $registro -> getRumTcProductoTerminado());
            }
            if ($request -> hasParameter('tiempo_corrida_estabilidad'))
            {
                $registroModificacion -> setRemNombreCampo('Tiempo de corrida - Estabilidad');
                $registroModificacion -> setRemValorAntiguo('' . $registro -> getRumTcEstabilidad());

                $registro -> setRumTcEstabilidad($request -> getParameter('tiempo_corrida_estabilidad'));

                $registroModificacion -> setRemValorNuevo('' . $registro -> getRumTcEstabilidad());
            }
            if ($request -> hasParameter('tiempo_corrida_materia_prima'))
            {
                $registroModificacion -> setRemNombreCampo('Tiempo de corrida - Materia prima');
                $registroModificacion -> setRemValorAntiguo('' . $registro -> getRumTcMateriaPrima());

                $registro -> setRumTcMateriaPrima($request -> getParameter('tiempo_corrida_materia_prima'));

                $registroModificacion -> setRemValorNuevo('' . $registro -> getRumTcMateriaPrima());
            }
            if ($request -> hasParameter('tiempo_corrida_pureza'))
            {
                $registroModificacion -> setRemNombreCampo('Tiempo de corrida - Pureza');
                $registroModificacion -> setRemValorAntiguo('' . $registro -> getRumTcPureza());

                $registro -> setRumTcPureza($request -> getParameter('tiempo_corrida_pureza'));

                $registroModificacion -> setRemValorNuevo('' . $registro -> getRumTcPureza());
            }
            if ($request -> hasParameter('tiempo_corrida_disolucion'))
            {
                $registroModificacion -> setRemNombreCampo('Tiempo de corrida - Disolución');
                $registroModificacion -> setRemValorAntiguo('' . $registro -> getRumTcDisolucion());

                $registro -> setRumTcDisolucion($request -> getParameter('tiempo_corrida_disolucion'));

                $registroModificacion -> setRemValorNuevo('' . $registro -> getRumTcDisolucion());
            }
            if ($request -> hasParameter('tiempo_corrida_uniformidad'))
            {
                $registroModificacion -> setRemNombreCampo('Tiempo de corrida - Uniformidad');
                $registroModificacion -> setRemValorAntiguo('' . $registro -> getRumTcUniformidad());

                $registro -> setRumTcUniformidad($request -> getParameter('tiempo_corrida_uniformidad'));

                $registroModificacion -> setRemValorNuevo('' . $registro -> getRumTcUniformidad());
            }
            if ($request -> hasParameter('numero_muestras_producto'))
            {
                $registroModificacion -> setRemNombreCampo('Número muestras - Producto');
                $registroModificacion -> setRemValorAntiguo('' . $registro -> getRumNumMuestrasProducto());

                $registro -> setRumNumMuestrasProducto($request -> getParameter('numero_muestras_producto'));

                $registroModificacion -> setRemValorNuevo('' . $registro -> getRumNumMuestrasProducto());
            }            
            if ($request -> hasParameter('numero_muestras_estabilidad'))
            {
                $registroModificacion -> setRemNombreCampo('Número muestras - Estabilidad');
                $registroModificacion -> setRemValorAntiguo('' . $registro -> getRumNumMuestrasEstabilidad());

                $registro -> setRumNumMuestrasEstabilidad($request -> getParameter('numero_muestras_estabilidad'));

                $registroModificacion -> setRemValorNuevo('' . $registro -> getRumNumMuestrasEstabilidad());
            }
            
            if ($request -> hasParameter('numero_muestras_materia_prima'))
            {
                $registroModificacion -> setRemNombreCampo('Número muestras - Materia prima');
                $registroModificacion -> setRemValorAntiguo('' . $registro -> getRumNumMuestrasMateriaPrima());

                $registro -> setRumNumMuestrasMateriaPrima($request -> getParameter('numero_muestras_materia_prima'));

                $registroModificacion -> setRemValorNuevo('' . $registro -> getRumNumMuestrasMateriaPrima());
            }
            
            if ($request -> hasParameter('numero_muestras_pureza'))
            {
                $registroModificacion -> setRemNombreCampo('Número muestras - Pureza');
                $registroModificacion -> setRemValorAntiguo('' . $registro -> getRumNumMuestrasPureza());

                $registro -> setRumNumMuestrasPureza($request -> getParameter('numero_muestras_pureza'));

                $registroModificacion -> setRemValorNuevo('' . $registro -> getRumNumMuestrasPureza());
            }
            if ($request -> hasParameter('numero_muestras_disolucion'))
            {
                $registroModificacion -> setRemNombreCampo('Número muestras - Disolución');
                $registroModificacion -> setRemValorAntiguo('' . $registro -> getRumNumMuestrasDisolucion());

                $registro -> setRumNumMuestrasDisolucion($request -> getParameter('numero_muestras_disolucion'));

                $registroModificacion -> setRemValorNuevo('' . $registro -> getRumNumMuestrasDisolucion());
            }
            if ($request -> hasParameter('numero_muestras_uniformidad'))
            {
                $registroModificacion -> setRemNombreCampo('Número muestras - Uniformidad');
                $registroModificacion -> setRemValorAntiguo('' . $registro -> getRumNumMuestrasUniformidad());

                $registro -> setRumNumMuestrasUniformidad($request -> getParameter('numero_muestras_uniformidad'));

                $registroModificacion -> setRemValorNuevo('' . $registro -> getRumNumMuestrasUniformidad());
            }
            if ($request -> hasParameter('hora_inicio_corrida'))
            {
                $hora_inicio = $request -> getParameter('hora_inicio_corrida');  
                //Cambios: 24 de febrero de 2014
                /* Cuando el método de la corrida es un mantenimiento, se registra en la hora de fin de la corrida
                   el mismo valor de la hora de inicio de la corrida ingresada */
                $cod_metodo = $registro->getRumMetCodigo();
                $metodo = MetodoPeer::retrieveByPK($cod_metodo);
                if($metodo->getMetMantenimiento() == 1) {
                                  
                    $registroModificacion -> setRemNombreCampo('Hora inicio');
                    $registroModificacion -> setRemValorAntiguo('' . $registro -> getRumHoraInicioTrabajo('H:i:s'));
                    $registro -> setRumHoraInicioTrabajo($hora_inicio);
                    $registroModificacion -> setRemValorNuevo('' . $registro -> getRumHoraInicioTrabajo('H:i:s'));
                    
                    $hora_fin = $request -> getParameter('hora_inicio_corrida');
                    $registroModificacion -> setRemNombreCampo('Hora fin');
                    $registroModificacion -> setRemValorAntiguo('' . $registro -> getRumHoraFinTrabajo('H:i:s'));
                    $registro -> setRumHoraFinTrabajo($hora_fin);
                    $registroModificacion -> setRemValorNuevo('' . $registro -> getRumHoraFinTrabajo('H:i:s'));
                    //Se registra el valor ingresado en la columna rum_hora_fin_trabajo_original
                    $registro -> setRumHoraFinTrabajoOriginal($hora_fin);
                }
                else {
                    //Cambios: 24 de febrero de 2014
                    //Restar a la hora de inicio ingresada el tiempo de inyección de la máquina
                    $hora_total = $this->operarHoraTiempoInyeccion($registro, $hora_inicio, '-');

                    $registroModificacion -> setRemNombreCampo('Hora inicio');
                    $registroModificacion -> setRemValorAntiguo('' . $registro -> getRumHoraInicioTrabajo('H:i:s'));
                    $registro -> setRumHoraInicioTrabajo($hora_total);
                    $registroModificacion -> setRemValorNuevo('' . $registro -> getRumHoraInicioTrabajo('H:i:s'));
                }
                //Cambios: 24 de febrero deo 2014
                //Registrar la hora inicio sin corregir en la columna rum_hora_inicio_trabajo_original
                $registro -> setRumHoraInicioTrabajoOriginal($hora_inicio);                
            }
            if ($request -> hasParameter('hora_fin_corrida'))
            {
                $hora_fin = $request -> getParameter('hora_fin_corrida');
                //Sumar a la hora de fin el tiempo de la corrida                
                $hora_total = $this->operarHoraTiempoCorrida($registro, $hora_fin, '+');
                //Se obtiene la fecha actual
                $fecha_actual = date('Y-m-d');
                //Se suma a la fecha actual la hora fin ingresada
                $horas_hora_ing = date('H', strtotime($hora_fin));
                $mins_hora_ing = date('i', strtotime($hora_fin));
                $segs_hora_ing = date('s', strtotime($hora_fin));
                $fecha_actual_hora = date('Y-m-d H:i:s', strtotime('+ '.$horas_hora_ing.' hour', strtotime($fecha_actual)));
                $fecha_actual_min = date('Y-m-d H:i:s', strtotime('+ '.$mins_hora_ing.' minute', strtotime($fecha_actual_hora)));
                $fecha_final_ing = date('Y-m-d H:i:s', strtotime('+ '.$segs_hora_ing.' second', strtotime($fecha_actual_min)));
                
                //Se obtiene el tiempo de corrida del método y se suma ese tiempo a la variable $fecha_final_ing
                $tc = array();
                $tc[] = number_format($registro -> getRumTcUniformidad(), 2, '.', '');
                $tc[] = number_format($registro -> getRumTcDisolucion(), 2, '.', '');
                $tc[] = number_format($registro -> getRumTcPureza(), 2, '.', '');
                $tc[] = number_format($registro -> getRumTcMateriaPrima(), 2, '.', '');
                $tc[] = number_format($registro -> getRumTcEstabilidad(), 2, '.', '');
                $tc[] = number_format($registro -> getRumTcProductoTerminado(), 2, '.', '');
                $tiempo_corrida_min = 0;
                $tiempo_corrida_seg = 0;
                for($i=0; $i<sizeof($tc); $i++) {
                    if($tc[$i] != 0.00) {
                        $tiempo_corrida_min += (int) ($tc[$i]);
                        $tiempo_corrida_seg += round(($tc[$i]-$tiempo_corrida_min)*60);
                        $i = sizeof($tc);
                    }
                }
                //Se suman a la variable $fecha_final_ing los minutos y segundos del tiempo de corrida
                $fecha_final_minutos = date('Y-m-d H:i', strtotime('+ '.$tiempo_corrida_min.' minute', strtotime($fecha_final_ing)));                
                $fecha_final_tc = date('Y-m-d H:i', strtotime('+ '.$tiempo_corrida_seg.' second', strtotime($fecha_final_minutos)));

                //Se cambia la fecha ingresada y la fecha que incluye el tiempo de corrida al formato 'Y-m-d'
                $fecha_ing_ymd = date('Y-m-d', strtotime($fecha_final_ing));
                $fecha_tc_ymd = date('Y-m-d', strtotime($fecha_final_tc));
                
                /* Si la fecha que incluye el tiempo de corrida corresponde al día siguiente, se coloca como 
                 * hora fin la hora ingresada y como hora fin corregida 23:59:59 */                
                if($fecha_tc_ymd > $fecha_ing_ymd) {
                    $hora_total = '23:59:59';
                }
                
                $registroModificacion -> setRemNombreCampo('Hora fin');
                $registroModificacion -> setRemValorAntiguo('' . $registro -> getRumHoraFinTrabajo('H:i:s'));
                $registro -> setRumHoraFinTrabajo($hora_total);
                $registroModificacion -> setRemValorNuevo($hora_total);
                
                //Cambios: 24 de febrero deo 2014
                //Registrar la hora fin sin corregir en la columna rum_hora_fin_trabajo_original
                $registro -> setRumHoraFinTrabajoOriginal($hora_fin);                
            }
            if ($request -> hasParameter('fallas'))
            {
                $registroModificacion -> setRemNombreCampo('Fallas');
                $registroModificacion -> setRemValorAntiguo('' . $registro -> getRumFallas());

                $registro -> setRumFallas($request -> getParameter('fallas') * 60);

                $registroModificacion -> setRemValorNuevo('' . $registro -> getRumFallas());
            }            
            if ($request -> hasParameter('lote'))
            {
                $registroModificacion -> setRemNombreCampo('Lote');
                $registroModificacion -> setRemValorAntiguo('' . $registro ->getRumLote());

                $registro ->setRumLote($request -> getParameter('lote'));
                
                $registroModificacion -> setRemValorNuevo('' . $registro ->getRumLote());
            }
            if ($request -> hasParameter('observaciones'))
            {
                $registroModificacion -> setRemNombreCampo('Observaciones');
                $registroModificacion -> setRemValorAntiguo('' . $registro ->getRumObservaciones());

                $registro ->setRumObservaciones($request -> getParameter('observaciones'));
                
                $registroModificacion -> setRemValorNuevo('' . $registro ->getRumObservaciones());
            }
            if ($request -> hasParameter('tiempo_entre_metodos_perdida'))
            {
                $registroModificacion -> setRemNombreCampo('Tiempo entre métodos');
                $registroModificacion -> setRemValorAntiguo('' . $registro -> getRumTiempoEntreModelo('H:i:s'));

                $registro -> setRumTiempoEntreModelo($request -> getParameter('tiempo_entre_metodos_perdida'));

                $registroModificacion -> setRemValorNuevo('' . $registro -> getRumTiempoEntreModelo('H:i:s'));
            }
            if ($request -> hasParameter('tiempo_corrida_ss_perdida'))
            {
                $registroModificacion -> setRemNombreCampo('Tiempo de corrida - System suitability');
                $registroModificacion -> setRemValorAntiguo('' . $registro -> getRumTiempoCorridaSistema());

                $registro -> setRumTiempoCorridaSistema($request -> getParameter('tiempo_corrida_ss_perdida'));

                $registroModificacion -> setRemValorNuevo('' . $registro -> getRumTiempoCorridaSistema());
            }
            if ($request -> hasParameter('numero_inyecciones_ss_perdida'))
            {
                $registroModificacion -> setRemNombreCampo('Reinyecciones - System suitability');
                $registroModificacion -> setRemValorAntiguo('' . $registro -> getRumNumInyeccionEstandarPer());

                $registro -> setRumNumInyeccionEstandarPer($request -> getParameter('numero_inyecciones_ss_perdida'));

                $registroModificacion -> setRemValorNuevo('' . $registro -> getRumNumInyeccionEstandarPer());
            }
            if ($request -> hasParameter('tiempo_corrida_cc_perdida'))
            {
                $registroModificacion -> setRemNombreCampo('Tiempo de corrida - Curva de calibración');
                $registroModificacion -> setRemValorAntiguo('' . $registro -> getRumTiempoCorridaCurvas());

                $registro -> setRumTiempoCorridaCurvas($request -> getParameter('tiempo_corrida_cc_perdida'));

                $registroModificacion -> setRemValorNuevo('' . $registro -> getRumTiempoCorridaCurvas());
            }
            if ($request -> hasParameter('numero_inyecciones_estandar1_perdida') && $registro -> getRumNumeroInyeccionEstandar1() != 0)
            {
                $registroModificacion -> setRemNombreCampo('Reinyecciones estandar 1 - Curva de calibración');
                $registroModificacion -> setRemValorAntiguo('' . $registro -> getRumNumInyeccionEstandar1Pe());

                $registro -> setRumNumInyeccionEstandar1Pe($request -> getParameter('numero_inyecciones_estandar1_perdida'));

                $registroModificacion -> setRemValorNuevo('' . $registro -> getRumNumInyeccionEstandar1Pe());
            }
            if ($request -> hasParameter('numero_inyecciones_estandar2_perdida') && $registro -> getRumNumeroInyeccionEstandar2() != 0)
            {
                $registroModificacion -> setRemNombreCampo('Reinyecciones estandar 2 - Curva de calibración');
                $registroModificacion -> setRemValorAntiguo('' . $registro -> getRumNumInyeccionEstandar2Pe());

                $registro -> setRumNumInyeccionEstandar2Pe($request -> getParameter('numero_inyecciones_estandar2_perdida'));

                $registroModificacion -> setRemValorNuevo('' . $registro -> getRumNumInyeccionEstandar2Pe());
            }
            if ($request -> hasParameter('numero_inyecciones_estandar3_perdida') && $registro -> getRumNumeroInyeccionEstandar3() != 0)
            {
                $registroModificacion -> setRemNombreCampo('Reinyecciones estandar 3 - Curva de calibración');
                $registroModificacion -> setRemValorAntiguo('' . $registro -> getRumNumInyeccionEstandar3Pe());

                $registro -> setRumNumInyeccionEstandar3Pe($request -> getParameter('numero_inyecciones_estandar3_perdida'));

                $registroModificacion -> setRemValorNuevo('' . $registro -> getRumNumInyeccionEstandar3Pe());
            }
            if ($request -> hasParameter('numero_inyecciones_estandar4_perdida') && $registro -> getRumNumeroInyeccionEstandar4() != 0)
            {
                $registroModificacion -> setRemNombreCampo('Reinyecciones estandar 4 - Curva de calibración');
                $registroModificacion -> setRemValorAntiguo('' . $registro -> getRumNumInyeccionEstandar4Pe());

                $registro -> setRumNumInyeccionEstandar4Pe($request -> getParameter('numero_inyecciones_estandar4_perdida'));

                $registroModificacion -> setRemValorNuevo('' . $registro -> getRumNumInyeccionEstandar4Pe());
            }
            if ($request -> hasParameter('numero_inyecciones_estandar5_perdida') && $registro -> getRumNumeroInyeccionEstandar5() != 0)
            {
                $registroModificacion -> setRemNombreCampo('Reinyecciones estandar 5 - Curva de calibración');
                $registroModificacion -> setRemValorAntiguo('' . $registro -> getRumNumInyeccionEstandar5Pe());

                $registro -> setRumNumInyeccionEstandar5Pe($request -> getParameter('numero_inyecciones_estandar5_perdida'));

                $registroModificacion -> setRemValorNuevo('' . $registro -> getRumNumInyeccionEstandar5Pe());
            }
            if ($request -> hasParameter('numero_inyecciones_estandar6_perdida') && $registro -> getRumNumeroInyeccionEstandar6() != 0)
            {
                $registroModificacion -> setRemNombreCampo('Reinyecciones estandar 6 - Curva de calibración');
                $registroModificacion -> setRemValorAntiguo('' . $registro -> getRumNumInyeccionEstandar6Pe());

                $registro -> setRumNumInyeccionEstandar6Pe($request -> getParameter('numero_inyecciones_estandar6_perdida'));

                $registroModificacion -> setRemValorNuevo('' . $registro -> getRumNumInyeccionEstandar6Pe());
            }
            if ($request -> hasParameter('numero_inyecciones_estandar7_perdida') && $registro -> getRumNumeroInyeccionEstandar7() != 0)
            {
                $registroModificacion -> setRemNombreCampo('Reinyecciones estandar 7 - Curva de calibración');
                $registroModificacion -> setRemValorAntiguo('' . $registro -> getRumNumInyeccionEstandar7Pe());

                $registro -> setRumNumInyeccionEstandar7Pe($request -> getParameter('numero_inyecciones_estandar7_perdida'));

                $registroModificacion -> setRemValorNuevo('' . $registro -> getRumNumInyeccionEstandar7Pe());
            }
            if ($request -> hasParameter('numero_inyecciones_estandar8_perdida') && $registro -> getRumNumeroInyeccionEstandar8() != 0)
            {
                $registroModificacion -> setRemNombreCampo('Reinyecciones estandar 8 - Curva de calibración');
                $registroModificacion -> setRemValorAntiguo('' . $registro -> getRumNumInyeccionEstandar8Pe());

                $registro -> setRumNumInyeccionEstandar8Pe($request -> getParameter('numero_inyecciones_estandar8_perdida'));

                $registroModificacion -> setRemValorNuevo('' . $registro -> getRumNumInyeccionEstandar8Pe());
            }
            if ($request -> hasParameter('tiempo_corrida_producto_perdida'))
            {
                $registroModificacion -> setRemNombreCampo('Tiempo de corrida - Producto');
                $registroModificacion -> setRemValorAntiguo('' . $registro -> getRumTcProductoTerminado());

                $registro -> setRumTcProductoTerminado($request -> getParameter('tiempo_corrida_producto_perdida'));

                $registroModificacion -> setRemValorNuevo('' . $registro -> getRumTcProductoTerminado());
            }
            if ($request -> hasParameter('tiempo_corrida_estabilidad_perdida'))
            {
                $registroModificacion -> setRemNombreCampo('Tiempo de corrida - Estabilidad');
                $registroModificacion -> setRemValorAntiguo('' . $registro -> getRumTcEstabilidad());

                $registro -> setRumTcEstabilidad($request -> getParameter('tiempo_corrida_estabilidad_perdida'));

                $registroModificacion -> setRemValorNuevo('' . $registro -> getRumTcEstabilidad());
            }
            if ($request -> hasParameter('tiempo_corrida_materia_prima_perdida'))
            {
                $registroModificacion -> setRemNombreCampo('Tiempo de corrida - Materia prima');
                $registroModificacion -> setRemValorAntiguo('' . $registro -> getRumTcMateriaPrima());

                $registro -> setRumTcMateriaPrima($request -> getParameter('tiempo_corrida_materia_prima_perdida'));

                $registroModificacion -> setRemValorNuevo('' . $registro -> getRumTcMateriaPrima());
            }
            if ($request -> hasParameter('tiempo_corrida_pureza_perdida'))
            {
                $registroModificacion -> setRemNombreCampo('Tiempo de corrida - Pureza');
                $registroModificacion -> setRemValorAntiguo('' . $registro -> getRumTcPureza());

                $registro -> setRumTcPureza($request -> getParameter('tiempo_corrida_pureza_perdida'));

                $registroModificacion -> setRemValorNuevo('' . $registro -> getRumTcPureza());
            }
            if ($request -> hasParameter('tiempo_corrida_disolucion_perdida'))
            {
                $registroModificacion -> setRemNombreCampo('Tiempo de corrida - Disolución');
                $registroModificacion -> setRemValorAntiguo('' . $registro -> getRumTcDisolucion());

                $registro -> setRumTcDisolucion($request -> getParameter('tiempo_corrida_disolucion_perdida'));

                $registroModificacion -> setRemValorNuevo('' . $registro -> getRumTcDisolucion());
            }
            if ($request -> hasParameter('tiempo_corrida_uniformidad_perdida'))
            {
                $registroModificacion -> setRemNombreCampo('Tiempo de corrida - Uniformidad');
                $registroModificacion -> setRemValorAntiguo('' . $registro -> getRumTcUniformidad());

                $registro -> setRumTcUniformidad($request -> getParameter('tiempo_corrida_uniformidad_perdida'));

                $registroModificacion -> setRemValorNuevo('' . $registro -> getRumTcUniformidad());
            }

            if ($request -> hasParameter('numero_muestras_producto_perdida'))
            {
                $registroModificacion -> setRemNombreCampo('Número de muestras reanalizadas - Producto');
                $registroModificacion -> setRemValorAntiguo('' . $registro -> getRumNumMuProductoPerdida());

                $registro -> setRumNumMuProductoPerdida($request -> getParameter('numero_muestras_producto_perdida'));

                $registroModificacion -> setRemValorNuevo('' . $registro -> getRumNumMuProductoPerdida());
            }
            if ($request -> hasParameter('numero_inyecciones_x_muestra_producto_perdida'))
            {
                $registroModificacion -> setRemNombreCampo('Número de reinyecciones x muestra - Producto');
                $registroModificacion -> setRemValorAntiguo('' . $registro -> getRumNumInyecXMuProducPerd());

                $registro -> setRumNumInyecXMuProducPerd($request -> getParameter('numero_inyecciones_x_muestra_producto_perdida'));

                $registroModificacion -> setRemValorNuevo('' . $registro -> getRumNumInyecXMuProducPerd());
            }
            if ($request -> hasParameter('numero_muestras_estabilidad_perdida'))
            {
                $registroModificacion -> setRemNombreCampo('Número de muestras reanalizadas - Estabilidad');
                $registroModificacion -> setRemValorAntiguo('' . $registro -> getRumNumMuEstabilidadPerdida());

                $registro -> setRumNumMuEstabilidadPerdida($request -> getParameter('numero_muestras_estabilidad_perdida'));

                $registroModificacion -> setRemValorNuevo('' . $registro -> getRumNumMuEstabilidadPerdida());
            }
            if ($request -> hasParameter('numero_inyecciones_x_muestra_estabilidad_perdida'))
            {
                $registroModificacion -> setRemNombreCampo('Número de reinyecciones x muestra - Estabilidad');
                $registroModificacion -> setRemValorAntiguo('' . $registro -> getRumNumInyecXMuEstabiPerd());

                $registro -> setRumNumInyecXMuEstabiPerd($request -> getParameter('numero_inyecciones_x_muestra_estabilidad_perdida'));

                $registroModificacion -> setRemValorNuevo('' . $registro -> getRumNumInyecXMuEstabiPerd());
            }
            if ($request -> hasParameter('numero_muestras_materia_prima_perdida'))
            {
                $registroModificacion -> setRemNombreCampo('Número de muestras reanalizadas - Materia prima');
                $registroModificacion -> setRemValorAntiguo('' . $registro -> getRumNumMuMateriaPrimaPerdi());

                $registro -> setRumNumMuMateriaPrimaPerdi($request -> getParameter('numero_muestras_materia_prima_perdida'));

                $registroModificacion -> setRemValorNuevo('' . $registro -> getRumNumMuMateriaPrimaPerdi());
            }
            if ($request -> hasParameter('numero_inyecciones_x_muestra_materia_prima_perdida'))
            {
                $registroModificacion -> setRemNombreCampo('Número de reinyecciones x muestra - Materia prima');
                $registroModificacion -> setRemValorAntiguo('' . $registro -> getRumNumInyecXMuMateriPerd());

                $registro -> setRumNumInyecXMuMateriPerd($request -> getParameter('numero_inyecciones_x_muestra_materia_prima_perdida'));

                $registroModificacion -> setRemValorNuevo('' . $registro -> getRumNumInyecXMuMateriPerd());
            }
            if ($request -> hasParameter('numero_muestras_pureza_perdida'))
            {
                $registroModificacion -> setRemNombreCampo('Número de muestras reanalizadas - Pureza');
                $registroModificacion -> setRemValorAntiguo('' . $registro -> getRumNumMuestrasPurezaPerdid());

                $registro -> setRumNumMuestrasPurezaPerdid($request -> getParameter('numero_muestras_pureza_perdida'));

                $registroModificacion -> setRemValorNuevo('' . $registro -> getRumNumMuestrasPurezaPerdid());
            }
            if ($request -> hasParameter('numero_inyecciones_x_muestra_pureza_perdida'))
            {
                $registroModificacion -> setRemNombreCampo('Número de reinyecciones x muestra - Pureza');
                $registroModificacion -> setRemValorAntiguo('' . $registro -> getRumNumInyecXMuPurezaPerd());

                $registro -> setRumNumInyecXMuPurezaPerd($request -> getParameter('numero_inyecciones_x_muestra_pureza_perdida'));

                $registroModificacion -> setRemValorNuevo('' . $registro -> getRumNumInyecXMuPurezaPerd());
            }
            if ($request -> hasParameter('numero_muestras_disolucion_perdida'))
            {
                $registroModificacion -> setRemNombreCampo('Número de muestras reanalizadas - Disolución');
                $registroModificacion -> setRemValorAntiguo('' . $registro -> getRumNumMuestrasDisolucionPe());

                $registro -> setRumNumMuestrasDisolucionPe($request -> getParameter('numero_muestras_disolucion_perdida'));

                $registroModificacion -> setRemValorNuevo('' . $registro -> getRumNumMuestrasDisolucionPe());
            }
            if ($request -> hasParameter('numero_inyecciones_x_muestra_disolucion_perdida'))
            {
                $registroModificacion -> setRemNombreCampo('Número de reinyecciones x muestra - Disolución');
                $registroModificacion -> setRemValorAntiguo('' . $registro -> getRumNumInyecXMuDisoluPerd());

                $registro -> setRumNumInyecXMuDisoluPerd($request -> getParameter('numero_inyecciones_x_muestra_disolucion_perdida'));

                $registroModificacion -> setRemValorNuevo('' . $registro -> getRumNumInyecXMuDisoluPerd());
            }
            if ($request -> hasParameter('numero_muestras_uniformidad_perdida'))
            {
                $registroModificacion -> setRemNombreCampo('Número de muestras reanalizadas - Uniformidad');
                $registroModificacion -> setRemValorAntiguo('' . $registro -> getRumNumMuestrasUniformidadP());

                $registro -> setRumNumMuestrasUniformidadP($request -> getParameter('numero_muestras_uniformidad_perdida'));

                $registroModificacion -> setRemValorNuevo('' . $registro -> getRumNumMuestrasUniformidadP());
            }
            if ($request -> hasParameter('numero_inyecciones_x_muestra_uniformidad_perdida'))
            {
                $registroModificacion -> setRemNombreCampo('Número de reinyecciones x muestra - Uniformidad');
                $registroModificacion -> setRemValorAntiguo('' . $registro -> getRumNumInyecXMuUniforPerd());

                $registro -> setRumNumInyecXMuUniforPerd($request -> getParameter('numero_inyecciones_x_muestra_uniformidad_perdida'));

                $registroModificacion -> setRemValorNuevo('' . $registro -> getRumNumInyecXMuUniforPerd());
            }
            
            //Cambios: 24 de febrero de 2014
            /* Se comentan las siguientes líneas pues la hora de inicio y fin de corridas para pérdidas
               corresponden a las calculadas por el sistema al tener en cuenta el tiempo de inyección de la 
               máquina y el tiempo de corrida del método respectivamente */
//            if ($request -> hasParameter('hora_inicio_corrida_perdida'))
//            {                
//                $registroModificacion -> setRemNombreCampo('Hora inicio');
//                $registroModificacion -> setRemValorAntiguo('' . $registro -> getRumHoraInicioTrabajo('H:i:s'));
//                $registro -> setRumHoraInicioTrabajo($request -> getParameter('hora_inicio_corrida_perdida'));
//                $registroModificacion -> setRemValorNuevo('' . $registro -> getRumHoraInicioTrabajo('H:i:s'));
//                
//                //Cambios: 24 de febrero de 2014
//                //Cuando un método es de alistamiento o mantenimiento se registra como la hora de fin la misma hora de inicio
//                $cod_metodo = $registro->getRumMetCodigo();
//                $metodo = MetodoPeer::retrieveByPK($cod_metodo);
//                if($metodo->getMetMantenimiento() == 1) {
//                    $registroModificacion -> setRemNombreCampo('Hora fin');
//                    $registroModificacion -> setRemValorAntiguo('' . $registro -> getRumHoraFinTrabajo('H:i:s'));
//
//                    $registro -> setRumHoraFinTrabajo($request -> getParameter('hora_inicio_corrida_perdida'));
//
//                    $registroModificacion -> setRemValorNuevo('' . $registro -> getRumHoraFinTrabajo('H:i:s'));
//                }
//            }            
//            if ($request -> hasParameter('hora_fin_corrida_perdida'))
//            {
//                $registroModificacion -> setRemNombreCampo('Hora fin');
//                $registroModificacion -> setRemValorAntiguo('' . $registro -> getRumHoraFinTrabajo('H:i:s'));
//
//                $registro -> setRumHoraFinTrabajo($request -> getParameter('hora_fin_corrida_perdida'));
//
//                $registroModificacion -> setRemValorNuevo('' . $registro -> getRumHoraFinTrabajo('H:i:s'));
//            }
            if ($request -> hasParameter('fallas_perdida'))
            {
                $registroModificacion -> setRemNombreCampo('Fallas');
                $registroModificacion -> setRemValorAntiguo('' . $registro -> getRumFallas());

                $registro -> setRumFallas($request -> getParameter('fallas_perdida') * 60);

                $registroModificacion -> setRemValorNuevo('' . $registro -> getRumFallas());
            }
            
            //Cambios: 24 de febrero de 2014
            if ($request -> hasParameter('col_codigo_interno'))
            {
                $registroModificacion -> setRemNombreCampo('Código Interno');
                
                //Si el valor antiguo es vacío
                if($registro->getRumColCodigo() == '') {
                    $registroModificacion -> setRemValorAntiguo('' . $registro->getRumColCodigo()); 
                }
                else {
                    $columnaAntiguo = ColumnaPeer::retrieveByPK($registro -> getRumColCodigo());
                    $registroModificacion -> setRemValorAntiguo('' . $columnaAntiguo->getColCodigoInterno()); 
                }                
                
                $registro ->setRumColCodigo($request -> getParameter('col_codigo_interno'));
                
                $columnaNuevo = ColumnaPeer::retrieveByPK($registro->getRumColCodigo());
                $registroModificacion -> setRemValorNuevo('' . $columnaNuevo->getColCodigoInterno());
            }
            if ($request -> hasParameter('etapa_nombre'))
            {
                $registroModificacion -> setRemNombreCampo('Etapa');
                
                //Si el valor antiguo es vacío
                if($registro->getRumEtaCodigo() == '') {
                    $registroModificacion -> setRemValorAntiguo('' . $registro->getRumEtaCodigo()); 
                }
                else {
                    $etapaAntiguo = EtapaPeer::retrieveByPK($registro ->getRumEtaCodigo());
                    $registroModificacion -> setRemValorAntiguo('' . $etapaAntiguo->getEtaNombre()); 
                }
                
                $registro ->setRumEtaCodigo($request -> getParameter('etapa_nombre'));                
                
                $etapaNuevo = EtapaPeer::retrieveByPK($registro ->getRumEtaCodigo());
                $registroModificacion -> setRemValorNuevo('' . $etapaNuevo->getEtaNombre());
            }
            if ($request -> hasParameter('platos_teoricos'))
            {
                $registroModificacion -> setRemNombreCampo('Platos teóricos');
                $registroModificacion -> setRemValorAntiguo('' . $registro ->getRumPlatosTeoricos());
                $registro ->setRumPlatosTeoricos($request -> getParameter('platos_teoricos'));                
                $registroModificacion -> setRemValorNuevo('' . $registro ->getRumPlatosTeoricos());
            } 
            if ($request -> hasParameter('tiempo_retencion'))
            {
                $registroModificacion -> setRemNombreCampo('Tiempo de Retención');
                $registroModificacion -> setRemValorAntiguo('' . $registro ->getRumTiempoRetencion());
                $registro ->setRumTiempoRetencion($request -> getParameter('tiempo_retencion'));                
                $registroModificacion -> setRemValorNuevo('' . $registro ->getRumTiempoRetencion());
            }
            if ($request -> hasParameter('resolucion'))
            {
                $registroModificacion -> setRemNombreCampo('Resolución');
                $registroModificacion -> setRemValorAntiguo('' . $registro ->getRumResolucion());
                $registro ->setRumResolucion($request -> getParameter('resolucion'));                
                $registroModificacion -> setRemValorNuevo('' . $registro ->getRumResolucion());
            }
            if ($request -> hasParameter('tailing'))
            {
                $registroModificacion -> setRemNombreCampo('Tailing');
                $registroModificacion -> setRemValorAntiguo('' . $registro ->getRumTailing());
                $registro ->setRumTailing($request -> getParameter('tailing'));                
                $registroModificacion -> setRemValorNuevo('' . $registro ->getRumTailing());
            }
            if ($request -> hasParameter('presion'))
            {
                $registroModificacion -> setRemNombreCampo('Presi&oacute;n');
                $registroModificacion -> setRemValorAntiguo('' . $registro ->getRumPresion());
                $registro ->setRumPresion($request -> getParameter('presion'));
                $registroModificacion -> setRemValorNuevo('' . $registro ->getRumPresion());
            }
            if ($request -> hasParameter('observaciones_col'))
            {
                $registroModificacion -> setRemNombreCampo('Observaciones Columna');
                $registroModificacion -> setRemValorAntiguo('' . $registro ->getRumObservacionesCol());
                $registro ->setRumObservacionesCol($request -> getParameter('observaciones_col'));
                $registroModificacion -> setRemValorNuevo('' . $registro ->getRumObservacionesCol());
            }
            
            if ($registro -> isModified())
            {
                $causa = '';
                if ($request -> hasParameter('causa'))
                {
                    $causa = $request -> getParameter('causa');
                }

                $registroModificacion -> setRemCausa($causa);

                // Solo almacena las modificaciones hechas por el administrador
                if ($user -> getAttribute('usu_per_codigo') == '2')
                {
                    $registroModificacion -> save();
                }
            }

            $registro -> save();
            
            //Cambios: 24 de febrero de 2014
            /* Se verifica si existe algún ahorro en los tiempos de funcionamiento después de haber ingresado 
             * la hora de finalización de la corrida.  La siguiente condición se ubica al final, pues se debe 
             * registrar la información ingresada de la corrida y si la condición se pone en la parte superior, 
             * esta función no alcanza a ejecutarse totalmente, por lo tanto, no se registraría la hora de 
             * finalización de la corrida ingresada.
             */
            if ($request -> hasParameter('hora_fin_corrida'))
            {                               
                $maq_tiempo_inyeccion = $registro -> obtenerTiempoInyeccionMaquina();
                $TF = ($registro->obtenerTFMetodo())*60;
                $TO = ($registro->obtenerTOMetodo($maq_tiempo_inyeccion))*60;
                $TPNP = $registro->calcularDuracionEventos($registro->getRumCodigo());
                //Se verifica si TF es menor a (TO+TPNP).  Si es menor, existe un ahorro en el TF
                $ahorro = $TF - $TO - $TPNP;
                if(round($ahorro) < 0) {
                    return $this -> renderText('Ahorro_TF');
                }
            }
        }        
        return $this -> renderText('Ok');
    }

    public function executeCrearRegistroUsoMaquina(sfWebRequest $request)
    {
        $user = $this -> getUser();
        $codigo_usuario = $user -> getAttribute('usu_codigo');
        $codigo_perfil_usuario = $user -> getAttribute('usu_per_codigo');
        if (($codigo_perfil_usuario!='3') && ($codigo_perfil_usuario!='2'))
        {
            return $this -> renderText('3');
        }
        
        $dateTimeFechaUso = new DateTime($request -> getParameter('fecha'));
        $timeStampFechaUso = $dateTimeFechaUso -> getTimestamp();
        $dateTimeFechaActual = new DateTime(date('Y-m-d'));
        $timeStampFechaActual = $dateTimeFechaActual -> getTimestamp();
        if (($timeStampFechaUso < $timeStampFechaActual) && ($codigo_perfil_usuario!='2'))
        {            
            return $this -> renderText('2');
        }

        $criteria = new Criteria();
        if ($request -> hasParameter('codigo_maquina'))
        {
            $criteria -> add(RegistroUsoMaquinaPeer::RUM_MAQ_CODIGO, $request -> getParameter('codigo_maquina'));
        }
        $criteria -> add(RegistroUsoMaquinaPeer::RUM_FECHA, $request -> getParameter('fecha'));
        $criteria -> add(RegistroUsoMaquinaPeer::RUM_ELIMINADO, false);
        $criteria -> addAscendingOrderByColumn(RegistroUsoMaquinaPeer::RUM_TIEMPO_ENTRE_MODELO);
        $registros = RegistroUsoMaquinaPeer::doSelect($criteria);

        $criterion = $criteria -> getNewCriterion(RegistroUsoMaquinaPeer::RUM_TIEMPO_ENTRE_MODELO, NULL, Criteria::ISNULL);
        $criterion -> addOr($criteria -> getNewCriterion(RegistroUsoMaquinaPeer::RUM_HORA_INICIO_TRABAJO, NULL, Criteria::ISNULL));
        $criterion -> addOr($criteria -> getNewCriterion(RegistroUsoMaquinaPeer::RUM_HORA_FIN_TRABAJO, NULL, Criteria::ISNULL));

        $criteria -> add($criterion);

        $numeroDeRegistrosConCamposHoraNulos = RegistroUsoMaquinaPeer::doCount($criteria);

        if ($numeroDeRegistrosConCamposHoraNulos > 0)
        {
            return $this -> renderText('1');
        }

        $registro = new RegistroUsoMaquina();

        $metodo = MetodoPeer::retrieveByPK($request -> getParameter('id_metodo'));
        //$registro->setRumTiempoCambioModelo($metodo->getMetTiempoCambioModelo()); //cambio maryit el 9 de feb de 2011
        $registro -> setRumTiempoCambioModelo($metodo -> getMetTiempoEstandar());
        $registro -> setRumTiempoCorridaSistema($metodo -> getMetTiempoCorridaSistema());
        $registro -> setRumNumeroInyeccionEstandar($metodo -> getMetNumeroInyeccionEstandar());
        $registro -> setRumTiempoCorridaCurvas($metodo -> getMetTiempoCorridaCurvas());

        // Version 1.1
        $registro -> setRumTcProductoTerminado($metodo -> getMetTcProductoTerminado());
        $registro -> setRumTcEstabilidad($metodo -> getMetTcEstabilidad());
        $registro -> setRumTcMateriaPrima($metodo -> getMetTcMateriaPrima());
        $registro -> setRumTcPureza($metodo -> getMetTcPureza());
        $registro -> setRumTcDisolucion($metodo -> getMetTcDisolucion());
        $registro -> setRumTcUniformidad($metodo -> getMetTcUniformidad());

        $registro -> setRumTiempoCorridaSistemaEst($metodo -> getMetTiempoCorridaSistema());
        $registro -> setRumTiempoCorridaCurvasEsta($metodo -> getMetTiempoCorridaCurvas());

        // Version 1.1
        $registro -> setRumTcProductoTerminadoEsta($metodo -> getMetTcProductoTerminado());
        $registro -> setRumTcEstabilidadEstandar($metodo -> getMetTcEstabilidad());
        $registro -> setRumTcMateriaPrimaEstandar($metodo -> getMetTcMateriaPrima());
        $registro -> setRumTcPurezaEstandar($metodo -> getMetTcPureza());
        $registro -> setRumTcDisolucionEstandar($metodo -> getMetTcDisolucion());
        $registro -> setRumTcUniformidadEstandar($metodo -> getMetTcUniformidad());

        $registro -> setRumNumeroInyeccionEstandar1($metodo -> getMetNumInyeccionEstandar1());
        $registro -> setRumNumeroInyeccionEstandar2($metodo -> getMetNumInyeccionEstandar2());
        $registro -> setRumNumeroInyeccionEstandar3($metodo -> getMetNumInyeccionEstandar3());
        $registro -> setRumNumeroInyeccionEstandar4($metodo -> getMetNumInyeccionEstandar4());
        $registro -> setRumNumeroInyeccionEstandar5($metodo -> getMetNumInyeccionEstandar5());
        $registro -> setRumNumeroInyeccionEstandar6($metodo -> getMetNumInyeccionEstandar6());
        $registro -> setRumNumeroInyeccionEstandar7($metodo -> getMetNumInyeccionEstandar7());
        $registro -> setRumNumeroInyeccionEstandar8($metodo -> getMetNumInyeccionEstandar8());
        $registro -> setRumNumInyecXMuestraProduc($metodo -> getMetNumInyecXMuProducto());
        $registro -> setRumNumInyecXMuestraEstabi($metodo -> getMetNumInyecXMuEstabilidad());
        $registro -> setRumNumInyecXMuestraMateri($metodo -> getMetNumInyecXMuMateriaPri());

        // Version 1.1
        $registro -> setRumNumInyecXMuestraPureza($metodo -> getMetNumInyecXMuPureza());
        $registro -> setRumNumInyecXMuestraDisolu($metodo -> getMetNumInyecXMuDisolucion());
        $registro -> setRumNumInyecXMuestraUnifor($metodo -> getMetNumInyecXMuUniformidad());

        $registro -> setRumMetCodigo($request -> getParameter('id_metodo'));

        $registro -> setRumMaqCodigo($request -> getParameter('codigo_maquina'));
        $registro -> setRumFecha($request -> getParameter('fecha'));
        $registro -> setRumFechaHoraRegSistema(date('Y-m-d H:i:s'));
        $registro -> setRumUsuCodigo($codigo_usuario);
        $registro -> setRumEliminado(false);
        
        $registro -> save();
        return $this -> renderText('Ok');
    }

    public function executeListarRegistrosUsoMaquina(sfWebRequest $request)
    {
        $criteria = new Criteria();
        if ($request -> hasParameter('codigo_maquina'))
        {
            $criteria -> add(RegistroUsoMaquinaPeer::RUM_MAQ_CODIGO, $request -> getParameter('codigo_maquina'));
        }
        if ($request -> hasParameter('codigo_operario') && $request -> getParameter('codigo_operario') != '-1')
        {
            $criteria -> add(RegistroUsoMaquinaPeer::RUM_USU_CODIGO, $request -> getParameter('codigo_operario'));
        }
        $criteria -> add(RegistroUsoMaquinaPeer::RUM_FECHA, $request -> getParameter('fecha'));
        $criteria -> add(RegistroUsoMaquinaPeer::RUM_ELIMINADO, false);
        $criteria -> addAscendingOrderByColumn(RegistroUsoMaquinaPeer::RUM_TIEMPO_ENTRE_MODELO);
        $registros = RegistroUsoMaquinaPeer::doSelect($criteria);

        $result = array();
        $data = array();

        $horasFin = 0;
        $minutosFin = 0;
        $segundosFin = 0;

        foreach ($registros as $registro)
        {
            $fields = array();
            
            $fields['id_registro_uso_maquina'] = $registro -> getRumCodigo();
            $fields['id_metodo'] = $registro -> getRumMetCodigo();
            $fields['tiempo_entre_metodos'] = $registro -> getRumTiempoEntreModelo('H:i:s');
            $fields['cambio_metodo_ajuste'] = number_format($registro -> getRumTiempoCambioModelo(), 2, '.', '');
            $fields['tiempo_corrida_ss'] = number_format($registro -> getRumTiempoCorridaSistema(), 2, '.', '');
            $fields['numero_inyecciones_ss'] = number_format($registro -> getRumNumeroInyeccionEstandar(), 2, '.', '');
            $fields['tiempo_corrida_cc'] = number_format($registro -> getRumTiempoCorridaCurvas(), 2, '.', '');

            $fields['numero_inyecciones_estandar1'] = number_format($registro -> getRumNumeroInyeccionEstandar1(), 2, '.', '');
            $fields['numero_inyecciones_estandar2'] = number_format($registro -> getRumNumeroInyeccionEstandar2(), 2, '.', '');
            $fields['numero_inyecciones_estandar3'] = number_format($registro -> getRumNumeroInyeccionEstandar3(), 2, '.', '');
            $fields['numero_inyecciones_estandar4'] = number_format($registro -> getRumNumeroInyeccionEstandar4(), 2, '.', '');
            $fields['numero_inyecciones_estandar5'] = number_format($registro -> getRumNumeroInyeccionEstandar5(), 2, '.', '');
            $fields['numero_inyecciones_estandar6'] = number_format($registro -> getRumNumeroInyeccionEstandar6(), 2, '.', '');
            $fields['numero_inyecciones_estandar7'] = number_format($registro -> getRumNumeroInyeccionEstandar7(), 2, '.', '');
            $fields['numero_inyecciones_estandar8'] = number_format($registro -> getRumNumeroInyeccionEstandar8(), 2, '.', '');

            // Version 1.1 {
            $fields['tiempo_corrida_producto'] = number_format($registro -> getRumTcProductoTerminado(), 2, '.', '');
            $fields['tiempo_corrida_estabilidad'] = number_format($registro -> getRumTcEstabilidad(), 2, '.', '');
            $fields['tiempo_corrida_materia_prima'] = number_format($registro -> getRumTcMateriaPrima(), 2, '.', '');
            $fields['tiempo_corrida_pureza'] = number_format($registro -> getRumTcPureza(), 2, '.', '');
            $fields['tiempo_corrida_disolucion'] = number_format($registro -> getRumTcDisolucion(), 2, '.', '');
            $fields['tiempo_corrida_uniformidad'] = number_format($registro -> getRumTcUniformidad(), 2, '.', '');
            // }

            $fields['numero_muestras_producto'] = number_format($registro -> getRumNumMuestrasProducto(), 2, '.', '');
            $fields['numero_inyecciones_x_muestra_producto'] = number_format($registro -> getRumNumInyecXMuestraProduc(), 2, '.', '');
            $fields['numero_muestras_estabilidad'] = number_format($registro -> getRumNumMuestrasEstabilidad(), 2, '.', '');
            $fields['numero_inyecciones_x_muestra_estabilidad'] = number_format($registro -> getRumNumInyecXMuestraEstabi(), 2, '.', '');
            $fields['numero_muestras_materia_prima'] = number_format($registro -> getRumNumMuestrasMateriaPrima(), 2, '.', '');
            $fields['numero_inyecciones_x_muestra_materia_prima'] = number_format($registro -> getRumNumInyecXMuestraMateri(), 2, '.', '');

            // Version 1.1 {
            $fields['numero_muestras_pureza'] = number_format($registro -> getRumNumMuestrasPureza(), 2, '.', '');
            $fields['numero_inyecciones_x_muestra_pureza'] = number_format($registro -> getRumNumInyecXMuestraPureza(), 2, '.', '');
            $fields['numero_muestras_disolucion'] = number_format($registro -> getRumNumMuestrasDisolucion(), 2, '.', '');
            $fields['numero_inyecciones_x_muestra_disolucion'] = number_format($registro -> getRumNumInyecXMuestraDisolu(), 2, '.', '');
            $fields['numero_muestras_uniformidad'] = number_format($registro -> getRumNumMuestrasUniformidad(), 2, '.', '');
            $fields['numero_inyecciones_x_muestra_uniformidad'] = number_format($registro -> getRumNumInyecXMuestraUnifor(), 2, '.', '');
            // }

            $fields['hora_inicio_corrida'] = $registro -> getRumHoraInicioTrabajoOriginal('H:i:s');
            $fields['hora_fin_corrida'] = $registro -> getRumHoraFinTrabajoOriginal('H:i:s');
            $fields['fallas'] = number_format($registro -> getRumFallas() / 60, 2, '.', '');
            $fields['lote'] = $registro -> getRumLote();
            $fields['observaciones'] = $registro -> getRumObservaciones();
            
            //Cambios: 24 de febrero de 2014
            if($registro->getRumColCodigo() == '') {
                $fields['col_codigo_interno'] = '';
            } else {
                $columna = ColumnaPeer::retrieveByPK($registro->getRumColCodigo());
                $fields['col_codigo_interno'] = $columna -> getColCodigoInterno();
            }
            if($registro->getRumEtaCodigo() == '') {
                $fields['etapa_nombre'] = '';
            } else {
                $etapa = EtapaPeer::retrieveByPK($registro->getRumEtaCodigo());
                $fields['etapa_nombre'] = $etapa -> getEtaNombre();
            }
            if ($registro -> getRumPlatosTeoricos() != '') {
                $fields['platos_teoricos'] = number_format($registro -> getRumPlatosTeoricos(), 2, '.', '');
            }
            if ($registro -> getRumTiempoRetencion() != '') {
                $fields['tiempo_retencion'] = number_format($registro -> getRumTiempoRetencion(), 2, '.', '');
            }
            if ($registro -> getRumResolucion() != '') {
                $fields['resolucion'] = number_format($registro -> getRumResolucion(), 2, '.', '');
            }
            if ($registro -> getRumTailing() != '') {
                $fields['tailing'] = number_format($registro -> getRumTailing(), 2, '.', '');
            }
            if ($registro -> getRumPresion() != '') {
                $fields['presion'] = number_format($registro -> getRumPresion(), 2, '.', '');
            }
            $fields['observaciones_col'] = $registro -> getRumObservacionesCol();

            $data[] = $fields;

            $fields = array();

            $fields['id_registro_uso_maquina'] = $registro -> getRumCodigo();
            $fields['id_metodo'] = $registro -> getRumMetCodigo();
            $fields['tiempo_entre_metodos'] = number_format(round($registro -> calcularTiempoEntreMetodosHoras($horasFin, $minutosFin, $segundosFin), 2), 2, '.', '');
            $fields['cambio_metodo_ajuste'] = number_format($registro -> calcularPerdidaCambioMetodoAjusteMinutos(), 2, '.', '');
            $fields['tiempo_corrida_ss'] = number_format($registro -> getRumTiempoCorridaSistema(), 2, '.', '');
            $fields['numero_inyecciones_ss'] = number_format($registro -> getRumNumInyeccionEstandarPer(), 2, '.', '');
            $fields['tiempo_corrida_cc'] = number_format($registro -> getRumTiempoCorridaCurvas(), 2, '.', '');

            $fields['numero_inyecciones_estandar1'] = number_format($registro -> getRumNumInyeccionEstandar1Pe(), 2, '.', '');
            $fields['numero_inyecciones_estandar2'] = number_format($registro -> getRumNumInyeccionEstandar2Pe(), 2, '.', '');
            $fields['numero_inyecciones_estandar3'] = number_format($registro -> getRumNumInyeccionEstandar3Pe(), 2, '.', '');
            $fields['numero_inyecciones_estandar4'] = number_format($registro -> getRumNumInyeccionEstandar4Pe(), 2, '.', '');
            $fields['numero_inyecciones_estandar5'] = number_format($registro -> getRumNumInyeccionEstandar5Pe(), 2, '.', '');
            $fields['numero_inyecciones_estandar6'] = number_format($registro -> getRumNumInyeccionEstandar6Pe(), 2, '.', '');
            $fields['numero_inyecciones_estandar7'] = number_format($registro -> getRumNumInyeccionEstandar7Pe(), 2, '.', '');
            $fields['numero_inyecciones_estandar8'] = number_format($registro -> getRumNumInyeccionEstandar8Pe(), 2, '.', '');

            // Version 1.1 {
            $fields['tiempo_corrida_producto'] = number_format($registro -> getRumTcProductoTerminado(), 2, '.', '');
            $fields['tiempo_corrida_estabilidad'] = number_format($registro -> getRumTcEstabilidad(), 2, '.', '');
            $fields['tiempo_corrida_materia_prima'] = number_format($registro -> getRumTcMateriaPrima(), 2, '.', '');
            $fields['tiempo_corrida_pureza'] = number_format($registro -> getRumTcPureza(), 2, '.', '');
            $fields['tiempo_corrida_disolucion'] = number_format($registro -> getRumTcDisolucion(), 2, '.', '');
            $fields['tiempo_corrida_uniformidad'] = number_format($registro -> getRumTcUniformidad(), 2, '.', '');
            // }

            $fields['numero_muestras_producto'] = number_format($registro -> getRumNumMuProductoPerdida(), 2, '.', '');
            $fields['numero_inyecciones_x_muestra_producto'] = number_format($registro -> getRumNumInyecXMuProducPerd(), 2, '.', '');
            $fields['numero_muestras_estabilidad'] = number_format($registro -> getRumNumMuEstabilidadPerdida(), 2, '.', '');
            $fields['numero_inyecciones_x_muestra_estabilidad'] = number_format($registro -> getRumNumInyecXMuEstabiPerd(), 2, '.', '');
            $fields['numero_muestras_materia_prima'] = number_format($registro -> getRumNumMuMateriaPrimaPerdi(), 2, '.', '');
            $fields['numero_inyecciones_x_muestra_materia_prima'] = number_format($registro -> getRumNumInyecXMuMateriPerd(), 2, '.', '');

            // Version 1.1 {
            $fields['numero_muestras_pureza'] = number_format($registro -> getRumNumMuestrasPurezaPerdid(), 2, '.', '');
            $fields['numero_inyecciones_x_muestra_pureza'] = number_format($registro -> getRumNumInyecXMuPurezaPerd(), 2, '.', '');
            $fields['numero_muestras_disolucion'] = number_format($registro -> getRumNumMuestrasDisolucionPe(), 2, '.', '');
            $fields['numero_inyecciones_x_muestra_disolucion'] = number_format($registro -> getRumNumInyecXMuDisoluPerd(), 2, '.', '');
            $fields['numero_muestras_uniformidad'] = number_format($registro -> getRumNumMuestrasUniformidadP(), 2, '.', '');
            $fields['numero_inyecciones_x_muestra_uniformidad'] = number_format($registro -> getRumNumInyecXMuUniforPerd(), 2, '.', '');
            // }
            
            $fields['hora_inicio_corrida'] = $registro -> getRumHoraInicioTrabajo('H:i:s');
            $fields['hora_fin_corrida'] = $registro -> getRumHoraFinTrabajo('H:i:s');            
            $fields['fallas'] = number_format($registro -> getRumFallas() / 60, 2, '.', '');
            $fields['lote'] = $registro -> getRumLote();
            $fields['observaciones'] = $registro -> getRumObservaciones();

            //Cambios: 24 de febrero de 2014
            //Se muestra el código interno de la columna en caso de haberse registrado
            if($registro->getRumColCodigo() == '') {
                $fields['col_codigo_interno'] = '';
            } else {
                $fields['col_codigo_interno'] = $columna -> getColCodigoInterno();
            }
            //Se muestra el nombre de la etapa de la columna en caso de haberse registrado
            if($registro->getRumEtaCodigo() == '') {
                $fields['etapa_nombre'] = '';
            } else {
                $fields['etapa_nombre'] = $etapa -> getEtaNombre();
            }
            if ($registro -> getRumPlatosTeoricos() != '') {
                $fields['platos_teoricos'] = number_format($registro -> getRumPlatosTeoricos(), 2, '.', '');
            }
            if ($registro -> getRumTiempoRetencion() != '') {
                $fields['tiempo_retencion'] = number_format($registro -> getRumTiempoRetencion(), 2, '.', '');
            }
            if ($registro -> getRumResolucion() != '') {
                $fields['resolucion'] = number_format($registro -> getRumResolucion(), 2, '.', '');
            }
            if ($registro -> getRumTailing() != '') {
                $fields['tailing'] = number_format($registro -> getRumTailing(), 2, '.', '');
            }
            if ($registro -> getRumPresion() != '') {
                $fields['presion'] = number_format($registro -> getRumPresion(), 2, '.', '');
            }
            $fields['observaciones_col'] = $registro -> getRumObservacionesCol();
            
            $horasFin = $registro -> getRumHoraFinTrabajo('H');
            $minutosFin = $registro -> getRumHoraFinTrabajo('i');
            $segundosFin = $registro -> getRumHoraFinTrabajo('s');

            $data[] = $fields;
        }

        $result['data'] = $data;
        return $this -> renderText(json_encode($result));
    }

    public function executeListarMetodos()
    {
        //15 de mayo cambio maryit
        //se deben listar los metodos que no han sido eliminados
        //los metodos eliminados tiene en la columna MET_ELIMINADO un 1 los activos tiene un 0
        $conexion = new Criteria();
        $conexion -> add(MetodoPeer::MET_ELIMINADO, 0);
        $conexion -> addAscendingOrderByColumn(MetodoPeer::MET_NOMBRE);
        $metodos = MetodoPeer::doSelect($conexion);
        
        $result = array();
        $data = array();

        foreach ($metodos as $metodo)
        {
            $fields = array();
            $fields['codigo'] = $metodo -> getMetCodigo();
            $fields['nombre'] = $metodo -> getMetNombre();
            $data[] = $fields;
        }

        $result['data'] = $data;
        return $this -> renderText(json_encode($result));
    }
    
    public function executeListarMetodosSinOrden()
    {        
        //se deben listar los metodos que no han sido eliminados
        //los metodos eliminados tiene en la columna MET_ELIMINADO un 1 los activos tiene un 0
        $conexion = new Criteria();
        $conexion -> add(MetodoPeer::MET_ELIMINADO, 0);
        $metodos = MetodoPeer::doSelect($conexion);
        
        $result = array();
        $data = array();

        foreach ($metodos as $metodo)
        {
            $fields = array();
            $fields['codigo'] = $metodo -> getMetCodigo();
            $fields['nombre'] = $metodo -> getMetNombre();
            $data[] = $fields;
        }

        $result['data'] = $data;
        return $this -> renderText(json_encode($result));
    }
    
    //Cambios: 24 de febrero de 2014
    public function executeListarColumnas(sfWebRequest $request)
    {
            $salida='({"total":"0", "results":""})';
            $fila=0;
            $datos = array();

            try{

                    $conexion = new Criteria();
                    $conexion->add(ColumnaPeer::COL_ELIMINADO, 0);
                    $conexion->addAscendingOrderByColumn(ColumnaPeer::COL_CODIGO_INTERNO);
                    $columnas = ColumnaPeer::doSelect($conexion);

                    foreach($columnas As $temporal)
                    {
                            $datos[$fila]['col_codigo'] = $temporal->getColCodigo();
                            $datos[$fila]['col_cod_interno'] = $temporal->getColCodigoInterno();
                            $fila++;
                    }

                    if($fila>0){
                            $jsonresult = json_encode($datos);
                            $salida= '({"total":"'.$fila.'","results":'.$jsonresult.'})';
                    }
            }catch (Exception $excepcion)
            {
                    $salida='Excepci&oacute;n en listar Columnas';
            }
            return $this->renderText($salida);
    }
    
    //Cambios: 24 de febrero de 2014
    public function executeListarEtapas(sfWebRequest $request)
    {
            $salida='({"total":"0", "results":""})';
            $fila=0;
            $datos = array();

            try{

                    $conexion = new Criteria();
                    $conexion->add(EtapaPeer::ETA_ELIMINADO, 0);
                    $conexion->addAscendingOrderByColumn(EtapaPeer::ETA_NOMBRE);
                    $etapas = EtapaPeer::doSelect($conexion);

                    foreach($etapas As $temporal)
                    {
                            $datos[$fila]['eta_codigo'] = $temporal->getEtaCodigo();
                            $datos[$fila]['eta_nombre'] = $temporal->getEtaNombre();
                            $fila++;
                    }

                    if($fila>0){
                            $jsonresult = json_encode($datos);
                            $salida= '({"total":"'.$fila.'","results":'.$jsonresult.'})';
                    }
            }catch (Exception $excepcion)
            {
                    $salida='Excepci&oacute;n en listar Etapas';
            }
            return $this->renderText($salida);
    }
    
    //Verifica si un tiempo se encuentra guardado en un arreglo
    public function verificarTiempo($tiempo, $arreglo) {
        $var = false;
        for($i=0; $i<sizeof($arreglo); $i++) {
            if($tiempo == $arreglo[$i]) {
                $var =  true;
                $i = sizeof($arreglo);
            }
        }
        return $var;
    }
        
    
    //Cambios: 24 de febrero de 2014
    //Restar a la hora inicio el tiempo de inyección de la máquina
    public function operarHoraTiempoInyeccion($registro, $hora_inicio, $operacion) {
        //Obtener el tiempo de inyección de la máquina
        $maquina = MaquinaPeer::retrieveByPK($registro -> getRumMaqCodigo());
        $tiempo_inyeccion = $maquina->getMaqTiempoInyeccion();
        //Obtener la parte entera del tiempo de inyeccion para restarla en minutos a la hora de inicio de trabajo
        $entera = (int) ($tiempo_inyeccion);                
        $hora_minutos = date('H:i:s',strtotime($operacion.''.$entera.' minute', strtotime($hora_inicio)));
        //Obtener la parte decimal del tiempo de inyeccion para restarla en segundos a la hora de inicio de trabajo
        $decimal = round(($tiempo_inyeccion-$entera)*60);
        $hora_total = date('H:i:s',strtotime($operacion.''.$decimal.' second', strtotime($hora_minutos)));
        
        return $hora_total;
    }
    
    //Cambios: 24 de febrero de 2014
    //Sumar a la hora de fin el tiempo de la corrida
    public function operarHoraTiempoCorrida($registro, $hora_fin, $operacion) {
        //1. Se obtiene el primer TC diferente de cero de derecha a izquierda de las columnas de "Información de muestras"                
        $tc = array();
        $tc[] = number_format($registro -> getRumTcUniformidad(), 2, '.', '');
        $tc[] = number_format($registro -> getRumTcDisolucion(), 2, '.', '');
        $tc[] = number_format($registro -> getRumTcPureza(), 2, '.', '');
        $tc[] = number_format($registro -> getRumTcMateriaPrima(), 2, '.', '');
        $tc[] = number_format($registro -> getRumTcEstabilidad(), 2, '.', '');
        $tc[] = number_format($registro -> getRumTcProductoTerminado(), 2, '.', '');
        $tiempo_corrida_min = 0;
        $tiempo_corrida_seg = 0;
        for($i=0; $i<sizeof($tc); $i++) {
            if($tc[$i] != 0.00) {
                $tiempo_corrida_min += (int) ($tc[$i]);
                $tiempo_corrida_seg += round(($tc[$i]-$tiempo_corrida_min)*60);
                $i = sizeof($tc);
            }
        }
        //2. Se aplica la operación entre el tiempo de corrida y la hora de fin ingresada
        $hora_min = date('H:i:s',strtotime($operacion.''.$tiempo_corrida_min.' minute', strtotime($hora_fin)));
        $hora_total = date('H:i:s',strtotime($operacion.''.$tiempo_corrida_seg.' second', strtotime($hora_min)));
        
        return $hora_total;
    }

}