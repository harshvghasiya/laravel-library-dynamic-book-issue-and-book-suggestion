<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="format-detection" content="telephone=no">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0"/>
    <?php echo $__env->yieldContent("metaData"); ?>
    <?php echo $__env->yieldContent("title"); ?>
    <meta charset="utf-8"/>
    <link rel="icon" href="<?php echo e(UPLOAD_AND_DOWNLOAD_URL()); ?>public/front/img/core-img/favicon.ico">
    <link rel="stylesheet" href="<?php echo e(UPLOAD_AND_DOWNLOAD_URL()); ?>public/front/style.css">
    <link rel="stylesheet" href="<?php echo e(UPLOAD_AND_DOWNLOAD_URL()); ?>public/front/css/normalize.css">
    <link rel="stylesheet" href="<?php echo e(UPLOAD_AND_DOWNLOAD_URL()); ?>public/front/css/main.css">
    <link rel="stylesheet" href="<?php echo e(UPLOAD_AND_DOWNLOAD_URL()); ?>public/front/toaster/toastr.css">

    <script src="<?php echo e(UPLOAD_AND_DOWNLOAD_URL()); ?>public/front/js/jquery/jquery-2.2.4.min.js"></script>
    <script src="<?php echo e(UPLOAD_AND_DOWNLOAD_URL()); ?>public/front/js/modernizr-2.6.2.min.js"></script>
    <script src="<?php echo e(UPLOAD_AND_DOWNLOAD_URL()); ?>public/front/toaster/toastr.min.js"></script>
   
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-158361593-1"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'UA-158361593-1');
    </script>

    <?php echo $__env->yieldContent("style"); ?>
</head><?php /**PATH /var/www/html/softtechover/resources/views/layouts/head.blade.php ENDPATH**/ ?>