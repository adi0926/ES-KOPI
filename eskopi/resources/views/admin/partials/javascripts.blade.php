<script src="{{ asset('global/js/jquery-3.7.1.min.js') }}"></script>
<script src="{{ asset('backend/js/popper.min.js') }}"></script>
<script src="{{ asset('backend/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('backend/js/jquery.nicescroll.min.js') }}"></script>
<script src="{{ asset('backend/js/moment.min.js') }}"></script>
<script src="{{ asset('backend/js/stisla.js') }}"></script>
<script src="{{ asset('backend/js/scripts.js') }}"></script>
<script src="{{ asset('backend/js/select2.min.js') }}"></script>
<script src="{{ asset('backend/js/tagify.js') }}"></script>
<script src="{{ asset('global/toastr/toastr.min.js') }}"></script>
<script src="{{ asset('backend/js/bootstrap4-toggle.min.js') }}"></script>
<script src="{{ asset('backend/js/fontawesome-iconpicker.min.js') }}"></script>
<script src="{{ asset('backend/js/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('backend/clockpicker/dist/bootstrap-clockpicker.js') }}"></script>
<script src="{{ asset('backend/datetimepicker/jquery.datetimepicker.js') }}"></script>
<script src="{{ asset('backend/js/iziToast.min.js') }}"></script>
<script src="{{ asset('backend/js/modules-toastr.js') }}"></script>
<script src="{{ asset('backend/tinymce/js/tinymce/tinymce.min.js') }}"></script>
<script src="{{ asset('global/nice-select/jquery.nice-select.min.js') }}"></script>
<script src="{{ asset('backend/js/default/backend.js') }}"></script>
<script src="{{ asset('backend/js/custom.js') }}"></script>
<script src="{{ asset('frontend/js/sweetalert.js') }}"></script>

<!-- File Manager js-->
<script src="{{ url('/vendor/laravel-filemanager/js/stand-alone-button.js') }}"></script>

<script>
    $('.file-manager').filemanager('file', {prefix: '{{ url("/laravel-filemanager") }}'});
    $('.file-manager-image').filemanager('image', {prefix: '{{ url("/laravel-filemanager") }}'});
</script>

<script>
    @session('messege')
    var type = "{{ Session::get('alert-type', 'info') }}"
    switch (type) {
        case 'info':
            toastr.info("{{ $value }}");
            break;
        case 'success':
            toastr.success("{{ $value }}");
            break;
        case 'warning':
            toastr.warning("{{ $value }}");
            break;
        case 'error':
            toastr.error("{{ $value }}");
            break;
    }
    @endsession

    $('.datepicker').datepicker({
        format: 'yyyy-mm-dd',
        orientation: "bottom auto"
    });
</script>

@if ($errors->any())
    @foreach ($errors->all() as $error)
        <script>
            toastr.error('{{ $error }}');
        </script>
    @endforeach
@endif

<script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/fixedcolumns/5.0.3/js/dataTables.fixedColumns.js"></script>
<script src="https://cdn.datatables.net/fixedcolumns/5.0.3/js/fixedColumns.dataTables.js"></script>
<script src="https://cdn.datatables.net/select/2.1.0/js/dataTables.select.js"></script>
<script src="https://cdn.datatables.net/select/2.1.0/js/select.dataTables.js"></script>

<script>
    new DataTable('#tableMaster', {
        columnDefs: [
            {
                orderable: false,
                render: DataTable.render.select(),
                targets: 0
            }
        ],
        fixedColumns: {
            start: 2
        },
        order: [[1, 'asc']],
        paging: true,
        pageLength: 10,
        scrollCollapse: true,
        scrollX: true,
        scrollY: true,
        select: {
            style: 'os',
            selector: 'td:first-child'
        }
    });
    
    new DataTable('#tableAngkatan', {
        columnDefs: [
            {
                orderable: false,
                render: DataTable.render.select(),
                targets: 0
            }
        ],
        fixedColumns: {
            start: 2
        },
        order: [[1, 'asc']],
        paging: true,
        pageLength: 10,
        scrollCollapse: true,
        scrollX: true,
        scrollY: true,
        select: {
            style: 'os',
            selector: 'td:first-child'
        }
    });
    
    new DataTable('#tableMataDiklat', {
        columnDefs: [
            {
                orderable: false,
                render: DataTable.render.select(),
                targets: 0
            }
        ],
        fixedColumns: {
            start: 2
        },
        order: [[1, 'asc']],
        paging: true,
        pageLength: 10, 
        scrollCollapse: true,
        scrollX: true,
        scrollY: true,
        select: {
            style: 'os',
            selector: 'td:first-child'
        }
    });
    
    new DataTable('#tableListKonten', {
            columnDefs: [
                {
                    orderable: false,
                    render: DataTable.render.select(),
                    targets: 0
                }
            ],
            fixedColumns: {
                start: 2
            },
            order: [[1, 'asc']],
            paging: false, 
            scrollCollapse: true,
            scrollX: true,
            scrollY: true,
            select: {
                style: 'os',
                selector: 'td:first-child'
            }
        });
</script>