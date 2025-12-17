<?php
require __DIR__ . "/../config/database.php";

include "./header.php";
?>
<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="../css/rentupload.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>

    <body>
        <!-- NAVBAR -->
        <nav class="navbar">
            <div class="nav-left">
                <!-- <div class="logo">StayEase</div> -->
                <!-- <div class="search-box">
                    <input type="text" placeholder="Search houses, amenities, and owners">
                    <i class="fa fa-search"></i>
                </div> -->
            </div>

            <div class="nav-right">
                <a href="#" class="active">Overview</a>
                <a href="#">Rent</a>
                <a href="adminprofile.php?action=adminprofile">Listings</a>
                <a href="#">Activity</a>
                <a href="rentupload.php?action=rentupload" class="upload-btn">Upload</a>
                <div class="profile-pic"></div>
            </div>
        </nav>

        <div>
            <h2>List your Property for Rent</h2>
        </div>  
        
            <form id="rentForm" enctype="multipart/form-data">
            <div class="form-group upload_house_input">
                <label for="property_pictures">Upload House Image</label>
                <input 
                    type="file" 
                    id="property_pictures" 
                    name="property_pictures" 
                    accept="image/png, image/jpeg" />
            </div>

            <div class="form-group property_name_input">
                <label for="property_name">Property Name</label>
                <input 
                    type="text" 
                    id="property_name" 
                    name="property_name"
                    placeholder="e.g. Sunny Apartment in Center" required />
            </div>

            <div class="form-group address_input">
                <label for="property_address">Address</label>
                <input 
                    type="text" 
                    id="property_address" 
                    name="property_address"
                    placeholder="Enter the full address" required />
            </div>

            <div class="form-group rent_amount_input">
                <label for="rent_cost">Rent Amount per Month (€)</label>
                <input  
                    type="number"
                    id="rent_cost"
                    name="rent_cost"
                    min="0"
                    step="0.01"
                    placeholder="Enter the amount in Euro" required />
            </div>

            <div class="form-group description_input">
                <label for="property_description">Description</label>
                <textarea 
                    id="property_description" 
                    name="property_description" 
                    placeholder="Provide a detailed description of your property (number of rooms, nearby locations, etc.)"></textarea>
            </div>

            <div class="checkbox-container">
                <div class="status-box">
                    <label for="is_furnished">Is Furnished?</label>
                    <input 
                        type="checkbox"
                        id="is_furnished"
                        name="is_furnished"
                        value="1" />
                </div>

                <div class="status-box">
                    <label for="availability_status">Available from now?</label>
                    <input 
                        type="checkbox"
                        id="availability_status"
                        name="availability_status"
                        value="1"
                        checked /> </div>
            </div>

            <div class="submit_button">
                <input type="submit" value="Submit Listing" />
            </div>  

        </form>
        
        <footer class="footer_site">
            <div class="header_button">
                <p>© 2025 EaseStay. All rights reserved.</p>
            </div>
        </footer>

        <script>
document.getElementById("rentForm").addEventListener("submit", function (e) {
    e.preventDefault();

    let formData = new FormData(this);
    let xhr = new XMLHttpRequest();

    xhr.open("POST", "/index.php?action=rentupload", true);

    xhr.onload = function () {
        console.log("RAW:", xhr.responseText);

        try {
            let res = JSON.parse(xhr.responseText);

            if (res.status === "success") {
                alert("Property listed successfully");
                window.location.href = "/views/ownerlisting.php?action=owner";
            } else {
                alert(res.message);
            }
        } catch (e) {
            alert("Server error");
        }
    };

    xhr.send(formData);
});
</script>

    </body>
</html>

<?php
include "./footer.php"
?>