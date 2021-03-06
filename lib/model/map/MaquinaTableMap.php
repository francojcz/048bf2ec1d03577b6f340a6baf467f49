<?php


/**
 * This class defines the structure of the 'maquina' table.
 *
 *
 * This class was autogenerated by Propel 1.4.2 on:
 *
 * 06/29/14 02:06:10
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    lib.model.map
 */
class MaquinaTableMap extends TableMap {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.map.MaquinaTableMap';

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
		$this->setName('maquina');
		$this->setPhpName('Maquina');
		$this->setClassname('Maquina');
		$this->setPackage('lib.model');
		$this->setUseIdGenerator(true);
		// columns
		$this->addPrimaryKey('MAQ_CODIGO', 'MaqCodigo', 'INTEGER', true, 11, null);
		$this->addColumn('MAQ_EST_CODIGO', 'MaqEstCodigo', 'INTEGER', false, 11, null);
		$this->addColumn('MAQ_COM_CERTIFICADO', 'MaqComCertificado', 'VARCHAR', false, 40, null);
		$this->addColumn('MAQ_NOMBRE', 'MaqNombre', 'VARCHAR', false, 200, null);
		$this->addColumn('MAQ_MARCA', 'MaqMarca', 'VARCHAR', false, 200, null);
		$this->addColumn('MAQ_MODELO', 'MaqModelo', 'VARCHAR', false, 200, null);
		$this->addColumn('MAQ_FECHA_ADQUISICION', 'MaqFechaAdquisicion', 'DATE', false, null, null);
		$this->addColumn('MAQ_FOTO_URL', 'MaqFotoUrl', 'VARCHAR', false, 200, null);
		$this->addColumn('MAQ_TIEMPO_INYECCION', 'MaqTiempoInyeccion', 'DECIMAL', false, 8, null);
		$this->addColumn('MAQ_FECHA_REGISTRO_SISTEMA', 'MaqFechaRegistroSistema', 'TIMESTAMP', false, null, null);
		$this->addColumn('MAQ_CODIGO_INVENTARIO', 'MaqCodigoInventario', 'VARCHAR', false, 20, null);
		$this->addColumn('MAQ_USU_CREA', 'MaqUsuCrea', 'INTEGER', false, 11, null);
		$this->addColumn('MAQ_USU_ACTUALIZA', 'MaqUsuActualiza', 'INTEGER', false, 11, null);
		$this->addColumn('MAQ_FECHA_ACTUALIZACION', 'MaqFechaActualizacion', 'TIMESTAMP', false, null, null);
		$this->addColumn('MAQ_ELIMINADO', 'MaqEliminado', 'SMALLINT', false, 6, null);
		$this->addColumn('MAQ_CAUSA_ELIMINACION', 'MaqCausaEliminacion', 'VARCHAR', false, 250, null);
		$this->addColumn('MAQ_CAUSA_ACTUALIZACION', 'MaqCausaActualizacion', 'VARCHAR', false, 250, null);
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

} // MaquinaTableMap
