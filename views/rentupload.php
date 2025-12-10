<?php
require __DIR__ . "/../config/database.php";

include "./header.php"
?>
<!DOCTYPE html>

<html>
    <head>
        <link rel="stylesheet" href="../css/rentupload.css">
    </head>

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
            <a href="ownerlisting.php?action=owner" class="active">Overview</a>
            <a href="#">Rent</a>
            <a href="adminprofile.php?action=adminprofile">Listings</a>
            <a href="#">Activity</a>
            <a href="rentupload.php?action=rentupload" class="upload-btn">Upload</a>
            <div class="profile-pic"></div>
        </div>
    </nav>

    <body>
        <div>
            <h2>List your Property for Rent</h2>
        </div>  
        <form>
            <div class="upload_house_input">
            <label for="property_pictures">Upload House Image</label><br>
            <input 
                type="file" 
                id="property_pictures" 
                name="property_pictures" 
                accept="image/png, image/jpeg" />
            </div>

            <div class="property_name_input">
            <label for="property_name"> Property Name</label><br>
            <input 
                type="text" 
                id="property_name" 
                name="property_name"
                placeholder="Enter the property name" /><br>
            </div>

            <div class="rent_amount_input">
            <label for="rent_cost">Rent Amount per Month</label><br>
            <input  
                type="number"
                id="rent_cost"
                name="rent_cost"
                min="0"
                placeholder="Enter the amount in Euro" /><br>
            </div>

            <div class="description_input">
            <label for="property_description"> Description</label><br>
            <input
                type="test"
                id="property_description"
                name="property_description"
                placeholder="Provide a detailed description of your property"/><br>
            </div>

            <div class="availability_status">
            <label for="availability_status"> Availability Status </label>
            <input 
                type="checkbox"
                id="availability_status"
                name="availability_status"/>
            </div>

            <div class="submit_button">
            <input 
                type="button" 
                value="Submit Listing" />
            </div>  

        </form>
    </body>
    <footer class="footer_site">
        <div class="header_button">
            <p>© 2025 EaseStay</p>
            <p>All rights reserved.</p>
        </div>
    </footer>
</html>