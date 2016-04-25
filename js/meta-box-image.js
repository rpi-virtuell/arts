/*
 * Attaches the image uploader to the input field
 */
jQuery(document).ready(function($){
 
    // Instantiates the variable that holds the media library frame.
    var meta_image_frame;
 
    // Runs when the image button is clicked.
    $('#meta-image-button').click(function(e){
 
        // Prevents the default action from occuring.
        e.preventDefault();
 
        // If the frame already exists, re-open it.
        var send_attachment_bkp = wp.media.editor.send.attachment;

    wp.media.editor.send.attachment = function(props, attachment) {

        $('#custom_media_image').attr('src', attachment.url);
        $('#custom_media_url').val(attachment.url);
        $('.custom_media_id').val(attachment.id);

        wp.media.editor.send.attachment = send_attachment_bkp;
    }

    wp.media.editor.open();

    return false;       
    });
});