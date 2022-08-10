<?php
$ansicht_unten = '';
$ansicht_unten = '

<!-- Konfiguration für Trumbowyg -->
<!-- Import jQuery -->

<script src="//ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>window.jQuery || document.write(\'<script src="js/vendor/jquery-3.3.1.min.js"><\/script>\')</script>
<script src="editor/Trumbowyg-main/dist/trumbowyg.min.js"></script>

<script src="editor/Trumbowyg-main/dist/plugins/cleanpaste/trumbowyg.cleanpaste.min.js"></script>
<script src="editor/Trumbowyg-main/dist/plugins/pasteimage/trumbowyg.pasteimage.min.js"></script>
<script src="editor/Trumbowyg-main/dist/plugins/colors/trumbowyg.colors.min.js"></script>
<script src="editor/Trumbowyg-main/dist/plugins/fontfamily/trumbowyg.fontfamily.min.js"></script>
<script src="editor/Trumbowyg-main/dist/plugins/fontsize/trumbowyg.fontsize.min.js"></script>
<script src="editor/Trumbowyg-main/dist/plugins/table/trumbowyg.table.min.js"></script>
<script src="editor/Trumbowyg-main/dist/plugins/indent/trumbowyg.indent.min.js"></script>
<script src="editor/Trumbowyg-main/dist/plugins/lineheight/trumbowyg.lineheight.min.js"></script>
<script src="editor/Trumbowyg-main/dist/plugins/noembed/trumbowyg.noembed.min.js"></script>
<script src="editor/Trumbowyg-main/dist/plugins/pasteembed/trumbowyg.pasteembed.min.js"></script>
<script src="editor/Trumbowyg-main/dist/plugins/pasteimage/trumbowyg.pasteimage.min.js"></script>
<script>
    $(\'#summernote-kapitel-text\').trumbowyg({
        btns: [
            [\'viewHTML\'],
            [\'undo\', \'redo\'], // Only supported in Blink browsers
            [\'formatting\'],
            [\'strong\', \'em\', \'del\'],
            [\'superscript\', \'subscript\'],
            [\'link\'],
            [\'insertImage\'],
            [\'justifyLeft\', \'justifyCenter\', \'justifyRight\', \'justifyFull\'],
            [\'unorderedList\', \'orderedList\'],
            [\'horizontalRule\'],
            [\'removeformat\'],
            [\'fullscreen\'],
            [\'foreColor\', \'backColor\'],
            [\'fontfamily\'],
            [\'fontsize\'],
            [\'table\'],
            [\'indent\', \'outdent\'],
            [\'lineheight\'],
            [\'noembed\'],
            [\'specialChars\']
        ],
        plugins: {
            fontsize: {
                sizeList: [
                    \'8px\',
                    \'9px\',
                    \'10px\',
                    \'11px\',
                    \'12px\',
                    \'14px\',
                    \'16px\',
                    \'18px\',
                    \'20px\',
                    \'22px\',
                    \'24px\'
                ],
                allowCustomSize: false
            }
            
        }
    });
</script>

    
<script type="text/javascript">
    var windowObjectReference = null; // global variable

    function popup(url, windowName) {
        if (windowObjectReference == null || windowObjectReference.closed) {
            windowObjectReference = window.open(url, windowName, "location=no,directories=0, menubar=no,scrollbars=no,status=yes,toolbar=no,dependent=yes,left=120,top=120,width=" + (screen.availWidth - 240) + ",height=" + (screen.availHeight - 240) + "");
        } else {
            windowObjectReference.focus();
        };
    }
</script>

<script>
    $(".click").click(function(){
        $(".post").load("unterlagen.anzeigen.php");
    });
</script>

<script>
$(\'.selectall_schreiben\').click(function() {
    if ($(this).is(\':checked\')) {
        $(\'.alle_schreiben\').attr(\'checked\', true);
    } else {
        $(\'.alle_schreiben\').attr(\'checked\', false);
    }
});

$(\'.selectall_lesen\').click(function() {
    if ($(this).is(\':checked\')) {
        $(\'.alle_lesen\').attr(\'checked\', true);
    } else {
        $(\'.alle_lesen\').attr(\'checked\', false);
    }
});

$(\'.selectall_none\').click(function() {
    if ($(this).is(\':checked\')) {
        $(\'.alle_none\').attr(\'checked\', true);
    } else {
        $(\'.alle_none\').attr(\'checked\', false);
    }
});

$(\'.selectall_benutzer_schreiben\').click(function() {
    if ($(this).is(\':checked\')) {
        $(\'.alle_benutzer_schreiben\').attr(\'checked\', true);
    } else {
        $(\'.alle_benutzer_schreiben\').attr(\'checked\', false);
    }
});

$(\'.selectall_benutzer_lesen\').click(function() {
    if ($(this).is(\':checked\')) {
        $(\'.alle_benutzer_lesen\').attr(\'checked\', true);
    } else {
        $(\'.alle_benutzer_lesen\').attr(\'checked\', false);
    }
});

$(\'.selectall_benutzer_none\').click(function() {
    if ($(this).is(\':checked\')) {
        $(\'.alle_benutzer_none\').attr(\'checked\', true);
    } else {
        $(\'.alle_benutzer_none\').attr(\'checked\', false);
    }
});


</script>


</body>
</html>
';

echo $ansicht_unten;
