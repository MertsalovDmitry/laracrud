<div class="modal fade" id="positions-modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="positionCrudModal"></h4>
            </div>
            <div class="modal-body">
                <form id="positionForm" name="positionForm" class="form-horizontal" role="form">
                    <div class="box-body">
                        <input type="hidden" name="position_id" id="position_id">
                        <div class="form-group form-group-name">
                            <label for="name"><i class="fa fa-label-name"></i> Name</label>
                            <input type="text" class="form-control" id="name" placeholder="Enter position name" name="name" maxlength="256" required="">
                            <span class="help-block">
                                <span class="pull-left help-block-name"></span>
                                <span class="pull-right" id="name-length">0 / 256</span>
                            </span>
                        </div>
                        <div class="form-group" id="adminCreated">
                            <div class="row">
                                <div class="col-xs-6">
                                    <label>Created at:</label>
                                    <span id="admin_created_at" class="form-control-static"></span>
                                </div>
                                <div class="col-xs-6">
                                    <label>Admin created ID:</label>
                                    <span id="admin_created_id" class="form-control-static"></span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group" id="adminUpdated">
                            <div class="row">
                                <div class="col-xs-6">
                                    <label>Updates at:</label>
                                    <span id="admin_updated_at"></span>
                                </div>
                                <div class="col-xs-6">
                                    <label>Admin updated ID:</label>
                                    <span id="admin_updated_id"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- /.box-body -->
        <div class="box-footer ">
            <div class="row">
                <div class="col-md-offset-4 col-xs-4">
                    <button type="submit" class="btn btn-block btn-flat btn-warning"  data-dismiss="modal" id="btn-cancel" value="cancel">Cancel</button>
                </div>
                <div class="col-xs-4">
                    <button type="submit" class="btn btn-block btn-flat btn-success" id="btn-save" value="store">Save</button>
                </div>
            </div>
        </div>
        <div class="modal-footer">    
        </div>
    </div>
</div>