<?php

/**
 * maestra_tamano actions.
 *
 * @package    tpmlabs
 * @subpackage maestra_tamano
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class maestra_tamanoActions extends sfActions
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
	 *Esta funcion permite crear y actualizar un Tamano
	*/
	public function executeActualizarTamano(sfWebRequest $request)
	{
		$salida = '';

		try{
			$tam_codigo = $this->getRequestParameter('maestra_tam_codigo');
			$tamano;

			if($tam_codigo!=''){
				$tamano  = TamanoParticulaPeer::retrieveByPk($tam_codigo);
			}
			else
			{
				$tamano = new TamanoParticula();
				$tamano->setTamFechaRegistroSistema(time());
				$tamano->setTamUsuCrea($this->getUser()->getAttribute('usu_codigo'));
				$tamano->setTamEliminado(0);
			}

			if($tamano)
			{
				$tamano->setTamNombre($this->getRequestParameter('maestra_tam_nombre'));
				$tamano->setTamFechaActualizacion(time());
				$tamano->setTamUsuActualiza($this->getUser()->getAttribute('usu_codigo'));
				$tamano->setTamCausaActualizacion($this->getRequestParameter('maestra_tam_causa_actualizacion'));
				$tamano->save();

				$salida = "({success: true, mensaje:'El tama&ntilde;o fue actualizado exitosamente'})";
			}
		}
		catch (Exception $excepcion)
		{
			$salida= "({success: false, errors: { reason: 'Hubo una excepci&oacute;n en tama&ntilde;o',error:'".$excepcion->getMessage()."'}})";
		}

		return $this->renderText($salida);
	}
        
        
        /**
	 *Esta funcion retorna un listado de Tamanos
	*/
	public function executeListarTamano(sfWebRequest $request)
	{
		$salida = '({"total":"0", "results":""})';
		$fila = 0;
		$datos = array();

		try{
			$tam_eliminado=$this->getRequestParameter('tam_eliminado');//los de mostrar
			if($tam_eliminado==''){
				$tam_eliminado=0;
			}
			$conexion = new Criteria();
			$conexion->add(TamanoParticulaPeer::TAM_ELIMINADO,$tam_eliminado);
			$cantidad_tamano = TamanoParticulaPeer::doCount($conexion);
			$conexion->setOffset($this->getRequestParameter('start'));
			$conexion->setLimit($this->getRequestParameter('limit'));
			$tamano = TamanoParticulaPeer::doSelect($conexion);

			foreach($tamano as $temporal)
			{
				$datos[$fila]['maestra_tam_codigo']=$temporal->getTamCodigo();
				$datos[$fila]['maestra_tam_nombre'] = $temporal->getTamNombre();

				$datos[$fila]['maestra_tam_fecha_registro_sistema'] = $temporal->getTamFechaRegistroSistema();
				$datos[$fila]['maestra_tam_fecha_actualizacion'] = $temporal->getTamFechaActualizacion();
				$datos[$fila]['maestra_tam_usu_crea_nombre'] = UsuarioPeer::obtenerNombreUsuario($temporal->getTamUsuCrea());
				$datos[$fila]['maestra_tam_usu_actualiza_nombre'] = UsuarioPeer::obtenerNombreUsuario($temporal->getTamUsuActualiza());
				$datos[$fila]['maestra_tam_eliminado'] = $temporal->getTamEliminado();
				$datos[$fila]['maestra_tam_causa_eliminacion'] = $temporal->getTamCausaEliminacion();
				$datos[$fila]['maestra_tam_causa_actualizacion'] = $temporal->getTamCausaActualizacion();

				$fila++;
			}
			if($fila>0){
				$jsonresult = json_encode($datos);
				$salida= '({"total":"'.$cantidad_tamano.'","results":'.$jsonresult.'})';
			}
		}
		catch (Exception $excepcion)
		{
			return "({success: false, errors: { reason: 'Hubo una excepci&oacute;n en evento al listar tama&ntilde;os',error:'".$excepcion->getMessage()."'}})";
		}
		return $this->renderText($salida);
	}
        
        
        /**	
	 *Esta funcion elimina un Tamano
	*/
	public function executeEliminarTamano(sfWebRequest $request)
	{
		$salida = "({success: false,  errors: { reason: 'No ha seleccionado ning&uacute;n tama&ntilde;o'}})";

		try{
			$tam_codigo = $this->getRequestParameter('maestra_tam_codigo');
			$causa_eliminacion = $this->getRequestParameter('maestra_tam_causa_eliminacion');
				
			if($tam_codigo!=''){				
				$tamano  = TamanoParticulaPeer::retrieveByPk($tam_codigo);
				if($tamano){
					$tamano->setTamUsuActualiza($this->getUser()->getAttribute('usu_codigo'));//es el usuario que lo elimina
					$tamano->setTamFechaActualizacion(time());
					$tamano->setTamEliminado(1);
					$tamano->setTamCausaEliminacion($causa_eliminacion);
					$tamano->save();
					$salida = "({success: true, mensaje:'El tama&ntilde;o fue eliminado exitosamente'})";					
				}
			}
		}
		catch (Exception $excepcion)
		{

			$salida= "({success: false, errors: { reason: 'Hubo una excepci&oacute;n en tama&ntilde;os al tratar de eliminar',error:'".$excepcion->getMessage()."'}})";
		}
		return $this->renderText($salida);
	}
        
        
        /**
	 *Esta función permite restablecer un objeto eliminado
	*/
	public function executeRestablecerTamano()
	{
		$salida = "({success: false, errors: { reason: 'No se pudo restablecer el tama&ntilde;o'}})";
		try{
			$tam_codigo = $this->getRequestParameter('maestra_tam_codigo');
			$causa_reestablece= $this->getRequestParameter('maestra_tam_causa_restablece');
				
				
			$tamano = TamanoParticulaPeer::retrieveByPk($tam_codigo);

			if($tamano)
			{
				$tamano->setTamUsuActualiza($this->getUser()->getAttribute('usu_codigo'));//es el usuario que lo reestablece
				$tamano->setTamFechaActualizacion(time());
				$tamano->setTamEliminado(0);
				$tamano->setTamCausaActualizacion($causa_reestablece);
				$tamano->save();
				$salida = "({success: true, mensaje:'El tama&ntilde;o fue restablecido exitosamente'})";
			}
		}
		catch (Exception $excepcion)
		{
			$salida= "({success: false, errors: { reason: 'Hubo una excepci&oacute;n',error:'".$excepcion->getMessage()."'}})";
		}
		return $this->renderText($salida);
	}
}
