<?php

require_once dirname(__FILE__).'/../lib/vendor/symfony/lib/autoload/sfCoreAutoload.class.php';
sfCoreAutoload::register();

class ProjectConfiguration extends sfProjectConfiguration
{
  public function setup()
  {
    $this->enablePlugins('sfDoctrinePlugin');
    $this->enablePlugins('sfDoctrineGuardPlugin');
    $this->enablePlugins('sfDoctrineErrorLoggerPlugin');
    $this->enablePlugins('sfFormExtraPlugin');
    
    
    sfConfig::set('sf_font_folder', sfConfig::get('sf_web_dir').DIRECTORY_SEPARATOR.'fonts');
    
  }

  /**
     * Configure the Doctrine engine
    
    public function configureDoctrine(Doctrine_Manager $manager)
    {
      $manager->setAttribute(Doctrine::ATTR_QUERY_CACHE, new Doctrine_Cache_Apc());
    }
 **/
}
