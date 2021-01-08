<?php

include('config/db.php');
if(isset($_POST['delete']))
{
    $id_to_delete = mysqli_real_escape_string($conn,$_POST['id_to_delete']);

    $sql = "DELETE FROM shopping WHERE id=$id_to_delete";

    if(mysqli_query($conn,$sql))
    {
        
        header('Location: index.php');
    }
     {
        echo 'error' . mysqli_error($conn);
    }
}
if(isset($_GET['id']))
{
$id = mysqli_real_escape_string($conn,$_GET['id']);

}
$sql = "SELECT * FROM shopping WHERE id = $id";
$result = mysqli_query($conn,$sql);
$pizza= mysqli_fetch_assoc($result);
mysqli_free_result($result);
mysqli_close($conn);



?>

<!DOCTYPE html>
<html>

<?php include('header.php');?>

<h4 class="center black-text">Details</h4>

  
<div class="container center grey lighten-3">
    <?php if($pizza): ?>
        <h4><?php echo htmlspecialchars($pizza['title']);?></h4>

        <h6>Ordered by:</h6> <p><?php echo htmlspecialchars($pizza['email']);?></p>
        <p><h6>Created at:</h6><?php echo htmlspecialchars($pizza['time']);?></p>

      <p> <h6>Ingredients: </h6> <?php echo htmlspecialchars($pizza['ingredients'])?></p>

        <form action"details.php method="POST">
            <input type="hidden" name="id_to_delete" value="<?php echo $pizza['id']?> ">
            <input type="submit" name="delete" value="Delete" class="btn brand z-depth-0">
        </form>

        <?php else : ?>
            <h5>No Such Pizza Exist</h5>
        <?php endif; ?>   
</div>
<?php include('footer.php');?>

</html>