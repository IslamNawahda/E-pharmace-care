<?php
session_start();
$host = 'localhost';
$dbname = 'projectdb';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $userId =$_POST['userId'];
    $userQuery = "
        SELECT name, imgName
        FROM users
        WHERE userId = :userId;
    ";

    $userStatement = $pdo->prepare($userQuery);
    $userStatement->bindParam(':userId', $userId, PDO::PARAM_INT);
    $userStatement->execute();

    $userDetails = $userStatement->fetch(PDO::FETCH_ASSOC);

    $userName = $userDetails['name'];
    $userImage = $userDetails['imgName'];

    $receiver=$_SESSION['userId'];
    $query = "
        SELECT sender, receiver, message,image
        FROM conversations
        WHERE (sender = :userId AND receiver = :receiver) OR (sender = :receiver AND receiver =:userId)
        ORDER BY created_at ASC;
    ";

    $statement = $pdo->prepare($query);
    $statement->bindParam(':userId', $userId, PDO::PARAM_INT);
    $statement->bindParam(':receiver', $receiver, PDO::PARAM_INT);
    $statement->execute();

    $messages = $statement->fetchAll(PDO::FETCH_ASSOC);

    echo '<div class="contact-profile">';
    echo '<img id="profile-img" style="height:40px" src="../admin/user/' . $userImage . '" alt="" />';
    echo '<p>' . $userName . '</p>';
    echo '</div>';

    echo '<ul>';
    foreach ($messages as $message) {
        $sender = $message['sender'];
        $receiver = $message['receiver'];
        $messageContent = $message['message'];

        $class = ($sender == $userId) ? 'sent' : 'replies';
       
        $imageSrc = ($sender == $userId) ? '../admin/user/' . $userImage : '../admin/user/' .   $_GET['sender'];

        echo '<li class="' . $class . '">';
        echo '<img src="' . $imageSrc . '" alt="" />';
        
        echo '<p>' . $messageContent . '</p>';
        if (isset($message['image']) && $message['image'] != '') {
            $floatDirection = ($sender == $userId) ?  'left':'right';
            echo '<br><br><br>
            <img src="../images/' . $message['image'] . '" alt="Thumbnail" class="thumbnail" style="height:200px;width:200px;border-radius: 10px; margin-'.$floatDirection.':35PX; float:' . $floatDirection . '; box-shadow: 3px 3px 9px 0 rgba(0, 0, 0, 0.8);" src="../images/' . $message['image'] . '" alt="'.$userId.'"  cursor:pointer;">
                <div id="myModal" class="modal">
                <span class="close">&times;</span>
                <img class="modal-content" id="fullImage" >
            </div>
            ';
        }
        echo '</li>';
      
    }
    echo '</ul>';
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

$pdo = null;
?>
<style>

.modal {
    display: none; 
    position: fixed;
    justify-content: center;
    align-items: center;
    left: 0;
    top: 0;
    width: 100%; 
    height: 100%;
    background-color: rgb(0,0,0); 
    background-color: rgba(0,0,0,0.6);
}

.modal-content {
    border-radius: 10px; 
    max-width: 80%;
    max-height: 80%;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
}

.close {
    position: absolute;
    top: 10px;
    right: 30px;
    color: #f1f1f1;
    font-size: 40px;
    font-weight: bold;
    cursor: pointer;
}
</style>



<script>
var thumbnails = document.getElementsByClassName('thumbnail');

function openModal() {
    var modal = document.getElementById('myModal');
    var modalImg = document.getElementById('fullImage');
    modal.style.display = "block";
    modalImg.src = this.src;
    modalImg.style.width = '60%';
    modalImg.style.height = '60%';
    modalImg.style.borderRadius = '10px'; 
}

for (var i = 0; i < thumbnails.length; i++) {
    thumbnails[i].addEventListener('click', openModal);
}

var closeModal = document.getElementsByClassName("close")[0];
closeModal.onclick = function() {
    var modal = document.getElementById('myModal');
    modal.style.display = "none";
}

</script>

