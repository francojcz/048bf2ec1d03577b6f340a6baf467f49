<?php


/**
 * This class defines the structure of the 'consumible_maquina' table.
 *
 *
 * This class was autogenerated by Propel 1.4.2 on:
 *
 * 06/10/14 14:56:06
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    lib.model.map
 */
class ConsumibleMaquinaTableMap extends TableMap {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.map.ConsumibleMaquinaTableMap';

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
		$this->setName('consumible_maquina');
		$this->setPhpName('ConsumibleMaquina');
		$this->setClassname('ConsumibleMaquina');
		$this->setPackage('lib.model');
		$this->setUseIdGenerator(true);
		// columns
		$this->addPrimaryKey('COM_CODIGO', 'ComCodigo', 'INTEGER', true, 11, null);
		$this->addForeignKey('COM_MAQ_CODIGO', 'ComMaqCodigo', 'INTEGER', 'maquina', 'MAQ_CODIGO', false, 11, null);
		$this->addColumn('COM_FECHA_CAMBIO', 'ComFechaCambio', 'TIMESTAMP', false, null, null);
		$this->addColumn('COM_ITEM', 'ComItem', 'VARCHAR', false, 200, null);
		$this->addColumn('COM_NUMERO_PARTE', 'ComNumeroParte', 'VARCHAR', false, 200, null);
		$this->addColumn('COM_PERIODICIDAD', 'ComPeriodicidad', 'INTEGER', false, 11, null);
		$this->addColumn('COM_PROXIMO_MANTENIMIENTO', 'ComProximoMantenimiento', 'TIMESTAMP', false, null, null);
		$this->addColumn('COM_FECHA_REGISTRO_SISTEMA', 'ComFechaRegistroSistema', 'TIMESTAMP', false, null, null);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
    $this->addRelation('Maquina', 'Maquina', RelationMap::MANY_TO_ONE, array('com_maq_codigo' => 'maq_codigo', ), 'RESTRICT', 'RESTRICT');
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

} // ConsumibleMaquinaTableMap
