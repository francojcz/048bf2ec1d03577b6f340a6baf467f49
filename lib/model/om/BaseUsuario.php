<?php

/**
 * Base class that represents a row from the 'usuario' table.
 *
 * 
 *
 * This class was autogenerated by Propel 1.4.2 on:
 *
 * 06/29/14 02:06:12
 *
 * @package    lib.model.om
 */
abstract class BaseUsuario extends BaseObject  implements Persistent {


	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        UsuarioPeer
	 */
	protected static $peer;

	/**
	 * The value for the usu_codigo field.
	 * @var        int
	 */
	protected $usu_codigo;

	/**
	 * The value for the usu_per_codigo field.
	 * @var        int
	 */
	protected $usu_per_codigo;

	/**
	 * The value for the usu_login field.
	 * @var        string
	 */
	protected $usu_login;

	/**
	 * The value for the usu_password field.
	 * @var        string
	 */
	protected $usu_password;

	/**
	 * The value for the usu_habilitado field.
	 * @var        int
	 */
	protected $usu_habilitado;

	/**
	 * The value for the usu_fecha_registro_sistema field.
	 * @var        string
	 */
	protected $usu_fecha_registro_sistema;

	/**
	 * The value for the usu_fecha_actualizacion field.
	 * @var        string
	 */
	protected $usu_fecha_actualizacion;

	/**
	 * The value for the usu_causa_actualizacion field.
	 * @var        string
	 */
	protected $usu_causa_actualizacion;

	/**
	 * The value for the usu_crea field.
	 * @var        string
	 */
	protected $usu_crea;

	/**
	 * The value for the usu_actualiza field.
	 * @var        string
	 */
	protected $usu_actualiza;

	/**
	 * Flag to prevent endless save loop, if this object is referenced
	 * by another object which falls in this transaction.
	 * @var        boolean
	 */
	protected $alreadyInSave = false;

	/**
	 * Flag to prevent endless validation loop, if this object is referenced
	 * by another object which falls in this transaction.
	 * @var        boolean
	 */
	protected $alreadyInValidation = false;

	// symfony behavior
	
	const PEER = 'UsuarioPeer';

	/**
	 * Get the [usu_codigo] column value.
	 * 
	 * @return     int
	 */
	public function getUsuCodigo()
	{
		return $this->usu_codigo;
	}

	/**
	 * Get the [usu_per_codigo] column value.
	 * 
	 * @return     int
	 */
	public function getUsuPerCodigo()
	{
		return $this->usu_per_codigo;
	}

	/**
	 * Get the [usu_login] column value.
	 * 
	 * @return     string
	 */
	public function getUsuLogin()
	{
		return $this->usu_login;
	}

	/**
	 * Get the [usu_password] column value.
	 * 
	 * @return     string
	 */
	public function getUsuPassword()
	{
		return $this->usu_password;
	}

	/**
	 * Get the [usu_habilitado] column value.
	 * 
	 * @return     int
	 */
	public function getUsuHabilitado()
	{
		return $this->usu_habilitado;
	}

	/**
	 * Get the [optionally formatted] temporal [usu_fecha_registro_sistema] column value.
	 * 
	 *
	 * @param      string $format The date/time format string (either date()-style or strftime()-style).
	 *							If format is NULL, then the raw DateTime object will be returned.
	 * @return     mixed Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00 00:00:00
	 * @throws     PropelException - if unable to parse/validate the date/time value.
	 */
	public function getUsuFechaRegistroSistema($format = 'Y-m-d H:i:s')
	{
		if ($this->usu_fecha_registro_sistema === null) {
			return null;
		}


		if ($this->usu_fecha_registro_sistema === '0000-00-00 00:00:00') {
			// while technically this is not a default value of NULL,
			// this seems to be closest in meaning.
			return null;
		} else {
			try {
				$dt = new DateTime($this->usu_fecha_registro_sistema);
			} catch (Exception $x) {
				throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->usu_fecha_registro_sistema, true), $x);
			}
		}

		if ($format === null) {
			// Because propel.useDateTimeClass is TRUE, we return a DateTime object.
			return $dt;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $dt->format('U'));
		} else {
			return $dt->format($format);
		}
	}

	/**
	 * Get the [optionally formatted] temporal [usu_fecha_actualizacion] column value.
	 * 
	 *
	 * @param      string $format The date/time format string (either date()-style or strftime()-style).
	 *							If format is NULL, then the raw DateTime object will be returned.
	 * @return     mixed Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00 00:00:00
	 * @throws     PropelException - if unable to parse/validate the date/time value.
	 */
	public function getUsuFechaActualizacion($format = 'Y-m-d H:i:s')
	{
		if ($this->usu_fecha_actualizacion === null) {
			return null;
		}


		if ($this->usu_fecha_actualizacion === '0000-00-00 00:00:00') {
			// while technically this is not a default value of NULL,
			// this seems to be closest in meaning.
			return null;
		} else {
			try {
				$dt = new DateTime($this->usu_fecha_actualizacion);
			} catch (Exception $x) {
				throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->usu_fecha_actualizacion, true), $x);
			}
		}

		if ($format === null) {
			// Because propel.useDateTimeClass is TRUE, we return a DateTime object.
			return $dt;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $dt->format('U'));
		} else {
			return $dt->format($format);
		}
	}

	/**
	 * Get the [usu_causa_actualizacion] column value.
	 * 
	 * @return     string
	 */
	public function getUsuCausaActualizacion()
	{
		return $this->usu_causa_actualizacion;
	}

	/**
	 * Get the [usu_crea] column value.
	 * 
	 * @return     string
	 */
	public function getUsuCrea()
	{
		return $this->usu_crea;
	}

	/**
	 * Get the [usu_actualiza] column value.
	 * 
	 * @return     string
	 */
	public function getUsuActualiza()
	{
		return $this->usu_actualiza;
	}

	/**
	 * Set the value of [usu_codigo] column.
	 * 
	 * @param      int $v new value
	 * @return     Usuario The current object (for fluent API support)
	 */
	public function setUsuCodigo($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->usu_codigo !== $v) {
			$this->usu_codigo = $v;
			$this->modifiedColumns[] = UsuarioPeer::USU_CODIGO;
		}

		return $this;
	} // setUsuCodigo()

	/**
	 * Set the value of [usu_per_codigo] column.
	 * 
	 * @param      int $v new value
	 * @return     Usuario The current object (for fluent API support)
	 */
	public function setUsuPerCodigo($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->usu_per_codigo !== $v) {
			$this->usu_per_codigo = $v;
			$this->modifiedColumns[] = UsuarioPeer::USU_PER_CODIGO;
		}

		return $this;
	} // setUsuPerCodigo()

	/**
	 * Set the value of [usu_login] column.
	 * 
	 * @param      string $v new value
	 * @return     Usuario The current object (for fluent API support)
	 */
	public function setUsuLogin($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->usu_login !== $v) {
			$this->usu_login = $v;
			$this->modifiedColumns[] = UsuarioPeer::USU_LOGIN;
		}

		return $this;
	} // setUsuLogin()

	/**
	 * Set the value of [usu_password] column.
	 * 
	 * @param      string $v new value
	 * @return     Usuario The current object (for fluent API support)
	 */
	public function setUsuPassword($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->usu_password !== $v) {
			$this->usu_password = $v;
			$this->modifiedColumns[] = UsuarioPeer::USU_PASSWORD;
		}

		return $this;
	} // setUsuPassword()

	/**
	 * Set the value of [usu_habilitado] column.
	 * 
	 * @param      int $v new value
	 * @return     Usuario The current object (for fluent API support)
	 */
	public function setUsuHabilitado($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->usu_habilitado !== $v) {
			$this->usu_habilitado = $v;
			$this->modifiedColumns[] = UsuarioPeer::USU_HABILITADO;
		}

		return $this;
	} // setUsuHabilitado()

	/**
	 * Sets the value of [usu_fecha_registro_sistema] column to a normalized version of the date/time value specified.
	 * 
	 * @param      mixed $v string, integer (timestamp), or DateTime value.  Empty string will
	 *						be treated as NULL for temporal objects.
	 * @return     Usuario The current object (for fluent API support)
	 */
	public function setUsuFechaRegistroSistema($v)
	{
		// we treat '' as NULL for temporal objects because DateTime('') == DateTime('now')
		// -- which is unexpected, to say the least.
		if ($v === null || $v === '') {
			$dt = null;
		} elseif ($v instanceof DateTime) {
			$dt = $v;
		} else {
			// some string/numeric value passed; we normalize that so that we can
			// validate it.
			try {
				if (is_numeric($v)) { // if it's a unix timestamp
					$dt = new DateTime('@'.$v, new DateTimeZone('UTC'));
					// We have to explicitly specify and then change the time zone because of a
					// DateTime bug: http://bugs.php.net/bug.php?id=43003
					$dt->setTimeZone(new DateTimeZone(date_default_timezone_get()));
				} else {
					$dt = new DateTime($v);
				}
			} catch (Exception $x) {
				throw new PropelException('Error parsing date/time value: ' . var_export($v, true), $x);
			}
		}

		if ( $this->usu_fecha_registro_sistema !== null || $dt !== null ) {
			// (nested ifs are a little easier to read in this case)

			$currNorm = ($this->usu_fecha_registro_sistema !== null && $tmpDt = new DateTime($this->usu_fecha_registro_sistema)) ? $tmpDt->format('Y-m-d H:i:s') : null;
			$newNorm = ($dt !== null) ? $dt->format('Y-m-d H:i:s') : null;

			if ( ($currNorm !== $newNorm) // normalized values don't match 
					)
			{
				$this->usu_fecha_registro_sistema = ($dt ? $dt->format('Y-m-d H:i:s') : null);
				$this->modifiedColumns[] = UsuarioPeer::USU_FECHA_REGISTRO_SISTEMA;
			}
		} // if either are not null

		return $this;
	} // setUsuFechaRegistroSistema()

	/**
	 * Sets the value of [usu_fecha_actualizacion] column to a normalized version of the date/time value specified.
	 * 
	 * @param      mixed $v string, integer (timestamp), or DateTime value.  Empty string will
	 *						be treated as NULL for temporal objects.
	 * @return     Usuario The current object (for fluent API support)
	 */
	public function setUsuFechaActualizacion($v)
	{
		// we treat '' as NULL for temporal objects because DateTime('') == DateTime('now')
		// -- which is unexpected, to say the least.
		if ($v === null || $v === '') {
			$dt = null;
		} elseif ($v instanceof DateTime) {
			$dt = $v;
		} else {
			// some string/numeric value passed; we normalize that so that we can
			// validate it.
			try {
				if (is_numeric($v)) { // if it's a unix timestamp
					$dt = new DateTime('@'.$v, new DateTimeZone('UTC'));
					// We have to explicitly specify and then change the time zone because of a
					// DateTime bug: http://bugs.php.net/bug.php?id=43003
					$dt->setTimeZone(new DateTimeZone(date_default_timezone_get()));
				} else {
					$dt = new DateTime($v);
				}
			} catch (Exception $x) {
				throw new PropelException('Error parsing date/time value: ' . var_export($v, true), $x);
			}
		}

		if ( $this->usu_fecha_actualizacion !== null || $dt !== null ) {
			// (nested ifs are a little easier to read in this case)

			$currNorm = ($this->usu_fecha_actualizacion !== null && $tmpDt = new DateTime($this->usu_fecha_actualizacion)) ? $tmpDt->format('Y-m-d H:i:s') : null;
			$newNorm = ($dt !== null) ? $dt->format('Y-m-d H:i:s') : null;

			if ( ($currNorm !== $newNorm) // normalized values don't match 
					)
			{
				$this->usu_fecha_actualizacion = ($dt ? $dt->format('Y-m-d H:i:s') : null);
				$this->modifiedColumns[] = UsuarioPeer::USU_FECHA_ACTUALIZACION;
			}
		} // if either are not null

		return $this;
	} // setUsuFechaActualizacion()

	/**
	 * Set the value of [usu_causa_actualizacion] column.
	 * 
	 * @param      string $v new value
	 * @return     Usuario The current object (for fluent API support)
	 */
	public function setUsuCausaActualizacion($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->usu_causa_actualizacion !== $v) {
			$this->usu_causa_actualizacion = $v;
			$this->modifiedColumns[] = UsuarioPeer::USU_CAUSA_ACTUALIZACION;
		}

		return $this;
	} // setUsuCausaActualizacion()

	/**
	 * Set the value of [usu_crea] column.
	 * 
	 * @param      string $v new value
	 * @return     Usuario The current object (for fluent API support)
	 */
	public function setUsuCrea($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->usu_crea !== $v) {
			$this->usu_crea = $v;
			$this->modifiedColumns[] = UsuarioPeer::USU_CREA;
		}

		return $this;
	} // setUsuCrea()

	/**
	 * Set the value of [usu_actualiza] column.
	 * 
	 * @param      string $v new value
	 * @return     Usuario The current object (for fluent API support)
	 */
	public function setUsuActualiza($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->usu_actualiza !== $v) {
			$this->usu_actualiza = $v;
			$this->modifiedColumns[] = UsuarioPeer::USU_ACTUALIZA;
		}

		return $this;
	} // setUsuActualiza()

	/**
	 * Indicates whether the columns in this object are only set to default values.
	 *
	 * This method can be used in conjunction with isModified() to indicate whether an object is both
	 * modified _and_ has some values set which are non-default.
	 *
	 * @return     boolean Whether the columns in this object are only been set with default values.
	 */
	public function hasOnlyDefaultValues()
	{
		// otherwise, everything was equal, so return TRUE
		return true;
	} // hasOnlyDefaultValues()

	/**
	 * Hydrates (populates) the object variables with values from the database resultset.
	 *
	 * An offset (0-based "start column") is specified so that objects can be hydrated
	 * with a subset of the columns in the resultset rows.  This is needed, for example,
	 * for results of JOIN queries where the resultset row includes columns from two or
	 * more tables.
	 *
	 * @param      array $row The row returned by PDOStatement->fetch(PDO::FETCH_NUM)
	 * @param      int $startcol 0-based offset column which indicates which restultset column to start with.
	 * @param      boolean $rehydrate Whether this object is being re-hydrated from the database.
	 * @return     int next starting column
	 * @throws     PropelException  - Any caught Exception will be rewrapped as a PropelException.
	 */
	public function hydrate($row, $startcol = 0, $rehydrate = false)
	{
		try {

			$this->usu_codigo = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
			$this->usu_per_codigo = ($row[$startcol + 1] !== null) ? (int) $row[$startcol + 1] : null;
			$this->usu_login = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
			$this->usu_password = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
			$this->usu_habilitado = ($row[$startcol + 4] !== null) ? (int) $row[$startcol + 4] : null;
			$this->usu_fecha_registro_sistema = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
			$this->usu_fecha_actualizacion = ($row[$startcol + 6] !== null) ? (string) $row[$startcol + 6] : null;
			$this->usu_causa_actualizacion = ($row[$startcol + 7] !== null) ? (string) $row[$startcol + 7] : null;
			$this->usu_crea = ($row[$startcol + 8] !== null) ? (string) $row[$startcol + 8] : null;
			$this->usu_actualiza = ($row[$startcol + 9] !== null) ? (string) $row[$startcol + 9] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

			// FIXME - using NUM_COLUMNS may be clearer.
			return $startcol + 10; // 10 = UsuarioPeer::NUM_COLUMNS - UsuarioPeer::NUM_LAZY_LOAD_COLUMNS).

		} catch (Exception $e) {
			throw new PropelException("Error populating Usuario object", $e);
		}
	}

	/**
	 * Checks and repairs the internal consistency of the object.
	 *
	 * This method is executed after an already-instantiated object is re-hydrated
	 * from the database.  It exists to check any foreign keys to make sure that
	 * the objects related to the current object are correct based on foreign key.
	 *
	 * You can override this method in the stub class, but you should always invoke
	 * the base method from the overridden method (i.e. parent::ensureConsistency()),
	 * in case your model changes.
	 *
	 * @throws     PropelException
	 */
	public function ensureConsistency()
	{

	} // ensureConsistency

	/**
	 * Reloads this object from datastore based on primary key and (optionally) resets all associated objects.
	 *
	 * This will only work if the object has been saved and has a valid primary key set.
	 *
	 * @param      boolean $deep (optional) Whether to also de-associated any related objects.
	 * @param      PropelPDO $con (optional) The PropelPDO connection to use.
	 * @return     void
	 * @throws     PropelException - if this object is deleted, unsaved or doesn't have pk match in db
	 */
	public function reload($deep = false, PropelPDO $con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("Cannot reload a deleted object.");
		}

		if ($this->isNew()) {
			throw new PropelException("Cannot reload an unsaved object.");
		}

		if ($con === null) {
			$con = Propel::getConnection(UsuarioPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		// We don't need to alter the object instance pool; we're just modifying this instance
		// already in the pool.

		$stmt = UsuarioPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); // rehydrate

		if ($deep) {  // also de-associate any related objects?

		} // if (deep)
	}

	/**
	 * Removes this object from datastore and sets delete attribute.
	 *
	 * @param      PropelPDO $con
	 * @return     void
	 * @throws     PropelException
	 * @see        BaseObject::setDeleted()
	 * @see        BaseObject::isDeleted()
	 */
	public function delete(PropelPDO $con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(UsuarioPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$ret = $this->preDelete($con);
			// symfony_behaviors behavior
			foreach (sfMixer::getCallables('BaseUsuario:delete:pre') as $callable)
			{
			  if (call_user_func($callable, $this, $con))
			  {
			    $con->commit();
			
			    return;
			  }
			}

			if ($ret) {
				UsuarioPeer::doDelete($this, $con);
				$this->postDelete($con);
				// symfony_behaviors behavior
				foreach (sfMixer::getCallables('BaseUsuario:delete:post') as $callable)
				{
				  call_user_func($callable, $this, $con);
				}

				$this->setDeleted(true);
				$con->commit();
			} else {
				$con->commit();
			}
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	}

	/**
	 * Persists this object to the database.
	 *
	 * If the object is new, it inserts it; otherwise an update is performed.
	 * All modified related objects will also be persisted in the doSave()
	 * method.  This method wraps all precipitate database operations in a
	 * single transaction.
	 *
	 * @param      PropelPDO $con
	 * @return     int The number of rows affected by this insert/update and any referring fk objects' save() operations.
	 * @throws     PropelException
	 * @see        doSave()
	 */
	public function save(PropelPDO $con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(UsuarioPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		$isInsert = $this->isNew();
		try {
			$ret = $this->preSave($con);
			// symfony_behaviors behavior
			foreach (sfMixer::getCallables('BaseUsuario:save:pre') as $callable)
			{
			  if (is_integer($affectedRows = call_user_func($callable, $this, $con)))
			  {
			    $con->commit();
			
			    return $affectedRows;
			  }
			}

			if ($isInsert) {
				$ret = $ret && $this->preInsert($con);
			} else {
				$ret = $ret && $this->preUpdate($con);
			}
			if ($ret) {
				$affectedRows = $this->doSave($con);
				if ($isInsert) {
					$this->postInsert($con);
				} else {
					$this->postUpdate($con);
				}
				$this->postSave($con);
				// symfony_behaviors behavior
				foreach (sfMixer::getCallables('BaseUsuario:save:post') as $callable)
				{
				  call_user_func($callable, $this, $con, $affectedRows);
				}

				UsuarioPeer::addInstanceToPool($this);
			} else {
				$affectedRows = 0;
			}
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	}

	/**
	 * Performs the work of inserting or updating the row in the database.
	 *
	 * If the object is new, it inserts it; otherwise an update is performed.
	 * All related objects are also updated in this method.
	 *
	 * @param      PropelPDO $con
	 * @return     int The number of rows affected by this insert/update and any referring fk objects' save() operations.
	 * @throws     PropelException
	 * @see        save()
	 */
	protected function doSave(PropelPDO $con)
	{
		$affectedRows = 0; // initialize var to track total num of affected rows
		if (!$this->alreadyInSave) {
			$this->alreadyInSave = true;

			if ($this->isNew() ) {
				$this->modifiedColumns[] = UsuarioPeer::USU_CODIGO;
			}

			// If this object has been modified, then save it to the database.
			if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = UsuarioPeer::doInsert($this, $con);
					$affectedRows += 1; // we are assuming that there is only 1 row per doInsert() which
										 // should always be true here (even though technically
										 // BasePeer::doInsert() can insert multiple rows).

					$this->setUsuCodigo($pk);  //[IMV] update autoincrement primary key

					$this->setNew(false);
				} else {
					$affectedRows += UsuarioPeer::doUpdate($this, $con);
				}

				$this->resetModified(); // [HL] After being saved an object is no longer 'modified'
			}

			$this->alreadyInSave = false;

		}
		return $affectedRows;
	} // doSave()

	/**
	 * Array of ValidationFailed objects.
	 * @var        array ValidationFailed[]
	 */
	protected $validationFailures = array();

	/**
	 * Gets any ValidationFailed objects that resulted from last call to validate().
	 *
	 *
	 * @return     array ValidationFailed[]
	 * @see        validate()
	 */
	public function getValidationFailures()
	{
		return $this->validationFailures;
	}

	/**
	 * Validates the objects modified field values and all objects related to this table.
	 *
	 * If $columns is either a column name or an array of column names
	 * only those columns are validated.
	 *
	 * @param      mixed $columns Column name or an array of column names.
	 * @return     boolean Whether all columns pass validation.
	 * @see        doValidate()
	 * @see        getValidationFailures()
	 */
	public function validate($columns = null)
	{
		$res = $this->doValidate($columns);
		if ($res === true) {
			$this->validationFailures = array();
			return true;
		} else {
			$this->validationFailures = $res;
			return false;
		}
	}

	/**
	 * This function performs the validation work for complex object models.
	 *
	 * In addition to checking the current object, all related objects will
	 * also be validated.  If all pass then <code>true</code> is returned; otherwise
	 * an aggreagated array of ValidationFailed objects will be returned.
	 *
	 * @param      array $columns Array of column names to validate.
	 * @return     mixed <code>true</code> if all validations pass; array of <code>ValidationFailed</code> objets otherwise.
	 */
	protected function doValidate($columns = null)
	{
		if (!$this->alreadyInValidation) {
			$this->alreadyInValidation = true;
			$retval = null;

			$failureMap = array();


			if (($retval = UsuarioPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	/**
	 * Retrieves a field from the object by name passed in as a string.
	 *
	 * @param      string $name name
	 * @param      string $type The type of fieldname the $name is of:
	 *                     one of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
	 *                     BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM
	 * @return     mixed Value of field.
	 */
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = UsuarioPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		$field = $this->getByPosition($pos);
		return $field;
	}

	/**
	 * Retrieves a field from the object by Position as specified in the xml schema.
	 * Zero-based.
	 *
	 * @param      int $pos position in xml schema
	 * @return     mixed Value of field at $pos
	 */
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getUsuCodigo();
				break;
			case 1:
				return $this->getUsuPerCodigo();
				break;
			case 2:
				return $this->getUsuLogin();
				break;
			case 3:
				return $this->getUsuPassword();
				break;
			case 4:
				return $this->getUsuHabilitado();
				break;
			case 5:
				return $this->getUsuFechaRegistroSistema();
				break;
			case 6:
				return $this->getUsuFechaActualizacion();
				break;
			case 7:
				return $this->getUsuCausaActualizacion();
				break;
			case 8:
				return $this->getUsuCrea();
				break;
			case 9:
				return $this->getUsuActualiza();
				break;
			default:
				return null;
				break;
		} // switch()
	}

	/**
	 * Exports the object as an array.
	 *
	 * You can specify the key type of the array by passing one of the class
	 * type constants.
	 *
	 * @param      string $keyType (optional) One of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
	 *                        BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM. Defaults to BasePeer::TYPE_PHPNAME.
	 * @param      boolean $includeLazyLoadColumns (optional) Whether to include lazy loaded columns.  Defaults to TRUE.
	 * @return     an associative array containing the field names (as keys) and field values
	 */
	public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true)
	{
		$keys = UsuarioPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getUsuCodigo(),
			$keys[1] => $this->getUsuPerCodigo(),
			$keys[2] => $this->getUsuLogin(),
			$keys[3] => $this->getUsuPassword(),
			$keys[4] => $this->getUsuHabilitado(),
			$keys[5] => $this->getUsuFechaRegistroSistema(),
			$keys[6] => $this->getUsuFechaActualizacion(),
			$keys[7] => $this->getUsuCausaActualizacion(),
			$keys[8] => $this->getUsuCrea(),
			$keys[9] => $this->getUsuActualiza(),
		);
		return $result;
	}

	/**
	 * Sets a field from the object by name passed in as a string.
	 *
	 * @param      string $name peer name
	 * @param      mixed $value field value
	 * @param      string $type The type of fieldname the $name is of:
	 *                     one of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
	 *                     BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM
	 * @return     void
	 */
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = UsuarioPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	/**
	 * Sets a field from the object by Position as specified in the xml schema.
	 * Zero-based.
	 *
	 * @param      int $pos position in xml schema
	 * @param      mixed $value field value
	 * @return     void
	 */
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setUsuCodigo($value);
				break;
			case 1:
				$this->setUsuPerCodigo($value);
				break;
			case 2:
				$this->setUsuLogin($value);
				break;
			case 3:
				$this->setUsuPassword($value);
				break;
			case 4:
				$this->setUsuHabilitado($value);
				break;
			case 5:
				$this->setUsuFechaRegistroSistema($value);
				break;
			case 6:
				$this->setUsuFechaActualizacion($value);
				break;
			case 7:
				$this->setUsuCausaActualizacion($value);
				break;
			case 8:
				$this->setUsuCrea($value);
				break;
			case 9:
				$this->setUsuActualiza($value);
				break;
		} // switch()
	}

	/**
	 * Populates the object using an array.
	 *
	 * This is particularly useful when populating an object from one of the
	 * request arrays (e.g. $_POST).  This method goes through the column
	 * names, checking to see whether a matching key exists in populated
	 * array. If so the setByName() method is called for that column.
	 *
	 * You can specify the key type of the array by additionally passing one
	 * of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME,
	 * BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM.
	 * The default key type is the column's phpname (e.g. 'AuthorId')
	 *
	 * @param      array  $arr     An array to populate the object from.
	 * @param      string $keyType The type of keys the array uses.
	 * @return     void
	 */
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = UsuarioPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setUsuCodigo($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setUsuPerCodigo($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setUsuLogin($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setUsuPassword($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setUsuHabilitado($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setUsuFechaRegistroSistema($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setUsuFechaActualizacion($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setUsuCausaActualizacion($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setUsuCrea($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setUsuActualiza($arr[$keys[9]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(UsuarioPeer::DATABASE_NAME);

		if ($this->isColumnModified(UsuarioPeer::USU_CODIGO)) $criteria->add(UsuarioPeer::USU_CODIGO, $this->usu_codigo);
		if ($this->isColumnModified(UsuarioPeer::USU_PER_CODIGO)) $criteria->add(UsuarioPeer::USU_PER_CODIGO, $this->usu_per_codigo);
		if ($this->isColumnModified(UsuarioPeer::USU_LOGIN)) $criteria->add(UsuarioPeer::USU_LOGIN, $this->usu_login);
		if ($this->isColumnModified(UsuarioPeer::USU_PASSWORD)) $criteria->add(UsuarioPeer::USU_PASSWORD, $this->usu_password);
		if ($this->isColumnModified(UsuarioPeer::USU_HABILITADO)) $criteria->add(UsuarioPeer::USU_HABILITADO, $this->usu_habilitado);
		if ($this->isColumnModified(UsuarioPeer::USU_FECHA_REGISTRO_SISTEMA)) $criteria->add(UsuarioPeer::USU_FECHA_REGISTRO_SISTEMA, $this->usu_fecha_registro_sistema);
		if ($this->isColumnModified(UsuarioPeer::USU_FECHA_ACTUALIZACION)) $criteria->add(UsuarioPeer::USU_FECHA_ACTUALIZACION, $this->usu_fecha_actualizacion);
		if ($this->isColumnModified(UsuarioPeer::USU_CAUSA_ACTUALIZACION)) $criteria->add(UsuarioPeer::USU_CAUSA_ACTUALIZACION, $this->usu_causa_actualizacion);
		if ($this->isColumnModified(UsuarioPeer::USU_CREA)) $criteria->add(UsuarioPeer::USU_CREA, $this->usu_crea);
		if ($this->isColumnModified(UsuarioPeer::USU_ACTUALIZA)) $criteria->add(UsuarioPeer::USU_ACTUALIZA, $this->usu_actualiza);

		return $criteria;
	}

	/**
	 * Builds a Criteria object containing the primary key for this object.
	 *
	 * Unlike buildCriteria() this method includes the primary key values regardless
	 * of whether or not they have been modified.
	 *
	 * @return     Criteria The Criteria object containing value(s) for primary key(s).
	 */
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(UsuarioPeer::DATABASE_NAME);

		$criteria->add(UsuarioPeer::USU_CODIGO, $this->usu_codigo);

		return $criteria;
	}

	/**
	 * Returns the primary key for this object (row).
	 * @return     int
	 */
	public function getPrimaryKey()
	{
		return $this->getUsuCodigo();
	}

	/**
	 * Generic method to set the primary key (usu_codigo column).
	 *
	 * @param      int $key Primary key.
	 * @return     void
	 */
	public function setPrimaryKey($key)
	{
		$this->setUsuCodigo($key);
	}

	/**
	 * Sets contents of passed object to values from current object.
	 *
	 * If desired, this method can also make copies of all associated (fkey referrers)
	 * objects.
	 *
	 * @param      object $copyObj An object of Usuario (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setUsuPerCodigo($this->usu_per_codigo);

		$copyObj->setUsuLogin($this->usu_login);

		$copyObj->setUsuPassword($this->usu_password);

		$copyObj->setUsuHabilitado($this->usu_habilitado);

		$copyObj->setUsuFechaRegistroSistema($this->usu_fecha_registro_sistema);

		$copyObj->setUsuFechaActualizacion($this->usu_fecha_actualizacion);

		$copyObj->setUsuCausaActualizacion($this->usu_causa_actualizacion);

		$copyObj->setUsuCrea($this->usu_crea);

		$copyObj->setUsuActualiza($this->usu_actualiza);


		$copyObj->setNew(true);

		$copyObj->setUsuCodigo(NULL); // this is a auto-increment column, so set to default value

	}

	/**
	 * Makes a copy of this object that will be inserted as a new row in table when saved.
	 * It creates a new object filling in the simple attributes, but skipping any primary
	 * keys that are defined for the table.
	 *
	 * If desired, this method can also make copies of all associated (fkey referrers)
	 * objects.
	 *
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @return     Usuario Clone of current object.
	 * @throws     PropelException
	 */
	public function copy($deepCopy = false)
	{
		// we use get_class(), because this might be a subclass
		$clazz = get_class($this);
		$copyObj = new $clazz();
		$this->copyInto($copyObj, $deepCopy);
		return $copyObj;
	}

	/**
	 * Returns a peer instance associated with this om.
	 *
	 * Since Peer classes are not to have any instance attributes, this method returns the
	 * same instance for all member of this class. The method could therefore
	 * be static, but this would prevent one from overriding the behavior.
	 *
	 * @return     UsuarioPeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new UsuarioPeer();
		}
		return self::$peer;
	}

	/**
	 * Resets all collections of referencing foreign keys.
	 *
	 * This method is a user-space workaround for PHP's inability to garbage collect objects
	 * with circular references.  This is currently necessary when using Propel in certain
	 * daemon or large-volumne/high-memory operations.
	 *
	 * @param      boolean $deep Whether to also clear the references on all associated objects.
	 */
	public function clearAllReferences($deep = false)
	{
		if ($deep) {
		} // if ($deep)

	}

	// symfony_behaviors behavior
	
	/**
	 * Calls methods defined via {@link sfMixer}.
	 */
	public function __call($method, $arguments)
	{
	  if (!$callable = sfMixer::getCallable('BaseUsuario:'.$method))
	  {
	    throw new sfException(sprintf('Call to undefined method BaseUsuario::%s', $method));
	  }
	
	  array_unshift($arguments, $this);
	
	  return call_user_func_array($callable, $arguments);
	}

} // BaseUsuario
