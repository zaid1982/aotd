
<script type="text/javascript">  
    
    var mvd_load_type;
    var mvd_otable;
    
    $(document).ready(function () {
                
    });
    
    function f_mvd_load_view_document(load_type, document_id, otable){
        $('#modal_waiting').on('shown.bs.modal', function(e){   
            mvd_load_type = load_type;
            mvd_otable = otable;
            var document = f_get_general_info('document', {document_id:document_id});
            if (document.document_filename == null) {
                f_notify(2, 'Error', errMsg_default);                    
                $('#modal_waiting').modal('hide');
                $(this).unbind(e);
                return false;
            }
            if (mvd_otable == 'macr')
                f_save_audit('117', document.document_sampleCode);
            else if (mvd_otable == 'mpcr')
                f_save_audit('217', document.document_sampleCode);
            else if (mvd_otable == 'mfcr')
                f_save_audit('317', document.document_sampleCode);
            var filename = document.document_folder + '/' + document.document_filename + '.' + document.document_extension;
            filename = filename.slice(3);
            $('#mvd_iframe').attr('src', filename+'#zoom=100');   
            $('#mvd_document_id').val(document_id);           
            $('#modal_view_document').modal('show');
            $('#modal_waiting').modal('hide');
            $(this).unbind(e);
        }).modal('show');
    }
    
</script>  
    