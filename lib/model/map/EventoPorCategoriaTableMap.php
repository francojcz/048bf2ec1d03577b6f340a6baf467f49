<?php


/**
 * This class defines the structure of the 'evento_por_categoria' table.
 *
 *
 * This class was autogenerated by Propel 1.4.2 on:
 *
 * 04/02/14 16:58:35
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    lib.model.map
 */
class EventoPorCategoriaTableMap extends TableMap {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.map.EventoPorCategoriaTableMap';

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
		$this->setName('evento_por_categoria');
		$this->setPhpName('EventoPorCategoria');
		$this->setClassname('EventoPorCategoria');
		$this->setPackage('lib.model');
		$this->setUseIdGenerator(false);
		// columns
		$this->addPrimaryKey('EVCA_CAT_CODIGO', 'EvcaCatCodigo', 'INTEGER', true, 11, null);
		$this->addPrimaryKey('EVCA_EVE_CODIGO', 'EvcaEveCodigo', 'INTEGER', true, 11, null);
		$this->addColumn('EVCA_USU_CREA', 'EvcaUsuCrea', 'INTEGER', false, 11, null);
		$this->addColumn('EVCA_FECHA_REGISTRO_SISTEMA', 'EvcaFechaRegistroSistema', 'TIMESTAMP', false, null, null);
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

} // EventoPorCategoriaTableMap
