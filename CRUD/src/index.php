<?php
require 'connect.php';
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Read</title>
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />
    <link rel="stylesheet" href="output.css" />
  </head>

  <body>
    <main>
      <section class="border-b border-green-950 mt-16 text-center">
        <div class="font-bold text-2xl text-black mb-4">
            <p>
                We are open 7 days a week!
            </p>
        </div>
        <div class="flex justify-center mt-8 mb-16">
            <table class="text-lg">
                <tr>
                  <th class="table-border">
                    No
                  </th>
                  <th class="table-border">
                    NPM
                  </th>
                  <th class="table-border">
                    Nama
                  </th>
                  <th class="table-border">
                    Jenis Kelamin
                  </th>
                  <th class="table-border">
                    Tanggal Lahir
                  </th>
                  <th class="table-border">
                    Alamat
                  </th>
                  <th class="table-border">
                    Foto
                  </th>
                  <th class="table-border">
                    Aksi
                  </th>
                </tr>
                <?php
                  $query = "SELECT * FROM `mahasiswa`";
                  $result = mysqli_query($conn, $query);

                  if($result){
                    $no = 1;
                    while ($row = mysqli_fetch_assoc($result)){
                      $id = $row['id'];
                      $npm = $row['npm'];
                      $nama = $row['nama'];
                      $jenisKelamin = $row['jenisKelamin'];
                      $tanggalLahir = $row['tanggalLahir'];
                      $alamat = $row['alamat'];
                      $foto = $row['foto'];

                      echo '<tr>';
                      echo "<td>$no</td>";
                      echo "<td>$npm</td>";
                      echo "<td>$nama</td>";
                      echo "<td>$jenisKelamin</td>";
                      echo "<td>$tanggalLahir</td>";
                      echo "<td>$alamat</td>";
                      echo '<td> <img src="' .$foto. '" width="240" height="240" ></td>';
                      echo 
                      '<td>
                      <button><a href=update.php?userId='.$id.'">Update</a></button>
                      <button><a href=delete.php?userId='.$id.'">Delete</a></button>
                      </td>
                      ';
                      echo '</tr>';

                      $no++;
                    }
                  }
                ?>
            </table>
        </div>
      </section>
    </main>
  </body>
</html>
