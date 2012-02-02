<?php

class PlexGeoChart extends PlexStats implements PlexChartInterface{
	
    public function __toString() {
        $string = '';
        $string .= $this->getJavascript();
        $string .= $this->render();
        
        
        return $string;
        
    }
    
    public function render(){
        
        $js = "<script type='text/javascript'>drawGeoChart();</script>";
        $div = '<div id="'.$this->getName().'"></div>';
        
        return $div.$js;
        
    }
    
}