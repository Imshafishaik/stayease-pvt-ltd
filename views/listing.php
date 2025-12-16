<?php 
include "./header.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>StayEase | Easy stays for students</title>
  <link rel="stylesheet" href="../css/listing.css">
</head>
<body>

  <section class="filters">
    <input type="text" placeholder="Search for houses..." />
    
    <select>
      <option>All Cities</option>
      <option>Paris</option>
      <option>Lyon</option>
      <option>Provence</option>
    </select>

    <select>
      <option>Max Price</option>
      <option>€700</option>
      <option>€900</option>
      <option>€1200</option>
    </select>

    <button>Search</button>
  </section>

  <!-- Listings -->
   <div class="main_card">
  <main class="cards">

    <div class="card">
      <img src="../images/homeimages/image2.avif" />
      <div class="card-content">
        <h3>Charming Paris Apartment</h3>
        <p>
          Located in the heart of Paris, this cozy apartment offers a unique
          blend of comfort and convenience.
        </p>
        <div class="card-footer">
          <span>€1200/month</span>
          <span class="status">Available Now</span>
        </div>
      </div>
    </div>

    <div class="card">
      <img src="https://images.unsplash.com/photo-1505693416388-ac5ce068fe85" />
      <div class="card-content">
        <h3>Modern Lyon Apartment</h3>
        <p>
          Enjoy modern living in this spacious apartment located in a vibrant
          neighborhood of Lyon.
        </p>
        <div class="card-footer">
          <span>€900/month</span>
          <span class="status muted">Available Jan 2024</span>
        </div>
      </div>
    </div>

    <div class="card">
      <img src="https://images.unsplash.com/photo-1568605114967-8130f3a36994" />
      <div class="card-content">
        <h3>Rustic Provence Cottage</h3>
        <p>
          Experience tranquility in this rustic cottage surrounded by the
          beautiful landscapes of Provence.
        </p>
        <div class="card-footer">
          <span>€750/month</span>
          <span class="status">Available Now</span>
        </div>
      </div>
    </div>

  </main>
</div>
  <!-- Footer -->
  <footer class="footer">
    <div>
      <p><strong>Contact Us</strong></p>
      <p>Email: support@accommodateme.fr</p>
      <p>Phone: +33 1 23 45 67 89</p>
    </div>
    <p class="copyright">
      © 2023 AccommodateMe. All rights reserved.
    </p>
  </footer>

</body>
</html>
