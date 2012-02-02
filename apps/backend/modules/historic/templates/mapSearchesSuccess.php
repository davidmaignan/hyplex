<?php use_javascript('debugger/ADS-final-verbose.js'); ?>
<?php use_javascript('debugger/myLogger.js'); ?>
<?php use_javascript('gmap/infobubble-compiled'); ?>

<?php include_partial('navigation')?>

<div id="mainContent" style="padding:0; margin-top:0;">

<div id="gmap_canvas"></div>


<?php echo $searches; ?>

</div>

<script type="text/javascript">
var searches = <?php echo $sf_data->get('searches','ESC_RAW');?>;

var gMapResutlPage;
var markers = [];
var infowindow;
var destinationsLatLng = [];
var markersDestination = [];
var gMapBounds;
var iterator = 0;
var infoBubbleHotel;

$('document').ready(function(){

	var latlng = new google.maps.LatLng(10, 0);

    var myOptions = {
      zoom: 2,
      center: latlng,
      mapTypeId: google.maps.MapTypeId.ROADMAP,
      scrollwheel: false
    };

    gMapResultPage = new google.maps.Map(document.getElementById("gmap_canvas"), myOptions);

    google.maps.event.addListener(gMapResultPage, 'rightclick',function(event){
		
		gMapBounds = new google.maps.LatLngBounds();

		for(var i in markersDestination){
			markersDestination[i].setVisible(false);
		}
		
		for(var i in markers){
			markers[i].setVisible(true);
			gMapBounds.extend(markers[i].getPosition());
		}
		
		gMapResultPage.fitBounds(gMapBounds);
    });

    var flights = searches.flight;

    gMapBounds = new google.maps.LatLngBounds();

    for(var i in flights)
    {
       //ADS.log.write(i+': '+flights[i]);
       createMarker(i, flights[i]);
    }

    gMapResultPage.fitBounds(gMapBounds);
    //gMapResultPage.setZoom(6);
	
    //ADS.log.write(markers);
	//alert('here');

});

function createMarker(id, a){

	//ADS.log.write(a.longitude);
	
    var latitude = parseFloat(a.latitude);
    var longitude = parseFloat(a.longitude);

    var myLatlng = new google.maps.LatLng(latitude, longitude);

    //var markerImage = '/images/gmap/marker-hotel-on.png';
    gMapBounds.extend(myLatlng);

    var marker = new google.maps.Marker({
        position: myLatlng,
        map: gMapResultPage,
        title:id,
        draggable: false,
        //icon: markerImage
        //animation: google.maps.Animation.DROP
    });

    marker.id = id;

    markers.push(marker);

    google.maps.event.addListener(marker, 'click', function(event){
    	//drawLines(this.id);
		showDestinations(this.id);
    });
	
    
    //addMarkerFunctionality(marker, id, a);
    
}

function showDestinations(id){

	gMapBounds = new google.maps.LatLngBounds();
	
	markersDestination = [];
	//ADS.log.write(markersDestination.length);

	var target;

	//hide all the others markers except the clicked on
	for(var i in markers){
		if(markers[i].id != id){
			markers[i].setVisible(false);
		}else{
			target = markers[i];
		}
	}
	
	gMapResultPage.setCenter(target.getPosition());
	gMapBounds.extend(target.getPosition());

	//Create destination markers, fit the map to display all of them, add them to array, then loop to drop them
	var flights = searches.flight;

	var destinations = flights[id].destination;
	
	//ADS.log.write(destinations);

	for(var j in destinations){

		var latitude = parseFloat(destinations[j].latitude);
	    var longitude = parseFloat(destinations[j].longitude);

		var myLatlng = new google.maps.LatLng(latitude, longitude);
		gMapBounds.extend(myLatlng);

		//var markerImage = 'http://gmaps-samples.googlecode.com/svn/trunk/markers/red/blank.png';
		var marker = new google.maps.Marker({
		      position: myLatlng,
		      map: gMapResultPage,
		      draggable: false,
		      //icon: markerImage,
		      //animation: google.maps.Animation.DROP
		});
		marker.setVisible(false);
		markersDestination.push(marker);
		marker.origin = id;
		marker.destination = j;

		 google.maps.event.addListener(marker, 'click', function(event){

			 //alert(infowindow);
			 
			 if(infowindow != undefined){
				 infowindow.close();
			 }
			 
			 infowindow = new google.maps.InfoWindow({
			        content: getAirportData(this.origin, this.destination),
			        maxWidth: 200
			 });

			 infowindow.open(gMapResultPage,this);
			 
		    /*
			if (infoBubbleHotel != undefined)
	        {
	            infoBubbleHotel.close();
	        }
			 //Get data
			 var message = getAirportData(this.origin, this.destination);
			 
			 infoBubbleHotel = new InfoBubble({
			      map: gMapResultPage,
			      content: message,
			      position: getInfoBubblePosition(this),
			      shadowStyle: 0,
			      padding: 0,
			      backgroundColor: 'rgb(235,235,235)',
			      borderRadius: 0,
			      arrowSize: 1,
			      borderWidth: 1,
			      borderColor: '#FFFFFF',
			      disableAutoPan: true,
			      hideCloseButton: true,
			      arrowPosition: 30,
			      backgroundClassName: 'phoney',
			      arrowStyle: 2
			    });

			    infoBubbleHotel.open(); 
				*/
		    });
		
		//Add to array 
		destinationsLatLng.push(myLatlng);
	}

	

	gMapResultPage.fitBounds(gMapBounds);
	//gMapResultPage.setZoom(gMapResultPage.getZoom()-1);

	google.maps.event.addListenerOnce(gMapResultPage, 'tilesloaded', function() {
		//Reset iterator
		iterator = 0;
		drop();
	});
	
}

function getAirportData(ori, dest){

	var name = searches.flight[ori].destination[dest].info.name + ' ';
	name += searches.flight[ori].destination[dest].info.city_name + ', ';
	name += searches.flight[ori].destination[dest].info.country;
	//alert(name);

	
	var content = '<h3>'+dest+'</h3>';
	content += '<p>'+ name + '</p>';
	content += '<p>Number of searches: '+ searches.flight[ori].destination[dest].total + '</p>';

    return content;
}

function drop() {
    for (var i = 0; i < markersDestination.length; i++) {
      setTimeout(function() {
        //addMarker();
          markersDestination[iterator].setVisible(true);
          markersDestination[iterator].setAnimation(google.maps.Animation.DROP);
          iterator++;
      }, i * 200);
    }
  }


/*
function addMarker() {
	
	var markerImage = '/images/gmap/marker-hotel-viewed-on.png';
	var marker = new google.maps.Marker({
	      position: destinationsLatLng[iterator],
	      map: gMapResultPage,
	      draggable: false,
	      icon: markerImage,
	      animation: google.maps.Animation.DROP
	});

    google.maps.event.addListener(marker, 'click', function(event){
    	//drawLines(this.id);
		ADS.log.write
    });
	
	markersDestination.push(marker);
	
    iterator++;
}
*/
/*
 
 infoBubbleHotel = new InfoBubble({
      map: gMapResultPage,
      content: message,
      position: position,
      shadowStyle: 0,
      padding: 0,
      backgroundColor: 'rgb(235,235,235)',
      borderRadius: 0,
      arrowSize: 1,
      borderWidth: 1,
      borderColor: '#FFFFFF',
      disableAutoPan: true,
      hideCloseButton: true,
      arrowPosition: 30,
      backgroundClassName: 'phoney',
      arrowStyle: 2
    });

    infoBubbleHotel.open(); 
 
 */

function drawLines(id){

	//alert(id);

	var bermudaTriangle;

    var triangleCoords = [
        new google.maps.LatLng(25.774252, -80.190262),
        new google.maps.LatLng(18.466465, -66.118292),
        new google.maps.LatLng(32.321384, -64.75737),
        new google.maps.LatLng(25.774252, -80.190262)
    ];

    // Construct the polygon
    bermudaTriangle = new google.maps.Polygon({
      paths: triangleCoords,
      strokeColor: "#FF0000",
      strokeOpacity: 0.8,
      strokeWeight: 2,
      fillColor: "#FF0000",
      fillOpacity: 0.35
    });

   bermudaTriangle.setMap(gMapResultPage);

	
}

</script>