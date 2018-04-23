<script type="text/javascript">
        
    function printBarCode(content) {

        var printContents = document.getElementById(content).innerHTML;
        w = window.open();

        w.document.write(printContents);
        w.document.write('<scr' + 'ipt type="text/javascript">' + 'window.onload = function() { window.print(); window.close(); };' + '</sc' + 'ript>');

        w.document.close(); // necessary for IE >= 10
        w.focus(); // necessary for IE >= 10

        return true;
    }
    
    function getBarCode(code) {
        JsBarcode("#barcode", code, { fontSize: 35 });
        printBarCode('printcode');
    }
    
    $(document).ready(function () {
        
        //JsBarcode("#barcode", "QEA/ATS/INT/NAC/114-17", { fontSize: 35 });
                
    });
            
</script>