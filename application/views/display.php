<?php
  // var_dump($data);
  // var_dump($count['count']);
  // var_dump($leads);
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
	<title>Leads Search and Pagination</title>
  <style>
    table{
      border-collapse: collapse;
    }
    td, th{
      padding: 3px 16px;
      border: 1px solid silver;
    }
    th{
      background-color: lightgrey;
    }
  </style>
</head>
<body>
  <div class='pagination'>
    <?php
    echo "<ul>";
      for($i=1; $i<=ceil(intval($count['count'])/5); $i++){
        echo "<li><a href='#' data-page='".$i."'>".$i."</a></li>";
        // echo "<li><a href='/ajax/search_by_name' data-page='".$i."' title='Page ".$i."'>".$i."</a></li>";
      }
    echo "</ul>";
    ?>
  </div>
  <table>
    <tr>
      <th>Leads_id</th>
      <th>First name</th>
      <th>Last name</th>
      <th>Registered date</th>
      <th>Email</th>
    </tr>
    	<?php
      foreach ($leads as $lead) {
        echo "<tr>";
        echo "<td align=center>".$lead['id']."</td>";
        echo "<td>".$lead['first_name']."</td>";
        echo "<td>".$lead['last_name']."</td>";
        echo "<td>".$lead['registered_datetime']."</td>";
        echo "<td>".$lead['email']."</td></tr>";
      }
    	?>
  </table>
</body>
</html>
