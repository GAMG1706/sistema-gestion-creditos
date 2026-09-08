<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Gestión de Créditos</title>
    <!-- Tailwind CSS desde CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Iconos de FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-100 font-sans antialiased">

    <!-- Navegación -->
    <nav class="bg-slate-900 border-b border-slate-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <div class="flex items-center space-x-3">
                    <div class="bg-blue-600 text-white p-2 rounded-lg">
                        <i class="fa-solid fa-building-columns text-xl"></i>
                    </div>
                    <span class="text-white font-bold text-lg tracking-wide">GestiónCreditos</span>
                </div>
                <div class="flex space-x-4">
                    <a href="{{ route('clientes.index') }}" class="text-gray-300 hover:bg-slate-800 hover:text-white px-3 py-2 rounded-md text-sm font-medium transition">
                        <i class="fa-solid fa-users mr-1.5"></i> Clientes
                    </a>
                    <a href="{{ route('creditos.index') }}" class="text-gray-300 hover:bg-slate-800 hover:text-white px-3 py-2 rounded-md text-sm font-medium transition">
                        <i class="fa-solid fa-credit-card mr-1.5"></i> Créditos
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Alertas Flash de Éxito / Error -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
        @if(session('success'))
            <div class="bg-emerald-100 border-l-4 border-emerald-500 text-emerald-700 p-4 rounded shadow-sm flex justify-between items-center" role="alert">
                <p><i class="fa-solid fa-circle-check mr-2"></i>{{ session('success') }}</p>
            </div>
        @endif

        @if($errors->any())
            <div class="bg-rose-100 border-l-4 border-rose-500 text-rose-700 p-4 rounded shadow-sm" role="alert">
                <p class="font-bold"><i class="fa-solid fa-triangle-exclamation mr-2"></i>Por favor corrige los siguientes errores:</p>
                <ul class="mt-1 list-disc list-inside text-sm">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>

    <!-- Contenido Principal -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        @yield('content')
    </main>

</body>
</html>