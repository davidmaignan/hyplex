<?php

class myUser extends sfGuardSecurityUser {



    /**
     * Function called to identify if it's the first request
     * @param boolean $boolean
     * @return <type>
     */
    public function isFirstRequest($boolean = null) {

      if (is_null($boolean)) {
            return $this->getAttribute('first_request', true);
        } else {
            $this->setAttribute('first_request', $boolean);
        }
    }

}
