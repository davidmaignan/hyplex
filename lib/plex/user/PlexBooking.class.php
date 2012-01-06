<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PlexBooking
 *
 * @author david
 */
class PlexBooking {
    //put your code here

    private $passengers = array();
    private $address = array();
    private $date;
    private $bookingId;
    private $user_folder;
    private $rooms = array();

    private $flightFilename;
    private $flight;

    private $hotel;
    private $hotelFilename;

    public function  __construct($values) {

        foreach($values as $key=>$values){

            $this->$key = $values;

        }

    }

    public function  __toString() {
        return "Implement toString in PlexBooking object to display parameters";
    }

    public function getCustomer(){

        return  $this->passengers[1]['salutation']. ' ' .
                $this->passengers[1]['first_name']. ' ' .
                $this->passengers[1]['last_name'];

    }

    public function getBookingId(){
        return $this->bookingId;
    }

    public function getPassengers(){
        return $this->passengers;
    }

    public function getFlight(){
        return $this->flight;
    }

    public function getHotel(){
        return $this->hotel;
    }

    public function getPassengerName($id){

        return $this->passengers[$id]['salutation']. ' '.
                $this->passengers[$id]['first_name'].' '.
                $this->passengers[$id]['last_name'];

    }


    public function getPassengerRoom($id){

        $passengerIDs = $this->rooms['rooms'][$id];

        $tmp = array();

        foreach ($passengerIDs as $passengerID) {
            array_push($tmp , $this->getPassengerName($passengerID));
        }

        return $tmp;

    }

    public function getFlightFilename(){
        return $this->flightFilename;
    }

    public function getHotelFilename(){
        return $this->hotelFilename;
    }

    public function getAddress(){
        return $this->address;
    }
    
    public function getHotelParameters(){
        
        return PlexParsing::retreiveParameters($this->getHotelFilename());
        
        
    }
  	
	public function getTotal(){
		
		$total = 0;
		
		$total = (float)($this->getFlight()->TotalPrice);
		$total += $this->getHotel()->getTotalPrice();
		
		return $total;
		
	}

}

