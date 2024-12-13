<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Berita - Desa Sondakan</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="font-sans bg-gray-100">
    <!-- Header -->
    <header class="float-right text-black py-4 px-5">
        <a class="bg-green-600 text-white px-4 py-2 rounded-md" href="{{ route('landing.') }}">Back</a>
    </header>

    <!-- Detail Berita -->
    <section class="py-12 bg-white">
        <div class="container mx-auto px-4 max-w-4xl">
            <h2 class="text-3xl font-bold text-center mb-6">{{ $berita->title }}</h2>
            <img src="{{ '../../storage/' . $berita->thumbnail }}" alt="Detail Berita" class="w-full mb-6 rounded-md">
            <p class="text-gray-700 mb-4">Dipublikasikan pada: <span
                    class="font-bold">{{ \Carbon\Carbon::parse($berita->published_at)->translatedFormat('d F Y') }}</span>
            </p>
            <p class="text-gray-800 leading-relaxed mb-6">{{ $berita->content }}</p>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-green-600 text-white text-center py-4">
        <p>&copy; 2024 Desa Sondakan. Semua hak dilindungi.</p>
    </footer>
</body>

</html>
