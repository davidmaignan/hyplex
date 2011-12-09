<article class="span-15 last" id="top-dest-all">
    <h2 class="title2"><?php echo __('Top destinations'); ?></h2>
    <div id="top-dest-container">
        <article class="top-dest span-5">
            <?php echo image_tag('../uploads/images/top_destination/3.jpg', array('class' => 'span-5')); ?>
            <h3><?php echo __('Venice') ?></h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing eli.</p>
        </article>
        <article class="top-dest span-5">
            <?php echo image_tag('../uploads/images/top_destination/4.jpg', array('class' => 'span-5')); ?>
            <h3><?php echo __('New York') ?></h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing eli.</p>
        </article>
        <article class="top-dest span-5">
            <?php echo image_tag('../uploads/images/top_destination/2.jpg', array('class' => 'span-5')); ?>
            <h3><?php echo __('Las Vegas') ?></h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing eli.</p>
        </article>
        <article class="top-dest span-5">
            <?php echo image_tag('../uploads/images/top_destination/1.jpg', array('class' => 'span-5')); ?>
            <h3><?php echo __('Los Angeles') ?></h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing eli.</p>
        </article>
        <article class="top-dest span-5">
            <?php echo image_tag('../uploads/images/top_destination/0.jpg', array('class' => 'span-5')); ?>
            <h3><?php echo __('Amsterdam') ?></h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing eli.</p>
        </article>
        <article class="top-dest span-5">
            <?php echo image_tag('../uploads/images/top_destination/5.jpg', array('class' => 'span-5')); ?>
            <h3><?php echo __('Paris') ?></h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing eli.</p>
        </article>
        <article class="top-dest span-5">
            <?php echo image_tag('../uploads/images/top_destination/6.jpg', array('class' => 'span-5')); ?>
            <h3><?php echo __('London') ?></h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing eli.</p>
        </article>
        <article class="top-dest span-5">
            <?php echo image_tag('../uploads/images/top_destination/7.jpg', array('class' => 'span-5')); ?>
            <h3><?php echo __('Japan') ?></h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing eli.</p>
        </article>
        <article class="top-dest span-5">
            <?php echo image_tag('../uploads/images/top_destination/8.jpg', array('class' => 'span-5')); ?>
            <h3><?php echo __('Beijing') ?></h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing eli.</p>
        </article>
        <article class="top-dest span-5">
            <?php echo image_tag('../uploads/images/top_destination/9.jpg', array('class' => 'span-5')); ?>
            <h3><?php echo __('San francisco') ?></h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing eli.</p>
        </article>
        <article class="top-dest span-5">
            <?php echo image_tag('../uploads/images/top_destination/10.jpg', array('class' => 'span-5')); ?>
            <h3><?php echo __('Moscow') ?></h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing eli.</p>
        </article>
        <article class="top-dest span-5">
            <?php echo image_tag('../uploads/images/top_destination/11.jpg', array('class' => 'span-5')); ?>
            <h3><?php echo __('Rome') ?></h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing eli.</p>
        </article>
    </div>
    <div style="clear:both;"></div>

    <ul class="paginator" id="top-dest-links" style="margin-top: 150px;">
        <li><a href="#" class="selected top-dest-link">1</a></li>
        <li><a href="#" class="top-dest-link">2</a></li>
        <li><a href="#" class="top-dest-link">3</a></li>
        <li><a href="#" class="top-dest-link">4</a></li>
    </ul>
</article>

<script type="text/javascript">
    $('document').ready(function(){
        $('a.top-dest-link').click(function(){
            var value = $(this).html()-1;
            var left = -630*value+'px';
            $('#top-dest-container').animate({left:left});
            $('a.top-dest-link').removeClass('selected');
            $(this).addClass('selected');
            return false;
        });
    });
</script>