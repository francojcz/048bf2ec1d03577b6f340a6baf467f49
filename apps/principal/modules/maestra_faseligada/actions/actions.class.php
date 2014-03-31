<?php

/**
 * maestra_faseligada actions.
 *
 * @package    tpmlabs
 * @subpackage maestra_faseligada
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class maestra_faseligadaActions extends sfActions
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
	 *Esta funcion permite crear y actualizar una Fase Ligada
	*/
	public function executeActualizarFaseLigada(sfWebRequest $request)
	{
		$salida = '';

		try{
			$fase_codigo = $this->getRequestParameter('maestra_fase_codigo');
			$fase;

			if($fase_codigo!=''){
				$fase  = FaseLigadaPeer::retrieveByPk($fase_codigo);
			}
			else
			{
				$fase = new FaseLigada();
				$fase->setFaseFechaRegistroSistema(time());
				$fase->setFaseUsuCrea($this->getUser()->getAttribute('usu_codigo'));
				$fase->setFaseEliminado(0);
			}

			if($fase)
			{
				$fase->setFaseNombre($this->getRequestParameter('maestra_fase_nombre'));
				$fase->setFaseFechaActualizacion(time());
				$fase->setFaseUsuActualiza($this->getUser()->getAttribute('usu_codigo'));
				$fase->setFaseCausaActualizacion($this->getRequestParameter('maestra_fase_causa_actualizacion'));
				$fase->save();

				$salida = "({success: true, mensaje:'La fase ligada fue actualizada exitosamente'})";
			}
		}
		catch (Exception $excepcion)
		{
			$salida= "({success: false, errors: { reason: 'Hubo una excepci&oacute;n en fase ligada',error:'".$excepcion->getMessage()."'}})";
		}

		return $this->renderText($salida);
	}
        
        
        /**
	 *Esta funcion retorna un listado de Fases Ligadas
	*/
	public function executeListarFaseLigada(sfWebRequest $request)
	{
		$salida = '({"total":"0", "results":""})';
		$fila = 0;
		$datos = array();

		try{
			$fase_eliminado=$this->getRequestParameter('fase_eliminado');//los de mostrar
			if($fase_eliminado==''){
				$fase_eliminado=0;
			}
			$conexion = new Criteria();
			$conexion->add(FaseLigadaPeer::FASE_ELIMINADO,$fase_eliminado);
			$cantidad_fase = FaseLigadaPeer::doCount($conexion);
			$conexion->setOffset($this->getRequestParameter('start'));
			$conexion->setLimit($this->getRequestParameter('limit'));
			$fase = FaseLigadaPeer::doSelect($conexion);

			foreach($fase as $temporal)
			{
				$datos[$fila]['maestra_fase_codigo']=$temporal->getFaseCodigo();
				$datos[$fila]['maestra_fase_nombre'] = $temporal->getFaseNombre();

				$datos[$fila]['maestra_fase_fecha_registro_sistema'] = $temporal->getFaseFechaRegistroSistema();
				$datos[$fila]['maestra_fase_fecha_actualizacion'] = $temporal->getFaseFechaActualizacion();
				$datos[$fila]['maestra_fase_usu_crea_nombre'] = UsuarioPeer::obtenerNombreUsuario($temporal->getFaseUsuCrea());
				$datos[$fila]['maestra_fase_usu_actualiza_nombre'] = UsuarioPeer::obtenerNombreUsuario($temporal->getFaseUsuActualiza());
				$datos[$fila]['maestra_fase_eliminado'] = $temporal->getFaseEliminado();
				$datos[$fila]['maestra_fase_causa_eliminacion'] = $temporal->getFaseCausaEliminacion();
				$datos[$fila]['maestra_fase_causa_actualizacion'] = $temporal->getFaseCausaActualizacion();

				$fila++;
			}
			if($fila>0){
				$jsonresult = json_encode($datos);
				$salida= '({"total":"'.$cantidad_fase.'","results":'.$jsonresult.'})';
			}
		}
		catch (Exception $excepcion)
		{
			return "({success: false, errors: { reason: 'Hubo una excepci&oacute;n en evento al listar fases ligadas',error:'".$excepcion->getMessage()."'}})";
		}
		return $this->renderText($salida);
	}
        
        
        /**	
	 *Esta funcion elimina una Fase Ligada
	*/
	public function executeEliminarFaseLigada(sfWebRequest $request)
	{
		$salida = "({success: false,  errors: { reason: 'No ha seleccionado ninguna fase ligada'}})";

		try{
			$fase_codigo = $this->getRequestParameter('maestra_fase_codigo');
			$causa_eliminacion = $this->getRequestParameter('maestra_fase_causa_eliminacion');
				
			if($fase_codigo!=''){				
				$fase  = FaseLigadaPeer::retrieveByPk($fase_codigo);
				if($fase){
					$fase->setFaseUsuActualiza($this->getUser()->getAttribute('usu_codigo'));//es el usuario que lo elimina
					$fase->setFaseFechaActualizacion(time());
					$fase->setFaseEliminado(1);
					$fase->setFaseCausaEliminacion($causa_eliminacion);
					$fase->save();
					$salida = "({success: true, mensaje:'La fase ligada fue eliminada exitosamente'})";					
				}
			}
		}
		catch (Exception $excepcion)
		{

			$salida= "({success: false, errors: { reason: 'Hubo una excepci&oacute;n en fases ligadas al tratar de eliminar',error:'".$excepcion->getMessage()."'}})";
		}
		return $this->renderText($salida);
	}
        
        
        /**
	 *Esta función permite restablecer un objeto eliminado
	*/
	public function executeRestablecerFaseLigada()
	{
		$salida = "({success: false, errors: { reason: 'No se pudo restablecer la fase ligada'}})";
		try{
			$fase_codigo = $this->getRequestParameter('maestra_fase_codigo');
			$causa_reestablece= $this->getRequestParameter('maestra_fase_causa_restablece');
				
				
			$fase = FaseLigadaPeer::retrieveByPk($fase_codigo);

			if($fase)
			{
				$fase->setFaseUsuActualiza($this->getUser()->getAttribute('usu_codigo'));//es el usuario que lo reestablece
				$fase->setFaseFechaActualizacion(time());
				$fase->setFaseEliminado(0);
				$fase->setFaseCausaActualizacion($causa_reestablece);
				$fase->save();
				$salida = "({success: true, mensaje:'La fase ligada fue restablecida exitosamente'})";
			}
		}
		catch (Exception $excepcion)
		{
			$salida= "({success: false, errors: { reason: 'Hubo una excepci&oacute;n',error:'".$excepcion->getMessage()."'}})";
		}
		return $this->renderText($salida);
	}
}
