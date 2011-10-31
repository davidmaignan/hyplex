<div class="span-18">
    <div class="padded">
        <div class="span-5 smaller bold" style="line-height: 20px;">
            <?php echo $page*10-9 ?> - <?php echo (($page*10) < $total)? $page*10: $total; ?> of <?php echo $total ?> hotels filtered
        </div>
        <div class="span-12 right last">
        <ul class="pagination">
        <?php for ($i = (ceil($total / 10)); $i >= 1; $i--): ?>
        <?php if ($page == $i): ?>
                <li><span class="page-link"><?php echo $i ?></span></li>
        <?php else: ?>
                    <li><a href="" class="page-link"><?php echo $i ?></a></li>
        <?php endif; ?>
        <?php endfor; ?>
        </ul>
        </div>
        <div style="clear:both;"></div>
    </div>
</div>
<hr class="space2" />

