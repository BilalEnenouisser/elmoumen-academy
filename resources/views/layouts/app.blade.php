<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="UTF-8">
    <title>Elmoumen Academy</title>
    @vite('resources/css/app.css')
</head>
<body class="font-sans antialiased text-gray-800 bg-white">

    <!-- Navbar -->
    <header class="bg-white shadow">
        <div class="container mx-auto flex justify-between items-center p-4">
            <!-- Left: Logo -->
            <div class="text-xl font-bold text-blue-600">Elmoumen</div>

            <!-- Center: Menu -->
            <nav class="hidden md:flex space-x-6">
                <a href="/" class="hover:text-blue-500">ACCUEIL</a>
                <a href="/about" class="hover:text-blue-500">ABOUT</a>
                <div class="relative group">
                    <span class="hover:text-blue-500 cursor-pointer">COURS</span>
                    <!-- Mega Menu -->
                    <div class="absolute left-0 top-full bg-white border shadow-md mt-2 p-4 hidden group-hover:flex space-x-4 z-10">
                        <a href="/courses/primaire" class="hover:text-blue-500">Primaire</a>
                        <a href="/courses/college" class="hover:text-blue-500">Collège</a>
                        <a href="/courses/lycee" class="hover:text-blue-500">Lycée</a>
                        <a href="/courses/concours" class="hover:text-blue-500">Concours</a>
                    </div>
                </div>
                <a href="/contact" class="hover:text-blue-500">CONTACT</a>
            </nav>

            <!-- Right: WhatsApp -->
            <div>
                <a href="https://wa.me/212600000000" class="bg-green-500 text-white px-4 py-1 rounded hover:bg-green-600">WhatsApp</a>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-100 text-center py-6 mt-10">
        &copy; {{ date('Y') }} Elmoumen Academy. Tous droits réservés.
    </footer>
</body>
</html>
