<?php


/**
 * This class defines the structure of the 'indicador' table.
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
class IndicadorTableMap extends TableMap {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.map.IndicadorTableMap';

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
		$this->setName('indicador');
		$this->setPhpName('Indicador');
		$this->setClassname('Indicador');
		$this->setPackage('lib.model');
		$this->setUseIdGenerator(true);
		// columns
		$this->addPrimaryKey('IND_CODIGO', 'IndCodigo', 'INTEGER', true, 11, null);
		$this->addColumn('IND_SIGLA', 'IndSigla', 'VARCHAR', false, 30, null);
		$this->addColumn('IND_NOMBRE', 'IndNombre', 'VARCHAR', false, 200, null);
		$this->addColumn('IND_FECHA_REGISTRO_SISTEMA', 'IndFechaRegistroSistema', 'TIMESTAMP', false, null, null);
		$this->addColumn('IND_UNIDAD', 'IndUnidad', 'VARCHAR', false, 20, null);
		$this->addColumn('IND_USU_CREA', 'IndUsuCrea', 'INTEGER', false, 11, null);
		$this->addColumn('IND_USU_ACTUALIZA', 'IndUsuActualiza', 'INTEGER', false, 11, null);
		$this->addColumn('IND_FECHA_ACTUALIZACION', 'IndFechaActualizacion', 'TIMESTAMP', false, null, null);
		$this->addColumn('IND_ELIMINADO', 'IndEliminado', 'SMALLINT', false, 6, null);
		$this->addColumn('IND_CAUSA_ELIMINACION', 'IndCausaEliminacion', 'VARCHAR', false, 250, null);
		$this->addColumn('IND_CAUSA_ACTUALIZACION', 'IndCausaActualizacion', 'VARCHAR', false, 250, null);
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

} // IndicadorTableMap
