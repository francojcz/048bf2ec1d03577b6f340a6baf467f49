<?php

/**
 * interfaz_reporte actions.
 *
 * @package    tpmlabs
 * @subpackage interfaz_reporte
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class interfaz_reporteActions extends sfActions
{
	/**
	 * Executes index action
	 *
	 * @param sfRequest $request A request object
	 */
	public function executeIndex(sfWebRequest $request)
	{
		//$this->forward('default', 'module');
		$nombreEmpresa='';
		$urlLogo='';

		try{
			$user = $this->getUser();
			$codigo_usuario = $user->getAttribute('usu_codigo');
			$criteria = new Criteria();
			$criteria->add(EmpleadoPeer::EMPL_USU_CODIGO, $codigo_usuario);
			$operario = EmpleadoPeer::doSelectOne($criteria);
			if($operario){
				$criteria = new Criteria();
				$criteria->add(EmpresaPeer::EMP_CODIGO, $operario->getEmplEmpCodigo());
				$empresa = EmpresaPeer::doSelectOne($criteria);
				if($empresa){
					$nombreEmpresa = $empresa->getEmpNombre();
					$urlLogo = $empresa->getEmpLogoUrl();
				}
			}
		}catch (Exception $excepcion)
		{
			//	echo($excepcion->getMessage());
		}

		$this->nombreEmpresa = $nombreEmpresa;
		$this->urlLogo = $urlLogo;
                
                //Cambios: 24 de febrero de 2014
                //Retorna el nombre del perfil de usuario en sesión
                if($codigo_usuario == 1) {
                    $this -> perfilUsuario = 'Super Administrador';
                } else if($codigo_usuario == 2) {
                    $this -> perfilUsuario = 'Administrador';
                } else if($codigo_usuario == 3) {
                    $this -> perfilUsuario = 'Analista';
                } else if($codigo_usuario == 5) {
                    $this -> perfilUsuario = 'Coordinador o Supervisor';
                }
	}
}
