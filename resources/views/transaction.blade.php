<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Items') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <button command="show-modal" commandfor="dialog" data-item-action="add" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 mr-2 rounded mb-3">Add Transaction</button>
            <!-- <button command="show-modal" commandfor="dialog" data-item-action="add" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 mr-2 rounded mb-3">Add Outgoing Stock</button> -->


            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <table id="transaction-table" class="display">

                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Item</th>
                                <th>Qty</th>
                                <th>Created At</th>
                                <th>Created By</th>
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

                        <form id="item-form">
                            @csrf

                            <div class="space-y-12">
                                <div class="border-b border-gray-900/10 pb-12">

                                    <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                                        <div class="sm:col-span-6">
                                            <label for="item-name" class="block text-sm/6 font-medium text-gray-900">Item name</label>
                                            <div class="mt-2">
                                                <select id="item-name" name="item" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                                                    <option value="">Select Item</option>
                                                    @foreach ($items as $item)
                                                    <option value="{{ $item->id }}">{{ $item->item_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="sm:col-span-6">
                                            <label for="transaction-type" class="block text-sm/6 font-medium text-gray-900">Transaction type</label>
                                            <div class="mt-2">
                                                <select id="transaction-type" name="transaction_type" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                                                    <option value="">Select Transaction Type</option>
                                                    <option value="1">Incoming</option>
                                                    <option value="2">Outgoing</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="sm:col-span-6">
                                            <label for="qty" class="block text-sm/6 font-medium text-gray-900">Qty</label>

                                            <div class="mt-2">
                                                <input id="qty" type="number" name="qty" autocomplete="postal-code" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-6 flex items-center justify-end gap-x-6">
                                <input id="item-id" type="hidden" name="id" />
                                <button command="close" commandfor="dialog" type="button" class="text-sm/6 font-semibold text-gray-900">Cancel</button>

                                <button id="transaction-btn-submit" type="button" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Save</button>

                            </div>
                        </form>
                    </div>
                </el-dialog-panel>
            </div>
        </dialog>
    </el-dialog>

    <script>
        $(function() {
            $('#transaction-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('transactions.data') }}",

                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'item_name',
                        name: 'item_name'
                    },
                    {
                        data: 'qty',
                        name: 'qty'
                    },
                    {
                        data: 'created_at',
                        name: 'created_at'
                    },
                    {
                        data: 'created_by',
                        name: 'created_by'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },

                ]
            });
        });

        $('button[data-item-action="add"]').on('click', function(e) {
            $('#item-form').removeAttr('data-item-action');
            let action = $(this).data('item-action');
            let itemId = $(this).data('item-id');

            $('#item-form')[0].reset();

            $('#item-form').attr('data-item-action', action);
        })

        $('#transaction-table').on('click', 'button[data-item-action="edit"]', function() {
            $('#item-form').removeAttr('data-item-action');
            var itemId = $(this).data('item-id');
            $('#dialog-edit').attr('commandfor', 'dialog-edit-' + itemId);
            $('#item-btn-submit').attr('data-item-action', 'edit');
            $('#item-form').attr('data-item-action', 'edit');
            $('#item-id').val(itemId);

            $.ajax({
                url: "{{ route('items.edit') }}",
                type: 'post',
                data: {
                    _token: '{{ csrf_token() }}',
                    id: itemId
                },
                success: function(data) {
                    // Set nilai input form dengan data item
                    $('#category-name').val(data.category);
                    $('#item-name').val(data.item_name);
                    $('#stock').val(data.stock);
                }
            });
        });

        $('#dialog').on('click', 'button[command="close"]', function() {
            $('#item-form').removeAttr('data-item-action');
        })

        // Form validation
        $('#item-form').on('click', '#transaction-btn-submit', function(e) {
            let isValid = true;
            let errorMessages = [];
            let action = $('#item-form').attr('data-item-action');
            const itemId = $('#item-id').val();

            console.log(action);
            url = action == "add" ? "{{ route('items.store') }}" : "{{ route('items.update') }}";
            console.log(url);

            // Validate item name
            const itemName = $('#item-name').val().trim();
            if (!itemName) {
                isValid = false;
                $('#item-name').addClass('border-red-500 focus:border-red-500 focus:ring-red-500');
                $('#item-name').after('<span class="text-red-500 text-xs">Item harus diisi</span>');

            } else {
                $('#item-name').removeClass('border-red-500 focus:border-red-500 focus:ring-red-500');
            }

            // Validate transaction type
            const transactionType = $('#transaction-type').val().trim();
            if (!transactionType) {
                isValid = false;
                $('#transaction-type').addClass('border-red-500 focus:border-red-500 focus:ring-red-500');
                $('#transaction-type').after('<span class="text-red-500 text-xs">Transaction type harus diisi</span>');

            } else {
                $('#transaction-type').removeClass('border-red-500 focus:border-red-500 focus:ring-red-500');
            }

            // Validate stock
            const qty = $('#qty').val().trim();
            if (!qty) {
                isValid = false;
                errorMessages.push('Stok harus diisi');
                $('#qty').addClass('border-red-500 focus:border-red-500 focus:ring-red-500');
                $('#qty').after('<span class="text-red-500 text-xs">Kuantitas harus diisi</span>');

            } else if (isNaN(qty) || parseInt(qty) < 0) {
                isValid = false;
                $('#qty').addClass('border-red-500 focus:border-red-500 focus:ring-red-500');
                $('#qty').after('<span class="text-red-500 text-xs">Kuantitas harus berupa angka positif</span>');

            } else {
                $('#qty').removeClass('border-red-500 focus:border-red-500 focus:ring-red-500');
                $('#qty').after('');
            }

            // If validation fails, prevent form submission and show errors
            if (!isValid) {
                e.preventDefault();

                // Display error messages
                // if (!$('.validation-errors').length) {
                //     const errorHtml = '<div class="validation-errors mt-4 p-3 bg-red-100 text-red-700 rounded"><ul>' +
                //         errorMessages.map(msg => '<li>' + msg + '</li>').join('') +
                //         '</ul></div>';
                //     $('form[action="{{ route("items.store") }}"]').prepend(errorHtml);
                // } else {
                //     $('.validation-errors ul').html(errorMessages.map(msg => '<li>' + msg + '</li>').join(''));
                // }
            } else {
                // Remove error messages if validation passes
                // $('.validation-errors').remove();

                $.ajax({
                    url: "{{ route('transactions.store') }}",
                    type: 'post',
                    data: {
                        _token: '{{ csrf_token() }}',
                        item_id: itemName,
                        transaction_type: transactionType,
                        qty: qty,
                    },
                    success: function(data) {
                        if (data.error) {
                            return alert(data.error);
                        }

                        // Refresh tabel setelah berhasil menambah
                        $('#transaction-table').DataTable().ajax.reload();
                        $('#item-form').removeAttr('data-item-action');
                        $('#item-form')[0].reset();

                        // Tutup dialog add
                        const dialog = document.getElementById("dialog");
                        dialog.close();
                    }
                });
            }
        });
    </script>

</x-app-layout>