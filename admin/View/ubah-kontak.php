<?php
require_once '../Middleware/AuthMiddleware.php';
AuthMiddleware::handle();

require_once '../Helpers/ErrorHandler.php';
require_once '../Helpers/KontakHelper.php';

// Get current contact data
$kontak = KontakHelper::getKontak();

if (!$kontak) {
    ErrorHandler::addError('Contact data not found');
    $kontak = [
        'nama' => '',
        'email' => '',
        'no_telp' => '',
        'no_wa' => '',
        'map' => '',
        'alamat' => ''
    ];
}

ErrorHandler::displayErrors();
ErrorHandler::displaySuccess();
?>

<div class="space-y-12">
    <!-- Contact Information Form -->
    <form method="POST" action="../Controller/update_kontak.php" id="contact-form">
        <div class="border-b border-gray-900/10 pb-12">
            <h2 class="text-base/7 font-semibold text-gray-900">Contact Information</h2>
            <p class="mt-1 text-sm/6 text-gray-600">Update your business contact details and location.</p>

            <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                <div class="sm:col-span-4">
                    <label for="nama" class="block text-sm/6 font-medium text-gray-900">Business Name</label>
                    <div class="mt-2">
                        <div class="flex items-center rounded-md bg-white pl-3 outline-1 -outline-offset-1 outline-gray-300 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-indigo-600">
                            <input type="text" name="nama" id="nama" 
                                value="<?php echo htmlspecialchars($kontak['nama']); ?>" 
                                class="block min-w-0 grow py-1.5 pr-3 px-3 text-base text-gray-900 border-b placeholder:text-gray-400 focus:outline-none sm:text-sm/6" 
                                placeholder="Enter business name" />
                        </div>
                    </div>
                </div>

                <div class="sm:col-span-4">
                    <label for="email" class="block text-sm/6 font-medium text-gray-900">Email Address</label>
                    <div class="mt-2">
                        <div class="flex items-center rounded-md bg-white pl-3 outline-1 -outline-offset-1 outline-gray-300 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-indigo-600">
                            <input type="email" name="email" id="email" 
                                value="<?php echo htmlspecialchars($kontak['email']); ?>" 
                                class="block min-w-0 grow py-1.5 pr-3 px-3 text-base text-gray-900 border-b placeholder:text-gray-400 focus:outline-none sm:text-sm/6" 
                                placeholder="Enter email address" />
                        </div>
                    </div>
                </div>

                <div class="sm:col-span-3">
                    <label for="no_telp" class="block text-sm/6 font-medium text-gray-900">Phone Number</label>
                    <div class="mt-2">
                        <div class="flex items-center rounded-md bg-white pl-3 outline-1 -outline-offset-1 outline-gray-300 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-indigo-600">
                            <input type="tel" name="no_telp" id="no_telp" 
                                value="<?php echo htmlspecialchars($kontak['no_telp']); ?>" 
                                class="block min-w-0 grow py-1.5 pr-3 px-3 text-base text-gray-900 border-b placeholder:text-gray-400 focus:outline-none sm:text-sm/6" 
                                placeholder="081234567890" />
                        </div>
                    </div>
                </div>

                <div class="sm:col-span-3">
                    <label for="no_wa" class="block text-sm/6 font-medium text-gray-900">WhatsApp Number</label>
                    <div class="mt-2">
                        <div class="flex items-center rounded-md bg-white pl-3 outline-1 -outline-offset-1 outline-gray-300 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-indigo-600">
                            <input type="tel" name="no_wa" id="no_wa" 
                                value="<?php echo htmlspecialchars($kontak['no_wa']); ?>" 
                                class="block min-w-0 grow py-1.5 pr-3 px-3 text-base text-gray-900 border-b placeholder:text-gray-400 focus:outline-none sm:text-sm/6" 
                                placeholder="081234567890" />
                        </div>
                    </div>
                </div>

                <div class="sm:col-span-6">
                    <label for="alamat" class="block text-sm/6 font-medium text-gray-900">Address</label>
                    <div class="mt-2">
                        <div class="flex items-center rounded-md bg-white pl-3 outline-1 -outline-offset-1 outline-gray-300 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-indigo-600">
                            <textarea name="alamat" id="alamat" rows="3" 
                                class="block min-w-0 grow py-1.5 pr-3 px-3 text-base text-gray-900 border-b placeholder:text-gray-400 focus:outline-none sm:text-sm/6" 
                                placeholder="Enter business address"><?php echo htmlspecialchars($kontak['alamat']); ?></textarea>
                        </div>
                    </div>
                </div>

                <div class="sm:col-span-6">
                    <label for="map" class="block text-sm/6 font-medium text-gray-900">Map Embed</label>
                    <div class="mt-2">
                        <div class="flex items-center rounded-md bg-white pl-3 outline-1 -outline-offset-1 outline-gray-300 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-indigo-600">
                            <textarea name="map" id="map" rows="4" 
                                class="block min-w-0 grow py-1.5 pr-3 px-3 text-base text-gray-900 border-b placeholder:text-gray-400 focus:outline-none sm:text-sm/6" 
                                placeholder="Paste Google Maps embed code or URL here..."><?php echo htmlspecialchars($kontak['map']); ?></textarea>
                        </div>
                        <p class="mt-2 text-sm text-gray-500">Add a Google Maps embed iframe code or URL for your business location</p>
                    </div>
                </div>
            </div>

            <div class="mt-6 flex items-center justify-end gap-x-6">
                <button type="button" onclick="resetContactForm()" class="text-sm/6 font-semibold text-gray-900">Reset</button>
                <button type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                    Update Contact Info
                </button>
            </div>
        </div>
    </form>

    <!-- Password Change Form -->
    <form method="POST" action="../Controller/update_password.php" id="password-form">
        <div class="border-b border-gray-900/10 pb-12">
            <h2 class="text-base/7 font-semibold text-gray-900">Change Admin Password</h2>
            <p class="mt-1 text-sm/6 text-gray-600">Update your admin login password for security.</p>

            <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                <div class="sm:col-span-4">
                    <label for="current_password" class="block text-sm/6 font-medium text-gray-900">Current Password</label>
                    <div class="mt-2">
                        <div class="flex items-center rounded-md bg-white pl-3 outline-1 -outline-offset-1 outline-gray-300 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-indigo-600">
                            <input type="password" name="current_password" id="current_password" 
                                class="block min-w-0 grow py-1.5 pr-3 px-3 text-base text-gray-900 border-b placeholder:text-gray-400 focus:outline-none sm:text-sm/6" 
                                placeholder="Enter current password" required />
                        </div>
                    </div>
                </div>

                <div class="sm:col-span-4">
                    <label for="new_password" class="block text-sm/6 font-medium text-gray-900">New Password</label>
                    <div class="mt-2">
                        <div class="flex items-center rounded-md bg-white pl-3 outline-1 -outline-offset-1 outline-gray-300 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-indigo-600">
                            <input type="password" name="new_password" id="new_password" 
                                class="block min-w-0 grow py-1.5 pr-3 px-3 text-base text-gray-900 border-b placeholder:text-gray-400 focus:outline-none sm:text-sm/6" 
                                placeholder="Enter new password" required minlength="6" />
                        </div>
                        <p class="mt-2 text-sm text-gray-500">Password must be at least 6 characters long</p>
                    </div>
                </div>

                <div class="sm:col-span-4">
                    <label for="confirm_password" class="block text-sm/6 font-medium text-gray-900">Confirm New Password</label>
                    <div class="mt-2">
                        <div class="flex items-center rounded-md bg-white pl-3 outline-1 -outline-offset-1 outline-gray-300 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-indigo-600">
                            <input type="password" name="confirm_password" id="confirm_password" 
                                class="block min-w-0 grow py-1.5 pr-3 px-3 text-base text-gray-900 border-b placeholder:text-gray-400 focus:outline-none sm:text-sm/6" 
                                placeholder="Confirm new password" required minlength="6" />
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-6 flex items-center justify-end gap-x-6">
                <button type="button" onclick="resetPasswordForm()" class="text-sm/6 font-semibold text-gray-900">Reset</button>
                <button type="submit" class="rounded-md bg-red-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-red-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-red-600">
                    Change Password
                </button>
            </div>
        </div>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const passwordForm = document.getElementById('password-form');
    const newPassword = document.getElementById('new_password');
    const confirmPassword = document.getElementById('confirm_password');

    // Password validation
    function validatePassword() {
        if (newPassword.value !== confirmPassword.value) {
            confirmPassword.setCustomValidity('Passwords do not match');
            return false;
        } else {
            confirmPassword.setCustomValidity('');
            return true;
        }
    }

    newPassword.addEventListener('input', validatePassword);
    confirmPassword.addEventListener('input', validatePassword);

    // Form submission validation
    passwordForm.addEventListener('submit', function(e) {
        if (!validatePassword()) {
            e.preventDefault();
            alert('Passwords do not match!');
            return false;
        }

        if (newPassword.value.length < 6) {
            e.preventDefault();
            alert('Password must be at least 6 characters long!');
            return false;
        }

        return confirm('Are you sure you want to change your password?');
    });

    // Contact form submission
    document.getElementById('contact-form').addEventListener('submit', function(e) {
        return confirm('Update contact information?');
    });
});

// Reset functions
function resetContactForm() {
    if (confirm('Reset all contact information to original values?')) {
        document.getElementById('contact-form').reset();
    }
}

function resetPasswordForm() {
    if (confirm('Clear all password fields?')) {
        document.getElementById('password-form').reset();
    }
}

// Phone number formatting 
function formatPhoneNumber(input) {
    let value = input.value.replace(/\D/g, '');
    if (value.length > 13) {
        value = value.substring(0, 13);
    }
    input.value = value;
}

document.getElementById('no_telp').addEventListener('input', function() {
    formatPhoneNumber(this);
});

document.getElementById('no_wa').addEventListener('input', function() {
    formatPhoneNumber(this);
});
</script>