<?php


/**
 * This class defines the structure of the 'empleado' table.
 *
 *
 * This class was autogenerated by Propel 1.4.2 on:
 *
 * 04/15/14 20:44:19
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    lib.model.map
 */
class EmpleadoTableMap extends TableMap {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.map.EmpleadoTableMap';

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
		$this->setName('empleado');
		$this->setPhpName('Empleado');
		$this->setClassname('Empleado');
		$this->setPackage('lib.model');
		$this->setUseIdGenerator(true);
		// columns
		$this->addPrimaryKey('EMPL_CODIGO', 'EmplCodigo', 'INTEGER', true, 11, null);
		$this->addColumn('EMPL_EMP_CODIGO', 'EmplEmpCodigo', 'INTEGER', false, 11, null);
		$this->addColumn('EMPL_TID_CODIGO', 'EmplTidCodigo', 'INTEGER', false, 11, null);
		$this->addColumn('EMPL_USU_CODIGO', 'EmplUsuCodigo', 'INTEGER', false, 11, null);
		$this->addColumn('EMPL_NOMBRES', 'EmplNombres', 'VARCHAR', false, 200, null);
		$this->addColumn('EMPL_APELLIDOS', 'EmplApellidos', 'VARCHAR', false, 200, null);
		$this->addColumn('EMPL_NUMERO_IDENTIFICACION', 'EmplNumeroIdentificacion', 'INTEGER', false, 11, null);
		$this->addColumn('EMPL_URL_FOTO', 'EmplUrlFoto', 'VARCHAR', false, 200, null);
		$this->addColumn('EMPL_FECHA_REGISTRO_SISTEMA', 'EmplFechaRegistroSistema', 'TIMESTAMP', false, null, null);
		$this->addColumn('EMPL_USU_CREA', 'EmplUsuCrea', 'INTEGER', false, 11, null);
		$this->addColumn('EMPL_USU_ACTUALIZA', 'EmplUsuActualiza', 'INTEGER', false, 11, null);
		$this->addColumn('EMPL_FECHA_ACTUALIZACION', 'EmplFechaActualizacion', 'TIMESTAMP', false, null, null);
		$this->addColumn('EMPL_ELIMINADO', 'EmplEliminado', 'SMALLINT', false, 6, null);
		$this->addColumn('EMPL_CAUSA_ELIMINACION', 'EmplCausaEliminacion', 'VARCHAR', false, 250, null);
		$this->addColumn('EMPL_CAUSA_ACTUALIZACION', 'EmplCausaActualizacion', 'VARCHAR', false, 250, null);
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

} // EmpleadoTableMap
