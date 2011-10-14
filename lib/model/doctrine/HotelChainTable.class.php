<?php

/**
 * HotelChainTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class HotelChainTable extends Doctrine_Table
{
    /**
     * Returns an instance of this class.
     *
     * @return object HotelChainTable
     */
    public static function getInstance()
    {
        return Doctrine_Core::getTable('HotelChain');
    }

    public function saveList($array)
    {
        foreach ($array as $key => $value) {
            $hotelChain = new HotelChain();
            $hotelChain->setTag($value);
            $hotelChain->setName($value);
            
            try{
                $hotelChain->save();
            }  catch (Doctrine_Exception $e){
                //var_dump($e);
                //exit;
                //echo 'error doctrine';
                //exit;
            }
        }

    }

}