<?php 
include('config/db.php');
$conn = mysqli_connect('localhost', 'sanket', 'sanket123', 'pizza');

if(!$conn)
{
  echo 'error' . mysqli_connect_error();
}

$sql = 'SELECT title, ingredients, id FROM shopping ORDER BY time';

$result = mysqli_query($conn, $sql);

$pizza = mysqli_fetch_all($result, MYSQLI_ASSOC);

mysqli_free_result($result);

mysqli_close($conn);

//print_r(explode(',', $pizza[0]['ingridients']));


?>
<!DOCTYPE html>
<html>

  <?php include('header.php'); ?> 
  
  <h4 class="center grey-text">Orders</h4>

  <div class="container">
    <div class="row">
      <?php  foreach($pizza as $pizza) : ?>
      <div class="col s6 md3">
        <div class="card z-depth-0">
        <img src="img/pizza.jpg" class="pizza">

          <div class="card-content center">
            <h6> <?php echo htmlspecialchars($pizza['title']); ?></h6>
            <ul>
              <?php foreach(explode(',' , $pizza['ingredients']) as $ing) : ?>
              <li><?php echo htmlspecialchars($ing); ?> </li>
              <?php endforeach; ?>
            </ul>
          </div>
          <div class="card-action right-align">
            <a class="brand-text" href="details.php?id= <?php echo $pizza['id']?>">more info</a>
          </div>
        </div>
      </div>
      <?php endforeach; ?>

    </div>
  </div>
  
  <?php include('footer.php'); ?>
</html>