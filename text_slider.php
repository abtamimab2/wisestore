
<div class="" style="width:100%;overflow:hidden !important;">
  <!-- text slider -->
  <div class="text-white py-2" style="background: black;width:100%;">
    <div class="container">
      <div class="marquee" onmouseover="pauseMarquee()" onmouseout="resumeMarquee()">
        <?php
          // fetch posts from database
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
</div>

<style>
/* slideshow text */
.marquee {
  white-space: nowrap;
  overflow: hidden;
  animation: marquee 60s linear infinite 0s;
  display: inline-block;
}

@keyframes marquee {
  0% {
    transform: translateX(100%);
  }
  100% {
    transform: translateX(-100%);
  }
}

/* Responsive adjustments */
@media (max-width: 576px) {
  .marquee {
    animation-duration: 100s; /* Adjust the duration as needed */
    animation-delay: 0s;
  }
}
</style>

<script>
var marqueeElement = document.querySelector(".marquee");
var isPaused = false;

function pauseMarquee() {
  marqueeElement.style.animationPlayState = "paused";
  isPaused = true;
}

function resumeMarquee() {
  if (isPaused) {
    marqueeElement.style.animationPlayState = "running";
    isPaused = false;
  }
}
</script>
