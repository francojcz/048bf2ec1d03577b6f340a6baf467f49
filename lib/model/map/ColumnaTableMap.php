<?php


/**
 * This class defines the structure of the 'columna' table.
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
class ColumnaTableMap extends TableMap {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.map.ColumnaTableMap';

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
		$this->setName('columna');
		$this->setPhpName('Columna');
		$this->setClassname('Columna');
		$this->setPackage('lib.model');
		$this->setUseIdGenerator(true);
		// columns
		$this->addPrimaryKey('COL_CODIGO', 'ColCodigo', 'INTEGER', true, 11, null);
		$this->addColumn('COL_CODIGO_INTERNO', 'ColCodigoInterno', 'INTEGER', false, 11, null);
		$this->addColumn('COL_LOTE', 'ColLote', 'VARCHAR', false, 100, null);
		$this->addColumn('COL_ELIMINADO', 'ColEliminado', 'SMALLINT', false, 6, null);
		$this->addColumn('COL_FECHA_REGISTRO_SISTEMA', 'ColFechaRegistroSistema', 'TIMESTAMP', false, null, null);
		$this->addColumn('COL_USU_CREA', 'ColUsuCrea', 'INTEGER', false, 11, null);
		$this->addColumn('COL_FECHA_ACTUALIZACION', 'ColFechaActualizacion', 'TIMESTAMP', false, null, null);
		$this->addColumn('COL_USU_ACTUALIZA', 'ColUsuActualiza', 'INTEGER', false, 11, null);
		$this->addColumn('COL_CAUSA_ELIMINACION', 'ColCausaEliminacion', 'VARCHAR', false, 250, null);
		$this->addColumn('COL_CAUSA_ACTUALIZACION', 'ColCausaActualizacion', 'VARCHAR', false, 250, null);
		$this->addColumn('COL_MAR_CODIGO', 'ColMarCodigo', 'INTEGER', false, 11, null);
		$this->addColumn('COL_MOD_CODIGO', 'ColModCodigo', 'INTEGER', false, 11, null);
		$this->addColumn('COL_FASE_CODIGO', 'ColFaseCodigo', 'INTEGER', false, 11, null);
		$this->addColumn('COL_DIM_CODIGO', 'ColDimCodigo', 'INTEGER', false, 11, null);
		$this->addColumn('COL_TAM_CODIGO', 'ColTamCodigo', 'INTEGER', false, 11, null);
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

} // ColumnaTableMap
