<?php
session_start();
require_once 'inscrit.php';
require_once 'anecdote.php';

$id = $_GET['id'];
$id_inscrit = $_SESSION['id'];

$lien_anecdote_inscrit = getVote($id,$id_inscrit);
$result = null;

if($lien_anecdote_inscrit == null){
    $result = anecdoteUpvote($id);
    aVoter($id,$id_inscrit);
    if($result == true){
    	echo "Success";
    }else{
    	echo "Failed";
    }
}else{
	echo "Failed";
}
//header("Location: ../../index.php?nbAnecdotes=".$_GET['page']);
?>
