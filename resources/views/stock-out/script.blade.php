<script type="text/javascript">
    $(document).ready(function() {
        let columns = [
            {
                data: 'item_code_item',
                name: 'item_code_item'
            },
            {
                data: 'item_item_name',
                name: 'item_item_name'
            },
            {
                data: 'quantity',
                name: 'quantity'
            },
            {
                data: 'user_name',
                name: 'user_name'
            },
            {
                data: 'created_at',
                name: 'created_at',
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
        setDataTable(".data-table", "{{ route('stock-out.index') }}", search, columns, {
            order: [0, 'asc']
        })

        let searchTimeout = null
        $(document).on("keyup change", ".search-by", function(){
            if (searchTimeout) clearTimeout(searchTimeout)
            searchTimeout = setTimeout(() => {
                search.search_field = $(this).attr('data-field')
                search.search_value = $(this).val()
                setDataTable(".data-table", "{{ route('stock-out.index') }}", search, columns, {
                    order: [0, 'asc']
                })
            }, 500)
        })

        $(document).on("change", "#category_id", function(){
            const val = $(this).val()
            $.ajax({
                url: "{{ route('items.get-item-by-category') }}",
                data: {
                    category_id: val,
                },
                success: function (res) {
                    let items = res.data
                    
                    $("#item_id").html('')
                    let codeItemDropdown = '<option value="">-- Select Code Item --</option>'
                    for (let i in items) {
                        let item = items[i]
                        codeItemDropdown += `<option value="${item.id}">${item.code_item} - ${item.item_name}</option>`
                    }
                    $("#item_id").html(codeItemDropdown)
                },
                error: function (err) {
                    console.log('err', err)
                }
            })
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

            let itemName = $("#item_id").val();
            if(!itemName){
                $.toast({
                    heading: 'Gagal',
                    text: 'Please select the Code Item!',
                    position: 'top-right',
                    loaderBg: '#fff',
                    icon: 'warning',
                    hideAfter: 3500,
                    stack: 6
                });

                return false;
            }

            let formData = {
                item_id: $("#item_id").val(),
                quantity: $("#quantity").val(),
            }
            let storeRoute = "{{ route('stock-out.store') }}";
            storeData(storeRoute, formData);
        });

        $(document).on("click", ".btn-delete", function(){
            let name = $(this).attr("data-name");
            $("#data-hapus").html(name);
            id = $(this).attr("data-id");
        });

        $(document).on("submit", "#form-hapus", function(e){
            e.preventDefault();
            let route = "{{ route('stock-out.destroy', 'data-id') }}";
            route = route.replace("data-id", id);
            deleteData(route);
        });
        
    });
</script>