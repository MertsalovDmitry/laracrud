<!-- delete employee /.modal -->  
<div class="modal fade" id="delete-position-modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">Remove position</h4>
            </div>
            <div class="form-group modal-body">
                <p>Are you sure you want to remove position - <span id="delete-position-name"></span> ?</p>
                <div class="form-group-delete">               
                  <span class="help-block help-block-delete"></span>
                </div>
              </div>
            <div class="modal-footer">
              <div class="row">
                <div class="col-xs-offset-8 col-xs-2">
                  <button type="button" class="btn btn-warning" data-dismiss="modal">Cancel</button>
                </div>
                <div class="col-xs-2">
                  <button type="button" id="confirm-delete-position" class="btn btn-success">Remove</button>
                </div>
              </div>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal --> 