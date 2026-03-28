
 text slider 
<div class="scroll-right text-white py-2" style="background: black;">
  <div class="container">
    <div class="marquee">
      <?php
        //fetch posts from database
       $sql = "SELECT * FROM posts";
        $result = mysqli_query($conn, $sql);
        while ($post = mysqli_fetch_assoc($result)) {
       $post_id = $post['id'];
     ?>
     <a class="text-white" href="post.php?id=<?php echo $post['id']; ?>"><?= $post['title'] ?></a> |
     <?php } ?>
   </div>
 </div>
</div>

<style>
    
    
/* slideshow text */
.marquee {
   white-space: nowrap;
   overflow: hidden;
   animation: marquee 40s linear infinite;
    display: inline-block; /* Add this line */
 }
  
 @keyframes marquee {
   0% { 
     transform: translateX(100%);
   }
    100% {
     transform: translateX(-100%);
   }
 }
</style>




