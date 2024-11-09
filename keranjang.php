
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CoffeMe</title>
    <link rel="shortcut icon" href="img/logo.jpeg" type="image/x-icon" />
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="//unpkg.com/alpinejs" defer></script>

    <!-- #region -->
     <!--fonts-->
     <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,300;0,400;0,700;1,700&display=swap"
      rel="stylesheet"
    />
    <!--feather icon-->
    <script src="https://unpkg.com/feather-icons"></script>
    <!--css-->
    <link rel="stylesheet" href="style.css" />
</head>
    <body>
   <!-- #region -->
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
          <a href="index.html"></a><i data-feather="coffee"></i>Coffee<span
            >Me</span
          >
        </h1>
        <ul>
          <li ><a href="index.html">Home</a></li>
          <li ><a href="menu.php">Menu</a></li>
          <li><a href="review.php">Review</a></li>
         <li class="active"><a href="keranjang.php">Pesanan</a></li>
        </ul>
      </div>
    </header>
   <!-- component -->
<div class="flex h-screen bg-white">
  <div class="flex-1 flex flex-col overflow-hidden mt-6">
     <!-- #region -->
    <div class="flex h-full">
      <nav class="flex w-72 h-full">
        <div class="w-full flex mx-auto px-6 py-8">
          <div class="w-full h-full "></div>
        </div>
      </nav>
      <main class="flex flex-col w-full bg-white overflow-x-hidden overflow-y-auto mb-14  border-4 border-gray-300">
        <div class="flex w-full mx-auto px-6 py-8">
          <div class="flex flex-col w-full h-full text-gray-900 text-xl justify-start ">
          <h3>Keranjang</h3>
          <?php
            include('koneksi.php');
            $sql = "SELECT a.keranjangid, a.total_harga, a.productid, a.quantity, a.catatanorder,a.ice,a.size, c.name, c.penjelasan, c.foto, c.price 
            FROM keranjang a INNER JOIN product c 
            ON a.productid=c.productid ";
            $query    = mysqli_query($connect, $sql);
            $jumlah = 0;
            $totalharga = 0;
            while ($data = mysqli_fetch_array($query)) {
            ?>                        
            <div class="box-border h-auto w-full p-4 border-4 mt-5">
            <div class="flex flex-col">
                <div>
                  <img src="img/<?php echo $data['foto']; ?>" alt="" class="w-40 h-40 object-cover">
                </div>
                <div>
                  <p class="text-2xl"><?= $data['name'] ?></p>
                </div>
                <hr class="border border-gray-300 my-4">
                <div class="flex flex-row justify-between">
                  <h5>Rp<?= number_format($data['price'], 0, "", ".") ?> x <?= $data['quantity'] ?></h5>
                  <h5>Rp<?= number_format($data['total_harga'], 0, "", ".") ?></h5>
                </div>
                <hr class="border border-gray-300 my-4">
                <div class="flex flex-col">
                    <div><p>Catatan:</p></div>
                    <div><p ><?= $data['catatanorder'] ?></p></div>
                </div>
                <hr class="border border-gray-300 my-4">
                <div class="flex justify-between">
                  <p>Size:</p>
                  <p><?= $data['ice'] ?></p>
                </div>
                <hr class="border border-gray-300 my-4">
                <div class="flex justify-between">
                  <p>Es:</p>
                  <p><?= $data['size'] ?></p>
                </div>
                <hr class="border border-gray-300 my-4">
                <div class="flex justify-end">
                  <form method="POST" action="keranjang_hapus.php">
                      <input type="hidden" name="idhapus" value=<?= $data['keranjangid'] ?>>
                     <button type="submit" class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded">hapus</button>
                  </form>
                </div>
              </div>

          </div>
            <?php
              $jumlah++;
              $totalharga = $totalharga + $data['total_harga'];
              }?>
          </div>
        </div>
      </main>

      <nav class="flex w-1/2 h-full ">
        <div class="w-full flex mx-auto px-6 py-8">
          <div class="box-border h-60 w-full p-4 border-4 border-gray-300 ">
            <div class="flex flex-col ...">
              <div><h1>Ringkasan Belanja</h1></div>
              <div class="flex flex-row justify-between">
              <div>Total Harga (<?= $jumlah ?> barang)</div>
                            <div><?= number_format($totalharga, 0, "", ".") ?></div>
              </div>
              <hr class="border border-gray-300 my-4">
              <div>
                <div class="flex flex-row justify-between">
                    <div>Total Harga</div>
                    <div><?= number_format($totalharga, 0, "", ".") ?></div>
                </div>
              </div>
              <div>
                   <form action="keranjang_proses.php" method="post">
                        <?php
                        $query1    = mysqli_query($connect, $sql);
                        while ($data1 = mysqli_fetch_array($query1)) {
                        ?>     
                        <input type="hidden" name="keranjang[]" value="<?= $data1['keranjangid'] ?>">
                        <input type="hidden" name="name[]" value="<?= $data1['name'] ?>">
                        <input type="hidden" name="total" value="<?= $totalharga ?>">
                        <input type="hidden" name="username" value="<?= $username ?>">
                      <?php } ?>  
                      <button type="submit" class="mt-6 w-full bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded float-right">Beli</button>
 
                    </form>
              </div>
            </div>
          </div>
        </div>
      </nav>
    </div>
  </div>
</div>

<style>
::-webkit-scrollbar {
  width: 5px;
  height: 5px;
}
::-webkit-scrollbar-thumb {
  background: linear-gradient(13deg, #7bcfeb 14%, #e685d3 64%);
  border-radius: 10px;
}
::-webkit-scrollbar-thumb:hover {
  background: linear-gradient(13deg, #c7ceff 14%, #f9d4ff 64%);
}
::-webkit-scrollbar-track {
  background: #ffffff;
  border-radius: 10px;
  box-shadow: inset 7px 10px 12px #f0f0f0;
}
</style>
 <!--fethaer icon-->
 <script>
      feather.replace();
    </script>


  </body>
</html>