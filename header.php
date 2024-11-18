<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Wejeatrans</title>
  <link rel="icon" type="image/png" href="img/logo.png">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootswatch@4.5.2/dist/cyborg/bootstrap.min.css"
    integrity="sha384-nEnU7Ae+3lD52AK+RGNzgieBWMnEfgTbRHIwEvp1XXPdqdO6uLTd/NwXbzboqjc2" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
    integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg bg-primary" data-bs-theme="dark">
    <div class="container-fluid">
      <?php if (isset($_SESSION)) : ?>
        <?php if ($_SESSION['role'] == 'user') : ?>
          <a class="navbar-brand" href="#"><img src="../img/logo.png" alt="Logo" style="width: 100px; height: auto;"></a>
        <php else : ?>
          <a class="navbar-brand" href="#"><img src="img/logo.png" alt="Logo" style="width: 100px; height: auto;"></a>
        <?php endif; ?>
      <?php endif; ?>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
        <!-- <span class="navbar-toggler-icon" style="background-image: none;">
          <i class="fas fa-bars" style="font-size: 1.5rem; color: white;"></i>
        </span> -->
        <span style="display: flex; width: 50px; height: 50px; justify-content: center; align-items: center">
          <i class="bi bi-list" style="color: #fff; font-size: 40px"></i>
        </span>
        
      </button>
      <div class="collapse navbar-collapse" id="navbarColor01">
        <form class="d-flex mx-auto" style="width: 50%;">
          <input class="form-control me-sm-2" type="search" placeholder="Cari">
          <button class="btn btn-secondary my-2 my-sm-0" type="submit">Search</button>
        </form>
        <ul class="navbar-nav ms-auto">
          <li class="nav-item"><a class="nav-link active" href="index.php">Home</a></li>
          <li class="nav-item"><a class="nav-link" href="about.php">About</a></li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Service <i class="fas fa-caret-down"></i> <!-- Tanda panah menggunakan Font Awesome -->
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="service.php">Tanpa Supir</a>
              <a class="dropdown-item" href="service.php">Dengan Supir</a>
            </div>
          </li>
          <li class="nav-item"><a class="nav-link" href="contact.php">Contact</a></li>
        </ul>
        <a href="login.php"><button type="button" class="btn btn-outline-light ms-3">Login</button></a>
      </div>
    </div>
  </nav>
