<?php
$countHotels = array();

foreach($hotels as $hotel){
    array_push($countHotels, $hotel->name);
}

$count = array_count_values($countHotels);

?>

<hr />
<table>
    <tr>
        <td>
            <h2>Duplicates</h2>
            <table>
                <?php $i=0;?>
            <?php foreach($count as $key=>$value): ?>
                <tr class="<?php echo fmod($i, 2) ? 'even' : 'odd' ?>">
                    <td><?php echo $key; ?></td>
                    <td><?php echo $value; $i++;?></td>
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