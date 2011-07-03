<?php


/**
 * This class defines the structure of the 'subscription_element' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    lib.model.map
 */
class SubscriptionElementTableMap extends TableMap {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.map.SubscriptionElementTableMap';

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
		$this->setName('subscription_element');
		$this->setPhpName('SubscriptionElement');
		$this->setClassname('SubscriptionElement');
		$this->setPackage('lib.model');
		$this->setUseIdGenerator(true);
		$this->setPrimaryKeyMethodInfo('subscription_element_id_seq');
		// columns
		$this->addPrimaryKey('ID', 'Id', 'INTEGER', true, null, null);
		$this->addForeignKey('SUBSCRIPTION_ID', 'SubscriptionId', 'INTEGER', 'subscription', 'ID', true, null, null);
		$this->addForeignKey('PACKAGE_ID', 'PackageId', 'INTEGER', 'package', 'ID', false, null, null);
		$this->addForeignKey('RPM_GROUP_ID', 'RpmGroupId', 'INTEGER', 'rpm_group', 'ID', false, null, null);
		$this->addForeignKey('DISTRELEASE_ID', 'DistreleaseId', 'INTEGER', 'distrelease', 'ID', false, null, null);
		$this->addForeignKey('ARCH_ID', 'ArchId', 'INTEGER', 'arch', 'ID', false, null, null);
		$this->addForeignKey('MEDIA_ID', 'MediaId', 'INTEGER', 'media', 'ID', false, null, null);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
    $this->addRelation('Subscription', 'Subscription', RelationMap::MANY_TO_ONE, array('subscription_id' => 'id', ), null, null);
    $this->addRelation('Package', 'Package', RelationMap::MANY_TO_ONE, array('package_id' => 'id', ), null, null);
    $this->addRelation('RpmGroup', 'RpmGroup', RelationMap::MANY_TO_ONE, array('rpm_group_id' => 'id', ), null, null);
    $this->addRelation('Distrelease', 'Distrelease', RelationMap::MANY_TO_ONE, array('distrelease_id' => 'id', ), null, null);
    $this->addRelation('Arch', 'Arch', RelationMap::MANY_TO_ONE, array('arch_id' => 'id', ), null, null);
    $this->addRelation('Media', 'Media', RelationMap::MANY_TO_ONE, array('media_id' => 'id', ), null, null);
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

} // SubscriptionElementTableMap
