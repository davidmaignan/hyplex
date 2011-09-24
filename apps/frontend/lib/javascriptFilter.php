<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of javascriptFilter
 * Filter to manage creation of different javascript files depending on the context
 *
 * Create javascript files for airports list
 * Include the files depending of the culture
 *
 * To develop create a compress files
 *
 * @author david
 */
class javascriptFilter extends sfFilter {

    public function execute($filterChain) {

        $filterChain->execute();

        //echo 'javascript filter';
        //exit;

        //Check if airport files exist for each languages.
        $languages = sfConfig::get('app_languages_available');
        $folder = sfConfig::get('sf_web_dir').DIRECTORY_SEPARATOR.'js'.DIRECTORY_SEPARATOR.'search'.DIRECTORY_SEPARATOR;

        foreach($languages as $language)
        {
            $file = $folder .'airport_list_'.$language.'.js';

            if(!file_exists($file))
            {
                //echo "$file does not exist in $folder<br />";
                Utils::createAirportJavascriptFile($language, $file);
                
            }
        }
        
    }
}
?>
