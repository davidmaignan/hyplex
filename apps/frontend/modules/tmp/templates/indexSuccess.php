<h1>Pms clarifications List</h1>

<table>
  <thead>
    <tr>
      <th>Id</th>
      <th>Clarification type</th>
      <th>Pms ticket</th>
      <th>From user</th>
      <th>To user</th>
      <th>Message</th>
      <th>Answer</th>
      <th>Is internal</th>
      <th>Created at</th>
      <th>Updated at</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($pms_clarifications as $pms_clarification): ?>
    <tr>
      <td><a href="<?php echo url_for('tmp/show?id='.$pms_clarification->getId()) ?>"><?php echo $pms_clarification->getId() ?></a></td>
      <td><?php echo $pms_clarification->getClarificationType() ?></td>
      <td><?php echo $pms_clarification->getPmsTicketId() ?></td>
      <td><?php echo $pms_clarification->getFromUserId() ?></td>
      <td><?php echo $pms_clarification->getToUserId() ?></td>
      <td><?php echo $pms_clarification->getMessage() ?></td>
      <td><?php echo $pms_clarification->getAnswer() ?></td>
      <td><?php echo $pms_clarification->getIsInternal() ?></td>
      <td><?php echo $pms_clarification->getCreatedAt() ?></td>
      <td><?php echo $pms_clarification->getUpdatedAt() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('tmp/new') ?>">New</a>
