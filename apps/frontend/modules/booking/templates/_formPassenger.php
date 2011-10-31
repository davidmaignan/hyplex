<h6 class="append-bottom small bold color2"><?php echo ucfirst(__($type)). ' ' .($key+1) ?></h6>
<div class="span-18" style="border-bottom: 1px dotted #aaaaaa; padding-bottom: 18px; margin-bottom: 6px;">
    <div class="span-11" style="border-right: 1px dotted #aaaaaa;">
    <table class="passengers append-bottom">
        <tr>
            <td class="first"><?php echo $f['salutation']->renderLabel(); ?></td>
            <td class="second"><?php echo $f['salutation']; ?></td>
            <td class="third"><?php echo $f['salutation']->renderError(); ?></td>
        </tr>
        <tr>
            <td><?php echo $f['first_name']->renderLabel(); ?></td>
            <td><?php echo $f['first_name']; ?></td>
            <td><?php echo $f['first_name']->renderError(); ?></td>
        </tr>
        <tr>
            <td><?php echo $f['middle_name']->renderLabel(); ?></td>
            <td><?php echo $f['middle_name']; ?></td>
            <td><?php echo $f['middle_name']->renderError(); ?></td>
        </tr>
        <tr>
            <td><?php echo $f['last_name']->renderLabel(); ?></td>
            <td><?php echo $f['last_name']; ?></td>
            <td><?php echo $f['last_name']->renderError(); ?></td>
        </tr>
        <tr>
            <td style="padding: 8px 0;"><?php echo $f['gender']->renderLabel(); ?></td>
            <td><?php echo $f['gender']; ?></td>
            <td><?php echo $f['gender']->renderError(); ?></td>
        </tr>
        <tr>
            <td><?php echo $f['dob']->renderLabel(); ?></td>
            <td><?php echo $f['dob']; ?></td>
            <td><?php echo $f['dob']->renderError(); ?></td>
        </tr>
    </table>
    </div>
    <div class="span-6 last">
    <table>
        
        <tr>
            <td>
                <ul>
                    <li><?php echo $f['frequent_flyer_number']->renderLabel(); ?></li>
                    <li><?php echo $f['frequent_flyer_number']; ?></li>
                </ul>
            </td>
        </tr>
        <tr>
            <td>
                <ul>
                    <li><?php echo $f['airline_code']->renderLabel(); ?></li>
                    <li><?php echo $f['airline_code']; ?></li>
                </ul>
            </td>
        </tr>
        <tr>
            <td>
                <ul>
                    <li><?php echo $f['meal_preference']->renderLabel(); ?></li>
                    <li><?php echo $f['meal_preference']; ?></li>
                </ul>
            </td>
        </tr>
        <tr>
            <td>
                <ul>
                    <li><?php echo $f['special_assistance']->renderLabel(); ?></li>
                    <li><?php echo $f['special_assistance']; ?></li>
                </ul>
            </td>
        </tr>
    </table>
    </div>
</div>
<hr class="space2" />