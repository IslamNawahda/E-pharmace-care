function sendMessage() {
    console.log('Sending message...');
    var form = $('#sendMessageForm');
    $.ajax({
        type: form.attr('method'),
        url: form.attr('action'),
        data: form.serialize(),
        success: function(response) {
            console.log('Message sent successfully:', response);

            form.find('input[name="message"]').val('');

            var userId = document.getElementById('receiverId').value;
            fetchMessages(userId);
        },
        error: function(error) {
            console.log('Error sending message:', error);
        }
    });
}

$(document).ready(function() {

    $('.contact').click(function() {
        var userId = $(this).data('userid');
        $('img[src="../admin/chat.png"]').hide();
        document.getElementById('receiverId').value = userId;
        fetchMessages(userId);


        $('#logout').click(function() {
            window.location.href = '../logout.php';
        });
    });

});

function fetchMessages(getUserId) {
    $.ajax({
        type: 'POST',
        url: 'fetch_messages.php?sender=' + encodeURIComponent('<?php echo $userImage; ?>'),
        data: {
            userId: getUserId,
            sender: '<?php echo $userImage; ?>'
        },
        success: function(response) {
            $('#chatMessagesContainer').html(response);
        },
        error: function(xhr, status, error) {
            console.log('AJAX Error: ' + status, error);
        }
    });

}

$(".messages").animate({
    scrollTop: $(document).height()
}, "fast");

$("#profile-img").click(function() {
    $("#status-options").toggleClass("active");
});

$(".expand-button").click(function() {
    $("#profile").toggleClass("expanded");
    $("#contacts").toggleClass("expanded");
});

$("#status-options ul li").click(function() {
    $("#profile-img").removeClass();
    $("#status-online").removeClass("active");
    $("#status-away").removeClass("active");
    $("#status-busy").removeClass("active");
    $("#status-offline").removeClass("active");
    $(this).addClass("active");

    if ($("#status-online").hasClass("active")) {
        $("#profile-img").addClass("online");
    } else if ($("#status-away").hasClass("active")) {
        $("#profile-img").addClass("away");
    } else if ($("#status-busy").hasClass("active")) {
        $("#profile-img").addClass("busy");
    } else if ($("#status-offline").hasClass("active")) {
        $("#profile-img").addClass("offline");
    } else {
        $("#profile-img").removeClass();
    };

    $("#status-options").removeClass("active");
});

function newMessage() {
    message = $(".message-input input").val();
    if ($.trim(message) == '') {
        return false;
    }
    $('<li class="sent"><img src="http://emilcarlsson.se/assets/mikeross.png" alt="" /><p>' + message + '</p></li>').appendTo($('.messages ul'));
    $('.message-input input').val(null);
    $('.contact.active .preview').html('<span>You: </span>' + message);
    $(".messages").animate({
        scrollTop: $(document).height()
    }, "fast");
};

$('.submit').click(function() {
    newMessage();
});
$('.message-input input').keyup(function(e) {
    if (e.which == 13) {
        e.preventDefault();
        sendMessage();
    }
});

$(window).on('keydown', function(e) {

});