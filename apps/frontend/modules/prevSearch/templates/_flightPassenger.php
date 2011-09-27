<?php echo format_number_choice(
        '[0]|[1]1 adult,  |(1,+Inf]%1% adults, ', array('%1%' => $flightParameters->getAdults()), $flightParameters->getAdults()) ?>
<?php echo format_number_choice(
        '[0]|[1]1 child, |(1,+Inf]%1% children,  ', array('%1%' => $flightParameters->getChildren()), $flightParameters->getChildren()) ?>
<?php echo format_number_choice(
        '[0]|[1]1 infant  |(1,+Inf]%1% infants', array('%1%' => $flightParameters->getInfants()), $flightParameters->getInfants()) ?>