<!-- Modal -->
<div class="modal fade" id="modal_email_noti" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-lg">
        <form class="form-horizontal" id="form_mmc">
            <div class="modal-content">  
                <div class="modal-header bg-color-blueLight txt-color-white">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        &times;
                    </button>
                    <h4 class="modal-title"><i class='fa fa-envelope-o'></i>&nbsp; Email Notification</h4>
                </div>
                <div class="modal-body modal-fixHeight">   
                    <div class="form-group">
                        <label class="col-md-3 control-label">Email Type</label>
                        <div class="col-md-9 control-label text-align-left">   
                            <strong><span id="lmmc_emailType_desc"></span></strong>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label"><font color="red">*</font> Email Title</label>
                        <div class="col-md-9">   
                            <input type="text" name="mmc_emailType_title" id="mmc_emailType_title" class="form-control"/>
                        </div>
                    </div>
                    <div class="form-group margin-bottom-5">
                        <label class="col-md-3 control-label"><font color="red">*</font> Email Text</label>
                        <div class="col-md-9">   
                            <textarea class="form-control" name="mmc_snote_emailType_text" id="mmc_snote_emailType_text" rows="6"></textarea>
                            <input type="hidden" name="mmc_emailType_text" id="mmc_emailType_text" />
                        </div>
                    </div> 
                    <div class="form-group">
                        <label class="col-md-3 control-label"><font color="red">*</font> Status</label>
                        <div class="col-md-9">   
                            <label class="radio radio-inline">
                                <input type="radio" class="radiobox" name="mmc_emailType_status" value="1">
                                <span>Active</span> 
                            </label>
                            <label class="radio radio-inline">
                                <input type="radio" class="radiobox" name="mmc_emailType_status" value="0">
                                <span>Inactive</span>  
                            </label>
                        </div>
                    </div>
                </div>
                <input type="hidden" name="mmc_emailType_id" id="mmc_emailType_id" />
                <input type="hidden" name="funct" id="mmc_funct" value="update_email_noti" />
                <div class="modal-footer padding-10">
                    <div class="row">
                        <div class="col-md-12">
                            <a hreh="#" class="btn btn-labeled btn-danger pull-left" data-dismiss="modal">
                                <span class="btn-label"><i class="fa fa-mail-reply "></i></span>Exit
                            </a>
                            <button type="button" class="btn btn-labeled btn-success" id="mmc_btn_save">
                                <span class="btn-label"><i class="fa fa-save"></i></span>Save
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>