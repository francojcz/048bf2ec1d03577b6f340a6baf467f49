<?php


/**
 * This class defines the structure of the 'evento_en_registro' table.
 *
 *
 * This class was autogenerated by Propel 1.4.2 on:
 *
 * 03/31/14 18:20:00
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    lib.model.map
 */
class EventoEnRegistroTableMap extends TableMap {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.map.EventoEnRegistroTableMap';

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
		$this->setName('evento_en_registro');
		$this->setPhpName('EventoEnRegistro');
		$this->setClassname('EventoEnRegistro');
		$this->setPackage('lib.model');
		$this->setUseIdGenerator(true);
		// columns
		$this->addPrimaryKey('EVRG_CODIGO', 'EvrgCodigo', 'INTEGER', true, 11, null);
		$this->addColumn('EVRG_RUM_CODIGO', 'EvrgRumCodigo', 'INTEGER', false, 11, null);
		$this->addColumn('EVRG_EVE_CODIGO', 'EvrgEveCodigo', 'INTEGER', false, 11, null);
		$this->addColumn('EVRG_OBSERVACIONES', 'EvrgObservaciones', 'VARCHAR', false, 200, null);
		$this->addColumn('EVRG_HORA_INICIO', 'EvrgHoraInicio', 'TIME', false, null, null);
		$this->addColumn('EVRG_HORA_FIN', 'EvrgHoraFin', 'TIME', false, null, null);
		$this->addColumn('EVRG_HORA_REGISTRO', 'EvrgHoraRegistro', 'TIME', false, null, null);
		$this->addColumn('EVRG_FECHA_REGISTRO_SISTEMA', 'EvrgFechaRegistroSistema', 'TIMESTAMP', false, null, null);
		$this->addColumn('EVRG_USU_CREA', 'EvrgUsuCrea', 'INTEGER', false, 11, null);
		$this->addColumn('EVRG_USU_ACTUALIZA', 'EvrgUsuActualiza', 'INTEGER', false, 11, null);
		$this->addColumn('EVRG_FECHA_ACTUALIZACION', 'EvrgFechaActualizacion', 'TIMESTAMP', false, null, null);
		$this->addColumn('EVRG_ELIMINADO', 'EvrgEliminado', 'SMALLINT', false, 6, null);
		$this->addColumn('EVRG_CAUSA_ELIMINACION', 'EvrgCausaEliminacion', 'VARCHAR', false, 250, null);
		$this->addColumn('EVRG_CAUSA_ACTUALIZACION', 'EvrgCausaActualizacion', 'VARCHAR', false, 250, null);
		$this->addColumn('EVRG_DURACION', 'EvrgDuracion', 'DECIMAL', false, 10, null);
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

} // EventoEnRegistroTableMap
