<?php //use_javascript('jquery-1.5.1.min.js'); ?>
<?php //use_javascript('jquery-ui-1.8.11.custom.min.js'); ?>
<?php use_javascript('myScript'); ?>
<?php use_javascript('functions.js'); ?>

<?php //use_javascript('jquery.bigframe.min.js'); ?>
<?php //use_javascript('thickbox-compressed.js'); ?>
<?php //use_javascript('jquery.autocomplete.min.js'); ?>


<?php use_javascript('fancybox/jquery.mousewheel-3.0.4.pack.js'); ?>
<?php use_javascript('fancybox/jquery.fancybox-1.3.4.pack.js'); ?>
<?php //use_javascript('search/searchFlight'); ?>
<?php //use_javascript('search/searchHotel'); ?>

<?php //use_javascript('search/airport_list_'.$sf_user->getCulture().'.js'); ?>
<?php //use_javascript('search/datepicker_'.$sf_user->getCulture().'.js'); ?>

<?php //use_stylesheet('fancybox/jquery.fancybox-1.3.4.css'); ?>
<?php //use_stylesheet('jquery.autocomplete.css'); ?>
<?php //use_stylesheet('thickbox.css'); ?>

<?php use_stylesheet('custom-theme/jquery-ui-1.8.16.custom.css'); ?>

<?php use_stylesheet('grid'); ?>
<?php use_stylesheet('typography'); ?>
<?php use_stylesheet('form'); ?>

<?php //use_javascript('debugger/ADS-final-verbose.js'); ?>
<?php //use_javascript('debugger/myLogger.js'); ?>

<?php //use_helper('Date', 'Number', 'I18n'); ?>

<br />
<input type="text" id="searchAirport" />
<div id="log"></div>
<hr />

<div class="span-12">

<input id="city" />
</div>
<div id="log2" class="span-10">log2</div>

<hr class="space3" />


<div class="demo">

<div class="ui-widget">
	<label>Your preferred programming language: </label>
	<select id="combobox">
		<option value="">Select one...</option>
		<option value="ActionScript">ActionScript</option>

		<option value="AppleScript">AppleScript</option>
		<option value="Asp">Asp</option>
		<option value="BASIC">BASIC</option>
		<option value="C">C</option>
		<option value="C++">C++</option>
		<option value="Clojure">Clojure</option>

		<option value="COBOL">COBOL</option>
		<option value="ColdFusion">ColdFusion</option>
		<option value="Erlang">Erlang</option>
		<option value="Fortran">Fortran</option>
		<option value="Groovy">Groovy</option>
		<option value="Haskell">Haskell</option>

		<option value="Java">Java</option>
		<option value="JavaScript">JavaScript</option>
		<option value="Lisp">Lisp</option>
		<option value="Perl">Perl</option>
		<option value="PHP">PHP</option>
		<option value="Python">Python</option>

		<option value="Ruby">Ruby</option>
		<option value="Scala">Scala</option>
		<option value="Scheme">Scheme</option>
	</select>
</div>
<button id="toggle">Show underlying select</button>

</div>

<style>

    strong{
        font-weight: bold;
        color: #ed145b;
    }

    #searchAirport{
        width: 250px;
    }


    /* demo */
    label
    {
            display:block;
    }


    /* autocomplete */
    input.autocomplete-loading
    {
            background-image:url(autocomplete.gif);
            background-position: center right;
            background-repeat:no-repeat;
    }
    ul.autocomplete
    {
        position: absolute;
        overflow: hidden;
        background-color: #fff;
        border: 1px solid ButtonShadow;
        margin: 0px;
        padding: 0px;
        list-style: none;
        color: #000;
            display:none;
            z-index:1000;
    }
    ul.autocomplete li
    {
      display: block;
      padding: 0.3em;
      overflow: hidden;
      width: 100%;
      cursor:pointer;
    }

    ul.autocomplete li.selected
    {
      background-color: Highlight ;
      color: #fff;
    }

</style>

<script>
/*
(function( $ ) {
		$.widget( "ui.combobox", {
			_create: function() {
				var self = this,
					select = this.element.hide(),
					selected = select.children( ":selected" ),
					value = selected.val() ? selected.text() : "";
				var input = this.input = $( "<input>" )
					.insertAfter( select )
					.val( value )
					.autocomplete({
						delay: 0,
						minLength: 0,
						source: function( request, response ) {
							var matcher = new RegExp( $.ui.autocomplete.escapeRegex(request.term), "i" );
							response( select.children( "option" ).map(function() {
								var text = $( this ).text();
								if ( this.value && ( !request.term || matcher.test(text) ) )
									return {
										label: text.replace(
											new RegExp(
												"(?![^&;]+;)(?!<[^<>]*)(" +
												$.ui.autocomplete.escapeRegex(request.term) +
												")(?![^<>]*>)(?![^&;]+;)", "gi"
											), "<strong>$1</strong>" ),
										value: text,
										option: this
									};
							}) );
						},
						select: function( event, ui ) {
							ui.item.option.selected = true;
							self._trigger( "selected", event, {
								item: ui.item.option
							});
						},
						change: function( event, ui ) {
							if ( !ui.item ) {
								var matcher = new RegExp( "^" + $.ui.autocomplete.escapeRegex( $(this).val() ) + "$", "i" ),
									valid = false;
								select.children( "option" ).each(function() {
									if ( $( this ).text().match( matcher ) ) {
										this.selected = valid = true;
										return false;
									}
								});
								if ( !valid ) {
									// remove invalid value, as it didn't match anything
									$( this ).val( "" );
									select.val( "" );
									input.data( "autocomplete" ).term = "";
									return false;
								}
							}
						}
					})
					.addClass( "ui-widget ui-widget-content ui-corner-left" );

				input.data( "autocomplete" )._renderItem = function( ul, item ) {
					return $( "<li></li>" )
						.data( "item.autocomplete", item )
						.append( "<a>" + item.label + "</a>" )
						.appendTo( ul );
				};

				this.button = $( "<button type='button'>&nbsp;</button>" )
					.attr( "tabIndex", -1 )
					.attr( "title", "Show All Items" )
					.insertAfter( input )
					.button({
						icons: {
							primary: "ui-icon-triangle-1-s"
						},
						text: false
					})
					.removeClass( "ui-corner-all" )
					.addClass( "ui-corner-right ui-button-icon" )
					.click(function() {
						// close if already visible
						if ( input.autocomplete( "widget" ).is( ":visible" ) ) {
							input.autocomplete( "close" );
							return;
						}

						// work around a bug (likely same cause as #5265)
						$( this ).blur();

						// pass empty string as value to search for, displaying all results
						input.autocomplete( "search", "" );
						input.focus();
					});
			},

			destroy: function() {
				this.input.remove();
				this.button.remove();
				this.element.show();
				$.Widget.prototype.destroy.call( this );
			}
		});
	})( jQuery );

	$(function() {
		$( "#combobox" ).combobox();
		$( "#toggle" ).click(function() {
			$( "#combobox" ).toggle();
		});
	});

*/
</script>



<script type="text/javascript">



    $('document').ready(function(){
        
        //ADS.log.header('autocomplete');

        /*

        $("#searchAirport").autocomplete('searchAirportComplete', {
                minChars: 3,
  		width: 300,
                autoFill: false,
                max: 20,
                highlight: function(value, search){
                    return highlight2(value, search);
                }
	});

        function log( message ) {
			$( "<div/>" ).text( message ).prependTo( "#log" );
                        
			$( "#log" ).scrollTop( 0 );
                        $('#city').val('test');
		}


        $( "#city" ).autocomplete({
			source: function( request, response ) {
				$.ajax({
					url: "searchAirportComplete",
					dataType: "json",
					data: {
						featureClass: "P",
						style: "full",
						maxRows: 12,
						name_startsWith: request.term
					},
                                        success: function( data) {

                                            response( $.map( data, function( item ) {
							return {
                                                                label: item.name,
								value: item
							}
						}));


                                            //alert(data[0]);
                                        }
					
				});
			},
			minLength: 2,
			select: function( event, ui ) {
                                
				log( ui.item ?
					"Selected: " + ui.item.label :
					"Nothing selected, input was " + this.value);
			},
			open: function() {
				$( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
			},
			close: function() {
				$( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
			}
		});


        */


        $(function() {
		function log( message ) {
			$("<div>"+message+"<div/>" ).prependTo( "#log" );
			$( "#log" ).scrollTop( 0 );
		}

                function log2( message ) {
			$( "#log2" ).appendTo(message);
		}

		$( "#city" ).autocomplete({
			source: function( request, response ) {
				$.ajax({
					url: "searchAirportComplete2",
					dataType: "json",
					data: {
						featureClass: "P",
						style: "full",
						maxRows: 12,
						name_startsWith: request.term
					},
					success: function( data ) {


                                                $('#log2').empty();
                                                $('#log2').append(request.term);

                                                $.map( data.values, function( item ) {
                                                     //$('#log2').append(item);
                                                     $('#log2').append('<br />');
                                                });


                                               

                                                //$('#log2').append(JSON.stringify(this));
                                                //$('#log2').append(arValues);
                                                //$('#log2').append('<br />');

						response( $.map( data.results, function( item ) {

                                                        var value = data.values[0];
                                                        //$('#log2').append(value);

                                                        var string = item.t_name+', '+ item.a_airport + ','+ item.u_country +' ('+ item.a_code +')';
                                                        string = highlight2(string, request.term);
                                                        
                                                        //var test = highlight2(string, value);
                                                        $('#log2').append(string+'<br />');

							return {
								label: string,
								value: item.t_name+', '+ item.a_airport + ','+ item.u_country +' ('+ item.a_code +')'
							}
						}));
					}
				});
			},
			minLength: 2,
			select: function( event, ui ) {
				log( ui.item ?
					"Selected: " + ui.item.label :
					"Nothing selected, input was " + this.value);
			},
			open: function() {
				$( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
			},
			close: function() {
				$( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
			}
		}).data('autocomplete')._renderItem = function( ul, item ) {
                    return $( "<li></li>" )
                        .data( "item.autocomplete", item )
                        .append( '<a>' + item.label + '</a>' )
                        .appendTo( ul );
                };

	});


    });

    function highlight2( data, search ){

        var values = search.split(' ');

        //alert(search);

        for(var i in values){
            if(values[i] != ''){
                values[i] = values[i].toLowerCase();
                data = data.replace( new RegExp( "(?!<[^<>]*)(" 
                    + $.ui.autocomplete.escapeRegex(values[i]) +
                    ")(?![^<>]*>)", "g"), "<strong>" + values[i] + "</strong>" );
                data = data.replace( new RegExp( "(?!<[^<>]*)("
                    + $.ui.autocomplete.escapeRegex(values[i].capitalize()) +
                    ")(?![^<>]*>)", "g"), "<strong>" + values[i].capitalize() + "</strong>" );
                data = data.replace( new RegExp( "(?!<[^<>]*)("
                    + $.ui.autocomplete.escapeRegex(values[i].toUpperCase()) +
                    ")(?![^<>]*>)", "g"), "<strong>" + values[i].toUpperCase() + "</strong>" );
                //data = data.replace( new RegExp( ( values[i].capitalize() ), 'g' ), "<strong>" + values[i].capitalize() + "</strong>" );
            }

        }

        return data;
    
        //return data.replace( new RegExp( preg_quote( values[0] ), 'gi' ), "<span style='font-weight:bold;color:#ED145B;'>" + values[0] + "</span>" );
    }

    String.prototype.toLower = function() {
        return this.charAt(0).toLowerCase() + this.slice(1);
    }

    String.prototype.capitalize = function() {
        return this.charAt(0).toUpperCase() + this.slice(1);
    }



</script>

