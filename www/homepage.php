<?php


	include 'includes/db.php';
	include 'includes/functions.php';
	include 'includes/header2.php';




?>	

		 <div class="blog-masthead">
      <div class="container">
        <nav class="nav blog-nav">
          <a class="nav-link active" href="#">Home</a>
          <a class="nav-link" href="#">New features</a>
          <a class="nav-link" href="#">View Posts</a>
          <a class="nav-link" href="#">New Posts</a>
          <a class="nav-link" href="#">About</a>
        </nav>
      </div>
      </div>

       <div class="blog-header">
      <div class="container">
        <h1 class="blog-title">The ALARIWO OF AFRICA</h1>
        <p class="lead blog-description">This is a blog where the tales under the moonlight are being told by the elders.</p>
      </div>
    </div>


    	<div class="container">

      <div class="row">

        <div class="col-sm-8 blog-main">

       <?php $display = DisplayPosts($conn); echo $display; ?>

          <div class="blog-post">
            <h2 class="blog-post-title">Sample blog post</h2>
            <p class="blog-post-meta">January 1, 2014 by <a href="#">Mark</a></p></div>


            <div class="sidebar-module">
            <h4>Archives</h4>
            <!-- <ol class="list-unstyled"> -->
              
            <?php $display = DisplayArchive($conn); echo $display; ?>

            <!-- </ol> -->
          </div>

