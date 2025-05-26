<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="/public/styles/room-event-info.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/2a849d8267.js" crossorigin="anonymous"></script>
    <script src="/public/scripts/room.js"></script>
    <title>Room Event Info</title>

</head>

<body id="room-dashboard">
    <main id="main-desktop">
        <div class="container-space-between-row" id="options-mobile">
            <div id="room-info-mobile">
                <div id="user-room-photo-mobile" class="container-center-center-row">
                </div>
                <div class="room-info-container container-center-center-column">
                <p class="room-info-mobile">Room name</p>
                <p class="room-info-mobile">(Event Info)</p>
                </div>    
            </div>
            <a href="/home-logged">
            <img src="/images/logo_alpa_event_black_circle_big.svg" alt="AlpaEvent logo"
                class="AlpaEvent-logo-mobile">
            </a>    
            <ul class="mobile-icons">
                <li id="hamburger-menu">
                    <i class="fa-solid fa-bars"></i>
                </li>
            </ul>
        </div>
        <aside id="aside" class="container-space-between-column">
            <div class="container-center-center-column" id="room-item-info">
                <div id="user-room-photo" class="container-center-center-row">
                </div>

                <p class="room-info room-name"></p>
                <p class="room-info room-localisation"></p>
                <p class="room-info room-date"></p>
                <p class="room-info room-type"></p>

            </div>
            <ul class="container-center-center-column room-options">
                <li class="room-option container-center-center-row">
                    <a href="/room/<?php echo htmlspecialchars($room_id);?>/room-dashboard">
                        <i class="fa-solid fa-house"></i><span class="option-text">Dashboard</span>
                    </a>
                </li>


                <li class="room-option container-center-center-row" id="option-selection">
                    <a href="/room/<?php echo htmlspecialchars($room_id);?>/room-event-info">
                        <i class="fa-solid fa-circle-info"></i><span class="option-text">Event Info</span>
                    </a>
                </li>

                <li class="room-option container-center-center-row">
                    <a href="/room/<?php echo htmlspecialchars($room_id);?>/room-event-settlements">
                        <i class="fa-solid fa-wallet"></i><span class="option-text">Event settlements</span>
                    </a>
                </li>
                <li class="room-option container-center-center-row">
                    <a href="/room/<?php echo htmlspecialchars($room_id);?>/room-event-plan">
                        <i class="fa-solid fa-map"></i><span class="option-text">Event plan</span>
                    </a>
                </li>
                <li class="room-option container-center-center-row">
                    <a href="/room/<?php echo htmlspecialchars($room_id);?>/room-chat">
                        <i class="fa-solid fa-comment"></i><span class="option-text">Chat</span>
                    </a>
                </li>
                <li class="room-option container-center-center-row">
                    <a href="/room/<?php echo htmlspecialchars($room_id);?>/room-gallery">
                        <i class="fa-solid fa-camera"></i><span class="option-text">Gallery</span>
                    </a>
                </li>
                <li class="room-option container-center-center-row">
                    <a href="/room/<?php echo htmlspecialchars($room_id);?>/room-team">
                        <i class="fa-solid fa-people-group"></i><span class="option-text">Team</span>
                    </a>
                </li>
                <li class="room-option container-center-center-row">

                    <a href="/room/<?php echo htmlspecialchars($room_id);?>/room-settings">
                        <i class="fa-solid fa-gear"></i><span class="option-text">Settings</span>
                    </a>
                </li>
            </ul>
            <div class="container-center-center-column logo-options">
                <a href="/home-logged">
                    <img src="../../images/logo_alpa_event_black_circle_big.svg" alt="AlpaEvent logo"
                        class="AlpaEvent-logo">
                </a>
                <ul class="container-center-center-column room-options">
                    <li class="room-option container-center-center-row">
                    <a>    
                    <i class="fa-solid fa-question"></i><span
                            class="option-text">Help</span>
                    </a>    
                    </li>
                    <li class="room-option container-center-center-row">
                        <a href="#" id="logout">
                        <i class="fa-solid fa-arrow-right-from-bracket"></i><span class="option-text">Log out</span>
                        </a>
                    </li>
                </ul>
            </div>
        </aside>



        <div id="quick-notes">

        </div>

        <div id="event-info" class= "container-center-column">
            <p>Details:</p>
            <p>Name:</p> 
            <p><?php echo $room_data["event_name"]?></p>  
        </div>

    </main>


</body>

</html>