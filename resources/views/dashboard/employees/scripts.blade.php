<!-- Typeahead -->
<script src="{{ asset('public\js\bootstrap3-typeahead.min.js') }}"></script>

<!-- momentjs -->
<script src="{{ asset('public\js\moment.min.js') }}"></script>

<!-- InputMask -->
<script src="{{ asset('public\js\jquery.inputmask.bundle.min.js') }}"></script>

<!-- Date-picker -->
<script src="{{ asset('public\js\bootstrap-datepicker.min.js') }}"></script>

<script>
    $(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        /* Initialize jquery inputmask for #phone input - create edit */    
        $('#phone').inputmask('+380 (99) 999 99 99')
        /* Initialize jquery inputmask for .phone-number - table */
        $('.phone-number').inputmask('+380 (99) 999 99 99')

        /* Initialize bootstrap datepicker for #employed_at input */
        let $employed_at = $('#employed_at').datepicker({
            autoclose: true,
            format: "dd.mm.yy",
        });

        /* Initialize Jquery DataTables for employees */
        let table = $('#employees-table').DataTable({
            processing: true,
            language: {
                processing: '<span>Processing</span>',
            },
            serverSide: true,
            ajax: "{{ route('employees.index') }}",
            columnDefs: [
                {
                    targets: [ 0 ],
                    visible: false,
                    searchable: false
                },
                {
                    targets: [ 1 ],
                    visible: false,
                    searchable: false
                }
            ],
            columns: [
                { data: 'id', name: 'id', searchable: false },
                { data: 'created_at', name: 'created_at', searchable: false },
                { data: 'photo', name: 'photo', orderable: false, searchable: false,
                    render: function (photo){  
                        return '<img class="img-circle" style="width:40px;height:auto;" src="' + 'public/img/photo/' + photo + '">';
                    },
                },
                { data: 'name', name: 'name' },
                { data: 'position', name: 'position', orderable: false, searchable:true,
                    render: function (position){
                        if (position){ return position.name; }
                        else { return ''; }
                    },
                },
                { data: 'employed_at', name: 'employed_at',
                    render: function (employed_at) {
                        return moment(employed_at).format("DD.MM.YY");
                    }
                },
                { data: 'phone', name: 'phone',
                    render: function ( toFormat ) {   
                        return viewPhonenumber(toFormat);
                    }
                },
                { data: 'email', name: 'email' },
                { data: 'salary', name: 'salary',
                    render: function (salary){  
                        return '$' + salary;
                    }, 
                },
                { data: 'action', name: 'action', orderable: false, searchable: false },
            ]
        });

        /* Initialize bootstrap-3-typeahead for #head input */
        let $head = $('input.typeahead').typeahead({
            source:  function (query, process) {
                return $.get("{{ route('employees.autocomplete') }}", { query: query }, function (data) {
                    return process(data);
                });
            },
        });

        /* Initialize select2 for positions.list */
        let $select2Position = $('.select2').select2({
            placeholder: 'Select an item',
            ajax: {
                url:  "{{ route('positions.list') }}",
                dataType: 'json',
                delay: 250,
                processResults: function (data) {
                    return {
                        results:  $.map(data, function (item) {
                            return {
                                text: item.name,
                                id: item.id
                            }
                        })
                    };
                },
                cache: true,
                minimumInputLength: 1,
            }
        });

        /* Bind #name input events to show length of name input */
        $("#name").bind("change paste keyup input", function() {
            str = $("#name").val().length + ' / 256';
            $("#name-length").text(str);
        });

        /* When user click add employee button */
        $('#create-new-employee').click(function () {
            $('#btn-save').val("store").text("Save");
            $('#employee_id').val('');
            $('#employeeForm').trigger("reset");
            $('#employeeCrudModal').html("Add New Employee");
            $('#employees-modal').modal('show');
            $("#name-length").text('0 / 256');
            $select2Position.val(null).trigger("change");
            $employed_at.val("").datepicker("update");
            $('#parent_id').val("");
            $('#hidden_parent_id').val("");
            $('#adminCreated').hide();
            $('#adminUpdated').hide();
            $('#employee-image').hide();

            clearErrors();
        });
      
        /* When click edit employee */
        $('body').on('click', '.edit', function () {  
            let employee_id = $(this).data('id');
            $.get('employees/' + employee_id +'/edit', function (data) {
                $('#employeeCrudModal').html("Edit employee");
                $('#btn-save').val("update").text("Edit");
                $('#employees-modal').modal('show');
                clearErrors(); 
                $('#employee_id').val(data.id);
                $('#name').val(data.name);
                $('#email').val(data.email);
                $('#phone').val(data.phone);
                if (data.position){
                    let newOption = new Option(data.position.name, data.position.id, false, true);
                    $select2Position.append(newOption).trigger('change');
                }
                else { $select2Position.val(null).trigger("change"); }
                $('#salary').val(data.salary);
                $employed_at.datepicker('update', new Date(data.employed_at));
                $('#employee-image').attr('src', 'public/img/photo/' + data.photo);
                $('#parent_id').val(data.head.name);
                $('#hidden_parent_id').val(data.head.id);
                $('#adminCreatedAt').text(moment(data.created_at).format("DD.MM.YY"));
                $('#adminCreatedID').text(data.admin_created.id); 
                $('#adminUpdatedAt').text(moment(data.updated_at).format("DD.MM.YY"));
                $('#adminUpdatedID').text(data.admin_updated.id);
                $('#adminCreated').show();
                $('#adminUpdated').show();
                $('#employee-image').show();                                   
            })
        });

        /* Add click event from #upload-employee-image to #input-photo */
        $('#upload-employee-image').click(function (e){  
            $('#input-photo').trigger('click'); 
        });

        /* Read image url and show image in #employee-image when image selected in input type file*/
        function readURL(input) {
            if (input.files && input.files[0]) {  
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#employee-image').attr('src', e.target.result).show();
                };
            reader.readAsDataURL(input.files[0]);
            }
        }

        /* Read new image url when url changed*/
        $("#input-photo").change(function(){
            readURL(this);
        });

        /* When click delete employee button*/
        $('body').on('click', '.delete', function () {
            let employee_id = $(this).data("id");
            $.get('employees/' + employee_id +'/edit', function (data) {
                $('#delete-employee-name').text(data.name);
                $('#delete-employee-modal').modal('show');
                $('#delete-employee-modal').on('click', '#confirm-delete-employee', function () {
                    $.ajax({
                        /* type: "delete", */
                        type: 'POST',
                        data: {_method: 'delete'},
                        url: "/employees/" + employee_id,
                        success: function (data) {
                            table.draw(false);
                            $('#delete-employee-modal').modal('hide');                   
                        }
                    });
                });
            })
        }); 

        /* When click btn-save button */
        $('#btn-save').click(function (e) {
            e.preventDefault();
            phone = $('#phone').val();
            phone = phone.replace(/[^\d]/g, '');
            let dateEmployedAt = moment($("#employed_at").datepicker('getDate')).format("YYYY-MM-DD");
            let currentParent = $head.typeahead("getActive");
            let parentID;
            if (currentParent){ parentID = currentParent.id; }
            else { parentID = $('#hidden_parent_id').val(); }
            let posID = $("#position-select").val();           
            $(this).html('Sending..');   
            let state = $('#btn-save').val() 
            let my_url = "employees"
            let id = $('#employee_id').val()    
            let mtype = "POST"
            let fd = new FormData()
            let method = "POST"
            if (state == "update"){
                my_url += '/' + id
                // mtype = 'PUT'
                method = "PUT"
                fd.append(_method, method);
            } 
            let $input = $("#input-photo")
            
            if ($input.prop('files')[0]){
                fd.append('photo', $input.prop('files')[0]);
            }
            fd.append('phone', phone);
            fd.append('email', $('#email').val());
            fd.append('salary', $('#salary').val());
            fd.append('employed_at', dateEmployedAt);
            fd.append('parent_id', parentID);
            fd.append('position_id', posID);
            fd.append('name', $('#name').val());
            $.ajax({
                processData: false,
                contentType: false,
                data: fd,
                url: my_url,
                type: mtype,
                dataType: 'json',
                success: function (data) {
                    $('#employeeForm').trigger("reset")
                    $('#employees-modal').modal('hide')
                    table.draw();
                },
                error: function (data) {
                    $('#btn-save').html('Save Changes');
                    clearErrors();
                    jQuery.each(data.responseJSON.errors, function (key, value) {
                        $('.form-group-' + key).addClass('has-error')
                        $('.fa-label-'+ key).addClass('fa-times-circle-o')
                        $('.help-block-'+ key).text(value)
                    });
                }
            });
        });

        /* Clear validation errors function */
        let clearErrors = function(){
            $('.form-group').removeClass('has-error');
            $('.fa').removeClass('fa-times-circle-o');
            $('.help-block-text').text('');
        };

        /* view format of PhoneNumber of employee in table*/
        let viewPhonenumber = function(phone){
            number = phone.toString();            
            number = '+' + number.substring(0,3) + 
                     ' (' + number.substring(3,5) + ') ' + 
                     number.substring(5,8) + ' ' + 
                     number.substring(8,10) + ' ' + 
                     number.substring(10,12);
            return number;
        }; 
    });
</script>