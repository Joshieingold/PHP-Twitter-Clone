<?php

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="DESC MISSING">
  <meta name="author" content="Nick Taggart, nick.taggart@nbcc.ca">
  <title>Y - Why use X when you can use Y!</title>
  <link href="includes/y.css" rel="stylesheet">
    <!-- Bootstrap core CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="icon" href="favicon.ico">
    
</head>
<body >
  <header>
    <div id="divLogo" >
      <img alt="Y Logo" src="img/y_logo.png" class="logo">
    </div>
    <div class="profile-container ms-auto">
      <a href="#" class="nav-link dropdown-toggle" id="dropdown01" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <img alt="Elon Musk Silhouette" src="img/profilepics/ElonSilouette.jpg" class="profilepic">
      </a>
      <div class="dropdown-menu" aria-labelledby="dropdown01">
        <a class="dropdown-item" href="logout.php">Logout</a>
        <a class="dropdown-item" href="upload_photo.php">Edit Profile Picture</a>
      </div>
    </div>
  </header>
  <div id="wrapper">
  <aside class="sidebar">
    <nav>
      
      <a href="#">
      <svg fill="none" width="28" viewBox="0 0 24 24" height="28" aria-hidden="true" style="color: rgb(249, 250, 251);">
        <path fill="hsl(213, 51.40%, 86.30%)" fill-rule="evenodd" clip-rule="evenodd" d="M12.63 1.724a1 1 0 0 0-1.26 0l-8 6.5A1 1 0 0 0 3 9v11a1 1 0 0 0 1 1h5a1 1 0 0 0 1-1v-6h4v6a1 1 0 0 0 1 1h5a1 1 0 0 0 1-1V9a1 1 0 0 0-.37-.776l-8-6.5Z">

        </path>
      </svg>
      Home</a>
      <a href="#">
      <svg fill="none" width="28" viewBox="0 0 24 24" height="28" aria-hidden="true" style="color: rgb(249, 250, 251);"><path fill="hsl(213, 51.40%, 86.30%)" fill-rule="evenodd" clip-rule="evenodd" d="M4.216 8.815a7.853 7.853 0 0 1 15.568 0l1.207 9.053A1 1 0 0 1 20 19h-3.354c-.904 1.748-2.607 3-4.646 3-2.039 0-3.742-1.252-4.646-3H4a1 1 0 0 1-.991-1.132l1.207-9.053ZM9.778 19c.61.637 1.399 1 2.222 1s1.613-.363 2.222-1H9.778ZM12 4a5.853 5.853 0 0 0-5.802 5.08L5.142 17h13.716l-1.056-7.92A5.853 5.853 0 0 0 12 4Z"></path></svg>
      Notifications</a>
      <a href="#"><svg fill="none" width="28" viewBox="0 0 24 24" height="28" aria-hidden="true" style="color: rgb(249, 250, 251);"><path fill="hsl(213, 51.40%, 86.30%)" fill-rule="evenodd" clip-rule="evenodd" d="M4 12a8 8 0 1 1 4.445 7.169 1 1 0 0 0-.629-.088l-3.537.662.7-3.415a1 1 0 0 0-.09-.66A7.961 7.961 0 0 1 4 12Zm8-10C6.477 2 2 6.477 2 12c0 1.523.341 2.968.951 4.262l-.93 4.537a1 1 0 0 0 1.163 1.184l4.68-.876A9.968 9.968 0 0 0 12 22c5.523 0 10-4.477 10-10S17.523 2 12 2ZM7.5 13.25a1.25 1.25 0 1 1 0-2.5 1.25 1.25 0 0 1 0 2.5Zm4.5 0a1.25 1.25 0 1 1 0-2.5 1.25 1.25 0 0 1 0 2.5Zm4.5 0a1.25 1.25 0 1 1 0-2.5 1.25 1.25 0 0 1 0 2.5Z"></path></svg>
      Messages      
      </a>
      <a href="#">
      <svg fill="none" width="28" viewBox="0 0 24 24" height="28" aria-hidden="true" style="color: rgb(249, 250, 251);"><path fill="hsl(213, 51.40%, 86.30%)" fill-rule="evenodd" clip-rule="evenodd" d="M11 5a6 6 0 1 0 0 12 6 6 0 0 0 0-12Zm-8 6a8 8 0 1 1 14.32 4.906l3.387 3.387a1 1 0 0 1-1.414 1.414l-3.387-3.387A8 8 0 0 1 3 11Z"></path></svg>
      Explore</a>
      <a href="#">
      <svg fill="none" width="28" height="28" viewBox="0 0 24 24" aria-hidden="true" style="color: rgb(249, 250, 251);">
  <path fill="hsl(213, 51.40%, 86.30%)" fill-rule="evenodd" clip-rule="evenodd"
    d="M12 2c-.55 0-1 .45-1 1v1.26C7.17 5.4 4 9.15 4 13.5 4 17.64 7.36 21 11.5 21h1c4.14 0 7.5-3.36 7.5-7.5 0-4.35-3.17-8.1-7-9.24V3c0-.55-.45-1-1-1Zm0 14.5-3.09 1.63.59-3.44-2.5-2.44 3.46-.5L12 8l1.54 3.15 3.46.5-2.5 2.44.59 3.44L12 16.5Z" />
</svg>

Y Premium</a>
      <a href="#" class="btn btn-primary w-100 mt-4" data-bs-toggle="modal" data-bs-target="#newPostModal">
        New Post
      </a>
    </nav>
  </aside>

  <main>
  <!--hardcoded placeholders for now -->
    <div class="post">
      <span>@parodyfan</span><br>
      Just joined Y! Where no one reads past the headline. #Yzone
    </div>
    <div class="post">
      <span>@nonsense_bot</span><br>
      BREAKING: Experts baffled as absolutely nothing happens. Again.
    </div>
    <div class="post">
      <span>@elon_slightly</span><br>
      Am considering rebranding Y to ∞ and removing all vowels.
    </div>
  </main>
 <aside class="rightbar">
      <!-- Right sidebar content -->
      <input type="text" class="form-control mb-3" placeholder="Search Y">
      <h5>Who to Troll</h5>
      <ul>
        <li><img src="img/profilepics/ElonSilouette.jpg" class="profilepic">&nbsp;<a href="proc/follow_proc.php?user_id=1">Elon Musk</a></li>
        <li><img src="img/profilepics/ElonSilouette.jpg" class="profilepic">&nbsp;<a href="proc/follow_proc.php?user_id=2">Will Smith</a></li>
        <li><img src="img/profilepics/ElonSilouette.jpg" class="profilepic">&nbsp;<a href="proc/follow_proc.php?user_id=3">Chris Hadfield</a></li>
      </ul>
    </aside>
</div>

<!--Bootstrap "New Post" modal-->
<form action="proc/post_proc.php" method="POST">
<div class="modal fade" id="newPostModal" tabindex="-1" aria-labelledby="newPostModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content bg-dark text-light">
      <div class="modal-header border-0">
        <h5 class="modal-title" id="newPostModalLabel">Create a Post</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <textarea class="form-control bg-black text-light post-textarea" placeholder="What's on your mind?" rows="4"></textarea>
      </div>
      <div class="modal-footer border-0">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-primary">Post</button>
      </div>
    </div>
  </div>
</div>
</form>

<!--End modal-->
  <!-- put this JS at the bottom so the page will load faster-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

