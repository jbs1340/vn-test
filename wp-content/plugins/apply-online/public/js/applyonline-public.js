


(function( $ ) {
    'use strict';

    /**
     * All of the code for your public-facing JavaScript source
     * should reside in this file.
     *
     * Note that this assume you're going to use jQuery, so it prepares
     * the $ function reference to be used within the scope of this
     * function.
     *
     * From here, you're able to define handlers for when the DOM is
     * ready:
     *
     * $(function() {
     *
     * });
     *
     * Or when the window is loaded:
     *
     * $( window ).load(function() {
     *
     * });
     *
     * ...and so on.
     *
     * Remember that ideally, we should not attach any more than a single DOM-ready or window-load handler
     * for any particular page. Though other scripts in WordPress core, other plugins, and other themes may
     * be doing this, we should try to minimize doing that in our own work.
     */

    $(document).ready(function(){
        $('.datepicker').datepicker({
            yearRange: "-99:+50",
            //dateFormat : aol_public.date_format,
            changeMonth: true,
            changeYear: true,
        });
        // Change this to the location of your server-side upload handler:
        var _data_json=[];
        var file_info = [];
        var url = 'wp-content/uploads/applyonline/',
            uploadButton = $('<label/>')
                .addClass('btn btn-warning lb-sts-upload')
                .text('Uploading...');
           var deleteButton = $('<label/>')
                .addClass('btn btn-danger rounded ml-5')
                .text('Abort')
                .on('click', function () {
                    var $this = $(this),
                        data = $this.data();
                    $this.remove();
                    data.abort();
                    // $this
                    //     .off('click')
                    //     .on('click', function () {
                    //         $this.remove();
                    //         data.abort();
                    //     });

                });
        $('#fileupload').fileupload({
            url: aol_public.ajaxurl,
            formData: {
                action: 'upload_files'
            },
            dataType: 'json',
            autoUpload: true,
            acceptFileTypes: /(\.|\/)(jpe?g|png|pdf)$/i,
            maxFileSize: 99900000,
            maxNumberOfFiles: 4,
            // Enable image resizing, except for Android and Opera,
            // which actually support image resizing, but fail to
            // send Blob objects via XHR requests:
            disableImageResize: /Android(?!.*Chrome)|Opera/
                .test(window.navigator.userAgent),
            previewMaxWidth: 100,
            previewMaxHeight: 100,
            previewCrop: true
        }).on('fileuploadadd', function (e, data) {
            data.context = $('<div/>').appendTo('#files');
            $.each(data.files, function (index, file) {
                var separators = [' ', '\\\+', '-', '\\\(', '\\\)',
'\\*', '/', ':', '\\\?','\\\.'];
                var nameClass = file.name.split(new RegExp(separators.join('|')));
                var node = $('<p/>')
                    .append($('<span/>').text(file.name));
                var status = data.context
                    .append($(''));
                var statussuccess = $('<div/>');
                var statuserror = $('<div/>');

                if (!index) {
                    node
                        .append(status.clone(true).addClass('text-warning status-waiting float-right').text('waiting'))
                        .append(deleteButton.addClass('float-right del-btn').clone(true).data(data).hide())
                        .append(statussuccess.addClass('ml-2 text-success status-ok '+nameClass[0]).clone(true).data(data).text('Successful!').hide())
                        .append(statuserror.addClass('ml-2 text-danger status-error '+nameClass[0]).clone(true).data(data).text('ERROR!').hide());

                }
                node.appendTo(data.context);
            });
        }).on('fileuploadprocessalways', function (e, data) {
            var index = data.index,
                file = data.files[index],
                node = $(data.context.children()[index]);
            if (file.preview) {
                node
                    .prepend('<br>')
                    .prepend(file.preview);
            }
            if (file.error) {
                node
                    .append('<br>')
                    .append($('<span class="text-danger"/>').text(file.error));
            }
            if (index + 1 === data.files.length) {
                uploadButton.text('Upload')
                    .prop('disabled', !!data.files.error);
            }
        }).on('fileuploadprogressall', function (e, data) {
            var progress = parseInt(data.loaded / data.total * 100, 10);
            $('#progress .progress-bar').css(
                'width',
                progress + '%'
            );
        }).on('fileuploaddone', function (e, data) {
            var separators = [' ', '\\\+', '-', '\\\(', '\\\)',
'\\*', '/', ':', '\\\?','\\\.'];
            if(data.result.status ){
                var temp = {'name': data.result.files.name,'type': data.result.files.type,'tmp_name': data.result.files.tmp_name,'size': data.result.files.size,'error':data.result.files.error};
                file_info.push(temp);
                $.each(data.files, function (i,l) {
                    var nameClass = l.name.split(new RegExp(separators.join('|')));
                    $('.status-waiting').hide();
                    $('.del-btn').show();
                    $('.status-ok.'+nameClass[0]).show();
                })
            }
            else{
                $('.status-waiting').hide();
                $('.del-btn').show();
                $.each(data.files, function (i,l) {
                var nameClass = l.name.split(new RegExp(separators.join('|')));
                console.log(data);
                $('.status-error.'+nameClass[0]).show().clone(true);
                })
            }

        }).on('fileuploadfail', function (e, data) {

            $.each(data.files, function (index) {
                var error = $('<span class="text-danger"/>').text('File upload failed.');
            });
        }).prop('disabled', !$.support.fileInput)
            .parent().addClass($.support.fileInput ? undefined : 'disabled');


        $( ".aol_app_form" ).submit(function(){
            jQuery('#fileupload input[type=file]').val(null);// save without input file
            var formData = new FormData(document.getElementById("fileupload"));
            formData.append('files', JSON.stringify(file_info));
            // formData.delete($('#fileupload input[type=file]').attr('name')) ;
            $.ajax({
                url: aol_public.ajaxurl,
                type: 'POST',
                dataType: 'json',
                data: formData,
                //async: false,
                cache: false,
                contentType: false,
                processData: false,
                beforeSend: function(){
                    $('#aol_form_status').removeClass();
                    $('#aol_form_status').html('Submitting . . . . . ');
                    $('#aol_form_status').addClass('alert alert-warning');
                    $(".aol-form-button").prop('disabled', true);
                },
                success:function(response){
                    $(document).trigger('afterAppSubmit', response); //Custom event  on ajax completiong

                    if(response['success']==true){
                        $('#aol_form_status').removeClass();
                        $('#aol_form_status').addClass('alert alert-success');
                        $('#aol_form_status').html(response['message']);
                        $(".aol-form-button").prop('disabled', false);
                        if(response['hide_form']==true) $('.aol_app_form').slideUp(); //Show a sliding effecnt.

                        //Divert to thank you page.
                        if(response.divert != null){
                            var page = response.divert;
                            window.location.href = stripslashes(page);
                        }
                    }
                    else if(response['success']==false){
                        $('#aol_form_status').removeClass();
                        $('#aol_form_status').addClass('alert alert-danger');
                        $('#aol_form_status').html(response['error']);
                        $(".aol-form-button").prop('disabled', false);
                    }
                    //If response is not jSon.
                    else{
                        $('#aol_form_status').addClass('alert alert-danger');
                        $('#aol_form_status').html('Form saved with errors. Please contact us for more information. ');
                        $(".aol-form-button").prop('disabled', false);
                    }
                },
                error: function(xhr, type, error){
                    $('#aol_form_status').removeClass();
                    $('#aol_form_status').addClass('alert alert-danger');
                    $('#aol_form_status').html('An unexpected error occured with error code: <u>' + xhr.status + " " + xhr.statusText+'</u>. Please contact us for more information.');
                    $(".aol-form-button").prop('disabled', false);
                }
            });
            return false;
        });
        jQuery('#phone-number').keydown(function (e) {
            var key = e.which || e.charCode || e.keyCode || 0;
            var phone = $(this);

            // Auto-format- do not expose the mask as the user begins to type
            if (key !== 8 && key !== 9) {
                if (phone.val().length > 10) {
                    return false;
                }
                if (phone.val().length === 4) {
                    phone.val($phone.val() + '-');
                }
            }

            // Allow numeric (and tab, backspace, delete) keys only
            return (key == 8 ||
                key == 9 ||
                key == 46 ||
                (key >= 48 && key <= 57) ||
                (key >= 96 && key <= 105));
        })

        jQuery('#phone-number').bind('focus click', function () {
            var phone = $(this);

            if (phone.val().length > 11) {
            }
            else {
                var val = phone.val();
                phone.val(' ').val(val); // Ensure cursor remains at the end
            }
        })

            .blur(function () {
                var phone = $(this);
            });
    })


})( jQuery );




function stripslashes (str) {
    return (str + '').replace(/\\(.?)/g, function (s, n1) {
        switch (n1) {
            case '\\':
                return '\\';
            case '0':
                return '\u0000';
            case '':
                return '';
            default:
                return n1;
        }
    });
}
