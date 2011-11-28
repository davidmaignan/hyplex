/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

var myWidth = 1400;
var myHeight = 0;

$('document').ready(function(){

    $('input[type=submit], a.button, a.add, a.select').click(function(){
         $( "#dialog-message" ).dialog({
            modal: true,
            buttons: {
                Cancel: function() {
                    $( this ).dialog( "close" );
                    //Cancel the request sent
                    //ajaxRequest.abort();
                }
            }
        });
    });


    

});


function alertSize() {
  //var myWidth = 0, myHeight = 0;
  if( typeof( window.innerWidth ) == 'number' ) {
    //Non-IE
    myWidth = window.innerWidth;
    myHeight = window.innerHeight;
  } else if( document.documentElement && ( document.documentElement.clientWidth || document.documentElement.clientHeight ) ) {
    //IE 6+ in 'standards compliant mode'
    myWidth = document.documentElement.clientWidth;
    myHeight = document.documentElement.clientHeight;
  } else if( document.body && ( document.body.clientWidth || document.body.clientHeight ) ) {
    //IE 4 compatible
    myWidth = document.body.clientWidth;
    myHeight = document.body.clientHeight;
  }
  //window.alert( 'Width = ' + myWidth );
  //window.alert( 'Height = ' + myHeight );

  //return myWidth;
}