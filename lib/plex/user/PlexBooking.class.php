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
    	
    	$string = '<table>';
    	
    	//Passengers
    	$string .= '<tr><td>Passengers:</td><td colspan="12">';
    	foreach($this->passengers as $key=>$passenger){
    		$string .= $this->getPassengerName($key).', ';
    	}
    	$string .= '</td></tr>';
    	
    	
    	//var_dump($this->passengers);
    	
    	if($this->flight){
    		$string .= $this->flight->displayParamsBookingTable();
    	}
    	
    	if($this->hotel){
    		
    		//var_dump($this->rooms);
    		//var_dump($this->hotel);
    		//exit;
    		
    		$string .= $this->hotel->displayParamsBookingTable($this->rooms);
    	}
    	
    	$string .= '<td><span class="legend blue">Total Price</span></td><td colspan="12">'. $this->getTotal().'</td></tr></table>';
    	
    	return $string;
    	
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
    	
    	//var_dump($this->address);
    	
    	$string = '';
    	$string .= $this->address['address_1'];
    	$string .= ($this->address['address_2'])? ', '.$this->address['address_2']: '';
    	$string .= '<br />'.$this->address['city'];
    	$string .= '<br />'.$this->address['postcode'];
    	$string .= ($this->address['state'])? '<br />'.$this->address['address_2']: '';
    	//$string .= ', '.$this->address['country'];
    	
    	return $string;
    	
        return $this->address;
    }
    
    public function getCountry(){
    	return $this->address['country'];
    }
    
    public function getTelephone(){
    	return $this->address['telephone'];
    }
    
    public function getEmail(){
        return $this->address['email'];
    }
    
    public function getPassword(){
        return $this->address['password'];
    }
    
    public function getUsername(){
        return strtolower($this->address['first_name']).strtolower($this->address['last_name']);
    }
    
    public function getHotelParameters(){
        
        return PlexParsing::retreiveParameters($this->getHotelFilename());
        
        
    }
  	
	public function getTotal(){
		
		$total = 0;
		
		if($this->getFlight()){
			$total += (float)($this->getFlight()->TotalPrice);
		}
		
		if($this->getHotel()){
			$total += $this->getHotel()->getTotalPrice();
		}
		
		
		
		return $total;
		
	}

}

