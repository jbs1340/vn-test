jQuery(function () {
    jQuery(".minor-publishing-actions select[name=aol_tag]").on("change", function () {
        if(this.value ==='pending'){
            jQuery('.minor-publishing-actions select[name=aol_tag]').addClass('invalidate');
        }
        else{
            jQuery('select[name=aol_tag]').removeClass('invalidate');

        }
        if (this.value !== 'pending') {
            jQuery("#commentsdiv").show();
        } else {
            jQuery("#commentsdiv , #postdivrich.postarea , h3:contains('Notes')").hide();
        }
    });
    if(status != null)
    {

    }

    jQuery("body.post-type-aol_application form[name=post]").on('submit',function (event) {
        event.preventDefault();
        jQuery('.error_aol').append().html('<div class="alert alert-info" role="alert">Loading...</div>');
        var token = jQuery('input[name=getcomment]').val();
        var pid = jQuery('input[name=post_ID]').val();
        var status = jQuery('select[name=aol_tag]').val();
        jQuery.ajax({
            type: 'post',
            content: 'application/xml',
            url: ajaxurl,
            data: {
                action: 'get-comments',
                p: pid,
                start: 0,
                _ajax_nonce: token
            }
        }).success(function (data) {
            if ( status === 'pending') {
                jQuery('.error_aol').append().html('<div class="alert alert-danger" role="alert">You <b>have to change</b> the status of candidates</div>');
                return false;
            } else if( status !== 'pending' ){
                if ( data == 1 && status === 'rejected') {
                    jQuery('.error_aol').append().html('<div class="alert alert-danger" role="alert">You <b>have to input</b> the reason in comment form</div>');
                    return false;
                } else {

                    jQuery.ajax({
                        type: 'post',
                        action:'post.php',
                        data: jQuery("form[name=post]").serialize()

                    }).success(function () {
                        jQuery('.error_aol').append().html('<div class="alert alert-success" role="alert"> <b>SUCCESS!</b> the status is updated</div>');

                    }).error(function () {
                    });
                }
            }
        }).error(function (data) {
            console.log(data);
            jQuery('.error_aol').append().html('<div class="alert alert-danger" role="alert"> <strong>ERROR!</strong>'+data+' </div>');

        });
    });


    var status = jQuery('select[name=aol_tag]').val();
    if(status != null)
    {
        console.log(('222'));
        window.onbeforeunload = function() {
            console.log(('222'));
            var Ans = confirm("Are you sure you want change page!");
            if(Ans==true)
                return true;
            else
                return false;
        };
    }

    jQuery.each(jQuery('select[name=aol_tag]'), function () {
        //console.log(this.value);
        if(this.value ==='pending'){
            jQuery('.minor-publishing-actions select[name=aol_tag]').addClass('invalidate');
        }
        else{
            jQuery('select[name=aol_tag]').removeClass('invalidate');

        }
        if (status != 'pending') {
            jQuery("#commentsdiv").show();
            jQuery("#postdivrich.postarea").hide();
        } else{
            jQuery("#commentsdiv , #postdivrich.postarea , h3:contains('Notes')").hide();
        }
    })
    jQuery('.pdf-viewer').each(function (i) {

        jQuery('<div class="pdf-div-viewer' + i + ' pdf-div"></div>').appendTo('#list-pdf');
        if (jQuery(this).data('url') != null) {
            PDFObject.embed(jQuery(this).data('url'), '.pdf-div-viewer' + i);
        }
    });

});
