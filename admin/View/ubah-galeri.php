<link rel="stylesheet" href="ubah-galeri.css">
<div class="main-content">

            <!-- Content Area -->
            <main class="content-area">
                <!-- Page Header -->
                <div class="page-header">
                    <h1 class="page-title">Ubah Galeri</h1>
                    <div class="header-actions">
                        <button class="btn btn-primary">+ Add Images</button>
                    </div>
                </div>

                <!-- Upload Zone -->
                <div class="upload-zone">
                    <div class="upload-icon">📁</div>
                    <div class="upload-text">Drag and drop images here, or click to select files</div>
                    <button class="btn btn-primary">Choose Files</button>
                </div>


                <!-- Gallery Grid -->
                <div class="gallery-grid">
                    <?php
                    include_once '../Model/config.php';
                    $query = "SELECT * FROM gambar";
                    $result = mysqli_query($conn, $query);
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                        }
                    }
                    ?>
                    <!-- Image Card 1 -->
                    <div class="image-card">
                        <div class="image-preview">
                            <img src="data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjgwIiBoZWlnaHQ9IjIwMCIgdmlld0JveD0iMCAwIDI4MCAyMDAiIGZpbGw9Im5vbmUiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+CjxyZWN0IHdpZHRoPSIyODAiIGhlaWdodD0iMjAwIiBmaWxsPSIjRjFGNUY5Ii8+CjxyZWN0IHg9IjEwMCIgeT0iNzAiIHdpZHRoPSI4MCIgaGVpZ2h0PSI2MCIgcng9IjgiIGZpbGw9IiNEMUQ1REIiLz4KPGVSBG8geD0iMTI1IiB5PSIxMDAiIHI9IjE1IiBmaWxsPSIjOUNBM0FGIi8+Cjwvc3ZnPgo=" alt="Sample Image">
                            <div class="image-overlay">
                                <button type="button" 
                                            class="absolute top-2 right-2 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center  transition-opacity hover:bg-red-600">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                        </svg>
                                </button>
                            </div>
                        </div>
                        <div class="card-content">
                            <div class="image-filename">product_hero_01.jpg</div>
                        </div>
                    </div>
                </div>
                <button class="btn mt-4 mb-4 bg-red-500 hover:bg-red-600 text-white float-right">Hapus Gambar Dicentang</button>

            </main>
    </div>