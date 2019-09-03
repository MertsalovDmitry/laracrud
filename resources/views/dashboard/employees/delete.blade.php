<!-- delete employee /.modal -->  
<div class="modal fade" id="delete-employee-modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">Remove employee</h4>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to remove employee <span id="delete-employee-name"></span> ?</p>
            </div>
            <div class="modal-footer">
                <div class="row">
                    <div class="col-xs-offset-8 col-xs-2">
                        <button type="button" class="btn btn-warning" data-dismiss="modal">Cancel</button>
                    </div>
                    <div class="col-xs-2">
                        <button type="button" id="confirm-delete-employee" class="btn btn-success">Remove</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal --> 