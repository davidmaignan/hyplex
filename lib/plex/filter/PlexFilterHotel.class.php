<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PlexFilterHotel
 *
 * @author david
 */
class PlexFilterHotel implements PlexFilterInterface{

    public $filename;
    public $type;
    public $arObjs = array();
    public $filteredObjs = array();
    public $filteredObjGmap = array();
    public $nbrHotels;
    public $filters;
    public $nbrTotalHotels;
    public $arFilterActivated = array();
    public $nbrHotelsToPaginate;
    public $arFilterToDeactivate = array('starRating'=>array(),'isOurPick'=>false, 'prices'=>array('min'=>'0','max'=>'0'),'location'=>array(),'chain'=>array());



    public function  __construct($type, $filename, $page, $filters) {

        sfProjectConfiguration::getActive()->loadHelpers(array('Number', 'I18N', 'Url', 'Asset', 'Tag'));

        $this->filename = $filename;
        $this->type = $type;

        $this->arObjs = $this->parseFile($this->getFilameFullPath('plex'));
        
        
    }

    public function getFilameFullPath($type = ''){


        switch ($type) {
            case 'plex':
                $file = 'plexResponse.plex';
                break;

            case 'filters':
                $file = 'plexResponse.filters';
                break;

            case 'markers':
                $file = 'plexResponse.markers';
                break;

            case 'raw':
                $file = 'plexResponse.raw';
                break;

            case 'xml':
                $file = 'plexResponse.xml';
                break;

            default:
                $file = null;
                break;
        }



        return sfConfig::get('sf_user_folder').DIRECTORY_SEPARATOR.
                'hotel'.DIRECTORY_SEPARATOR.
                $this->filename.DIRECTORY_SEPARATOR.$file;
    }

    protected function parseFile($filename){

        if ($filename === null || !file_exists($filename)) {
            throw new Exception('You must provide a valid file in the FilterClass');
        }

        $content = file_get_contents($filename);

        $ar = array();

        while ($join = strpos($content, '---')) {
            $obj = unserialize(trim(substr($content, 0, $join)));
            $content = trim(substr($content, $join + 3));
            array_push($ar, $obj);
        }

        //Rename plex
        return $ar;

    }

    public function  getDatasForFilterForm() {
        $content = file_get_contents($this->getFilameFullPath('filters'));
        $datas = unserialize($content);
        return $datas;

    }

}
?>
