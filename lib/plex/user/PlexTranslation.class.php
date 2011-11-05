<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PlexTranslation
 *
 * @author david
 */
class PlexTranslation {
    //put your code here

    public $originFile;
    public $directory;
    public $destinationFile;


    public $arDatas = array();


    public function  __construct($directory, $file) {

        $originFile = $directory.$file;

        //echo $originFile;

        if(!file_exists($originFile)){
            //echo 'hrere';
            throw new Exception('No origin file exist to translate');
        }else{
            //echo 'exist';
        }

        $this->originFile = $originFile;

        //$this->getDataToTranslate($originFile);
        //var_dump($this->arDatas);
        //$this->displayArDatas();

        //$this->getTranslatedText($directory.'translated.txt');

        //$this->saveTranslatedText($directory);


    }


    public function getDataToTranslate($file){


        $handle = fopen($file, 'r+b');

        if(!$handle){
            throw new Exception("You don't have the permission to open this file: $file");
        }


        while(!feof($handle)){

            $content = fgets($handle);
            //echo preg_match('#<source>.+</source>#', $content);
            if(preg_match('#<source>.+</source>#', $content) > 0){

                $data = substr($content, 16, -10);
                //echo trim($data);
                array_push($this->arDatas, array('en'=>$data));
                //echo htmlentities($content);
                //echo "<br />";
            }

        }

        fclose($handle);
        

    }

    public function displayArDatas(){

        echo "<ul>";

        foreach($this->arDatas as $value){

            echo "<li>".$value['en']."</li>";

        }

        echo "</ul>";
        
    }

    public function getTranslatedText($filename){

        $i=0;

        $handle = fopen($filename, 'r');
        while(!feof($handle)){

            $content = fgets($handle);
            $this->arDatas[$i]['zh'] = trim($content);

            $i++;
        }

        fclose($handle);

        var_dump($this->arDatas);

    }


    public function saveTranslatedText($directory){

        $string = '<?xml version="1.0" encoding="UTF-8"?>
                    <!DOCTYPE xliff PUBLIC "-//XLIFF//DTD XLIFF//EN" "http://www.oasis-open.org/committees/xliff/documents/xliff.dtd">
                    <xliff version="1.0">
                      <file source-language="EN" target-language="zh" datatype="plaintext" original="messages" date="2011-11-04T17:01:24Z" product-name="messages">
                        <header/>
                        <body>';


        foreach ($this->arDatas as $key => $value) {

            $string .= '<trans-unit id="'.$key.'">
                            <source>'. $value['en'] .'</source>
                            <target>'.$value['zh'].'</target>
                        </trans-unit>';


        }

        $string .= '</body></file></xliff>';

        $finalFile = $directory.'test.xml';

        //echo $finalFile;
        //file_put_contents($finalFile, $string);
        //chmod($finalFile, 0777);
    }



}

