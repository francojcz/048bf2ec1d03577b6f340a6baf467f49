<?php

/**
 * crud_faseligada actions.
 *
 * @package    tpmlabs
 * @subpackage crud_faseligada
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class crud_faseligadaActions extends sfActions
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
	 *Esta funcion permite crear y actualizar una fase ligada
	*/
	public function executeActualizarFaseLigada(sfWebRequest $request)
	{
		$salida = '';
		try{
			$fase_codigo = $this->getRequestParameter('fase_codigo');
			$fase = null;

			if($fase_codigo!=''){
				$fase  = FaseLigadaPeer::retrieveByPk($fase_codigo);

				if($fase->getFaseEliminado()) {
					$salida = "({success: false, errors: { reason: 'No es posible modificar una fase ligada que ha sido eliminada'}})";
					return $this->renderText($salida);
				}
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
				$fase->setFaseNombre($this->getRequestParameter('fase_nombre'));                                
				$fase->setFaseFechaActualizacion(time());
				$fase->setFaseUsuActualiza($this->getUser()->getAttribute('usu_codigo'));
				$fase->setFaseCausaActualizacion($this->getRequestParameter('fase_causa_actualizacion'));
                                $fase->setFaseModCodigo($this->getRequestParameter('fase_modelo'));

				$fase->save();

				$salida = "({success: true, mensaje:'La fase ligada fue actualizada exitosamente'})";
			}
		}
		catch (Exception $excepcion)
		{
			$salida= "({success: false, errors: { reason: 'Hubo una excepci&oacute;n en fase ligada ".$excepcion."'}})";
		}

		return $this->renderText($salida);
	}
        
        
        /**
	 *Esta funcion permite listar las fases ligadas registradas en el sistema
	*/
        public function executeListarFaseLigada(sfWebRequest $request)
	{
		$salida='({"total":"0", "results":""})';
		$fila=0;
		$datos=array();

		try{
			$start=$this->getRequestParameter('start');
			$limit=$this->getRequestParameter('limit');
			$fase_eliminado=$this->getRequestParameter('fase_eliminado');//los de mostrar
			if($fase_eliminado==''){
				$fase_eliminado=0;
			}

			$conexion = new Criteria();
			$conexion->add(FaseLigadaPeer::FASE_ELIMINADO,$fase_eliminado);

			$fase_cantidad = FaseLigadaPeer::doCount($conexion);

			if($start!=''){
				$conexion->setOffset($start);
				$conexion->setLimit($limit);
			}
			$fase = FaseLigadaPeer::doSelect($conexion);

			foreach($fase as $temporal)
			{
				$datos[$fila]['fase_codigo']=$temporal->getFaseCodigo();
				$datos[$fila]['fase_nombre'] = $temporal->getFaseNombre();
                                $datos[$fila]['fase_modelo'] = $temporal->getFaseModCodigo();
                                
                                $modelo = ModeloPeer::retrieveByPK($temporal->getFaseModCodigo());
                                $datos[$fila]['fase_modelo_nombre'] = $modelo->getModNombre();                               
				
				$datos[$fila]['fase_fecha_registro_sistema'] = $temporal->getFaseFechaRegistroSistema();
				$datos[$fila]['fase_fecha_actualizacion'] = $temporal->getFaseFechaActualizacion();				
				$datos[$fila]['fase_usu_crea_nombre'] = UsuarioPeer::obtenerNombreUsuario($temporal->getFaseUsuCrea());
				$datos[$fila]['fase_usu_actualiza_nombre'] = UsuarioPeer::obtenerNombreUsuario($temporal->getFaseUsuActualiza());
				$datos[$fila]['fase_eliminado'] = $temporal->getFaseEliminado();
				$datos[$fila]['fase_causa_eliminacion'] = $temporal->getFaseCausaEliminacion();
				$datos[$fila]['fase_causa_actualizacion'] = $temporal->getFaseCausaActualizacion();
				$fila++;
			}
			if($fila>0){
				$jsonresult = json_encode($datos);
				$salida= '({"total":"'.$fase_cantidad.'","results":'.$jsonresult.'})';
			}
		}
		catch (Exception $excepcion)
		{
			return "({success: false, errors: { reason: 'Hubo una excepci&oacute;n en fase ligada ',error:".$excepcion->getMessage()."'}})";
		}

		return $this->renderText($salida);
	}
        
        
        /**
	 *Esta funcion permite eliminar una fase ligada
	*/
        public function executeEliminarFaseLigada(sfWebRequest $request)
	{
		$salida = '';

		try{
			$fase_codigo = $this->getRequestParameter('fase_codigo');
			$causa_eliminacion= $this->getRequestParameter('fase_causa_eliminacion');


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
			else
			{
				$salida = "({success: false,  errors: { reason: 'No ha seleccionado ninguna fase ligada'}})";
			}

		}
		catch (Exception $excepcion)
		{

			$salida= "({success: false, errors: { reason: 'Hubo una excepci&oacute;n en fase al tratar de eliminar ', error:'".$excepcion->getMessage()."'}})";
		}

		return $this->renderText($salida);
	}
        
        /**
	 *Esta funcion permite restablecer una fase ligada
	*/
        public function executeRestablecerFaseLigada()
	{
		$salida = "({success: false, errors: { reason: 'No se pudo restablecer la fase ligada'}})";
		try{
			$fase_codigo = $this->getRequestParameter('fase_codigo');
			$causa_reestablece= $this->getRequestParameter('fase_causa_restablece');


			$fase  = FaseLigadaPeer::retrieveByPk($fase_codigo);

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
        
        
        /**	 
	 *Esta funcion retorna un listado de modelos
	 */
	public function executeListarModelos(sfWebRequest $request)
	{
		$salida='({"total":"0", "results":""})';
		$fila=0;
		$datos = array();

		try{
			$conexion = new Criteria();
			$conexion->add(ModeloPeer::MOD_ELIMINADO, 0);
                        $conexion->addAscendingOrderByColumn(ModeloPeer::MOD_NOMBRE);
			$modelos = ModeloPeer::doSelect($conexion);

			foreach($modelos as $temporal)
			{
				$datos[$fila]['mod_codigo'] = $temporal->getModCodigo();
				$datos[$fila]['mod_nombre'] = $temporal->getModNombre();
				
				$fila++;
			}
			if($fila>0){
				$jsonresult = json_encode($datos);
				$salida= '({"total":"'.$fila.'","results":'.$jsonresult.'})';
			}
		}
		catch (Exception $excepcion)
		{
			return "({success: false, errors: { reason: 'Hubo una excepci&oacute;n al listar Modelos ',error:'".$excepcion->getMessage()."'}})";
		}
		return $this->renderText($salida);
	}
}
