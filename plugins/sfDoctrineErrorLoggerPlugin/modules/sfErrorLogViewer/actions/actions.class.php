<?php

/**
 * sfErrorLogViewer actions.
 *
 * @package    sfdemo
 * @subpackage sfErrorLogViewer
 * @author     Fabien Potencier
 * @version    SVN: $Id: actions.class.php 7911 2008-03-15 22:05:07Z fabien $
 */
class sfErrorLogViewerActions extends autosfErrorLogViewerActions
{
  public function executeDeleteAllSimilar()
  {
    $error = Doctrine::getTable('sfErrorLog')->find($this->getRequestParameter('id'));
    $this->forward404Unless($error);

    sfErrorLogTable::deleteAllSimilar($error);

    $this->redirect('sfErrorLogViewer/list');
  }

  public function executeDeleteAll()
  {
  	Doctrine_Query::create()
  		->delete()
  		->from('sfErrorLog')
  		->execute();
  		
    $this->redirect('sfErrorLogViewer/list');
  }
}
