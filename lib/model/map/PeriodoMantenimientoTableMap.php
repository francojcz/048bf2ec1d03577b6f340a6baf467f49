<?php


/**
 * This class defines the structure of the 'periodo_mantenimiento' table.
 *
 *
 * This class was autogenerated by Propel 1.4.2 on:
 *
 * 03/27/14 21:28:47
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    lib.model.map
 */
class PeriodoMantenimientoTableMap extends TableMap {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.map.PeriodoMantenimientoTableMap';

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
		$this->setName('periodo_mantenimiento');
		$this->setPhpName('PeriodoMantenimiento');
		$this->setClassname('PeriodoMantenimiento');
		$this->setPackage('lib.model');
		$this->setUseIdGenerator(true);
		// columns
		$this->addPrimaryKey('PMTO_CODIGO', 'PmtoCodigo', 'INTEGER', true, 11, null);
		$this->addColumn('PMTO_PERIODO', 'PmtoPeriodo', 'INTEGER', false, 11, null);
		$this->addColumn('PMTO_TIPO', 'PmtoTipo', 'INTEGER', false, 11, null);
		$this->addColumn('PMTO_FECHA_REGISTRO_SISTEMA', 'PmtoFechaRegistroSistema', 'TIMESTAMP', false, null, null);
		$this->addColumn('PMTO_USU_CREA', 'PmtoUsuCrea', 'INTEGER', false, 11, null);
		$this->addColumn('PMTO_USU_ACTUALIZA', 'PmtoUsuActualiza', 'INTEGER', false, 11, null);
		$this->addColumn('PMTO_FECHA_ACTUALIZACION', 'PmtoFechaActualizacion', 'TIMESTAMP', false, null, null);
		$this->addColumn('PMTO_ELIMINADO', 'PmtoEliminado', 'SMALLINT', false, 6, null);
		$this->addColumn('PMTO_CAUSA_ELIMINACION', 'PmtoCausaEliminacion', 'VARCHAR', false, 250, null);
		$this->addColumn('PMTO_CAUSA_ACTUALIZACION', 'PmtoCausaActualizacion', 'VARCHAR', false, 250, null);
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

} // PeriodoMantenimientoTableMap