<?php


/**
 * This class defines the structure of the 'marca' table.
 *
 *
 * This class was autogenerated by Propel 1.4.2 on:
 *
 * 03/27/14 21:28:46
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    lib.model.map
 */
class MarcaTableMap extends TableMap {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.map.MarcaTableMap';

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
		$this->setName('marca');
		$this->setPhpName('Marca');
		$this->setClassname('Marca');
		$this->setPackage('lib.model');
		$this->setUseIdGenerator(true);
		// columns
		$this->addPrimaryKey('MAR_CODIGO', 'MarCodigo', 'INTEGER', true, 11, null);
		$this->addColumn('MAR_NOMBRE', 'MarNombre', 'VARCHAR', false, 200, null);
		$this->addColumn('MAR_FECHA_REGISTRO_SISTEMA', 'MarFechaRegistroSistema', 'TIMESTAMP', false, null, null);
		$this->addColumn('MAR_USU_CREA', 'MarUsuCrea', 'INTEGER', false, 11, null);
		$this->addColumn('MAR_USU_ACTUALIZA', 'MarUsuActualiza', 'INTEGER', false, 11, null);
		$this->addColumn('MAR_FECHA_ACTUALIZACION', 'MarFechaActualizacion', 'TIMESTAMP', false, null, null);
		$this->addColumn('MAR_ELIMINADO', 'MarEliminado', 'SMALLINT', false, 6, null);
		$this->addColumn('MAR_CAUSA_ELIMINACION', 'MarCausaEliminacion', 'VARCHAR', false, 250, null);
		$this->addColumn('MAR_CAUSA_ACTUALIZACION', 'MarCausaActualizacion', 'VARCHAR', false, 250, null);
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

} // MarcaTableMap
