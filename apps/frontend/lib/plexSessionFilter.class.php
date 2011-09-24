<?php

/**
 * Description of plexSessionFilter
 * Filter to renew a n time the sTId when a long period of inactivity by the user
 *
 *
 * @author david
 */
class plexSessionFilter extends sfFilter {


    public function execute($filterChain){

        

        $filterChain->execute();

       
        $user = $this->getContext()->getUser();
        

        //var_dump($user->getAttribute('sTId'));
        //$user->setAttribute('sTId', null);
        //$user->setAttribute('sTId_time', null);

        if($user->getAttribute('sTId') != null && $user->getAttribute('sTId_time') && $user->hasAttribute('sTId')){

             //How much time before renewing sTId
             $restTime = $user->getAttribute('sTId_time') - time();
             //ob_start();
             //var_dump($restTime);
             $restTime = ($restTime > 0)?$restTime:0;

             //var_dump($restTime);

             $url = $this->getContext()->getController()->genUrl(array('sf_route'=>'session_renew',
                                                                            'time'=>$restTime));
             

             $timerCode = '<script type="text/javascript">
                        $("document").ready(function(){
                            //sTID_time = '.$user->getAttribute('sTId_time').';
                            //alert("document ready inside plexSessionFilter");
                            plexStidRenewal("'.$url.'");
                        });

                      </script>';

            $response = $this->getContext()->getResponse();

            $response->setContent(str_ireplace('</body>', $timerCode.'</body>', $response->getContent()));


        }

        // Decorate the response with the timer code

       


        //echo "<pre>";
        //var_dump($response->getJavascripts());
       

        

        //exit;

    }


}
?>
