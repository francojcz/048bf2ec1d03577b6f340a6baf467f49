<?php


/**
 * This class defines the structure of the 'empresa' table.
 *
 *
 * This class was autogenerated by Propel 1.4.2 on:
 *
 * 08/28/13 23:31:17
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    lib.model.map
 */
class EmpresaTableMap extends TableMap {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.map.EmpresaTableMap';

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
		$this->setName('empresa');
		$this->setPhpName('Empresa');
		$this->setClassname('Empresa');
		$this->setPackage('lib.model');
		$this->setUseIdGenerator(true);
		// columns
		$this->addPrimaryKey('EMP_CODIGO', 'EmpCodigo', 'INTEGER', true, 11, null);
		$this->addColumn('EMP_NOMBRE', 'EmpNombre', 'VARCHAR', false, 200, null);
		$this->addColumn('EMP_LOGO_URL', 'EmpLogoUrl', 'VARCHAR', false, 200, null);
		$this->addColumn('EMP_NIT', 'EmpNit', 'VARCHAR', false, 200, null);
		$this->addColumn('EMP_FECHA_LIMITE_LICENCIA', 'EmpFechaLimiteLicencia', 'DATE', false, null, null);
		$this->addColumn('EMP_FECHA_INICIO_LICENCIA', 'EmpFechaInicioLicencia', 'DATE', false, null, null);
		$this->addColumn('EMP_INYECT_ESTANDAR_PROMEDIO', 'EmpInyectEstandarPromedio', 'INTEGER', false, 11, null);
		$this->addColumn('EMP_TIEMPO_ALERTA_CONSUMIBLE', 'EmpTiempoAlertaConsumible', 'INTEGER', false, 11, null);
		$this->addColumn('EMP_FECHA_REGISTRO_SISTEMA', 'EmpFechaRegistroSistema', 'TIMESTAMP', false, null, null);
		$this->addColumn('EMP_USU_CREA', 'EmpUsuCrea', 'INTEGER', false, 11, null);
		$this->addColumn('EMP_USU_ACTUALIZA', 'EmpUsuActualiza', 'INTEGER', false, 11, null);
		$this->addColumn('EMP_FECHA_ACTUALIZACION', 'EmpFechaActualizacion', 'TIMESTAMP', false, null, null);
		$this->addColumn('EMP_ELIMINADO', 'EmpEliminado', 'SMALLINT', false, 6, null);
		$this->addColumn('EMP_CAUSA_ELIMINACION', 'EmpCausaEliminacion', 'VARCHAR', false, 250, null);
		$this->addColumn('EMP_CAUSA_ACTUALIZACION', 'EmpCausaActualizacion', 'VARCHAR', false, 250, null);
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

} // EmpresaTableMap
