<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
}
# connect
require '../database/database.php';
$pdo = Database::connect();

# put the information for the chosen record into variable $results 
$id = $_GET['id'];
$sql = "SELECT * FROM persons WHERE id=" . $id;
$query=$pdo->prepare($sql);
$query->execute();
$result = $query->fetch();

$states = array(
		    '' => 'Select...',
		    'AL'=>'Alabama',
		    'AK'=>'Alaska',
		    'AZ'=>'Arizona',
		    'AR'=>'Arkansas',
		    'CA'=>'California',
		    'CO'=>'Colorado',
		    'CT'=>'Connecticut',
		    'DE'=>'Delaware',
		    'DC'=>'District of Columbia',
		    'FL'=>'Florida',
		    'GA'=>'Georgia',
		    'HI'=>'Hawaii',
		    'ID'=>'Idaho',
		    'IL'=>'Illinois',
		    'IN'=>'Indiana',
		    'IA'=>'Iowa',
		    'KS'=>'Kansas',
		    'KY'=>'Kentucky',
		    'LA'=>'Louisiana',
		    'ME'=>'Maine',
		    'MD'=>'Maryland',
		    'MA'=>'Massachusetts',
		    'MI'=>'Michigan',
		    'MN'=>'Minnesota',
		    'MS'=>'Mississippi',
		    'MO'=>'Missouri',
		    'MT'=>'Montana',
		    'NE'=>'Nebraska',
		    'NV'=>'Nevada',
		    'NH'=>'New Hampshire',
		    'NJ'=>'New Jersey',
		    'NM'=>'New Mexico',
		    'NY'=>'New York',
		    'NC'=>'North Carolina',
		    'ND'=>'North Dakota',
		    'OH'=>'Ohio',
		    'OK'=>'Oklahoma',
		    'OR'=>'Oregon',
		    'PA'=>'Pennsylvania',
		    'RI'=>'Rhode Island',
		    'SC'=>'South Carolina',
		    'SD'=>'South Dakota',
		    'TN'=>'Tennessee',
		    'TX'=>'Texas',
		    'UT'=>'Utah',
		    'VT'=>'Vermont',
		    'VA'=>'Virginia',
		    'WA'=>'Washington',
		    'WV'=>'West Virginia',
		    'WI'=>'Wisconsin',
		    'WY'=>'Wyoming',
		);
?>

<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
<html xmlns='http://www.w3.org/1999/xhtml'>
<head>
<meta http-equiv='Content-Type' content='text/html; charset=UTF-8'>
<title>Register</title>
<link rel='stylesheet' type='text/css' href='view.css' media='all'>
<script type='text/javascript' src='view.js'></script>

</head>
<body id='main_body' >
	<?php
	error_reporting(0);
	?>

	<img id='top' src='top.png' alt=''>
	<div id='form_container'>
	
		<h1>Read/view existing users</h1>
		<form id='form_13943' class='appnitro'  method='post' action="list.php"> 
					<div class='form_description'>
			<h2></h2>
			
			<p></p>
		</div>						
			<ul >
			
					<li id='li_1' >
		<label class='description' for='element_1'>Role </label>
		<span>
			<label> Role: </label>
			<select class='element select medium' id='role' name='role'> 
				<option value="User">User</option>
            			<option value="Admin">Admin</option>
        		</select>
		</span>
		
		
		</li>		<li id='li_2' >
		<label class='description' for='element_2'>Frist Name: </label>
		<span>
			<input id='fname' name= 'fname' class='element text' maxlength='50' size='50' value='<?php echo $_GET["results"];?>' disabled>
		</span>
		</li>		<li id='li_3' >
		<label class='description' for='element_3'>Last Name: </label>
		<span>
			<input id='lname' name= 'lname' class='element text' maxlength='50' size='50' value='<?php echo $_GET["results"];?>' disabled>
		</span>
		 </li>		<li id='li_4' >
		<label class='description' for='element_4'>Email: </label>
		<span>
			<input id='email' name='email' class='element text' size='50' maxlength='50' value='<?php echo $_GET["results"];?>'  disabled>
		</span>
		</li>		<li id='li_5' >
		<label class='description' for='element_5'>Phone: </label>
		<span>
			<input id='phone' name='phone' class='element text' size='50' maxlength='50' value='<?php echo $_GET["results"];?>'  disabled>
		</span>
	
		</li>		<li id='li_6' >
		<label class='description' for='element_6'>Password: </label>
		<span>
			<input id='password' name='password' class='element password' size='50' maxlength='50' value='<?php echo $_GET["password"];?>'  disabled>
		</span>
	
		</li>		<li id='li_7' >
		<label class='description' for='element_'>Address: </label>
		<span>
			<input id='address' name='address' class='element text' size='50' maxlength='50' value='<?php echo $_GET["address"];?>'  disabled>
		</span>
	
		</li>		<li id='li_9' >
		<label class='description' for='element_9'>Address Line 2: </label>
		<span>
			<input id='address2' name='address2' class='element text' size='50' maxlength='50' value='<?php echo $_GET["address"];?>' disabled>
		</span>
	
		</li>		<li id='li_10' >
		<label class='description' for='element_10'>City: </label>
		<span>
			<input id='city' name='city' class='element text' size='50' maxlength='50' value='<?php echo $_GET["city"];?>'  disabled>
		</span>
	
		</li>		<li id='li_11' >
		<label class='description' for='element_11'>State: </label>
		<span>
		<select class='element select medium' id='state' name='state'>
			<?php foreach ($states as $key => $value) { ?>
			<option value="<?php echo $key; ?>"><?php echo $value; ?></option>
			<?php } ?>
		</select>
		</span>
	
		</li>		<li id='li_12' >
		<label class='description' for='element_12'>Zip Code: </label>
		<span>
			<input id='zip_code' name='zip_code' class='element text' size='50' maxlength='50' value='<?php echo $_GET["zip_code"];?>'  disabled>
		</span>
	
		</li>

	</div>
	<img id='bottom' src='bottom.png' alt=''>
	</body>
</html>
