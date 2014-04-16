<?php


/**
 * This class defines the structure of the 'meta_anual_x_indicador' table.
 *
 *
 * This class was autogenerated by Propel 1.4.2 on:
 *
 * 04/15/14 20:44:21
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    lib.model.map
 */
class MetaAnualXIndicadorTableMap extends TableMap {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.map.MetaAnualXIndicadorTableMap';

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
		$this->setName('meta_anual_x_indicador');
		$this->setPhpName('MetaAnualXIndicador');
		$this->setClassname('MetaAnualXIndicador');
		$this->setPackage('lib.model');
		$this->setUseIdGenerator(false);
		// columns
		$this->addPrimaryKey('MEA_IND_CODIGO', 'MeaIndCodigo', 'INTEGER', true, 11, null);
		$this->addPrimaryKey('MEA_EMP_CODIGO', 'MeaEmpCodigo', 'INTEGER', true, 11, null);
		$this->addPrimaryKey('MEA_ANIO', 'MeaAnio', 'INTEGER', true, 11, null);
		$this->addColumn('MEA_VALOR', 'MeaValor', 'DECIMAL', false, 8, null);
		$this->addColumn('MEA_FECHA_REGISTRO_SISTEMA', 'MeaFechaRegistroSistema', 'TIMESTAMP', false, null, null);
		$this->addColumn('MEA_USU_CREA', 'MeaUsuCrea', 'INTEGER', false, 11, null);
		$this->addColumn('MEA_USU_ACTUALIZA', 'MeaUsuActualiza', 'INTEGER', false, 11, null);
		$this->addColumn('MEA_FECHA_ACTUALIZACION', 'MeaFechaActualizacion', 'TIMESTAMP', false, null, null);
		$this->addColumn('MEA_ELIMINADO', 'MeaEliminado', 'SMALLINT', false, 6, null);
		$this->addColumn('MEA_CAUSA_ELIMINACION', 'MeaCausaEliminacion', 'VARCHAR', false, 250, null);
		$this->addColumn('MEA_CAUSA_ACTUALIZACION', 'MeaCausaActualizacion', 'VARCHAR', false, 250, null);
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

} // MetaAnualXIndicadorTableMap
