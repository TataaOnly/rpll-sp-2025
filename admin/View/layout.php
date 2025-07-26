<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <title>PlastikHB Admin Dashboard</title>
    <link rel="icon" href="../../images/icon.png" type="image/png">

    <?php
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
    if (!isset($_SESSION['login'])) {
        header('Location: ../index.php');
        exit();
    }   
    ?>
</head>
<body class="bg-gray-100">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <div class="w-64 bg-white shadow-lg">
            <!-- Logo/Brand -->
            <div class="flex items-center justify-center h-16 px-4 border-b border-gray-200">
                <div class="flex items-center">
                    <div class="w-12 h-12 rounded-lg flex items-center justify-center">
                        <image src="../../images/icon.png" alt="Logo" class="w-12 h-12">
                    </div>
                    <span class="text-xl font-semibold text-gray-800">PlastikHB</span>
                </div>
            </div>

            <!-- Navigation -->
            <nav class="mt-8 px-4">
                <div class="space-y-1">
                    <!-- Dashboard -->
                    <a href="?page=ubah-produk" class="group flex items-center px-3 py-2 text-sm font-medium rounded-lg <?php echo ($_GET['page'] ?? '') === 'ubah-produk' ? 'bg-gray-100 text-gray-900' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900'; ?>">
                        <i class="fas fa-database text-gray-400 group-hover:text-gray-500 mr-3 w-5 h-5 flex-shrink-0"></i>
                        Ubah Produk
                    </a>

                    <a href="?page=ubah-galeri" class="group flex items-center px-3 py-2 text-sm font-medium rounded-lg <?php echo ($_GET['page'] ?? '') === 'ubah-galeri' ? 'bg-gray-100 text-gray-900' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900'; ?>">
                        <i class="fas fa-images text-gray-400 group-hover:text-gray-500 mr-3 w-5 h-5 flex-shrink-0"></i>
                        Ubah Galeri
                    </a>

                    <a href="?page=ubah-kontak" class="group flex items-center px-3 py-2 text-sm font-medium rounded-lg <?php echo ($_GET['page'] ?? '') === 'ubah-kontak' ? 'bg-gray-100 text-gray-900' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900'; ?>">
                        <i class="fas fa-phone text-gray-400 group-hover:text-gray-500 mr-3 w-5 h-5 flex-shrink-0"></i>
                        Ubah Kontak
                    </a>

                </div>

            </nav>

            <!-- Sign Out Section -->
            <div class="absolute bottom-0 w-64 p-4 border-t border-gray-200 bg-white">
                <form method="POST" action="../Controller/logout.php" class="mt-2">
                    <button type="submit" 
                            class="w-full text-left text-red-600 hover:bg-red-50 hover:text-red-700 group flex items-center px-3 py-2 text-sm font-medium rounded-lg transition-colors">
                        <i class="fas fa-sign-out-alt text-red-500 group-hover:text-red-600 mr-3 w-5 h-5 flex-shrink-0"></i>
                        Sign Out
                    </button>
                </form>
            </div>
              
        </div>

        <!-- Main Content Area -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Top Navigation -->
            <header class="bg-white shadow-sm border-b border-gray-200">
                <div class="flex items-center justify-between px-6 py-4">
                    <div class="flex items-center">
                        <button class="lg:hidden p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-blue-500">
                            <i class="fas fa-bars"></i>
                        </button>
                        <h1 class="ml-3 text-xl font-semibold text-gray-900">Admin Dashboard</h1>
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <main class="flex-1 overflow-y-auto bg-gray-50 p-6">
                <div class="mx-auto">
                    <div class="bg-white rounded-lg shadow p-6">
                        <?php
                        require_once '../routes.php';
                        $page = isset($_GET['page']) ? $_GET['page'] : 'home';
                        
                        if (isset($routes[$page])) {
                            include $routes[$page];
                        } else {
                            echo "Page not found";  // Or include a 404.php
                        }
                        ?>
                    </div>
                </div>
            </main>
        </div>
    </div>
</body>
</html>