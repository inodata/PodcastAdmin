<table>
  <tbody>
    <tr>
      <th>Id:</th>
      <td><?php echo $mixtape->getId() ?></td>
    </tr>
    <tr>
      <th>Title:</th>
      <td><?php echo $mixtape->getTitle() ?></td>
    </tr>
    <tr>
      <th>File:</th>
      <td><?php echo $mixtape->getFile() ?></td>
    </tr>
    <tr>
      <th>Created at:</th>
      <td><?php echo $mixtape->getCreatedAt() ?></td>
    </tr>
    <tr>
      <th>Updated at:</th>
      <td><?php echo $mixtape->getUpdatedAt() ?></td>
    </tr>
  </tbody>
</table>

<hr />

<a href="<?php echo url_for('mixtape/edit?id='.$mixtape->getId()) ?>">Edit</a>
&nbsp;
<a href="<?php echo url_for('mixtape/index') ?>">List</a>
