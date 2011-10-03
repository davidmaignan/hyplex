<?php use_javascript('search/airlines.js'); ?>
<style>
	.ui-autocomplete {
		max-height: 100px;
		overflow-y: auto;
		/* prevent horizontal scrollbar */
		overflow-x: hidden;
		/* add padding to account for vertical scrollbar */
		padding-right: 20px;
	}
	/* IE 6 doesn't support max-height
	 * we use height instead, but this forces the menu to always be this tall
	 */
	* html .ui-autocomplete {
		height: 100px;
	}
	</style>

<div class="span-26 last append-bottom">
    <h2 class="title">Passengers information</h2>
    <p>All traveler information must match exactly what is on the government-issued ID you use when traveling.</p>

    <?php if($form->hasGlobalErrors()): ?>
        <ul class="error-global">
           <?php foreach ($form->getGlobalErrors() as $name => $error): ?>
              <li class=""><?php echo $error ?></li>
            <?php endforeach; ?>
        </ul>
        <?php endif; ?>
        <?php echo $form; ?>
    

    <form action="<?php echo url_for('@booking_passenger') ?>" method="post">
        <?php foreach ($form['passengers'] as $key => $f): ?>
        <div class="span-19">
            <table class="append-bottom">
                <tr>
                    <td>
                        <ul>
                            <li><?php echo $f['salutation']->renderLabel(); ?></li>
                            <li><?php echo $f['salutation']; ?></li>
                            <li><?php echo $f['salutation']->renderError(); ?></li>
                        </ul>
                    </td>
                    <td>
                        <ul>
                            <li><?php echo $f['first_name']->renderLabel(); ?></li>
                            <li><?php echo $f['first_name']; ?></li>
                            <li><?php echo $f['first_name']->renderError(); ?></li>
                        </ul>
                    </td>
                    <td>
                        <ul>
                            <li><?php echo $f['last_name']->renderLabel(); ?></li>
                            <li><?php echo $f['last_name']; ?></li>
                            <li><?php echo $f['last_name']->renderError(); ?></li>
                        </ul>
                    </td>
                    <td>
                        <ul>
                            <li><?php echo $f['dob']->renderLabel(); ?></li>
                            <li><?php echo $f['dob']; ?></li>
                            <li><?php echo $f['dob']->renderError(); ?></li>
                        </ul>
                    </td>
                </tr>
                <tr>
                    <tr>
                        <td></td>
                    <td>
                        <ul>
                            <li><?php echo $f['frequent_flyer_number']->renderLabel(); ?></li>
                            <li><?php echo $f['frequent_flyer_number']; ?></li>
                            <li><?php echo $f['frequent_flyer_number']->renderError(); ?></li>
                        </ul>
                    </td>
                    <td>
                        <ul>
                            <li><?php echo $f['airline_code']->renderLabel(); ?></li>
                            <li><?php echo $f['airline_code']; ?></li>
                            <li><?php echo $f['airline_code']->renderError(); ?></li>
                        </ul>
                    </td>
                    <td>
                        <ul>
                            <li><?php echo $f['meal_preference']->renderLabel(); ?></li>
                            <li><?php echo $f['meal_preference']; ?></li>
                            <li><?php echo $f['meal_preference']->renderError(); ?></li>
                        </ul>
                    </td>
                    <td>
                        <ul>
                            <li><?php echo $f['special_assistance']->renderLabel(); ?></li>
                            <li><?php echo $f['special_assistance']; ?></li>
                            <li><?php echo $f['special_assistance']->renderError(); ?></li>
                        </ul>
                    </td>
                </tr>
            </table>
            <?php echo $f['gender']; ?>
            <?php echo $f['p_type']->render(array('value'=>'ADT')); ?>
            <?php echo $f['gender']->render(array('value'=>'M')); ?>
            <?php //echo $form['type']; ?>
            <?php echo $form['_csrf_token']; ?>
            </div>
        <hr />
        <?php endforeach; ?>

        <div class="span-8 last right append-bottom">
            <input type="submit" value="<?php echo __('next'); ?>" class="next" />
        </div>
        <?php //echo $form['type']; ?>
        <?php //echo $form['_csrf_token']; ?>
    </form>
</div>


<script type="text/javascript">


    $('document').ready(function(){

    $(".dob").mask("9999-99-99");

var projects = [
			{
				value: "jquery",
				label: "jQuery",
				desc: "the write less, do more, JavaScript library",
				icon: "jquery_32x32.png"
			},
			{
				value: "jquery-ui",
				label: "jQuery UI",
				desc: "the official user interface library for jQuery",
				icon: "jqueryui_32x32.png"
			},
			{
				value: "sizzlejs",
				label: "Sizzle JS",
				desc: "a pure-JavaScript CSS selector engine",
				icon: "sizzlejs_32x32.png"
			}
		];

		$( ".airline_code" ).autocomplete({
                        autoFocus: true,
			minLength: 2,
                        delay: 200,
			source: airlines,
			select: function( event, ui ) {
				$( this ).val( ui.item.label );
				return false;
			}
		})
		.data( "autocomplete" )._renderItem = function( ul, item ) {
			return $( "<li></li>" )
				.data( "item.autocomplete", item )
				.append( "<a>" + item.label + "</a>" )
				.appendTo( ul );
		};



        
    });

</script>