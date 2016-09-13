<div class="row">
  <div class="col-md-12">
      <table class="table table-striped">
        <tr>
          <th>#</th>
          <th>Text</th>
          <th>Date</th>
        </tr>
        <?php
          if (isset($current_id)) {
            ShowRecord($current_id);
          } elseif (isset($_COOKIE['CURRENT_ID'])) {
            ShowRecord((int)$_COOKIE['CURRENT_ID']);
          } else {
            echo("Error!");
          }
        ?>
      </table>
  </div>
</div>
