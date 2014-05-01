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
(1,1, 'HPLC Q-EL-001', 'HEWLLET PACKARD', 'Rop-34AGILENT 1100', '2011-01-27', NULL, '0.5800', '2011-01-27 12:35:38', 'Q-EL-004',1,1, '2011-01-27 21:49:06',0, NULL),
(2,1, 'HPLC Q-EL-002', 'SHIMADZU', 'LC2010-AHT', '2011-01-27', NULL, '0.5800', '2011-01-27 12:35:38', 'Q-EL-005',1,1, '2011-01-27 21:50:00',0, NULL),
(3,1, 'HPLC Q-EL-003', 'SHIMADZU', 'LC2010-AHT', '2011-01-20', NULL, '0.5800', '2011-01-27 18:32:03', 'Q-EL-006',1,1, '2011-01-27 21:50:12',0, NULL);

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

INSERT INTO `metodo` (`met_codigo`, `met_nombre`, `met_tiempo_alistamiento`, `met_tiempo_acondicionamiento`, `met_tiempo_estabilizacion`, `met_tiempo_estandar`, `met_tiempo_corrida_sistema`, `met_tiempo_corrida_curvas`, `met_num_inyeccion_estandar_1`, `met_num_inyeccion_estandar_2`, `met_num_inyeccion_estandar_3`, `met_num_inyeccion_estandar_4`, `met_num_inyeccion_estandar_5`, `met_num_inyeccion_estandar_6`, `met_num_inyeccion_estandar_7`, `met_num_inyeccion_estandar_8`, `met_fecha_registro_sistema`, `met_num_inyec_x_mu_producto`, `met_num_inyec_x_mu_estabilidad`, `met_num_inyec_x_mu_materia_pri`, `met_num_inyec_x_mu_pureza`, `met_num_inyec_x_mu_disolucion`, `met_num_inyec_x_mu_uniformidad`, `met_numero_inyeccion_estandar`, `met_usu_crea`, `met_usu_actualiza`, `met_fecha_actualizacion`, `met_eliminado`, `met_causa_eliminacion`, `met_causa_actualizacion`, `met_tc_producto_terminado`, `met_tc_estabilidad`, `met_tc_materia_prima`, `met_tc_pureza`, `met_tc_disolucion`, `met_tc_uniformidad`, `met_mantenimiento`) VALUES
(1, 'Praziquantel', '15.0000', '15.0000', '0.0000', '30.0000', '0.0000', '4.0000', 5, 0, 0, 0, 0, 0, NULL, NULL, '2012-08-10 16:03:48', 1, 0, 0, 0, 0, 0, 0, 1, 1, '2013-05-08 11:35:13', 0, 'ENSAYO', '', '4.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', 0),
(2, 'Ivermectina', '15.0000', '15.0000', '0.0000', '30.0000', '0.0000', '10.0000', 5, 0, 0, 0, 0, 0, NULL, NULL, '2012-08-13 15:15:27', 1, 0, 0, 0, 0, 0, 0, 1, 1, '2012-10-01 09:21:57', 0, NULL, '', '10.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', 0),
(3, 'Ibuprofeno Limite Compuestos Relacionados C ', '15.0000', '15.0000', '0.0000', '30.0000', '0.0000', '13.0000', 2, 0, 0, 0, 0, 0, NULL, NULL, '2012-08-14 13:34:51', 1, 0, 0, 0, 0, 0, 0, 1, 1, '2012-08-14 13:34:51', 0, NULL, '', '13.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', 0),
(4, 'Albendazol', '15.0000', '15.0000', '0.0000', '30.0000', '0.0000', '9.0000', 5, 0, 0, 0, 0, 0, NULL, NULL, '2012-08-15 08:38:53', 1, 0, 0, 0, 0, 0, 0, 1, 1, '2012-08-15 08:38:53', 0, NULL, '', '9.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', 0),
(5, 'Albendazol EDOPetit Purga', '15.0000', '15.0000', '0.0000', '30.0000', '0.0000', '17.0000', 5, 0, 0, 0, 0, 0, NULL, NULL, '2012-08-15 08:40:18', 1, 0, 0, 0, 0, 0, 0, 1, 1, '2012-08-15 08:40:18', 0, NULL, '', '17.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', 0),
(6, 'ATP', '15.0000', '15.0000', '0.0000', '30.0000', '0.0000', '6.0000', 5, 0, 0, 0, 0, 0, NULL, NULL, '2012-08-15 08:42:06', 1, 0, 0, 0, 0, 0, 0, 1, 1, '2012-11-26 11:27:02', 0, NULL, '', '10.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', 0),
(7, 'Boldenona Undecilato', '15.0000', '15.0000', '0.0000', '30.0000', '0.0000', '9.0000', 5, 0, 0, 0, 0, 0, NULL, NULL, '2012-08-15 08:42:58', 1, 0, 0, 0, 0, 0, 0, 1, 1, '2012-08-15 08:42:58', 0, NULL, '', '9.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', 0),
(8, 'Dipirona Sódica', '15.0000', '15.0000', '0.0000', '30.0000', '0.0000', '8.0000', 5, 0, 0, 0, 0, 0, NULL, NULL, '2012-08-15 08:44:29', 1, 0, 0, 0, 0, 0, 0, 1, 1, '2012-08-15 08:44:29', 0, NULL, '', '8.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', 0),
(9, 'Doramectina', '15.0000', '15.0000', '0.0000', '30.0000', '0.0000', '6.0000', 5, 0, 0, 0, 0, 0, NULL, NULL, '2012-08-15 08:45:54', 1, 0, 0, 0, 0, 0, 0, 1, 1, '2012-08-15 08:45:54', 0, NULL, '', '7.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', 0),
(10, 'Enrofloxacino HCl', '15.0000', '15.0000', '0.0000', '30.0000', '0.0000', '11.0000', 5, 0, 0, 0, 0, 0, NULL, NULL, '2012-08-15 08:47:25', 1, 0, 0, 0, 0, 0, 0, 1, 1, '2012-11-13 10:50:15', 0, NULL, '', '11.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', 0),
(11, 'Fenbendazol', '15.0000', '15.0000', '0.0000', '30.0000', '0.0000', '6.0000', 5, 0, 0, 0, 0, 0, NULL, NULL, '2012-08-15 08:49:37', 1, 0, 0, 0, 0, 0, 0, 1, 1, '2012-08-15 08:49:37', 0, NULL, '', '6.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', 0),
(12, 'Fenilbutazona Sodica', '15.0000', '15.0000', '0.0000', '30.0000', '0.0000', '5.5000', 5, 0, 0, 0, 0, 0, NULL, NULL, '2012-08-15 08:50:39', 1, 0, 0, 0, 0, 0, 0, 1, 1, '2012-08-15 08:50:39', 0, NULL, '', '5.5000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', 0),
(13, 'Glucosamina Sulfato Derivatización', '30.0000', '30.0000', '0.0000', '60.0000', '0.0000', '18.0000', 5, 0, 0, 0, 0, 0, NULL, NULL, '2012-08-15 08:51:44', 1, 0, 0, 0, 0, 0, 0, 1, 1, '2012-08-15 08:51:56', 0, NULL, '', '18.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', 0),
(14, 'Oxitetraciclina HCl', '15.0000', '20.0000', '0.0000', '35.0000', '0.0000', '8.0000', 5, 0, 0, 0, 0, 0, NULL, NULL, '2012-08-15 08:54:07', 1, 0, 0, 0, 0, 0, 0, 1, 1, '2012-08-15 08:54:07', 0, NULL, '', '8.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', 0),
(15, 'Oxitetraciclina HCl EDOAntripan', '15.0000', '20.0000', '0.0000', '35.0000', '0.0000', '6.0000', 5, 0, 0, 0, 0, 0, NULL, NULL, '2012-08-15 08:55:18', 1, 0, 0, 0, 0, 0, 0, 1, 1, '2012-11-06 11:54:54', 0, NULL, '', '6.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', 0),
(16, 'Pamoato de Pirantel', '15.0000', '15.0000', '0.0000', '30.0000', '0.0000', '5.0000', 5, 0, 0, 0, 0, 0, NULL, NULL, '2012-08-15 08:56:26', 1, 0, 0, 0, 0, 0, 0, 1, 1, '2012-08-15 08:56:26', 0, NULL, '', '5.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', 0),
(17, 'Vitaminas Hidrosolubles Otros', '15.0000', '45.0000', '0.0000', '60.0000', '0.0000', '15.0000', 5, 0, 0, 0, 0, 0, NULL, NULL, '2012-08-15 11:27:25', 1, 0, 0, 0, 0, 0, 0, 1, 1, '2012-08-15 14:14:11', 0, NULL, '', '15.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', 0),
(18, 'Vitaminas Hidrosolubles EDOBonapel', '15.0000', '45.0000', '0.0000', '60.0000', '0.0000', '15.0000', 5, 0, 0, 0, 0, 0, NULL, NULL, '2012-08-15 11:28:59', 1, 0, 0, 0, 0, 0, 0, 1, 1, '2012-08-15 14:13:39', 0, NULL, '', '18.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', 0),
(19, 'Vitaminas Liposolubles D y E', '15.0000', '45.0000', '0.0000', '60.0000', '0.0000', '18.0000', 5, 0, 0, 0, 0, 0, NULL, NULL, '2012-08-15 11:32:32', 1, 0, 0, 0, 0, 0, 0, 1, 1, '2012-08-15 14:14:53', 0, NULL, '', '18.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', 0),
(20, 'Vitaminas Liposolubles D y E Farvical', '15.0000', '30.0000', '0.0000', '45.0000', '0.0000', '13.0000', 5, 0, 0, 0, 0, 0, NULL, NULL, '2012-08-15 11:33:18', 1, 0, 0, 0, 0, 0, 0, 1, 1, '2012-08-15 14:24:24', 0, NULL, '', '13.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', 0),
(21, 'Aminoacidos ', '15.0000', '135.0000', '0.0000', '150.0000', '0.0000', '45.0000', 5, 0, 0, 0, 0, 0, NULL, NULL, '2012-08-15 11:37:10', 1, 0, 0, 0, 0, 0, 0, 1, 1, '2012-08-15 14:21:00', 0, NULL, '', '45.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', 0),
(22, 'Aminoacidos (Taurina)', '15.0000', '20.0000', '0.0000', '35.0000', '0.0000', '7.0000', 5, 0, 0, 0, 0, 0, NULL, NULL, '2012-08-15 11:38:13', 1, 0, 0, 0, 0, 0, 0, 1, 1, '2012-08-15 14:22:48', 0, NULL, '', '7.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', 0),
(23, 'AcidosOrgánicos', '15.0000', '30.0000', '0.0000', '45.0000', '0.0000', '15.0000', 5, 0, 0, 0, 0, 0, NULL, NULL, '2012-08-15 14:29:08', 1, 0, 0, 0, 0, 0, 0, 1, 1, '2012-10-01 09:21:17', 0, NULL, '', '15.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', 0),
(24, 'Triclosan(Irgasan)', '15.0000', '40.0000', '0.0000', '55.0000', '0.0000', '20.0000', 5, 0, 0, 0, 0, 0, NULL, NULL, '2012-08-15 14:33:57', 1, 0, 0, 0, 0, 0, 0, 1, 1, '2012-08-15 14:33:57', 0, NULL, '', '20.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', 0),
(25, 'Trazas de Ivermectina', '30.0000', '0.0000', '0.0000', '30.0000', '0.0000', '10.0000', 1, 0, 0, 0, 0, 0, NULL, NULL, '2012-08-27 09:40:49', 1, 0, 0, 0, 0, 0, 0, 1, 1, '2012-08-27 09:40:49', 0, NULL, '', '10.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', 0),
(26, 'Fallo', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', 0, 0, 0, 0, 0, 0, NULL, NULL, '2012-08-29 15:09:37', 0, 0, 0, 0, 0, 0, 0, 1, 1, '2012-08-29 15:09:37', 0, NULL, '', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', 0),
(27, 'Impurezas Comunes ', '15.0000', '0.0000', '0.0000', '15.0000', '0.0000', '15.0000', 1, 0, 0, 0, 0, 0, NULL, NULL, '2012-12-11 15:09:28', 0, 0, 2, 0, 0, 0, 0, 1, 1, '2012-12-11 15:14:11', 0, NULL, '', '0.0000', '0.0000', '15.0000', '0.0000', '0.0000', '0.0000', 0),
(28, 'Trazas Boldenona Undecilato', '15.0000', '15.0000', '0.0000', '30.0000', '0.0000', '9.0000', 1, 0, 0, 0, 0, 0, NULL, NULL, '2013-01-28 17:29:05', 1, 0, 0, 0, 0, 0, 0, 1, 1, '2013-01-28 17:29:48', 0, NULL, '', '9.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', 0);

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