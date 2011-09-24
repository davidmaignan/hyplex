<?php

/*
 * Generate a localized version for the URL you are visiting.
 * http://snippets.symfony-project.org/snippets/tagged/culture+i18n/order_by/date
 */

function localized_current_url($sf_culture = null)
{
  if (! $sf_culture)
  {
    throw new sfException(sprintf('Invalid parameter $sf_culture "%s".', $sf_culture));
  }

  $routing    = sfContext::getInstance()->getRouting();
  $request    = sfContext::getInstance()->getRequest();
  $controller = sfContext::getInstance()->getController();

  // depending on your routing configuration, you can set $route_name = $routing->getCurrentRouteName()
  $route_name = $routing->getCurrentRouteName();

  $parameters = $controller->convertUrlStringToParameters($routing->getCurrentInternalUri());
  $parameters[1]['sf_culture'] = $sf_culture;

  //sfContext::getInstance()->getUser()->setCulture($sf_culture);
  //sfContext::getInstance()->getResponse()->setCookie('hypertech_culture', null, time()-3600);

  return $routing->generate($route_name, array_merge($request->getGetParameters(), $parameters[1]));
}

/*
<div>
  <?php //foreach(sfConfig::get('app_languages_available') as $language) { ?>
    <a href="<?php //echo localized_current_url($language); ?>"><?php //echo $language; ?></a>
</div>
 */