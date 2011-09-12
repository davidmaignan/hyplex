<div id="sorting">
    <span>Sort by: </span>
    <ul>
        <li class="level-1 selected">
            <div class="level-2">
                <a id="sort_price_desc" class="">desc</a>
                <a id="sort_price_asc" class="selected asc">asc</a>
            </div>
            <div class="level-3">
                Price
            </div>

        </li>
        <li class="level-1">
            <div class="level-2">
                <a id="sort_airline_desc" class="">desc</a>
                <a id="sort_airline_asc" class="asc">asc</a>
            </div>
            <div class="level-3">
                Airline
            </div>

        </li>
        <li class="level-1">
            <div class="level-2">
                <a id="duration_desc" class="">desc</a>
                <a id="duration_asc" class="asc">asc</a>
            </div>
            <div class="level-3">
                Duration
            </div>

        </li>
        <li class="level-1">
            <div class="level-2">
                <a id="sort_takeoff_desc" class="">desc</a>
                <a id="sort_takeoff_asc" class="asc">asc</a>
            </div>
            <div class="level-3">
                Take off
            </div>

        </li>
        <li class="level-1">
            <div class="level-2">
                <a id="sort_stops_desc" class="">desc</a>
                <a id="sort_stops_asc" class="asc">asc</a>
            </div>
            <div class="level-3">
                Stops
            </div>
        </li>
        <?php include_partial('include/pagination', array('total' => $total, 'page' => $page)); ?>
    </ul>

</div>