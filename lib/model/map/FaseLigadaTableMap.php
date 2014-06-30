<?php


/**
 * This class defines the structure of the 'fase_ligada' table.
 *
 *
 * This class was autogenerated by Propel 1.4.2 on:
 *
 * 06/29/14 02:06:09
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    lib.model.map
 */
class FaseLigadaTableMap extends TableMap {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.map.FaseLigadaTableMap';

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
		$this->setName('fase_ligada');
		$this->setPhpName('FaseLigada');
		$this->setClassname('FaseLigada');
		$this->setPackage('lib.model');
		$this->setUseIdGenerator(true);
		// columns
		$this->addPrimaryKey('FASE_CODIGO', 'FaseCodigo', 'INTEGER', true, 11, null);
		$this->addColumn('FASE_NOMBRE', 'FaseNombre', 'VARCHAR', false, 200, null);
		$this->addColumn('FASE_ELIMINADO', 'FaseEliminado', 'SMALLINT', false, 6, null);
		$this->addColumn('FASE_FECHA_REGISTRO_SISTEMA', 'FaseFechaRegistroSistema', 'TIMESTAMP', false, null, null);
		$this->addColumn('FASE_USU_CREA', 'FaseUsuCrea', 'INTEGER', false, 11, null);
		$this->addColumn('FASE_FECHA_ACTUALIZACION', 'FaseFechaActualizacion', 'TIMESTAMP', false, null, null);
		$this->addColumn('FASE_USU_ACTUALIZA', 'FaseUsuActualiza', 'INTEGER', false, 11, null);
		$this->addColumn('FASE_CAUSA_ELIMINACION', 'FaseCausaEliminacion', 'VARCHAR', false, 250, null);
		$this->addColumn('FASE_CAUSA_ACTUALIZACION', 'FaseCausaActualizacion', 'VARCHAR', false, 250, null);
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

} // FaseLigadaTableMap
