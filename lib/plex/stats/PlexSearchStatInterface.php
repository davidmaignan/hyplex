<?php

interface PlexSearchStatInterface{

    public function parseData($data);
    /**
     * Function to return all the list of codes from the object
     */
	public function getCodes();


}