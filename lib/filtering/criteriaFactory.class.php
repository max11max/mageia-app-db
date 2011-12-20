<?php
class criteriaFactory
{

  public function createFromContext(madbContext $context, $targetPerimeter, $use_default_filtering_values = true)
  {
    $criteria              = new Criteria();
    $filtersIteratorFactory = new filtersIteratorFactory();
    $filterIterator        = $filtersIteratorFactory->create();

    $perimeters            = new filterPerimeters();
    $perimeter             = $perimeters->get($targetPerimeter);

    $criteria              = $perimeter->addSelectColumns($criteria);

    foreach ($perimeters->getAll() as $perimeter)
    {
      $perimeterFilters = $filterIterator->getByPerimeter($perimeter);
      if ($perimeter == $targetPerimeter)
      {
        $criteria = $this->applyCurrentPerimeterFilters($perimeterFilters, $criteria, $context, $use_default_filtering_values);
      }
      else
      {
        $criteria = $this->applyOtherPerimeterFilters($perimeterFilters, $criteria, $context, $perimeters->get($perimeter), $use_default_filtering_values);
      }
    }

    return $criteria;
  }

  private function applyCurrentPerimeterFilters(filtersIterator $filters, $criteria, $context, $use_default_filtering_values)
  {
    $criteria = clone $criteria;
    foreach ($filters as $filter)
    {
      $filter->setCriteria($criteria);
      $filter->setMadbContext($context);
      $criteria = $filter->getFilteredCriteria(true, $use_default_filtering_values);
    }
    return $criteria;
  }

  protected function getConnection()
  {
    return Propel::getConnection();
  }

  private function applyOtherPerimeterFilters(filtersIterator $filters, Criteria $criteria, $context, basePerimeter $perimeter, $use_default_filtering_values)
  {
    $criteriaOrig = clone $criteria;
    $selectall_criteria = new Criteria();
    $selectall_criteria->setDistinct();
    $selectall_criteria = $perimeter->addTemporayTableColumns($selectall_criteria);
    
    $criteria = $this->applyCurrentPerimeterFilters($filters, $selectall_criteria, $context, $use_default_filtering_values);

    // No need to create a temp table which contains every package or rpm id
    if ($criteria == $selectall_criteria)
    {
      return $criteriaOrig;
    }
    
    $tablename = 'tmp_filtrage_' . md5(serialize($filters));//TODO better filtertablename
    //TODO do not delete every time this table
    $this->getConnection()->exec(sprintf('DROP TABLE IF EXISTS `%s`', $tablename));

    $toTmp     = new criteriaToTemporaryTable($criteria, $tablename);
    $toTmp->setConnection($this->getConnection());
    $toTmp->execute();
    $sql = 'ALTER TABLE %s ADD INDEX (id)';
    $this->getConnection()->exec(sprintf($sql, $tablename));

    $criteria = $criteriaOrig;

    //TODO by perimeter join

    //2 getTargetId methods?
    if (get_class($perimeter) != 'rpmPerimeter')
    {
      $criteria->addJoin(RpmPeer::PACKAGE_ID, $toTmp->getField('id'), Criteria::JOIN);
    }
    else
    {
      $criteria->addJoin(PackagePeer::ID, $toTmp->getField('id'), Criteria::JOIN);
    }

     return $criteria;
  }

}
