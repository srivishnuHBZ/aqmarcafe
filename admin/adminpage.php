<?php

if(isset($_POST['search']))
{
    $valueToSearch = $_POST['valueToSearch'];
    // search in all table columns
    // using concat mysql function
    $query = "SELECT * FROM `reservation` WHERE CONCAT(`reserv_id`, `f_name`, `l_name`, `num_guests`, `num_tables`, `rdate`, `time_zone`, 
    `telephone`, `comment`, `reg_date`) LIKE '%".$valueToSearch."%'";
    $search_result = filterTable($query);
    
}
 else {
    $query = "SELECT * FROM `users`";
    $search_result = filterTable($query);
}

// function to connect and execute the query
function filterTable($query)
{
    $connect = mysqli_connect("localhost", "root", "", "loginsystem");
    $filter_Result = mysqli_query($connect, $query);
    return $filter_Result;
}

?>

<!DOCTYPE html>
<html>
    <head>
        <script src="table2excel.js"></script>
        <title>View Reservations</title>
        <style>
			
            table,tr,th,td
            {
                border: 1px solid black;
				padding: 10px;
  				text-align: left;
				border-collapse: collapse;
			}
			tr:hover {
				background-color: #f5f5f5;
			}
			tr:nth-child(even) {
				background-color: #f2f2f2;
			}
			th {
			  	background-color: #25274D;
			  	color: white;
			}	
            
			input[type=button], input[type=submit], input[type=reset] {
			  background-color: #191970;
			  border: none;
			  color: white;
			  padding: 16px 32px;
			  text-decoration: none;
			  margin: 4px 2px;
			  cursor: pointer;
			}
			.button {
			  background-color: #191970; 
			  border: none;
			  color: white;
			  padding: 16px 32px;
			  text-align: center;
			  text-decoration: none;
			  display: inline-block;
			  font-size: 16px;
			  margin: 4px 2px;
			  transition-duration: 0.4s;
			  cursor: pointer;
			}
			.button {
			  background-color: white; 
			  color: black; 
			  border: 2px solid #191970;
			}

			.button:hover {
			  background-color: #191970;
			  color: white;
        </style>
    </head>
    <body><center>
        
        
		<h1>Aqmar Café Reservation System</h1>
		<h2><i>Generate Reservation</i></h2><br>
        <form action="adminpage.php" method="post">
			<label><i>Pick a date: </i></label>
            <input type="date" name="valueToSearch" placeholder="Value To Search"><br><br>
            <input type="submit" name="search" value="Generate"><br><br>
            
            <table>
                <tr>
                    <th>Id</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Guest Count</th>
                    <th>Table Number</th>
                    <th>Reservation Date</th>
                    <th>Time zone</th>
                    <th>Telephone</th>
                    <th>Comment</th>
                    <th>Register Date</th>
                </tr>

      <!-- populate table from mysql database -->
                <?php while($row = mysqli_fetch_array($search_result)):?>
                <tr>
                    <td><?php echo $row['reserv_id'];?></td>
                    <td><?php echo $row['f_name'];?></td>
                    <td><?php echo $row['l_name'];?></td>
                    <td><?php echo $row['num_guests'];?></td>
                    <td><?php echo $row['num_tables'];?></td>
                    <td><?php echo $row['rdate'];?></td>
                    <td><?php echo $row['time_zone'];?></td>
                    <td><?php echo $row['telephone'];?></td>
                    <td><?php echo $row['comment'];?></td>
                    <td><?php echo $row['reg_date'];?></td>
                </tr>
                <?php endwhile;?>
            </table>
    </form><br>
        <button class="button" id="export">Export Generated Reservation</button>

    <script>
      var table2excel = new Table2Excel();

      document.getElementById('export').addEventListener('click', function() {
        table2excel.export(document.querySelectorAll('table'));
      });
    </script>
        
    </body></center>
</html>