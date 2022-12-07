
<?php  require "connect.php";
session_start();
?>



<!DOCTYPE html>
<html lang="en">



<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link href="main.css" rel="stylesheet">
    <title>Home</title>
</head>
<body>


    <header>
       
    <div class="search">
    <?php
    if(isset($_SESSION['loggedin'])&& $_SESSION['loggedin']==true ){
    echo'
    
          <center><form action="search.php" method="get">
<input type="search" name="search" id="search">
<button type="submit">Submit</button>

        </form></center>';}
        ?>
    

        <nav>
            <logo>
            <h1>Blast</h1>
            <img src="tiktok.svg" alt="lgo">
        </logo>

<ul class="tabs">
    <?php 
if(isset($_SESSION['loggedin'])&& $_SESSION['loggedin']==true ) { echo '
  <li class="tab active" value="0"><img src="home.svg" alt="logo"></li>
    <li class="tab" value="1"><img src="friends.svg" alt="logo" ></li>
    <li class="tab" value="2"><img src="photo-film-solid.svg" alt="logo"></li>
    <li class="tab" value="3"><img src="messages.svg" alt="logo"></li>
    <li class="tab" value="4"><img src="user.svg" alt="logo"></li>
    
    <button class="logout"><a href="logout.php"> Log out</a></button>
';}
  
else{ echo '
   <li class="tab " value="0" style="width: 60px;">log in</li>
    <li class="tab active" value="1" style="width: 70px;"> sign up</li>
';}
?></ul>

</nav>
    </header>

<section class="pages">
<?php
if(isset($_SESSION['loggedin'])&& $_SESSION['loggedin']==true ){ 
    $name=$_SESSION['username'];
$email=$_SESSION['email'];
$path=$_SESSION['path'];
$description=$_SESSION['description'];

    
    echo'
<div class="page active">

<button id="Postid">Post now</button>
<div class="container">



</div>

<div class="sign post" id="postform">
<button id="postback" > back</button>
<form action="post.php" method="post" enctype="multipart/form-data">
    <label for="email">Add description</label>
    <input type="text" id="posttext" name="posttext" placeholder="add Descriptiin">
    <label for="postfile" >upload picture<img src="post.png" alt="upload" id="postlabel"></label>
    <input type="file" accept="image/*" id="postfile" name="postfile"  onchange="loadpost(event)">
    <div id="loadfile"></div>
    
    <button type="submit">
        post
    </button>
    
      </form>
    </div>
<div id="updateclass">


<p id="iddd"></p>







</div>





';
$sql="SELECT * FROM `user_post`order by `post_id` desc ";

$result=mysqli_query($con,$sql);

//$num=mysqli_num_rows($result);
while (  $row=mysqli_fetch_assoc($result)){
   
    $postlike=$row["post_like"];
    $postid=$row["post_id"];
    $posttext=$row["post_description"];
    $postsrc=$row["post_path"];
    $postuserid=$row["post_userid"];
    $sql="SELECT * FROM `user_profile` WHERE `sr`='$postuserid'";
    $result2=mysqli_query($con,$sql);
    $row2=mysqli_fetch_assoc($result2);
$postusername= $row2["username"];
$postuserpath= $row2["path"];

echo'
  <div class="posters">
  <div class="postername">
  <a href="#" > <img src='.$postuserpath.'><h2>'.$postusername.'</h2></a>
  <div id="optionbar">
';
if($postuserid==$_SESSION['id']){echo '

  <button><a href="delete.php?id='.$postid.'" >Delete</a></button>
  <button " id='.$postid.'" value="1" class="edit"><a href="#?id='.$postid.'"  >update</a></button>
  ';}
  else{echo '
    <button><a href="#" >report</a></button>'; }
  echo '</div>
  </div>
<div class="poster">
<p>'.$posttext.'</p>';
if(!empty($postsrc)){ echo'
<img src='.$postsrc.'>';}
echo '
</div>
<div class="commentbar">
<button id="like">Like '.$postlike.'<button>
<button id="comment">Comment<button>
</div>
  </div>




';}

echo '</div>';}?>
<?php 
if(isset($_SESSION['loggedin'])&& $_SESSION['loggedin']==true ){
    echo'
<div class="page">
<div class="friends">';

$sql="SELECT * FROM `user_profile` ";
$result=mysqli_query($con,$sql);
$num=mysqli_num_rows($result);


while ( $row=mysqli_fetch_assoc($result)){
    $username=$row["username"];
    $pathsrc=$row["path"];
    $id=$row["sr"];
echo '
<div class="friend">
<a href="profile.php?id='.$id.' "> 
<img src="'.$pathsrc.'" alt="load"><p>'.$username.'</p>
</a>

</div>

';


} 
echo'
</div>

    
</div>';
}?>
<?php 
if(isset($_SESSION['loggedin'])&& $_SESSION['loggedin']==true ){
    echo' 
<div class="page">
    <h1>Wecome Videos</h1>
</div>
<div class="page">
    <h1>Welcome Notifications</h1>
</div>

<div class="page">
   <div class="profile">
    <div class="profiledown">




    <img src="'.$path.'" alt="profile">
    <br>
<h2>
    User name:<b style="color:white ;">'.$name.'</b><br> <button><a src="#">Change Username</a></button>

</h2>
<h2>
    Email:<b  style="color: white;">'.$email.'</b><br><button> <a src="#">Change email</a></button>

</h2>
<h2>
   Description:<b style="color: white ; ">'.$description.'</b><br> <button><a src="#">edit Description</a></button>

</h2>

</div>
   </div>


   
</div>
';} ?>
<?php
if(!isset($_SESSION['loggedin']) ){

echo '
<div class="page ">
    <div class="sign in">

        <form action="signin.php" method="post" enctype="multipart/form-data">
            <h1>Welcome To Blast Sign in form</h1>
    <p>Welcome to our website thanks for joining us </p>
           
            <label for="email">Enter Email</label><br>
            <input type="text" id="emailsign" name="email" placeholder="enter your Email"><br>
            <label for="password" >Enter password</label><br>
            <input type="password" id="passwordsign" name="password" placeholder="enter password"><br>
            
            <button type="submit">
                Submit
            </button>
            
              </form>
            </div>


  </form>
</div>
<div class="page active">
    <div class="sign up">

    <form action="signup.php" method="post" enctype="multipart/form-data" >
        <h1>Welcome To Blast Sign up form</h1>
<p>Welcome to our website thanks for joining us </p>
        <label for="username" >Enter Username</label><br>
        <input type="text" id="username" name="username" placeholder="enter your username"><br>
        <label for="email">Enter Email</label><br>
        <input type="text" id="email" name="email" placeholder="enter your Email"><br>
        <label for="password" >Enter password</label><br>
        <input type="password" id="password" name="password" placeholder="enter password"><br> 
        <label for="cpassword" >Enter Confirm Password</label><br>
        <input type="password" id="cpassword" name="cpassword" placeholder="Confirm password"><br> 
        <label for="description" >Enter description</label><br>
        <textarea id="description" name="description">
</textarea><br>
        <label for="file" >upload picture<br><img src="upload.png" alt="upload" id="filelabel"></label><br>
        <input type="file" accept="image/*" id="file" name="file"  onchange="loadFile(event)">
        <div  id="imgbox" ></div>
        
        <button type="submit" >
            Submit
        </button>
        
          </form>



        </div>
</div>

</div>
';}
?>
</section>

<script src="script.js"></script>
</body>
</html>