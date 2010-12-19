<?php
class criteriaFactory
{

  public static function createFromContext(madbContext $context, $perimeter)
  {
    $criteria   = new Criteria();
    $filterList = filterCollection::getAll();

    //TODO rpm
    if ($perimeter == filterPerimeters::PACKAGE)
    {
      PackagePeer::addSelectColumns($criteria);
    }
   
    foreach ($filterList as $filterName)
    {
      $filter = new $filterName();
      $filter->setCriteria($criteria);
      $filter->setMadbContext($context);
      if ($filter->getPerimeter() == $perimeter)
      {
        $criteria = $filter->getFilteredCriteria();
      }
      else
      {
        $criteria = self::applyFilterOnOtherPerimeter($filter, $criteria);
      }
    }
    return $criteria;
  }

  protected static function applyFilterOnOtherPerimeter($filter, $criteria)
  {
    $criteriaOrig = $criteria;
    $criteria = clone $criteria;
    $criteria->clearSelectColumns();
    //TODO by perimeter select
    $criteria->addSelectColumn(PackagePeer::ID);
    $criteria->setDistinct();
    $filter->setCriteria($criteria);
    $filter->getFilteredCriteria();
    $tablename = 'tmp_filtrage_' . md5(get_class($filter));
    $toTmp = new criteriaToTemporaryTable($criteria, $tablename);
    $pdo = Propel::getConnection();
    $toTmp->setConnection(Propel::getConnection());
    $toTmp->execute();
    $sql = 'ALTER TABLE %s ADD INDEX (id)';
    $pdo->exec(sprintf($sql, $tablename));
    $criteria = $criteriaOrig;
    //TODO by perumeter join
    $criteria->addJoin(PackagePeer::ID, $toTmp->getField('id'), Criteria::JOIN);
    return $criteria;
  }

}
