<?php use_helper('Text') ?>

<div id="myslidemenu" class="jqueryslidemenu">
    <ul>
        <li><a href="#">CMS</a>
            <ul>
                <li><?php echo link_to(__('Area'), '@area'); ?></li>
                <li><?php echo link_to(__('Country'), '@country'); ?></li>
                <li><?php echo link_to(__('State'), '@state'); ?></li>
                <li><?php echo link_to(__('City'), '@city'); ?></li>
                <li><?php echo link_to(__('Metropolitan city'), '@city_metro'); ?></li>
                <li><?php echo link_to(__('Airline'), '@airline'); ?></li>
            </ul>
        </li>
         <li><a href="#">CMS</a></li>
        <li><a href="#">Logs</a>
            <ul>
                <li><?php echo link_to(__('Initial request'), 'request_init_plex'); ?></li>
                <li><?php echo link_to(__('Plex request'), 'request_plex'); ?></li>
                <li><?php echo link_to(__('Plex Booking'), 'booking'); ?></li>
                <li><?php echo link_to(__('Plex Error log'), 'plex_error_log'); ?></li>
                <li><?php echo link_to(__('Error log'), 'sf_error_log'); ?></li>
            </ul>
        <li><?php echo link_to(__('Users'), '@sf_guard_user'); ?>
            <ul>
                <li><?php echo link_to(__('Groups'), '@sf_guard_group'); ?></li>
                <li><?php echo link_to(__('Permissions'), '@sf_guard_permission'); ?></li>
            </ul>
        </li>
        <li>
            <ul>
                <li>test</li>
            </ul>
        </li>
        <li><?php echo link_to(__('Log out'), 'sf_guard_signout'); ?></li>
        <li style="float:right;"><a href="#" onclick="return false;" id="filter">Filters</a></li>
    </ul>
    <br style="clear: left" />
</div>
<div style="clear: both;"></div>
<hr class="space" /><hr class="space" />
<!--
<div id="myslidemenu" class="jqueryslidemenu">
    <ul>
        <li><a href="http://www.dynamicdrive.com">Item 1</a></li>
        <li><a href="#">Item 2</a></li>
        <li><a href="#">Folder 1</a>
            <ul>
                <li><a href="#">Sub Item 1.1</a></li>
                <li><a href="#">Sub Item 1.2</a></li>
                <li><a href="#">Sub Item 1.3</a></li>
                <li><a href="#">Sub Item 1.4</a></li>
            </ul>
        </li>
        <li><a href="#">Item 3</a></li>
        <li><a href="#">Folder 2</a>
            <ul>
                <li><a href="#">Sub Item 2.1</a></li>
                <li><a href="#">Folder 2.1</a>
                    <ul>
                        <li><a href="#">Sub Item 2.1.1</a></li>
                        <li><a href="#">Sub Item 2.1.2</a></li>
                        <li><a href="#">Folder 3.1.1</a>
                            <ul>
                                <li><a href="#">Sub Item 3.1.1.1</a></li>
                                <li><a href="#">Sub Item 3.1.1.2</a></li>
                                <li><a href="#">Sub Item 3.1.1.3</a></li>
                                <li><a href="#">Sub Item 3.1.1.4</a></li>
                                <li><a href="#">Sub Item 3.1.1.5</a></li>
                            </ul>
                        </li>
                        <li><a href="#">Sub Item 2.1.4</a></li>
                    </ul>
                </li>
            </ul>
        </li>
        <li><a href="http://www.dynamicdrive.com/style/">Item 4</a></li>
    </ul>
    <br style="clear: left" />
</div>
-->