<?php
require_once('database.php');

// Get IDs
$pet_id = filter_input(INPUT_POST, 'pet_id', FILTER_VALIDATE_INT);
$category_id = filter_input(INPUT_POST, 'category_id', FILTER_VALIDATE_INT);

// Delete the product from the database
if ($pet_id != false && $category_id != false) {
    $query = "DELETE FROM pets
              WHERE petID = :pet_id";
    $statement = $db->prepare($query);
    $statement->bindValue(':pet_id', $pet_id);
    $statement->execute();
    $statement->closeCursor();
}

// display the Product List page
include('index.php');
?>