<?php

/**
 * maestra_marca actions.
 *
 * @package    tpmlabs
 * @subpackage maestra_marca
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class maestra_marcaActions extends sfActions
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
	 *Esta funcion permite crear y actualizar una Marca
	*/
	public function executeActualizarMarca(sfWebRequest $request)
	{
		$salida = '';

		try{
			$mar_codigo = $this->getRequestParameter('maestra_mar_codigo');
			$marca;

			if($mar_codigo!=''){
				$marca  = MarcaPeer::retrieveByPk($mar_codigo);
			}
			else
			{
				$marca = new Marca();
				$marca->setMarFechaRegistroSistema(time());
				$marca->setMarUsuCrea($this->getUser()->getAttribute('usu_codigo'));
				$marca->setMarEliminado(0);
			}

			if($marca)
			{
				$marca->setMarNombre($this->getRequestParameter('maestra_mar_nombre'));
				$marca->setMarFechaActualizacion(time());
				$marca->setMarUsuActualiza($this->getUser()->getAttribute('usu_codigo'));
				$marca->setMarCausaActualizacion($this->getRequestParameter('maestra_mar_causa_actualizacion'));
				$marca->save();

				$salida = "({success: true, mensaje:'La marca fue actualizada exitosamente'})";
			}
		}
		catch (Exception $excepcion)
		{
			$salida= "({success: false, errors: { reason: 'Hubo una excepci&oacute;n en marca',error:'".$excepcion->getMessage()."'}})";
		}

		return $this->renderText($salida);
	}
        
        
        /**
	 *Esta funcion retorna un listado de Marcas
	*/
	public function executeListarMarca(sfWebRequest $request)
	{
		$salida = '({"total":"0", "results":""})';
		$fila = 0;
		$datos = array();

		try{
			$mar_eliminado=$this->getRequestParameter('mar_eliminado');//los de mostrar
			if($mar_eliminado==''){
				$mar_eliminado=0;
			}
			$conexion = new Criteria();
			$conexion->add(MarcaPeer::MAR_ELIMINADO,$mar_eliminado);
			$cantidad_evento = MarcaPeer::doCount($conexion);
			$conexion->setOffset($this->getRequestParameter('start'));
			$conexion->setLimit($this->getRequestParameter('limit'));
			$marca = MarcaPeer::doSelect($conexion);

			foreach($marca as $temporal)
			{
				$datos[$fila]['maestra_mar_codigo']=$temporal->getMarCodigo();
				$datos[$fila]['maestra_mar_nombre'] = $temporal->getMarNombre();

				$datos[$fila]['maestra_mar_fecha_registro_sistema'] = $temporal->getMarFechaRegistroSistema();
				$datos[$fila]['maestra_mar_fecha_actualizacion'] = $temporal->getMarFechaActualizacion();
				$datos[$fila]['maestra_mar_usu_crea_nombre'] = UsuarioPeer::obtenerNombreUsuario($temporal->getMarUsuCrea());
				$datos[$fila]['maestra_mar_usu_actualiza_nombre'] = UsuarioPeer::obtenerNombreUsuario($temporal->getMarUsuActualiza());
				$datos[$fila]['maestra_mar_eliminado'] = $temporal->getMarEliminado();
				$datos[$fila]['maestra_mar_causa_eliminacion'] = $temporal->getMarCausaEliminacion();
				$datos[$fila]['maestra_mar_causa_actualizacion'] = $temporal->getMarCausaActualizacion();

				$fila++;
			}
			if($fila>0){
				$jsonresult = json_encode($datos);
				$salida= '({"total":"'.$cantidad_evento.'","results":'.$jsonresult.'})';
			}
		}
		catch (Exception $excepcion)
		{
			return "({success: false, errors: { reason: 'Hubo una excepci&oacute;n en evento al listar marcas',error:'".$excepcion->getMessage()."'}})";
		}
		return $this->renderText($salida);
	}
        
        
        /**	
	 *Esta funcion elimina una Marca
	*/
	public function executeEliminarMarca(sfWebRequest $request)
	{
		$salida = "({success: false,  errors: { reason: 'No ha seleccionado ninguna marca'}})";

		try{
			$mar_codigo = $this->getRequestParameter('maestra_mar_codigo');
			$causa_eliminacion = $this->getRequestParameter('maestra_mar_causa_eliminacion');
				
			if($mar_codigo!=''){				
				$marca  = MarcaPeer::retrieveByPk($mar_codigo);
				if($marca){
					$marca->setMarUsuActualiza($this->getUser()->getAttribute('usu_codigo'));//es el usuario que lo elimina
					$marca->setMarFechaActualizacion(time());
					$marca->setMarEliminado(1);
					$marca->setMarCausaEliminacion($causa_eliminacion);
					$marca->save();
					$salida = "({success: true, mensaje:'La marca fue eliminada exitosamente'})";					
				}
			}
		}
		catch (Exception $excepcion)
		{

			$salida= "({success: false, errors: { reason: 'Hubo una excepci&oacute;n en marcas al tratar de eliminar',error:'".$excepcion->getMessage()."'}})";
		}
		return $this->renderText($salida);
	}
        
        
        /**
	 *Esta función permite restablecer un objeto eliminado
	*/
	public function executeRestablecerMarca()
	{
		$salida = "({success: false, errors: { reason: 'No se pudo restablecer la marcaa'}})";
		try{
			$mar_codigo = $this->getRequestParameter('maestra_mar_codigo');
			$causa_reestablece= $this->getRequestParameter('maestra_mar_causa_restablece');
				
				
			$marca  = MarcaPeer::retrieveByPk($mar_codigo);

			if($marca)
			{
				$marca->setMarUsuActualiza($this->getUser()->getAttribute('usu_codigo'));//es el usuario que lo reestablece
				$marca->setMarFechaActualizacion(time());
				$marca->setMarEliminado(0);
				$marca->setMarCausaActualizacion($causa_reestablece);
				$marca->save();
				$salida = "({success: true, mensaje:'La marca fue restablecida exitosamente'})";
			}
		}
		catch (Exception $excepcion)
		{
			$salida= "({success: false, errors: { reason: 'Hubo una excepci&oacute;n',error:'".$excepcion->getMessage()."'}})";
		}
		return $this->renderText($salida);
	}
}
