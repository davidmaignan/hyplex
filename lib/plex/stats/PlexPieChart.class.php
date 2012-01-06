<?php

/**
 * Description of PlexPieChart
 *
 * @author david
 */
class PlexPieChart extends PlexStats implements PlexChartInterface {
    //put your code here
     
        
    public function __toString() {
        $string = '';
        $string .= $this->getJavascript();
        $string .= $this->render();
        
        
        return $string;
        
    }
    
    public function render(){
        
        $js = "<script type='text/javascript'>drawPieChart('PieChart');</script>";
        $div = '<div id="'.$this->getName().'"></div>';
        
        return $div.$js;
        
    }
    
}


