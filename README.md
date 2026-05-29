                                                
  Planning and Learning Automation based on Artificial Intelligence (PanoraAI)
  https://planora-ai.online

================================================================================

DESKRIPSI PROYEK
----------------

PlanoraAI adalah platform berbasis web yang dirancang khusus untuk membantu
guru (khususnya guru SMK) dalam mengotomatisasi penyusunan Rencana Pelaksanaan
Pembelajaran (RPP) dan perangkat ajar lainnya menggunakan teknologi Gemini AI.

Penyusunan administrasi guru seringkali memakan waktu yang lama. PlanoraAI
hadir untuk memangkas waktu tersebut dengan menghasilkan draf RPP yang
terstruktur, sesuai kurikulum, dan relevan dengan kebutuhan industri hanya
dalam hitungan detik.

Proyek ini dikembangkan menggunakan metodologi ADDIE (Analysis, Design,
Development, Implementation, and Evaluation) untuk memastikan kualitas output
yang dihasilkan memenuhi standar akademik.

================================================================================

FITUR UTAMA
-----------

  [1] Otomatisasi RPP Berbasis AI
      Menghasilkan RPP lengkap menggunakan API Gemini.

  [2] Format Terstruktur
      Output mengikuti kaidah penulisan perangkat ajar yang berlaku.

  [3] Optimasi Token
      Penanganan pengiriman data ke AI secara efisien untuk menghindari
      limit error.

  [4] Responsive UI
      Tampilan bersih dan nyaman di berbagai perangkat berkat
      Tailwind CSS & Bootstrap.

================================================================================

TECH STACK
----------

  Framework   : Laravel (PHP)
  Frontend    : Tailwind CSS / Bootstrap & Blade Template
  AI          : Gemini API (Google AI Studio)
  Database    : MySQL
  Hosting     : planora-ai.online

================================================================================

CARA INSTALASI (LOKAL)
-----------------------

  Langkah 1 -- Clone Repositori
  ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
  git clone https://github.com/username/PlanoraAI.git
  cd PlanoraAI

  Langkah 2 -- Instalasi Dependensi
  ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
  composer install
  npm install && npm run dev

  Langkah 3 -- Konfigurasi Environment
  ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
  Salin file .env.example menjadi .env, lalu sesuaikan konfigurasi
  database dan API Key Gemini:

    GEMINI_API_KEY=your_api_key_here

  Langkah 4 -- Generate Key & Migrasi Database
  ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
  php artisan key:generate
  php artisan migrate

  Langkah 5 -- Jalankan Server
  ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
  php artisan serve

================================================================================

STRUKTUR PROYEK
---------------

  app/Http/Controllers   Logika utama penanganan integrasi API Gemini.
  resources/views        Template tampilan website.
  routes/web.php         Definisi rute aplikasi.

================================================================================

LISENSI
-------

Proyek ini dikembangkan untuk tujuan pendidikan dan pengembangan
profesionalitas guru.

================================================================================

  Developed with passion by Nanda Pratama Gema Mahardika
  Mahasiswa Pendidikan Teknik Informatika, Universitas Negeri Malang

================================================================================
