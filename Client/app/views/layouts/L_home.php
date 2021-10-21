<?php
$this->render('block/head',$contentHome);
$this->render('block/header');
$this->render($content,$contentHome);
$this->render('block/footer');
?>