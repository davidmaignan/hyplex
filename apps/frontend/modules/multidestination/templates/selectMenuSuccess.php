<h5 class="multi-title"><?php echo __($title); ?></h5>
<select name="<?php echo $name; ?>" id="<?php echo $name; ?>" onChange="sendDestinationRequest(this)" size="15" style="width: 150px;">
    <?php foreach ($datas as $data): ?>
    <?php $code = ($name == 'citySelect')? "(".$data->getCode().")": ''; ?>
    <?php echo "<option label='$data $code' value='".$data->getId()."'>$data $code </option>"; ?>
    <?php endforeach; ?>
</select>

