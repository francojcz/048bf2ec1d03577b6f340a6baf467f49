<?php


/**
 * This class defines the structure of the 'registro_uso_maquina' table.
 *
 *
 * This class was autogenerated by Propel 1.4.2 on:
 *
 * 04/22/14 19:04:30
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    lib.model.map
 */
class RegistroUsoMaquinaTableMap extends TableMap {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.map.RegistroUsoMaquinaTableMap';

	/**
	 * Initialize the table attributes, columns and validators
	 * Relations are not initialized by this method since they are lazy loaded
	 *
	 * @return     void
	 * @throws     PropelException
	 */
	public function initialize()
	{
	  // attributes
		$this->setName('registro_uso_maquina');
		$this->setPhpName('RegistroUsoMaquina');
		$this->setClassname('RegistroUsoMaquina');
		$this->setPackage('lib.model');
		$this->setUseIdGenerator(true);
		// columns
		$this->addPrimaryKey('RUM_CODIGO', 'RumCodigo', 'INTEGER', true, 11, null);
		$this->addColumn('RUM_MAQ_CODIGO', 'RumMaqCodigo', 'INTEGER', false, 11, null);
		$this->addColumn('RUM_MET_CODIGO', 'RumMetCodigo', 'INTEGER', false, 11, null);
		$this->addColumn('RUM_USU_CODIGO', 'RumUsuCodigo', 'INTEGER', false, 11, null);
		$this->addColumn('RUM_USU_CODIGO_ELIMINO', 'RumUsuCodigoElimino', 'INTEGER', false, 11, null);
		$this->addColumn('RUM_HORA_INICIO_TRABAJO', 'RumHoraInicioTrabajo', 'TIME', false, null, null);
		$this->addColumn('RUM_HORA_FIN_TRABAJO', 'RumHoraFinTrabajo', 'TIME', false, null, null);
		$this->addColumn('RUM_TIEMPO_ENTRE_MODELO', 'RumTiempoEntreModelo', 'TIME', false, null, null);
		$this->addColumn('RUM_TIEMPO_CAMBIO_MODELO', 'RumTiempoCambioModelo', 'DECIMAL', false, 12, null);
		$this->addColumn('RUM_TIEMPO_CORRIDA_SISTEMA', 'RumTiempoCorridaSistema', 'DECIMAL', false, 12, null);
		$this->addColumn('RUM_TIEMPO_CORRIDA_CURVAS', 'RumTiempoCorridaCurvas', 'DECIMAL', false, 12, null);
		$this->addColumn('RUM_TIEMPO_CORRIDA_SISTEMA_EST', 'RumTiempoCorridaSistemaEst', 'DECIMAL', false, 12, null);
		$this->addColumn('RUM_TIEMPO_CORRIDA_CURVAS_ESTA', 'RumTiempoCorridaCurvasEsta', 'DECIMAL', false, 12, null);
		$this->addColumn('RUM_NUM_INYECCION_ESTANDAR_PER', 'RumNumInyeccionEstandarPer', 'DECIMAL', false, 12, null);
		$this->addColumn('RUM_NUMERO_INYECCION_ESTANDAR', 'RumNumeroInyeccionEstandar', 'DECIMAL', false, 12, null);
		$this->addColumn('RUM_TIEMPO_PREPARACION', 'RumTiempoPreparacion', 'DECIMAL', false, 12, null);
		$this->addColumn('RUM_TIEMPO_DURACION_CICLO', 'RumTiempoDuracionCiclo', 'TIME', false, null, null);
		$this->addColumn('RUM_NUMERO_CORRIDAS', 'RumNumeroCorridas', 'INTEGER', false, 11, null);
		$this->addColumn('RUM_NUMERO_INYECCION_ESTANDAR1', 'RumNumeroInyeccionEstandar1', 'DECIMAL', false, 12, null);
		$this->addColumn('RUM_NUMERO_INYECCION_ESTANDAR2', 'RumNumeroInyeccionEstandar2', 'DECIMAL', false, 12, null);
		$this->addColumn('RUM_NUMERO_INYECCION_ESTANDAR3', 'RumNumeroInyeccionEstandar3', 'DECIMAL', false, 12, null);
		$this->addColumn('RUM_NUMERO_INYECCION_ESTANDAR4', 'RumNumeroInyeccionEstandar4', 'DECIMAL', false, 12, null);
		$this->addColumn('RUM_NUMERO_INYECCION_ESTANDAR5', 'RumNumeroInyeccionEstandar5', 'DECIMAL', false, 12, null);
		$this->addColumn('RUM_NUMERO_INYECCION_ESTANDAR6', 'RumNumeroInyeccionEstandar6', 'DECIMAL', false, 12, null);
		$this->addColumn('RUM_NUMERO_INYECCION_ESTANDAR7', 'RumNumeroInyeccionEstandar7', 'DECIMAL', false, 12, null);
		$this->addColumn('RUM_NUMERO_INYECCION_ESTANDAR8', 'RumNumeroInyeccionEstandar8', 'DECIMAL', false, 12, null);
		$this->addColumn('RUM_NUM_INYECCION_ESTANDAR1_PE', 'RumNumInyeccionEstandar1Pe', 'DECIMAL', false, 12, null);
		$this->addColumn('RUM_NUM_INYECCION_ESTANDAR2_PE', 'RumNumInyeccionEstandar2Pe', 'DECIMAL', false, 12, null);
		$this->addColumn('RUM_NUM_INYECCION_ESTANDAR3_PE', 'RumNumInyeccionEstandar3Pe', 'DECIMAL', false, 12, null);
		$this->addColumn('RUM_NUM_INYECCION_ESTANDAR4_PE', 'RumNumInyeccionEstandar4Pe', 'DECIMAL', false, 12, null);
		$this->addColumn('RUM_NUM_INYECCION_ESTANDAR5_PE', 'RumNumInyeccionEstandar5Pe', 'DECIMAL', false, 12, null);
		$this->addColumn('RUM_NUM_INYECCION_ESTANDAR6_PE', 'RumNumInyeccionEstandar6Pe', 'DECIMAL', false, 12, null);
		$this->addColumn('RUM_NUM_INYECCION_ESTANDAR7_PE', 'RumNumInyeccionEstandar7Pe', 'DECIMAL', false, 12, null);
		$this->addColumn('RUM_NUM_INYECCION_ESTANDAR8_PE', 'RumNumInyeccionEstandar8Pe', 'DECIMAL', false, 12, null);
		$this->addColumn('RUM_NUM_MUESTRAS_PRODUCTO', 'RumNumMuestrasProducto', 'DECIMAL', false, 12, null);
		$this->addColumn('RUM_NUM_MUESTRAS_ESTABILIDAD', 'RumNumMuestrasEstabilidad', 'DECIMAL', false, 12, null);
		$this->addColumn('RUM_NUM_MUESTRAS_MATERIA_PRIMA', 'RumNumMuestrasMateriaPrima', 'DECIMAL', false, 12, null);
		$this->addColumn('RUM_NUM_MUESTRAS_PUREZA', 'RumNumMuestrasPureza', 'DECIMAL', false, 12, null);
		$this->addColumn('RUM_NUM_MUESTRAS_DISOLUCION', 'RumNumMuestrasDisolucion', 'DECIMAL', false, 12, null);
		$this->addColumn('RUM_NUM_MUESTRAS_UNIFORMIDAD', 'RumNumMuestrasUniformidad', 'DECIMAL', false, 12, null);
		$this->addColumn('RUM_NUM_MU_PRODUCTO_PERDIDA', 'RumNumMuProductoPerdida', 'DECIMAL', false, 12, null);
		$this->addColumn('RUM_NUM_MU_ESTABILIDAD_PERDIDA', 'RumNumMuEstabilidadPerdida', 'DECIMAL', false, 12, null);
		$this->addColumn('RUM_NUM_MU_MATERIA_PRIMA_PERDI', 'RumNumMuMateriaPrimaPerdi', 'DECIMAL', false, 12, null);
		$this->addColumn('RUM_NUM_MUESTRAS_PUREZA_PERDID', 'RumNumMuestrasPurezaPerdid', 'DECIMAL', false, 12, null);
		$this->addColumn('RUM_NUM_MUESTRAS_DISOLUCION_PE', 'RumNumMuestrasDisolucionPe', 'DECIMAL', false, 12, null);
		$this->addColumn('RUM_NUM_MUESTRAS_UNIFORMIDAD_P', 'RumNumMuestrasUniformidadP', 'DECIMAL', false, 12, null);
		$this->addColumn('RUM_NUM_INYEC_X_MUESTRA_ESTABI', 'RumNumInyecXMuestraEstabi', 'DECIMAL', false, 12, null);
		$this->addColumn('RUM_NUM_INYEC_X_MUESTRA_PRODUC', 'RumNumInyecXMuestraProduc', 'DECIMAL', false, 12, null);
		$this->addColumn('RUM_NUM_INYEC_X_MUESTRA_MATERI', 'RumNumInyecXMuestraMateri', 'DECIMAL', false, 12, null);
		$this->addColumn('RUM_NUM_INYEC_X_MUESTRA_PUREZA', 'RumNumInyecXMuestraPureza', 'DECIMAL', false, 12, null);
		$this->addColumn('RUM_NUM_INYEC_X_MUESTRA_DISOLU', 'RumNumInyecXMuestraDisolu', 'DECIMAL', false, 12, null);
		$this->addColumn('RUM_NUM_INYEC_X_MUESTRA_UNIFOR', 'RumNumInyecXMuestraUnifor', 'DECIMAL', false, 12, null);
		$this->addColumn('RUM_NUM_INYEC_X_MU_ESTABI_PERD', 'RumNumInyecXMuEstabiPerd', 'DECIMAL', false, 12, null);
		$this->addColumn('RUM_NUM_INYEC_X_MU_PRODUC_PERD', 'RumNumInyecXMuProducPerd', 'DECIMAL', false, 12, null);
		$this->addColumn('RUM_NUM_INYEC_X_MU_MATERI_PERD', 'RumNumInyecXMuMateriPerd', 'DECIMAL', false, 12, null);
		$this->addColumn('RUM_NUM_INYEC_X_MU_PUREZA_PERD', 'RumNumInyecXMuPurezaPerd', 'DECIMAL', false, 12, null);
		$this->addColumn('RUM_NUM_INYEC_X_MU_DISOLU_PERD', 'RumNumInyecXMuDisoluPerd', 'DECIMAL', false, 12, null);
		$this->addColumn('RUM_NUM_INYEC_X_MU_UNIFOR_PERD', 'RumNumInyecXMuUniforPerd', 'DECIMAL', false, 12, null);
		$this->addColumn('RUM_FALLAS', 'RumFallas', 'DECIMAL', false, 12, null);
		$this->addColumn('RUM_LOTE', 'RumLote', 'VARCHAR', false, 300, null);
		$this->addColumn('RUM_OBSERVACIONES', 'RumObservaciones', 'VARCHAR', false, 300, null);
		$this->addColumn('RUM_FECHA', 'RumFecha', 'DATE', false, null, null);
		$this->addColumn('RUM_FECHA_HORA_REG_SISTEMA', 'RumFechaHoraRegSistema', 'TIMESTAMP', false, null, null);
		$this->addColumn('RUM_CAUSA_ELIMINACION', 'RumCausaEliminacion', 'VARCHAR', false, 300, null);
		$this->addColumn('RUM_FECHA_HORA_ELIM_SISTEMA', 'RumFechaHoraElimSistema', 'TIMESTAMP', false, null, null);
		$this->addColumn('RUM_ELIMINADO', 'RumEliminado', 'TINYINT', false, 1, null);
		$this->addColumn('RUM_TC_PRODUCTO_TERMINADO', 'RumTcProductoTerminado', 'DECIMAL', false, 12, null);
		$this->addColumn('RUM_TC_ESTABILIDAD', 'RumTcEstabilidad', 'DECIMAL', false, 12, null);
		$this->addColumn('RUM_TC_MATERIA_PRIMA', 'RumTcMateriaPrima', 'DECIMAL', false, 12, null);
		$this->addColumn('RUM_TC_PUREZA', 'RumTcPureza', 'DECIMAL', false, 12, null);
		$this->addColumn('RUM_TC_DISOLUCION', 'RumTcDisolucion', 'DECIMAL', false, 12, null);
		$this->addColumn('RUM_TC_UNIFORMIDAD', 'RumTcUniformidad', 'DECIMAL', false, 12, null);
		$this->addColumn('RUM_TC_PRODUCTO_TERMINADO_ESTA', 'RumTcProductoTerminadoEsta', 'DECIMAL', false, 12, null);
		$this->addColumn('RUM_TC_ESTABILIDAD_ESTANDAR', 'RumTcEstabilidadEstandar', 'DECIMAL', false, 12, null);
		$this->addColumn('RUM_TC_MATERIA_PRIMA_ESTANDAR', 'RumTcMateriaPrimaEstandar', 'DECIMAL', false, 12, null);
		$this->addColumn('RUM_TC_PUREZA_ESTANDAR', 'RumTcPurezaEstandar', 'DECIMAL', false, 12, null);
		$this->addColumn('RUM_TC_DISOLUCION_ESTANDAR', 'RumTcDisolucionEstandar', 'DECIMAL', false, 12, null);
		$this->addColumn('RUM_TC_UNIFORMIDAD_ESTANDAR', 'RumTcUniformidadEstandar', 'DECIMAL', false, 12, null);
		$this->addColumn('RUM_COL_CODIGO', 'RumColCodigo', 'INTEGER', false, 11, null);
		$this->addColumn('RUM_ETA_CODIGO', 'RumEtaCodigo', 'INTEGER', false, 11, null);
		$this->addColumn('RUM_PLATOS_TEORICOS', 'RumPlatosTeoricos', 'DECIMAL', false, 12, null);
		$this->addColumn('RUM_TIEMPO_RETENCION', 'RumTiempoRetencion', 'DECIMAL', false, 12, null);
		$this->addColumn('RUM_RESOLUCION', 'RumResolucion', 'DECIMAL', false, 12, null);
		$this->addColumn('RUM_TAILING', 'RumTailing', 'DECIMAL', false, 12, null);
		$this->addColumn('RUM_PRESION', 'RumPresion', 'DECIMAL', false, 12, null);
		$this->addColumn('RUM_OBSERVACIONES_COL', 'RumObservacionesCol', 'VARCHAR', false, 300, null);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
	} // buildRelations()

	/**
	 * 
	 * Gets the list of behaviors registered for this table
	 * 
	 * @return array Associative array (name => parameters) of behaviors
	 */
	public function getBehaviors()
	{
		return array(
			'symfony' => array('form' => 'true', 'filter' => 'true', ),
			'symfony_behaviors' => array(),
		);
	} // getBehaviors()

} // RegistroUsoMaquinaTableMap
