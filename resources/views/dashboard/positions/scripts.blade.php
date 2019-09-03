<!-- momentjs -->
<script src="{{ asset('public\js\moment.min.js') }}"></script>

<script>
$(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    /* Initialize Jquery DataTables for positions */
    let table = $('#positions-table').DataTable({
        processing: true,
        language: { processing: '<span>Processing</span>', },
        serverSide: true,
        ajax: '{{ route('positions.index') }}',
        columnDefs: [ { targets: [0], visible: false, searchable: false } ],
        columns: [
            { data: 'id', name: 'id', searchable: false },
            { data: 'name',  name: 'name' },
            { data: 'updated_at', name: 'updated_at', searchable: false, 
                render: function (updated_at) {
                    return moment(updated_at).format("DD.MM.YY");
                },
            },
            { data: 'action', name: 'action', orderable: false, searchable: false },
        ]
    });

    /* Bind #name input events to show length of name input */
    $("#name").bind("change paste keyup input", function() {
        str = $("#name").val().length + ' / 256';
        $("#name-length").text(str);
    });

    /* When user click add position button */
    $('#create-new-position').click(function () {
        $('#btn-save').val("store").text("Save");
        $('#position_id').val('');
        $('#positionForm').trigger("reset");
        $('#positionCrudModal').html("Add New Position");
        $('#positions-modal').modal('show');
        $("#name-length").text('0 / 256');
        $('#adminCreated').hide();
        $('#adminUpdated').hide();
        $('.form-group-name').removeClass('has-error').removeClass('has-success');
        $('.fa-label-name').removeClass('fa-times-circle-o').removeClass('fa-check');
        $('.help-block-name').text('');    
    });
         
    /* When click edit position */
    $('body').on('click', '.edit', function () {  
        let position_id = $(this).data('id');            
        $.get('positions/' + position_id +'/edit', function (data) {
            $('#name-error').hide();
            $('#positionCrudModal').html("Edit position");
            $('#btn-save').val("edit").text("Save");
            $('#positions-modal').modal('show');
            $('#position_id').val(data.id);
            $('#name').val(data.name).change();
            $('#adminCreated').show();
            $('#adminUpdated').show();
            $('#admin_created_at').text(moment(data.created_at).format("DD.MM.YY"));
            $('#admin_created_id').text(data.admin_created_id); 
            $('#admin_updated_at').text(moment(data.updated_at).format("DD.MM.YY"));
            $('#admin_updated_id').text(data.admin_updated_id); 
            $('#btn-save').val("update").text("Save");
            $('.form-group-name').removeClass('has-error').removeClass('has-success');
            $('.fa-label-name').removeClass('fa-times-circle-o').removeClass('fa-check');
            $('.help-block-name').text('');                   
        })
    });

    /* When click delete position button*/
    $('body').on('click', '.delete', function () {
        let position_id = $(this).data("id");
        $('#delete-position-modal').modal('show');
        $('.form-group-delete').removeClass('has-error');
        $('.help-block-delete').text('');
        $.get('positions/' + position_id +'/edit', function (data) {
            $('#delete-position-name').text(data.name);          
            $('#delete-position-modal').on('click', '#confirm-delete-position', function () {
                $.ajax({
                    /* type: "delete", */
                    type: 'POST',
                    data: {_method: 'delete'},
                    url: "/positions/" + position_id,
                    success: function (data) {
                        table.draw(false);
                        $('#delete-position-modal').modal('hide');
                    },
                });
            });
        })
    }); 

    /* When click btn-save button */
    $('#btn-save').click(function (e) {
        e.preventDefault();
        $(this).html('Sending..')      
        let state = $('#btn-save').val() 
        let my_url = "positions"
        let id = $('#position_id').val()
        let method = "POST"
        if (state == "update"){
            my_url += '/' + id
            method = "PATCH"
        }   
        $.ajax({
            data: {
                name: $('#name').val(),
                _method: method
            },,
            url: my_url,
            type: "POST",
            dataType: 'json',
            success: function (data) {
                if ($.isEmptyObject(data.errors)) {
                    $('.form-group-name').removeClass('has-error').addClass('has-success');
                    $('.fa-label-name').removeClass('fa-times-circle-o').addClass('fa-check');
                    $('.help-block-name').text('');
                    $('#positionForm').trigger("reset");
                    $('#positions-modal').modal('hide');
                    table.draw(); 
                } 
            },
            error: function (data) {
                $('#btn-save').html('Save Changes');
                let errors = data.responseJSON.errors;
                $('.form-group-name').addClass('has-error');
                $('.fa-label-name').addClass('fa-times-circle-o');
                $('.help-block-name').text(errors.name);
            }
        });
    });
});
</script>