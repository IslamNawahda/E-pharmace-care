
<?php
session_start();
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