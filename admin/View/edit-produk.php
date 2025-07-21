<form method="POST" action="/produks" enctype="multipart/form-data">

        <div class="space-y-12">
            <div class="border-b border-gray-900/10 pb-12">
            <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                <div class="sm:col-span-4">
                <label for="nama-produk" class="block text-sm/6 font-medium text-gray-900">Nama Produk</label>
                <div class="mt-2">
                    <div class="flex items-center rounded-md bg-white pl-3 outline-1 -outline-offset-1 outline-gray-300 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-indigo-600">
                        <input type="text" name="nama-produk" id="nama-produk" class="block min-w-0 grow py-1.5 pr-3 px-3 text-base text-gray-900 border-b placeholder:text-gray-400 focus:outline-none sm:text-sm/6" value="{{ $produk->nama }}" />
                    </div>
                    
                    @error('nama-produk')
                        <div class="text-red-500 text-sm/6 mt-1">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="sm:col-span-4">
                <label for="harga-produk" class="block text-sm/6 font-medium text-gray-900">Harga Produk</label>
                <div class="mt-2">
                    <div class="flex items-center rounded-md bg-white pl-3 outline-1 -outline-offset-1 outline-gray-300 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-indigo-600">
                        <input type="number" name="harga-produk" id="harga-produk" min="0" value="{{ $produk->harga }}" step=".01" class="block min-w-0 grow border-b py-1.5 pr-3 pl-1 text-base text-gray-900 placeholder:text-gray-400 focus:outline-none sm:text-sm/6" />
                    </div>

                    @error('harga-produk')
                        <div class="text-red-500 text-sm/6 mt-1">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="sm:col-span-4">
                <label for="stok-produk" class="block text-sm/6 font-medium text-gray-900">Stok Produk</label>
                <div class="mt-2">
                    <div class="flex items-center rounded-md bg-white pl-3 outline-1 -outline-offset-1 outline-gray-300 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-indigo-600">
                    <input type="number" name="stok-produk" id="stok-produk" min="0" value="{{ $produk->stok }}" class="block min-w-0 grow py-1.5 pr-3 pl-1 border-b text-base text-gray-900 placeholder:text-gray-400 focus:outline-none sm:text-sm/6" " />
                    </div>

                    @error('stok-produk')
                        <div class="text-red-500 text-sm/6 mt-1">{{ $message }}</div>
                    @enderror
                </div>
            </div>

                <div class="col-span-full">
                <label for="deksripsi" class="block text-sm/6 font-medium text-gray-900">Deskripsi</label>
                <div class="mt-2">
                    <textarea name="deksripsi" id="deksripsi" rows="3" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 border-b outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" value="{{ $produk->deskripsi }}"></textarea>
                </div>
                <p class="mt-3 text-sm/6 text-gray-600">Tulis Deskripsi Produk.</p>
                </div>

                <div class="col-span-full">
                <label for="photo" class="block text-sm/6 font-medium text-gray-900">Photo</label>
                <div class="mt-2 flex items-center gap-x-3">
                    <div class="w-[300px] h-[300px] flex items-center justify-center rounded-md bg-gray-100 overflow-hidden">
                    <svg class="w-[300px] h-[300px] text-gray-300" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true" data-slot="icon">
                        <path fill-rule="evenodd" d="M18.685 19.097A9.723 9.723 0 0 0 21.75 12c0-5.385-4.365-9.75-9.75-9.75S2.25 6.615 2.25 12a9.723 9.723 0 0 0 3.065 7.097A9.716 9.716 0 0 0 12 21.75a9.716 9.716 0 0 0 6.685-2.653Zm-12.54-1.285A7.486 7.486 0 0 1 12 15a7.486 7.486 0 0 1 5.855 2.812A8.224 8.224 0 0 1 12 20.25a8.224 8.224 0 0 1-5.855-2.438ZM15.75 9a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0Z" clip-rule="evenodd" />
                    </svg>
                    </div>
                    <button type="button" class="rounded-md bg-white px-2.5 py-1.5 text-sm font-semibold text-gray-900 shadow-xs ring-1 ring-gray-300 ring-inset hover:bg-gray-50">Change</button>
                </div>
                </div>

                <div class="col-span-full">
                <label for="cover-photo" class="block text-sm/6 font-medium text-gray-900">Cover photo</label>
                <div class="mt-2 flex justify-center rounded-lg border border-dashed border-gray-900/25 px-6 py-10">
                    <div class="text-center">
                    <svg class="mx-auto size-12 text-gray-300" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true" data-slot="icon">
                        <path fill-rule="evenodd" d="M1.5 6a2.25 2.25 0 0 1 2.25-2.25h16.5A2.25 2.25 0 0 1 22.5 6v12a2.25 2.25 0 0 1-2.25 2.25H3.75A2.25 2.25 0 0 1 1.5 18V6ZM3 16.06V18c0 .414.336.75.75.75h16.5A.75.75 0 0 0 21 18v-1.94l-2.69-2.689a1.5 1.5 0 0 0-2.12 0l-.88.879.97.97a.75.75 0 1 1-1.06 1.06l-5.16-5.159a1.5 1.5 0 0 0-2.12 0L3 16.061Zm10.125-7.81a1.125 1.125 0 1 1 2.25 0 1.125 1.125 0 0 1-2.25 0Z" clip-rule="evenodd" />
                    </svg>
                    <div class="mt-4 flex text-sm/6 text-gray-600">
                        <label for="file-upload" class="relative cursor-pointer rounded-md bg-white font-semibold text-indigo-600 focus-within:ring-2 focus-within:ring-indigo-600 focus-within:ring-offset-2 focus-within:outline-hidden hover:text-indigo-500">
                        <span>Upload a file</span>
                        <input id="file-upload" name="file-upload" type="file" class="sr-only" />
                        </label>
                        <p class="pl-1">or drag and drop</p>
                    </div>
                    <p class="text-xs/5 text-gray-600">PNG, JPG, GIF up to 10MB</p>
                    </div>
                </div>
                </div>
            </div>
            <br>
            @if($errors->any())
                <div class="text-red-500 text-sm/6">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>



        <div class="mt-6 flex items-center justify-end gap-x-6">
            <button type="button" class="text-sm/6 font-semibold text-gray-900">Cancel</button>
            <button type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Update</button>
        </div>
    </form>