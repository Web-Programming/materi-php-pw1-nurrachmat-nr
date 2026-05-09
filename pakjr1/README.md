## Catatan
1. Membuat Model Migration dan Controller
``php artisan make:model Barang -mc``

2. Menjalankan Migration
``php artisan migrate``

3. Membuat View
``php artisan make:view namafolde.namaview``
output : namafolder/namaview.blade.php

4. Membuat Controller Saja
``php artisan make:controller NamaController``

5. Menjalankan Dev. Server
``php artisan serve``

6. Membuat Seeder
``php artisan make:seeder BarangSeeder``

7. Menjalanka Seeder
``php artisan db:seed --class="BarangSeeder"``