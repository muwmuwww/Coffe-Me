<?php
include('koneksi.php');
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>CoffeMe</title>

    <!--fonts-->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,300;0,400;0,700;1,700&display=swap"
      rel="stylesheet"
    />

    <!-- gambar logo coffe -->
    <link rel="shortcut icon" href="img/logo.jpeg" type="image/x-icon">


    <!--feather icon-->
    <script src="https://unpkg.com/feather-icons"></script>

    <!--css-->
    <link rel="stylesheet" href="style.css" />
  </head>
  <body>
    <!-- header -->
    <div class="medsos">
      <div class="container">
        <ul>
          <li>
            <a href="#"><i data-feather="facebook"></i></a>
          </li>
          <li>
            <a href="https://youtu.be/vKFEThqAjKk"><i data-feather="youtube"></i></a>
          </li>
          <li>
            <a href="https://instagram.com/coffeme._?igshid=OGQ5ZDc2ODk2ZA=="><i data-feather="instagram"></i></a>
          </li>
        </ul>
      </div>
    </div>
    <header>
      <div class="container">
        <h1>
          <a href="index.html"></a><i data-feather="coffee"></i>Coffee<span>Me</span>
        </h1>
        <ul>
          <li ><a href="index.html">Home</a></li>
          <li class="active"><a href="menu.php">Menu</a></li>
          <li><a href="review.php">Review</a></li>
          
          <li><a href="keranjang.php">Pesanan</a></li>
        </ul>
      </div>
    </header>

    <!-- Menu -->

    <section class="menu">
    <h1>Menu</h1>
    <div class="box-container">
        <?php
        $sql = "SELECT * FROM product";
        $query = mysqli_query($connect, $sql);
        while ($data = mysqli_fetch_array($query)) {
            $productId = $data['productid']; // Get the product ID
        ?>
            <div class="box">
                <img src="img/<?php echo $data['foto']; ?>" alt="">
                <h3><?= $data['name']; ?></h3>
                <div class="price">Rp. <?= number_format($data['price'], 0, "", ".") ?></div>
                <button type="button" class="btn" onclick="openModal('staticBackdrop<?= $productId ?>')">Masukkan Keranjang</button>
            </div>

            <div class="modal" id="staticBackdrop<?= $productId ?>">
            <form method="POST" action="index_login_proses.php">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5">Masukkan Pesanan</h1>
                        <button type="button" class="btn-close" onclick="closeModal()"></button>
                    </div>
                    <h3><?= $data['name']; ?></h3>
                        <div class="price">Rp. <?= number_format($data['price'], 0, "", ".") ?></div>
                    <div class="modal-body">
                        <input type="hidden" name="username" value="<?= $username; ?>">
                        <input type="hidden" name="productid" value="<?= $data['productid']; ?>">
                        <input type="hidden" name="price" value="<?= $data['price']; ?>">
                        Jumlah barang
                        <input type="number" name="quantity" class="form-number text-center" min="1" style="width: 50px; margin-right: -4px;" value="1">
                        <hr>
                        Tulis Catatan
                        <input class="card card-body" style="height: 5px; width: 100%" type="text" name="catatanorder">
                         <label for="size">Ukuran :</label>
                          <select id="size" name="size">
                            <option value="Medium">Medium</option>
                            <option value="Large">Large</option>
                            <option value="Small">Small</option>
                          </select> 
                        <label for="ice">  Es :</label>
                          <select id="ice" name="ice">
                            <option value="YA">YA</option>
                            <option value="Tidak">Tidak</option>
                            <option value="Sedikit">Sedikit</option>
                          </select> 
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" onclick="closeModal('staticBackdrop<?= $productId ?>')">Tutup</button>
                        <button type="submit" class="btn btn-primary" style="background-color: #00A445;">Submit</button>
                    </div>
                </div>
            </form>
            </div>

            <script>
               function openModal(modalId) {
                    <?php if (!$username) { ?>
                        window.location.href = "login.php";
                    <?php } else { ?>
                        document.getElementById(modalId).style.display = 'block';
                    <?php } ?>
                }

                function closeModal(modalId) {
                    document.getElementById(modalId).style.display = 'none';
                }
            </script>

        <?php } ?>
    </div>
</section>

<!-- end -->

    <!-- footer -->

    <footer>
      <div class="box">
        <ul>
          <li>
            <img src="img/footer-1.png" alt="footer-1" />
            <br />
            <a href="#">Adress</a>
            <br />
            <p>Jalan Tluki 1, Sleman Yogyakarta</p>
          </li>
          <li>
            <img src="img/footer-2.png" alt="footer-2" />
            <br />
            <a href="#">E-mail</a>
            <br />
            <p>CoffeMe@gmail.com</p>
          </li>
          <li>
            <img src="img/footer-3.png" alt="footer-3" />
            <br />
            <a href="#">Call us</a>
            <br />
            <p>+62 8123 4567</p>
          </li>
          <li>
            <img src="img/footer-4.png" alt="footer-4" />
            <br />
            <a href="#">Opening</a>
            <br />
            <p>Monday - Friday: 8:00 - 24:00</p>
          </li>
        </ul>
      </div>
    </footer>

    <!--fethaer icon-->
    <script>
      feather.replace();
    </script>
  </body>
</html>
