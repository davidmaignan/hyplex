<?php
//var_dump($total);
//var_dump($page);
?>
<ul class="pagination">
    <li class="bold">1-10 of 82 hotels filtered</li>
<?php for ($i = (ceil($total / 10)); $i >= 1; $i--): ?>
<?php if ($page == $i): ?>
        <li><span class="page-link"><?php echo $i ?></span></li>
<?php else: ?>
            <li><a href="" class="page-link"><?php echo $i ?></a></li>
<?php endif; ?>
<?php endfor; ?>
</ul>
<hr class="space2" />