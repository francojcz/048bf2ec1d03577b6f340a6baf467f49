<?php


/**
 * This class defines the structure of the 'estado' table.
 *
 *
 * This class was autogenerated by Propel 1.4.2 on:
 *
 * 03/27/14 18:46:48
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    lib.model.map
 */
class EstadoTableMap extends TableMap {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.map.EstadoTableMap';

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
		$this->setName('estado');
		$this->setPhpName('Estado');
		$this->setClassname('Estado');
		$this->setPackage('lib.model');
		$this->setUseIdGenerator(true);
		// columns
		$this->addPrimaryKey('EST_CODIGO', 'EstCodigo', 'INTEGER', true, 11, null);
		$this->addColumn('EST_NOMBRE', 'EstNombre', 'VARCHAR', false, 200, null);
		$this->addColumn('EST_FECHA_REGISTRO_SISTEMA', 'EstFechaRegistroSistema', 'TIMESTAMP', false, null, null);
		$this->addColumn('EST_USU_CREA', 'EstUsuCrea', 'INTEGER', false, 11, null);
		$this->addColumn('EST_USU_ACTUALIZA', 'EstUsuActualiza', 'INTEGER', false, 11, null);
		$this->addColumn('EST_FECHA_ACTUALIZACION', 'EstFechaActualizacion', 'TIMESTAMP', false, null, null);
		$this->addColumn('EST_ELIMINADO', 'EstEliminado', 'SMALLINT', false, 6, null);
		$this->addColumn('EST_CAUSA_ELIMINACION', 'EstCausaEliminacion', 'VARCHAR', false, 250, null);
		$this->addColumn('EST_CAUSA_ACTUALIZACION', 'EstCausaActualizacion', 'VARCHAR', false, 250, null);
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

} // EstadoTableMap
