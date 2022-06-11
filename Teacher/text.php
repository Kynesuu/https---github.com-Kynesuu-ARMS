<?php 
session_start();
$id = $_SESSION['teacher_id'];

echo $id;