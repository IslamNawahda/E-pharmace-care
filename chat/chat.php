<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>




<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Inbox</title>
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.2/css/font-awesome.min.css">

<script src="https://use.typekit.net/hoy3lrg.js"></script>
<script>try{Typekit.load({ async: true });}catch(e){}</script>
<link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css'><link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.2/css/font-awesome.min.css'>
<link rel="stylesheet" href="chat.css">
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>

<?php
session_start();
include '../includes/config.php';
$userId = $_SESSION['userId'];

$sql = "SELECT * FROM users WHERE userId = $userId";
$result = $con->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $actualUsername = $row["name"];
    $userImage = $row["imgName"];
    $email = $row["email"];

    $phone = $row["phone"];

    $address = $row["address"];

} else {
    $actualUsername = "Default User";
    $userImage = "default_image.jpg";
}
?>



</head><body>


<div id="frame">
	<div id="sidepanel">
		<div id="profile">
			<div class="wrap">
				<img id="profile-img" src="../admin/user/<?php echo $userImage;?>" class="online" alt="" style="width:60px; height:60px"/>
				<p><?php echo $actualUsername?></p>
				<i class="fa fa-chevron-down expand-button" aria-hidden="true"></i>
				<div id="status-options">
					<ul>
						<li id="status-online" class="active"><span class="status-circle"></span> <p>Online</p></li>

					</ul>
				</div>
				<div id="expanded">
					<input name="twitter" type="text" value="<?php echo $email;?>" />
					<input name="twitter" type="text" value="<?php echo $phone;?>" />
					<input name="twitter" type="text" value="<?php echo $address;?>" />
				</div>
			</div>
		</div>
		<div id="search">
			<label for=""><i class="fa fa-users"  >  My contacts List</i></label><br><br>
		</div>

		<?php


$host = 'localhost';
$dbname = 'projectdb';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $loggedInUserId = $_SESSION['userId'];

    $query = "
    SELECT distinct
    u.userId AS user_id,
    u.name AS user_name,
    u.imgName AS user_image,
    c.message AS last_message
    FROM
        users u
    INNER JOIN
        conversations c ON u.userId = c.sender OR u.userId = c.receiver
    WHERE
        (c.sender = :loggedUserId OR c.receiver = :loggedUserId)
        AND u.userId != :loggedUserId
        AND c.created_at = (
            SELECT MAX(created_at)
            FROM conversations
            WHERE (sender = u.userId AND receiver = :loggedUserId)
            OR (receiver = u.userId AND sender = :loggedUserId)
        )
    ORDER BY
    c.created_at DESC;

    ";

    $statement = $pdo->prepare($query);
    $statement->bindParam(':loggedUserId', $loggedInUserId, PDO::PARAM_INT);
    $statement->execute();

    $results = $statement->fetchAll(PDO::FETCH_ASSOC);

    echo '<br><div id="contacts">';
echo '<ul>';

foreach ($results as $result) {
    echo '<li class="contact" data-userid="' . $result['user_id'] . '">';
    echo '<div class="wrap">';
    echo '<span class="contact-status online"></span>';
    echo '<img src="../admin/user/' . $result['user_image'] . '" alt="' . $result['user_name'] . '" style="width:50px; height:50px;" />';
    echo '<div class="meta">';
    echo '<p class="name">' . $result['user_name'] . '</p><br>';
    echo '<p class="name">' . $result['last_message'] . '</p>';
    echo '</div>';
    echo '</div>';
    echo '</li><br>';
}

echo '</ul>';
echo '</div>';

  
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

$pdo = null;

?>

		<div id="bottom-bar">
        <button id="home" style="width:50%">
        <i class="fa fa-home fa-fw" aria-hidden="true"></i> 
        <span>Home</span>
        </button>

        <button id="logout" style="width:50%">
        <i class="fa fa-user fa-fw" aria-hidden="true"></i> 
        <span>Logout</span>
        </button>

		</div>
	</div>

	<div class="content">

  <img src="../admin/chat.png" style="height:100%; width:100%;"></img>


  <div class="messages"  id="chatMessagesContainer">

			<ul>
				<li class="sent">
					<img src="" alt="" hidden />
				</li>
				<li class="replies">
					<img src="" alt="" hidden/>
				</li>
			
			</ul>
		</div>
    <div class="message-input">
    <div class="wrap">
        
    <form id="sendMessageForm" action="send_messages.php" method="POST" enctype="multipart/form-data" style="display: flex;">
    <input type="text" name="message" id="message" placeholder="Write your message..." required style="flex-grow: 1; " />
    <input type="number" name="receiver" id="receiverId" value="" hidden />
    
    <label for="fileInput" id="attach" style="background-color: #32465a; color: #ffffff; padding: 12px; border: none; cursor: pointer; text-align: center;">
        <i class="fa fa-paperclip" aria-hidden="true"></i>
        <input class="form-control"  id="fileInput"  name="image" type="file" style="display: none;">

    </label>

    <button type="button" id="sendMessageButton" onclick="sendMessage()" >
        <i class="fa fa-paper-plane" aria-hidden="true"></i>
    </button>
</form>

</div>
    </div>
</div>
</div>
<script>
function sendMessage() {
    console.log('Sending message...');
    var form = document.getElementById('sendMessageForm');
    var formData = new FormData(form);

    for (var pair of formData.entries()) {
        console.log(pair[0]+ ': ' + pair[1]);
    }
    var receiverId = formData.get('receiver');

    $.ajax({
        type: form.method,
        url: form.action,
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
            console.log('Message sent successfully:', response);

            // Load the updated contact list after sending the message
            loadUpdatedContacts();
            fetchMessages(receiverId);
            scrollToLastMessage();
            // Clear message input fields
            document.getElementById('message').value = '';
            document.getElementById('fileInput').value = '';
                  // Scroll to the last message
             
        },
        error: function(error) {
            console.log('Error sending message:', error);
        }
    });
}

// Function to load updated contact list
function loadUpdatedContacts() {
    $.ajax({
        type: 'GET',
        url: 'fetch_data.php', // Change the path if necessary
        success: function(response) {
            // Replace the existing contact list with the updated one
            $('#contacts').html(response);
            
        },
        error: function(error) {
            console.log('Error loading updated contacts:', error);
        }
    });
}
function scrollToLastMessage() {
    var messagesContainer = $('.messages');
    messagesContainer.animate({
        scrollTop: messagesContainer.prop('scrollHeight')
    }, 'fast');
}



$(document).ready(function() {
  $('#sendMessageButton').hide();
  $('#message').hide();
  $('#attach').hide();
  $('.contact:first').click();
});

  
  
    $('.contact').click(function() {
        var userId = $(this).data('userid');
        $('img[src="../admin/chat.png"]').hide();
        document.getElementById('receiverId').value = userId;

        fetchMessages(userId);

        $('#sendMessageButton').show();
        $('#message').show();
        $('#attach').show();
        
    });

    $('#home').click(function() {
            window.location.href = '../index.php';
        });

    $('#logout').click(function() {
            window.location.href = '../logout.php';
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
            scrollToLastMessage();

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
</script>

</body></html>