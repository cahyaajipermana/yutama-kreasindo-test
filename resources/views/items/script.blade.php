<script type="text/javascript">
    $(document).ready(function() {
        let columns = [{
                data: 'id',
                name: 'id',
                className: 'text-center'
            },
            {
                data: 'category_name',
                name: 'category_name'
            },
            {
                data: 'code_item',
                name: 'code_item'
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
                data: 'user_name',
                name: 'user_name'
            },
            {
                data: 'updated_at',
                name: 'updated_at',
                render: function (data, type, row, meta) {
                    if (data == "" || data == null) return ""
                    return moment(data).format('YYYY-MM-DD HH:mm:ss')
                }
            },
            {
                data: 'action',
                name: 'action',
                className: 'text-center',
                orderable: false,
                searchable: false
            },
        ]

        const search = {
            search_field: '',
            search_value: ''
        }

        // init data table
        setDataTable(".data-table", "{{ route('items.index') }}", search, columns, {
            order: [0, 'asc']
        })

        let searchTimeout = null
        $(document).on("keyup change", ".search-by", function(){
            if (searchTimeout) clearTimeout(searchTimeout)
            searchTimeout = setTimeout(() => {
                search.search_field = $(this).attr('data-field')
                search.search_value = $(this).val()
                setDataTable(".data-table", "{{ route('items.index') }}", search, columns, {
                    order: [0, 'asc']
                })
            }, 500)
        })

        $(document).on("click", ".btn-tambah", function(){
            getCodeItem()
        })

        $(document).on("submit", "#form-create", function(e){
            e.preventDefault();

            let categoryId = $("#category_id").val();
            if(!categoryId){
                $.toast({
                    heading: 'Gagal',
                    text: 'Please select the Category!',
                    position: 'top-right',
                    loaderBg: '#fff',
                    icon: 'warning',
                    hideAfter: 3500,
                    stack: 6
                });

                return false;
            }

            let itemName = $("#item_name").val();
            if(!itemName){
                $.toast({
                    heading: 'Gagal',
                    text: 'Please fill in the Item Name!',
                    position: 'top-right',
                    loaderBg: '#fff',
                    icon: 'warning',
                    hideAfter: 3500,
                    stack: 6
                });

                return false;
            }

            let codeItem = $("#code_item").val();
            if(!codeItem){
                $.toast({
                    heading: 'Gagal',
                    text: 'Please fill in the Code Item!',
                    position: 'top-right',
                    loaderBg: '#fff',
                    icon: 'warning',
                    hideAfter: 3500,
                    stack: 6
                });

                return false;
            }

            let formData = {
                item_name: $("#item_name").val(),
                code_item: $("#code_item").val(),
                category_id: $("#category_id").val(),
            }
            let storeRoute = "{{ route('items.store') }}";
            storeData(storeRoute, formData);
        });

        $(document).on("submit", "#form-create-category", function(e){
            e.preventDefault();

            let formData = {
                name: $("#category_name").val(),
            }
            let storeRoute = "{{ route('item-category.store') }}";
            storeData(storeRoute, formData);
        });

        $(document).on("click", ".btn-edit", function(){
            $("#item_name_edit").val("");
            $("#code_item_edit").val("");
            $("#category_id_edit").val("");

            let url = "{{ route('items.edit', 'data-id') }}";
            id = $(this).attr("data-id");
            url = url.replace("data-id", id);

            $.ajax({
                url: url,
                success: function(res){
                    let data = res.data
                    $("#item_name_edit").val(data.item_name);
                    $("#code_item_edit").val(data.code_item);
                    $("#category_id_edit").val(data.category_id);
                },
                error: function(res){
                    $.toast({
                        heading: 'Gagal',
                        text: 'Gagal menampilkan data!',
                        position: 'top-right',
                        loaderBg: '#fff',
                        icon: 'warning',
                        hideAfter: 3500,
                        stack: 6
                    })
                }
            });
        });

        $(document).on("submit", "#form-edit", function(e){
            e.preventDefault();
            let formData = {
                _method: 'PUT',
                item_name: $("#item_name_edit").val(),
                category_id: $("#category_id_edit").val(),
            }
            let route = "{{ route('items.update', 'data-id') }}";
            route = route.replace("data-id", id);
            updateData(route, formData);
        });

        $(document).on("click", ".btn-delete", function(){
            let name = $(this).attr("data-name");
            $("#data-hapus").html(name);
            id = $(this).attr("data-id");
        });

        $(document).on("submit", "#form-hapus", function(e){
            e.preventDefault();
            let route = "{{ route('items.destroy', 'data-id') }}";
            route = route.replace("data-id", id);
            deleteData(route);
        });
        
    });

    function getCodeItem() {
        $.ajax({
            url: "{{ route('items.get-code-item') }}",
            success: function (res) {
                $("#code_item").val(res.data)
            },
            error: function (err) {
                console.log(err)
            }
        })
    }
</script>