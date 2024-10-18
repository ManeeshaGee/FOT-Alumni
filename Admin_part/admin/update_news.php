<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
}

if(isset($_POST['update'])){

   $nid = $_POST['nid'];
   $title = $_POST['title'];
   $title = filter_var($title, FILTER_SANITIZE_STRING);
   $date = $_POST['date'];
   $date = filter_var($date, FILTER_SANITIZE_STRING);
   $details = $_POST['details'];
   $details = filter_var($details, FILTER_SANITIZE_STRING);

   $update_product = $conn->prepare("UPDATE `news` SET title = ?, date = ?, description = ? WHERE news_id = ?");
   $update_product->execute([$title, $date, $details, $nid]);

   $message[] = 'product updated successfully!';

   $old_image_01 = $_POST['old_image_01'];
   $image_01 = $_FILES['image_01']['name'];
   $image_01 = filter_var($image_01, FILTER_SANITIZE_STRING);
   $image_size_01 = $_FILES['image_01']['size'];
   $image_tmp_name_01 = $_FILES['image_01']['tmp_name'];
   $image_folder_01 = '../uploaded_img/'.$image_01;

   if(!empty($image_01)){
      if($image_size_01 > 2000000){
         $message[] = 'image size is too large!';
      }else{
         $update_image_01 = $conn->prepare("UPDATE `news` SET news_photo_id = ? WHERE id = ?");
         $update_image_01->execute([$image_01, $nid]);
         move_uploaded_file($image_tmp_name_01, $image_folder_01);
         unlink('../uploaded_img/'.$old_image_01);
         $message[] = 'image 01 updated successfully!';
      }
   }

   $old_image_02 = $_POST['old_image_02'];
   $image_02 = $_FILES['image_02']['name'];
   $image_02 = filter_var($image_02, FILTER_SANITIZE_STRING);
   $image_size_02 = $_FILES['image_02']['size'];
   $image_tmp_name_02 = $_FILES['image_02']['tmp_name'];
   $image_folder_02 = '../uploaded_img/'.$image_02;

   if(!empty($image_02)){
      if($image_size_02 > 2000000){
         $message[] = 'image size is too large!';
      }else{
         $update_image_02 = $conn->prepare("UPDATE `news` SET news_photo_two = ? WHERE id = ?");
         $update_image_02->execute([$image_02, $nid]);
         move_uploaded_file($image_tmp_name_02, $image_folder_02);
         unlink('../uploaded_img/'.$old_image_02);
         $message[] = 'image 02 updated successfully!';
      }
   }

   $old_image_03 = $_POST['old_image_03'];
   $image_03 = $_FILES['image_03']['name'];
   $image_03 = filter_var($image_03, FILTER_SANITIZE_STRING);
   $image_size_03 = $_FILES['image_03']['size'];
   $image_tmp_name_03 = $_FILES['image_03']['tmp_name'];
   $image_folder_03 = '../uploaded_img/'.$image_03;

   if(!empty($image_03)){
      if($image_size_03 > 2000000){
         $message[] = 'image size is too large!';
      }else{
         $update_image_03 = $conn->prepare("UPDATE `news` SET news_photo_three = ? WHERE id = ?");
         $update_image_03->execute([$image_03, $nid]);
         move_uploaded_file($image_tmp_name_03, $image_folder_03);
         unlink('../uploaded_img/'.$old_image_03);
         $message[] = 'image 03 updated successfully!';
      }
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Update News</title>
   <link rel="icon" type="image/x-icon" href="">

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <link rel="stylesheet" href="../css/admin_style.css">

</head>
<body>

<?php include '../components/admin_header.php'; ?>

<section class="update-product">

   <h1 class="heading">Update News</h1>

   <?php
      $update_id = $_GET['update'];
      $select_data = $conn->prepare("SELECT * FROM `news` WHERE news_id = ?");
      $select_data->execute([$update_id]);
      if($select_data->rowCount() > 0){
         while($fetch_data = $select_data->fetch(PDO::FETCH_ASSOC)){ 
   ?>
   <form action="" method="post" enctype="multipart/form-data">
      <input type="hidden" name="nid" value="<?= $fetch_data['news_id']; ?>">
      <input type="hidden" name="old_image_01" value="<?= $fetch_data['news_photo_one']; ?>">
      <input type="hidden" name="old_image_02" value="<?= $fetch_data['news_photo_two']; ?>">
      <input type="hidden" name="old_image_03" value="<?= $fetch_data['news_photo_three']; ?>">
      <div class="image-container">
         <div class="main-image">
            <img src="../uploaded_img/<?= $fetch_data['news_photo_one']; ?>" alt="">
         </div>
         <div class="sub-image">
            <img src="../uploaded_img/<?= $fetch_data['news_photo_one']; ?>" alt="">
            <img src="../uploaded_img/<?= $fetch_data['news_photo_two']; ?>" alt="">
            <img src="../uploaded_img/<?= $fetch_data['news_photo_three']; ?>" alt="">
         </div>
      </div>
      <span>Update title</span>
      <input type="text" name="title" class="box" maxlength="100" placeholder="enter news title" value="<?= $fetch_data['title']; ?>">
      <span>Update date</span>
      <input type="date" name="date"  class="box" placeholder="enter publishing date" <?= $fetch_data['date']; ?>>
      <span>Update description</span>
      <textarea name="details" class="box" cols="30" rows="10"><?= $fetch_data['description']; ?></textarea>
      <span>Update image 01</span>
      <input type="file" name="image_01" accept="image/jpg, image/jpeg, image/png, image/webp" class="box">
      <span>Update image 02</span>
      <input type="file" name="image_02" accept="image/jpg, image/jpeg, image/png, image/webp" class="box">
      <span>Update image 03</span>
      <input type="file" name="image_03" accept="image/jpg, image/jpeg, image/png, image/webp" class="box">
      <div class="flex-btn">
         <input type="submit" name="update" class="btn" value="update">
         <a href="news.php" class="option-btn">Go Back.</a>
      </div>
   </form>
   
   <?php
         }
      }else{
         echo '<p class="empty">no news found!</p>';
      }
   ?>

</section>












<script src="../js/admin_script.js"></script>
   
</body>
</html>