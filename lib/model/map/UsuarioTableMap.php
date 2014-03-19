<?php


/**
 * This class defines the structure of the 'usuario' table.
 *
 *
 * This class was autogenerated by Propel 1.4.2 on:
 *
 * 03/18/14 22:42:53
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    lib.model.map
 */
class UsuarioTableMap extends TableMap {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.map.UsuarioTableMap';

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
		$this->setName('usuario');
		$this->setPhpName('Usuario');
		$this->setClassname('Usuario');
		$this->setPackage('lib.model');
		$this->setUseIdGenerator(true);
		// columns
		$this->addPrimaryKey('USU_CODIGO', 'UsuCodigo', 'INTEGER', true, 11, null);
		$this->addColumn('USU_PER_CODIGO', 'UsuPerCodigo', 'INTEGER', false, 11, null);
		$this->addColumn('USU_LOGIN', 'UsuLogin', 'VARCHAR', false, 200, null);
		$this->addColumn('USU_PASSWORD', 'UsuPassword', 'VARCHAR', false, 200, null);
		$this->addColumn('USU_HABILITADO', 'UsuHabilitado', 'SMALLINT', false, 6, null);
		$this->addColumn('USU_FECHA_REGISTRO_SISTEMA', 'UsuFechaRegistroSistema', 'TIMESTAMP', false, null, null);
		$this->addColumn('USU_FECHA_ACTUALIZACION', 'UsuFechaActualizacion', 'TIMESTAMP', false, null, null);
		$this->addColumn('USU_CAUSA_ACTUALIZACION', 'UsuCausaActualizacion', 'VARCHAR', false, 250, null);
		$this->addColumn('USU_CREA', 'UsuCrea', 'VARCHAR', false, 20, null);
		$this->addColumn('USU_ACTUALIZA', 'UsuActualiza', 'VARCHAR', false, 20, null);
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

} // UsuarioTableMap
