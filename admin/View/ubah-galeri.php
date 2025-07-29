<?php
require_once '../Middleware/AuthMiddleware.php';
AuthMiddleware::handle();

require_once '../Service/ProdukService.php';
require_once '../Service/GambarService.php';
require_once '../Helpers/ErrorHandler.php';
?>
<link rel="stylesheet" href="ubah-galeri.css">

<!-- error and success message display -->
<?php 
ErrorHandler::displayErrors();
ErrorHandler::displaySuccess();
?>

<div class="main-content">
    <!-- Content Area -->
    <main class="content-area">
        <?php
        // Use service to get gallery product
        $produkService = new ProdukService();
        $gambarService = new GambarService();
        
        // Find gallery product (assuming it's the one with 'custom' name)
        $products = $produkService->getAllProducts();
        $produk_id = 0;
        
        if ($products) {
            foreach ($products as $product) {
                if (stripos($product['nama'], 'custom') !== false) {
                    $produk_id = $product['produk_id'];
                    break;
                }
            }
        }
        
        // If no custom product found, create one
        if ($produk_id == 0) {
            $initial_data = [
                'nama' => 'custom',
                'harga' => 0,
                'stok' => 0,
                'deskripsi' => 'Gallery images'
            ];
            $produk_id = $produkService->addProduct($initial_data);
        }
        ?>
        <!-- Page Header -->
        <form method="POST" action="../Controller/tambah_galeri.php" enctype="multipart/form-data">
            <div class="page-header">
                <h1 class="page-title">Ubah Galeri</h1>
                <div class="header-actions">
                    <button type="submit" class="btn btn-primary">+ Add Images</button>
                </div>
            </div>
            
                <input type="hidden" name="produk_id" value="<?php echo htmlspecialchars($produk_id); ?>">
            <!-- Upload area -->
            <div id="upload-area" class="flex justify-center rounded-lg border border-dashed border-gray-900/25 px-6 py-10 hover:border-gray-400 transition-colors">
                <div class="text-center">
                    <svg class="mx-auto size-12 text-gray-300" viewBox="0 0 24 24" fill="currentColor">
                        <path fill-rule="evenodd" d="M1.5 6a2.25 2.25 0 0 1 2.25-2.25h16.5A2.25 2.25 0 0 1 22.5 6v12a2.25 2.25 0 0 1-2.25 2.25H3.75A2.25 2.25 0 0 1 1.5 18V6ZM3 16.06V18c0 .414.336.75.75.75h16.5A.75.75 0 0 0 21 18v-1.94l-2.69-2.689a1.5 1.5 0 0 0-2.12 0l-.88.879.97.97a.75.75 0 1 1-1.06 1.06l-5.16-5.159a1.5 1.5 0 0 0-2.12 0L3 16.061Zm10.125-7.81a1.125 1.125 0 1 1 2.25 0 1.125 1.125 0 0 1-2.25 0Z" clip-rule="evenodd" />
                    </svg>
                    <div class="mt-4 flex text-sm/6 text-gray-600">
                        <label for="file-upload" class="relative cursor-pointer rounded-md bg-white font-semibold text-indigo-600 focus-within:ring-2 focus-within:ring-indigo-600 focus-within:ring-offset-2 focus-within:outline-hidden hover:text-indigo-500">
                            <span>Add more images</span>
                            <input id="file-upload" name="file-upload[]" type="file" class="sr-only" multiple accept="image/*" />
                        </label>
                        <p class="pl-1">or drag and drop</p>
                    </div>
                    <p class="text-xs/5 text-gray-600">PNG, JPG, GIF up to 10MB each</p>
                </div>
            </div>
            <div id="all-images" class="grid grid-cols-2 md:grid-cols-3 object-contain lg:grid-cols-4 gap-4 mb-4"></div>
        </form>

        <br/>
        <hr/>
        <br />
        <h2 class="text-lg font-semibold mb-4">Existing Images</h2>
        <!-- Gallery Grid -->
        <div class="gallery-grid">
           <?php
            // Use service to get images
            $images = $gambarService->getAllImagesByProductId($produk_id);
            
            if ($images && !empty($images)) {
                foreach ($images as $image) {
            ?>
            <!-- Image Card 1 -->
            <?php foreach ($images as $image): ?>
            <div class="image-card" data-image-id="<?php echo htmlspecialchars($image['gambar_id']); ?>">
                <div class="image-preview">
                    <img src="../../uploads/<?php echo htmlspecialchars($image['file']); ?>" alt="Sample Image">
                    <div class="image-overlay">
                        <div class="image-checkbox absolute top-2 left-2">
                            <input type="checkbox" 
                                id="image_<?php echo $image['gambar_id']; ?>" 
                                name="selected_images[]" 
                                value="<?php echo $image['gambar_id']; ?>"
                                class="image-select-checkbox">
                        </div>
                        <button type="button" 
                                    onclick="deleteImage(<?php echo $image['gambar_id']; ?>)"
                                    class="absolute top-2 right-2 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center transition-opacity hover:bg-red-600">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                        </button>
                    </div>
                </div>
                <div class="card-content">
                    <div class="image-filename"><?php echo htmlspecialchars($image['file']); ?></div>
                </div>
            <?php 
                }
            } else {
                echo '<p class="text-gray-500">No images found. Upload some images to get started.</p>';
            }
            ?>
        <button type="button" 
                onclick="deleteSelectedImages()" 
                class="btn mt-4 mb-4 bg-red-500 hover:bg-red-600 text-white float-right">
            Hapus Gambar Dicentang
        </button>

    </main>
</div>

    <script>
        const uploadArea = document.getElementById('upload-area');
        const fileInput = document.getElementById('file-upload');
        const allImages = document.getElementById('all-images');

        let selectedFiles = [];

        const validImageTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif', 'image/webp'];
        const maxFileSize = 10 * 1024 * 1024; // 10MB

        uploadArea.addEventListener('dragover', (e) => {
            e.preventDefault();
            uploadArea.classList.add('border-indigo-600', 'bg-indigo-50');
        });

        uploadArea.addEventListener('dragleave', (e) => {
            e.preventDefault();
            uploadArea.classList.remove('border-indigo-600', 'bg-indigo-50');
        });
        
        uploadArea.addEventListener('drop', (e) => {
            e.preventDefault();
            uploadArea.classList.remove('border-indigo-600', 'bg-indigo-50');
            const files = Array.from(e.dataTransfer.files);
            handleFiles(files);
        });

        function validateFile(file){
            if(!validImageTypes.includes(file.type)){
                alert(`${file.name} is not a valid image type. Please upload JPEG, PNG, GIF, or WebP files.`);
                return false;
            }

            if(file.size > maxFileSize){
                alert(`${file.name} is too large. Maximum size is 10MB.`);
                return false;
            }

            return true;
        }

        function displayImage(file) {
            const reader = new FileReader();
            reader.onload = (e) => {
                const imageDiv = document.createElement('div');
                imageDiv.className = 'relative group new-image';

                imageDiv.innerHTML = `
                    <div class="image-card">
                        <div class="image-preview">
                            <img src="${e.target.result}" alt="Sample Image">
                            <div class="image-overlay">
                                <button type="button" 
                                            class="absolute top-2 right-2 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center  transition-opacity hover:bg-red-600" onclick="removeNewImage(this, '${file.name}')">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                        </svg>
                                </button>
                            </div>
                        </div>
                        <div class="card-content">
                            <div class="image-filename">${file.name}</div>
                        </div>
                    </div>
                    
                `;
                
                allImages.appendChild(imageDiv);
            };
            reader.readAsDataURL(file);
        }

        function updateFileInput() {
            const dt = new DataTransfer();
            selectedFiles.forEach(file => dt.items.add(file));
            fileInput.files = dt.files;
        }

        function handleFiles(files){
            const validFiles = [];
            files.forEach(file => {
                if (validateFile(file)) {
                    validFiles.push(file);
                }
            });
            
            validFiles.forEach(file => {
                selectedFiles.push(file);
                displayImage(file);
            });
            
            if (validFiles.length > 0) {
                updateFileInput();
            }

        }

        fileInput.addEventListener('change', (e) => {
            const files = Array.from(e.target.files);
            handleFiles(files);
        });

        window.removeNewImage = function(button, fileName) {
            selectedFiles = selectedFiles.filter(file => file.name !== fileName);
            button.parentElement.parentElement.parentElement.parentElement.remove();
            updateFileInput();
        };

        //delete banyak gambar
        function deleteSelectedImages() {
            const selectedCheckboxes = document.querySelectorAll('.image-select-checkbox:checked');
            
            if (selectedCheckboxes.length === 0) {
                alert('Please select at least one image to delete.');
                return;
            }
            
            if (!confirm(`Are you sure you want to delete ${selectedCheckboxes.length} selected image(s)?`)) {
                return;
            }
            
            const imageIds = Array.from(selectedCheckboxes).map(cb => cb.value);
            deleteImages(imageIds, selectedCheckboxes);
        }

        //delete 1 gambar
        function deleteImage(imageId) {
            if (!confirm('Are you sure you want to delete this image?')) {
                return;
            }
            
            const imageElement = document.querySelector(`[data-image-id="${imageId}"]`);
            deleteImages([imageId], [imageElement]);
        }

        // Delete gambar
        function deleteImages(imageIds, elementsToRemove) {
            const formData = new FormData();
            formData.append('produk_id', '<?php echo $produk_id; ?>');
            
            // Send as array for both single and multiple
            imageIds.forEach(id => formData.append('image_ids[]', id));
            
            fetch('../Controller/delete_galeri.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert(data.message);
                    // Remove elements from DOM
                    elementsToRemove.forEach(element => {
                        if (element.closest) {
                            element.closest('.image-card').remove();
                        } else {
                            element.remove();
                        }
                    });
                } else {
                    alert('Error: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Failed to delete images');
            });
        }


    </script>