<?php

/**
 * crud_eliminarcertificado actions.
 *
 * @package    tpmlabs
 * @subpackage crud_eliminarcertificado
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class crud_eliminarcertificadoActions extends sfActions
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
        //Lista todos los equipos para las cuales se generó un certificado
        public function executeListarCertificado(sfWebRequest $request)
	{
		$salida = '({"total":"0", "results":""})';
		$fila = 0;
		$datos = array();

		try{			
			$start = $this->getRequestParameter('start');
			$limit = $this->getRequestParameter('limit');
			
                        $criteria = new Criteria();
			$certs_cantidad = ComputadorPeer::doCount($criteria);
			if($start!=''){
				$criteria->setOffset($start);
				$criteria->setLimit($limit);
			}                        
			$certificados = ComputadorPeer::doSelect($criteria);

			foreach($certificados as $temporal)
			{
				$datos[$fila]['com_nombre']=$temporal->getComNombre();				
				$fila++;
			}
			if($fila>0){
				$jsonresult = json_encode($datos);
				$salida= '({"total":"'.$certs_cantidad.'","results":'.$jsonresult.'})';
			}
		}
		catch (Exception $excepcion)
		{
			return "({success: false, errors: { reason: 'Hubo una excepci&oacute;n en certificados ',error:".$excepcion->getMessage()."'}})";
		}

		return $this->renderText($salida);
	}
        
        //Cambios: 24 de febrero de 2014
        //Elimina permanentemente un equipo certificado de la tabla computador
        public function executeEliminarCertificado(sfWebRequest $request)
	{
                $salida = '';
                try{
                    $com_nombre = $this->getRequestParameter('com_nombre');
                    if($com_nombre!='') {
                        $criteria = new Criteria();
                        $criteria->add(ComputadorPeer::COM_NOMBRE, $com_nombre);
                        $computador = ComputadorPeer::doSelectOne($criteria);

                        if($computador){
                                $computador->delete();
                                $salida = "({success: true, mensaje:'El computador fue eliminado exitosamente'})";
                        }
                    } else {
                        $salida = "({success: false,  errors: { reason: 'No ha seleccionado ning&uacute;n computador'}})";
                    }
                }
                catch (Exception $excepcion)
                {
                    $salida= "({success: false, errors: { reason: 'Hubo una excepci&oacute;n en computador al tratar de eliminar ',error:'".$excepcion->getMessage()."'}})";
                }

                return $this->renderText($salida);
	}
}
