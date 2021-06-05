 <!-- Begin Page Content -->
 <div class="container-fluid">

   <!-- Page Heading -->
   <div class="d-sm-flex align-items-center justify-content-between mb-4">
     <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
   </div>

   <div class="row">

     <!-- Earnings (Monthly) Card Example -->
     <div class="col-xl-3 col-md-6 mb-4">
       <div class="card border-left-primary shadow h-100 py-2">
         <div class="card-body">
           <div class="row no-gutters align-items-center">
             <div class="col mr-2">
               <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                 Pengaduan</div>
               <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $data['pengaduan']; ?></div>
             </div>
             <div class="col-auto">
               <i class="fas fa-trash fa-2x text-gray-300"></i>
             </div>
           </div>
         </div>
       </div>
     </div>

     <!-- Earnings (Monthly) Card Example -->
     <div class="col-xl-3 col-md-6 mb-4">
       <div class="card border-left-success shadow h-100 py-2">
         <div class="card-body">
           <div class="row no-gutters align-items-center">
             <div class="col mr-2">
               <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                 Berita</div>
               <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $data['berita']; ?></div>
             </div>
             <div class="col-auto">
               <i class="fas fa-map-marker-alt fa-2x text-gray-300"></i>
             </div>
           </div>
         </div>
       </div>
     </div>

     <!-- Earnings (Monthly) Card Example -->
     <div class="col-xl-3 col-md-6 mb-4">
       <div class="card border-left-info shadow h-100 py-2">
         <div class="card-body">
           <div class="row no-gutters align-items-center">
             <div class="col mr-2">
               <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Total Pengguna
               </div>
               <div class="row no-gutters align-items-center">
                 <div class="col-auto">
                   <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?= $data['user']; ?></div>
                 </div>
                 <div class="col">
                   <div class="progress progress-sm mr-2">
                     <div class="progress-bar bg-info" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                   </div>
                 </div>
               </div>
             </div>
             <div class="col-auto">
               <i class="fas fa-users fa-2x text-gray-300"></i>
             </div>
           </div>
         </div>
       </div>
     </div>

     <!-- Pending Requests Card Example -->
     <div class="col-xl-3 col-md-6 mb-4">
       <div class="card border-left-warning shadow h-100 py-2">
         <div class="card-body">
           <div class="row no-gutters align-items-center">
             <div class="col mr-2">
               <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                 Pasien</div>
               <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $data['pasien']; ?></div>
             </div>
             <div class="col-auto">
               <i class="fas fa-comments fa-2x text-gray-300"></i>
             </div>
           </div>
         </div>
       </div>
     </div>
   </div>

   <div class="row">
     <!-- Area Chart -->
     <div class="col-lg-12">
       <div class="card shadow mb-4">
         <!-- Card Header - Dropdown -->
         <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
           <h6 class="m-0 font-weight-bold text-primary">Daftar 10 Pengaduan Terbaru</h6>
         </div>
         <!-- Card Body -->
         <div class="card-body">
           <div class="table-responsive">
             <table class="table table-bordered">
               <thead>
                 <tr>
                   <th>Tanggal Pengaduan</th>
                   <th>Kode Pasien</th>
                   <th>Nama Pasien</th>
                   <th>Pengaduan</th>
                   <th>Status</th>
                   <th>Aksi</th>
                 </tr>
               </thead>
               <tbody>
                 <?php

                  if (!empty($pengaduanLatest)) {
                    $baseurl = base_url("admin/pengaduan?status");

                    foreach ($pengaduanLatest as $key => $value) {
                      echo "<tr>";
                      echo "<td>" . tgl_jam_indo($value['tgl_pengaduan']) . "</td>";
                      echo "<td>$value[kode_pasien]</td>";
                      echo "<td>$value[nama_pasien]</td>";
                      echo "<td>$value[pengaduan]</td>";
                      echo "<td>" . getStatus($value['status']) . "</td>";
                      echo "<td class='text-center'>";
                      echo "<a href='$baseurl/edit/$id' class='btn btn-warning btn-sm mx-1 my-1'><i class='fas fa-edit'></i></a>";
                      echo "</td>";
                      echo "</tr>";
                    }
                  } else {
                    echo '<tr><td colspan="6" class="text-center">Maaf, data tidak ditemukan!</td></tr>';
                  }
                  ?>
               </tbody>
             </table>
           </div>

         </div>
       </div>
     </div>