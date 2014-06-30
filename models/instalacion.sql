insert into perfil (per_codigo,per_nombre,per_fecha_registro_sistema,per_fecha_actualizacion,per_eliminado) values (1,"Super Administrador",now(),now(),0);
insert into perfil (per_codigo,per_nombre,per_fecha_registro_sistema,per_fecha_actualizacion,per_eliminado) values (2,"Administrador",now(),now(),0);
insert into perfil (per_codigo,per_nombre,per_fecha_registro_sistema,per_fecha_actualizacion,per_eliminado) values (3,"Analista",now(),now(),0);
insert into perfil (per_codigo,per_nombre,per_fecha_registro_sistema,per_fecha_actualizacion,per_eliminado) values (4,"Coordinador o Supervisor",now(),now(),0);

insert into usuario (usu_codigo,usu_login,usu_password,usu_per_codigo,usu_habilitado,usu_fecha_registro_sistema) values (1,'quantar',md5('quantar'),1,1,now());

insert into empresa (emp_codigo, emp_nombre, emp_nit, emp_fecha_limite_licencia, emp_fecha_inicio_licencia, emp_inyect_estandar_promedio, emp_tiempo_alerta_consumible, emp_fecha_registro_sistema,emp_fecha_actualizacion,emp_eliminado,emp_usu_crea,emp_usu_actualiza) VALUES ( '1', 'Nombre Empresa Ltda.', '123456.1', '2017-12-02', '2010-12-18', '6', '4', now(),now(),0,1,1);

insert into tipo_identificacion (tid_codigo,tid_nombre,tid_fecha_registro_sistema,tid_fecha_actualizacion,tid_eliminado,tid_usu_crea,tid_usu_actualiza) values (1,"Cédula de ciudadanía",now(),now(),0,1,1);
insert into tipo_identificacion (tid_codigo,tid_nombre,tid_fecha_registro_sistema,tid_fecha_actualizacion,tid_eliminado,tid_usu_crea,tid_usu_actualiza) values (2,"Cédula de extranjería",now(),now(),0,1,1);
insert into tipo_identificacion (tid_codigo,tid_nombre,tid_fecha_registro_sistema,tid_fecha_actualizacion,tid_eliminado,tid_usu_crea,tid_usu_actualiza) values (3,"Tarjeta de identidad",now(),now(),0,1,1);

insert into estado (est_codigo,est_nombre,est_fecha_registro_sistema,est_fecha_actualizacion,est_eliminado,est_usu_crea,est_usu_actualiza) values (1,"Bueno",now(),now(),0,1,1);
insert into estado (est_codigo,est_nombre,est_fecha_registro_sistema,est_fecha_actualizacion,est_eliminado,est_usu_crea,est_usu_actualiza) values (2,"Dado de baja",now(),now(),0,1,1);

INSERT INTO `maquina` (`maq_codigo`, `maq_est_codigo`, `maq_nombre`, `maq_marca`, `maq_modelo`, `maq_fecha_adquisicion`, `maq_foto_url`, `maq_tiempo_inyeccion`, `maq_fecha_registro_sistema`, `maq_codigo_inventario`, `maq_usu_crea`, `maq_usu_actualiza`, `maq_fecha_actualizacion`, `maq_eliminado`, `maq_causa_eliminacion`) VALUES
(1,1, 'HPLC Q-EL-001', 'HEWLLET PACKARD', 'Rop-34AGILENT 1100', '2011-01-27', NULL, '1', '2011-01-27 12:35:38', 'Q-EL-001',1,1, '2011-01-27 21:49:06',0, NULL),
(2,1, 'HPLC Q-EL-002', 'SHIMADZU', 'LC2010-AHT', '2011-01-27', NULL, '1', '2011-01-27 12:35:38', 'Q-EL-002',1,1, '2011-01-27 21:50:00',0, NULL),
(3,1, 'HPLC Q-EL-003', 'SHIMADZU', 'LC2010-AHT', '2011-01-20', NULL, '1', '2011-01-27 18:32:03', 'Q-EL-003',1,1, '2011-01-27 21:50:12',0, NULL);

insert into categoria_evento (cat_codigo,cat_nombre,cat_fecha_registro_sistema,cat_fecha_actualizacion,cat_eliminado,cat_usu_crea,cat_usu_actualiza) values(1,'Problemas de Presión',now(),now(),0,1,1); 
insert into categoria_evento (cat_codigo,cat_nombre,cat_fecha_registro_sistema,cat_fecha_actualizacion,cat_eliminado,cat_usu_crea,cat_usu_actualiza) values(2,'Problemas con Fugas',now(),now(),0,1,1);
insert into categoria_evento (cat_codigo,cat_nombre,cat_fecha_registro_sistema,cat_fecha_actualizacion,cat_eliminado,cat_usu_crea,cat_usu_actualiza) values(3,'Problemas con la Retención de Picos',now(),now(),0,1,1);
insert into categoria_evento (cat_codigo,cat_nombre,cat_fecha_registro_sistema,cat_fecha_actualizacion,cat_eliminado,cat_usu_crea,cat_usu_actualiza) values(4,'Problemas con la forma de los picos',now(),now(),0,1,1);
insert into categoria_evento (cat_codigo,cat_nombre,cat_fecha_registro_sistema,cat_fecha_actualizacion,cat_eliminado,cat_usu_crea,cat_usu_actualiza) values(5,'Problemas con la Línea Base',now(),now(),0,1,1);
insert into categoria_evento (cat_codigo,cat_nombre,cat_fecha_registro_sistema,cat_fecha_actualizacion,cat_eliminado,cat_usu_crea,cat_usu_actualiza) values(6,'Problemas con el Automuestreador',now(),now(),0,1,1);
insert into categoria_evento (cat_codigo,cat_nombre,cat_fecha_registro_sistema,cat_fecha_actualizacion,cat_eliminado,cat_usu_crea,cat_usu_actualiza) values(7,'Problemas con el equipo Controlador',now(),now(),0,1,1);
insert into categoria_evento (cat_codigo,cat_nombre,cat_fecha_registro_sistema,cat_fecha_actualizacion,cat_eliminado,cat_usu_crea,cat_usu_actualiza) values(8,'Problemas Generales',now(),now(),0,1,1);
insert into categoria_evento (cat_codigo,cat_nombre,cat_fecha_registro_sistema,cat_fecha_actualizacion,cat_eliminado,cat_usu_crea,cat_usu_actualiza) values(9,'Reinyección',now(),now(),0,1,1);

insert into evento (eve_codigo,eve_nombre,eve_fecha_registro_sistema,eve_fecha_actualizacion,eve_eliminado,eve_usu_crea,eve_usu_actualiza) values(1,'Presión del sistema alta', now(),now(),0,1,1);
insert into evento (eve_codigo,eve_nombre,eve_fecha_registro_sistema,eve_fecha_actualizacion,eve_eliminado,eve_usu_crea,eve_usu_actualiza) values(2,'Presión del sistema baja', now(),now(),0,1,1);
insert into evento (eve_codigo,eve_nombre,eve_fecha_registro_sistema,eve_fecha_actualizacion,eve_eliminado,eve_usu_crea,eve_usu_actualiza) values(3,'Presión inestable', now(),now(),0,1,1);
insert into evento (eve_codigo,eve_nombre,eve_fecha_registro_sistema,eve_fecha_actualizacion,eve_eliminado,eve_usu_crea,eve_usu_actualiza) values(4,'Otros', now(),now(),0,1,1);
insert into evento (eve_codigo,eve_nombre,eve_fecha_registro_sistema,eve_fecha_actualizacion,eve_eliminado,eve_usu_crea,eve_usu_actualiza) values(5,'Fuga en la entrada/salida de la columna', now(),now(),0,1,1);
insert into evento (eve_codigo,eve_nombre,eve_fecha_registro_sistema,eve_fecha_actualizacion,eve_eliminado,eve_usu_crea,eve_usu_actualiza) values(6,'Fuga en la entrada al detector', now(),now(),0,1,1);
insert into evento (eve_codigo,eve_nombre,eve_fecha_registro_sistema,eve_fecha_actualizacion,eve_eliminado,eve_usu_crea,eve_usu_actualiza) values(7,'Fuga en la entrada/salida del filtro en línea', now(),now(),0,1,1);
insert into evento (eve_codigo,eve_nombre,eve_fecha_registro_sistema,eve_fecha_actualizacion,eve_eliminado,eve_usu_crea,eve_usu_actualiza) values(8,'Fuga en la entrada/salida de las bombas', now(),now(),0,1,1);
insert into evento (eve_codigo,eve_nombre,eve_fecha_registro_sistema,eve_fecha_actualizacion,eve_eliminado,eve_usu_crea,eve_usu_actualiza) values(9,'Fuga en el asiento del inyector', now(),now(),0,1,1);
insert into evento (eve_codigo,eve_nombre,eve_fecha_registro_sistema,eve_fecha_actualizacion,eve_eliminado,eve_usu_crea,eve_usu_actualiza) values(10,'Fuga en el inyector', now(),now(),0,1,1);
insert into evento (eve_codigo,eve_nombre,eve_fecha_registro_sistema,eve_fecha_actualizacion,eve_eliminado,eve_usu_crea,eve_usu_actualiza) values(11,'Falta reproducibilidad en los tiempos de retención de picos', now(),now(),0,1,1);
insert into evento (eve_codigo,eve_nombre,eve_fecha_registro_sistema,eve_fecha_actualizacion,eve_eliminado,eve_usu_crea,eve_usu_actualiza) values(12,'Aumento en el tiempo de retención de picos', now(),now(),0,1,1);
insert into evento (eve_codigo,eve_nombre,eve_fecha_registro_sistema,eve_fecha_actualizacion,eve_eliminado,eve_usu_crea,eve_usu_actualiza) values(13,'Disminución en el tiempo de retención de picos', now(),now(),0,1,1);
insert into evento (eve_codigo,eve_nombre,eve_fecha_registro_sistema,eve_fecha_actualizacion,eve_eliminado,eve_usu_crea,eve_usu_actualiza) values(14,'Pérdida de resolución de picos', now(),now(),0,1,1);
insert into evento (eve_codigo,eve_nombre,eve_fecha_registro_sistema,eve_fecha_actualizacion,eve_eliminado,eve_usu_crea,eve_usu_actualiza) values(15,'Picos anchos', now(),now(),0,1,1);
insert into evento (eve_codigo,eve_nombre,eve_fecha_registro_sistema,eve_fecha_actualizacion,eve_eliminado,eve_usu_crea,eve_usu_actualiza) values(16,'Picos Fantasma', now(),now(),0,1,1);
insert into evento (eve_codigo,eve_nombre,eve_fecha_registro_sistema,eve_fecha_actualizacion,eve_eliminado,eve_usu_crea,eve_usu_actualiza) values(17,'Picos negativos', now(),now(),0,1,1);
insert into evento (eve_codigo,eve_nombre,eve_fecha_registro_sistema,eve_fecha_actualizacion,eve_eliminado,eve_usu_crea,eve_usu_actualiza) values(18,'Picos divididos', now(),now(),0,1,1);
insert into evento (eve_codigo,eve_nombre,eve_fecha_registro_sistema,eve_fecha_actualizacion,eve_eliminado,eve_usu_crea,eve_usu_actualiza) values(19,'Picos con cola', now(),now(),0,1,1);
insert into evento (eve_codigo,eve_nombre,eve_fecha_registro_sistema,eve_fecha_actualizacion,eve_eliminado,eve_usu_crea,eve_usu_actualiza) values(20,'Picos con frente', now(),now(),0,1,1);
insert into evento (eve_codigo,eve_nombre,eve_fecha_registro_sistema,eve_fecha_actualizacion,eve_eliminado,eve_usu_crea,eve_usu_actualiza) values(21,'Picos cortados en la punta', now(),now(),0,1,1);
insert into evento (eve_codigo,eve_nombre,eve_fecha_registro_sistema,eve_fecha_actualizacion,eve_eliminado,eve_usu_crea,eve_usu_actualiza) values(22,'Picos cortados en la base', now(),now(),0,1,1);
insert into evento (eve_codigo,eve_nombre,eve_fecha_registro_sistema,eve_fecha_actualizacion,eve_eliminado,eve_usu_crea,eve_usu_actualiza) values(23,'Línea base con ruido', now(),now(),0,1,1);
insert into evento (eve_codigo,eve_nombre,eve_fecha_registro_sistema,eve_fecha_actualizacion,eve_eliminado,eve_usu_crea,eve_usu_actualiza) values(24,'Línea base espigada', now(),now(),0,1,1);
insert into evento (eve_codigo,eve_nombre,eve_fecha_registro_sistema,eve_fecha_actualizacion,eve_eliminado,eve_usu_crea,eve_usu_actualiza) values(25,'Línea base variable', now(),now(),0,1,1);
insert into evento (eve_codigo,eve_nombre,eve_fecha_registro_sistema,eve_fecha_actualizacion,eve_eliminado,eve_usu_crea,eve_usu_actualiza) values(26,'Atascamiento del automuestreador', now(),now(),0,1,1);
insert into evento (eve_codigo,eve_nombre,eve_fecha_registro_sistema,eve_fecha_actualizacion,eve_eliminado,eve_usu_crea,eve_usu_actualiza) values(27,'Mal posicionamiento del automuestreador', now(),now(),0,1,1);
insert into evento (eve_codigo,eve_nombre,eve_fecha_registro_sistema,eve_fecha_actualizacion,eve_eliminado,eve_usu_crea,eve_usu_actualiza) values(28,'El equipo no reconoce la bandeja de muestras', now(),now(),0,1,1);
insert into evento (eve_codigo,eve_nombre,eve_fecha_registro_sistema,eve_fecha_actualizacion,eve_eliminado,eve_usu_crea,eve_usu_actualiza) values(29,'El computador se bloquea', now(),now(),0,1,1);
insert into evento (eve_codigo,eve_nombre,eve_fecha_registro_sistema,eve_fecha_actualizacion,eve_eliminado,eve_usu_crea,eve_usu_actualiza) values(30,'El computador no carga el software', now(),now(),0,1,1);
insert into evento (eve_codigo,eve_nombre,eve_fecha_registro_sistema,eve_fecha_actualizacion,eve_eliminado,eve_usu_crea,eve_usu_actualiza) values(31,'El software se bloquea', now(),now(),0,1,1);
insert into evento (eve_codigo,eve_nombre,eve_fecha_registro_sistema,eve_fecha_actualizacion,eve_eliminado,eve_usu_crea,eve_usu_actualiza) values(32,'El software se interrumpe en medio de una corrida analítica', now(),now(),0,1,1);
insert into evento (eve_codigo,eve_nombre,eve_fecha_registro_sistema,eve_fecha_actualizacion,eve_eliminado,eve_usu_crea,eve_usu_actualiza) values(33,'Uso de fase móvil no correspondiente con el método', now(),now(),0,1,1);
insert into evento (eve_codigo,eve_nombre,eve_fecha_registro_sistema,eve_fecha_actualizacion,eve_eliminado,eve_usu_crea,eve_usu_actualiza) values(34,'Se carga  metodología de análisis no correspondiente', now(),now(),0,1,1);
insert into evento (eve_codigo,eve_nombre,eve_fecha_registro_sistema,eve_fecha_actualizacion,eve_eliminado,eve_usu_crea,eve_usu_actualiza) values(35,'Se utiliza columna no correspondiente con el método', now(),now(),0,1,1);
insert into evento (eve_codigo,eve_nombre,eve_fecha_registro_sistema,eve_fecha_actualizacion,eve_eliminado,eve_usu_crea,eve_usu_actualiza) values(36,'Inadecuada preparación de la fase móvil', now(),now(),0,1,1);
insert into evento (eve_codigo,eve_nombre,eve_fecha_registro_sistema,eve_fecha_actualizacion,eve_eliminado,eve_usu_crea,eve_usu_actualiza) values(37,'Inadecuada preparación de soluciones estándar', now(),now(),0,1,1);
insert into evento (eve_codigo,eve_nombre,eve_fecha_registro_sistema,eve_fecha_actualizacion,eve_eliminado,eve_usu_crea,eve_usu_actualiza) values(38,'Inadecuada preparación de solución test', now(),now(),0,1,1);
insert into evento (eve_codigo,eve_nombre,eve_fecha_registro_sistema,eve_fecha_actualizacion,eve_eliminado,eve_usu_crea,eve_usu_actualiza) values(39,'Inadecuada preparación de muestra', now(),now(),0,1,1);
insert into evento (eve_codigo,eve_nombre,eve_fecha_registro_sistema,eve_fecha_actualizacion,eve_eliminado,eve_usu_crea,eve_usu_actualiza) values(40,'Ubicación errónea de muestras en automuestreador', now(),now(),0,1,1);
insert into evento (eve_codigo,eve_nombre,eve_fecha_registro_sistema,eve_fecha_actualizacion,eve_eliminado,eve_usu_crea,eve_usu_actualiza) values(41,'Reinyección', now(),now(),0,1,1);

insert into evento_por_categoria (evca_eve_codigo,evca_cat_codigo,evca_fecha_registro_sistema,evca_usu_crea) values(1,1,now(),1);
insert into evento_por_categoria (evca_eve_codigo,evca_cat_codigo,evca_fecha_registro_sistema,evca_usu_crea) values(2,1,now(),1);
insert into evento_por_categoria (evca_eve_codigo,evca_cat_codigo,evca_fecha_registro_sistema,evca_usu_crea) values(3,1,now(),1);
insert into evento_por_categoria (evca_eve_codigo,evca_cat_codigo,evca_fecha_registro_sistema,evca_usu_crea) values(4,1,now(),1);
insert into evento_por_categoria (evca_eve_codigo,evca_cat_codigo,evca_fecha_registro_sistema,evca_usu_crea) values(5,2,now(),1);
insert into evento_por_categoria (evca_eve_codigo,evca_cat_codigo,evca_fecha_registro_sistema,evca_usu_crea) values(6,2,now(),1);
insert into evento_por_categoria (evca_eve_codigo,evca_cat_codigo,evca_fecha_registro_sistema,evca_usu_crea) values(7,2,now(),1);
insert into evento_por_categoria (evca_eve_codigo,evca_cat_codigo,evca_fecha_registro_sistema,evca_usu_crea) values(8,2,now(),1);
insert into evento_por_categoria (evca_eve_codigo,evca_cat_codigo,evca_fecha_registro_sistema,evca_usu_crea) values(9,2,now(),1);
insert into evento_por_categoria (evca_eve_codigo,evca_cat_codigo,evca_fecha_registro_sistema,evca_usu_crea) values(10,2,now(),1);
insert into evento_por_categoria (evca_eve_codigo,evca_cat_codigo,evca_fecha_registro_sistema,evca_usu_crea) values(4,2,now(),1);
insert into evento_por_categoria (evca_eve_codigo,evca_cat_codigo,evca_fecha_registro_sistema,evca_usu_crea) values(11,3,now(),1);
insert into evento_por_categoria (evca_eve_codigo,evca_cat_codigo,evca_fecha_registro_sistema,evca_usu_crea) values(12,3,now(),1);
insert into evento_por_categoria (evca_eve_codigo,evca_cat_codigo,evca_fecha_registro_sistema,evca_usu_crea) values(13,3,now(),1);
insert into evento_por_categoria (evca_eve_codigo,evca_cat_codigo,evca_fecha_registro_sistema,evca_usu_crea) values(14,3,now(),1);
insert into evento_por_categoria (evca_eve_codigo,evca_cat_codigo,evca_fecha_registro_sistema,evca_usu_crea) values(4,3,now(),1);
insert into evento_por_categoria (evca_eve_codigo,evca_cat_codigo,evca_fecha_registro_sistema,evca_usu_crea) values(15,4,now(),1);
insert into evento_por_categoria (evca_eve_codigo,evca_cat_codigo,evca_fecha_registro_sistema,evca_usu_crea) values(16,4,now(),1);
insert into evento_por_categoria (evca_eve_codigo,evca_cat_codigo,evca_fecha_registro_sistema,evca_usu_crea) values(17,4,now(),1);
insert into evento_por_categoria (evca_eve_codigo,evca_cat_codigo,evca_fecha_registro_sistema,evca_usu_crea) values(18,4,now(),1);
insert into evento_por_categoria (evca_eve_codigo,evca_cat_codigo,evca_fecha_registro_sistema,evca_usu_crea) values(19,4,now(),1);
insert into evento_por_categoria (evca_eve_codigo,evca_cat_codigo,evca_fecha_registro_sistema,evca_usu_crea) values(20,4,now(),1);
insert into evento_por_categoria (evca_eve_codigo,evca_cat_codigo,evca_fecha_registro_sistema,evca_usu_crea) values(21,4,now(),1);
insert into evento_por_categoria (evca_eve_codigo,evca_cat_codigo,evca_fecha_registro_sistema,evca_usu_crea) values(22,4,now(),1);
insert into evento_por_categoria (evca_eve_codigo,evca_cat_codigo,evca_fecha_registro_sistema,evca_usu_crea) values(4,4,now(),1);
insert into evento_por_categoria (evca_eve_codigo,evca_cat_codigo,evca_fecha_registro_sistema,evca_usu_crea) values(23,5,now(),1);
insert into evento_por_categoria (evca_eve_codigo,evca_cat_codigo,evca_fecha_registro_sistema,evca_usu_crea) values(24,5,now(),1);
insert into evento_por_categoria (evca_eve_codigo,evca_cat_codigo,evca_fecha_registro_sistema,evca_usu_crea) values(25,5,now(),1);
insert into evento_por_categoria (evca_eve_codigo,evca_cat_codigo,evca_fecha_registro_sistema,evca_usu_crea) values(4,5,now(),1);
insert into evento_por_categoria (evca_eve_codigo,evca_cat_codigo,evca_fecha_registro_sistema,evca_usu_crea) values(26,6,now(),1);
insert into evento_por_categoria (evca_eve_codigo,evca_cat_codigo,evca_fecha_registro_sistema,evca_usu_crea) values(27,6,now(),1);
insert into evento_por_categoria (evca_eve_codigo,evca_cat_codigo,evca_fecha_registro_sistema,evca_usu_crea) values(28,6,now(),1);
insert into evento_por_categoria (evca_eve_codigo,evca_cat_codigo,evca_fecha_registro_sistema,evca_usu_crea) values(4,6,now(),1);
insert into evento_por_categoria (evca_eve_codigo,evca_cat_codigo,evca_fecha_registro_sistema,evca_usu_crea) values(29,7,now(),1);
insert into evento_por_categoria (evca_eve_codigo,evca_cat_codigo,evca_fecha_registro_sistema,evca_usu_crea) values(30,7,now(),1);
insert into evento_por_categoria (evca_eve_codigo,evca_cat_codigo,evca_fecha_registro_sistema,evca_usu_crea) values(31,7,now(),1);
insert into evento_por_categoria (evca_eve_codigo,evca_cat_codigo,evca_fecha_registro_sistema,evca_usu_crea) values(32,7,now(),1);
insert into evento_por_categoria (evca_eve_codigo,evca_cat_codigo,evca_fecha_registro_sistema,evca_usu_crea) values(4,7,now(),1);
insert into evento_por_categoria (evca_eve_codigo,evca_cat_codigo,evca_fecha_registro_sistema,evca_usu_crea) values(33,8,now(),1);
insert into evento_por_categoria (evca_eve_codigo,evca_cat_codigo,evca_fecha_registro_sistema,evca_usu_crea) values(34,8,now(),1);
insert into evento_por_categoria (evca_eve_codigo,evca_cat_codigo,evca_fecha_registro_sistema,evca_usu_crea) values(35,8,now(),1);
insert into evento_por_categoria (evca_eve_codigo,evca_cat_codigo,evca_fecha_registro_sistema,evca_usu_crea) values(36,8,now(),1);
insert into evento_por_categoria (evca_eve_codigo,evca_cat_codigo,evca_fecha_registro_sistema,evca_usu_crea) values(37,8,now(),1);
insert into evento_por_categoria (evca_eve_codigo,evca_cat_codigo,evca_fecha_registro_sistema,evca_usu_crea) values(38,8,now(),1);
insert into evento_por_categoria (evca_eve_codigo,evca_cat_codigo,evca_fecha_registro_sistema,evca_usu_crea) values(39,8,now(),1);
insert into evento_por_categoria (evca_eve_codigo,evca_cat_codigo,evca_fecha_registro_sistema,evca_usu_crea) values(40,8,now(),1);
insert into evento_por_categoria (evca_eve_codigo,evca_cat_codigo,evca_fecha_registro_sistema,evca_usu_crea) values(4,8,now(),1);
insert into evento_por_categoria (evca_eve_codigo,evca_cat_codigo,evca_fecha_registro_sistema,evca_usu_crea) values(41,9,now(),1);

insert into indicador (ind_codigo,ind_sigla,ind_nombre,ind_unidad,ind_fecha_registro_sistema,ind_fecha_actualizacion,ind_eliminado,ind_usu_crea,ind_usu_actualiza) values (1,'TP','Tiempo Programado','Hrs',now(),now(),0,1,1);
insert into indicador (ind_codigo,ind_sigla,ind_nombre,ind_unidad,ind_fecha_registro_sistema,ind_fecha_actualizacion,ind_eliminado,ind_usu_crea,ind_usu_actualiza) values (2,'TNP','Tiempo No Programado','Hrs',now(),now(),0,1,1);
insert into indicador (ind_codigo,ind_sigla,ind_nombre,ind_unidad,ind_fecha_registro_sistema,ind_fecha_actualizacion,ind_eliminado,ind_usu_crea,ind_usu_actualiza) values (3,'TPP','Tiempo Parada Programada','Hrs',now(),now(),0,1,1);
insert into indicador (ind_codigo,ind_sigla,ind_nombre,ind_unidad,ind_fecha_registro_sistema,ind_fecha_actualizacion,ind_eliminado,ind_usu_crea,ind_usu_actualiza) values (4,'TPNP','Tiempo Paradas No Programadas','Hrs',now(),now(),0,1,1);
insert into indicador (ind_codigo,ind_sigla,ind_nombre,ind_unidad,ind_fecha_registro_sistema,ind_fecha_actualizacion,ind_eliminado,ind_usu_crea,ind_usu_actualiza) values (5,'TF','Tiempo Funcionamiento','Hrs',now(),now(),0,1,1);
insert into indicador (ind_codigo,ind_sigla,ind_nombre,ind_unidad,ind_fecha_registro_sistema,ind_fecha_actualizacion,ind_eliminado,ind_usu_crea,ind_usu_actualiza) values (6,'TO','Tiempo Operativo','Hrs',now(),now(),0,1,1);
insert into indicador (ind_codigo,ind_sigla,ind_nombre,ind_unidad,ind_fecha_registro_sistema,ind_fecha_actualizacion,ind_eliminado,ind_usu_crea,ind_usu_actualiza) values (7,'D','Disponibilidad','%',now(),now(),0,1,1);
insert into indicador (ind_codigo,ind_sigla,ind_nombre,ind_unidad,ind_fecha_registro_sistema,ind_fecha_actualizacion,ind_eliminado,ind_usu_crea,ind_usu_actualiza) values (8,'E','Eficiencia','%',now(),now(),0,1,1);
insert into indicador (ind_codigo,ind_sigla,ind_nombre,ind_unidad,ind_fecha_registro_sistema,ind_fecha_actualizacion,ind_eliminado,ind_usu_crea,ind_usu_actualiza) values (9,'C','Calidad','%',now(),now(),0,1,1);
insert into indicador (ind_codigo,ind_sigla,ind_nombre,ind_unidad,ind_fecha_registro_sistema,ind_fecha_actualizacion,ind_eliminado,ind_usu_crea,ind_usu_actualiza) values (10,'A','Aprovechamiento','%',now(),now(),0,1,1);
insert into indicador (ind_codigo,ind_sigla,ind_nombre,ind_unidad,ind_fecha_registro_sistema,ind_fecha_actualizacion,ind_eliminado,ind_usu_crea,ind_usu_actualiza) values (11,'OEE','Efectividad Global del Equipo','%',now(),now(),0,1,1);
insert into indicador (ind_codigo,ind_sigla,ind_nombre,ind_unidad,ind_fecha_registro_sistema,ind_fecha_actualizacion,ind_eliminado,ind_usu_crea,ind_usu_actualiza) values (12,'Fallas','Fallas','%',now(),now(),0,1,1);
insert into indicador (ind_codigo,ind_sigla,ind_nombre,ind_unidad,ind_fecha_registro_sistema,ind_fecha_actualizacion,ind_eliminado,ind_usu_crea,ind_usu_actualiza) values (13,'Paros','Paros menores /Reajustes','%',now(),now(),0,1,1);
insert into indicador (ind_codigo,ind_sigla,ind_nombre,ind_unidad,ind_fecha_registro_sistema,ind_fecha_actualizacion,ind_eliminado,ind_usu_crea,ind_usu_actualiza) values (14,'Retrabajos','Retrabajos','%',now(),now(),0,1,1);
insert into indicador (ind_codigo,ind_sigla,ind_nombre,ind_unidad,ind_fecha_registro_sistema,ind_fecha_actualizacion,ind_eliminado,ind_usu_crea,ind_usu_actualiza) values (15,'Perdida_rendimiento','Pérdida de rendimiento','%',now(),now(),0,1,1);
insert into indicador (ind_codigo,ind_sigla,ind_nombre,ind_unidad,ind_fecha_registro_sistema,ind_fecha_actualizacion,ind_eliminado,ind_usu_crea,ind_usu_actualiza) values (16,'PTEE','productividad Global del Equipo','%',now(),now(),0,1,1);

INSERT INTO `metodo` (`met_codigo`, `met_nombre`, `met_tiempo_alistamiento`, `met_tiempo_acondicionamiento`, `met_tiempo_estabilizacion`, `met_tiempo_estandar`, `met_tiempo_corrida_sistema`, `met_tiempo_corrida_curvas`, `met_num_inyeccion_estandar_1`, `met_num_inyeccion_estandar_2`, `met_num_inyeccion_estandar_3`, `met_num_inyeccion_estandar_4`, `met_num_inyeccion_estandar_5`, `met_num_inyeccion_estandar_6`, `met_num_inyeccion_estandar_7`, `met_num_inyeccion_estandar_8`, `met_fecha_registro_sistema`, `met_num_inyec_x_mu_producto`, `met_num_inyec_x_mu_estabilidad`, `met_num_inyec_x_mu_materia_pri`, `met_num_inyec_x_mu_pureza`, `met_num_inyec_x_mu_disolucion`, `met_num_inyec_x_mu_uniformidad`, `met_numero_inyeccion_estandar`, `met_usu_crea`, `met_usu_actualiza`, `met_fecha_actualizacion`, `met_eliminado`, `met_causa_eliminacion`, `met_causa_actualizacion`, `met_tc_producto_terminado`, `met_tc_estabilidad`, `met_tc_materia_prima`, `met_tc_pureza`, `met_tc_disolucion`, `met_tc_uniformidad`, `met_mantenimiento`, `met_tiempo_inyeccion`) VALUES
(1, 'Praziquantel', '15.0000', '15.0000', '0.0000', '30.0000', '0.0000', '4.0000', 5, 0, 0, 0, 0, 0, NULL, NULL, '2012-08-10 16:03:48', 1, 0, 0, 0, 0, 0, 0, 1, 1, '2013-05-08 11:35:13', 0, 'ENSAYO', '', '4.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', 0, 1),
(2, 'Ivermectina', '15.0000', '15.0000', '0.0000', '30.0000', '0.0000', '10.0000', 5, 0, 0, 0, 0, 0, NULL, NULL, '2012-08-13 15:15:27', 1, 0, 0, 0, 0, 0, 0, 1, 1, '2012-10-01 09:21:57', 0, NULL, '', '10.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', 0, 1),
(3, 'Ibuprofeno Limite Compuestos Relacionados C ', '15.0000', '15.0000', '0.0000', '30.0000', '0.0000', '13.0000', 2, 0, 0, 0, 0, 0, NULL, NULL, '2012-08-14 13:34:51', 1, 0, 0, 0, 0, 0, 0, 1, 1, '2012-08-14 13:34:51', 0, NULL, '', '13.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', 0, 1),
(4, 'Albendazol', '15.0000', '15.0000', '0.0000', '30.0000', '0.0000', '9.0000', 5, 0, 0, 0, 0, 0, NULL, NULL, '2012-08-15 08:38:53', 1, 0, 0, 0, 0, 0, 0, 1, 1, '2012-08-15 08:38:53', 0, NULL, '', '9.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', 0, 1),
(5, 'Albendazol EDOPetit Purga', '15.0000', '15.0000', '0.0000', '30.0000', '0.0000', '17.0000', 5, 0, 0, 0, 0, 0, NULL, NULL, '2012-08-15 08:40:18', 1, 0, 0, 0, 0, 0, 0, 1, 1, '2012-08-15 08:40:18', 0, NULL, '', '17.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', 0, 1),
(6, 'ATP', '15.0000', '15.0000', '0.0000', '30.0000', '0.0000', '6.0000', 5, 0, 0, 0, 0, 0, NULL, NULL, '2012-08-15 08:42:06', 1, 0, 0, 0, 0, 0, 0, 1, 1, '2012-11-26 11:27:02', 0, NULL, '', '10.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', 0, 1),
(7, 'Boldenona Undecilato', '15.0000', '15.0000', '0.0000', '30.0000', '0.0000', '9.0000', 5, 0, 0, 0, 0, 0, NULL, NULL, '2012-08-15 08:42:58', 1, 0, 0, 0, 0, 0, 0, 1, 1, '2012-08-15 08:42:58', 0, NULL, '', '9.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', 0, 1),
(8, 'Dipirona Sódica', '15.0000', '15.0000', '0.0000', '30.0000', '0.0000', '8.0000', 5, 0, 0, 0, 0, 0, NULL, NULL, '2012-08-15 08:44:29', 1, 0, 0, 0, 0, 0, 0, 1, 1, '2012-08-15 08:44:29', 0, NULL, '', '8.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', 0, 1),
(9, 'Doramectina', '15.0000', '15.0000', '0.0000', '30.0000', '0.0000', '6.0000', 5, 0, 0, 0, 0, 0, NULL, NULL, '2012-08-15 08:45:54', 1, 0, 0, 0, 0, 0, 0, 1, 1, '2012-08-15 08:45:54', 0, NULL, '', '7.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', 0, 1),
(10, 'Enrofloxacino HCl', '15.0000', '15.0000', '0.0000', '30.0000', '0.0000', '11.0000', 5, 0, 0, 0, 0, 0, NULL, NULL, '2012-08-15 08:47:25', 1, 0, 0, 0, 0, 0, 0, 1, 1, '2012-11-13 10:50:15', 0, NULL, '', '11.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', 0, 1),
(11, 'Fenbendazol', '15.0000', '15.0000', '0.0000', '30.0000', '0.0000', '6.0000', 5, 0, 0, 0, 0, 0, NULL, NULL, '2012-08-15 08:49:37', 1, 0, 0, 0, 0, 0, 0, 1, 1, '2012-08-15 08:49:37', 0, NULL, '', '6.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', 0, 1),
(12, 'Fenilbutazona Sodica', '15.0000', '15.0000', '0.0000', '30.0000', '0.0000', '5.5000', 5, 0, 0, 0, 0, 0, NULL, NULL, '2012-08-15 08:50:39', 1, 0, 0, 0, 0, 0, 0, 1, 1, '2012-08-15 08:50:39', 0, NULL, '', '5.5000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', 0, 1),
(13, 'Glucosamina Sulfato Derivatización', '30.0000', '30.0000', '0.0000', '60.0000', '0.0000', '18.0000', 5, 0, 0, 0, 0, 0, NULL, NULL, '2012-08-15 08:51:44', 1, 0, 0, 0, 0, 0, 0, 1, 1, '2012-08-15 08:51:56', 0, NULL, '', '18.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', 0, 1),
(14, 'Oxitetraciclina HCl', '15.0000', '20.0000', '0.0000', '35.0000', '0.0000', '8.0000', 5, 0, 0, 0, 0, 0, NULL, NULL, '2012-08-15 08:54:07', 1, 0, 0, 0, 0, 0, 0, 1, 1, '2012-08-15 08:54:07', 0, NULL, '', '8.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', 0, 1),
(15, 'Oxitetraciclina HCl EDOAntripan', '15.0000', '20.0000', '0.0000', '35.0000', '0.0000', '6.0000', 5, 0, 0, 0, 0, 0, NULL, NULL, '2012-08-15 08:55:18', 1, 0, 0, 0, 0, 0, 0, 1, 1, '2012-11-06 11:54:54', 0, NULL, '', '6.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', 0, 1),
(16, 'Pamoato de Pirantel', '15.0000', '15.0000', '0.0000', '30.0000', '0.0000', '5.0000', 5, 0, 0, 0, 0, 0, NULL, NULL, '2012-08-15 08:56:26', 1, 0, 0, 0, 0, 0, 0, 1, 1, '2012-08-15 08:56:26', 0, NULL, '', '5.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', 0, 1),
(17, 'Vitaminas Hidrosolubles Otros', '15.0000', '45.0000', '0.0000', '60.0000', '0.0000', '15.0000', 5, 0, 0, 0, 0, 0, NULL, NULL, '2012-08-15 11:27:25', 1, 0, 0, 0, 0, 0, 0, 1, 1, '2012-08-15 14:14:11', 0, NULL, '', '15.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', 0, 1),
(18, 'Vitaminas Hidrosolubles EDOBonapel', '15.0000', '45.0000', '0.0000', '60.0000', '0.0000', '15.0000', 5, 0, 0, 0, 0, 0, NULL, NULL, '2012-08-15 11:28:59', 1, 0, 0, 0, 0, 0, 0, 1, 1, '2012-08-15 14:13:39', 0, NULL, '', '18.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', 0, 1),
(19, 'Vitaminas Liposolubles D y E', '15.0000', '45.0000', '0.0000', '60.0000', '0.0000', '18.0000', 5, 0, 0, 0, 0, 0, NULL, NULL, '2012-08-15 11:32:32', 1, 0, 0, 0, 0, 0, 0, 1, 1, '2012-08-15 14:14:53', 0, NULL, '', '18.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', 0, 1),
(20, 'Vitaminas Liposolubles D y E Farvical', '15.0000', '30.0000', '0.0000', '45.0000', '0.0000', '13.0000', 5, 0, 0, 0, 0, 0, NULL, NULL, '2012-08-15 11:33:18', 1, 0, 0, 0, 0, 0, 0, 1, 1, '2012-08-15 14:24:24', 0, NULL, '', '13.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', 0, 1),
(21, 'Aminoacidos ', '15.0000', '135.0000', '0.0000', '150.0000', '0.0000', '45.0000', 5, 0, 0, 0, 0, 0, NULL, NULL, '2012-08-15 11:37:10', 1, 0, 0, 0, 0, 0, 0, 1, 1, '2012-08-15 14:21:00', 0, NULL, '', '45.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', 0, 1),
(22, 'Aminoacidos (Taurina)', '15.0000', '20.0000', '0.0000', '35.0000', '0.0000', '7.0000', 5, 0, 0, 0, 0, 0, NULL, NULL, '2012-08-15 11:38:13', 1, 0, 0, 0, 0, 0, 0, 1, 1, '2012-08-15 14:22:48', 0, NULL, '', '7.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', 0, 1),
(23, 'AcidosOrgánicos', '15.0000', '30.0000', '0.0000', '45.0000', '0.0000', '15.0000', 5, 0, 0, 0, 0, 0, NULL, NULL, '2012-08-15 14:29:08', 1, 0, 0, 0, 0, 0, 0, 1, 1, '2012-10-01 09:21:17', 0, NULL, '', '15.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', 0, 1),
(24, 'Triclosan(Irgasan)', '15.0000', '40.0000', '0.0000', '55.0000', '0.0000', '20.0000', 5, 0, 0, 0, 0, 0, NULL, NULL, '2012-08-15 14:33:57', 1, 0, 0, 0, 0, 0, 0, 1, 1, '2012-08-15 14:33:57', 0, NULL, '', '20.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', 0, 1),
(25, 'Trazas de Ivermectina', '30.0000', '0.0000', '0.0000', '30.0000', '0.0000', '10.0000', 1, 0, 0, 0, 0, 0, NULL, NULL, '2012-08-27 09:40:49', 1, 0, 0, 0, 0, 0, 0, 1, 1, '2012-08-27 09:40:49', 0, NULL, '', '10.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', 0, 1),
(26, 'Fallo', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', 0, 0, 0, 0, 0, 0, NULL, NULL, '2012-08-29 15:09:37', 0, 0, 0, 0, 0, 0, 0, 1, 1, '2012-08-29 15:09:37', 0, NULL, '', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', 0, 1),
(27, 'Impurezas Comunes ', '15.0000', '0.0000', '0.0000', '15.0000', '0.0000', '15.0000', 1, 0, 0, 0, 0, 0, NULL, NULL, '2012-12-11 15:09:28', 0, 0, 2, 0, 0, 0, 0, 1, 1, '2012-12-11 15:14:11', 0, NULL, '', '0.0000', '0.0000', '15.0000', '0.0000', '0.0000', '0.0000', 0, 1),
(28, 'Trazas Boldenona Undecilato', '15.0000', '15.0000', '0.0000', '30.0000', '0.0000', '9.0000', 1, 0, 0, 0, 0, 0, NULL, NULL, '2013-01-28 17:29:05', 1, 0, 0, 0, 0, 0, 0, 1, 1, '2013-01-28 17:29:48', 0, NULL, '', '9.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', 0, 1);

INSERT INTO `etapa` (`eta_codigo`, `eta_nombre`, `eta_eliminado`, `eta_fecha_registro_sistema`, `eta_usu_crea`, `eta_fecha_actualizacion`, `eta_usu_actualiza`, `eta_causa_eliminacion`, `eta_causa_actualizacion`) VALUES
(1, 'PT', 0, now(), 1, now(), 1, NULL, NULL),
(2, 'VAL', 0, now(), 1, now(), 1, NULL, NULL),
(3, 'DIS', 0, now(), 1, now(), 1, NULL, NULL),
(4, 'MP', 0, now(), 1, now(), 1, NULL, NULL),
(5, 'EST NAT', 0, now(), 1, now(), 1, NULL, NULL),
(6, 'EST ACE', 0, now(), 1, now(), 1, NULL, NULL),
(7, 'EST', 0, now(), 1, now(), 1, NULL, NULL),
(8, 'NIR', 0, now(), 1, now(), 1, NULL, NULL),
(9, 'PROYECTO', 0, now(), 1, now(), 1, NULL, NULL),
(10, 'DISEÑO', 0, now(), 1, now(), 1, NULL, NULL),
(11, 'EST ACEL', 0, now(), 1, now(), 1, NULL, NULL);

INSERT INTO `marca` (`mar_codigo`, `mar_nombre`, `mar_fecha_registro_sistema`, `mar_usu_crea`, `mar_usu_actualiza`, `mar_fecha_actualizacion`, `mar_eliminado`, `mar_causa_eliminacion`, `mar_causa_actualizacion`) VALUES
(1, 'ACT', now(), 1, 1, now(), 0, NULL, NULL),
(2, 'AGILENT', now(), 1, 1, now(), 0, NULL, NULL),
(3, 'BIO-RAD', now(), 1, 1, now(), 0, NULL, NULL),
(4, 'CHIRAL', now(), 1, 1, now(), 0, NULL, NULL),
(5, 'GRACE DISCOVERY SCIENCES', now(), 1, 1, now(), 0, NULL, NULL),
(6, 'HICHROM', now(), 1, 1, now(), 0, NULL, NULL),
(7, 'MERCK', now(), 1, 1, now(), 0, NULL, NULL),
(8, 'PHENOMENEX', now(), 1, 1, now(), 0, NULL, NULL),
(9, 'SHINWA CHEMICAL INDUSTRIES', now(), 1, 1, now(), 0, NULL, NULL),
(10, 'SHODEX', now(), 1, 1, now(), 0, NULL, NULL),
(11, 'THERMO SCIENTIFIC', now(), 1, 1, now(), 0, NULL, NULL),
(12, 'WATERS', now(), 1, 1, now(), 0, NULL, NULL),
(13, 'YMC', now(), 1, 1, now(), 0, NULL, NULL);

INSERT INTO `modelo` (`mod_codigo`, `mod_nombre`, `mod_eliminado`, `mod_fecha_registro_sistema`, `mod_usu_crea`, `mod_fecha_actualizacion`, `mod_usu_actualiza`, `mod_causa_eliminacion`, `mod_causa_actualizacion`) VALUES
(1, 'ACE', 0, now(), 1, now(), 1, NULL, NULL),
(2, 'ALLSEP ANION', 0, now(), 1, now(), 1, NULL, NULL),
(3, 'AMINEX HPX-87H', 0, now(), 1, now(), 1, NULL, NULL),
(4, 'ASAHIPAK', 0, now(), 1, now(), 1, NULL, NULL),
(5, 'CHIRALCEL OD', 0, now(), 1, now(), 1, NULL, NULL),
(6, 'CHIRALPAK', 0, now(), 1, now(), 1, NULL, NULL),
(7, 'CHIRALPAK AD', 0, now(), 1, now(), 1, NULL, NULL),
(8, 'CHIREX (S) LEV y (R) NEA', 0, now(), 1, now(), 1, NULL, NULL),
(9, 'CHROMOLITH', 0, now(), 1, now(), 1, NULL, NULL),
(10, 'D-CHIRAL-AGPTM + PRECOLUMNA', 0, now(), 1, now(), 1, NULL, NULL),
(11, 'GEMINI', 0, now(), 1, now(), 1, NULL, NULL),
(12, 'HILIC ATLANTIS', 0, now(), 1, now(), 1, NULL, NULL),
(13, 'HYPERCLONE', 0, now(), 1, now(), 1, NULL, NULL),
(14, 'HYPERSIL', 0, now(), 1, now(), 1, NULL, NULL),
(15, 'KINETEX', 0, now(), 1, now(), 1, NULL, NULL),
(16, 'LICHROCART', 0, now(), 1, now(), 1, NULL, NULL),
(17, 'LICHROCART 100', 0, now(), 1, now(), 1, NULL, NULL),
(18, 'LICHROCART CHIRADEX', 0, now(), 1, now(), 1, NULL, NULL),
(19, 'LICHROSPHER', 0, now(), 1, now(), 1, NULL, NULL),
(20, 'LICHROSPHER 100', 0, now(), 1, now(), 1, NULL, NULL),
(21, 'MICROBONDAPAK', 0, now(), 1, now(), 1, NULL, NULL),
(22, 'MICROPORASIL', 0, now(), 1, now(), 1, NULL, NULL),
(23, 'NOVAPAK', 0, now(), 1, now(), 1, NULL, NULL),
(24, 'NOVAPAK HP', 0, now(), 1, now(), 1, NULL, NULL),
(25, 'PARTISIL 10', 0, now(), 1, now(), 1, NULL, NULL),
(26, 'PHENOMENEX GEMINI', 0, now(), 1, now(), 1, NULL, NULL),
(27, 'PHENOMENEX GEMINI-NX', 0, now(), 1, now(), 1, NULL, NULL),
(28, 'PHENOMENEX HYPERCLONE', 0, now(), 1, now(), 1, NULL, NULL),
(29, 'PHENOMENEX HYPERCLONE BDS', 0, now(), 1, now(), 1, NULL, NULL),
(30, 'PHENOMENEX HYPERSIL', 0, now(), 1, now(), 1, NULL, NULL),
(31, 'PHENOMENEX KINETEX', 0, now(), 1, now(), 1, NULL, NULL),
(32, 'PHENOMENEX KROMASIL', 0, now(), 1, now(), 1, NULL, NULL),
(33, 'PHENOMENEX LUNA', 0, now(), 1, now(), 1, NULL, NULL),
(34, 'PHENOMENEX SPHERISORB', 0, now(), 1, now(), 1, NULL, NULL),
(35, 'PUROSPHER', 0, now(), 1, now(), 1, NULL, NULL),
(36, 'PUROSPHER STAR', 0, now(), 1, now(), 1, NULL, NULL),
(37, 'SPHEREX OH (DIOL)', 0, now(), 1, now(), 1, NULL, NULL),
(38, 'SPHERISORB', 0, now(), 1, now(), 1, NULL, NULL),
(39, 'SYMMETRY', 0, now(), 1, now(), 1, NULL, NULL),
(40, 'SYMMETRY SHIELD', 0, now(), 1, now(), 1, NULL, NULL),
(41, 'SYNERGI POLAR', 0, now(), 1, now(), 1, NULL, NULL),
(42, 'THERMO HYPERSIL GOLD', 0, now(), 1, now(), 1, NULL, NULL),
(43, 'ULTRON ES-OVM', 0, now(), 1, now(), 1, NULL, NULL),
(44, 'X-BRIDGE', 0, now(), 1, now(), 1, NULL, NULL),
(45, 'X-TERRA', 0, now(), 1, now(), 1, NULL, NULL),
(46, 'X-TERRA MS', 0, now(), 1, now(), 1, NULL, NULL),
(47, 'YMC-PACK ODS', 0, now(), 1, now(), 1, NULL, NULL),
(48, 'ZORBAX', 0, now(), 1, now(), 1, NULL, NULL),
(49, 'ZORBAX ECLIPSE XDB', 0, now(), 1, now(), 1, NULL, NULL),
(50, 'ZORBAX RX', 0, now(), 1, now(), 1, NULL, NULL),
(51, 'ZORBAX SB', 0, now(), 1, now(), 1, NULL, NULL);

INSERT INTO `fase_ligada` (`fase_codigo`, `fase_nombre`, `fase_eliminado`, `fase_fecha_registro_sistema`, `fase_usu_crea`, `fase_fecha_actualizacion`, `fase_usu_actualiza`, `fase_causa_eliminacion`, `fase_causa_actualizacion`) VALUES
(1, 'AGP', 0, now(), 1, now(), 1, NULL, NULL),
(2, 'C6', 0, now(), 1, now(), 1, NULL, NULL),
(3, 'C8', 0, now(), 1, now(), 1, NULL, NULL),
(4, 'C18', 0, now(), 1, now(), 1, NULL, NULL),
(5, 'CN', 0, now(), 1, now(), 1, NULL, NULL),
(6, 'FENIL', 0, now(), 1, now(), 1, NULL, NULL),
(7, 'H', 0, now(), 1, now(), 1, NULL, NULL),
(8, 'ODP-50', 0, now(), 1, now(), 1, NULL, NULL),
(9, 'ODS (2)', 0, now(), 1, now(), 1, NULL, NULL),
(10, 'RP', 0, now(), 1, now(), 1, NULL, NULL),
(11, 'RP8', 0, now(), 1, now(), 1, NULL, NULL),
(12, 'RP18', 0, now(), 1, now(), 1, NULL, NULL),
(13, 'RP18e', 0, now(), 1, now(), 1, NULL, NULL),
(14, 'SCX', 0, now(), 1, now(), 1, NULL, NULL),
(15, 'SI', 0, now(), 1, now(), 1, NULL, NULL),
(16, 'SILICA', 0, now(), 1, now(), 1, NULL, NULL),
(17, 'X', 0, now(), 1, now(), 1, NULL, NULL);

INSERT INTO `dimension` (`dim_codigo`, `dim_nombre`, `dim_eliminado`, `dim_fecha_registro_sistema`, `dim_usu_crea`, `dim_fecha_actualizacion`, `dim_usu_actualiza`, `dim_causa_eliminacion`, `dim_causa_actualizacion`) VALUES
(1, '3.0 x 150 mm', 0, now(), 1, now(), 1, NULL, NULL),
(2, '3.9 x 150 mm', 0, now(), 1, now(), 1, NULL, NULL),
(3, '3.9 x 300 mm', 0, now(), 1, now(), 1, NULL, NULL),
(4, '4.0 x 55 mm', 0, now(), 1, now(), 1, NULL, NULL),
(5, '4.0 x 100 mm', 0, now(), 1, now(), 1, NULL, NULL),
(6, '4.0 x 125 mm', 0, now(), 1, now(), 1, NULL, NULL),
(7, '4.0 x 150 mm', 0, now(), 1, now(), 1, NULL, NULL),
(8, '4.0 x 250 mm', 0, now(), 1, now(), 1, NULL, NULL),
(9, '4.6 x 50 mm', 0, now(), 1, now(), 1, NULL, NULL),
(10, '4.6 x 75 mm', 0, now(), 1, now(), 1, NULL, NULL),
(11, '4.6 x 100 mm', 0, now(), 1, now(), 1, NULL, NULL),
(12, '4.6 x 150 mm', 0, now(), 1, now(), 1, NULL, NULL),
(13, '4.6 x 250 mm', 0, now(), 1, now(), 1, NULL, NULL),
(14, '6.0 x 4 mm', 0, now(), 1, now(), 1, NULL, NULL),
(15, '7.8 x 300 mm', 0, now(), 1, now(), 1, NULL, NULL);

INSERT INTO `tamano_particula` (`tam_codigo`, `tam_nombre`, `tam_eliminado`, `tam_fecha_registro_sistema`, `tam_usu_crea`, `tam_fecha_actualizacion`, `tam_usu_actualiza`, `tam_causa_eliminacion`, `tam_causa_actualizacion`) VALUES
(1, '1.8', 0, now(), 1, now(), 1, NULL, NULL),
(2, '2.6', 0, now(), 1, now(), 1, NULL, NULL),
(3, '3.0', 0, now(), 1, now(), 1, NULL, NULL),
(4, '3.5', 0, now(), 1, now(), 1, NULL, NULL),
(5, '4.0', 0, now(), 1, now(), 1, NULL, NULL),
(6, '5.0', 0, now(), 1, now(), 1, NULL, NULL),
(7, '7.0', 0, now(), 1, now(), 1, NULL, NULL),
(8, '10.0', 0, now(), 1, now(), 1, NULL, NULL),
(9, 'X', 0, now(), 1, now(), 1, NULL, NULL);

INSERT INTO `columna` (`col_codigo`, `col_codigo_interno`, `col_lote`, `col_eliminado`, `col_fecha_registro_sistema`, `col_usu_crea`, `col_fecha_actualizacion`, `col_usu_actualiza`, `col_causa_eliminacion`, `col_causa_actualizacion`, `col_mar_codigo`, `col_mod_codigo`, `col_fase_codigo`, `col_dim_codigo`, `col_tam_codigo`) VALUES
(1, 350, 'X', 0, now(), 1, now(), 1, NULL, NULL, 7, 16, 13, 8, 6),
(2, 227, 'X', 0, now(), 1, now(), 1, NULL, NULL, 12, 45, 12, 12, 4),
(3, 197, 'X', 0, now(), 1, now(), 1, NULL, NULL, 12, 23, 4, 2, 5),
(4, 416, 'X', 0, now(), 1, now(), 1, NULL, NULL, 7, 19, 13, 6, 6),
(5, 228, 'X', 0, now(), 1, now(), 1, NULL, NULL, 12, 45, 12, 13, 6),
(6, 432, 'X', 0, now(), 1, now(), 1, NULL, NULL, 12, 39, 4, 13, 6),
(7, 125, 'X', 0, now(), 1, now(), 1, NULL, NULL, 12, 45, 12, 12, 4),
(8, 69, 'X', 0, now(), 1, now(), 1, NULL, NULL, 8, 11, 2, 12, 6),
(9, 59, 'X', 0, now(), 1, now(), 1, NULL, NULL, 12, 45, 12, 13, 6),
(10, 297, 'X', 0, now(), 1, now(), 1, NULL, NULL, 12, 45, 12, 13, 6),
(11, 384, 'X', 0, now(), 1, now(), 1, NULL, NULL, 7, 35, 13, 12, 6),
(12, 409, 'X', 0, now(), 1, now(), 1, NULL, NULL, 7, 35, 13, 12, 6),
(13, 318, 'X', 0, now(), 1, now(), 1, NULL, NULL, 12, 45, 12, 12, 6),
(14, 19, 'X', 0, now(), 1, now(), 1, NULL, NULL, 1, 1, 4, 12, 6),
(15, 424, 'X', 0, now(), 1, now(), 1, NULL, NULL, 7, 9, 13, 11, 6),
(16, 54, 'X', 0, now(), 1, now(), 1, NULL, NULL, 12, 44, 6, 13, 6),
(17, 582, 'X', 0, now(), 1, now(), 1, NULL, NULL, 8, 32, 3, 12, 6),
(18, 579, 'X', 0, now(), 1, now(), 1, NULL, NULL, 12, 39, 3, 2, 6),
(19, 61, 'X', 0, now(), 1, now(), 1, NULL, NULL, 12, 23, 4, 2, 5),
(20, 322, 'X', 0, now(), 1, now(), 1, NULL, NULL, 12, 45, 11, 13, 4),
(21, 488, 'X', 0, now(), 1, now(), 1, NULL, NULL, 12, 45, 12, 9, 4),
(22, 177, 'X', 0, now(), 1, now(), 1, NULL, NULL, 12, 45, 12, 13, 6),
(23, 193, 'X', 0, now(), 1, now(), 1, NULL, NULL, 12, 45, 11, 13, 6),
(24, 1, 'X', 0, now(), 1, now(), 1, NULL, NULL, 10, 4, 8, 12, 6),
(25, 250, 'X', 0, now(), 1, now(), 1, NULL, NULL, 12, 45, 12, 13, 6),
(26, 391, 'X', 0, now(), 1, now(), 1, NULL, NULL, 12, 45, 12, 13, 6),
(27, 154, 'X', 0, now(), 1, now(), 1, NULL, NULL, 12, 45, 12, 12, 6),
(28, 444, 'X', 0, now(), 1, now(), 1, NULL, NULL, 12, 38, 9, 13, 6),
(29, 278, 'X', 0, now(), 1, now(), 1, NULL, NULL, 12, 45, 12, 12, 6),
(30, 500, 'X', 0, now(), 1, now(), 1, NULL, NULL, 8, 34, 9, 13, 6),
(31, 435, 'X', 0, now(), 1, now(), 1, NULL, NULL, 12, 23, 4, 2, 5),
(32, 370, 'X', 0, now(), 1, now(), 1, NULL, NULL, 12, 45, 12, 13, 6),
(33, 274, 'X', 0, now(), 1, now(), 1, NULL, NULL, 12, 45, 12, 13, 6),
(34, 371, 'X', 0, now(), 1, now(), 1, NULL, NULL, 12, 45, 12, 13, 6),
(35, 153, 'X', 0, now(), 1, now(), 1, NULL, NULL, 12, 45, 12, 12, 6),
(36, 360, 'X', 0, now(), 1, now(), 1, NULL, NULL, 12, 45, 11, 13, 6),
(37, 44, 'X', 0, now(), 1, now(), 1, NULL, NULL, 4, 7, 7, 13, 6),
(38, 330, 'X', 0, now(), 1, now(), 1, NULL, NULL, 12, 40, 12, 13, 6),
(39, 337, 'X', 0, now(), 1, now(), 1, NULL, NULL, 12, 45, 12, 12, 4),
(40, 509, 'X', 0, now(), 1, now(), 1, NULL, NULL, 2, 50, 3, 13, 6),
(41, 440, 'X', 0, now(), 1, now(), 1, NULL, NULL, 12, 24, 5, 3, 5),
(42, 229, 'X', 0, now(), 1, now(), 1, NULL, NULL, 12, 45, 12, 13, 6),
(43, 123, 'X', 0, now(), 1, now(), 1, NULL, NULL, 12, 46, 4, 13, 6),
(44, 244, 'X', 0, now(), 1, now(), 1, NULL, NULL, 12, 45, 12, 12, 6),
(45, 483, 'X', 0, now(), 1, now(), 1, NULL, NULL, 12, 45, 12, 13, 6),
(46, 551, 'X', 0, now(), 1, now(), 1, NULL, NULL, 12, 45, 12, 13, 6),
(47, 313, 'X', 0, now(), 1, now(), 1, NULL, NULL, 12, 45, 12, 13, 6),
(48, 436, 'X', 0, now(), 1, now(), 1, NULL, NULL, 12, 21, 4, 2, 8),
(49, 429, 'X', 0, now(), 1, now(), 1, NULL, NULL, 2, 49, 4, 10, 4),
(50, 339, 'X', 0, now(), 1, now(), 1, NULL, NULL, 12, 45, 12, 13, 6),
(51, 8, 'X', 0, now(), 1, now(), 1, NULL, NULL, 12, 45, 12, 12, 4),
(52, 254, 'X', 0, now(), 1, now(), 1, NULL, NULL, 8, 27, 4, 12, 6),
(53, 295, 'X', 0, now(), 1, now(), 1, NULL, NULL, 12, 45, 12, 13, 6),
(54, 263, 'X', 0, now(), 1, now(), 1, NULL, NULL, 12, 45, 11, 12, 4),
(55, 421, 'X', 0, now(), 1, now(), 1, NULL, NULL, 7, 20, 11, 6, 6),
(56, 85, 'X', 0, now(), 1, now(), 1, NULL, NULL, 7, 20, 13, 6, 6),
(57, 596, 'X', 0, now(), 1, now(), 1, NULL, NULL, 12, 24, 5, 3, 5),
(58, 306, 'X', 0, now(), 1, now(), 1, NULL, NULL, 7, 20, 11, 6, 6),
(59, 458, 'X', 0, now(), 1, now(), 1, NULL, NULL, 8, 27, 4, 12, 6),
(60, 463, 'X', 0, now(), 1, now(), 1, NULL, NULL, 11, 42, 4, 13, 6),
(61, 455, 'X', 0, now(), 1, now(), 1, NULL, NULL, 12, 45, 12, 13, 6),
(62, 354, 'X', 0, now(), 1, now(), 1, NULL, NULL, 12, 45, 12, 12, 4),
(63, 225, 'X', 0, now(), 1, now(), 1, NULL, NULL, 12, 23, 3, 2, 5),
(64, 16, 'X', 0, now(), 1, now(), 1, NULL, NULL, 12, 23, 16, 2, 5),
(65, 17, 'X', 0, now(), 1, now(), 1, NULL, NULL, 12, 23, 16, 2, 5),
(66, 55, 'X', 0, now(), 1, now(), 1, NULL, NULL, 11, 14, 15, 13, 6),
(67, 323, 'X', 0, now(), 1, now(), 1, NULL, NULL, 12, 23, 3, 2, 5),
(68, 234, 'X', 0, now(), 1, now(), 1, NULL, NULL, 7, 20, 13, 6, 6),
(69, 361, 'X', 0, now(), 1, now(), 1, NULL, NULL, 12, 45, 11, 12, 4),
(70, 279, 'X', 0, now(), 1, now(), 1, NULL, NULL, 12, 45, 12, 12, 6),
(71, 192, 'X', 0, now(), 1, now(), 1, NULL, NULL, 12, 45, 12, 13, 6),
(72, 256, 'X', 0, now(), 1, now(), 1, NULL, NULL, 12, 45, 11, 12, 6),
(73, 152, 'X', 0, now(), 1, now(), 1, NULL, NULL, 12, 45, 12, 12, 6),
(74, 142, 'X', 0, now(), 1, now(), 1, NULL, NULL, 12, 45, 12, 13, 4),
(75, 460, 'X', 0, now(), 1, now(), 1, NULL, NULL, 8, 13, 4, 11, 3),
(76, 276, 'X', 0, now(), 1, now(), 1, NULL, NULL, 12, 45, 12, 13, 6),
(77, 290, 'X', 0, now(), 1, now(), 1, NULL, NULL, 12, 45, 11, 13, 4),
(78, 232, 'X', 0, now(), 1, now(), 1, NULL, NULL, 12, 45, 11, 13, 6),
(79, 553, 'X', 0, now(), 1, now(), 1, NULL, NULL, 12, 44, 6, 13, 6),
(80, 387, 'X', 0, now(), 1, now(), 1, NULL, NULL, 12, 44, 6, 13, 6),
(81, 139, 'X', 0, now(), 1, now(), 1, NULL, NULL, 12, 45, 12, 12, 4),
(82, 548, 'X', 0, now(), 1, now(), 1, NULL, NULL, 12, 45, 12, 12, 4),
(83, 95, 'X', 0, now(), 1, now(), 1, NULL, NULL, 7, 20, 13, 6, 6),
(84, 454, 'X', 0, now(), 1, now(), 1, NULL, NULL, 9, 43, 17, 12, 6),
(85, 368, 'X', 0, now(), 1, now(), 1, NULL, NULL, 7, 20, 13, 6, 6),
(86, 32, 'X', 0, now(), 1, now(), 1, NULL, NULL, 9, 43, 17, 12, 6),
(87, 174, 'X', 0, now(), 1, now(), 1, NULL, NULL, 12, 23, 4, 2, 5),
(88, 70, 'X', 0, now(), 1, now(), 1, NULL, NULL, 8, 26, 4, 13, 6),
(89, 248, 'X', 0, now(), 1, now(), 1, NULL, NULL, 12, 45, 12, 13, 6),
(90, 176, 'X', 0, now(), 1, now(), 1, NULL, NULL, 12, 45, 12, 13, 6),
(91, 426, 'X', 0, now(), 1, now(), 1, NULL, NULL, 7, 36, 13, 13, 6),
(92, 210, 'X', 0, now(), 1, now(), 1, NULL, NULL, 12, 45, 12, 13, 6),
(93, 363, 'X', 0, now(), 1, now(), 1, NULL, NULL, 12, 45, 11, 13, 6),
(94, 251, 'X', 0, now(), 1, now(), 1, NULL, NULL, 12, 45, 11, 13, 6),
(95, 204, 'X', 0, now(), 1, now(), 1, NULL, NULL, 12, 39, 4, 12, 6),
(96, 292, 'X', 0, now(), 1, now(), 1, NULL, NULL, 12, 12, 16, 13, 6),
(97, 298, 'X', 0, now(), 1, now(), 1, NULL, NULL, 12, 45, 12, 12, 4),
(98, 385, 'X', 0, now(), 1, now(), 1, NULL, NULL, 8, 8, 17, 13, 6),
(99, 267, 'X', 0, now(), 1, now(), 1, NULL, NULL, 12, 45, 12, 13, 6),
(100, 319, 'X', 0, now(), 1, now(), 1, NULL, NULL, 12, 45, 11, 13, 6),
(101, 457, 'X', 0, now(), 1, now(), 1, NULL, NULL, 12, 45, 11, 13, 6),
(102, 534, 'X', 0, now(), 1, now(), 1, NULL, NULL, 13, 47, 3, 12, 6),
(103, 478, 'X', 0, now(), 1, now(), 1, NULL, NULL, 8, 13, 4, 12, 6),
(104, 341, 'X', 0, now(), 1, now(), 1, NULL, NULL, 8, 33, 3, 13, 6),
(105, 311, 'X', 0, now(), 1, now(), 1, NULL, NULL, 12, 45, 12, 13, 6),
(106, 629, 'X', 0, now(), 1, now(), 1, NULL, NULL, 12, 45, 12, 12, 4),
(107, 316, 'X', 0, now(), 1, now(), 1, NULL, NULL, 12, 45, 12, 12, 4),
(108, 180, 'X', 0, now(), 1, now(), 1, NULL, NULL, 12, 23, 3, 2, 5),
(109, 359, 'X', 0, now(), 1, now(), 1, NULL, NULL, 7, 20, 13, 6, 6),
(110, 348, 'X', 0, now(), 1, now(), 1, NULL, NULL, 7, 16, 13, 8, 6),
(111, 314, 'X', 0, now(), 1, now(), 1, NULL, NULL, 12, 45, 12, 13, 6),
(112, 423, 'X', 0, now(), 1, now(), 1, NULL, NULL, 7, 35, 13, 4, 3),
(113, 237, 'X', 0, now(), 1, now(), 1, NULL, NULL, 7, 20, 13, 6, 6),
(114, 167, 'X', 0, now(), 1, now(), 1, NULL, NULL, 12, 23, 5, 2, 5),
(115, 158, 'X', 0, now(), 1, now(), 1, NULL, NULL, 12, 44, 6, 13, 6),
(116, 103, 'X', 0, now(), 1, now(), 1, NULL, NULL, 12, 24, 5, 3, 5),
(117, 545, 'X', 0, now(), 1, now(), 1, NULL, NULL, 7, 20, 13, 6, 6),
(118, 386, 'X', 0, now(), 1, now(), 1, NULL, NULL, 12, 45, 11, 13, 4),
(119, 466, 'X', 0, now(), 1, now(), 1, NULL, NULL, 12, 45, 11, 13, 6),
(120, 173, 'X', 0, now(), 1, now(), 1, NULL, NULL, 12, 23, 4, 2, 5),
(121, 121, 'X', 0, now(), 1, now(), 1, NULL, NULL, 2, 51, 4, 13, 6),
(122, 474, 'X', 0, now(), 1, now(), 1, NULL, NULL, 9, 43, 17, 12, 6),
(123, 262, 'X', 0, now(), 1, now(), 1, NULL, NULL, 8, 33, 4, 11, 3),
(124, 226, 'X', 0, now(), 1, now(), 1, NULL, NULL, 12, 45, 12, 9, 4),
(125, 300, 'X', 0, now(), 1, now(), 1, NULL, NULL, 12, 23, 4, 2, 5),
(126, 592, 'X', 0, now(), 1, now(), 1, NULL, NULL, 12, 45, 12, 9, 4),
(127, 618, 'X', 0, now(), 1, now(), 1, NULL, NULL, 12, 45, 12, 12, 4),
(128, 523, 'X', 0, now(), 1, now(), 1, NULL, NULL, 12, 45, 11, 12, 6),
(129, 513, 'X', 0, now(), 1, now(), 1, NULL, NULL, 12, 45, 12, 12, 4),
(130, 207, 'X', 0, now(), 1, now(), 1, NULL, NULL, 12, 45, 12, 13, 6),
(131, 378, 'X', 0, now(), 1, now(), 1, NULL, NULL, 12, 45, 12, 13, 6),
(132, 209, 'X', 0, now(), 1, now(), 1, NULL, NULL, 12, 22, 16, 2, 8),
(133, 78, 'X', 0, now(), 1, now(), 1, NULL, NULL, 8, 30, 4, 12, 6),
(134, 218, 'X', 0, now(), 1, now(), 1, NULL, NULL, 12, 39, 4, 12, 6),
(135, 288, 'X', 0, now(), 1, now(), 1, NULL, NULL, 8, 37, 17, 13, 6),
(136, 443, 'X', 0, now(), 1, now(), 1, NULL, NULL, 12, 45, 12, 13, 6),
(137, 369, 'X', 0, now(), 1, now(), 1, NULL, NULL, 12, 45, 12, 12, 6),
(138, 449, 'X', 0, now(), 1, now(), 1, NULL, NULL, 12, 39, 4, 12, 6),
(139, 219, 'X', 0, now(), 1, now(), 1, NULL, NULL, 12, 39, 4, 12, 6),
(140, 76, 'X', 0, now(), 1, now(), 1, NULL, NULL, 8, 30, 4, 12, 6),
(141, 398, 'X', 0, now(), 1, now(), 1, NULL, NULL, 7, 35, 13, 12, 6),
(142, 99, 'X', 0, now(), 1, now(), 1, NULL, NULL, 7, 20, 13, 6, 6),
(143, 388, 'X', 0, now(), 1, now(), 1, NULL, NULL, 12, 45, 11, 12, 4),
(144, 624, 'X', 0, now(), 1, now(), 1, NULL, NULL, 7, 19, 12, 13, 6),
(145, 253, 'X', 0, now(), 1, now(), 1, NULL, NULL, 12, 39, 4, 13, 6),
(146, 145, 'X', 0, now(), 1, now(), 1, NULL, NULL, 12, 45, 12, 13, 4),
(147, 317, 'X', 0, now(), 1, now(), 1, NULL, NULL, 12, 45, 12, 12, 4),
(148, 71, 'X', 0, now(), 1, now(), 1, NULL, NULL, 8, 26, 4, 13, 6),
(149, 471, 'X', 0, now(), 1, now(), 1, NULL, NULL, 12, 45, 12, 12, 4),
(150, 480, 'X', 0, now(), 1, now(), 1, NULL, NULL, 12, 45, 12, 13, 6),
(151, 467, 'X', 0, now(), 1, now(), 1, NULL, NULL, 12, 45, 12, 12, 6),
(152, 190, 'X', 0, now(), 1, now(), 1, NULL, NULL, 12, 46, 4, 13, 6),
(153, 506, 'X', 0, now(), 1, now(), 1, NULL, NULL, 12, 44, 6, 13, 6),
(154, 182, 'X', 0, now(), 1, now(), 1, NULL, NULL, 7, 18, 17, 13, 6),
(155, 498, 'X', 0, now(), 1, now(), 1, NULL, NULL, 12, 45, 12, 12, 4),
(156, 405, 'X', 0, now(), 1, now(), 1, NULL, NULL, 12, 23, 4, 2, 5),
(157, 199, 'X', 0, now(), 1, now(), 1, NULL, NULL, 12, 23, 4, 2, 5),
(158, 135, 'X', 0, now(), 1, now(), 1, NULL, NULL, 12, 45, 12, 12, 4),
(159, 120, 'X', 0, now(), 1, now(), 1, NULL, NULL, 12, 45, 11, 13, 4),
(160, 119, 'X', 0, now(), 1, now(), 1, NULL, NULL, 12, 45, 11, 12, 6),
(161, 194, 'X', 0, now(), 1, now(), 1, NULL, NULL, 12, 45, 11, 13, 6),
(162, 213, 'X', 0, now(), 1, now(), 1, NULL, NULL, 12, 23, 5, 2, 5),
(163, 2, 'X', 0, now(), 1, now(), 1, NULL, NULL, 12, 38, 3, 13, 6),
(164, 7, 'X', 0, now(), 1, now(), 1, NULL, NULL, 12, 45, 12, 2, 6),
(165, 272, 'X', 0, now(), 1, now(), 1, NULL, NULL, 12, 45, 12, 13, 6),
(166, 392, 'X', 0, now(), 1, now(), 1, NULL, NULL, 12, 23, 4, 2, 5),
(167, 4, 'X', 0, now(), 1, now(), 1, NULL, NULL, 12, 12, 16, 13, 6),
(168, 235, 'X', 0, now(), 1, now(), 1, NULL, NULL, 7, 20, 13, 6, 6),
(169, 114, 'X', 0, now(), 1, now(), 1, NULL, NULL, 12, 45, 12, 13, 6),
(170, 157, 'X', 0, now(), 1, now(), 1, NULL, NULL, 12, 45, 12, 12, 6),
(171, 355, 'X', 0, now(), 1, now(), 1, NULL, NULL, 12, 45, 12, 13, 6),
(172, 304, 'X', 0, now(), 1, now(), 1, NULL, NULL, 12, 39, 4, 13, 6),
(173, 497, 'X', 0, now(), 1, now(), 1, NULL, NULL, 12, 45, 12, 13, 6),
(174, 469, 'X', 0, now(), 1, now(), 1, NULL, NULL, 12, 45, 12, 12, 4),
(175, 358, 'X', 0, now(), 1, now(), 1, NULL, NULL, 7, 20, 13, 6, 6),
(176, 277, 'X', 0, now(), 1, now(), 1, NULL, NULL, 12, 45, 12, 12, 6),
(177, 93, 'X', 0, now(), 1, now(), 1, NULL, NULL, 7, 20, 13, 6, 6),
(178, 34, 'X', 0, now(), 1, now(), 1, NULL, NULL, 5, 2, 17, 12, 7),
(179, 202, 'X', 0, now(), 1, now(), 1, NULL, NULL, 12, 23, 3, 2, 5),
(180, 346, 'X', 0, now(), 1, now(), 1, NULL, NULL, 7, 16, 12, 8, 6),
(181, 236, 'X', 0, now(), 1, now(), 1, NULL, NULL, 7, 20, 13, 6, 6),
(182, 557, 'X', 0, now(), 1, now(), 1, NULL, NULL, 7, 20, 13, 6, 6),
(183, 543, 'X', 0, now(), 1, now(), 1, NULL, NULL, 7, 20, 13, 6, 6),
(184, 550, 'X', 0, now(), 1, now(), 1, NULL, NULL, 12, 45, 11, 12, 4),
(185, 511, 'X', 0, now(), 1, now(), 1, NULL, NULL, 2, 48, 3, 12, 6),
(186, 404, 'X', 0, now(), 1, now(), 1, NULL, NULL, 12, 12, 16, 13, 6),
(187, 10, 'X', 0, now(), 1, now(), 1, NULL, NULL, 12, 21, 4, 2, 8),
(188, 499, 'X', 0, now(), 1, now(), 1, NULL, NULL, 12, 45, 12, 12, 4),
(189, 170, 'X', 0, now(), 1, now(), 1, NULL, NULL, 12, 45, 11, 13, 6),
(190, 364, 'X', 0, now(), 1, now(), 1, NULL, NULL, 12, 45, 12, 13, 6),
(191, 484, 'X', 0, now(), 1, now(), 1, NULL, NULL, 12, 45, 12, 13, 6),
(192, 331, 'X', 0, now(), 1, now(), 1, NULL, NULL, 12, 12, 16, 13, 6),
(193, 481, 'X', 0, now(), 1, now(), 1, NULL, NULL, 12, 39, 4, 13, 6),
(194, 390, 'X', 0, now(), 1, now(), 1, NULL, NULL, 12, 12, 16, 13, 6),
(195, 266, 'X', 0, now(), 1, now(), 1, NULL, NULL, 12, 45, 12, 13, 6),
(196, 493, 'X', 0, now(), 1, now(), 1, NULL, NULL, 8, 28, 4, 2, 6),
(197, 66, 'X', 0, now(), 1, now(), 1, NULL, NULL, 12, 38, 4, 13, 6),
(198, 494, 'X', 0, now(), 1, now(), 1, NULL, NULL, 8, 30, 4, 12, 6),
(199, 308, 'X', 0, now(), 1, now(), 1, NULL, NULL, 2, 48, 3, 12, 6),
(200, 482, 'X', 0, now(), 1, now(), 1, NULL, NULL, 12, 45, 11, 12, 4),
(201, 357, 'X', 0, now(), 1, now(), 1, NULL, NULL, 7, 20, 13, 6, 6),
(202, 149, 'X', 0, now(), 1, now(), 1, NULL, NULL, 12, 45, 11, 12, 6),
(203, 296, 'X', 0, now(), 1, now(), 1, NULL, NULL, 12, 45, 12, 13, 6),
(204, 169, 'X', 0, now(), 1, now(), 1, NULL, NULL, 12, 45, 12, 12, 6),
(205, 320, 'X', 0, now(), 1, now(), 1, NULL, NULL, 12, 45, 11, 13, 6),
(206, 282, 'X', 0, now(), 1, now(), 1, NULL, NULL, 12, 45, 11, 12, 4),
(207, 84, 'X', 0, now(), 1, now(), 1, NULL, NULL, 7, 20, 13, 6, 6),
(208, 223, 'X', 0, now(), 1, now(), 1, NULL, NULL, 12, 23, 4, 2, 5),
(209, 188, 'X', 0, now(), 1, now(), 1, NULL, NULL, 7, 20, 13, 6, 6),
(210, 15, 'X', 0, now(), 1, now(), 1, NULL, NULL, 12, 39, 4, 12, 6),
(211, 376, 'X', 0, now(), 1, now(), 1, NULL, NULL, 7, 20, 13, 6, 6),
(212, 24, 'X', 0, now(), 1, now(), 1, NULL, NULL, 12, 45, 12, 13, 4),
(213, 155, 'X', 0, now(), 1, now(), 1, NULL, NULL, 12, 45, 12, 12, 6),
(214, 334, 'X', 0, now(), 1, now(), 1, NULL, NULL, 7, 19, 12, 6, 6),
(215, 329, 'X', 0, now(), 1, now(), 1, NULL, NULL, 6, 25, 14, 13, 8),
(216, 400, 'X', 0, now(), 1, now(), 1, NULL, NULL, 12, 39, 4, 12, 6),
(217, 372, 'X', 0, now(), 1, now(), 1, NULL, NULL, 12, 45, 4, 13, 6),
(218, 347, 'X', 0, now(), 1, now(), 1, NULL, NULL, 7, 16, 13, 8, 6),
(219, 456, 'X', 0, now(), 1, now(), 1, NULL, NULL, 12, 39, 4, 13, 6),
(220, 305, 'X', 0, now(), 1, now(), 1, NULL, NULL, 7, 20, 11, 6, 6),
(221, 215, 'X', 0, now(), 1, now(), 1, NULL, NULL, 12, 45, 11, 12, 6),
(222, 453, 'X', 0, now(), 1, now(), 1, NULL, NULL, 7, 36, 13, 13, 6),
(223, 268, 'X', 0, now(), 1, now(), 1, NULL, NULL, 12, 45, 12, 12, 6),
(224, 117, 'X', 0, now(), 1, now(), 1, NULL, NULL, 12, 45, 11, 12, 6),
(225, 342, 'X', 0, now(), 1, now(), 1, NULL, NULL, 12, 45, 12, 13, 6),
(226, 50, 'X', 0, now(), 1, now(), 1, NULL, NULL, 8, 33, 4, 13, 6),
(227, 112, 'X', 0, now(), 1, now(), 1, NULL, NULL, 2, 49, 6, 12, 6),
(228, 64, 'X', 0, now(), 1, now(), 1, NULL, NULL, 2, 51, 6, 9, 1),
(229, 489, 'X', 0, now(), 1, now(), 1, NULL, NULL, 4, 6, 1, 7, 6),
(230, 191, 'X', 0, now(), 1, now(), 1, NULL, NULL, 12, 45, 12, 13, 6),
(231, 273, 'X', 0, now(), 1, now(), 1, NULL, NULL, 12, 45, 12, 13, 6),
(232, 3, 'X', 0, now(), 1, now(), 1, NULL, NULL, 12, 23, 4, 3, 5),
(233, 136, 'X', 0, now(), 1, now(), 1, NULL, NULL, 12, 45, 12, 12, 4),
(234, 187, 'X', 0, now(), 1, now(), 1, NULL, NULL, 7, 20, 13, 6, 6),
(235, 264, 'X', 0, now(), 1, now(), 1, NULL, NULL, 12, 45, 11, 12, 4),
(236, 487, 'X', 0, now(), 1, now(), 1, NULL, NULL, 2, 51, 3, 11, 4),
(237, 179, 'X', 0, now(), 1, now(), 1, NULL, NULL, 12, 39, 4, 12, 6),
(238, 88, 'X', 0, now(), 1, now(), 1, NULL, NULL, 7, 20, 13, 6, 6),
(239, 94, 'X', 0, now(), 1, now(), 1, NULL, NULL, 7, 20, 13, 6, 6),
(240, 542, 'X', 0, now(), 1, now(), 1, NULL, NULL, 7, 20, 13, 6, 6),
(241, 422, 'X', 0, now(), 1, now(), 1, NULL, NULL, 7, 20, 13, 6, 6),
(242, 87, 'X', 0, now(), 1, now(), 1, NULL, NULL, 7, 20, 13, 6, 6),
(243, 437, 'X', 0, now(), 1, now(), 1, NULL, NULL, 12, 45, 12, 12, 4),
(244, 470, 'X', 0, now(), 1, now(), 1, NULL, NULL, 12, 45, 12, 9, 4),
(245, 301, 'X', 0, now(), 1, now(), 1, NULL, NULL, 12, 21, 4, 2, 8),
(246, 472, 'X', 0, now(), 1, now(), 1, NULL, NULL, 12, 45, 11, 12, 6),
(247, 402, 'X', 0, now(), 1, now(), 1, NULL, NULL, 12, 45, 11, 13, 6),
(248, 303, 'X', 0, now(), 1, now(), 1, NULL, NULL, 12, 24, 5, 3, 5),
(249, 106, 'X', 0, now(), 1, now(), 1, NULL, NULL, 12, 24, 5, 3, 5),
(250, 275, 'X', 0, now(), 1, now(), 1, NULL, NULL, 12, 45, 12, 13, 6),
(251, 151, 'X', 0, now(), 1, now(), 1, NULL, NULL, 12, 45, 12, 12, 6),
(252, 217, 'X', 0, now(), 1, now(), 1, NULL, NULL, 12, 45, 11, 12, 4),
(253, 31, 'X', 0, now(), 1, now(), 1, NULL, NULL, 4, 10, 17, 5, 6),
(254, 464, 'X', 0, now(), 1, now(), 1, NULL, NULL, 7, 36, 13, 13, 6),
(255, 508, 'X', 0, now(), 1, now(), 1, NULL, NULL, 3, 3, 17, 15, 9),
(256, 28, 'X', 0, now(), 1, now(), 1, NULL, NULL, 8, 29, 3, 13, 6),
(257, 560, 'X', 0, now(), 1, now(), 1, NULL, NULL, 8, 15, 4, 11, 2),
(258, 6, 'X', 0, now(), 1, now(), 1, NULL, NULL, 12, 21, 4, 2, 8),
(259, 27, 'X', 0, now(), 1, now(), 1, NULL, NULL, 12, 40, 12, 13, 6),
(260, 3894, 'X', 0, now(), 1, now(), 1, NULL, NULL, 2, 48, 5, 14, 3),
(261, 138, 'X', 0, now(), 1, now(), 1, NULL, NULL, 12, 45, 12, 12, 4),
(262, 417, 'X', 0, now(), 1, now(), 1, NULL, NULL, 7, 36, 13, 13, 6),
(263, 30, 'X', 0, now(), 1, now(), 1, NULL, NULL, 8, 27, 4, 13, 6),
(264, 379, 'X', 0, now(), 1, now(), 1, NULL, NULL, 12, 45, 12, 13, 6),
(265, 382, 'X', 0, now(), 1, now(), 1, NULL, NULL, 12, 45, 12, 12, 4),
(266, 122, 'X', 0, now(), 1, now(), 1, NULL, NULL, 2, 51, 4, 1, 4),
(267, 541, 'X', 0, now(), 1, now(), 1, NULL, NULL, 7, 20, 13, 6, 6),
(268, 442, 'X', 0, now(), 1, now(), 1, NULL, NULL, 12, 45, 12, 13, 6),
(269, 115, 'X', 0, now(), 1, now(), 1, NULL, NULL, 12, 45, 12, 13, 6),
(270, 56, 'X', 0, now(), 1, now(), 1, NULL, NULL, 8, 27, 4, 13, 6),
(271, 49, 'X', 0, now(), 1, now(), 1, NULL, NULL, 4, 7, 7, 13, 6),
(272, 438, 'X', 0, now(), 1, now(), 1, NULL, NULL, 12, 45, 12, 12, 6),
(273, 46, 'X', 0, now(), 1, now(), 1, NULL, NULL, 2, 51, 5, 13, 6),
(274, 375, 'X', 0, now(), 1, now(), 1, NULL, NULL, 7, 20, 13, 6, 6),
(275, 108, 'X', 0, now(), 1, now(), 1, NULL, NULL, 8, 41, 10, 12, 5),
(276, 507, 'X', 0, now(), 1, now(), 1, NULL, NULL, 12, 39, 4, 12, 6),
(277, 411, 'X', 0, now(), 1, now(), 1, NULL, NULL, 7, 20, 13, 6, 6),
(278, 214, 'X', 0, now(), 1, now(), 1, NULL, NULL, 12, 45, 12, 13, 6),
(279, 233, 'X', 0, now(), 1, now(), 1, NULL, NULL, 7, 17, 13, 6, 6),
(280, 124, 'X', 0, now(), 1, now(), 1, NULL, NULL, 12, 39, 4, 12, 6),
(281, 133, 'X', 0, now(), 1, now(), 1, NULL, NULL, 12, 45, 12, 12, 4),
(282, 428, 'X', 0, now(), 1, now(), 1, NULL, NULL, 2, 49, 4, 1, 6),
(283, 468, 'X', 0, now(), 1, now(), 1, NULL, NULL, 12, 45, 12, 12, 6),
(284, 247, 'X', 0, now(), 1, now(), 1, NULL, NULL, 12, 46, 4, 13, 6),
(285, 353, 'X', 0, now(), 1, now(), 1, NULL, NULL, 12, 45, 12, 12, 6),
(286, 48, 'X', 0, now(), 1, now(), 1, NULL, NULL, 8, 13, 4, 11, 3),
(287, 549, 'X', 0, now(), 1, now(), 1, NULL, NULL, 12, 45, 12, 12, 4),
(288, 439, 'X', 0, now(), 1, now(), 1, NULL, NULL, 12, 45, 12, 12, 4),
(289, 516, 'X', 0, now(), 1, now(), 1, NULL, NULL, 12, 39, 3, 12, 6),
(290, 131, 'X', 0, now(), 1, now(), 1, NULL, NULL, 12, 45, 12, 12, 4),
(291, 35, 'X', 0, now(), 1, now(), 1, NULL, NULL, 8, 31, 4, 12, 6),
(292, 518, 'X', 0, now(), 1, now(), 1, NULL, NULL, 12, 39, 3, 12, 6),
(293, 401, 'X', 0, now(), 1, now(), 1, NULL, NULL, 12, 45, 12, 13, 6),
(294, 175, 'X', 0, now(), 1, now(), 1, NULL, NULL, 12, 45, 12, 13, 6),
(295, 486, 'X', 0, now(), 1, now(), 1, NULL, NULL, 8, 33, 4, 13, 6),
(296, 465, 'X', 0, now(), 1, now(), 1, NULL, NULL, 12, 45, 12, 9, 4),
(297, 206, 'X', 0, now(), 1, now(), 1, NULL, NULL, 12, 39, 4, 12, 6),
(298, 60, 'X', 0, now(), 1, now(), 1, NULL, NULL, 12, 45, 12, 9, 4),
(299, 526, 'X', 0, now(), 1, now(), 1, NULL, NULL, 12, 45, 12, 8, 6),
(300, 366, 'X', 0, now(), 1, now(), 1, NULL, NULL, 7, 20, 13, 6, 6),
(301, 270, 'X', 0, now(), 1, now(), 1, NULL, NULL, 4, 5, 7, 13, 9),
(302, 111, 'X', 0, now(), 1, now(), 1, NULL, NULL, 12, 23, 4, 2, 5),
(303, 299, 'X', 0, now(), 1, now(), 1, NULL, NULL, 12, 45, 11, 13, 4),
(304, 62, 'X', 0, now(), 1, now(), 1, NULL, NULL, 12, 23, 4, 2, 5);