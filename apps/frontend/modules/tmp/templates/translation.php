<?php

echo __('New translation');

format_number_choice( '[0]|[1]1 adult|(1,+Inf]%1% adults', array('%1%' =>0), 0);
format_number_choice( '[0]|[1]1 child|(1,+Inf]%1% children', array('%1%' =>0), 0);
format_number_choice( '[0]|[1]1 infant|(1,+Inf]%1% infants', array('%1%' =>0), 0);
format_number_choice( '[0]|[1]aged %1% year old|(1,+Inf]aged %1% years old', array('%1%' =>''),0);
format_number_choice( '[0]|[1]aged %1% year old|(1,+Inf]aged %1% years old', array('%1%' =>''),0);
format_number_choice( '[0]|[1]1 child between 2 and 12 years old|(1,+Inf]%1% children between 2 and 12 years old',
                         array('%1%'=>0),0);
format_number_choice( '[0]|[1]1 infant under 2 years old|(1,+Inf]%1% infants under 2 years old',
                         array('%1%'=>0),0);
format_number_choice( '[0]|[1]1 child %2%|(1,+Inf]%1% children %2%',
                         array('%1%'=>0, '%2%'=> 0),0);
format_number_choice( '[0]|[1]1 night|(1,+Inf]%1% nights', array('%1%' =>0), 0);
format_number_choice( '[0]|[1]1 room|(1,+Inf]%1% rooms', array('%1%' =>0), 0);

__('Layover for ');
__("Stops");
__("Flight Times");
__("Take-off");
__("Airlines");
__("Flight quality");
__("Trip duration");
__("Price");
__("Return flight");
__("Depart flight");
__('Non stop');
__('Operated by');
__("Average Nightly Rate");
__("Is our pick");
__('hotels');
__("Location");
__('View more');
__("Hotel chain");
__('search');
__(' hotels found');
__('Clear selected filter');
__("Name contains");

__("This flight is priced for %1% at the time of travel but you entered %2%");
__("This hotel is priced for %1% at the time of travel but you entered %2%");
