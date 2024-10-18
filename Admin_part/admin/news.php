<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
};

if(isset($_POST['add_news'])){

   $title = $_POST['title'];
   $title = filter_var($title, FILTER_SANITIZE_STRING);
   $date = $_POST['date'];
   $date = filter_var($date, FILTER_SANITIZE_STRING);
   $description = $_POST['description'];
   $description = filter_var($description, FILTER_SANITIZE_STRING);

   $image_01 = $_FILES['image_01']['name'];
   $image_01 = filter_var($image_01, FILTER_SANITIZE_STRING);
   $image_size_01 = $_FILES['image_01']['size'];
   $image_tmp_name_01 = $_FILES['image_01']['tmp_name'];
   $image_folder_01 = '../uploaded_img/'.$image_01;

   $image_02 = $_FILES['image_02']['name'];
   $image_02 = filter_var($image_02, FILTER_SANITIZE_STRING);
   $image_size_02 = $_FILES['image_02']['size'];
   $image_tmp_name_02 = $_FILES['image_02']['tmp_name'];
   $image_folder_02 = '../uploaded_img/'.$image_02;

   $image_03 = $_FILES['image_03']['name'];
   $image_03 = filter_var($image_03, FILTER_SANITIZE_STRING);
   $image_size_03 = $_FILES['image_03']['size'];
   $image_tmp_name_03 = $_FILES['image_03']['tmp_name'];
   $image_folder_03 = '../uploaded_img/'.$image_03;

   $select_news = $conn->prepare("SELECT * FROM `news` WHERE title = ?");
   $select_news->execute([$title]);

   if($select_news->rowCount() > 0){
      $message[] = 'News already exist!';
   }else{

      $insert_news = $conn->prepare("INSERT INTO `news`(title, date, description, news_photo_one, news_photo_two, news_photo_three) VALUES(?,?,?,?,?,?)");
      $insert_news->execute([$title, $date, $description, $image_01, $image_02, $image_03]);

      if($insert_news){
         if($image_size_01 > 2000000 OR $image_size_02 > 2000000 OR $image_size_03 > 2000000){
            $message[] = 'image size is too large!';
         }else{
            move_uploaded_file($image_tmp_name_01, $image_folder_01);
            move_uploaded_file($image_tmp_name_02, $image_folder_02);
            move_uploaded_file($image_tmp_name_03, $image_folder_03);
            $message[] = 'Your news is added!';
         }

      }

   }  

};

if(isset($_GET['delete'])){

   $delete_id = $_GET['delete'];
   $delete_news_image = $conn->prepare("SELECT * FROM `news` WHERE news_id = ?");
   $delete_news_image->execute([$delete_id]);
   $fetch_news_image = $delete_news_image->fetch(PDO::FETCH_ASSOC);
   unlink('../uploaded_img/'.$fetch_news_image['news_photo_one']);
   unlink('../uploaded_img/'.$fetch_news_image['news_photo_two']);
   unlink('../uploaded_img/'.$fetch_news_image['news_photo_three']);
   $delete_news = $conn->prepare("DELETE FROM `news` WHERE news_id = ?");
   $delete_news->execute([$delete_id]);
   header('location:news.php');
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>News</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <link rel="stylesheet" href="../css/admin_style.css">
   <link rel="icon" type="image/x-icon" href="">
</head>
<body>

<?php include '../components/admin_header.php'; ?>

<section class="add-products">

   <h1 class="heading">Add News</h1>

   <form action="" method="post" enctype="multipart/form-data">
      <div class="flex">
         <div class="inputBox">
            <span>News tile (required)</span>
            <input type="text" class="box" required maxlength="500" placeholder="enter news title" name="title">
         </div>
         <div class="inputBox">
            <span>Date</span>
            <input type="date" min="0" class="box"  placeholder="enter publishing date"  name="date">
         </div>
         <div class="inputBox">
            <span>Description (required)</span>
            <textarea name="description" placeholder="enter news details" class="box" required maxlength="1000" cols="30" rows="50"></textarea>
         </div>
        <div class="inputBox">
            <span>Image 01 (required)</span>
            <input type="file" name="image_01" accept="image/jpg, image/jpeg, image/png, image/webp" class="box" required>
        </div>
        <div class="inputBox">
            <span>Image 02 (required)</span>
            <input type="file" name="image_02" accept="image/jpg, image/jpeg, image/png, image/webp" class="box">
        </div>
        <div class="inputBox">
            <span>Image 03 (required)</span>
            <input type="file" name="image_03" accept="image/jpg, image/jpeg, image/png, image/webp" class="box">
        </div>
      </div>
      
      <input type="submit" value="add news" class="btn" name="add_news">
   </form>

</section>
<section class="show-products">

   <h1 class="heading">News Added</h1>
   
   <div class="box-container">

   <?php
      $select_data = $conn->prepare("SELECT * FROM `news`");
      $select_data->execute();
      if($select_data->rowCount() > 0){
         while($fetch_data = $select_data->fetch(PDO::FETCH_ASSOC)){ 
   ?>
   <div class="box">
      <img src="../uploaded_img/<?= $fetch_data['news_photo_one']; ?>" alt="">
      <div class="name"><?= $fetch_data['title']; ?></div>
      <div class="price"><span><?= $fetch_data['date']; ?></span></div>
      <div class="details"><span><?= $fetch_data['description']; ?></span></div>
      <div class="flex-btn">
         <a href="update_news.php?update=<?= $fetch_data['news_id']; ?>" class="option-btn">update</a>
         <a href="news.php?delete=<?= $fetch_data['news_id']; ?>" class="delete-btn" onclick="return confirm('delete this product?');">delete</a>
      </div>
   </div>
   <?php
         }
      }else{
         echo '<p class="empty">no news added yet!</p>';
      }
   ?>
   
   </div>

</section>










<script src="../js/admin_script.js"></script>
   
</body>
</html>