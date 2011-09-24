<style>
    .flight{
        border:1px solid #aaa;
        background-color: white;
        padding:5px;
        margin-bottom: 5px;
    }

    .flight table{
        width:100%;
    }

    span.small{
        font-size: 80%;
        display: block;
        font-weight: bold;
        color: #4297d7;
    }

    .flight td{
        padding:0 4px;
        color: #525252;
        border-right: 1px solid #eee;
        font-size: 92%;

    }

    .flight tr.line td{
        background-color: #aaa;
        height: 1px;

    }

</style>

<div class="flight">

    <?php echo html_entity_decode($result); ?>
   
</div>
