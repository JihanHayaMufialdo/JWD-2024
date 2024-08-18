<?php
require 'connect.php';

function generateRandomString($length = 10) {
  $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
  $charactersLength = strlen($characters);
  $randomString = '';
  for ($i = 0; $i < $length; $i++) {
      $randomString .= $characters[rand(0, $charactersLength - 1)];
  }
  return $randomString;
}

if(isset($_GET['userId'])) {
  $id = $_GET['userId'];

  // Ambil data mahasiswa berdasarkan ID
  $query = "SELECT * FROM `mahasiswa` WHERE id = '$id'";
  $result = mysqli_query($conn, $query);
  $row = mysqli_fetch_assoc($result);

  $npm = $row['npm'];
  $nama = $row['nama'];
  $jenisKelamin = $row['jenisKelamin'];
  $tanggalLahir = $row['tanggalLahir'];
  $alamat = $row['alamat'];
  $foto = $row['foto'];
}

if(isset($_POST['submit'])) {
  $npm = $_POST['npm'];
  $nama = $_POST['nama'];
  $jenisKelamin = $_POST['jenisKelamin'];
  $tanggalLahir = $_POST['tanggalLahir'];
  $alamat = $_POST['alamat'];

  $target_file = $foto; // Menggunakan foto yang sudah ada sebagai default

  if($_FILES["foto"]["name"]){
    $target_dir = "uploads/";
    $target_file = $target_dir . generateRandomString() . basename($_FILES["foto"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

    // Validasi upload file baru
    $check = getimagesize($_FILES["foto"]["tmp_name"]);
    if($check !== false) {
      $uploadOk = 1;
    } else {
      echo "File is not an image.";
      $uploadOk = 0;
    }

    if (file_exists($target_file)) {
      echo "Sorry, file already exists.";
      $uploadOk = 0;
    }

    if ($_FILES["foto"]["size"] > 500000) {
      echo "Sorry, your file is too large.";
      $uploadOk = 0;
    }

    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
      echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
      $uploadOk = 0;
    }

    if ($uploadOk == 1) {
      if (move_uploaded_file($_FILES["foto"]["tmp_name"], $target_file)) {
        echo "The file ". htmlspecialchars( basename( $_FILES["foto"]["name"])). " has been uploaded.";
      } else {
        echo "Sorry, there was an error uploading your file.";
      }
    }
  }

  // Update data mahasiswa
  $query = "UPDATE `mahasiswa` SET npm='$npm', nama='$nama', jenisKelamin='$jenisKelamin', tanggalLahir='$tanggalLahir', alamat='$alamat', foto='$target_file' WHERE id='$id'";
  $result = mysqli_query($conn, $query);

  if($result){
    header('location:index.php');
  }
}
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Update</title>
    <link rel="stylesheet" href="output.css" />
  </head>

  <body>
    <form action="" method="post" enctype="multipart/form-data">
      <div class="flex justify-center py-32">
        <div class="rounded bg-white px-8 shadow-lg">
          <div class="my-8 text-center text-xl font-bold">
            <p>Biodata Mahasiswa</p>
          </div>
          <div class="my-4">
            <label for="npm" class="font-semibold"> NPM </label>
            <div class="text-box">
              <div class="m-2">
                <input
                  type="text"
                  id="npm"
                  name="npm"
                  maxlength="10"
                  minlength="10"
                  pattern="\d{10}"
                  placeholder="Masukkan NPM"
                  value="<?php echo $npm; ?>"
                  required
                />
              </div>
            </div>
          </div>
          <div class="my-4">
            <label for="nama" class="font-semibold"> Nama </label>
            <div class="text-box">
              <div class="m-2">
                <input
                  type="text"
                  id="nama"
                  name="nama"
                  placeholder="Masukkan Nama"
                  value="<?php echo $nama; ?>"
                  required
                />
              </div>
            </div>
          </div>
          <div class="my-4">
            <label for="jenisKelamin" class="font-semibold">
              Jenis Kelamin
            </label>
            <div class="mt-2">
              <div class="gap-x-4">
                <input
                  type="radio"
                  id="Pria"
                  name="jenisKelamin"
                  value="Pria"
                  <?php if($jenisKelamin == 'Pria') echo 'checked'; ?>
                  required
                />
                <label for="pria"> Pria </label>
                <input
                  type="radio"
                  id="Wanita"
                  name="jenisKelamin"
                  value="Wanita"
                  <?php if($jenisKelamin == 'Wanita') echo 'checked'; ?>
                  required
                />
                <label for="wanita"> Wanita </label>
              </div>
            </div>
          </div>
          <div class="my-4">
            <label for="tanggalLahir" class="font-semibold">
              Tanggal Lahir
            </label>
            <div class="text-box">
              <div class="m-2">
                <input type="date" id="tanggalLahir" name="tanggalLahir" value="<?php echo $tanggalLahir; ?>" required/>
              </div>
            </div>
          </div>
          <div class="my-4">
            <label for="alamat" class="font-semibold"> Alamat </label>
            <div class="text-box">
              <div class="m-2">
                <textarea
                  id="alamat"
                  name="alamat"
                  placeholder="Masukkan Alamat"
                  rows="4"
                  cols="50"
                  required
                ><?php echo $alamat; ?></textarea>
              </div>
            </div>
          </div>
          <div class="mb-8 mt-4">
            <label for="foto" class="font-semibold"> Foto </label>
            <div class="text-box">
              <div class="m-2">
                <input type="file" name="foto" id="foto" accept="image/*"/>
              </div>
            </div>
          </div>
          <div class="mb-8">
            <button
              type="submit" name="submit"
              class="text-md w-full rounded bg-blue-800 py-1 font-semibold text-white"
            >
              Simpan
            </button>
          </div>
        </div>
      </div>
    </form>
  </body>
</html>
