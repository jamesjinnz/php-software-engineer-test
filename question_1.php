<?php
namespace SoftwareEngineerTest;

// Question 1a

$DB_HOST = 'localhost';
$DB_NAME = 'test';
$DB_USER = 'test';
$DB_PASS = 'test';

// write your sql to get customer_data here
$mysqli = new \mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);

/* check connection */
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}

$where = '';
if (array_key_exists('occupation_name',$_GET))
{
    if ($_GET['occupation_name']){
        $occupationName = mysqli_real_escape_string($mysqli, $_GET['occupation_name']);
        $where = ' WHERE co.occupation_name = "'.$occupationName.'"';
    }
}

$sql = 'SELECT c.customer_id,c.first_name,c.last_name,co.occupation_name FROM customer AS c LEFT JOIN customer_occupation AS co ON co.customer_occupation_id = c.customer_occupation_id '.$where;

$result = $mysqli->query($sql);
mysqli_close($mysqli);
?>

<h2>Customer List</h2>

<table>
	<tr>
		<th>Customer ID</th>
		<th>First Name</th>
		<th>Last Name</th>
		<th>Occupation</th>
	</tr>

	<!-- Write your code here -->
    <?php if ($result):?>
        <?php foreach ($result as $value):?>
            <tr>
                <td><?php echo ($value['customer_id']) ?$value['customer_id']: '' ?></td>
                <td><?php echo ($value['first_name']) ? $value['first_name'] : ''?></td>
                <td><?php echo ($value['last_name'])? $value['last_name'] : ''?></td>
                <td><?php echo ($value['occupation_name']) ? $value['occupation_name'] : 'un-employed'?></td>
            </tr>
        <?php endforeach ?>
    <?php endif ?>
</table>
