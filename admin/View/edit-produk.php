<?php
if(!isset($_SESSION)) 
{ 
    session_start(); 
} 
if (!isset($_SESSION['login'])) {
        header('Location: ../index.php');
        exit();
    }   
$errors = isset($_SESSION['errors']) ? $_SESSION['errors'] : [];
$old = isset($_SESSION['old']) ? $_SESSION['old'] : [];
unset($_SESSION['errors']);
unset($_SESSION['old']);
include_once '../Model/config.php';
if (isset($_GET['id'])) {
    $produk_id = mysqli_real_escape_string($conn, $_GET['id']);
    $query = "SELECT * FROM produk WHERE produk_id = '$produk_id'";
    $result = mysqli_query($conn, $query);
    $produk = mysqli_fetch_assoc($result);

    // Get existing images
    $image_query = "SELECT * FROM gambar WHERE produk_id = '$produk_id'";
    $image_result = mysqli_query($conn, $image_query);
    $existing_images = [];
    while ($row = mysqli_fetch_assoc($image_result)) {
        $existing_images[] = $row;
    }
}

?>
<form method="POST" action="../Controller/update_produk.php" enctype="multipart/form-data">
    <input type="hidden" name="produk_id" value="<?php echo $produk['produk_id']; ?>">
    <input type="hidden" name="deleted_images" id="deleted-images" value="">

    <div class="space-y-12">
        <div class="border-b border-gray-900/10 pb-12">
            <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                <div class="sm:col-span-4">
                    <label for="nama-produk" class="block text-sm/6 font-medium text-gray-900">Nama Produk</label>
                    <div class="mt-2">
                        <div class="flex items-center rounded-md bg-white pl-3 outline-1 -outline-offset-1 outline-gray-300 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-indigo-600">
                            <input type="text" name="nama-produk" id="nama-produk" 
                                value="<?php echo htmlspecialchars($produk['nama']); ?>" 
                                class="block min-w-0 grow py-1.5 pr-3 px-3 text-base text-gray-900 border-b placeholder:text-gray-400 focus:outline-none sm:text-sm/6" />
                        </div>
                        <?php if (isset($errors['nama-produk'])): ?>
                            <div class="text-red-500 text-sm/6 mt-1"><?php echo htmlspecialchars($errors['nama-produk']); ?></div>
                        <?php endif; ?>
                    </div>
                </div>

            <div class="sm:col-span-4">
                <label for="harga-produk" class="block text-sm/6 font-medium text-gray-900">Harga Produk</label>
                <div class="mt-2">
                    <div class="flex items-center rounded-md bg-white pl-3 outline-1 -outline-offset-1 outline-gray-300 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-indigo-600">
                        <input type="number" name="harga-produk" id="harga-produk" min="0" value="<?php echo htmlspecialchars($produk['harga']); ?>" class="block min-w-0 grow border-b py-1.5 pr-3 pl-1 text-base text-gray-900 placeholder:text-gray-400 focus:outline-none sm:text-sm/6" />
                    </div>
                    <?php if (isset($errors['harga-produk'])): ?>
                            <div class="text-red-500 text-sm/6 mt-1"><?php echo htmlspecialchars($errors['harga-produk']); ?></div>
                    <?php endif; ?>
                </div>
            </div>

            <div class="sm:col-span-4">
                <label for="stok-produk" class="block text-sm/6 font-medium text-gray-900">Stok Produk</label>
                <div class="mt-2">
                    <div class="flex items-center rounded-md bg-white pl-3 outline-1 -outline-offset-1 outline-gray-300 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-indigo-600">
                    <input type="number" name="stok-produk" id="stok-produk" min="0" value="<?php echo htmlspecialchars($produk['stok']); ?>"  class="block min-w-0 grow py-1.5 pr-3 pl-1 border-b text-base text-gray-900 placeholder:text-gray-400 focus:outline-none sm:text-sm/6" />
                    </div>
                    <?php if (isset($errors['stok-produk'])): ?>
                            <div class="text-red-500 text-sm/6 mt-1"><?php echo htmlspecialchars($errors['stok-produk']); ?></div>
                    <?php endif; ?>
                </div>
            </div>

                <div class="col-span-full">
                    <label for="cover-photo" class="block text-sm/6 font-medium text-gray-900">Product Images</label>
                    <div class="mt-2">
                        
                        <!-- Combined Images Display Area -->
                        <div id="all-images" class="grid grid-cols-2 md:grid-cols-3 object-contain lg:grid-cols-4 gap-4 mb-4 <?php echo empty($existing_images) ? 'hidden' : ''; ?>">
                            <!-- Existing images will be shown here -->
                            <?php foreach ($existing_images as $image): ?>
                                <div class="relative group existing-image" data-image-id="<?php echo $image['gambar_id']; ?>">
                                    <img src="../../uploads/<?php echo htmlspecialchars($image['file']); ?>" 
                                        alt="Product Image" 
                                        class="w-full h-32 object-contain rounded-lg shadow-md">
                                    <button type="button" 
                                            onclick="markForDeletion(<?php echo $image['gambar_id']; ?>, this)"
                                            class="absolute top-2 right-2 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity hover:bg-red-600">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                        </svg>
                                    </button>
                                    <div class="absolute bottom-2 left-2 bg-blue-500 text-white px-2 py-1 rounded text-xs existing-label">
                                        Existing
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>

                        <!-- Upload Area -->
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
                    </div>
                </div>
            <br>
            <?php if (!empty($errors)): ?>
                <div class="text-red-500 text-sm/6">
                    <ul>
                        <?php foreach ($errors as $error): ?>
                            <li><?php echo htmlspecialchars($error); ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>
        </div>

        <div class="mt-6 flex items-center justify-end gap-x-6">
        <button type="button" onclick="cancelChanges()" class="text-sm/6 font-semibold text-gray-900">Cancel</button>
        <button type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Update</button>
    </div>
    </form>

    <script>
document.addEventListener('DOMContentLoaded', function() {
    const uploadArea = document.getElementById('upload-area');
    const fileInput = document.getElementById('file-upload');
    const allImages = document.getElementById('all-images');
    const deletedImagesInput = document.getElementById('deleted-images');
    
    let selectedFiles = [];
    let deletedImageIds = [];
    let originalImageState = {};

    // Valid image types
    const validImageTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif', 'image/webp'];
    const maxFileSize = 10 * 1024 * 1024; // 10MB


    function validateImage(file) {
        if (!validImageTypes.includes(file.type)) {
            alert(`${file.name} is not a valid image type. Please upload JPEG, PNG, GIF, or WebP files.`);
            return false;
        }
        
        if (file.size > maxFileSize) {
            alert(`${file.name} is too large. Maximum size is 10MB.`);
            return false;
        }
        
        return true;
    }


    // Store original state of existing images
    document.querySelectorAll('.existing-image').forEach(img => {
        const imageId = img.dataset.imageId;
        originalImageState[imageId] = {
            element: img.cloneNode(true),
            deleted: false
        };
    });

    // Mark image for deletion (visual only)
    window.markForDeletion = function(imageId, button) {
        if (!confirm('Mark this image for deletion? Changes will only be saved when you click Update.')) {
            return;
        }

        const imageContainer = button.closest('.existing-image');
        
        // Add visual indication of deletion
        imageContainer.classList.add('opacity-50');
        imageContainer.querySelector('img').classList.add('grayscale');
        
        // Change label and button
        const label = imageContainer.querySelector('.existing-label');
        label.textContent = 'Will be deleted';
        label.classList.remove('bg-blue-500');
        label.classList.add('bg-red-500');
        
        // Change button to restore function
        button.onclick = function() { restoreImage(imageId, this); };
        button.classList.remove('bg-red-500', 'hover:bg-red-600');
        button.classList.add('bg-green-500', 'hover:bg-green-600');
        button.innerHTML = `
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
            </svg>
        `;

        // Add to deletion list
        if (!deletedImageIds.includes(imageId)) {
            deletedImageIds.push(imageId);
            updateDeletedImagesInput();
        }
    };

    // Restore image from deletion
    window.restoreImage = function(imageId, button) {
        const imageContainer = button.closest('.existing-image');
        
        // Remove visual indication of deletion
        imageContainer.classList.remove('opacity-50');
        imageContainer.querySelector('img').classList.remove('grayscale');
        
        // Restore label and button
        const label = imageContainer.querySelector('.existing-label');
        label.textContent = 'Existing';
        label.classList.remove('bg-red-500');
        label.classList.add('bg-blue-500');
        
        // Change button back to delete function
        button.onclick = function() { markForDeletion(imageId, this); };
        button.classList.remove('bg-green-500', 'hover:bg-green-600');
        button.classList.add('bg-red-500', 'hover:bg-red-600');
        button.innerHTML = `
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        `;

        // Remove from deletion list
        deletedImageIds = deletedImageIds.filter(id => id != imageId);
        updateDeletedImagesInput();
    };

    // Update hidden input with deleted image IDs
    function updateDeletedImagesInput() {
        deletedImagesInput.value = deletedImageIds.join(',');
    }

    // Cancel all changes
    window.cancelChanges = function() {
        if (!confirm('Cancel all changes and return to product list?')) {
            return;
        }
        
        // Redirect back to product list
        window.location.href = '?page=ubah-produk';
    };

    // Show images container if there are existing images or new uploads
    function updateImageDisplay() {
        const hasExisting = document.querySelectorAll('.existing-image').length > 0;
        const hasNew = selectedFiles.length > 0;
        
        if (hasExisting || hasNew) {
            allImages.classList.remove('hidden');
        } else {
            allImages.classList.add('hidden');
        }
    }

    // Handle file uploads with validation
    function handleFiles(files) {
        const validFiles = [];
        
        files.forEach(file => {
            if (validateImage(file)) {
                validFiles.push(file);
            }
        });
        
        validFiles.forEach(file => {
            selectedFiles.push(file);
            displayNewImage(file);
        });
        
        if (validFiles.length > 0) {
            updateImageDisplay();
            updateFileInput();
        }
    }

    function displayNewImage(file) {
        const reader = new FileReader();
        reader.onload = (e) => {
            const imageDiv = document.createElement('div');
            imageDiv.className = 'relative group new-image';
            
            imageDiv.innerHTML = `
                <img src="${e.target.result}" 
                     alt="New Image" 
                     class="w-full h-32 object-contain rounded-lg shadow-md">
                <button type="button" 
                        onclick="removeNewImage(this, '${file.name}')"
                        class="absolute top-2 right-2 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity hover:bg-red-600">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
                <div class="absolute bottom-2 left-2 bg-green-500 text-white px-2 py-1 rounded text-xs">
                    New
                </div>
            `;
            
            allImages.appendChild(imageDiv);
        };
        reader.readAsDataURL(file);
    }

    // Remove new image
    window.removeNewImage = function(button, fileName) {
        selectedFiles = selectedFiles.filter(file => file.name !== fileName);
        button.parentElement.remove();
        updateImageDisplay();
        updateFileInput();
    };

    function updateFileInput() {
        const dt = new DataTransfer();
        selectedFiles.forEach(file => dt.items.add(file));
        fileInput.files = dt.files;
    }

    // Event listeners for drag and drop
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
        const files = Array.from(e.dataTransfer.files).filter(file => file.type.startsWith('image/'));
        handleFiles(files);
    });

    fileInput.addEventListener('change', (e) => {
        const files = Array.from(e.target.files);
        handleFiles(files);
    });

    // Add some CSS for visual feedback
    const style = document.createElement('style');
    style.textContent = `
        .grayscale {
            filter: grayscale(100%);
        }
    `;
    document.head.appendChild(style);
});
</script>