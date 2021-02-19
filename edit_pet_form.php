<?php
require('database.php');

$pet_id = filter_input(INPUT_POST, 'pet_id', FILTER_VALIDATE_INT);
$query = 'SELECT *
          FROM pets
          WHERE petID = :pet_id';
$statement = $db->prepare($query);
$statement->bindValue(':pet_id', $pet_id);
$statement->execute();
$pets = $statement->fetch(PDO::FETCH_ASSOC);
$statement->closeCursor();
?>
<!-- the head section -->
 <div class="container">
<?php
include('includes/header.php');
?>
        <h1>Edit Product</h1> 
        <form action="edit_pet.php" method="post" enctype="multipart/form-data"
              id="edit_pet_form">
            <input type="hidden" name="original_image" value="<?php echo $pets['image']; ?>" />
            <input type="hidden" name="pet_id"
                   value="<?php echo $pets['petID']; ?>">

            <label>Category ID:</label>
            <input type="category_id" name="category_id"
                   value="<?php echo $pets['categoryID']; ?>">
            <br>

            <label>Name:</label>
            <input type="input" name="name"
                   value="<?php echo $pets['name']; ?>">
            <br>

            <label>List Price:</label>
            <input type="input" name="price"
                   value="<?php echo $pets['price']; ?>">
            <br>

            <label>Colour:</label>
            <input type="input" name="colour"
                   value="<?php echo $pets['colour']; ?>">
            <br>

            <label>Image:</label>
            <input type="file" name="image" accept="image/*" />
            <br>            
            <?php if ($pets['image'] != "") { ?>
            <p><img src="image_uploads/<?php echo $pets['image']; ?>" height="150" /></p>
            <?php } ?>
            
            <label>&nbsp;</label>
            <input type="submit" value="Save Changes">
            <br>
        </form>
        <p><a href="index.php">View Homepage</a></p>
    <?php
include('includes/footer.php');
?>