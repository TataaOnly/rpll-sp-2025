<?php
if (!isset($_SESSION['login'])) {
        header('Location: ../index.php');
        exit();
}   
?>
<h2 class="text-lg font-medium text-gray-900 mb-4">Ubah Produk</h2>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script type="text/javascript" src="../dist/jquery.tabledit.js"></script>
<link rel="stylesheet" href="ubah-produk.css"> 
<div class="bg-gray-50 p-6">
<div class="max-w-7xl mx-auto">
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <div class="bg-gradient-to-r from-blue-600 to-purple-600 px-6 py-4">
                <h2 class="text-2xl font-bold text-white flex items-center">
                    <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                    </svg>
                    Ubah Produk
                </h2>
                <p class="text-blue-100 mt-1">Kelola produk dengan mudah - klik untuk mengedit</p>
            </div>
            
            <div class="p-6">
                <div class="overflow-x-auto">
                    <table id="data_table" class="product-table w-full table table-striped">
                        <thead>
                            <tr class="bg-gray-50 border-b-2 border-gray-200">
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">ID Produk</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Nama Produk</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Stok</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Harga</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Edit</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Delete</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <!-- Your PHP loop goes here -->
                             <?php
                            include_once '../Model/config.php';
                            $sql_query = "SELECT produk_id, nama, stok, harga, status FROM produk";
                            $resultset = mysqli_query($conn, $sql_query) or die("database error:". mysqli_error($conn));
                            while( $developer = mysqli_fetch_assoc($resultset) ) {
                                $isChecked = $developer['status'] == 'Aktif' ? 'checked' : '';
                                $statusText = $developer['status'] == 'Aktif' ? 'Aktif' : 'Tidak Aktif';
                                $statusClass = $developer['status'] == 'Aktif' ? 'status-active' : 'status-inactive';
                            ?>
                                <tr id="<?php echo $developer['produk_id']; ?>" class="transition-all duration-200">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900"><?php echo $developer['produk_id']; ?></td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><?php echo $developer['nama']; ?></td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><?php echo $developer['stok']; ?></td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><?php echo $developer['harga']; ?></td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        <label class="toggle-switch">
                                            <input type="checkbox" class="status-toggle" data-id="<?php echo $developer['produk_id']; ?>" <?php echo $isChecked; ?>>
                                            <span class="toggle-slider"></span>
                                        </label>
                                        <span class="status-text ml-3 px-2 py-1 rounded-full text-xs font-medium <?php echo $statusClass; ?>"><?php echo $statusText; ?></span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        <a href="?page=edit-produk&id=<?php echo $developer['produk_id']; ?>" class="bg-green-500 text-white px-4 py-2 rounded shadow hover:bg-green-600 transition-colors inline-block text-center">
                                            Edit
                                        </a>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        <form class="deleteform" method="post">
                                            <input type="hidden" name="produk_id" value="<?php echo $developer['produk_id']; ?>">
                                            <button type="submit" 
                                                    class="bg-red-500 text-white px-4 py-2 rounded shadow hover:bg-red-600 transition-colors">
                                                Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            <?php }
                            mysqli_close($conn);
                            ?>
                        </tbody>
                    </table>
                </div>
                
                <div class="mt-6 flex items-center justify-between">
                    <div class="text-sm text-gray-600">
                        <strong>Tips:</strong> Klik pada nama, stok, atau harga untuk mengedit. Toggle switch untuk mengubah status.
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>

    <!-- Toast notification -->
    <div id="toast" class="fixed top-4 right-4 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg transform translate-x-full transition-transform duration-300 ease-in-out z-50">
        <div class="flex items-center">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
            </svg>
            <span id="toast-message">Data berhasil disimpan!</span>
        </div>
    </div>

    <script>
        // Initialize the table with your original Tabledit settings
        $(document).ready(function(){
            $('#data_table').Tabledit({
                deleteButton: false,
                editButton: false,
                columns: {
                    identifier: [0, 'produk_id'],
                    editable: [[1, 'nama'], [2, 'stok'], [3, 'harga']]
                },
                hideIdentifier: false,
                url: '../Controller/live_edit.php',
                // Add validation before submit
                onAjax: function(action, serialize) {
                    // Get the edited values
                    var data = new URLSearchParams(serialize);
                    var stok = data.get('stok');
                    var harga = data.get('harga');
                    
                    // Validate stok (must be number and positive)
                    if (data.has('stok') && (!Number.isInteger(Number(stok)) || Number(stok) < 0)) {
                        showToast('Stok harus berupa angka positif', 'error');
                        return false;
                    }
                    
                    // Validate harga (must be number and positive)
                    if (data.has('harga') && (!Number.isInteger(Number(harga)) || Number(harga) < 0)) {
                        showToast('Harga harus berupa angka positif', 'error');
                        return false;
                    }
                    
                    return true;
                },
                onSuccess: function(data, textStatus, jqXHR) {
                    showToast('Data berhasil disimpan!', 'success');
                    console.log('Success:', data);
                },
                onFail: function(jqXHR, textStatus, errorThrown) {
                    showToast('Terjadi kesalahan saat menyimpan data!', 'error');
                    console.log('Error:', errorThrown);
                }
            });
            
            // Handle status toggle - this is separate from Tabledit
            $('.status-toggle').change(function() {
                var $toggle = $(this);
                var $statusText = $toggle.closest('td').find('.status-text');
                var $row = $toggle.closest('tr');
                var productId = $toggle.data('id');
                var isActive = $toggle.is(':checked');
                
                // Add loading effect
                $row.addClass('loading');
                
                // Update status text and styling
                if (isActive) {
                    $statusText.text('Aktif').removeClass('status-inactive').addClass('status-active');
                } else {
                    $statusText.text('Tidak Aktif').removeClass('status-active').addClass('status-inactive');
                }
                
                // AJAX call to update status
                $.post('../Controller/update_status.php', {
                    produk_id: productId,
                    status: isActive ? 'Aktif' : 'Non-Aktif'
                }, function(response) {
                    $row.removeClass('loading');
                    showToast('Status produk berhasil diubah!', 'success');
                }).fail(function() {
                    $row.removeClass('loading');
                    showToast('Terjadi kesalahan saat mengubah status!', 'error');
                    // Revert toggle state
                    $toggle.prop('checked', !isActive);
                    if (!isActive) {
                        $statusText.text('Aktif').removeClass('status-inactive').addClass('status-active');
                    } else {
                        $statusText.text('Tidak Aktif').removeClass('status-active').addClass('status-inactive');
                    }
                });
            });
        });
        
        // Toast notification function
        function showToast(message, type = 'success') {
            var $toast = $('#toast');
            var $toastMessage = $('#toast-message');
            
            $toast.removeClass('bg-green-500 bg-red-500');
            if (type === 'success') {
                $toast.addClass('bg-green-500');
            } else {
                $toast.addClass('bg-red-500');
            }
            
            $toastMessage.text(message);
            $toast.removeClass('translate-x-full');
            
            setTimeout(function() {
                $toast.addClass('translate-x-full');
            }, 3000);
        }

        $(document).ready(function () {
            $(document).on('submit', '.deleteform', function (e) {
                e.preventDefault();
                if (confirm('Are you sure you want to delete this post?')) {
                    var produk_id = $(this).find('input[name="produk_id"]').val();
                    $.ajax({
                        type: 'POST',
                        url: "../Controller/delete_produk.php", // URL to your delete script
                        data: $(this).serialize(),
                        success: function (response) {
                            // Handle success response
                            showToast('Product deleted successfully', 'success');
                            $('tr#' + produk_id).remove(); // Remove the row from the table
                        },
                    });
                }
            });
        });
    </script>
