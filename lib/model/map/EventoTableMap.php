<?php


/**
 * This class defines the structure of the 'evento' table.
 *
 *
 * This class was autogenerated by Propel 1.4.2 on:
 *
 * 07/18/13 22:30:35
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    lib.model.map
 */
class EventoTableMap extends TableMap {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.map.EventoTableMap';

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
		$this->setName('evento');
		$this->setPhpName('Evento');
		$this->setClassname('Evento');
		$this->setPackage('lib.model');
		$this->setUseIdGenerator(true);
		// columns
		$this->addPrimaryKey('EVE_CODIGO', 'EveCodigo', 'INTEGER', true, 11, null);
		$this->addColumn('EVE_NOMBRE', 'EveNombre', 'VARCHAR', true, 200, null);
		$this->addColumn('EVE_FECHA_REGISTRO_SISTEMA', 'EveFechaRegistroSistema', 'TIMESTAMP', false, null, null);
		$this->addForeignKey('EVE_USU_CREA', 'EveUsuCrea', 'INTEGER', 'usuario', 'USU_CODIGO', false, 11, null);
		$this->addForeignKey('EVE_USU_ACTUALIZA', 'EveUsuActualiza', 'INTEGER', 'usuario', 'USU_CODIGO', false, 11, null);
		$this->addColumn('EVE_FECHA_ACTUALIZACION', 'EveFechaActualizacion', 'TIMESTAMP', false, null, null);
		$this->addColumn('EVE_ELIMINADO', 'EveEliminado', 'SMALLINT', false, 6, null);
		$this->addColumn('EVE_CAUSA_ELIMINACION', 'EveCausaEliminacion', 'VARCHAR', false, 250, null);
		$this->addColumn('EVE_CAUSA_ACTUALIZACION', 'EveCausaActualizacion', 'VARCHAR', false, 250, null);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
    $this->addRelation('UsuarioRelatedByEveUsuCrea', 'Usuario', RelationMap::MANY_TO_ONE, array('eve_usu_crea' => 'usu_codigo', ), 'RESTRICT', 'RESTRICT');
    $this->addRelation('UsuarioRelatedByEveUsuActualiza', 'Usuario', RelationMap::MANY_TO_ONE, array('eve_usu_actualiza' => 'usu_codigo', ), 'RESTRICT', 'RESTRICT');
    $this->addRelation('EventoEnRegistro', 'EventoEnRegistro', RelationMap::ONE_TO_MANY, array('eve_codigo' => 'evrg_eve_codigo', ), 'RESTRICT', 'RESTRICT');
    $this->addRelation('EventoPorCategoria', 'EventoPorCategoria', RelationMap::ONE_TO_MANY, array('eve_codigo' => 'evca_eve_codigo', ), 'RESTRICT', 'RESTRICT');
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

} // EventoTableMap
