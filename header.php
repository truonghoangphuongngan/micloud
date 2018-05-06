<?php 
include_once("functions.php");
include_once("link-ref.php");

// Nếu người dùng submit form


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<style>

.flex-container{
    display: flex;
    background-color: #FFF5EE;
    justify-content: center;
}
.flex-container > div{
   
    margin: 0px 120px 0px 120px;
    width: 50px;
    font-size: 20px;
    text-align: center;
    background-color: brown;
    justify-content: center;
}


 
.container-1{
    display: flex;
    width: 200px;
    vertical-align: middle;
    white-space: nowrap;
    position: relative;
    justify-content: center;
}

.container-1 .icon{
    position: absolute;
    
    
    margin-top: 5px;

    z-index: 1;
    color: #fda6d0;
}

.container-1 input#search{
    
    width: 300px;
    height: 30px;
    background: #f0f1f1;
    border: none;
    font-size: 10pt;
    
    color: #ff0095;
    padding-left: 45px;
    -webkit-border-radius: 5px;
    -moz-border-radius: 5px;
    border-radius: 5px;
 
}


.container-1 input#search::-webkit-input-placeholder {
   color: #fda6d0;
}
.container-1 input#search:-moz-placeholder { /* Firefox 18- */
   color: #65737e;  
}
 
.container-1 input#search::-moz-placeholder {  /* Firefox 19+ */
   color: #65737e;  
}
 
.container-1 input#search:-ms-input-placeholder {  
   color: #65737e;  
}

.flex-head1{
    display: flex;
    
    justify-content: center;
}

.container-1 >div{
  
    margin: 10px 10px;
    font-size: 40px;
    text-align: center;
    background-color: rgb(42, 165, 108);
    justify-content: center;
}

.container-1 #image{
    
    margin: 10px 10px;
    width: 60px;
    height: 50px;
    background-color: rgb(54, 42, 165);
    justify-content: center;
    text-align: center;
}

.container-1 .img_head{

    margin: 10px 10px;
    justify-content: center;
    text-align: center;
    background-color: rgb(54, 42, 165);

}


</style>
<body>
    <div class="flex-container">
        <div class="container-1">
            <img src="icon.png" id="image" alt="Logo Micloud" width="40" height="40">
            <div>Micloud</div>
        </div>
     
        <div class="container-1">
            <form class="form" action="result_search.php" method="post">
                <input type="submit" id="submit_search" name="submit_search" class="fa fa-search">
                <input type="text" id="search" name="search" placeholder="Search..." />
            </form>
        </div>
       
        <div class="container-1">
                <img src="images/messenger.png" class="img_head" alt="Logo Micloud" width="30" height="30">
                <img src="images/ring.png" class="img_head" alt="Logo Micloud" width="30" height="30">
                <img src="images/user.png" class="img_head" alt="Logo Micloud" width="30" height="30">

        </div>
       

    </div>
</body>
</html>