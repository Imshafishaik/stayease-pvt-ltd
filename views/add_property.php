<?php include 'header.php'; ?>

<div class="container">
    <h2>Add New Property</h2>
    <form action="../controllers/add_property.php" method="post" enctype="multipart/form-data">
        <label for="title">Title:</label>
        <input type="text" id="title" name="title" required>

        <label for="description">Description:</label>
        <textarea id="description" name="description" required></textarea>

        <label for="rent">Rent Price (per month):</label>
        <input type="number" id="rent" name="rent" required>

        <label for="city">City:</label>
        <input type="text" id="city" name="city" required>

        <label for="address">Address:</label>
        <input type="text" id="address" name="address" required>

        <label for="amenities">Amenities (comma-separated):</label>
        <input type="text" id="amenities" name="amenities">

        <label for="photos">Photos:</label>
        <input type="file" id="photos" name="photos[]" multiple>

        <button type="submit">Add Property</button>
    </form>
</div>

<?php include 'footer.php'; ?>