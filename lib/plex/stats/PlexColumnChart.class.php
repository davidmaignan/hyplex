<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PlexColumnChart
 *
 * @author david
 */
class PlexColumnChart extends PlexStats implements PlexChartInterface {
    
    public function __toString() {
        $string = '';
        $string .= $this->getJavascript();
        $string .= $this->render();
        
        
        return $string;
        
    }
    
    public function render(){
        
        $js = "<script type='text/javascript'>drawPieChart('ColumnChart');</script>";
        $div = '<div id="'.$this->getName().'"></div>';
        
        return $div.$js;
        
    }
}


