<!-- Modal -->
<div class="modal fade" id="modal_upload" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">  
            <form class="form-horizontal" id="form_upload" method="post" enctype="multipart/form-data">
                <div class="modal-header bg-color-blueLight txt-color-white">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        &times;
                    </button>
                    <h4 class="modal-title"><i class='fa fa-file-pdf-o'></i>&nbsp; Upload Document</h4>
                </div>
                <div class="modal-body modal-fixHeight">   
                    <div class="form-group">
                        <label class="control-label text-left text-italic padding-left-15">* Notes: Please attach document in the format of PDF, jpeg or png only.</label>
                    </div>    
                    <div class="form-group">
                        <label class="col-md-3 control-label"><font color="red">*</font> Sample Code</label>
                        <div class="col-md-9 selectContainer">   
                            <select class="form-control" name="mup_document_sampleCode" id="mup_document_sampleCode"></select>
                        </div>
                    </div>            
                    <div class="form-group">
                        <label class="col-md-3 control-label"><font color="red">*</font> Document Name</label>
                        <div class="col-md-9">   
                            <div class="input-group">
                                <input type="text" name="mup_document_name" id="mup_document_name" class="form-control">
                                <span class="input-group-addon hidden-xs"><i class="fa fa-file-text"></i></span>        
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label"><font color="red">*</font> Document Type</label>
                        <div class="col-md-9 selectContainer">   
                            <select class="form-control" name="mup_documentName_id" id="mup_documentName_id"></select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label"><font color="red">*</font> File</label>
                        <div class="col-md-9">   
                            <div class="input-group">
                                <input type="file" name="mup_file" id="mup_file" class="form-control">
                                <span class="input-group-addon hidden-xs"><i class="fa fa-upload"></i></span>        
                            </div>
                        </div>
                    </div>   
                    <div class="form-group">
                        <label class="col-md-3 control-label">Description</label>
                        <div class="col-md-9">   
                            <textarea class="form-control" name="mup_document_remarks" id="mup_document_remarks" rows="3"></textarea>
                        </div>
                    </div>
                </div> 
                <div class="modal-footer padding-10">
                    <div class="row">
                        <div class="col-md-12">
                            <button type="button" class="btn btn-labeled btn-danger pull-left" data-dismiss="modal">
                                <span class="btn-label"><i class="fa fa-mail-reply "></i></span>Exit
                            </button>
                            <button type="button" class="btn btn-labeled btn-warning" id="mup_btn_submit">
                                <span class="btn-label"><i class="fa fa-upload"></i></span>Upload
                            </button>
                        </div>
                    </div>
                </div>
                <input type="hidden" name="funct" id="mup_funct" value="upload_file" />
                <input type="hidden" name="mup_ids" id="mup_ids" />
                <input type="hidden" name="mup_wfTrans_id" id="mup_wfTrans_id" />
            </form>
        </div>
    </div>
</div>