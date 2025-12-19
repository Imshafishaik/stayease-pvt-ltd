<?php
require __DIR__ . "/../config/database.php";

include "./views/header.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EaseStay Admin Dashboard</title>
    <link rel="stylesheet" href="../css/adminprofile.css"> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>
<body>

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
            <a href="#">Listings</a>
            <a href="#">Activity</a>
            <a href="/index.php?action=rentupload" class="upload-btn">Upload</a>
            <div class="profile-pic"></div>
        </div>
    </nav>

        <main class="main">
            <div class="sidebar">
                <h3 class="sidebar-title">Quick Links</h3>
                <ul class="quick-links scrollbar">
                    <li><a href="#">User Management</a></li>
                    <li><a href="#">House Management</a></li>
                    <li><a href="#">User Management</a></li>                  
                </ul>
            </div>

            <section class="content">

                <div class="documents" >
                    <h2 class="documents-header">User Documents</h2>
                    <div class="scrollbar">
                    <div class="document-card" >
                        <div class="document-info" >
                            <img src="https://img.freepik.com/darmowe-zdjecie/portret-przystojny-usmiechajacy-sie-stylowy-hipster-lambersexual-model-sexy-mezczyzna-ubrany-w-tshirt-i-dzinsy-moda-mezczyzna-na-bialym-tle-na-niebieskiej-scianie-w-studio_158538-26731.jpg?semt=ais_incoming&w=740&q=80" alt="John Smith" class="profile-pic">
                            <div class="document-details">
                                <p class="document-owner">John Smith</p>
                                <p class="document-type">Passport</p>
                            </div>
                        </div>
                        <div class="document-actions">
                            <button class="action accept">Accept</button>
                            <button class="action reject">Reject</button>
                        </div>
                    </div>

                    <div class="document-card">
                        <div class="document-info">
                            <img src="https://media.istockphoto.com/id/1326417862/fr/photo/jeune-femme-qui-rit-tout-en-se-relaxant-%C3%A0-la-maison.jpg?s=612x612&w=0&k=20&c=9kSRtp-LQLeKGWiBqBBNNmPKpzxoO445dyE3bLWQVm4=" alt="Emily Johnson" class="profile-pic">
                            <div class="document-details">
                                <p class="document-owner">Emily Johnson</p>
                                <p class="document-type">Visa</p>
                            </div>
                        </div>
                        <div class="document-actions">
                            <button class="action accept">Accept</button>
                            <button class="action reject">Reject</button>
                        </div>
                    </div>

                    <div class="document-card">
                        <div class="document-info">
                            <img src="https://media.istockphoto.com/id/1326417862/fr/photo/jeune-femme-qui-rit-tout-en-se-relaxant-%C3%A0-la-maison.jpg?s=612x612&w=0&k=20&c=9kSRtp-LQLeKGWiBqBBNNmPKpzxoO445dyE3bLWQVm4=" alt="Emily Johnson" class="profile-pic">
                            <div class="document-details">
                                <p class="document-owner">Emily Johnson</p>
                                <p class="document-type">Visa</p>
                            </div>
                        </div>
                        <div class="document-actions">
                            <button class="action accept">Accept</button>
                            <button class="action reject">Reject</button>
                        </div>
                    </div>

                    <div class="document-card">
                        <div class="document-info">
                            <img src="https://media.istockphoto.com/id/1326417862/fr/photo/jeune-femme-qui-rit-tout-en-se-relaxant-%C3%A0-la-maison.jpg?s=612x612&w=0&k=20&c=9kSRtp-LQLeKGWiBqBBNNmPKpzxoO445dyE3bLWQVm4=" alt="Emily Johnson" class="profile-pic">
                            <div class="document-details">
                                <p class="document-owner">Emily Johnson</p>
                                <p class="document-type">Visa</p>
                            </div>
                        </div>
                        <div class="document-actions">
                            <button class="action accept">Accept</button>
                            <button class="action reject">Reject</button>
                        </div>
                    </div>

                    <div class="document-card" >
                        <div class="document-info" >
                            <img src="https://img.freepik.com/darmowe-zdjecie/portret-przystojny-usmiechajacy-sie-stylowy-hipster-lambersexual-model-sexy-mezczyzna-ubrany-w-tshirt-i-dzinsy-moda-mezczyzna-na-bialym-tle-na-niebieskiej-scianie-w-studio_158538-26731.jpg?semt=ais_incoming&w=740&q=80" alt="John Smith" class="profile-pic">
                            <div class="document-details">
                                <p class="document-owner">John Smith</p>
                                <p class="document-type">Passport</p>
                            </div>
                        </div>
                        <div class="document-actions">
                            <button class="action accept">Accept</button>
                            <button class="action reject">Reject</button>
                        </div>
                    </div>

                    <div class="document-card">
                        <div class="document-info">
                            <img src="https://media.istockphoto.com/id/1326417862/fr/photo/jeune-femme-qui-rit-tout-en-se-relaxant-%C3%A0-la-maison.jpg?s=612x612&w=0&k=20&c=9kSRtp-LQLeKGWiBqBBNNmPKpzxoO445dyE3bLWQVm4=" alt="Emily Johnson" class="profile-pic">
                            <div class="document-details">
                                <p class="document-owner">Emily Johnson</p>
                                <p class="document-type">Visa</p>
                            </div>
                        </div>
                        <div class="document-actions">
                            <button class="action accept">Accept</button>
                            <button class="action reject">Reject</button>
                        </div>
                    </div>

                    <div class="document-card" >
                        <div class="document-info" >
                            <img src="https://img.freepik.com/darmowe-zdjecie/portret-przystojny-usmiechajacy-sie-stylowy-hipster-lambersexual-model-sexy-mezczyzna-ubrany-w-tshirt-i-dzinsy-moda-mezczyzna-na-bialym-tle-na-niebieskiej-scianie-w-studio_158538-26731.jpg?semt=ais_incoming&w=740&q=80" alt="John Smith" class="profile-pic">
                            <div class="document-details">
                                <p class="document-owner">John Smith</p>
                                <p class="document-type">Passport</p>
                            </div>
                        </div>
                        <div class="document-actions">
                            <button class="action accept">Accept</button>
                            <button class="action reject">Reject</button>
                        </div>
                    </div>

                    <div class="document-card">
                        <div class="document-info">
                            <img src="https://media.istockphoto.com/id/1326417862/fr/photo/jeune-femme-qui-rit-tout-en-se-relaxant-%C3%A0-la-maison.jpg?s=612x612&w=0&k=20&c=9kSRtp-LQLeKGWiBqBBNNmPKpzxoO445dyE3bLWQVm4=" alt="Emily Johnson" class="profile-pic">
                            <div class="document-details">
                                <p class="document-owner">Emily Johnson</p>
                                <p class="document-type">Visa</p>
                            </div>
                        </div>
                        <div class="document-actions">
                            <button class="action accept">Accept</button>
                            <button class="action reject">Reject</button>
                        </div>
                    </div>
                    </div>
                </div>

                <div class="documents">
                    <h2 class="documents-header">House Documents</h2>
                    <div class="scrollbar">
                    <div class="document-card">
                        <div class="document-info">
                            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRWeSGMK9-ESewPZwZuUxlj5RrLl9HWVGknog&s" alt="Michael Brown Document" class="profile-pic">
                            <div class="document-details">
                                <p class="document-owner">Michael Brown</p>
                                <p class="document-type">Registration Document</p>
                            </div>
                        </div>
                        <div class="document-actions">
                            <button class="action accept">Accept</button>
                            <button class="action reject">Reject</button>
                        </div>
                    </div>

                    <div class="document-card">
                        <div class="document-info">
                            <img src="https://media.gettyimages.com/id/685132223/fr/photo/businesswoman-with-braided-hair-over-white.jpg?s=612x612&w=gi&k=20&c=ttZAIqd70SLAm1JgkkSDX5xcG4uXahLd1DpIYuF9J3E=" alt="Sarah Lewis Document" class="profile-pic">
                            <div class="document-details">
                                <p class="document-owner">Sarah Lewis</p>
                                <p class="document-type">Registration Document</p>
                            </div>
                        </div>
                        <div class="document-actions">
                            <button class="action accept">Accept</button>
                            <button class="action reject">Reject</button>
                        </div>
                    </div>

                    <div class="document-card">
                        <div class="document-info">
                            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRWeSGMK9-ESewPZwZuUxlj5RrLl9HWVGknog&s" alt="Michael Brown Document" class="profile-pic">
                            <div class="document-details">
                                <p class="document-owner">Michael Brown</p>
                                <p class="document-type">Registration Document</p>
                            </div>
                        </div>
                        <div class="document-actions">
                            <button class="action accept">Accept</button>
                            <button class="action reject">Reject</button>
                        </div>
                    </div>

                    <div class="document-card">
                        <div class="document-info">
                            <img src="https://media.gettyimages.com/id/685132223/fr/photo/businesswoman-with-braided-hair-over-white.jpg?s=612x612&w=gi&k=20&c=ttZAIqd70SLAm1JgkkSDX5xcG4uXahLd1DpIYuF9J3E=" alt="Sarah Lewis Document" class="profile-pic">
                            <div class="document-details">
                                <p class="document-owner">Sarah Lewis</p>
                                <p class="document-type">Registration Document</p>
                            </div>
                        </div>
                        <div class="document-actions">
                            <button class="action accept">Accept</button>
                            <button class="action reject">Reject</button>
                        </div>
                    </div>

                    <div class="document-card">
                        <div class="document-info">
                            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRWeSGMK9-ESewPZwZuUxlj5RrLl9HWVGknog&s" alt="Michael Brown Document" class="profile-pic">
                            <div class="document-details">
                                <p class="document-owner">Michael Brown</p>
                                <p class="document-type">Registration Document</p>
                            </div>
                        </div>
                        <div class="document-actions">
                            <button class="action accept">Accept</button>
                            <button class="action reject">Reject</button>
                        </div>
                    </div>

                    <div class="document-card">
                        <div class="document-info">
                            <img src="https://media.gettyimages.com/id/685132223/fr/photo/businesswoman-with-braided-hair-over-white.jpg?s=612x612&w=gi&k=20&c=ttZAIqd70SLAm1JgkkSDX5xcG4uXahLd1DpIYuF9J3E=" alt="Sarah Lewis Document" class="profile-pic">
                            <div class="document-details">
                                <p class="document-owner">Sarah Lewis</p>
                                <p class="document-type">Registration Document</p>
                            </div>
                        </div>
                        <div class="document-actions">
                            <button class="action accept">Accept</button>
                            <button class="action reject">Reject</button>
                        </div>
                    </div>
                    </div>  

                </div>
            </section>
        </main>

    </div>

</body>
</html>
<?php

include "./views/footer.php";
?>