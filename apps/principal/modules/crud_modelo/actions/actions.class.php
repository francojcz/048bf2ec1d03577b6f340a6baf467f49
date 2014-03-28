<?php

/**
 * crud_modelo actions.
 *
 * @package    tpmlabs
 * @subpackage crud_modelo
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class crud_modeloActions extends sfActions
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
	 *Esta funcion permite crear y actualizar un modelo
	*/
	public function executeActualizarModelo(sfWebRequest $request)
	{
		$salida = '';
		try{
			$mod_codigo = $this->getRequestParameter('mod_codigo');
			$modelo = null;

			if($mod_codigo!=''){
				$modelo  = ModeloPeer::retrieveByPk($mod_codigo);

				if($modelo->getModEliminado()) {
					$salida = "({success: false, errors: { reason: 'No es posible modificar un modelo que ha sido eliminado'}})";
					return $this->renderText($salida);
				}
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
				$modelo->setModNombre($this->getRequestParameter('mod_nombre'));                                
				$modelo->setModFechaActualizacion(time());
				$modelo->setModUsuActualiza($this->getUser()->getAttribute('usu_codigo'));
				$modelo->setModCausaActualizacion($this->getRequestParameter('mod_causa_actualizacion'));
                                $modelo->setModMarCodigo($this->getRequestParameter('mod_marca'));

				$modelo->save();

				$salida = "({success: true, mensaje:'El modelo fue actualizado exitosamente'})";
			}
		}
		catch (Exception $excepcion)
		{
			$salida= "({success: false, errors: { reason: 'Hubo una excepci&oacute;n en modelo ".$excepcion."'}})";
		}

		return $this->renderText($salida);
	}
        
        /**
	 *Esta funcion permite listar los modelos registrados en el sistema
	*/
        public function executeListarModelo(sfWebRequest $request)
	{
		$salida='({"total":"0", "results":""})';
		$fila=0;
		$datos=array();

		try{
			$start=$this->getRequestParameter('start');
			$limit=$this->getRequestParameter('limit');
			$mod_eliminado=$this->getRequestParameter('mod_eliminado');//los de mostrar
			if($mod_eliminado==''){
				$mod_eliminado=0;
			}

			$conexion = new Criteria();
			$conexion->add(ModeloPeer::MOD_ELIMINADO,$mod_eliminado);

			$modelos_cantidad = ModeloPeer::doCount($conexion);

			if($start!=''){
				$conexion->setOffset($start);
				$conexion->setLimit($limit);
			}
			$modelo = ModeloPeer::doSelect($conexion);

			foreach($modelo as $temporal)
			{
				$datos[$fila]['mod_codigo']=$temporal->getModCodigo();
				$datos[$fila]['mod_nombre'] = $temporal->getModNombre();                                
				
				$datos[$fila]['mod_fecha_registro_sistema'] = $temporal->getModFechaRegistroSistema();
				$datos[$fila]['mod_fecha_actualizacion'] = $temporal->getModFechaActualizacion();				
				$datos[$fila]['mod_usu_crea_nombre'] = UsuarioPeer::obtenerNombreUsuario($temporal->getModUsuCrea());
				$datos[$fila]['mod_usu_actualiza_nombre'] = UsuarioPeer::obtenerNombreUsuario($temporal->getModUsuActualiza());
				$datos[$fila]['mod_eliminado'] = $temporal->getModEliminado();
				$datos[$fila]['mod_causa_eliminacion'] = $temporal->getModCausaEliminacion();
				$datos[$fila]['mod_causa_actualizacion'] = $temporal->getModCausaActualizacion();
				$fila++;
			}
			if($fila>0){
				$jsonresult = json_encode($datos);
				$salida= '({"total":"'.$modelos_cantidad.'","results":'.$jsonresult.'})';
			}
		}
		catch (Exception $excepcion)
		{
			return "({success: false, errors: { reason: 'Hubo una excepci&oacute;n en modelo ',error:".$excepcion->getMessage()."'}})";
		}

		return $this->renderText($salida);
	}        
        
        /**
	 *Esta funcion permite eliminar un modelo
	*/
        public function executeEliminarModelo(sfWebRequest $request)
	{
		$salida = '';

		try{
			$mod_codigo = $this->getRequestParameter('mod_codigo');
			$causa_eliminacion= $this->getRequestParameter('mod_causa_eliminacion');


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
			else
			{
				$salida = "({success: false,  errors: { reason: 'No ha seleccionado ning&uacute;n modelo'}})";
			}

		}
		catch (Exception $excepcion)
		{

			$salida= "({success: false, errors: { reason: 'Hubo una excepci&oacute;n en modelo al tratar de eliminar ', error:'".$excepcion->getMessage()."'}})";
		}

		return $this->renderText($salida);
	}
        
        /**
	 *Esta funcion permite restablecer un modelo eliminado
	*/
        public function executeRestablecerModelo()
	{
		$salida = "({success: false, errors: { reason: 'No se pudo restablecer el modelo'}})";
		try{
			$mod_codigo = $this->getRequestParameter('mod_codigo');
			$causa_reestablece= $this->getRequestParameter('mod_causa_restablece');


			$modelo  = ModeloPeer::retrieveByPk($mod_codigo);

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
        
        
        /**	 
	 *Esta funcion retorna un listado de marcas
	 */
	public function executeListarMarcas(sfWebRequest $request )
	{
		$salida='({"total":"0", "results":""})';
		$fila=0;
		$datos = array();

		try{
			$conexion = new Criteria();
			$conexion->add(MarcaPeer::MAR_ELIMINADO , 0);
                        $conexion->addAscendingOrderByColumn(MarcaPeer::MAR_NOMBRE);
			$marcas = MarcaPeer::doSelect($conexion);

			foreach($marcas as $temporal)
			{
				$datos[$fila]['mar_codigo'] = $temporal->getMarCodigo();
				$datos[$fila]['mar_nombre'] = $temporal->getMarNombre();
				
				$fila++;
			}
			if($fila>0){
				$jsonresult = json_encode($datos);
				$salida= '({"total":"'.$fila.'","results":'.$jsonresult.'})';
			}
		}
		catch (Exception $excepcion)
		{
			return "({success: false, errors: { reason: 'Hubo una excepci&oacute;n al listar Marcas ',error:'".$excepcion->getMessage()."'}})";
		}
		return $this->renderText($salida);
	}
        
}
