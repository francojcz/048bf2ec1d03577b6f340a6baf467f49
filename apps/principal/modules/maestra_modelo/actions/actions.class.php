<?php

/**
 * maestra_modelo actions.
 *
 * @package    tpmlabs
 * @subpackage maestra_modelo
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class maestra_modeloActions extends sfActions
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
	 *Esta funcion permite crear y actualizar un Modelo
	*/
	public function executeActualizarModelo(sfWebRequest $request)
	{
		$salida = '';

		try{
			$mod_codigo = $this->getRequestParameter('maestra_mod_codigo');
			$modelo;

			if($mod_codigo!=''){
				$modelo  = ModeloPeer::retrieveByPk($mod_codigo);
			}
			else
			{
				$modelo = new Modelo();
				$modelo->setModFechaRegistroSistema(time());
				$modelo->setModUsuCrea($this->getUser()->getAttribute('usu_codigo'));
				$modelo->setModEliminado(0);
			}

			if($modelo)
			{
				$modelo->setModNombre($this->getRequestParameter('maestra_mod_nombre'));
				$modelo->setModFechaActualizacion(time());
				$modelo->setModUsuActualiza($this->getUser()->getAttribute('usu_codigo'));
				$modelo->setModCausaActualizacion($this->getRequestParameter('maestra_mod_causa_actualizacion'));
				$modelo->save();

				$salida = "({success: true, mensaje:'El modelo fue actualizado exitosamente'})";
			}
		}
		catch (Exception $excepcion)
		{
			$salida= "({success: false, errors: { reason: 'Hubo una excepci&oacute;n en modelo',error:'".$excepcion->getMessage()."'}})";
		}

		return $this->renderText($salida);
	}
        
        
        /**
	 *Esta funcion retorna un listado de Modelos
	*/
	public function executeListarModelo(sfWebRequest $request)
	{
		$salida = '({"total":"0", "results":""})';
		$fila = 0;
		$datos = array();

		try{
			$mod_eliminado=$this->getRequestParameter('mod_eliminado');//los de mostrar
			if($mod_eliminado==''){
				$mod_eliminado=0;
			}
			$conexion = new Criteria();
			$conexion->add(ModeloPeer::MOD_ELIMINADO,$mod_eliminado);
			$cantidad_modelo = ModeloPeer::doCount($conexion);
			$conexion->setOffset($this->getRequestParameter('start'));
			$conexion->setLimit($this->getRequestParameter('limit'));
			$modelo = ModeloPeer::doSelect($conexion);

			foreach($modelo as $temporal)
			{
				$datos[$fila]['maestra_mod_codigo']=$temporal->getModCodigo();
				$datos[$fila]['maestra_mod_nombre'] = $temporal->getModNombre();

				$datos[$fila]['maestra_mod_fecha_registro_sistema'] = $temporal->getModFechaRegistroSistema();
				$datos[$fila]['maestra_mod_fecha_actualizacion'] = $temporal->getModFechaActualizacion();
				$datos[$fila]['maestra_mod_usu_crea_nombre'] = UsuarioPeer::obtenerNombreUsuario($temporal->getModUsuCrea());
				$datos[$fila]['maestra_mod_usu_actualiza_nombre'] = UsuarioPeer::obtenerNombreUsuario($temporal->getModUsuActualiza());
				$datos[$fila]['maestra_mod_eliminado'] = $temporal->getModEliminado();
				$datos[$fila]['maestra_mod_causa_eliminacion'] = $temporal->getModCausaEliminacion();
				$datos[$fila]['maestra_mod_causa_actualizacion'] = $temporal->getModCausaActualizacion();

				$fila++;
			}
			if($fila>0){
				$jsonresult = json_encode($datos);
				$salida= '({"total":"'.$cantidad_modelo.'","results":'.$jsonresult.'})';
			}
		}
		catch (Exception $excepcion)
		{
			return "({success: false, errors: { reason: 'Hubo una excepci&oacute;n en evento al listar modelos',error:'".$excepcion->getMessage()."'}})";
		}
		return $this->renderText($salida);
	}
        
        
        /**	
	 *Esta funcion elimina un Modelo
	*/
	public function executeEliminarModelo(sfWebRequest $request)
	{
		$salida = "({success: false,  errors: { reason: 'No ha seleccionado ning&uacute;n modelo'}})";

		try{
			$mod_codigo = $this->getRequestParameter('maestra_mod_codigo');
			$causa_eliminacion = $this->getRequestParameter('maestra_mod_causa_eliminacion');
				
			if($mod_codigo!=''){				
				$modelo  = ModeloPeer::retrieveByPk($mod_codigo);
				if($modelo){
					$modelo->setModUsuActualiza($this->getUser()->getAttribute('usu_codigo'));//es el usuario que lo elimina
					$modelo->setModFechaActualizacion(time());
					$modelo->setModEliminado(1);
					$modelo->setModCausaEliminacion($causa_eliminacion);
					$modelo->save();
					$salida = "({success: true, mensaje:'El modelo fue eliminado exitosamente'})";					
				}
			}
		}
		catch (Exception $excepcion)
		{

			$salida= "({success: false, errors: { reason: 'Hubo una excepci&oacute;n en modelos al tratar de eliminar',error:'".$excepcion->getMessage()."'}})";
		}
		return $this->renderText($salida);
	}
        
        
        /**
	 *Esta función permite restablecer un objeto eliminado
	*/
	public function executeRestablecerModelo()
	{
		$salida = "({success: false, errors: { reason: 'No se pudo restablecer el modelo'}})";
		try{
			$mod_codigo = $this->getRequestParameter('maestra_mod_codigo');
			$causa_reestablece= $this->getRequestParameter('maestra_mod_causa_restablece');
				
				
			$modelo = ModeloPeer::retrieveByPk($mod_codigo);

			if($modelo)
			{
				$modelo->setModUsuActualiza($this->getUser()->getAttribute('usu_codigo'));//es el usuario que lo reestablece
				$modelo->setModFechaActualizacion(time());
				$modelo->setModEliminado(0);
				$modelo->setModCausaActualizacion($causa_reestablece);
				$modelo->save();
				$salida = "({success: true, mensaje:'El modelo fue restablecido exitosamente'})";
			}
		}
		catch (Exception $excepcion)
		{
			$salida= "({success: false, errors: { reason: 'Hubo una excepci&oacute;n',error:'".$excepcion->getMessage()."'}})";
		}
		return $this->renderText($salida);
	}
}
