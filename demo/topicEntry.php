<?php
/**********************************************************
* File: topicEntry.php
* Author: Br. Burton
* 
* Description: This is the PHP file that the user starts with.
*   It has a form to enter a new scripture and topic.
*   It posts to the insertTopic.php page.
***********************************************************/
?>
<!DOCTYPE html>
<html>
<head>
	<title>Topic Entry</title>
</head>

<body>
<div>

<h1>Enter New Scriptures and Topics</h1>

<form id="mainForm" action="insertTopic.php" method="POST">

	<input type="text" id="txtBook" name="txtBook"></input>
	<label for="txtBooK">Book</label>
	<br /><br />

	<input type="text" id="txtChapter" name="txtChapter"></input>
	<label for="txtChapter">Chapter</label>
	<br /><br />

	<input type="text" id="txtVerse" name="txtVerse"></input>
	<label for="txtVerse">Verse</label>
	<br /><br />

	<label for="txtContent">Content:</label><br />
	<textarea id="txtContent" name="txtContent" rows="4" cols="50"></textarea>
	<br /><br />

	<label>Topics:</label><br />

<?php
// This section will now generate the available check boxes for topics
// based on what is in the database
try
{
	// Load the database
	require("scriptureDbConnector.php");
	$db = loadDatabase();	

	// prepare the statement
	$statement = $db->prepare('SELECT * FROM topic;');
   $statement->execute();

	// Go through each result
	while ($row = $statement->fetch(PDO::FETCH_ASSOC))
	{
		echo '<input type="checkbox" name="chkTopics[]" value="' . $row['id'] . '">';
		echo $row['name'];
		echo '</input><br />';

		// put a newline out there just to make our "view source" experience better
		echo "\n";
	}

}
catch (PDOException $ex)
{
	// Please be aware that you don't want to output the Exception message in
	// a production environment
	echo "Error connecting to DB. Details: $ex";
	die();
}

?>

	<br />

	<input type="submit" value="Add to Database" />

</form>


</div>

</body>
</html>