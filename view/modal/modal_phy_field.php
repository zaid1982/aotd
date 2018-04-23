<!-- Modal -->
<div class="modal fade" id="modal_phy_field" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog">
        <form class="form-horizontal" id="form_mplf">
            <div class="modal-content">  
                <div class="modal-header bg-color-blueLight txt-color-white">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        &times;
                    </button>
                    <h4 class="modal-title"><i class='fa fa-edit'></i>&nbsp; Customer Category</h4>
                </div>
                <div class="modal-body modal-fixHeight">   
                    <div class="form-group">
                        <label class="col-md-4 control-label"><font color="red">*</font> Laboratory Name</label>
                        <div class="col-md-8">   
                            <input type="text" name="mplf_lab_name" id="mplf_lab_name" class="form-control" disabled=""/>
                        </div>
                    </div> 
                    <div class="form-group">
                        <label class="col-md-4 control-label"><font color="red">*</font> Test Name</label>
                        <div class="col-md-8">   
                            <input type="text" name="mplf_phyTest_name" id="mplf_phyTest_name" class="form-control" disabled=""/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label"><font color="red">*</font> Field Name</label>
                        <div class="col-md-8">   
                            <input type="text" name="mplf_phyField_name" id="mplf_phyField_name" class="form-control"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label"><font color="red">*</font> Status</label>
                        <div class="col-md-8">   
                            <label class="radio radio-inline">
                                <input type="radio" class="radiobox" name="mplf_phyTest_status" value="1">
                                <span>Active</span> 
                            </label>
                            <label class="radio radio-inline">
                                <input type="radio" class="radiobox" name="mplf_phyTest_status" value="41">
                                <span>Hidden</span>  
                            </label>
                        </div>
                    </div> 
                </div>
                <input type="hidden" name="mplf_phyField_id" id="mplf_phyField_id" />
                <input type="hidden" name="mplf_phyTest_id" id="mplf_phyTest_id" />
                <input type="hidden" name="funct" id="mplf_funct" />
                <div class="modal-footer padding-10">
                    <div class="row">
                        <div class="col-md-12">
                            <a hreh="#" class="btn btn-labeled btn-danger pull-left" data-dismiss="modal">
                                <span class="btn-label"><i class="fa fa-mail-reply "></i></span>Exit
                            </a>
                            <button type="button" class="btn btn-labeled btn-success" id="mplf_btn_save">
                                <span class="btn-label"><i class="fa fa-save"></i></span>Save
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>