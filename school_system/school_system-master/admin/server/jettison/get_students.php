<?php
include "../db_config.php";
$key = $_POST['key'];
if($key == "fetch") {
  $sql = "SELECT * FROM student";
  $result = $conn->query($sql);
  if ($result->num_rows > 0) {

    while ($row = $result->fetch_assoc()) {
      echo '
        <tr>
           <th scope="row">'.$row["id"].'</th>
           <td>'.$row["fname"].'</td>
           <td>'.$row["lname"].'</td>
           <td>'.$row["course"].'</td>
           <td>
             <button type="button" onclick="showModal('.$row["id"].')" class="btn btn-outline-info">View</button>
             <button type="button" class="btn btn-outline-danger">Delete</button>
           </td>
         </tr>';
    }
  }
}



