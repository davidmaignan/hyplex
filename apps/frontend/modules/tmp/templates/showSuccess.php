<table>
  <tbody>
    <tr>
      <th>Id:</th>
      <td><?php echo $pms_clarification->getId() ?></td>
    </tr>
    <tr>
      <th>Clarification type:</th>
      <td><?php echo $pms_clarification->getClarificationType() ?></td>
    </tr>
    <tr>
      <th>Pms ticket:</th>
      <td><?php echo $pms_clarification->getPmsTicketId() ?></td>
    </tr>
    <tr>
      <th>From user:</th>
      <td><?php echo $pms_clarification->getFromUserId() ?></td>
    </tr>
    <tr>
      <th>To user:</th>
      <td><?php echo $pms_clarification->getToUserId() ?></td>
    </tr>
    <tr>
      <th>Message:</th>
      <td><?php echo $pms_clarification->getMessage() ?></td>
    </tr>
    <tr>
      <th>Answer:</th>
      <td><?php echo $pms_clarification->getAnswer() ?></td>
    </tr>
    <tr>
      <th>Is internal:</th>
      <td><?php echo $pms_clarification->getIsInternal() ?></td>
    </tr>
    <tr>
      <th>Created at:</th>
      <td><?php echo $pms_clarification->getCreatedAt() ?></td>
    </tr>
    <tr>
      <th>Updated at:</th>
      <td><?php echo $pms_clarification->getUpdatedAt() ?></td>
    </tr>
  </tbody>
</table>

<hr />

<a href="<?php echo url_for('tmp/edit?id='.$pms_clarification->getId()) ?>">Edit</a>
&nbsp;
<a href="<?php echo url_for('tmp/index') ?>">List</a>
