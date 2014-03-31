<?php

/**
 * maestra_dimension actions.
 *
 * @package    tpmlabs
 * @subpackage maestra_dimension
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class maestra_dimensionActions extends sfActions
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
	 *Esta funcion permite crear y actualizar una Dimension
	*/
	public function executeActualizarDimension(sfWebRequest $request)
	{
		$salida = '';

		try{
			$dim_codigo = $this->getRequestParameter('maestra_dim_codigo');
			$dimension;

			if($dim_codigo!=''){
				$dimension  = DimensionPeer::retrieveByPk($dim_codigo);
			}
			else
			{
				$dimension = new Dimension();
				$dimension->setDimFechaRegistroSistema(time());
				$dimension->setDimUsuCrea($this->getUser()->getAttribute('usu_codigo'));
				$dimension->setDimEliminado(0);
			}

			if($dimension)
			{
				$dimension->setDimNombre($this->getRequestParameter('maestra_dim_nombre'));
				$dimension->setDimFechaActualizacion(time());
				$dimension->setDimUsuActualiza($this->getUser()->getAttribute('usu_codigo'));
				$dimension->setDimCausaActualizacion($this->getRequestParameter('maestra_dim_causa_actualizacion'));
				$dimension->save();

				$salida = "({success: true, mensaje:'La dimensi&oacute;n fue actualizada exitosamente'})";
			}
		}
		catch (Exception $excepcion)
		{
			$salida= "({success: false, errors: { reason: 'Hubo una excepci&oacute;n en dimensi&oacute;n',error:'".$excepcion->getMessage()."'}})";
		}

		return $this->renderText($salida);
	}
        
        
        /**
	 *Esta funcion retorna un listado de Dimensiones
	*/
	public function executeListarDimension(sfWebRequest $request)
	{
		$salida = '({"total":"0", "results":""})';
		$fila = 0;
		$datos = array();

		try{
			$dim_eliminado=$this->getRequestParameter('dim_eliminado');//los de mostrar
			if($dim_eliminado==''){
				$dim_eliminado=0;
			}
			$conexion = new Criteria();
			$conexion->add(DimensionPeer::DIM_ELIMINADO,$dim_eliminado);
			$cantidad_dimension = DimensionPeer::doCount($conexion);
			$conexion->setOffset($this->getRequestParameter('start'));
			$conexion->setLimit($this->getRequestParameter('limit'));
			$dimension = DimensionPeer::doSelect($conexion);

			foreach($dimension as $temporal)
			{
				$datos[$fila]['maestra_dim_codigo']=$temporal->getDimCodigo();
				$datos[$fila]['maestra_dim_nombre'] = $temporal->getDimNombre();

				$datos[$fila]['maestra_dim_fecha_registro_sistema'] = $temporal->getDimFechaRegistroSistema();
				$datos[$fila]['maestra_dim_fecha_actualizacion'] = $temporal->getDimFechaActualizacion();
				$datos[$fila]['maestra_dim_usu_crea_nombre'] = UsuarioPeer::obtenerNombreUsuario($temporal->getDimUsuCrea());
				$datos[$fila]['maestra_dim_usu_actualiza_nombre'] = UsuarioPeer::obtenerNombreUsuario($temporal->getDimUsuActualiza());
				$datos[$fila]['maestra_dim_eliminado'] = $temporal->getDimEliminado();
				$datos[$fila]['maestra_dim_causa_eliminacion'] = $temporal->getDimCausaEliminacion();
				$datos[$fila]['maestra_dim_causa_actualizacion'] = $temporal->getDimCausaActualizacion();

				$fila++;
			}
			if($fila>0){
				$jsonresult = json_encode($datos);
				$salida= '({"total":"'.$cantidad_dimension.'","results":'.$jsonresult.'})';
			}
		}
		catch (Exception $excepcion)
		{
			return "({success: false, errors: { reason: 'Hubo una excepci&oacute;n en evento al listar dimensiones',error:'".$excepcion->getMessage()."'}})";
		}
		return $this->renderText($salida);
	}
        
        
        /**	
	 *Esta funcion elimina una Dimensión
	*/
	public function executeEliminarDimension(sfWebRequest $request)
	{
		$salida = "({success: false,  errors: { reason: 'No ha seleccionado ninguna dimensi&oacute;n'}})";

		try{
			$dim_codigo = $this->getRequestParameter('maestra_dim_codigo');
			$causa_eliminacion = $this->getRequestParameter('maestra_dim_causa_eliminacion');
				
			if($dim_codigo!=''){				
				$dimension  = DimensionPeer::retrieveByPk($dim_codigo);
				if($dimension){
					$dimension->setDimUsuActualiza($this->getUser()->getAttribute('usu_codigo'));//es el usuario que lo elimina
					$dimension->setDimFechaActualizacion(time());
					$dimension->setDimEliminado(1);
					$dimension->setDimCausaEliminacion($causa_eliminacion);
					$dimension->save();
					$salida = "({success: true, mensaje:'La dimensi&oacute;n fue eliminada exitosamente'})";					
				}
			}
		}
		catch (Exception $excepcion)
		{

			$salida= "({success: false, errors: { reason: 'Hubo una excepci&oacute;n en dimensiones al tratar de eliminar',error:'".$excepcion->getMessage()."'}})";
		}
		return $this->renderText($salida);
	}
        
        
        /**
	 *Esta función permite restablecer un objeto eliminado
	*/
	public function executeRestablecerDimension()
	{
		$salida = "({success: false, errors: { reason: 'No se pudo restablecer la dimensi&oacute;n'}})";
		try{
			$dim_codigo = $this->getRequestParameter('maestra_dim_codigo');
			$causa_reestablece= $this->getRequestParameter('maestra_dim_causa_restablece');
				
				
			$dimension = DimensionPeer::retrieveByPk($dim_codigo);

			if($dimension)
			{
				$dimension->setDimUsuActualiza($this->getUser()->getAttribute('usu_codigo'));//es el usuario que lo reestablece
				$dimension->setDimFechaActualizacion(time());
				$dimension->setDimEliminado(0);
				$dimension->setDimCausaActualizacion($causa_reestablece);
				$dimension->save();
				$salida = "({success: true, mensaje:'La dimensi&oacute;n fue restablecida exitosamente'})";
			}
		}
		catch (Exception $excepcion)
		{
			$salida= "({success: false, errors: { reason: 'Hubo una excepci&oacute;n',error:'".$excepcion->getMessage()."'}})";
		}
		return $this->renderText($salida);
	}  
}
