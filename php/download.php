<?php 
//init
session_start(); 
include  "functions.php";
//download a document
if(isset($_GET['id'])) 
{
	// if id is set then get the file with the id from database
	$id = $_GET['id'];

	//download a row
	$row = getDocumentContent($id);
	list($name, $type, $size, $content) = $row;
	header("Content-length: $size");
	header("Content-type: $type");
	header("Content-Disposition: attachment; filename=$name");
	echo $content;
	exit;
}