<?php
/**
 * login actions.
 *
 * @package    segaproyectos
 * @subpackage login
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */

class loginActions extends sfActions {
     public function executeConsultarEstadoSesion() {
         $usuario = $this->getUser();		
         if($usuario->isAuthenticated()) {
             return $this->renderText('Activa');
         }
         else {
             return $this->renderText('Vencida');
         }
     }	
     
     public function executeIndex(sfWebRequest $request) {
         // $this->forward('default', 'module');
     }
     
     public function executeAutenticar() {
         try {
             $this->getUser()->setAuthenticated(false);
             $this->getUser()->clearCredentials();
             $this->getUser()->getAttributeHolder()->clear();
             $conexion = new Criteria();
             $conexion->add(UsuarioPeer::USU_HABILITADO,1);
             $conexion->add(UsuarioPeer::USU_LOGIN,$this->getRequestParameter('usu_login'));
             $conexion->add(UsuarioPeer::USU_PASSWORD,$this->getRequestParameter('usu_password_encriptada'));
             $usuario = UsuarioPeer::doSelectOne($conexion);
             $this->getUser()->setCulture('es_CO');
             if(!$usuario) {
                 return $this->renderText("{success: false, errors: { reason: 'El usuario o password son incorrectos' }}");
             } else {
                 $this->getUser()->setAttribute('usu_codigo', $usuario->getUsuCodigo());
                 $this->getUser()->setAttribute('usu_login', $usuario->getUsuLogin());
                 $this->getUser()->setAttribute('usu_per_codigo', $usuario->getUsuPerCodigo());
                 $perfilCodigo = $usuario->getUsuPerCodigo();
                 switch($perfilCodigo) {
                     case 1: // Perfil 'super Administrador'
                         $this->getUser()->setAuthenticated(true);
                         $this->getUser()->addCredential('superadministrador');
                         return $this->renderText("{success:true,mensaje:'".$perfilCodigo."'}");
                         break;
                     case 2: // Perfil 'administrador del sistema'						
                         $salida=$this->ArrancarSesionOperario($usuario->getUsuCodigo());						
                         if($salida!='') {
                             return $this->renderText("{ success: false, errors: { reason: '".$salida."' }}");
                         }
                         $this->getUser()->setAuthenticated(true);
                         $this->getUser()->addCredential('administrador');
                         return $this->renderText("{success:true,mensaje:'".$perfilCodigo."'}");
                         break;
                     case 3: // Perfil 'analista operario'						
                         $computador = ComputadorPeer::retrieveByPK($this->getRequestParameter('certificado'));
                         if($computador) {
                             $salida=$this->ArrancarSesionOperario($usuario->getUsuCodigo());
                             if($salida!='') {
                                 return $this->renderText("{ success: false, errors: { reason: '".$salida."' }}");
                             }
                             $valido=$this->validarFechaLicencia();
                             if($valido=="true") {
                                 $this->getUser()->setAttribute('certificado', $this->getRequestParameter('certificado'));
                                 $this->getUser()->setAuthenticated(true);
                                 $this->getUser()->addCredential('analista');
                             } else {
                                 return $this->renderText("{ success: false, errors: { reason: '".$valido."' }}");
                             }
                             return $this->renderText("{success:true,mensaje:'".$perfilCodigo."'}");
                         } else {
                             return $this->renderText("{ success: false, errors: { reason: 'Este computador no está autorizado para ingresar al sistema' }}");
                         }
                         break;
                     case 4: // reportes coordinador supervisor
                         $salida = $this->ArrancarSesionOperario($usuario->getUsuCodigo());
                         if($salida!='') {
                             return $this->renderText("{ success: false, errors: { reason: '".$salida."' }}");
                         }
                         $this->getUser()->setAuthenticated(true);
                         $this->getUser()->addCredential('reportes');
                         return $this->renderText("{success:true,mensaje:'".$perfilCodigo."'}");
                         break;
                 }
             }		
         }catch (Exception $excepcion) {
             return $this->renderText("{success:false,errors:{reason:'Ha ocurrido una execpcion',error:'".$excepcion->getMessage()."' }}");
         }
    }
    
    /**	* Este metodo se encarga de sacar al usuario del sistema */
    public function executeDesautenticar() {
        if($this->getUser()->isAuthenticated())	{
            $this->getUser()->setAuthenticated(false);
            $this->getUser()->clearCredentials();
            $this->getUser()->getAttributeHolder()->clear();
        }
        return $this->renderText("{success: true, mensaje: 'El usuario ha terminado'}");
   }
   
   /** * Este metodo se encarga de poner los datos de operario y de la empresa en session */
   protected function ArrancarSesionOperario($usu_codigo) {
       $salida="";
       try {
            //$usu_codigo = $this->getRequestParameter('usu_codigo');
           $conexion = new Criteria();
           $conexion->add(EmpleadoPeer::EMPL_USU_CODIGO, $usu_codigo);
           $conexion->add(EmpleadoPeer::EMPL_ELIMINADO, '0');
           $empleado_cant=EmpleadoPeer::doCount($conexion);
           $empleado = EmpleadoPeer::doSelectOne($conexion);
           if($empleado) {
               $this->getUser()->setAttribute('empl_codigo', $empleado->getEmplCodigo());
               $this->getUser()->setAttribute('empl_nombre', $empleado->getEmplNombres());
               $this->getUser()->setAttribute('empl_emp_codigo', $empleado->getEmplEmpCodigo());
               $conexion = new Criteria();
               $conexion->add(EmpresaPeer::EMP_CODIGO, $empleado->getEmplEmpCodigo());
               $empresa = EmpresaPeer::doSelectOne($conexion);
               if($empresa) {
                   $this->getUser()->setAttribute('emp_codigo', $empresa->getEmpCodigo());
               }
               else { 
                   $salida="El empleado no tiene una empresa asociado";
               }
           } else {
               $salida="El usuario no tiene un empleado asociado";
           } 
       } catch (Exception $excepcion) {
           throw $excepcion;
           //$salida =  "({success: false, errors: { reason: 'Hubo una excepción'}})";
           }
       return $salida;
   }
   
   /* Este metodo se valoda que no se haya vencido la licencia y esta habilitado solo para los analistas */
   protected function validarFechaLicencia() {		
          $salida="";		
          try		{
              $emp_codigo=$this->getUser()->getAttribute('emp_codigo');	
              if($emp_codigo){				
                  $hoy_fecha=date("Y-m-d");	
                  //echo($hoy_fecha.'-');	
                  $conexion = new Criteria();
                  $conexion->add(EmpresaPeer::EMP_CODIGO, $emp_codigo);
                  //$conexion->add(EmpresaPeer::EMP_FECHA_LIMITE_LICENCIA, $hoy_fecha, CRITERIA::GREATERLESS_EQUAL);	
                  //$conexion->addAnd(EmpresaPeer::EMP_FECHA_INICIO_LICENCIA, $hoy_fecha, CRITERIA::LESS_EQUAL);	
                  $empresa = EmpresaPeer::doSelectOne($conexion);	
                  if($empresa){			
                      $fin=$empresa->getEmpFechaLimiteLicencia();
                      $ini=$empresa->getEmpFechaInicioLicencia();
                      //echo($fin.'-'.$ini);
                      if( $fin>=$hoy_fecha  && $ini<=$hoy_fecha){
                          return "true";
                          }		
                          else{
                              $salida="La licencia del software no este activa en este periodo";
                              }		
                          }				
                          else{
                              $salida="No se ha podido capturar la empresa a la que pertenece este usuario";
                              }
                          }			
                          else {		
                              $salida="No se ha podido capturar la empresa a la que pertenece este usuario";
                              }		                                                                                  
                          }		
                          catch (Exception $excepcion) {	
                              throw $excepcion;	
                          }
        return $salida;
   }
}