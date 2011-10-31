<?php

require_once dirname(__FILE__).'/../lib/plexerrorGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/plexerrorGeneratorHelper.class.php';

/**
 * plexerror actions.
 *
 * @package    hyplexdemo
 * @subpackage plexerror
 * @author     David Maignan
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class plexerrorActions extends autoPlexerrorActions
{

    public function executeViewErrorFile(sfWebRequest $request){

        $filename = $request->getParameter('filename');
        $filename = sfConfig::get('sf_cache_dir').DIRECTORY_SEPARATOR.$filename;

        $this->content = file_get_contents($filename);

    }


    

}
