<?php include '../views/auth.php';
include 'class.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>List</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

</head>

<body>
  <?php include 'header.php' ?>
  <div class="container">
    <div class="row">
      <div class="col-md-2">
        <form action="add.php">
          <button class="btn btn-secondary" type="submit">Add Assignment</button>
        </form>
      </div>
    </div>
    <div class="row" style="margin-top: 20px;">
      <h3>List Assignment</h3>
      <div class="col-sm-12">
        <div class="table-responsive">
          <table class="table">
            <thead>
              <tr>
                <th>Title</th>
                <th>Date</th>
              </tr>
            </thead>
            <tbody>
              <?php
                $listClass=Classfile::getAll();
                foreach ($listClass as $class) {
                  echo '<tr>';
                  echo "<td>{$class->getTitle()}</td>";
                  echo "<td>{$class->getDate()}</td>";
                  echo '<td>
                  <form action="detail.php">
                      <button class="btn btn-primary" type="submit" name="id" value="'.$class->getId().'">Detail</button>
                  </form></td>';
                  echo '</tr>';  
                }
              ?>
            </tbody>
          </table>
        </div> 
      </div>
    </div>        
  </div>
</body>

</html>