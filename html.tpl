<table style="width: 660px; margin: 0 auto;">
  <tr style="height: 24px; background-color: #DDFFFF;">
    <th style="width: 80%; text-align: center; vertical-align: middle; font-weight: bold;">Query</th>
    <th style="width: 20%; text-align: center; vertical-align: middle; font-weight: bold;">Time</th>
  </tr>
  <?php foreach ($rows as $row) : ?>
  <tr>
    <td style="padding: 5px;">
      <em style="font-weight: bold;">SQL: </em> <?php echo h($row["sql"]) ?>
      <?php if (!empty($row["binds"])) : ?>
        <br/>
        <em style="font-weight: bold;">BIND VALUES: </em> <?php echo h($row["binds"]) ?>
      <?php endif ?>
    </td>
    <td style="text-align: center; vertical-align: middle;">
      <?php echo $row["time"] ?> msec
    </td>
  </tr>
  <?php endforeach ?>
</table>
