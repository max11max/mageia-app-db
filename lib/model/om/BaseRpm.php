<?php

/**
 * Base class that represents a row from the 'rpm' table.
 *
 * 
 *
 * @package    lib.model.om
 */
abstract class BaseRpm extends BaseObject  implements Persistent {


	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        RpmPeer
	 */
	protected static $peer;

	/**
	 * The value for the id field.
	 * @var        int
	 */
	protected $id;

	/**
	 * The value for the package_id field.
	 * @var        int
	 */
	protected $package_id;

	/**
	 * The value for the distrelease_id field.
	 * @var        int
	 */
	protected $distrelease_id;

	/**
	 * The value for the media_id field.
	 * @var        int
	 */
	protected $media_id;

	/**
	 * The value for the rpm_group_id field.
	 * @var        int
	 */
	protected $rpm_group_id;

	/**
	 * The value for the licence field.
	 * @var        string
	 */
	protected $licence;

	/**
	 * The value for the name field.
	 * @var        string
	 */
	protected $name;

	/**
	 * The value for the evr field.
	 * @var        string
	 */
	protected $evr;

	/**
	 * The value for the version field.
	 * @var        string
	 */
	protected $version;

	/**
	 * The value for the release field.
	 * @var        string
	 */
	protected $release;

	/**
	 * The value for the summary field.
	 * @var        string
	 */
	protected $summary;

	/**
	 * The value for the description field.
	 * @var        string
	 */
	protected $description;

	/**
	 * The value for the url field.
	 * @var        string
	 */
	protected $url;

	/**
	 * The value for the src_rpm field.
	 * @var        string
	 */
	protected $src_rpm;

	/**
	 * The value for the rpm_pkgid field.
	 * @var        string
	 */
	protected $rpm_pkgid;

	/**
	 * The value for the build_time field.
	 * @var        string
	 */
	protected $build_time;

	/**
	 * The value for the size field.
	 * @var        int
	 */
	protected $size;

	/**
	 * The value for the arch field.
	 * @var        string
	 */
	protected $arch;

	/**
	 * The value for the arch_id field.
	 * @var        int
	 */
	protected $arch_id;

	/**
	 * @var        Package
	 */
	protected $aPackage;

	/**
	 * @var        Distrelease
	 */
	protected $aDistrelease;

	/**
	 * @var        Media
	 */
	protected $aMedia;

	/**
	 * @var        RpmGroup
	 */
	protected $aRpmGroup;

	/**
	 * @var        Arch
	 */
	protected $aArchRelatedByArchId;

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
	
	const PEER = 'RpmPeer';

	/**
	 * Get the [id] column value.
	 * 
	 * @return     int
	 */
	public function getId()
	{
		return $this->id;
	}

	/**
	 * Get the [package_id] column value.
	 * 
	 * @return     int
	 */
	public function getPackageId()
	{
		return $this->package_id;
	}

	/**
	 * Get the [distrelease_id] column value.
	 * 
	 * @return     int
	 */
	public function getDistreleaseId()
	{
		return $this->distrelease_id;
	}

	/**
	 * Get the [media_id] column value.
	 * 
	 * @return     int
	 */
	public function getMediaId()
	{
		return $this->media_id;
	}

	/**
	 * Get the [rpm_group_id] column value.
	 * 
	 * @return     int
	 */
	public function getRpmGroupId()
	{
		return $this->rpm_group_id;
	}

	/**
	 * Get the [licence] column value.
	 * 
	 * @return     string
	 */
	public function getLicence()
	{
		return $this->licence;
	}

	/**
	 * Get the [name] column value.
	 * 
	 * @return     string
	 */
	public function getName()
	{
		return $this->name;
	}

	/**
	 * Get the [evr] column value.
	 * 
	 * @return     string
	 */
	public function getEvr()
	{
		return $this->evr;
	}

	/**
	 * Get the [version] column value.
	 * 
	 * @return     string
	 */
	public function getVersion()
	{
		return $this->version;
	}

	/**
	 * Get the [release] column value.
	 * 
	 * @return     string
	 */
	public function getRelease()
	{
		return $this->release;
	}

	/**
	 * Get the [summary] column value.
	 * 
	 * @return     string
	 */
	public function getSummary()
	{
		return $this->summary;
	}

	/**
	 * Get the [description] column value.
	 * 
	 * @return     string
	 */
	public function getDescription()
	{
		return $this->description;
	}

	/**
	 * Get the [url] column value.
	 * 
	 * @return     string
	 */
	public function getUrl()
	{
		return $this->url;
	}

	/**
	 * Get the [src_rpm] column value.
	 * 
	 * @return     string
	 */
	public function getSrcRpm()
	{
		return $this->src_rpm;
	}

	/**
	 * Get the [rpm_pkgid] column value.
	 * 
	 * @return     string
	 */
	public function getRpmPkgid()
	{
		return $this->rpm_pkgid;
	}

	/**
	 * Get the [optionally formatted] temporal [build_time] column value.
	 * 
	 *
	 * @param      string $format The date/time format string (either date()-style or strftime()-style).
	 *							If format is NULL, then the raw DateTime object will be returned.
	 * @return     mixed Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00 00:00:00
	 * @throws     PropelException - if unable to parse/validate the date/time value.
	 */
	public function getBuildTime($format = 'Y-m-d H:i:s')
	{
		if ($this->build_time === null) {
			return null;
		}


		if ($this->build_time === '0000-00-00 00:00:00') {
			// while technically this is not a default value of NULL,
			// this seems to be closest in meaning.
			return null;
		} else {
			try {
				$dt = new DateTime($this->build_time);
			} catch (Exception $x) {
				throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->build_time, true), $x);
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
	 * Get the [size] column value.
	 * 
	 * @return     int
	 */
	public function getSize()
	{
		return $this->size;
	}

	/**
	 * Get the [arch] column value.
	 * 
	 * @return     string
	 */
	public function getArch()
	{
		return $this->arch;
	}

	/**
	 * Get the [arch_id] column value.
	 * 
	 * @return     int
	 */
	public function getArchId()
	{
		return $this->arch_id;
	}

	/**
	 * Set the value of [id] column.
	 * 
	 * @param      int $v new value
	 * @return     Rpm The current object (for fluent API support)
	 */
	public function setId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = RpmPeer::ID;
		}

		return $this;
	} // setId()

	/**
	 * Set the value of [package_id] column.
	 * 
	 * @param      int $v new value
	 * @return     Rpm The current object (for fluent API support)
	 */
	public function setPackageId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->package_id !== $v) {
			$this->package_id = $v;
			$this->modifiedColumns[] = RpmPeer::PACKAGE_ID;
		}

		if ($this->aPackage !== null && $this->aPackage->getId() !== $v) {
			$this->aPackage = null;
		}

		return $this;
	} // setPackageId()

	/**
	 * Set the value of [distrelease_id] column.
	 * 
	 * @param      int $v new value
	 * @return     Rpm The current object (for fluent API support)
	 */
	public function setDistreleaseId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->distrelease_id !== $v) {
			$this->distrelease_id = $v;
			$this->modifiedColumns[] = RpmPeer::DISTRELEASE_ID;
		}

		if ($this->aDistrelease !== null && $this->aDistrelease->getId() !== $v) {
			$this->aDistrelease = null;
		}

		return $this;
	} // setDistreleaseId()

	/**
	 * Set the value of [media_id] column.
	 * 
	 * @param      int $v new value
	 * @return     Rpm The current object (for fluent API support)
	 */
	public function setMediaId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->media_id !== $v) {
			$this->media_id = $v;
			$this->modifiedColumns[] = RpmPeer::MEDIA_ID;
		}

		if ($this->aMedia !== null && $this->aMedia->getId() !== $v) {
			$this->aMedia = null;
		}

		return $this;
	} // setMediaId()

	/**
	 * Set the value of [rpm_group_id] column.
	 * 
	 * @param      int $v new value
	 * @return     Rpm The current object (for fluent API support)
	 */
	public function setRpmGroupId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->rpm_group_id !== $v) {
			$this->rpm_group_id = $v;
			$this->modifiedColumns[] = RpmPeer::RPM_GROUP_ID;
		}

		if ($this->aRpmGroup !== null && $this->aRpmGroup->getId() !== $v) {
			$this->aRpmGroup = null;
		}

		return $this;
	} // setRpmGroupId()

	/**
	 * Set the value of [licence] column.
	 * 
	 * @param      string $v new value
	 * @return     Rpm The current object (for fluent API support)
	 */
	public function setLicence($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->licence !== $v) {
			$this->licence = $v;
			$this->modifiedColumns[] = RpmPeer::LICENCE;
		}

		return $this;
	} // setLicence()

	/**
	 * Set the value of [name] column.
	 * 
	 * @param      string $v new value
	 * @return     Rpm The current object (for fluent API support)
	 */
	public function setName($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->name !== $v) {
			$this->name = $v;
			$this->modifiedColumns[] = RpmPeer::NAME;
		}

		return $this;
	} // setName()

	/**
	 * Set the value of [evr] column.
	 * 
	 * @param      string $v new value
	 * @return     Rpm The current object (for fluent API support)
	 */
	public function setEvr($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->evr !== $v) {
			$this->evr = $v;
			$this->modifiedColumns[] = RpmPeer::EVR;
		}

		return $this;
	} // setEvr()

	/**
	 * Set the value of [version] column.
	 * 
	 * @param      string $v new value
	 * @return     Rpm The current object (for fluent API support)
	 */
	public function setVersion($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->version !== $v) {
			$this->version = $v;
			$this->modifiedColumns[] = RpmPeer::VERSION;
		}

		return $this;
	} // setVersion()

	/**
	 * Set the value of [release] column.
	 * 
	 * @param      string $v new value
	 * @return     Rpm The current object (for fluent API support)
	 */
	public function setRelease($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->release !== $v) {
			$this->release = $v;
			$this->modifiedColumns[] = RpmPeer::RELEASE;
		}

		return $this;
	} // setRelease()

	/**
	 * Set the value of [summary] column.
	 * 
	 * @param      string $v new value
	 * @return     Rpm The current object (for fluent API support)
	 */
	public function setSummary($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->summary !== $v) {
			$this->summary = $v;
			$this->modifiedColumns[] = RpmPeer::SUMMARY;
		}

		return $this;
	} // setSummary()

	/**
	 * Set the value of [description] column.
	 * 
	 * @param      string $v new value
	 * @return     Rpm The current object (for fluent API support)
	 */
	public function setDescription($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->description !== $v) {
			$this->description = $v;
			$this->modifiedColumns[] = RpmPeer::DESCRIPTION;
		}

		return $this;
	} // setDescription()

	/**
	 * Set the value of [url] column.
	 * 
	 * @param      string $v new value
	 * @return     Rpm The current object (for fluent API support)
	 */
	public function setUrl($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->url !== $v) {
			$this->url = $v;
			$this->modifiedColumns[] = RpmPeer::URL;
		}

		return $this;
	} // setUrl()

	/**
	 * Set the value of [src_rpm] column.
	 * 
	 * @param      string $v new value
	 * @return     Rpm The current object (for fluent API support)
	 */
	public function setSrcRpm($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->src_rpm !== $v) {
			$this->src_rpm = $v;
			$this->modifiedColumns[] = RpmPeer::SRC_RPM;
		}

		return $this;
	} // setSrcRpm()

	/**
	 * Set the value of [rpm_pkgid] column.
	 * 
	 * @param      string $v new value
	 * @return     Rpm The current object (for fluent API support)
	 */
	public function setRpmPkgid($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->rpm_pkgid !== $v) {
			$this->rpm_pkgid = $v;
			$this->modifiedColumns[] = RpmPeer::RPM_PKGID;
		}

		return $this;
	} // setRpmPkgid()

	/**
	 * Sets the value of [build_time] column to a normalized version of the date/time value specified.
	 * 
	 * @param      mixed $v string, integer (timestamp), or DateTime value.  Empty string will
	 *						be treated as NULL for temporal objects.
	 * @return     Rpm The current object (for fluent API support)
	 */
	public function setBuildTime($v)
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

		if ( $this->build_time !== null || $dt !== null ) {
			// (nested ifs are a little easier to read in this case)

			$currNorm = ($this->build_time !== null && $tmpDt = new DateTime($this->build_time)) ? $tmpDt->format('Y-m-d H:i:s') : null;
			$newNorm = ($dt !== null) ? $dt->format('Y-m-d H:i:s') : null;

			if ( ($currNorm !== $newNorm) // normalized values don't match 
					)
			{
				$this->build_time = ($dt ? $dt->format('Y-m-d H:i:s') : null);
				$this->modifiedColumns[] = RpmPeer::BUILD_TIME;
			}
		} // if either are not null

		return $this;
	} // setBuildTime()

	/**
	 * Set the value of [size] column.
	 * 
	 * @param      int $v new value
	 * @return     Rpm The current object (for fluent API support)
	 */
	public function setSize($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->size !== $v) {
			$this->size = $v;
			$this->modifiedColumns[] = RpmPeer::SIZE;
		}

		return $this;
	} // setSize()

	/**
	 * Set the value of [arch] column.
	 * 
	 * @param      string $v new value
	 * @return     Rpm The current object (for fluent API support)
	 */
	public function setArch($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->arch !== $v) {
			$this->arch = $v;
			$this->modifiedColumns[] = RpmPeer::ARCH;
		}

		return $this;
	} // setArch()

	/**
	 * Set the value of [arch_id] column.
	 * 
	 * @param      int $v new value
	 * @return     Rpm The current object (for fluent API support)
	 */
	public function setArchId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->arch_id !== $v) {
			$this->arch_id = $v;
			$this->modifiedColumns[] = RpmPeer::ARCH_ID;
		}

		if ($this->aArchRelatedByArchId !== null && $this->aArchRelatedByArchId->getId() !== $v) {
			$this->aArchRelatedByArchId = null;
		}

		return $this;
	} // setArchId()

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

			$this->id = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
			$this->package_id = ($row[$startcol + 1] !== null) ? (int) $row[$startcol + 1] : null;
			$this->distrelease_id = ($row[$startcol + 2] !== null) ? (int) $row[$startcol + 2] : null;
			$this->media_id = ($row[$startcol + 3] !== null) ? (int) $row[$startcol + 3] : null;
			$this->rpm_group_id = ($row[$startcol + 4] !== null) ? (int) $row[$startcol + 4] : null;
			$this->licence = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
			$this->name = ($row[$startcol + 6] !== null) ? (string) $row[$startcol + 6] : null;
			$this->evr = ($row[$startcol + 7] !== null) ? (string) $row[$startcol + 7] : null;
			$this->version = ($row[$startcol + 8] !== null) ? (string) $row[$startcol + 8] : null;
			$this->release = ($row[$startcol + 9] !== null) ? (string) $row[$startcol + 9] : null;
			$this->summary = ($row[$startcol + 10] !== null) ? (string) $row[$startcol + 10] : null;
			$this->description = ($row[$startcol + 11] !== null) ? (string) $row[$startcol + 11] : null;
			$this->url = ($row[$startcol + 12] !== null) ? (string) $row[$startcol + 12] : null;
			$this->src_rpm = ($row[$startcol + 13] !== null) ? (string) $row[$startcol + 13] : null;
			$this->rpm_pkgid = ($row[$startcol + 14] !== null) ? (string) $row[$startcol + 14] : null;
			$this->build_time = ($row[$startcol + 15] !== null) ? (string) $row[$startcol + 15] : null;
			$this->size = ($row[$startcol + 16] !== null) ? (int) $row[$startcol + 16] : null;
			$this->arch = ($row[$startcol + 17] !== null) ? (string) $row[$startcol + 17] : null;
			$this->arch_id = ($row[$startcol + 18] !== null) ? (int) $row[$startcol + 18] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

			// FIXME - using NUM_COLUMNS may be clearer.
			return $startcol + 19; // 19 = RpmPeer::NUM_COLUMNS - RpmPeer::NUM_LAZY_LOAD_COLUMNS).

		} catch (Exception $e) {
			throw new PropelException("Error populating Rpm object", $e);
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

		if ($this->aPackage !== null && $this->package_id !== $this->aPackage->getId()) {
			$this->aPackage = null;
		}
		if ($this->aDistrelease !== null && $this->distrelease_id !== $this->aDistrelease->getId()) {
			$this->aDistrelease = null;
		}
		if ($this->aMedia !== null && $this->media_id !== $this->aMedia->getId()) {
			$this->aMedia = null;
		}
		if ($this->aRpmGroup !== null && $this->rpm_group_id !== $this->aRpmGroup->getId()) {
			$this->aRpmGroup = null;
		}
		if ($this->aArchRelatedByArchId !== null && $this->arch_id !== $this->aArchRelatedByArchId->getId()) {
			$this->aArchRelatedByArchId = null;
		}
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
			$con = Propel::getConnection(RpmPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		// We don't need to alter the object instance pool; we're just modifying this instance
		// already in the pool.

		$stmt = RpmPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); // rehydrate

		if ($deep) {  // also de-associate any related objects?

			$this->aPackage = null;
			$this->aDistrelease = null;
			$this->aMedia = null;
			$this->aRpmGroup = null;
			$this->aArchRelatedByArchId = null;
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
			$con = Propel::getConnection(RpmPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$ret = $this->preDelete($con);
			// symfony_behaviors behavior
			foreach (sfMixer::getCallables('BaseRpm:delete:pre') as $callable)
			{
			  if (call_user_func($callable, $this, $con))
			  {
			    $con->commit();
			
			    return;
			  }
			}

			if ($ret) {
				RpmPeer::doDelete($this, $con);
				$this->postDelete($con);
				// symfony_behaviors behavior
				foreach (sfMixer::getCallables('BaseRpm:delete:post') as $callable)
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
			$con = Propel::getConnection(RpmPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		$isInsert = $this->isNew();
		try {
			$ret = $this->preSave($con);
			// symfony_behaviors behavior
			foreach (sfMixer::getCallables('BaseRpm:save:pre') as $callable)
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
				foreach (sfMixer::getCallables('BaseRpm:save:post') as $callable)
				{
				  call_user_func($callable, $this, $con, $affectedRows);
				}

				RpmPeer::addInstanceToPool($this);
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

			// We call the save method on the following object(s) if they
			// were passed to this object by their coresponding set
			// method.  This object relates to these object(s) by a
			// foreign key reference.

			if ($this->aPackage !== null) {
				if ($this->aPackage->isModified() || $this->aPackage->isNew()) {
					$affectedRows += $this->aPackage->save($con);
				}
				$this->setPackage($this->aPackage);
			}

			if ($this->aDistrelease !== null) {
				if ($this->aDistrelease->isModified() || $this->aDistrelease->isNew()) {
					$affectedRows += $this->aDistrelease->save($con);
				}
				$this->setDistrelease($this->aDistrelease);
			}

			if ($this->aMedia !== null) {
				if ($this->aMedia->isModified() || $this->aMedia->isNew()) {
					$affectedRows += $this->aMedia->save($con);
				}
				$this->setMedia($this->aMedia);
			}

			if ($this->aRpmGroup !== null) {
				if ($this->aRpmGroup->isModified() || $this->aRpmGroup->isNew()) {
					$affectedRows += $this->aRpmGroup->save($con);
				}
				$this->setRpmGroup($this->aRpmGroup);
			}

			if ($this->aArchRelatedByArchId !== null) {
				if ($this->aArchRelatedByArchId->isModified() || $this->aArchRelatedByArchId->isNew()) {
					$affectedRows += $this->aArchRelatedByArchId->save($con);
				}
				$this->setArchRelatedByArchId($this->aArchRelatedByArchId);
			}

			if ($this->isNew() ) {
				$this->modifiedColumns[] = RpmPeer::ID;
			}

			// If this object has been modified, then save it to the database.
			if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = RpmPeer::doInsert($this, $con);
					$affectedRows += 1; // we are assuming that there is only 1 row per doInsert() which
										 // should always be true here (even though technically
										 // BasePeer::doInsert() can insert multiple rows).

					$this->setId($pk);  //[IMV] update autoincrement primary key

					$this->setNew(false);
				} else {
					$affectedRows += RpmPeer::doUpdate($this, $con);
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


			// We call the validate method on the following object(s) if they
			// were passed to this object by their coresponding set
			// method.  This object relates to these object(s) by a
			// foreign key reference.

			if ($this->aPackage !== null) {
				if (!$this->aPackage->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aPackage->getValidationFailures());
				}
			}

			if ($this->aDistrelease !== null) {
				if (!$this->aDistrelease->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aDistrelease->getValidationFailures());
				}
			}

			if ($this->aMedia !== null) {
				if (!$this->aMedia->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aMedia->getValidationFailures());
				}
			}

			if ($this->aRpmGroup !== null) {
				if (!$this->aRpmGroup->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aRpmGroup->getValidationFailures());
				}
			}

			if ($this->aArchRelatedByArchId !== null) {
				if (!$this->aArchRelatedByArchId->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aArchRelatedByArchId->getValidationFailures());
				}
			}


			if (($retval = RpmPeer::doValidate($this, $columns)) !== true) {
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
		$pos = RpmPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getId();
				break;
			case 1:
				return $this->getPackageId();
				break;
			case 2:
				return $this->getDistreleaseId();
				break;
			case 3:
				return $this->getMediaId();
				break;
			case 4:
				return $this->getRpmGroupId();
				break;
			case 5:
				return $this->getLicence();
				break;
			case 6:
				return $this->getName();
				break;
			case 7:
				return $this->getEvr();
				break;
			case 8:
				return $this->getVersion();
				break;
			case 9:
				return $this->getRelease();
				break;
			case 10:
				return $this->getSummary();
				break;
			case 11:
				return $this->getDescription();
				break;
			case 12:
				return $this->getUrl();
				break;
			case 13:
				return $this->getSrcRpm();
				break;
			case 14:
				return $this->getRpmPkgid();
				break;
			case 15:
				return $this->getBuildTime();
				break;
			case 16:
				return $this->getSize();
				break;
			case 17:
				return $this->getArch();
				break;
			case 18:
				return $this->getArchId();
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
		$keys = RpmPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getPackageId(),
			$keys[2] => $this->getDistreleaseId(),
			$keys[3] => $this->getMediaId(),
			$keys[4] => $this->getRpmGroupId(),
			$keys[5] => $this->getLicence(),
			$keys[6] => $this->getName(),
			$keys[7] => $this->getEvr(),
			$keys[8] => $this->getVersion(),
			$keys[9] => $this->getRelease(),
			$keys[10] => $this->getSummary(),
			$keys[11] => $this->getDescription(),
			$keys[12] => $this->getUrl(),
			$keys[13] => $this->getSrcRpm(),
			$keys[14] => $this->getRpmPkgid(),
			$keys[15] => $this->getBuildTime(),
			$keys[16] => $this->getSize(),
			$keys[17] => $this->getArch(),
			$keys[18] => $this->getArchId(),
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
		$pos = RpmPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setId($value);
				break;
			case 1:
				$this->setPackageId($value);
				break;
			case 2:
				$this->setDistreleaseId($value);
				break;
			case 3:
				$this->setMediaId($value);
				break;
			case 4:
				$this->setRpmGroupId($value);
				break;
			case 5:
				$this->setLicence($value);
				break;
			case 6:
				$this->setName($value);
				break;
			case 7:
				$this->setEvr($value);
				break;
			case 8:
				$this->setVersion($value);
				break;
			case 9:
				$this->setRelease($value);
				break;
			case 10:
				$this->setSummary($value);
				break;
			case 11:
				$this->setDescription($value);
				break;
			case 12:
				$this->setUrl($value);
				break;
			case 13:
				$this->setSrcRpm($value);
				break;
			case 14:
				$this->setRpmPkgid($value);
				break;
			case 15:
				$this->setBuildTime($value);
				break;
			case 16:
				$this->setSize($value);
				break;
			case 17:
				$this->setArch($value);
				break;
			case 18:
				$this->setArchId($value);
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
		$keys = RpmPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setPackageId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setDistreleaseId($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setMediaId($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setRpmGroupId($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setLicence($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setName($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setEvr($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setVersion($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setRelease($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setSummary($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setDescription($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setUrl($arr[$keys[12]]);
		if (array_key_exists($keys[13], $arr)) $this->setSrcRpm($arr[$keys[13]]);
		if (array_key_exists($keys[14], $arr)) $this->setRpmPkgid($arr[$keys[14]]);
		if (array_key_exists($keys[15], $arr)) $this->setBuildTime($arr[$keys[15]]);
		if (array_key_exists($keys[16], $arr)) $this->setSize($arr[$keys[16]]);
		if (array_key_exists($keys[17], $arr)) $this->setArch($arr[$keys[17]]);
		if (array_key_exists($keys[18], $arr)) $this->setArchId($arr[$keys[18]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(RpmPeer::DATABASE_NAME);

		if ($this->isColumnModified(RpmPeer::ID)) $criteria->add(RpmPeer::ID, $this->id);
		if ($this->isColumnModified(RpmPeer::PACKAGE_ID)) $criteria->add(RpmPeer::PACKAGE_ID, $this->package_id);
		if ($this->isColumnModified(RpmPeer::DISTRELEASE_ID)) $criteria->add(RpmPeer::DISTRELEASE_ID, $this->distrelease_id);
		if ($this->isColumnModified(RpmPeer::MEDIA_ID)) $criteria->add(RpmPeer::MEDIA_ID, $this->media_id);
		if ($this->isColumnModified(RpmPeer::RPM_GROUP_ID)) $criteria->add(RpmPeer::RPM_GROUP_ID, $this->rpm_group_id);
		if ($this->isColumnModified(RpmPeer::LICENCE)) $criteria->add(RpmPeer::LICENCE, $this->licence);
		if ($this->isColumnModified(RpmPeer::NAME)) $criteria->add(RpmPeer::NAME, $this->name);
		if ($this->isColumnModified(RpmPeer::EVR)) $criteria->add(RpmPeer::EVR, $this->evr);
		if ($this->isColumnModified(RpmPeer::VERSION)) $criteria->add(RpmPeer::VERSION, $this->version);
		if ($this->isColumnModified(RpmPeer::RELEASE)) $criteria->add(RpmPeer::RELEASE, $this->release);
		if ($this->isColumnModified(RpmPeer::SUMMARY)) $criteria->add(RpmPeer::SUMMARY, $this->summary);
		if ($this->isColumnModified(RpmPeer::DESCRIPTION)) $criteria->add(RpmPeer::DESCRIPTION, $this->description);
		if ($this->isColumnModified(RpmPeer::URL)) $criteria->add(RpmPeer::URL, $this->url);
		if ($this->isColumnModified(RpmPeer::SRC_RPM)) $criteria->add(RpmPeer::SRC_RPM, $this->src_rpm);
		if ($this->isColumnModified(RpmPeer::RPM_PKGID)) $criteria->add(RpmPeer::RPM_PKGID, $this->rpm_pkgid);
		if ($this->isColumnModified(RpmPeer::BUILD_TIME)) $criteria->add(RpmPeer::BUILD_TIME, $this->build_time);
		if ($this->isColumnModified(RpmPeer::SIZE)) $criteria->add(RpmPeer::SIZE, $this->size);
		if ($this->isColumnModified(RpmPeer::ARCH)) $criteria->add(RpmPeer::ARCH, $this->arch);
		if ($this->isColumnModified(RpmPeer::ARCH_ID)) $criteria->add(RpmPeer::ARCH_ID, $this->arch_id);

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
		$criteria = new Criteria(RpmPeer::DATABASE_NAME);

		$criteria->add(RpmPeer::ID, $this->id);

		return $criteria;
	}

	/**
	 * Returns the primary key for this object (row).
	 * @return     int
	 */
	public function getPrimaryKey()
	{
		return $this->getId();
	}

	/**
	 * Generic method to set the primary key (id column).
	 *
	 * @param      int $key Primary key.
	 * @return     void
	 */
	public function setPrimaryKey($key)
	{
		$this->setId($key);
	}

	/**
	 * Sets contents of passed object to values from current object.
	 *
	 * If desired, this method can also make copies of all associated (fkey referrers)
	 * objects.
	 *
	 * @param      object $copyObj An object of Rpm (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setPackageId($this->package_id);

		$copyObj->setDistreleaseId($this->distrelease_id);

		$copyObj->setMediaId($this->media_id);

		$copyObj->setRpmGroupId($this->rpm_group_id);

		$copyObj->setLicence($this->licence);

		$copyObj->setName($this->name);

		$copyObj->setEvr($this->evr);

		$copyObj->setVersion($this->version);

		$copyObj->setRelease($this->release);

		$copyObj->setSummary($this->summary);

		$copyObj->setDescription($this->description);

		$copyObj->setUrl($this->url);

		$copyObj->setSrcRpm($this->src_rpm);

		$copyObj->setRpmPkgid($this->rpm_pkgid);

		$copyObj->setBuildTime($this->build_time);

		$copyObj->setSize($this->size);

		$copyObj->setArch($this->arch);

		$copyObj->setArchId($this->arch_id);


		$copyObj->setNew(true);

		$copyObj->setId(NULL); // this is a auto-increment column, so set to default value

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
	 * @return     Rpm Clone of current object.
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
	 * @return     RpmPeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new RpmPeer();
		}
		return self::$peer;
	}

	/**
	 * Declares an association between this object and a Package object.
	 *
	 * @param      Package $v
	 * @return     Rpm The current object (for fluent API support)
	 * @throws     PropelException
	 */
	public function setPackage(Package $v = null)
	{
		if ($v === null) {
			$this->setPackageId(NULL);
		} else {
			$this->setPackageId($v->getId());
		}

		$this->aPackage = $v;

		// Add binding for other direction of this n:n relationship.
		// If this object has already been added to the Package object, it will not be re-added.
		if ($v !== null) {
			$v->addRpm($this);
		}

		return $this;
	}


	/**
	 * Get the associated Package object
	 *
	 * @param      PropelPDO Optional Connection object.
	 * @return     Package The associated Package object.
	 * @throws     PropelException
	 */
	public function getPackage(PropelPDO $con = null)
	{
		if ($this->aPackage === null && ($this->package_id !== null)) {
			$this->aPackage = PackagePeer::retrieveByPk($this->package_id);
			/* The following can be used additionally to
			   guarantee the related object contains a reference
			   to this object.  This level of coupling may, however, be
			   undesirable since it could result in an only partially populated collection
			   in the referenced object.
			   $this->aPackage->addRpms($this);
			 */
		}
		return $this->aPackage;
	}

	/**
	 * Declares an association between this object and a Distrelease object.
	 *
	 * @param      Distrelease $v
	 * @return     Rpm The current object (for fluent API support)
	 * @throws     PropelException
	 */
	public function setDistrelease(Distrelease $v = null)
	{
		if ($v === null) {
			$this->setDistreleaseId(NULL);
		} else {
			$this->setDistreleaseId($v->getId());
		}

		$this->aDistrelease = $v;

		// Add binding for other direction of this n:n relationship.
		// If this object has already been added to the Distrelease object, it will not be re-added.
		if ($v !== null) {
			$v->addRpm($this);
		}

		return $this;
	}


	/**
	 * Get the associated Distrelease object
	 *
	 * @param      PropelPDO Optional Connection object.
	 * @return     Distrelease The associated Distrelease object.
	 * @throws     PropelException
	 */
	public function getDistrelease(PropelPDO $con = null)
	{
		if ($this->aDistrelease === null && ($this->distrelease_id !== null)) {
			$this->aDistrelease = DistreleasePeer::retrieveByPk($this->distrelease_id);
			/* The following can be used additionally to
			   guarantee the related object contains a reference
			   to this object.  This level of coupling may, however, be
			   undesirable since it could result in an only partially populated collection
			   in the referenced object.
			   $this->aDistrelease->addRpms($this);
			 */
		}
		return $this->aDistrelease;
	}

	/**
	 * Declares an association between this object and a Media object.
	 *
	 * @param      Media $v
	 * @return     Rpm The current object (for fluent API support)
	 * @throws     PropelException
	 */
	public function setMedia(Media $v = null)
	{
		if ($v === null) {
			$this->setMediaId(NULL);
		} else {
			$this->setMediaId($v->getId());
		}

		$this->aMedia = $v;

		// Add binding for other direction of this n:n relationship.
		// If this object has already been added to the Media object, it will not be re-added.
		if ($v !== null) {
			$v->addRpm($this);
		}

		return $this;
	}


	/**
	 * Get the associated Media object
	 *
	 * @param      PropelPDO Optional Connection object.
	 * @return     Media The associated Media object.
	 * @throws     PropelException
	 */
	public function getMedia(PropelPDO $con = null)
	{
		if ($this->aMedia === null && ($this->media_id !== null)) {
			$this->aMedia = MediaPeer::retrieveByPk($this->media_id);
			/* The following can be used additionally to
			   guarantee the related object contains a reference
			   to this object.  This level of coupling may, however, be
			   undesirable since it could result in an only partially populated collection
			   in the referenced object.
			   $this->aMedia->addRpms($this);
			 */
		}
		return $this->aMedia;
	}

	/**
	 * Declares an association between this object and a RpmGroup object.
	 *
	 * @param      RpmGroup $v
	 * @return     Rpm The current object (for fluent API support)
	 * @throws     PropelException
	 */
	public function setRpmGroup(RpmGroup $v = null)
	{
		if ($v === null) {
			$this->setRpmGroupId(NULL);
		} else {
			$this->setRpmGroupId($v->getId());
		}

		$this->aRpmGroup = $v;

		// Add binding for other direction of this n:n relationship.
		// If this object has already been added to the RpmGroup object, it will not be re-added.
		if ($v !== null) {
			$v->addRpm($this);
		}

		return $this;
	}


	/**
	 * Get the associated RpmGroup object
	 *
	 * @param      PropelPDO Optional Connection object.
	 * @return     RpmGroup The associated RpmGroup object.
	 * @throws     PropelException
	 */
	public function getRpmGroup(PropelPDO $con = null)
	{
		if ($this->aRpmGroup === null && ($this->rpm_group_id !== null)) {
			$this->aRpmGroup = RpmGroupPeer::retrieveByPk($this->rpm_group_id);
			/* The following can be used additionally to
			   guarantee the related object contains a reference
			   to this object.  This level of coupling may, however, be
			   undesirable since it could result in an only partially populated collection
			   in the referenced object.
			   $this->aRpmGroup->addRpms($this);
			 */
		}
		return $this->aRpmGroup;
	}

	/**
	 * Declares an association between this object and a Arch object.
	 *
	 * @param      Arch $v
	 * @return     Rpm The current object (for fluent API support)
	 * @throws     PropelException
	 */
	public function setArchRelatedByArchId(Arch $v = null)
	{
		if ($v === null) {
			$this->setArchId(NULL);
		} else {
			$this->setArchId($v->getId());
		}

		$this->aArchRelatedByArchId = $v;

		// Add binding for other direction of this n:n relationship.
		// If this object has already been added to the Arch object, it will not be re-added.
		if ($v !== null) {
			$v->addRpm($this);
		}

		return $this;
	}


	/**
	 * Get the associated Arch object
	 *
	 * @param      PropelPDO Optional Connection object.
	 * @return     Arch The associated Arch object.
	 * @throws     PropelException
	 */
	public function getArchRelatedByArchId(PropelPDO $con = null)
	{
		if ($this->aArchRelatedByArchId === null && ($this->arch_id !== null)) {
			$this->aArchRelatedByArchId = ArchPeer::retrieveByPk($this->arch_id);
			/* The following can be used additionally to
			   guarantee the related object contains a reference
			   to this object.  This level of coupling may, however, be
			   undesirable since it could result in an only partially populated collection
			   in the referenced object.
			   $this->aArchRelatedByArchId->addRpms($this);
			 */
		}
		return $this->aArchRelatedByArchId;
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

			$this->aPackage = null;
			$this->aDistrelease = null;
			$this->aMedia = null;
			$this->aRpmGroup = null;
			$this->aArchRelatedByArchId = null;
	}

	// symfony_behaviors behavior
	
	/**
	 * Calls methods defined via {@link sfMixer}.
	 */
	public function __call($method, $arguments)
	{
	  if (!$callable = sfMixer::getCallable('BaseRpm:'.$method))
	  {
	    throw new sfException(sprintf('Call to undefined method BaseRpm::%s', $method));
	  }
	
	  array_unshift($arguments, $this);
	
	  return call_user_func_array($callable, $arguments);
	}

} // BaseRpm
