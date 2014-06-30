<?php


/**
 * This class defines the structure of the 'grupo_por_equipo' table.
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
class GrupoPorEquipoTableMap extends TableMap {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.map.GrupoPorEquipoTableMap';

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
		$this->setName('grupo_por_equipo');
		$this->setPhpName('GrupoPorEquipo');
		$this->setClassname('GrupoPorEquipo');
		$this->setPackage('lib.model');
		$this->setUseIdGenerator(false);
		// columns
		$this->addPrimaryKey('GREQ_GRU_CODIGO', 'GreqGruCodigo', 'INTEGER', true, 11, null);
		$this->addPrimaryKey('GREQ_MAQ_CODIGO', 'GreqMaqCodigo', 'INTEGER', true, 11, null);
		$this->addColumn('GREQ_USU_CREA', 'GreqUsuCrea', 'INTEGER', false, 11, null);
		$this->addColumn('GREQ_FECHA_REGISTRO_SISTEMA', 'GreqFechaRegistroSistema', 'TIMESTAMP', false, null, null);
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

} // GrupoPorEquipoTableMap
