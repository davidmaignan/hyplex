<?php use_helper('I18N', 'Date') ?>
<?php include_partial('citymetro/assets') ?>

<div id="sf_admin_container">
    <h1><?php echo __('Citymetro List', array(), 'messages') ?></h1>

    <?php include_partial('citymetro/flashes') ?>

    <div id="sf_admin_content">

        <div class="sf_admin_list">

            <table cellspacing="0">
                <thead>
                    <tr>
                      
                        <th><?php echo __('code'); ?></th>
                        <th><?php echo __('city'); ?></th>
                        <th><?php echo __('country'); ?></th>
                        <th><?php echo __('list of associated airports'); ?></th>
                    </tr>
                </thead>
                <tfoot>

                </tfoot>
                <tbody>
                    <?php foreach ($cityMetros as $i => $city_metro): $odd = fmod(++$i, 2) ? 'odd' : 'even' ?>
                        <tr class="sf_admin_row <?php echo $odd ?>">
                           
                        <?php //$city_metro = new City_metro($table, $isNewEntry); ?>
                        <td><?php echo $city_metro->getCity()->getCode(); ?></td>
                        <td><?php echo $city_metro->getCity()->getName(); ?></td>
                        <td><?php echo image_tag('icons/flag/'.$city_metro->getCity()->getCountry()->getCode().'.gif'); ?>
                        <?php echo $city_metro->getCity()->getCountry(); ?></td>
                        <td>
                            <ul>
                                <?php foreach ($city_metro->getCities() as $city): ?>
                                    <li><?php echo '<b>' . $city->getCode() . '</b>: ' . $city->getAirport(); ?></li>
                                <?php endforeach; ?>
                                </ul>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

        </div>

    </div>

    <div id="sf_admin_footer">

    </div>
</div>
