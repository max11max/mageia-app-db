<?php
class madbUpdatePackageDescTask extends madbBaseTask
{

  protected $propel = true;

  protected function configure()
  {
    $this->namespace = 'madb';
    $this->name      = 'update-package-desc';
  }
  protected function execute($arguments = array(), $options = array())
  {
    sfContext::createInstance($this->createConfiguration('frontend', 'prod'));
    $con = Propel::getConnection();

    Propel::disableInstancePooling();
    
    $sql = "UPDATE package SET description=NULL, summary=NULL;";
    $con->exec($sql);

    $factory  = new madbPropelObjectHydratorFactory();
    $packages = $factory->create(new Criteria(), new Package());
    foreach ($packages as $package)
    {
      try
      {
        $package->updateSummaryAndDescription();
      }
      catch (PackageException $e)
      {
        echo $e->getMessage() . "\n";
      }
    }
  }
}
