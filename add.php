<?php
include('config/db.php'); 

$pizza = $email = $ing = '';
$errors = array('email' =>'', 'pizza'=>'', 'ing'=>'');

if(isset($_POST['submit']))
{

  if(empty($_POST['email'])) 
  {
    $errors['email'] = 'A email field cannot be empty';
  } 
  else
  {
      $email = $_POST['email'];
      if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $errors['email'] = 'Email must be valid email address ';
      }
  }

  if(empty($_POST['pizza']))
  {
    $errors['pizza'] = ' A title is required ';
  }
  else{
    $pizza = $_POST['pizza'];
    if(!preg_match('/^[a-zA-Z\s]+$/',$pizza))
    {
        $errors['pizza'] = 'Title must been letters and spaces only ';
    }
  }

  if(empty($_POST['ing'])){
    $errors['ing'] = 'This field is required ';
  }
  else
  {

    $ing = $_POST['ing'];
    if(!preg_match('/^([a-zA-Z\s]+)(,\$*[a-zA-Z\s]*)*$/',$ing)){
    $errors['ing'] = 'Must include comma and letters ';
    }
  }

    
 if(array_filter($errors))
 {
  
 }
 else{
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pizza = mysqli_real_escape_string($conn, $_POST['pizza']);
   $ing = mysqli_real_escape_string($conn, $_POST['ing']);

   $sql = "INSERT INTO shopping(title,email,ingredients) VALUES('$pizza', '$email',  '$ing')";
   if(mysqli_query($conn, $sql)){
    header('Location: index.php');
   }
   else
   {
     echo 'query error:' . mysqli_error($conn);
   }

  //header('Location: index.php');
 }
 }

?>
<!DOCTYPE html>
<html>
  <?php include('header.php'); ?>  
<section class="container gray-text"></section>
 <h4 class="center">Add a Pizza</h4>
 <form class="white" action="add.php" method="POST">
 <label>Enter Your Email:</label>
 <input type="text" name="email" value="<?php echo htmlspecialchars($email) ?>">
 <div class="red-text"> <?php echo $errors['email']; ?> </div>
 <label>Enter Pizza Title:</label>
 <input type="text" name="pizza" value="<?php echo htmlspecialchars($pizza) ?>">
 <div class="red-text"> <?php echo $errors['pizza']; ?> </div>
 <label>Enter Ingredients (Comma separated):</label>
 <input type="text" name="ing" value="<?php echo htmlspecialchars($ing) ?>">
 <div class="red-text"> <?php echo $errors['ing'];?> </div>
 <div class="center">
 <input type="Submit" name="submit" value="Submit" class="btn brand z-depth-0"> 
 </div>
 </form>
  <?php include('footer.php'); ?>
 
</html>