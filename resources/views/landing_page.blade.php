<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Desa Sondakan</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        nav ul li a {
            position: relative;
            display: inline-block;
            text-decoration: none;
        }

        nav ul li a::after {
            content: '';
            position: absolute;
            left: 0;
            bottom: -2px;
            width: 0;
            height: 2px;
            background: white;
            transition: width 0.3s ease;
        }

        nav ul li a:hover::after {
            width: 100%;
        }
    </style>
</head>

<body class="font-sans bg-gray-100">
    <!-- Header -->
    <header class="bg-green-600 text-white py-4">
        <div class="container mx-auto flex justify-between items-center px-4">
            <h1 class="text-2xl font-bold">Desa Sondakan</h1>
            <nav>
                <ul class="flex space-x-6">
                    <li><a href="#profil" class="hover:text-gray-200">Profil</a></li>
                    <li><a href="#berita" class="hover:text-gray-200">Berita</a></li>
                    <li><a href="#layanan" class="hover:text-gray-200">Layanan</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="bg-cover bg-center h-[400px] flex items-center justify-center"
        style="background-image: url('{{ asset('assets/images/imgsondakan.png') }}');">
        <div class="text-center text-white">
            <h2 class="text-4xl font-bold">Selamat Datang di Desa Sondakan</h2>
            <p class="mt-4 text-lg">Membangun desa bersama untuk masa depan yang lebih baik</p>
        </div>
    </section>

    <!-- Profil Desa -->
    <section id="profil" class="py-12 bg-white">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center mb-6">Profil Desa</h2>
            <p class="text-gray-700 text-center max-w-3xl mx-auto">Desa Sondakana adalah desa yang terletak di tengah
                Kota Surakarta, Jawa Tengah. Dengan lokasi yang strategis dan komunitas yang beragam, desa ini
                berkomitmen untuk menjaga nilai-nilai budaya sekaligus mendorong inovasi dalam pembangunan. Desa
                Sondakana terus berupaya meningkatkan kesejahteraan masyarakat melalui program-program pemberdayaan,
                layanan publik, dan pengelolaan sumber daya yang berkelanjutan.</p>
        </div>
    </section>

    <!-- Berita -->
    <section id="berita" class="py-12 bg-gray-100">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center mb-6">Berita Terkini</h2>
            @if ($berita->isNotEmpty())

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

                    @foreach ($berita as $be)
                        <a href="{{ route('landing.berita', $be->slug) }}">
                            <div class="bg-white shadow-md p-4">
                                <img src="{{ 'storage/' . $be->thumbnail }}" alt="Berita" class="w-full mb-4">
                                <h3 class="text-xl font-bold">{{ $be->title }}</h3>
                                <p class="text-gray-600 mt-2">
                                    {{ \Illuminate\Support\Str::limit($be->content, 57, '...') }}
                                </p>
                            </div>
                        </a>
                    @endforeach
                </div>
            @else
                <div class="w-full text-center">
                    <h1 class="text-[24px] font-bold">Berita Kosong</h1>
                </div>
            @endif
        </div>
    </section>

    {{-- <section id="gallery">
        <h1 class="font-bold text-center">Gallery</h1>
    </section> --}}

    <!-- Layanan -->
    <section id="layanan" class="py-12 bg-white">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center mb-6">Layanan Desa</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="text-center p-4">
                    <div
                        class="bg-green-600 text-white w-16 h-16 flex items-center justify-center mx-auto rounded-full mb-4">
                        🏠</div>
                    <h3 class="text-xl font-bold">Administrasi</h3>
                    <p class="text-gray-600">Layanan surat menyurat dan administrasi warga.</p>
                </div>
                <div class="text-center p-4">
                    <div
                        class="bg-green-600 text-white w-16 h-16 flex items-center justify-center mx-auto rounded-full mb-4">
                        📈</div>
                    <h3 class="text-xl font-bold">Ekonomi</h3>
                    <p class="text-gray-600">Program UMKM dan pemberdayaan ekonomi warga.</p>
                </div>
                <div class="text-center p-4">
                    <div
                        class="bg-green-600 text-white w-16 h-16 flex items-center justify-center mx-auto rounded-full mb-4">
                        🌳</div>
                    <h3 class="text-xl font-bold">Lingkungan</h3>
                    <p class="text-gray-600">Pengelolaan lingkungan untuk desa yang bersih dan sehat.</p>
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

            </div>
        </div>
    </section>

    {{-- <!-- Kontak -->
    <section id="kontak" class="py-12 bg-gray-100">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center mb-6">Kontak Kami</h2>
            <form action="#" method="POST" class="max-w-lg mx-auto bg-white shadow-md p-6">
                <div class="mb-4">
                    <label for="name" class="block text-gray-700 font-bold mb-2">Nama</label>
                    <input type="text" id="name" name="name" class="w-full px-4 py-2 border rounded-md"
                        required>
                </div>
                <div class="mb-4">
                    <label for="email" class="block text-gray-700 font-bold mb-2">Email</label>
                    <input type="email" id="email" name="email" class="w-full px-4 py-2 border rounded-md"
                        required>
                </div>
                <div class="mb-4">
                    <label for="message" class="block text-gray-700 font-bold mb-2">Pesan</label>
                    <textarea id="message" name="message" rows="4" class="w-full px-4 py-2 border rounded-md" required></textarea>
                </div>
                <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded-md">Kirim</button>
            </form>
        </div>
    </section> --}}

    <!-- Footer -->
    <footer class="bg-green-600 text-white text-center py-4">
        <p>&copy; 2024 Desa Sondakan. Semua hak dilindungi.</p>
    </footer>
</body>

</html>
