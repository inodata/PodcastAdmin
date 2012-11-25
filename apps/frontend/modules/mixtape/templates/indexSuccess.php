<h1>Mixtapes List</h1>

<table>
  <thead>
    <tr>
      <th>Id</th>
      <th>Title</th>
      <th>File</th>
      <th>Created at</th>
      <th>Updated at</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($mixtapes as $mixtape): ?>
    <tr>
      <td><a href="<?php echo url_for('mixtape/show?id='.$mixtape->getId()) ?>"><?php echo $mixtape->getId() ?></a></td>
      <td><?php echo $mixtape->getTitle() ?></td>
      <td><?php echo $mixtape->getFile() ?></td>
      <td><?php echo $mixtape->getCreatedAt() ?></td>
      <td><?php echo $mixtape->getUpdatedAt() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('mixtape/new') ?>">New</a>
