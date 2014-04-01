<?php

/**
 * maestra_etapa actions.
 *
 * @package    tpmlabs
 * @subpackage maestra_etapa
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class maestra_etapaActions extends sfActions
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
  
        /**
	 *Esta funcion permite crear y actualizar una Etapa
	*/
	public function executeActualizarEtapa(sfWebRequest $request)
	{
		$salida = '';

		try{
			$eta_codigo = $this->getRequestParameter('maestra_eta_codigo');
			$etapa;

			if($eta_codigo!=''){
				$etapa  = EtapaPeer::retrieveByPk($eta_codigo);
			}
			else
			{
				$etapa = new Etapa();
				$etapa->setEtaFechaRegistroSistema(time());
				$etapa->setEtaUsuCrea($this->getUser()->getAttribute('usu_codigo'));
				$etapa->setEtaEliminado(0);
			}

			if($etapa)
			{
				$etapa->setEtaNombre($this->getRequestParameter('maestra_eta_nombre'));
				$etapa->setEtaFechaActualizacion(time());
				$etapa->setEtaUsuActualiza($this->getUser()->getAttribute('usu_codigo'));
				$etapa->setEtaCausaActualizacion($this->getRequestParameter('maestra_eta_causa_actualizacion'));
				$etapa->save();

				$salida = "({success: true, mensaje:'La etapa fue actualizada exitosamente'})";
			}
		}
		catch (Exception $excepcion)
		{
			$salida= "({success: false, errors: { reason: 'Hubo una excepci&oacute;n en etapa',error:'".$excepcion->getMessage()."'}})";
		}

		return $this->renderText($salida);
	}
        
        /**
	 *Esta funcion retorna un listado de Etapas
	*/
	public function executeListarEtapa(sfWebRequest $request)
	{
		$salida = '({"total":"0", "results":""})';
		$fila = 0;
		$datos = array();

		try{
			$eta_eliminado=$this->getRequestParameter('eta_eliminado');//los de mostrar
			if($eta_eliminado==''){
				$eta_eliminado=0;
			}
			$conexion = new Criteria();
			$conexion->add(EtapaPeer::ETA_ELIMINADO,$eta_eliminado);
			$cantidad_etapa = EtapaPeer::doCount($conexion);
			$conexion->setOffset($this->getRequestParameter('start'));
			$conexion->setLimit($this->getRequestParameter('limit'));
			$etapa = EtapaPeer::doSelect($conexion);

			foreach($etapa as $temporal)
			{
				$datos[$fila]['maestra_eta_codigo']=$temporal->getEtaCodigo();
				$datos[$fila]['maestra_eta_nombre'] = $temporal->getEtaNombre();

				$datos[$fila]['maestra_eta_fecha_registro_sistema'] = $temporal->getEtaFechaRegistroSistema();
				$datos[$fila]['maestra_eta_fecha_actualizacion'] = $temporal->getEtaFechaActualizacion();
				$datos[$fila]['maestra_eta_usu_crea_nombre'] = UsuarioPeer::obtenerNombreUsuario($temporal->getEtaUsuCrea());
				$datos[$fila]['maestra_eta_usu_actualiza_nombre'] = UsuarioPeer::obtenerNombreUsuario($temporal->getEtaUsuActualiza());
				$datos[$fila]['maestra_eta_eliminado'] = $temporal->getEtaEliminado();
				$datos[$fila]['maestra_eta_causa_eliminacion'] = $temporal->getEtaCausaEliminacion();
				$datos[$fila]['maestra_eta_causa_actualizacion'] = $temporal->getEtaCausaActualizacion();

				$fila++;
			}
			if($fila>0){
				$jsonresult = json_encode($datos);
				$salida= '({"total":"'.$cantidad_etapa.'","results":'.$jsonresult.'})';
			}
		}
		catch (Exception $excepcion)
		{
			return "({success: false, errors: { reason: 'Hubo una excepci&oacute;n en evento al listar etapas',error:'".$excepcion->getMessage()."'}})";
		}
		return $this->renderText($salida);
	}
        
        
         /**	
	 *Esta funcion elimina una Etapa
	*/
	public function executeEliminarEtapa(sfWebRequest $request)
	{
		$salida = "({success: false,  errors: { reason: 'No ha seleccionado ninguna etapa'}})";

		try{
			$eta_codigo = $this->getRequestParameter('maestra_eta_codigo');
			$causa_eliminacion = $this->getRequestParameter('maestra_eta_causa_eliminacion');
				
			if($eta_codigo!=''){				
				$etapa  = EtapaPeer::retrieveByPk($eta_codigo);
				if($etapa){
					$etapa->setEtaUsuActualiza($this->getUser()->getAttribute('usu_codigo'));//es el usuario que lo elimina
					$etapa->setEtaFechaActualizacion(time());
					$etapa->setEtaEliminado(1);
					$etapa->setEtaCausaEliminacion($causa_eliminacion);
					$etapa->save();
					$salida = "({success: true, mensaje:'La etapa fue eliminada exitosamente'})";					
				}
			}
		}
		catch (Exception $excepcion)
		{

			$salida= "({success: false, errors: { reason: 'Hubo una excepci&oacute;n en etapas al tratar de eliminar',error:'".$excepcion->getMessage()."'}})";
		}
		return $this->renderText($salida);
	}
        
        /**
	 *Esta función permite restablecer un objeto eliminado
	*/
	public function executeRestablecerEtapa()
	{
		$salida = "({success: false, errors: { reason: 'No se pudo restablecer la etapa'}})";
		try{
			$eta_codigo = $this->getRequestParameter('maestra_eta_codigo');
			$causa_reestablece= $this->getRequestParameter('maestra_eta_causa_restablece');
				
				
			$etapa = EtapaPeer::retrieveByPk($eta_codigo);

			if($etapa)
			{
				$etapa->setEtaUsuActualiza($this->getUser()->getAttribute('usu_codigo'));//es el usuario que lo reestablece
				$etapa->setEtaFechaActualizacion(time());
				$etapa->setEtaEliminado(0);
				$etapa->setEtaCausaActualizacion($causa_reestablece);
				$etapa->save();
				$salida = "({success: true, mensaje:'La etapa fue restablecida exitosamente'})";
			}
		}
		catch (Exception $excepcion)
		{
			$salida= "({success: false, errors: { reason: 'Hubo una excepci&oacute;n',error:'".$excepcion->getMessage()."'}})";
		}
		return $this->renderText($salida);
	}
}
