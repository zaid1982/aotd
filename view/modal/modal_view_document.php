<div class="modal" id="modal_view_document" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-lg">
        <form class="form-horizontal" id="form_mvd">
            <div class="modal-content">
                <div class="modal-header bg-color-blueLight txt-color-white">
                    <button type="button" class="close" aria-hidden="true" data-dismiss="modal">
                        &times;
                    </button>
                    <h4 class="modal-title text-white" id="myModalLabel">Performance Evaluation</h4>
                </div>
                <div class="modal-body modal-fixHeight">   
                    <div class="row">
                        <div class="col-md-12" style="height: calc(100vh - 250px); ">
                            <iframe id="mvd_iframe" name="mvd_iframe_<?=time()?>" src="" height="100%" width="100%"></iframe>
                        </div>                                    
                    </div>
                </div>
                <input type="hidden" name="mvd_document_id" id="mvd_document_id" />
                <input type="hidden" name="funct" id="mvd_funct" />
                <div class="modal-footer padding-10">
                    <div class="row">
                        <div class="col-md-12">
                            <a hreh="#" class="btn btn-labeled btn-danger pull-left" data-dismiss="modal">
                                <span class="btn-label"><i class="fa fa-mail-reply "></i></span>Exit
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>