<?php


$conn=mysqli_connect('localhost','root','','btwev');
if(isset($_POST['type']) && $_POST['type']!='' && isset($_POST['p_id']) && $_POST['p_id']>0){
	$type=mysqli_real_escape_string($conn,$_POST['type']);
	$id=mysqli_real_escape_string($conn,$_POST['p_id']);
	
	if($type=='like'){
		if(isset($_COOKIE['like_'.$id])){
			setcookie('like_'.$id,"yes",1);
			$sql="UPDATE poster set like_count=like_count-1 where p_id='$id'";
			$opertion="unlike";
		}else{
			
			if(isset($_COOKIE['dislike_'.$id])){
				setcookie('dislike_'.$id,"yes",1);
				mysqli_query($conn,"UPDATE poster set dislike_count=dislike_count-1 where p_id='$id'");
			}
			
			setcookie('like_'.$id,"yes",time()+60*60*24*365*5);
			$sql="UPDATE poster set like_count=like_count+1 where p_id='$id'";
			$opertion="like";
		}
	}
	
	if($type=='dislike'){
		if(isset($_COOKIE['dislike_'.$id])){
			setcookie('dislike_'.$id,"yes",1);
			$sql="UPDATE poster set dislike_count=dislike_count-1 where p_id='$id'";
			$opertion="undislike";
		}else{
			
			if(isset($_COOKIE['like_'.$id])){
				setcookie('like_'.$id,"yes",1);
				mysqli_query($conn,"UPDATE poster set like_count=like_count-1 where p_id='$id'");
			}
			
			setcookie('dislike_'.$id,"yes",time()+60*60*24*365*5);
			$sql="UPDATE poster set dislike_count=dislike_count+1 where p_id='$id'";
			$opertion="dislike";
		}
	}
	mysqli_query($conn,$sql);

	$row=mysqli_fetch_assoc(mysqli_query($conn,"SELECT * from poster where p_id='$id'"));
	
	echo json_encode([
		'opertion'=>$opertion,
		'like_count'=>$row['like_count'],
		'dislike_count'=>$row['dislike_count']
	]);

}
?>