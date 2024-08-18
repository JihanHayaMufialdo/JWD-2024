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

if(isset($_POST['submit'])) {
  $npm = $_POST['npm'];
  $nama = $_POST['nama'];
  $jenisKelamin = $_POST['jenisKelamin'];
  $tanggalLahir = $_POST['tanggalLahir'];
  $alamat = $_POST['alamat'];

  $target_dir = "uploads/";
  $target_file = $target_dir . generateRandomString() . basename($_FILES["foto"]["name"]);
  $uploadOk = 1;
  $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

  // Check if image file is a actual image or fake image
  if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["foto"]["tmp_name"]);
    if($check !== false) {
      echo "File is an image - " . $check["mime"] . ".";
      $uploadOk = 1;
    } else {
      echo "File is not an image.";
      $uploadOk = 0;
    }
  }

  // Check if file already exists
  if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
  }

  // Check file size
  if ($_FILES["foto"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
  }

  // Allow certain file formats
  if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
  && $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
  }

  // Check if $uploadOk is set to 0 by an error
  if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
  // if everything is ok, try to upload file
  } else {
    if (move_uploaded_file($_FILES["foto"]["tmp_name"], $target_file)) {
      echo "The file ". htmlspecialchars( basename( $_FILES["foto"]["name"])). " has been uploaded.";
    } else {
      echo "Sorry, there was an error uploading your file.";
    }
  }

  $query = "INSERT INTO `mahasiswa` (npm,nama,jenisKelamin,tanggalLahir,alamat,foto)  
            VALUES ('$npm', '$nama', '$jenisKelamin', '$tanggalLahir', '$alamat', '$target_file')";

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
    <title>Document</title>
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />
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
                  required
                />
                <label for="pria"> Pria </label>
                <input
                  type="radio"
                  id="Wanita"
                  name="jenisKelamin"
                  value="Wanita"
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
                <input type="date" id="tanggalLahir" name="tanggalLahir" required/>
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
                >
                </textarea>
              </div>
            </div>
          </div>
          <div class="mb-8 mt-4">
            <label for="foto" class="font-semibold"> Foto </label>
            <div class="text-box">
              <div class="m-2">
                <input type="file" name="foto" id="foto" accept="image/*" required/>
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
