<section class="content-header">
    <h1>
        Dashboard
        <small>Control panel</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-lg-3 col-xs-6">
            <div class="small-box bg-aqua">
                <div class="inner">
                    <h3><?= count($gifts); ?></h3>
                    <p>Gifts</p>
                </div>
                <div class="icon">
                    <i class="fa fa-gift"></i>
                </div>
                <a href="<?= base_url('gifts'); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
      
        <div class="col-lg-3 col-xs-6">
            <div class="small-box bg-green">
                <div class="inner">
                    <h3><?= count($transactions); ?></h3>
                    <p>Transactions</p>
                </div>
                <div class="icon">
                    <i class="fa fa-shopping-cart"></i>
                </div>
                <a href="<?= base_url('transactions'); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        
        <div class="col-lg-3 col-xs-6">
            <div class="small-box bg-yellow">
                <div class="inner">
                    <h3><?= count($customers); ?></h3>
                    <p>Customers</p>
                </div>
                <div class="icon">
                    <i class="fa fa-users"></i>
                </div>
                <a href="<?= base_url('customers'); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <div class="col-lg-3 col-xs-6">
            <div class="small-box bg-red">
                <div class="inner">
                    <h3><?= count($users); ?></h3>
                    <p>Users</p>
                </div>
                <div class="icon">
                    <i class="fa fa-user"></i>
                </div>
                <a href="<?= base_url('users'); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6">
            <div class="box">
                <div class="box-header">
                    <h5 class="box-title">Majapahit Challenge</h5>
                </div>
                <div class="box-body">
                    <table>
                        <tr>
                            <td>1. </td>
                            <td>Apa yang Anda ketahui Tentang Git?</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>Salah satu Version Control System yang sangat membantu dalam 
                            pengembangan suatu program aplikasi. 
                            Terutama ketika dalam proses pembangunan maupun pengembangan aplikasi tersebut 
                            melibatkan beberapa developer (kolaborasi). Seperti ketika 
                            ada perubahan pada suatu file, kita tidak perlu membuat file salinan.</td>
                        </tr>
                        <tr>
                            <td>2.</td>
                            <td>Apa yang Anda ketahui tentang Relasi Tabel dalam Database?</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>Relasi (hubungan) antar tabel merupakan suatu hubungan antar tabel 
                            satu dengan tabel lainnya yang berfungsi untuk mengatur operasi dalam database serta yang merepresentasikan objek di dunia nyata. 
                            Terdapat beberapa relasi tabel dalam database yaitu one to one, one to many, many to many.</td>
                        </tr>
                        <tr>
                            <td>3.</td>
                            <td>Apa yang Anda ketahui tentang OOP</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>Merupakan suatu paradigma pemrograman yang berorientasi kepada objek. 
                            Semua data dan fungsi pada paradigma ini terbungkus kedalam kelas-kelas. 
                            Kelas atau Class itu sendiri adalah implementasi dari OOP, bisa disebut juga dengan blueprint, sehingga sebuah Class dapat digunakan berulang kali untuk menginisiasi atau instansiasi objek.</td>
                        </tr>
                        <tr>
                            <td>4.</td>
                            <td>Apa yang Anda ketahui tentang REST API?</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>REST atau <i>REspresentational State Transfer</i> merupakan standar arsitektur komunikasi berbasis web yang sering
                            diterapkan dalam pengembangan layanan berbasis web. Umumnya menggunakan HTTP sebagai protokol untuk komunikasi data. Rest Server sebagai penyedia 
                            resource dan Rest Client sebagai yang mengakses dan menampilkan resource. Request yang digunak antara lain GET, POST, PUT, DELETE.</td>
                        </tr>
                        <tr>
                            <td>5.</td>
                            <td>Security yang dapat digunakan dalam REST API</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>otentikasi penguna, validasi, token,JWT, OAuth, dll</td>
                        </tr>
                        <tr>
                            <td>6.</td>
                            <td>Buat program berbasis web.</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>Aplikasi ini dibuat untuk Admin dalam mengelola pelanggan jika melakukan pembelian,
                            setiap transaksi dicatat/diinput oleh admin dan pelanggan mendapat tambahan 5 poin dari setiap pembelian.
                            Disini saya asumsikan bahwa aplikasi ini jenis aplikasi penjualan berbasis web, sehingga saya hanya membuat
                            tampilan untuk admin saja. Aplikasi ini dibuat sesederhana mungkin karena keterbatasan waktu dalam 
                            pembuatan/penulisan kode. Sehingga tidak ada penjelasan lebih detil ketika proses transaksi berlangsung, dan juga
                            tidak disertakan penjelasan mengenai harga produk, jumlah pembelian, total, kategori produk, metode pembayaran, dlsb. 
                            Difokuskan pada CRUD hadiah, transaksi, customer, user, serta penambahan poin pelanggan ketika pembelian berlangsung, dan 
                            bagaimana menampilkan jumlah poin yang telah dikumpulkan oleh pelanggan dan daftar hadiah dengan informasi nilai tukar point.<br>
                            Untuk akses halaman admin : <br>
                            username : admin<br>
                            password : admin<br>
                            Akses api cek point pelanggan melalui postman dan daftar hadiah beserta nilai tukar point, dilakukan berdasar key <b>username</b> pelanggan.
                            http://localhost/majapahit/home/check</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
