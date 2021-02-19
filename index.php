<?php
require_once('database.php');
// Get category ID
if (!isset($category_id)) {
$category_id = filter_input(INPUT_GET, 'category_id', 
FILTER_VALIDATE_INT);
if ($category_id == NULL || $category_id == FALSE) {
$category_id = 1;
}
}

// Get name for current category
$queryCategory = "SELECT * FROM categories
WHERE categoryID = :category_id";
$statement1 = $db->prepare($queryCategory);
$statement1->bindValue(':category_id', $category_id);
$statement1->execute();
$category = $statement1->fetch();
$statement1->closeCursor();
$category_name = $category['categoryName'];

// Get all categories
$queryAllCategories = 'SELECT * FROM categories
ORDER BY categoryID';
$statement2 = $db->prepare($queryAllCategories);
$statement2->execute();
$categories = $statement2->fetchAll();
$statement2->closeCursor();

// Get pets for selected category
$queryRecords = "SELECT * FROM pets
WHERE categoryID = :category_id
ORDER BY petID";
$statement3 = $db->prepare($queryRecords);
$statement3->bindValue(':category_id', $category_id);
$statement3->execute();
$pets = $statement3->fetchAll();
$statement3->closeCursor();
?>
<div class="container">
<?php
include('includes/header.php');
?>
<h1>Record List</h1>
<?php
include('includes/sidebar.php');
?>
<section>
<!-- display a table of pets -->
<h2><?php echo $category_name; ?></h2>
<h1>This is a normal h1</h1>

<table>
<tr>
<th>Image</th>
<th>Name</th>
<th>Price</th>
<th>Colour</th>
<th>Delete</th>
<th>Edit</th>
</tr>
<?php foreach ($pets as $pet) : ?>
<tr>
<td><img src="image_uploads/<?php echo $pet['image']; ?>" width="100px" height="100px" /></td>
<td><?php echo $pet['name']; ?></td>
<td><?php echo $pet['price']; ?></td>
<td><?php echo $pet['colour']; ?></td>
<td><form action="delete_pet.php" method="post"
id="delete_pet_form">
<input type="hidden" name="pet_id"
value="<?php echo $pet['petID']; ?>">
<input type="hidden" name="category_id"
value="<?php echo $pet['categoryID']; ?>">
<input type="submit" value="Delete">
</form></td>
<td><form action="edit_pet_form.php" method="post"
id="delete_pet_form">
<input type="hidden" name="pet_id"
value="<?php echo $pet['petID']; ?>">
<input type="hidden" name="category_id"
value="<?php echo $pet['categoryID']; ?>">
<input type="submit" value="Edit">
</form></td>
</tr>
<?php endforeach; ?>
</table>
<p><a href="add_pet_form.php">Add Pet</a></p>
<p><a href="category_list.php">Manage Categories</a></p>
</section>
<?php
include('includes/footer.php');
?>