<?php include 'inc/header.php'; ?>

<?php

$sql = "SELECT * FROM feedback";
$result = mysqli_query($conn, $sql);
$feedback = mysqli_fetch_all($result, MYSQLI_ASSOC);

?>


<h2>Feedback</h2>
<?php if (empty($feedback)) : ?>
  <p class="lead mt3">There is no feedback</p>
<?php else : ?>
  <p class="lead mt3">There is a lot of feedbacks</p>
<?php endif ?>

<?php foreach ($feedback as $item) : ?>

  <div class="card my-3 w-75">
    <div class="card-body text-center">
      <p><?php echo $item['body']; ?></p>
      <div class="text-secondary mt-2">
        From <strong><?php echo $item['name']; ?></strong>
      </div>
      <div class="text-secondary mt-2">
        Posted by <strong><?php echo $item['email']; ?></strong>
      </div>
    </div>
  </div>

<?php endforeach; ?>
<?php include 'inc/footer.php'; ?>