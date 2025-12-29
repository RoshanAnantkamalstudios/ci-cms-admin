<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Brahma Valley ITI</title>
  <link rel="icon" href="<?= base_url() ?>public/front_end/img/logo.png" type="image/png">
  <!-- Bootstrap 5 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Animate.css -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" rel="stylesheet">
  <!-- AOS CSS -->
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
  <!-- Bootstrap Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
  <!-- Google Fonts: Poppins -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <!-- Custom CSS -->
  <!-- <link rel="stylesheet" href="css/bootstrap.css" /> -->
  <link rel="stylesheet" href="<?= base_url() ?>public/front_end/css/flaticon.css" />
  <link rel="stylesheet" href="<?= base_url() ?>public/front_end/css/themify-icons.css" />
  <link rel="stylesheet" href="<?= base_url() ?>public/front_end/vendors/owl-carousel/owl.carousel.min.css" />
  <link rel="stylesheet" href="<?= base_url() ?>public/front_end/vendors/nice-select/css/nice-select.css" />
  <link rel="stylesheet" href="<?= base_url() ?>public/front_end/css/newstyle.css">
</head>
<body class="index-page">
    <!--================ Header Menu Area =================-->
 <?= $this->include("layout/widget_frontend/header.php") ?>
  <!--================ End Header Menu Area =================-->

                <?= $this->renderSection('content') ?>
               
  <?= $this->include("layout/widget_frontend/footer.php") ?>
