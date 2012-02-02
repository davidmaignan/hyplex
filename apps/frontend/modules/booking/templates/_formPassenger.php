<h4 class=" minMargin bold color2"><?php echo __($type). ' ' .($key+1) ?></h4>
<div class="span-18">
    <div class="span-11" style="border-right: 1px dotted #aaaaaa;">
    <table class="append-bottom">
        <tr>
            <td class="first"><?php echo $f['salutation']->renderLabel(); ?></td>
            <td class="second"><?php echo $f['salutation']; ?></td>
            <td class="third"><?php echo $f['salutation']->renderError(); ?></td>
        </tr>
        <tr>
            <td class="first"><?php echo $f['first_name']->renderLabel(); ?></td>
            <td><?php echo $f['first_name']->render(array('class'=>'text span-4')); ?></td>
            <td><?php echo $f['first_name']->renderError(); ?></td>
        </tr>
        <tr>
            <td class="first"><?php echo $f['middle_name']->renderLabel(); ?></td>
            <td><?php echo $f['middle_name']->render(array('class'=>'text span-4')); ?></td>
            <td><?php echo $f['middle_name']->renderError(); ?></td>
        </tr>
        <tr>
            <td class="first"><?php echo $f['last_name']->renderLabel(); ?></td>
            <td><?php echo $f['last_name']->render(array('class'=>'text span-4')); ?></td>
            <td><?php echo $f['last_name']->renderError(); ?></td>
        </tr>
        <tr>
            <td style="padding: 8px 0;"><?php echo $f['gender']->renderLabel(); ?></td>
            <td><?php echo $f['gender']; ?></td>
            <td><?php echo $f['gender']->renderError(); ?></td>
        </tr>
        <tr>
            <td class="first"><?php echo $f['dob']->renderLabel(); ?></td>
            <td><?php echo $f['dob']->render(array('class'=>'text span-3 dob')); ?></td>
            <td><?php echo $f['dob']->renderError(); ?></td>
        </tr>
    </table>
    </div>
    <div class="span-6 last">
    <table>
        
        <tr>
            <td>
                <?php echo $f['frequent_flyer_number']->renderLabel(); ?><br />
                <?php echo $f['frequent_flyer_number']->render(array('class'=>'text span-4')); ?>
            </td>
        </tr>
        <tr>
            <td>
                <?php echo $f['airline_code']->renderLabel(); ?><br />
                <?php echo $f['airline_code']->render(array('class'=>'text span-4 airline_code')); ?>
            </td>
        </tr>
        <tr>
            <td>
                <?php echo $f['meal_preference']->renderLabel(); ?><br />
                <?php echo $f['meal_preference']->render(array('class'=>'text span-4')); ?>
            </td>
        </tr>
        <tr>
            <td>
                <?php echo $f['special_assistance']->renderLabel(); ?><br />
                <?php echo $f['special_assistance']; ?>
            </td>
        </tr>
    </table>
    </div>
</div>
<hr class="space2" />