<div class="modal fade" id="employees-modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="employeeCrudModal"></h4>
            </div>
            <div class="modal-body">
                <form id="employeeForm" name="employeeForm" class="form-horizontal" role="form" enctype="multipart/form-data">
                    <div class="box-body">
                        <input type="hidden" name="employee_id" id="employee_id">
                        <input type="hidden" name="position_id" id="position_id">
                        <input type="hidden" name="hidden_parent_id" id="hidden_parent_id">
                        <div class="form-group form-group-photo">
                            <div class="row">
                                <div class="col-xs-12">
                                    <label><i class="fa fa-label-photo"></i> Photo</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12">
                                    <img src="" id="employee-image" alt="Employee Image">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12">
                                    <input type="file" class="form-control" id="input-photo" style="display: none;">
                                    <a href="javascript:void(0)" class="btn btn-primary btn-flat btn-sm" id="upload-employee-image">Upload Photo</a>
                                    <span class="help-block">File format jpg,png up to 5MB, the minimum size of 300x300px</span>
                                    <span class="help-block help-block-photo  help-block-text"></span>
                                </div>
                            </div>       
                        </div>
                        <div class="form-group form-group-name">
                            <label for="name"><i class="fa fa-label-name"></i> Name</label>
                            <input type="text" class="form-control" id="name" placeholder="Enter Name" name="name" value="" maxlength="256" required="">
                            <span class="help-block">
                                <span class="pull-left help-block-name help-block-text"></span>
                                <span class="pull-right" id="name-length">0 / 256</span>
                            </span>
                        </div>
                        <div class="form-group form-group-phone"> 
                            <label for="phone"><i class="fa fa-label-phone"></i> Phone</label>
                            <input type="text" class="form-control" id="phone" placeholder="Enter Phone" name="phone" value="" required="">
                            <span class="help-block">
                                <span class="pull-left help-block-phone help-block-text"></span>
                                <span class="pull-right" id="phone-format">Required format +380 (xx) XXX XX XX</span>
                            </span>
                        </div>
                        <div class="form-group form-group-email">
                            <label for="email"><i class="fa fa-label-email"></i> Email</label>
                            <input type="email" class="form-control" id="email" placeholder="Enter Email" name="email" value="" maxlength="256" required="">
                            <span class="help-block help-block-email help-block-text"></span>
                        </div>
                        <div class="form-group form-group-position_id">
                            <label for="position-select"><i class="fa fa-label-position_id"></i> Position</label>
                            <select id="position-select" name="position_id" class="form-control select2" style="width: 100%;"></select>
                            <span class="help-block help-block-position_id help-block-text"></span>
                        </div>
                        <div class="form-group form-group-salary">
                            <label for="salary"><i class="fa fa-label-salary"></i> Salary</label>
                            <input type="number" min="0.000" max="500.000" step="0.001" class="form-control" id="salary" placeholder="Enter Salary" name="salary" value="" maxlength="10" required="">
                            <span class="help-block help-block-salary help-block-text"></span>
                        </div>
                        <div class="form-group form-group-parent_id">
                            <label for="parent_id"><i class="fa fa-label-parent_id"></i> Head</label>
                            <input type="text" class="typeahead form-control" id="parent_id" placeholder="Enter Head" name="parent_id" value="" maxlength="256" required="" data-provide="typeahead">
                            <span class="help-block help-block-parent_id help-block-text"></span>
                        </div>
                        <div class="form-group form-group-employed_at">
                            <label for="employed_at">
                                <i class="fa fa-label-employed_at"></i> Date of employment
                            </label>
                            <input type="text" 
                                   class="form-control" 
                                   id="employed_at" 
                                   placeholder="Enter Date of employment" 
                                   name="employed_at" 
                                   maxlength="250" 
                                   required="" >
                            <span class="help-block help-block-employed_at help-block-text"></span>
                        </div>
                        <div class="form-group" id="adminCreated">
                            <div class="row">
                                <div class="col-xs-6">
                                    <label>Created at:</label>
                                    <span id="adminCreatedAt" class="form-control-static"></span>
                                </div>
                                <div class="col-xs-6">
                                    <label>Admin created ID:</label>
                                    <span id="adminCreatedID" class="form-control-static"></span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group" id="adminUpdated">
                            <div class="row">
                                <div class="col-xs-6">
                                    <label>Updates at:</label>
                                    <span id="adminUpdatedAt"></span>
                                </div>
                                <div class="col-xs-6">
                                    <label>Admin updated ID:</label>
                                    <span id="adminUpdatedID"></span>
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
                    <button type="submit" class="btn btn-block btn-flat btn-success" id="btn-save" value="create">Save</button>
                </div>
            </div>
        </div>
        <div class="modal-footer">    
        </div>
    </div>
</div>