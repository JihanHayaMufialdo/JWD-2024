<?php
require 'connect.php';

if(isset($_POST['submit'])) {
  $npm = $_POST['npm'];
  $nama = $_POST['nama'];
  $jenisKelamin = $_POST['jenisKelamin'];
  $tanggalLahir = $_POST['tanggalLahir'];
  $alamat = $_POST['alamat'];
  // $foto = $_POST['foto'];
  $foto = 'test.jpg';

  $query = "INSERT INTO `mahasiswa` (npm,nama,jenisKelamin,tanggalLahir,alamat,foto)  
            VALUES ('$npm', '$nama', '$jenisKelamin', '$tanggalLahir', '$alamat', '$foto')";

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
