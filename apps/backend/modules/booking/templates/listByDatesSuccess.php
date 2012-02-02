<?php include_partial('historic/navigation'); ?>

<div id="mainContent">

<div id="sf_admin_container">
	<h1><?php echo __('Booking List', array(), 'messages') ?></h1>
	
	<div id="sf_admin_header">
		<?php include_partial('booking/list_header', array('pager' => $pager)) ?>
	</div>
	
	<div class="sf_admin_list">
	
		<?php if (!$pager->getNumResults()): ?>
	    	<p><?php echo __('No result', array(), 'sf_admin') ?></p>
	  	<?php else: ?>
	  	
	  	<?php endif; ?>
	  	
	  	<table cellspacing="0">
	      <thead>
	        <tr>
	          <th id="sf_admin_list_batch_actions"><input id="sf_admin_list_batch_checkbox" type="checkbox" onclick="checkAll();" /></th>
	          <?php include_partial('booking/list_th_tabular', array('sort' => $sort)) ?>
	          <th id="sf_admin_list_th_actions"><?php echo __('Actions', array(), 'sf_admin') ?></th>
	        </tr>
	      </thead>
	      
	      <tfoot>
        <tr>
          <th colspan="7">
            <?php if ($pager->haveToPaginate()): ?>
              <?php include_partial('booking/pagination', array('pager' => $pager)) ?>
            <?php endif; ?>

            <?php echo format_number_choice('[0] no result|[1] 1 result|(1,+Inf] %1% results', array('%1%' => $pager->getNumResults()), $pager->getNumResults(), 'sf_admin') ?>
            <?php if ($pager->haveToPaginate()): ?>
              <?php echo __('(page %%page%%/%%nb_pages%%)', array('%%page%%' => $pager->getPage(), '%%nb_pages%%' => $pager->getLastPage()), 'sf_admin') ?>
            <?php endif; ?>
          </th>
        </tr>
      </tfoot>
	      <tbody>
        <?php foreach ($pager->execute() as $i => $booking): $odd = fmod(++$i, 2) ? 'odd' : 'even' ?>
          <tr class="sf_admin_row <?php echo $odd ?>">
            <?php include_partial('booking/list_td_batch_actions', array('booking' => $booking, 'helper' => $helper)) ?>
            <?php include_partial('booking/list_td_tabular', array('booking' => $booking)) ?>
            <?php include_partial('booking/list_td_actions', array('booking' => $booking, 'helper' => $helper)) ?>
          </tr>
        <?php endforeach; ?>
      </tbody>
	      </table>
	
	</div>


</div>