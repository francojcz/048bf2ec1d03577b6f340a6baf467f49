<?php

/**
 * maestra_grupoequipo actions.
 *
 * @package    tpmlabs
 * @subpackage maestra_grupoequipo
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class maestra_grupoequipoActions extends sfActions
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
  
        //Cambios: 24 de febrero de 2014
        
        //La siguiente función crea y actualiza un grupo de equipos
	public function executeActualizarGrupo(sfWebRequest $request)
	{
		$salida = '';

		try{
			$gru_codigo = $this->getRequestParameter('maestra_gru_codigo');
			$grupo;
				
			if($gru_codigo!=''){
				$grupo  = GrupoEquipoPeer::retrieveByPk($gru_codigo);
			}
			else
			{
				$grupo = new GrupoEquipo();
				$grupo->setGruFechaRegistroSistema(time());
				$grupo->setGruUsuCrea($this->getUser()->getAttribute('usu_codigo'));
				$grupo->setGruEliminado(0);
			}
				
			if($grupo)
			{
				$grupo->setGruNombre($this->getRequestParameter('maestra_gru_nombre'));
				$grupo->setGruFechaActualizacion(time());
				$grupo->setGruUsuActualiza($this->getUser()->getAttribute('usu_codigo'));
				$grupo->setGruCausaActualizacion($this->getRequestParameter('maestra_gru_causa_actualizacion'));
				
				$grupo->save();

				$salida = "({success: true, mensaje:'El grupo de equipos fue actualizado exitosamente'})";
			}
		}
		catch (Exception $excepcion)
		{
			$salida= "({success: false, errors: { reason: 'Hubo una excepci&oacute;n en grupo equipos',error:'".$excepcion->getMessage()."'}})";
		}

		return $this->renderText($salida);
	}
        
        //La siguiente función retorna un listado de grupo de equipos
        public function executeListarGrupo(sfWebRequest $request)
	{
		$salida = '({"total":"0", "results":""})';
		$fila = 0;
		$datos = array();

		try{
			$gru_eliminado=$this->getRequestParameter('gru_eliminado');//los de mostrar
			if($gru_eliminado==''){
				$gru_eliminado=0;
			}
			$conexion = new Criteria();
			$conexion->add(GrupoEquipoPeer::GRU_ELIMINADO,$gru_eliminado);	
			$cantidad_grupo = GrupoEquipoPeer::doCount($conexion);
			$conexion->setOffset($this->getRequestParameter('start'));
			$conexion->setLimit($this->getRequestParameter('limit'));
			$grupo = GrupoEquipoPeer::doSelect($conexion);

			foreach($grupo as $temporal)
			{
				$datos[$fila]['maestra_gru_codigo']=$temporal->getGruCodigo();
				$datos[$fila]['maestra_gru_nombre'] = $temporal->getGruNombre();
				
				$datos[$fila]['maestra_gru_fecha_registro_sistema'] = $temporal->getGruFechaRegistroSistema();
				$datos[$fila]['maestra_gru_fecha_actualizacion'] = $temporal->getGruFechaActualizacion();				
				
				$datos[$fila]['maestra_gru_usu_crea_nombre'] = UsuarioPeer::obtenerNombreUsuario($temporal->getGruUsuCrea());
				$datos[$fila]['maestra_gru_usu_actualiza_nombre'] = UsuarioPeer::obtenerNombreUsuario($temporal->getGruUsuActualiza());
				
				$datos[$fila]['maestra_gru_eliminado'] = $temporal->getGruEliminado();
				$datos[$fila]['maestra_gru_causa_eliminacion'] = $temporal->getGruCausaEliminacion();
				$datos[$fila]['maestra_gru_causa_actualizacion'] = $temporal->getGruCausaActualizacion();
				$fila++;
			}
			if($fila>0){
				$jsonresult = json_encode($datos);
				$salida= '({"total":"'.$cantidad_grupo.'","results":'.$jsonresult.'})';
			}
		}
		catch (Exception $excepcion)
		{
			return "({success: false, errors: { reason: 'Hubo una excepci&oacute;n en grupo de equipos al listar ',error:'".$excepcion->getMessage()."'}})";
		}
		return $this->renderText($salida);
	}
        
        //La siguiente función elimina un grupo de equipos
        public function executeEliminarGrupo(sfWebRequest $request)
	{
		$salida = "({success: false,  errors: { reason: 'No ha seleccionado ning&uacute;n grupo de equipos'}})";
		try{
			$gru_codigo = $this->getRequestParameter('maestra_gru_codigo');
			$causa_eliminacion = $this->getRequestParameter('maestra_gru_causa_eliminacion');			
			$grupo;
				
			if($gru_codigo!=''){
                            $grupo  = GrupoEquipoPeer::retrieveByPk($gru_codigo);
                            if($grupo){
                                    $grupo->setGruUsuActualiza($this->getUser()->getAttribute('usu_codigo'));//es el usuario que lo elimina
                                    $grupo->setGruFechaActualizacion(time());
                                    $grupo->setGruEliminado(1);
                                    $grupo->setGruCausaEliminacion($causa_eliminacion);
                                    $grupo->save();
                                    $salida = "({success: true, mensaje:'El grupo de equipos fue eliminado exitosamente'})";

                            }				
			}
		}
		catch (Exception $excepcion)
		{
				
			$salida= "({success: false, errors: { reason: 'Hubo una excepci&oacute;n en grupo de equipos al tratar de eliminar',error:'".$excepcion->getMessage()."'}})";
		}
		return $this->renderText($salida);
	}
        
        //La siguiente función restablece un grupo de equipos
        public function executeRestablecerGrupo()
	{
		$salida = "({success: false, errors: { reason: 'No se pudo restablecer el grupo de equipos'}})";
		try{
			$gru_codigo = $this->getRequestParameter('maestra_gru_codigo');
			$causa_reestablece= $this->getRequestParameter('maestra_gru_causa_restablece');
			
			
			$grupo  = GrupoEquipoPeer::retrieveByPk($gru_codigo);
				
				if($grupo)
				{
					$grupo->setGruUsuActualiza($this->getUser()->getAttribute('usu_codigo'));//es el usuario que lo reestablece
					$grupo->setGruFechaActualizacion(time());
					$grupo->setGruEliminado(0);
					$grupo->setGruCausaActualizacion($causa_reestablece);
					$grupo->save();
					$salida = "({success: true, mensaje:'El grupo fue restablecido exitosamente'})";
				}
		}
		catch (Exception $excepcion)
		{
			$salida= "({success: false, errors: { reason: 'Hubo una excepci&oacute;n',error:'".$excepcion->getMessage()."'}})";
		}
		return $this->renderText($salida);
	}
        
        //La siguiente función retorna un listado con los equipos que tiene un grupo
        public function executeListarEquiposporgrupo(sfWebRequest $request )
	{
		$gru_codigo = $this->getRequestParameter('maestra_gru_codigo');
		
		$salida = '({"total":"0", "results":""})';
		$fila = 0;
		$datos = array();

		try{
			$conexion = new Criteria();
			$conexion->addJoin(GrupoPorEquipoPeer::GREQ_MAQ_CODIGO, MaquinaPeer::MAQ_CODIGO);
			$conexion->add(GrupoPorEquipoPeer::GREQ_GRU_CODIGO, $gru_codigo);	
			$conexion->add(MaquinaPeer::MAQ_ELIMINADO, 0);	
			$maquinas = MaquinaPeer::doSelect($conexion);

			foreach($maquinas as $temporal)
			{
                            $datos[$fila]['maestra_greq_maq_codigo'] = $temporal->getMaqCodigo();
                            $datos[$fila]['maestra_greq_maq_nombre'] = $temporal->getMaqNombre();

                            $fila++;
			}
			if($fila>0){
				$jsonresult = json_encode($datos);
				$salida= '({"total":"'.$fila.'","results":'.$jsonresult.'})';
			}
		}
		catch (Exception $excepcion)
		{
			return "({success: false, errors: { reason: 'Hubo una excepci&oacute;n al listar M&aacute;quinas por Grupo ',error:'".$excepcion->getMessage()."'}})";
		}
		return $this->renderText($salida);
	}
        
        //La siguiente función retorna un listado con los equipos
        public function executeListarMaquinas(sfWebRequest $request )
	{
		$salida = '({"total":"0", "results":""})';
		$fila = 0;
		$datos = array();

		try{
			$conexion = new Criteria();
			$conexion->add(MaquinaPeer::MAQ_ELIMINADO, 0);	
			$maquinas = MaquinaPeer::doSelect($conexion);

			foreach($maquinas as $temporal)
			{
				$datos[$fila]['maq_codigo'] = $temporal->getMaqCodigo();
				$datos[$fila]['maq_nombre'] = $temporal->getMaqNombre();
				
				$fila++;
			}
			if($fila>0){
				$jsonresult = json_encode($datos);
				$salida= '({"total":"'.$fila.'","results":'.$jsonresult.'})';
			}
		}
		catch (Exception $excepcion)
		{
			return "({success: false, errors: { reason: 'Hubo una excepci&oacute;n al listar M&aacute;quinas ',error:'".$excepcion->getMessage()."'}})";
		}
		return $this->renderText($salida);
	}
        
        //La siguiente función guarda grupos por equipo
        public function executeGuardarGrupoPorEquipo(sfWebRequest $request)
	{
		$salida = "({success: true, mensaje:'La asignaci&oacute;n de grupo a m&aacute;quina no fue realizada'})";

		try{
			$gru_codigo = $this->getRequestParameter('gru_codigo');
			$maq_codigo = $this->getRequestParameter('maq_codigo');
				
			if($gru_codigo!='' && $maq_codigo!=''){			
				$conexion = new Criteria();
				$conexion->add(GrupoPorEquipoPeer::GREQ_MAQ_CODIGO, $maq_codigo);
				$conexion->addAnd(GrupoPorEquipoPeer::GREQ_GRU_CODIGO, $gru_codigo);
				$grupoporequipo = GrupoPorEquipoPeer::doSelect($conexion);

				if($grupoporequipo)
				{
					$salida = "({success: true, mensaje:'El equipo ya hab&iacute;a sido asignado al grupo'})";
				}
				else
				{
					$grupoporequipo = new GrupoPorEquipo();
					$grupoporequipo->setGreqGruCodigo($gru_codigo);
					$grupoporequipo->setGreqMaqCodigo($maq_codigo);
					$grupoporequipo->setGreqFechaRegistroSistema(time());
					$grupoporequipo->setGreqUsuCrea($this->getUser()->getAttribute('usu_codigo'));
					$grupoporequipo->save();

					$salida = "({success: true, mensaje:'La asignaci&oacute;n del equipo al grupo ha sido realizada exitosamente'})";
				}
				
			}
		}
		catch (Exception $excepcion)
		{
			$salida= "({success: false, errors: { reason: 'Hubo una excepci&oacute;n en equipo por grupo ',error:'".$excepcion->getMessage()."'}})";
		}

		return $this->renderText($salida);
	}
        
        //La siguiente función elimina un equipo de un grupo
        public function executeEliminarGrupoPorEquipo(sfWebRequest $request)
	{
		$salida = "({success: true, mensaje:'La asignaci&oacute; de equipo a grupo no fue eliminada'})";
		
		try{
			$gru_codigo = $this->getRequestParameter('gru_codigo');
			$temp = $this->getRequestParameter('maqs_codigos');
			$maqs_codigos = json_decode($temp);
		
			if($gru_codigo!='' ){
				foreach ($maqs_codigos as $maq_codigo)
				{
					$conexion = new Criteria();
					$conexion->add(GrupoPorEquipoPeer::GREQ_MAQ_CODIGO, $maq_codigo);
					$conexion->addAnd(GrupoPorEquipoPeer::GREQ_GRU_CODIGO, $gru_codigo);
					$grupoporequipo = GrupoPorEquipoPeer::doSelectOne($conexion);

					if($grupoporequipo)
					{
						$grupoporequipo->delete();
						$salida = "({success: true, mensaje:'El equipo ha ha sido eliminado exitosamente del grupo'})";
					}
				}
			}
		}
		catch (Exception $excepcion)
		{
			$salida= "({success: false, errors: { reason: 'Hubo una excepci&oacute;n en grupo por equipo ',error:'".$excepcion->getMessage()."'}})";
		}

		return $this->renderText($salida);
	}
}
