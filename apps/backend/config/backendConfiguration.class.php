<?php

class backendConfiguration extends sfApplicationConfiguration
{
  public function configure()
  {
	sfConfig::set('app_currency', 10);
  }
}
