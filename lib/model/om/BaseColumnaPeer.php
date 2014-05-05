<?php

/**
 * Base static class for performing query and update operations on the 'columna' table.
 *
 * 
 *
 * This class was autogenerated by Propel 1.4.2 on:
 *
 * 05/05/14 21:39:42
 *
 * @package    lib.model.om
 */
abstract class BaseColumnaPeer {

	/** the default database name for this class */
	const DATABASE_NAME = 'propel';

	/** the table name for this class */
	const TABLE_NAME = 'columna';

	/** the related Propel class for this table */
	const OM_CLASS = 'Columna';

	/** A class that can be returned by this peer. */
	const CLASS_DEFAULT = 'lib.model.Columna';

	/** the related TableMap class for this table */
	const TM_CLASS = 'ColumnaTableMap';
	
	/** The total number of columns. */
	const NUM_COLUMNS = 15;

	/** The number of lazy-loaded columns. */
	const NUM_LAZY_LOAD_COLUMNS = 0;

	/** the column name for the COL_CODIGO field */
	const COL_CODIGO = 'columna.COL_CODIGO';

	/** the column name for the COL_CODIGO_INTERNO field */
	const COL_CODIGO_INTERNO = 'columna.COL_CODIGO_INTERNO';

	/** the column name for the COL_LOTE field */
	const COL_LOTE = 'columna.COL_LOTE';

	/** the column name for the COL_ELIMINADO field */
	const COL_ELIMINADO = 'columna.COL_ELIMINADO';

	/** the column name for the COL_FECHA_REGISTRO_SISTEMA field */
	const COL_FECHA_REGISTRO_SISTEMA = 'columna.COL_FECHA_REGISTRO_SISTEMA';

	/** the column name for the COL_USU_CREA field */
	const COL_USU_CREA = 'columna.COL_USU_CREA';

	/** the column name for the COL_FECHA_ACTUALIZACION field */
	const COL_FECHA_ACTUALIZACION = 'columna.COL_FECHA_ACTUALIZACION';

	/** the column name for the COL_USU_ACTUALIZA field */
	const COL_USU_ACTUALIZA = 'columna.COL_USU_ACTUALIZA';

	/** the column name for the COL_CAUSA_ELIMINACION field */
	const COL_CAUSA_ELIMINACION = 'columna.COL_CAUSA_ELIMINACION';

	/** the column name for the COL_CAUSA_ACTUALIZACION field */
	const COL_CAUSA_ACTUALIZACION = 'columna.COL_CAUSA_ACTUALIZACION';

	/** the column name for the COL_MAR_CODIGO field */
	const COL_MAR_CODIGO = 'columna.COL_MAR_CODIGO';

	/** the column name for the COL_MOD_CODIGO field */
	const COL_MOD_CODIGO = 'columna.COL_MOD_CODIGO';

	/** the column name for the COL_FASE_CODIGO field */
	const COL_FASE_CODIGO = 'columna.COL_FASE_CODIGO';

	/** the column name for the COL_DIM_CODIGO field */
	const COL_DIM_CODIGO = 'columna.COL_DIM_CODIGO';

	/** the column name for the COL_TAM_CODIGO field */
	const COL_TAM_CODIGO = 'columna.COL_TAM_CODIGO';

	/**
	 * An identiy map to hold any loaded instances of Columna objects.
	 * This must be public so that other peer classes can access this when hydrating from JOIN
	 * queries.
	 * @var        array Columna[]
	 */
	public static $instances = array();


	// symfony behavior
	
	/**
	 * Indicates whether the current model includes I18N.
	 */
	const IS_I18N = false;

	/**
	 * holds an array of fieldnames
	 *
	 * first dimension keys are the type constants
	 * e.g. self::$fieldNames[self::TYPE_PHPNAME][0] = 'Id'
	 */
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('ColCodigo', 'ColCodigoInterno', 'ColLote', 'ColEliminado', 'ColFechaRegistroSistema', 'ColUsuCrea', 'ColFechaActualizacion', 'ColUsuActualiza', 'ColCausaEliminacion', 'ColCausaActualizacion', 'ColMarCodigo', 'ColModCodigo', 'ColFaseCodigo', 'ColDimCodigo', 'ColTamCodigo', ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('colCodigo', 'colCodigoInterno', 'colLote', 'colEliminado', 'colFechaRegistroSistema', 'colUsuCrea', 'colFechaActualizacion', 'colUsuActualiza', 'colCausaEliminacion', 'colCausaActualizacion', 'colMarCodigo', 'colModCodigo', 'colFaseCodigo', 'colDimCodigo', 'colTamCodigo', ),
		BasePeer::TYPE_COLNAME => array (self::COL_CODIGO, self::COL_CODIGO_INTERNO, self::COL_LOTE, self::COL_ELIMINADO, self::COL_FECHA_REGISTRO_SISTEMA, self::COL_USU_CREA, self::COL_FECHA_ACTUALIZACION, self::COL_USU_ACTUALIZA, self::COL_CAUSA_ELIMINACION, self::COL_CAUSA_ACTUALIZACION, self::COL_MAR_CODIGO, self::COL_MOD_CODIGO, self::COL_FASE_CODIGO, self::COL_DIM_CODIGO, self::COL_TAM_CODIGO, ),
		BasePeer::TYPE_FIELDNAME => array ('col_codigo', 'col_codigo_interno', 'col_lote', 'col_eliminado', 'col_fecha_registro_sistema', 'col_usu_crea', 'col_fecha_actualizacion', 'col_usu_actualiza', 'col_causa_eliminacion', 'col_causa_actualizacion', 'col_mar_codigo', 'col_mod_codigo', 'col_fase_codigo', 'col_dim_codigo', 'col_tam_codigo', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, )
	);

	/**
	 * holds an array of keys for quick access to the fieldnames array
	 *
	 * first dimension keys are the type constants
	 * e.g. self::$fieldNames[BasePeer::TYPE_PHPNAME]['Id'] = 0
	 */
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('ColCodigo' => 0, 'ColCodigoInterno' => 1, 'ColLote' => 2, 'ColEliminado' => 3, 'ColFechaRegistroSistema' => 4, 'ColUsuCrea' => 5, 'ColFechaActualizacion' => 6, 'ColUsuActualiza' => 7, 'ColCausaEliminacion' => 8, 'ColCausaActualizacion' => 9, 'ColMarCodigo' => 10, 'ColModCodigo' => 11, 'ColFaseCodigo' => 12, 'ColDimCodigo' => 13, 'ColTamCodigo' => 14, ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('colCodigo' => 0, 'colCodigoInterno' => 1, 'colLote' => 2, 'colEliminado' => 3, 'colFechaRegistroSistema' => 4, 'colUsuCrea' => 5, 'colFechaActualizacion' => 6, 'colUsuActualiza' => 7, 'colCausaEliminacion' => 8, 'colCausaActualizacion' => 9, 'colMarCodigo' => 10, 'colModCodigo' => 11, 'colFaseCodigo' => 12, 'colDimCodigo' => 13, 'colTamCodigo' => 14, ),
		BasePeer::TYPE_COLNAME => array (self::COL_CODIGO => 0, self::COL_CODIGO_INTERNO => 1, self::COL_LOTE => 2, self::COL_ELIMINADO => 3, self::COL_FECHA_REGISTRO_SISTEMA => 4, self::COL_USU_CREA => 5, self::COL_FECHA_ACTUALIZACION => 6, self::COL_USU_ACTUALIZA => 7, self::COL_CAUSA_ELIMINACION => 8, self::COL_CAUSA_ACTUALIZACION => 9, self::COL_MAR_CODIGO => 10, self::COL_MOD_CODIGO => 11, self::COL_FASE_CODIGO => 12, self::COL_DIM_CODIGO => 13, self::COL_TAM_CODIGO => 14, ),
		BasePeer::TYPE_FIELDNAME => array ('col_codigo' => 0, 'col_codigo_interno' => 1, 'col_lote' => 2, 'col_eliminado' => 3, 'col_fecha_registro_sistema' => 4, 'col_usu_crea' => 5, 'col_fecha_actualizacion' => 6, 'col_usu_actualiza' => 7, 'col_causa_eliminacion' => 8, 'col_causa_actualizacion' => 9, 'col_mar_codigo' => 10, 'col_mod_codigo' => 11, 'col_fase_codigo' => 12, 'col_dim_codigo' => 13, 'col_tam_codigo' => 14, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, )
	);

	/**
	 * Translates a fieldname to another type
	 *
	 * @param      string $name field name
	 * @param      string $fromType One of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
	 *                         BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM
	 * @param      string $toType   One of the class type constants
	 * @return     string translated name of the field.
	 * @throws     PropelException - if the specified name could not be found in the fieldname mappings.
	 */
	static public function translateFieldName($name, $fromType, $toType)
	{
		$toNames = self::getFieldNames($toType);
		$key = isset(self::$fieldKeys[$fromType][$name]) ? self::$fieldKeys[$fromType][$name] : null;
		if ($key === null) {
			throw new PropelException("'$name' could not be found in the field names of type '$fromType'. These are: " . print_r(self::$fieldKeys[$fromType], true));
		}
		return $toNames[$key];
	}

	/**
	 * Returns an array of field names.
	 *
	 * @param      string $type The type of fieldnames to return:
	 *                      One of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
	 *                      BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM
	 * @return     array A list of field names
	 */

	static public function getFieldNames($type = BasePeer::TYPE_PHPNAME)
	{
		if (!array_key_exists($type, self::$fieldNames)) {
			throw new PropelException('Method getFieldNames() expects the parameter $type to be one of the class constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME, BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM. ' . $type . ' was given.');
		}
		return self::$fieldNames[$type];
	}

	/**
	 * Convenience method which changes table.column to alias.column.
	 *
	 * Using this method you can maintain SQL abstraction while using column aliases.
	 * <code>
	 *		$c->addAlias("alias1", TablePeer::TABLE_NAME);
	 *		$c->addJoin(TablePeer::alias("alias1", TablePeer::PRIMARY_KEY_COLUMN), TablePeer::PRIMARY_KEY_COLUMN);
	 * </code>
	 * @param      string $alias The alias for the current table.
	 * @param      string $column The column name for current table. (i.e. ColumnaPeer::COLUMN_NAME).
	 * @return     string
	 */
	public static function alias($alias, $column)
	{
		return str_replace(ColumnaPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	/**
	 * Add all the columns needed to create a new object.
	 *
	 * Note: any columns that were marked with lazyLoad="true" in the
	 * XML schema will not be added to the select list and only loaded
	 * on demand.
	 *
	 * @param      criteria object containing the columns to add.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function addSelectColumns(Criteria $criteria)
	{
		$criteria->addSelectColumn(ColumnaPeer::COL_CODIGO);
		$criteria->addSelectColumn(ColumnaPeer::COL_CODIGO_INTERNO);
		$criteria->addSelectColumn(ColumnaPeer::COL_LOTE);
		$criteria->addSelectColumn(ColumnaPeer::COL_ELIMINADO);
		$criteria->addSelectColumn(ColumnaPeer::COL_FECHA_REGISTRO_SISTEMA);
		$criteria->addSelectColumn(ColumnaPeer::COL_USU_CREA);
		$criteria->addSelectColumn(ColumnaPeer::COL_FECHA_ACTUALIZACION);
		$criteria->addSelectColumn(ColumnaPeer::COL_USU_ACTUALIZA);
		$criteria->addSelectColumn(ColumnaPeer::COL_CAUSA_ELIMINACION);
		$criteria->addSelectColumn(ColumnaPeer::COL_CAUSA_ACTUALIZACION);
		$criteria->addSelectColumn(ColumnaPeer::COL_MAR_CODIGO);
		$criteria->addSelectColumn(ColumnaPeer::COL_MOD_CODIGO);
		$criteria->addSelectColumn(ColumnaPeer::COL_FASE_CODIGO);
		$criteria->addSelectColumn(ColumnaPeer::COL_DIM_CODIGO);
		$criteria->addSelectColumn(ColumnaPeer::COL_TAM_CODIGO);
	}

	/**
	 * Returns the number of rows matching criteria.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
	 * @param      PropelPDO $con
	 * @return     int Number of matching rows.
	 */
	public static function doCount(Criteria $criteria, $distinct = false, PropelPDO $con = null)
	{
		// we may modify criteria, so copy it first
		$criteria = clone $criteria;

		// We need to set the primary table name, since in the case that there are no WHERE columns
		// it will be impossible for the BasePeer::createSelectSql() method to determine which
		// tables go into the FROM clause.
		$criteria->setPrimaryTableName(ColumnaPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			ColumnaPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count
		$criteria->setDbName(self::DATABASE_NAME); // Set the correct dbName

		if ($con === null) {
			$con = Propel::getConnection(ColumnaPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
		// symfony_behaviors behavior
		foreach (sfMixer::getCallables(self::getMixerPreSelectHook(__FUNCTION__)) as $sf_hook)
		{
		  call_user_func($sf_hook, 'BaseColumnaPeer', $criteria, $con);
		}

		// BasePeer returns a PDOStatement
		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; // no rows returned; we infer that means 0 matches.
		}
		$stmt->closeCursor();
		return $count;
	}
	/**
	 * Method to select one object from the DB.
	 *
	 * @param      Criteria $criteria object used to create the SELECT statement.
	 * @param      PropelPDO $con
	 * @return     Columna
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectOne(Criteria $criteria, PropelPDO $con = null)
	{
		$critcopy = clone $criteria;
		$critcopy->setLimit(1);
		$objects = ColumnaPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	/**
	 * Method to do selects.
	 *
	 * @param      Criteria $criteria The Criteria object used to build the SELECT statement.
	 * @param      PropelPDO $con
	 * @return     array Array of selected Objects
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelect(Criteria $criteria, PropelPDO $con = null)
	{
		return ColumnaPeer::populateObjects(ColumnaPeer::doSelectStmt($criteria, $con));
	}
	/**
	 * Prepares the Criteria object and uses the parent doSelect() method to execute a PDOStatement.
	 *
	 * Use this method directly if you want to work with an executed statement durirectly (for example
	 * to perform your own object hydration).
	 *
	 * @param      Criteria $criteria The Criteria object used to build the SELECT statement.
	 * @param      PropelPDO $con The connection to use
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 * @return     PDOStatement The executed PDOStatement object.
	 * @see        BasePeer::doSelect()
	 */
	public static function doSelectStmt(Criteria $criteria, PropelPDO $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(ColumnaPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		if (!$criteria->hasSelectClause()) {
			$criteria = clone $criteria;
			ColumnaPeer::addSelectColumns($criteria);
		}

		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);
		// symfony_behaviors behavior
		foreach (sfMixer::getCallables(self::getMixerPreSelectHook(__FUNCTION__)) as $sf_hook)
		{
		  call_user_func($sf_hook, 'BaseColumnaPeer', $criteria, $con);
		}


		// BasePeer returns a PDOStatement
		return BasePeer::doSelect($criteria, $con);
	}
	/**
	 * Adds an object to the instance pool.
	 *
	 * Propel keeps cached copies of objects in an instance pool when they are retrieved
	 * from the database.  In some cases -- especially when you override doSelect*()
	 * methods in your stub classes -- you may need to explicitly add objects
	 * to the cache in order to ensure that the same objects are always returned by doSelect*()
	 * and retrieveByPK*() calls.
	 *
	 * @param      Columna $value A Columna object.
	 * @param      string $key (optional) key to use for instance map (for performance boost if key was already calculated externally).
	 */
	public static function addInstanceToPool(Columna $obj, $key = null)
	{
		if (Propel::isInstancePoolingEnabled()) {
			if ($key === null) {
				$key = (string) $obj->getColCodigo();
			} // if key === null
			self::$instances[$key] = $obj;
		}
	}

	/**
	 * Removes an object from the instance pool.
	 *
	 * Propel keeps cached copies of objects in an instance pool when they are retrieved
	 * from the database.  In some cases -- especially when you override doDelete
	 * methods in your stub classes -- you may need to explicitly remove objects
	 * from the cache in order to prevent returning objects that no longer exist.
	 *
	 * @param      mixed $value A Columna object or a primary key value.
	 */
	public static function removeInstanceFromPool($value)
	{
		if (Propel::isInstancePoolingEnabled() && $value !== null) {
			if (is_object($value) && $value instanceof Columna) {
				$key = (string) $value->getColCodigo();
			} elseif (is_scalar($value)) {
				// assume we've been passed a primary key
				$key = (string) $value;
			} else {
				$e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or Columna object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value,true)));
				throw $e;
			}

			unset(self::$instances[$key]);
		}
	} // removeInstanceFromPool()

	/**
	 * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
	 *
	 * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
	 * a multi-column primary key, a serialize()d version of the primary key will be returned.
	 *
	 * @param      string $key The key (@see getPrimaryKeyHash()) for this instance.
	 * @return     Columna Found object or NULL if 1) no instance exists for specified key or 2) instance pooling has been disabled.
	 * @see        getPrimaryKeyHash()
	 */
	public static function getInstanceFromPool($key)
	{
		if (Propel::isInstancePoolingEnabled()) {
			if (isset(self::$instances[$key])) {
				return self::$instances[$key];
			}
		}
		return null; // just to be explicit
	}
	
	/**
	 * Clear the instance pool.
	 *
	 * @return     void
	 */
	public static function clearInstancePool()
	{
		self::$instances = array();
	}
	
	/**
	 * Method to invalidate the instance pool of all tables related to columna
	 * by a foreign key with ON DELETE CASCADE
	 */
	public static function clearRelatedInstancePool()
	{
	}

	/**
	 * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
	 *
	 * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
	 * a multi-column primary key, a serialize()d version of the primary key will be returned.
	 *
	 * @param      array $row PropelPDO resultset row.
	 * @param      int $startcol The 0-based offset for reading from the resultset row.
	 * @return     string A string version of PK or NULL if the components of primary key in result array are all null.
	 */
	public static function getPrimaryKeyHashFromRow($row, $startcol = 0)
	{
		// If the PK cannot be derived from the row, return NULL.
		if ($row[$startcol] === null) {
			return null;
		}
		return (string) $row[$startcol];
	}

	/**
	 * The returned array will contain objects of the default type or
	 * objects that inherit from the default.
	 *
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function populateObjects(PDOStatement $stmt)
	{
		$results = array();
	
		// set the class once to avoid overhead in the loop
		$cls = ColumnaPeer::getOMClass(false);
		// populate the object(s)
		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key = ColumnaPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj = ColumnaPeer::getInstanceFromPool($key))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://propel.phpdb.org/trac/ticket/509
				// $obj->hydrate($row, 0, true); // rehydrate
				$results[] = $obj;
			} else {
				$obj = new $cls();
				$obj->hydrate($row);
				$results[] = $obj;
				ColumnaPeer::addInstanceToPool($obj, $key);
			} // if key exists
		}
		$stmt->closeCursor();
		return $results;
	}
	/**
	 * Returns the TableMap related to this peer.
	 * This method is not needed for general use but a specific application could have a need.
	 * @return     TableMap
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function getTableMap()
	{
		return Propel::getDatabaseMap(self::DATABASE_NAME)->getTable(self::TABLE_NAME);
	}

	/**
	 * Add a TableMap instance to the database for this peer class.
	 */
	public static function buildTableMap()
	{
	  $dbMap = Propel::getDatabaseMap(BaseColumnaPeer::DATABASE_NAME);
	  if (!$dbMap->hasTable(BaseColumnaPeer::TABLE_NAME))
	  {
	    $dbMap->addTableObject(new ColumnaTableMap());
	  }
	}

	/**
	 * The class that the Peer will make instances of.
	 *
	 * If $withPrefix is true, the returned path
	 * uses a dot-path notation which is tranalted into a path
	 * relative to a location on the PHP include_path.
	 * (e.g. path.to.MyClass -> 'path/to/MyClass.php')
	 *
	 * @param      boolean  Whether or not to return the path wit hthe class name 
	 * @return     string path.to.ClassName
	 */
	public static function getOMClass($withPrefix = true)
	{
		return $withPrefix ? ColumnaPeer::CLASS_DEFAULT : ColumnaPeer::OM_CLASS;
	}

	/**
	 * Method perform an INSERT on the database, given a Columna or Criteria object.
	 *
	 * @param      mixed $values Criteria or Columna object containing data that is used to create the INSERT statement.
	 * @param      PropelPDO $con the PropelPDO connection to use
	 * @return     mixed The new primary key.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doInsert($values, PropelPDO $con = null)
	{
    // symfony_behaviors behavior
    foreach (sfMixer::getCallables('BaseColumnaPeer:doInsert:pre') as $sf_hook)
    {
      if (false !== $sf_hook_retval = call_user_func($sf_hook, 'BaseColumnaPeer', $values, $con))
      {
        return $sf_hook_retval;
      }
    }

		if ($con === null) {
			$con = Propel::getConnection(ColumnaPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; // rename for clarity
		} else {
			$criteria = $values->buildCriteria(); // build Criteria from Columna object
		}

		if ($criteria->containsKey(ColumnaPeer::COL_CODIGO) && $criteria->keyContainsValue(ColumnaPeer::COL_CODIGO) ) {
			throw new PropelException('Cannot insert a value for auto-increment primary key ('.ColumnaPeer::COL_CODIGO.')');
		}


		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		try {
			// use transaction because $criteria could contain info
			// for more than one table (I guess, conceivably)
			$con->beginTransaction();
			$pk = BasePeer::doInsert($criteria, $con);
			$con->commit();
		} catch(PropelException $e) {
			$con->rollBack();
			throw $e;
		}

    // symfony_behaviors behavior
    foreach (sfMixer::getCallables('BaseColumnaPeer:doInsert:post') as $sf_hook)
    {
      call_user_func($sf_hook, 'BaseColumnaPeer', $values, $con, $pk);
    }

		return $pk;
	}

	/**
	 * Method perform an UPDATE on the database, given a Columna or Criteria object.
	 *
	 * @param      mixed $values Criteria or Columna object containing data that is used to create the UPDATE statement.
	 * @param      PropelPDO $con The connection to use (specify PropelPDO connection object to exert more control over transactions).
	 * @return     int The number of affected rows (if supported by underlying database driver).
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doUpdate($values, PropelPDO $con = null)
	{
    // symfony_behaviors behavior
    foreach (sfMixer::getCallables('BaseColumnaPeer:doUpdate:pre') as $sf_hook)
    {
      if (false !== $sf_hook_retval = call_user_func($sf_hook, 'BaseColumnaPeer', $values, $con))
      {
        return $sf_hook_retval;
      }
    }

		if ($con === null) {
			$con = Propel::getConnection(ColumnaPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		$selectCriteria = new Criteria(self::DATABASE_NAME);

		if ($values instanceof Criteria) {
			$criteria = clone $values; // rename for clarity

			$comparison = $criteria->getComparison(ColumnaPeer::COL_CODIGO);
			$selectCriteria->add(ColumnaPeer::COL_CODIGO, $criteria->remove(ColumnaPeer::COL_CODIGO), $comparison);

		} else { // $values is Columna object
			$criteria = $values->buildCriteria(); // gets full criteria
			$selectCriteria = $values->buildPkeyCriteria(); // gets criteria w/ primary key(s)
		}

		// set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		$ret = BasePeer::doUpdate($selectCriteria, $criteria, $con);

    // symfony_behaviors behavior
    foreach (sfMixer::getCallables('BaseColumnaPeer:doUpdate:post') as $sf_hook)
    {
      call_user_func($sf_hook, 'BaseColumnaPeer', $values, $con, $ret);
    }

    return $ret;
	}

	/**
	 * Method to DELETE all rows from the columna table.
	 *
	 * @return     int The number of affected rows (if supported by underlying database driver).
	 */
	public static function doDeleteAll($con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(ColumnaPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		$affectedRows = 0; // initialize var to track total num of affected rows
		try {
			// use transaction because $criteria could contain info
			// for more than one table or we could emulating ON DELETE CASCADE, etc.
			$con->beginTransaction();
			$affectedRows += BasePeer::doDeleteAll(ColumnaPeer::TABLE_NAME, $con);
			// Because this db requires some delete cascade/set null emulation, we have to
			// clear the cached instance *after* the emulation has happened (since
			// instances get re-added by the select statement contained therein).
			ColumnaPeer::clearInstancePool();
			ColumnaPeer::clearRelatedInstancePool();
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	}

	/**
	 * Method perform a DELETE on the database, given a Columna or Criteria object OR a primary key value.
	 *
	 * @param      mixed $values Criteria or Columna object or primary key or array of primary keys
	 *              which is used to create the DELETE statement
	 * @param      PropelPDO $con the connection to use
	 * @return     int 	The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
	 *				if supported by native driver or if emulated using Propel.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	 public static function doDelete($values, PropelPDO $con = null)
	 {
		if ($con === null) {
			$con = Propel::getConnection(ColumnaPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		if ($values instanceof Criteria) {
			// invalidate the cache for all objects of this type, since we have no
			// way of knowing (without running a query) what objects should be invalidated
			// from the cache based on this Criteria.
			ColumnaPeer::clearInstancePool();
			// rename for clarity
			$criteria = clone $values;
		} elseif ($values instanceof Columna) { // it's a model object
			// invalidate the cache for this single object
			ColumnaPeer::removeInstanceFromPool($values);
			// create criteria based on pk values
			$criteria = $values->buildPkeyCriteria();
		} else { // it's a primary key, or an array of pks
			$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(ColumnaPeer::COL_CODIGO, (array) $values, Criteria::IN);
			// invalidate the cache for this object(s)
			foreach ((array) $values as $singleval) {
				ColumnaPeer::removeInstanceFromPool($singleval);
			}
		}

		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		$affectedRows = 0; // initialize var to track total num of affected rows

		try {
			// use transaction because $criteria could contain info
			// for more than one table or we could emulating ON DELETE CASCADE, etc.
			$con->beginTransaction();
			
			$affectedRows += BasePeer::doDelete($criteria, $con);
			ColumnaPeer::clearRelatedInstancePool();
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	}

	/**
	 * Validates all modified columns of given Columna object.
	 * If parameter $columns is either a single column name or an array of column names
	 * than only those columns are validated.
	 *
	 * NOTICE: This does not apply to primary or foreign keys for now.
	 *
	 * @param      Columna $obj The object to validate.
	 * @param      mixed $cols Column name or array of column names.
	 *
	 * @return     mixed TRUE if all columns are valid or the error message of the first invalid column.
	 */
	public static function doValidate(Columna $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(ColumnaPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(ColumnaPeer::TABLE_NAME);

			if (! is_array($cols)) {
				$cols = array($cols);
			}

			foreach ($cols as $colName) {
				if ($tableMap->containsColumn($colName)) {
					$get = 'get' . $tableMap->getColumn($colName)->getPhpName();
					$columns[$colName] = $obj->$get();
				}
			}
		} else {

		}

		return BasePeer::doValidate(ColumnaPeer::DATABASE_NAME, ColumnaPeer::TABLE_NAME, $columns);
	}

	/**
	 * Retrieve a single object by pkey.
	 *
	 * @param      int $pk the primary key.
	 * @param      PropelPDO $con the connection to use
	 * @return     Columna
	 */
	public static function retrieveByPK($pk, PropelPDO $con = null)
	{

		if (null !== ($obj = ColumnaPeer::getInstanceFromPool((string) $pk))) {
			return $obj;
		}

		if ($con === null) {
			$con = Propel::getConnection(ColumnaPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria = new Criteria(ColumnaPeer::DATABASE_NAME);
		$criteria->add(ColumnaPeer::COL_CODIGO, $pk);

		$v = ColumnaPeer::doSelect($criteria, $con);

		return !empty($v) > 0 ? $v[0] : null;
	}

	/**
	 * Retrieve multiple objects by pkey.
	 *
	 * @param      array $pks List of primary keys
	 * @param      PropelPDO $con the connection to use
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function retrieveByPKs($pks, PropelPDO $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(ColumnaPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$objs = null;
		if (empty($pks)) {
			$objs = array();
		} else {
			$criteria = new Criteria(ColumnaPeer::DATABASE_NAME);
			$criteria->add(ColumnaPeer::COL_CODIGO, $pks, Criteria::IN);
			$objs = ColumnaPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

	// symfony behavior
	
	/**
	 * Returns an array of arrays that contain columns in each unique index.
	 *
	 * @return array
	 */
	static public function getUniqueColumnNames()
	{
	  return array();
	}

	// symfony_behaviors behavior
	
	/**
	 * Returns the name of the hook to call from inside the supplied method.
	 *
	 * @param string $method The calling method
	 *
	 * @return string A hook name for {@link sfMixer}
	 *
	 * @throws LogicException If the method name is not recognized
	 */
	static private function getMixerPreSelectHook($method)
	{
	  if (preg_match('/^do(Select|Count)(Join(All(Except)?)?|Stmt)?/', $method, $match))
	  {
	    return sprintf('BaseColumnaPeer:%s:%1$s', 'Count' == $match[1] ? 'doCount' : $match[0]);
	  }
	
	  throw new LogicException(sprintf('Unrecognized function "%s"', $method));
	}

} // BaseColumnaPeer

// This is the static code needed to register the TableMap for this table with the main Propel class.
//
BaseColumnaPeer::buildTableMap();

