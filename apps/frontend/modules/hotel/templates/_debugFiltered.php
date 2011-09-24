<hr />
<table>
    <tr>
        <td>
            <h2>Total hotels: <?php echo count($hotels); ?></h2>
            <table>
                <?php foreach($hotels as $i=>$hotel): ?>
                <tr class="<?php echo fmod($i, 2) ? 'even' : 'odd' ?>">
                    <td><?php echo html_entity_decode($hotel); ?></td>
                </tr>
                <?php endforeach; ?>
            </table>
        </td>
    </tr>
    <tr>
        <td>

        </td>
    </tr>
</table>