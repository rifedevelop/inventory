<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Items') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <button command="show-modal" commandfor="dialog" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-3">Add New</button>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <table id="items-table" class="table-auto bg-white">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Category</th>
                                <th>Name</th>
                                <th>Stock</th>
                                <th>Created At</th>
                                <th>Updated At</th>
                                <th>Action</th>


                            </tr>
                        </thead>
                    </table>

                </div>
            </div>
        </div>
    </div>

    <el-dialog>
        <dialog id="dialog" aria-labelledby="dialog-title" class="fixed inset-0 size-auto max-h-none max-w-none overflow-y-auto bg-transparent backdrop:bg-transparent">
            <el-dialog-backdrop class="fixed inset-0 bg-gray-500/75 transition-opacity data-closed:opacity-0 data-enter:duration-300 data-enter:ease-out data-leave:duration-200 data-leave:ease-in"></el-dialog-backdrop>

            <div tabindex="0" class="flex min-h-full items-end justify-center p-4 text-center focus:outline-none sm:items-center sm:p-0">
                <el-dialog-panel class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all data-closed:translate-y-4 data-closed:opacity-0 data-enter:duration-300 data-enter:ease-out data-leave:duration-200 data-leave:ease-in sm:my-8 sm:w-full sm:max-w-lg data-closed:sm:translate-y-0 data-closed:sm:scale-95">
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <h5 class="text-lg font-medium leading-6 text-gray-900">Add New Item</h5>

                        <form action="{{ route('items.store') }}" method="POST">
                            @csrf

                            <div class="space-y-12">
                                <div class="border-b border-gray-900/10 pb-12">
                                    <!-- <h2 class="text-base/7 font-semibold text-gray-900">Personal Information</h2>
                                <p class="mt-1 text-sm/6 text-gray-600">Use a permanent address where you can receive mail.</p> -->

                                    <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                                        <div class="sm:col-span-6">
                                            <label for="category-name" class="block text-sm/6 font-medium text-gray-900">Category name</label>
                                            <div class="mt-2">
                                                <input id="category-name" type="text" name="category" autocomplete="given-name" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
                                            </div>
                                        </div>

                                        <div class="sm:col-span-6">
                                            <label for="item-name" class="block text-sm/6 font-medium text-gray-900">Item name</label>
                                            <div class="mt-2">
                                                <input id="item-name" type="text" name="item_name" autocomplete="given-name" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
                                            </div>
                                        </div>

                                        <div class="sm:col-span-6">
                                            <label for="stock" class="block text-sm/6 font-medium text-gray-900">Stock</label>
                                            <div class="mt-2">
                                                <input id="stock" type="text" name="stock" autocomplete="postal-code" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-6 flex items-center justify-end gap-x-6">
                                <button command="close" commandfor="dialog" type="button" class="text-sm/6 font-semibold text-gray-900">Cancel</button>

                                <button type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Save</button>
                            </div>
                        </form>
                    </div>

                    <!-- <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                        <button type="button" command="close" commandfor="dialog" class="inline-flex w-full justify-center rounded-md bg-red-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-red-500 sm:ml-3 sm:w-auto">Deactivate</button>
                        <button type="button" command="close" commandfor="dialog" class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-xs ring-1 ring-gray-300 ring-inset hover:bg-gray-50 sm:mt-0 sm:w-auto">Cancel</button>
                    </div> -->
                </el-dialog-panel>
            </div>
        </dialog>
    </el-dialog>

    <el-dialog>
        <dialog id="dialog-delete" aria-labelledby="dialog-title" class="fixed inset-0 size-auto max-h-none max-w-none overflow-y-auto bg-transparent backdrop:bg-transparent">
            <el-dialog-backdrop class="fixed inset-0 bg-gray-500/75 transition-opacity data-closed:opacity-0 data-enter:duration-300 data-enter:ease-out data-leave:duration-200 data-leave:ease-in"></el-dialog-backdrop>

            <div tabindex="0" class="flex min-h-full items-end justify-center p-4 text-center focus:outline-none sm:items-center sm:p-0">
                <el-dialog-panel class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all data-closed:translate-y-4 data-closed:opacity-0 data-enter:duration-300 data-enter:ease-out data-leave:duration-200 data-leave:ease-in sm:my-8 sm:w-full sm:max-w-lg data-closed:sm:translate-y-0 data-closed:sm:scale-95">
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <div class="sm:flex sm:items-start">
                            <div class="mx-auto flex size-12 shrink-0 items-center justify-center rounded-full bg-red-100 sm:mx-0 sm:size-10">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" data-slot="icon" aria-hidden="true" class="size-6 text-red-600">
                                    <path d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </div>
                            <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                <h3 id="dialog-title" class="text-base font-semibold text-gray-900">Delete</h3>
                                <div class="mt-2">
                                    <p class="text-sm text-gray-500">Are you sure you want to delete this item?</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                        <button type="button" command="close" commandfor="dialog-delete" class="inline-flex w-full justify-center rounded-md bg-red-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-red-500 sm:ml-3 sm:w-auto">Delete</button>

                        <button type="button" command="close" commandfor="dialog-delete" class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-xs ring-1 ring-gray-300 ring-inset hover:bg-gray-50 sm:mt-0 sm:w-auto">Cancel</button>
                    </div>
                </el-dialog-panel>
            </div>
        </dialog>
    </el-dialog>

    <script>
        $(function() {
            $('#items-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('items.data') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'category',
                        name: 'category'
                    },
                    {
                        data: 'item_name',
                        name: 'item_name'
                    },
                    {
                        data: 'stock',
                        name: 'stock'
                    },
                    {
                        data: 'created_at',
                        name: 'created_at'
                    },
                    {
                        data: 'updated_at',
                        name: 'updated_at'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },

                ]
            });

            // Form validation
            $('form[action="{{ route("items.store") }}"]').on('submit', function(e) {
                let isValid = true;
                let errorMessages = [];

                // Validate category name
                const categoryName = $('#category-name').val().trim();
                if (!categoryName) {
                    isValid = false;
                    errorMessages.push('Kategori harus diisi');
                    $('#category-name').addClass('outline-red-500');
                } else {
                    $('#category-name').removeClass('outline-red-500');
                }

                // Validate item name
                const itemName = $('#item-name').val().trim();
                if (!itemName) {
                    isValid = false;
                    errorMessages.push('Nama item harus diisi');
                    $('#item-name').addClass('outline-red-500');
                } else {
                    $('#item-name').removeClass('outline-red-500');
                }

                // Validate stock
                const stock = $('#stock').val().trim();
                if (!stock) {
                    isValid = false;
                    errorMessages.push('Stok harus diisi');
                    $('#stock').addClass('outline-red-500');
                } else if (isNaN(stock) || parseInt(stock) < 0) {
                    isValid = false;
                    errorMessages.push('Stok harus berupa angka positif');
                    $('#stock').addClass('outline-red-500');
                } else {
                    $('#stock').removeClass('outline-red-500');
                }

                // If validation fails, prevent form submission and show errors
                if (!isValid) {
                    e.preventDefault();

                    // Display error messages
                    if (!$('.validation-errors').length) {
                        const errorHtml = '<div class="validation-errors mt-4 p-3 bg-red-100 text-red-700 rounded"><ul>' +
                            errorMessages.map(msg => '<li>' + msg + '</li>').join('') +
                            '</ul></div>';
                        $('form[action="{{ route("items.store") }}"]').prepend(errorHtml);
                    } else {
                        $('.validation-errors ul').html(errorMessages.map(msg => '<li>' + msg + '</li>').join(''));
                    }
                } else {
                    // Remove error messages if validation passes
                    $('.validation-errors').remove();
                }
            });
        });

        $('#items-table').on('click', 'button[data-item-id]', function() {
            var itemId = $(this).data('item-id');
            $('#dialog-delete').attr('commandfor', 'dialog-delete-' + itemId);
        });

        $('#items-table').on('click', 'button[data-item-id="edit"]', function() {
            var itemId = $(this).data('item-id');
            $('#dialog-edit').attr('commandfor', 'dialog-edit-' + itemId);
        });
    </script>

</x-app-layout>