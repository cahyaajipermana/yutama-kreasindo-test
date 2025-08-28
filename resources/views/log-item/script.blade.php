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
                data: 'type',
                name: 'type',
                render: function (data, type, row, meta) {
                    if (data == "" || data == null) return ""
                    return data == 'masuk' ? '<span class="badge bg-success">In</span>' : '<span class="badge bg-danger">Out</span>'
                }
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
        ]

        const search = {
            search_field: '',
            search_value: ''
        }

        // init data table
        setDataTable(".data-table", "{{ route('log-item.index') }}", search, columns, {
            order: [4, 'desc']
        })

        let searchTimeout = null
        $(document).on("keyup change", ".search-by", function(){
            if (searchTimeout) clearTimeout(searchTimeout)
            searchTimeout = setTimeout(() => {
                search.search_field = $(this).attr('data-field')
                search.search_value = $(this).val()
                setDataTable(".data-table", "{{ route('log-item.index') }}", search, columns, {
                    order: [4, 'desc']
                })
            }, 500)
        })
    });
</script>