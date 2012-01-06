<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PlexStats
 *
 * @author david
 */
abstract class PlexStats {

    private $fields = array('date', 'ip', 'folder', 'language', 'sTId', 'agent', 'uri', 'parameters');
    private $arValues = array();
    private $arColumns = array(); //array('language' => 'string', 'clicks' => 'number');
    private $arOptions = array();
    private $arTitle = array();
    private $width;
    private $height;
    private $name;
    
    static $arIps = array('18.12.13.14','123.56.47.45','173.230.162.100',
    						'145.45.23.45','195.45.23.45','210.34.5.67',
    						'202.34.5.67');

    public function __construct($name, $datas, $width = 400, $height = 400, $options = null) {

        $this->name = $name;
        $this->arColumns = $datas['cols'];
        $this->arValues = $datas['values'];
        $this->arTitle = $datas['title'];
        $this->width = $width;
        $this->height = $height;
        $this->arOptions = $options;
    }

    protected function getName() {
        
        $args = func_num_args();
        
        if($args == 0){
            return $this->name . '_chart';
        }
        
        return json_encode($this->name . '_chart');
    }

    protected function getColumns() {
        return json_encode($this->arColumns);
    }
    
    protected function getValues() {
        return json_encode($this->arValues);
    }
    
    protected function getTitle(){
        $culture = sfContext::getInstance()->getUser()->getCulture();
        return  json_encode($this->arTitle[$culture]);
    }
    
    protected function getWidth(){
        return json_encode($this->width);
    }
    
    protected function getHeight(){
        return json_encode($this->height);
    }

    protected function getJavascript() {

        $js = "
        <script type='text/javascript'>
        
        	function drawGeoChart() {
        	
        		var width = {$this->getWidth()};
                var height = {$this->getHeight()};
                var target = {$this->getName('json')};
                var values = {$this->getValues()};
                var cols = {$this->getColumns()};
                
        	
			    var data = new google.visualization.DataTable();
			    
			    for(var i in cols){
                    //alert(i+': '+cols[i]);
                    data.addColumn(cols[i],i);
                }
			    
			    //data.addColumn('string', 'Country');
			    //data.addColumn('number', 'Popularity');
			    
			    for(var i in values){
                    data.addRow([i, parseInt(values[i])]); 
                    //alert(i+': '+values[i]);
                }
			    
                /*
			    data.addRows([
			      ['Germany', 200],
			      ['United States', 300],
			      ['Brazil', 400],
			      ['Canada', 500],
			      ['France', 600],
			      ['RU', 700]
			    ]);
				*/
			    var options = {
			    	width: width,
			    	height: height,
    				colorAxis: {colors: ['#c4df9b', '#005826']}
    			};
			
			    var chart = new google.visualization.GeoChart(document.getElementById(target));
			    chart.draw(data, options);
			};
        

            function drawPieChart(type) {
        
                var data = new google.visualization.DataTable();
            
                var cols = {$this->getColumns()};
                var values = {$this->getValues()};
                var title = {$this->getTitle()};
                var width = {$this->getWidth()};
                var height = {$this->getHeight()};
                var target = {$this->getName('json')};
                //alert(target);
                
                for(var i in cols){
                    //alert(i+': '+cols[i]);
                    data.addColumn(cols[i],i);
                }
                
                for(var i in values){
                    data.addRow([i, parseInt(values[i])]); 
                    //alert(i+': '+values[i]);
                }

                // Set chart options
                var options = {'title':title,
                                 'width':width,
                                 'height':height};

                // Instantiate and draw our chart, passing in some options.
                
                switch (true) {
                    case type == 'PieChart':
                        var chart = new google.visualization.PieChart(document.getElementById(target));
                        break;

                    case type == 'ColumnChart':
                        var chart = new google.visualization.ColumnChart(document.getElementById(target));
                        break;

                }
                
                chart.draw(data, options);

            }
                
                
            function drawMultiColumnChart(){
                
                var data = new google.visualization.DataTable();   
                
                var target = {$this->getName('json')};
                var cols = {$this->getColumns()};
                var values = {$this->getValues()};
                var title = {$this->getTitle()};
                var width = {$this->getWidth()};
                var height = {$this->getHeight()};
                
                for(var i in cols){
                    //ADS.log.write(cols[i]+ ': '+i);
                    data.addColumn(cols[i],i);
                }
                
                
                for(var i in values){
                    
                    var tmp = new Array(i);
                
                    for(var j in values[i]){
                        //ADS.log.write(j+': '+values[i][j]);
                        tmp.push(values[i][j]);
                    }
                    data.addRow(tmp);
                    //alert(tmp);
                
                }
                
                //alert(cols);
                //alert(target);
                
                
                     
        
                //data.addColumn('string', 'OS');
                //data.addColumn('number', 'Firefox');
                //data.addColumn('number', 'Safari');
                //data.addColumn('number', 'Opera');
                //data.addColumn('number', 'IE');
                
                /*
                data.addRows([
                  ['Mac', 300, 400,300,0,100],
                  ['Windows', 300, 30,10,450,100],
                  ['Linux', 300, 00,200,0,100],
                  ['Iphone', 0, 300,0,0,100]
                ]);
                */

                var options = {
                  width: width, 
                  height: height,
                  title: title,
                  hAxis: {title: 'Operating System'}
                };

                var chart = new google.visualization.ColumnChart(document.getElementById(target));
                chart.draw(data, options);
                
                
                
            }
            

        </script>";

        return $js;
    }

    /**
     * Retrieve file path for historic file for each user folder
     * @return array of file path
     */
    static function getHistoricFiles() {

        $files = sfFinder::type('folder')->name('historic')->maxDepth(1)->in(sfConfig::get('sf_cache_dir'));

        return $files;
    }

    /**
     * Read historic files in each user folder, save each entry in the db 
     * and flush it once saved
     */
    static function saveInDB() {

        $files = self::getHistoricFiles();

        foreach ($files as $file) {

            $entries = file($file);
            
            $total = count($entries)-1;

            foreach ($entries as $key => $entry) {
            	
            	/* Do not save in db if:
            	 * - no culture
            	 * - if 2 following rows are strictly identical
            	 * - ... to complete
            	 */
            	
                
                
                $tsop = 0;
                $datas = explode('|', $entry);
                
                $date1 = new DateTime($datas[0]);
                $parameters = unserialize($datas[7]);
                
                
                
                
                if($key < $total){
                    $nextEntry = $entries[++$key];
                    $nextDatas = explode('|', $nextEntry);
                    $date2 = new DateTime($nextDatas[0]);
                    
                    $interval = $date1->diff($date2);
                    $tsop = Utils::getDateIntervalValue($interval);
                }

                $historic = new Historic();
                $historic->setDate($date1->format('Y-m-d H:i:s'));
                $historic->setTsop($tsop);
                if($datas[1] == '127.0.0.1'){
                	//$historic->setIp('173.230.162.100');
                	$historic->setIp(self::$arIps[rand(0,count(self::$arIps)-1)]);
                }else{
                	$historic->setIp($datas[1]);
                }
                
                $historic->setFolder($datas[2]);
                $historic->setAgent($datas[3]);

                $tmp = Utils::getUserAgent($datas[3]);

                $historic->setOs($tmp['os']);
                $historic->setBrowser($tmp['browser']);
                $historic->setVersion($tmp['version']);

                //$historic->setLanguage(Utils::getLanguage($datas[4]));
                if(!isset($parameters['sf_culture'])){
                	$parameters['sf_culture'] = 'en_US';
                }
                
                $historic->setLanguage($parameters['sf_culture']);
                $historic->setModule($parameters['module']);
                $historic->setAction($parameters['action']);
                
                
                $historic->setUri($datas[4]);
                $historic->setSTId($datas[5]);
                $historic->setFilename($datas[6]);
                $historic->setParameters(unserialize($datas[7]));
                $historic->setScrubbed(false);
                $historic->setSessionId($datas[8]);
                $historic->save();
                
                
            }

            file_put_contents($file, '');
            
        }
        
        //Retrieve IPs for country_id is NULL
        $ips = Doctrine::getTable('historic')->getIPsWithCountryIdNull();
        //var_dump($ips);

        //Retreive country_id for these IPs from IPMapping table
        $ipMapping = Doctrine::getTable('IpMapping')->getCountryIdFromIps($ips);
        //var_dump($ipMapping);
        
        //Assigned country_id to historic
        $historics = Doctrine::getTable('historic')->getByCountryIsNULL();
        //var_dump(count($historics));
        
        //Loop through historic object and save country_id
        foreach($historics as $historic){
        	
        	$ipNumeric = Utils::convertIpToNumeric($historic->getIp());
        	
			foreach($ipMapping as $ipMap){
				
				if($ipNumeric > $ipMap['ip_from'] && $ipNumeric < $ipMap['ip_to']){
					//echo 'country id is: '.$ipMap['country_id'];
					$historic->setCountryID($ipMap['country_id']);
					$historic->save();
					
				}
			}
        }
    }

}

