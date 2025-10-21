<?php 
include('header.php');
include('dbconnect2.php');
?>

<div class="container-fluid">
  <?php include('menubar.php'); ?>

  <div class="col-md-2"></div>
  <div class="col-md-8">
    <div class="panel panel-success">
      <div class="panel-heading">
        <h3 class="panel-title">Add Region and District</h3>
      </div>

      <div class="panel-body">
        <form class="form-horizontal" action="" method="post" role="form">
          <div class="form-row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="region">Region:</label>
                <input type="text" name="region" class="form-control" id="region" required>
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group">
                <label for="district">District:</label>
                <input type="text" name="district" class="form-control" id="district" required>
              </div>
            </div>
          </div>

          <div class="form-group">
            <button type="submit" name="save_region" class="btn btn-success form-control">
              Save
              <span class="glyphicon glyphicon-arrow-right" aria-hidden="true"></span>
            </button>
          </div>
        </form>

        <?php
        if (isset($_POST['save_region'])) {
          $region = trim($_POST['region']);
          $district = trim($_POST['district']);

          if (!empty($region) && !empty($district)) {
            $sql = "INSERT INTO regions (region, district) VALUES ('$region', '$district')";
            $query = mysqli_query($dbcon, $sql);

            if ($query) {
              echo "<script>alert('Region and District saved successfully'); window.location='region.php';</script>";
            } else {
              echo "<div class='alert alert-danger'>Error saving record: " . mysqli_error($dbcon) . "</div>";
            }
          } else {
            echo "<div class='alert alert-warning'>All fields are required.</div>";
          }
        }
        ?>
      </div>
    </div>
  </div>

  <div class="col-md-2"></div>
</div>

<?php include('scripts.php'); ?>
</body>
</html>
