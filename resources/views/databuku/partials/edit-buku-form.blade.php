<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Data Buku') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <form method="POST" action="{{ route('databuku.update', $book->id) }}" enctype="multipart/form-data"
                        class="mx-auto">
                        @csrf
                        @method('PUT')
                        <div class="mb-5">
                            <label for="judul"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Judul buku</label>
                            <input type="text" id="judul" name="judul" value="{{ $book->judul }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                required>
                        </div>
                        <div class="mb-5">
                            <label for="kategori"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kategori
                                Buku</label>
                            <select id="kategori" name="kategori"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                @foreach ($categories as $category)
                                    <option value="{{ $category->kategori }}"
                                        {{ $book->kategori == $category->kategori ? 'selected' : '' }}>
                                        {{ $category->kategori }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-5">
                            <label for="deskripsi"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Deskripsi
                                Buku</label>
                            <input type="text" id="deskripsi" name="deskripsi" value="{{ $book->deskripsi }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                required>
                        </div>
                        <div class="mb-5">
                            <label for="jumlah"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jumlah Buku</label>
                            <input type="text" id="jumlah" name="jumlah" value="{{ $book->jumlah }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                required>
                        </div>
                        <div class="mb-5 max-w-lg mx-auto">
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                for="file_buku">Upload file buku</label>
                            <input
                                class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                aria-describedby="file_buku_help" id="file_buku" name="file_buku" type="file">
                            <div class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="file_buku_help">
                                File harus menggunakan format yang sesuai (PDF) *lewati langkah ini jika tidak ingin mengubah file</div>
                        </div>
                        <div class="mb-5 max-w-lg mx-auto">
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                for="cover_buku">Upload cover buku</label>
                            <input
                                class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                aria-describedby="cover_buku_help" id="cover_buku" name="cover_buku" type="file">
                            <div class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="cover_buku_help">
                                Cover harus menggunakan format yang sesuai dengan ukuran maks 2mb (jpeg/jpg/png) *lewati langkah ini jika tidak ingin mengubah cover</div>
                        </div>
                        <button type="submit"
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
