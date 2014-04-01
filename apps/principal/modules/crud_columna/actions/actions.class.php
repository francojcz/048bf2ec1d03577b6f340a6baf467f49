<?php

/**
 * crud_columna actions.
 *
 * @package    tpmlabs
 * @subpackage crud_columna
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class crud_columnaActions extends sfActions
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
	 *Esta funcion permite crear y actualizar una columna
	 */
	public function executeActualizarColumna(sfWebRequest $request)
	{
		$salida = '';
		try{
			$col_codigo = $this->getRequestParameter('col_codigo');
			$columna = null;

			if($col_codigo!=''){
				$columna  = ColumnaPeer::retrieveByPk($col_codigo);

				if($columna->getColEliminado()) {
					$salida = "({success: false, errors: { reason: 'No es posible modificar una columna que ha sido eliminada'}})";
					return $this->renderText($salida);
				}
			}
			else
			{
				$columna = new Columna();
				$columna->setColFechaRegistroSistema(time());
				$columna->setColUsuCrea($this->getUser()->getAttribute('usu_codigo'));
				$columna->setColEliminado(0);
			}

			if($columna)
			{
				$columna->setColCodigoInterno($this->getRequestParameter('col_codigo_interno'));                                
                                $columna->setColLote($this->getRequestParameter('col_lote'));
                                $columna->setColMarCodigo($this->getRequestParameter('col_mar_codigo'));
                                $columna->setColModCodigo($this->getRequestParameter('col_mod_codigo'));
                                
				$columna->setColFechaActualizacion(time());
				$columna->setColUsuActualiza($this->getUser()->getAttribute('usu_codigo'));
				$columna->setColCausaActualizacion($this->getRequestParameter('col_causa_actualizacion'));

				$columna->save();

				$salida = "({success: true, mensaje:'La columna fue actualizada exitosamente'})";
			}
		}
		catch (Exception $excepcion)
		{
			$salida= "({success: false, errors: { reason: 'Hubo una excepci&oacute;n en columna ".$excepcion."'}})";
		}

		return $this->renderText($salida);
	}        
        
        /**
	 *Esta funcion permite listar las columnas registradas en el sistema
	*/        
        public function executeListarColumna(sfWebRequest $request)
	{
		$salida='({"total":"0", "results":""})';
		$fila=0;
		$datos=array();

		try{
			$start=$this->getRequestParameter('start');
			$limit=$this->getRequestParameter('limit');
			$col_eliminado=$this->getRequestParameter('col_eliminado');//los de mostrar
			if($col_eliminado==''){
				$col_eliminado=0;
			}

			$conexion = new Criteria();
			$conexion->add(ColumnaPeer::COL_ELIMINADO,$col_eliminado);

			$columnas_cantidad = ColumnaPeer::doCount($conexion);

			if($start!=''){
				$conexion->setOffset($start);
				$conexion->setLimit($limit);
			}
			$columna = ColumnaPeer::doSelect($conexion);

			foreach($columna as $temporal)
			{

				$datos[$fila]['col_codigo']=$temporal->getColCodigo();
				$datos[$fila]['col_codigo_interno'] = $temporal->getColCodigoInterno();
                                $datos[$fila]['col_lote'] = $temporal->getColLote();
                                
                                //Información de la Marca
                                $datos[$fila]['col_mar_codigo'] = $temporal->getColMarCodigo();
                                $marca = MarcaPeer::retrieveByPK($temporal->getColMarCodigo());
                                $datos[$fila]['col_mar_nombre'] = $marca->getMarNombre();
                                
                                //Información del Modelo
                                $datos[$fila]['col_mod_codigo'] = $temporal->getColModCodigo();
                                $modelo = ModeloPeer::retrieveByPK($temporal->getColModCodigo());
                                $datos[$fila]['col_mod_nombre'] = $modelo->getModNombre();
				
				$datos[$fila]['col_fecha_registro_sistema'] = $temporal->getColFechaRegistroSistema();
				$datos[$fila]['col_fecha_actualizacion'] = $temporal->getColFechaActualizacion();				
				$datos[$fila]['col_usu_crea_nombre'] = UsuarioPeer::obtenerNombreUsuario($temporal->getColUsuCrea());
				$datos[$fila]['col_usu_actualiza_nombre'] = UsuarioPeer::obtenerNombreUsuario($temporal->getColUsuActualiza());
				$datos[$fila]['col_eliminado'] = $temporal->getColEliminado();
				$datos[$fila]['col_causa_eliminacion'] = $temporal->getColCausaEliminacion();
				$datos[$fila]['col_causa_actualizacion'] = $temporal->getColCausaActualizacion();
				$fila++;
			}
			if($fila>0){
				$jsonresult = json_encode($datos);
				$salida= '({"total":"'.$columnas_cantidad.'","results":'.$jsonresult.'})';
			}
		}
		catch (Exception $excepcion)
		{
			return "({success: false, errors: { reason: 'Hubo una excepci&oacute;n en columna ',error:".$excepcion->getMessage()."'}})";
		}

		return $this->renderText($salida);
	}
        
        /**
	 *Esta funcion permite eliminar una columna
	*/
        public function executeEliminarColumna(sfWebRequest $request)
	{
		$salida = '';

		try{
			$col_codigo = $this->getRequestParameter('col_codigo');
			$causa_eliminacion= $this->getRequestParameter('col_causa_eliminacion');


			if($col_codigo!=''){                            
				$columna  = ColumnaPeer::retrieveByPk($col_codigo);
				if($columna){
					$columna->setColUsuActualiza($this->getUser()->getAttribute('usu_codigo'));//es el usuario que lo elimina
					$columna->setColFechaActualizacion(time());
					$columna->setColEliminado(1);
					$columna->setColCausaEliminacion($causa_eliminacion);
					$columna->save();
					$salida = "({success: true, mensaje:'La columna fue eliminada exitosamente'})";
				}
			}
			else
			{
				$salida = "({success: false,  errors: { reason: 'No ha seleccionado ninguna columna'}})";
			}

		}
		catch (Exception $excepcion)
		{

			$salida= "({success: false, errors: { reason: 'Hubo una excepci&oacute;n en columna al tratar de eliminar ', error:'".$excepcion->getMessage()."'}})";
		}

		return $this->renderText($salida);
	}
        
        /**
	 *Esta funcion permite restablecer una columna eliminado
	*/
        public function executeRestablecerColumna()
	{
		$salida = "({success: false, errors: { reason: 'No se pudo restablecer la columna'}})";
		try{
			$col_codigo = $this->getRequestParameter('col_codigo');
			$causa_reestablece= $this->getRequestParameter('col_causa_restablece');


			$columna  = ColumnaPeer::retrieveByPk($col_codigo);

			if($columna)
			{
				$columna->setColUsuActualiza($this->getUser()->getAttribute('usu_codigo'));//es el usuario que lo reestablece
				$columna->setColFechaActualizacion(time());
				$columna->setColEliminado(0);
				$columna->setColCausaActualizacion($causa_reestablece);
				$columna->save();
				$salida = "({success: true, mensaje:'La columna fue restablecida exitosamente'})";
			}
		}
		catch (Exception $excepcion)
		{
			$salida= "({success: false, errors: { reason: 'Hubo una excepci&oacute;n',error:'".$excepcion->getMessage()."'}})";
		}
		return $this->renderText($salida);
	}        
        
        /**
	 *Esta funcion lista las marcas de columna
	*/
	public function executeListarMarcas(sfWebRequest $request)
	{
		$salida='({"total":"0", "results":""})';
		$fila=0;
		$datos = array();

		try{

			$conexion = new Criteria();
                        $conexion->addAscendingOrderByColumn(MarcaPeer::MAR_NOMBRE);
			$marcas = MarcaPeer::doSelect($conexion);

			foreach($marcas As $temporal)
			{
				$datos[$fila]['mar_codigo'] = $temporal->getMarCodigo();
				$datos[$fila]['mar_nombre'] = $temporal->getMarNombre();
				$fila++;
			}

			if($fila>0){
				$jsonresult = json_encode($datos);
				$salida= '({"total":"'.$fila.'","results":'.$jsonresult.'})';
			}
		}catch (Exception $excepcion)
		{
			$salida='Exception en listar Marcas';
		}
		return $this->renderText($salida);
	}
        
        /**
	 *Esta funcion lista los modelos de columna
	*/
	public function executeListarModelos(sfWebRequest $request)
	{
		$salida='({"total":"0", "results":""})';
		$fila=0;
		$datos = array();

		try{

			$conexion = new Criteria();
                        $conexion->addAscendingOrderByColumn(ModeloPeer::MOD_NOMBRE);
			$modelos = ModeloPeer::doSelect($conexion);

			foreach($modelos As $temporal)
			{
				$datos[$fila]['mod_codigo'] = $temporal->getModCodigo();
				$datos[$fila]['mod_nombre'] = $temporal->getModNombre();
				$fila++;
			}

			if($fila>0){
				$jsonresult = json_encode($datos);
				$salida= '({"total":"'.$fila.'","results":'.$jsonresult.'})';
			}
		}catch (Exception $excepcion)
		{
			$salida='Exception en listar Modelos';
		}
		return $this->renderText($salida);
	}
}