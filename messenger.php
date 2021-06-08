<?php

require_once 'config/configuration.php';
require_once 'config/connect.php';

$sql = '
SELECT M.message, M.date_at, 
U.pseudo, 
CASE WHEN (U.avatar != \'\') THEN avatar ELSE \'default.jpg\' END AS avatar 
FROM messenger AS M 
INNER JOIN users AS U 
    ON U.id = M.user_id
ORDER BY M.date_at DESC
';
$tchat = '<div id="tchat">';
if ($result = $mysqli->query($sql)) {
    if ($result->num_rows > 0) {
        while ($messenger = $result->fetch_assoc()) {
            $tchat .= '
            <div class="d-flex justify-content-start mb-4">
                <div class="img_cont_msg">
                    <img src="/images/avatar/'.$messenger['avatar'].'" class="rounded-circle user_img_msg">
                </div>
                <div class="msg_cotainer">
                    '.$messenger['message'].'
                    <span class="msg_time">'.$messenger['pseudo'].', '.$messenger['date_at'].'</span>
                </div>
            </div>';
        }
    }
}
$tchat .= '</div>';
echo $tchat;
