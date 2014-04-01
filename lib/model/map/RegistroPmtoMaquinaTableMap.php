<?php


/**
 * This class defines the structure of the 'registro_pmto_maquina' table.
 *
 *
 * This class was autogenerated by Propel 1.4.2 on:
 *
 * 04/01/14 01:57:53
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    lib.model.map
 */
class RegistroPmtoMaquinaTableMap extends TableMap {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.map.RegistroPmtoMaquinaTableMap';

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
		$this->setName('registro_pmto_maquina');
		$this->setPhpName('RegistroPmtoMaquina');
		$this->setClassname('RegistroPmtoMaquina');
		$this->setPackage('lib.model');
		$this->setUseIdGenerator(true);
		// columns
		$this->addPrimaryKey('RPM_CODIGO', 'RpmCodigo', 'INTEGER', true, 11, null);
		$this->addColumn('RPM_MAQ_CODIGO', 'RpmMaqCodigo', 'INTEGER', false, 11, null);
		$this->addColumn('RPM_PMTO_CODIGO', 'RpmPmtoCodigo', 'INTEGER', false, 11, null);
		$this->addColumn('RPM_FECHA_INICIO', 'RpmFechaInicio', 'DATE', false, null, null);
		$this->addColumn('RPM_USU_REGISTRA', 'RpmUsuRegistra', 'INTEGER', false, 11, null);
		$this->addColumn('RPM_FECHA_REGISTRO', 'RpmFechaRegistro', 'DATE', false, null, null);
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

} // RegistroPmtoMaquinaTableMap
