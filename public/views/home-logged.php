<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Cairo:wght@200..1000&family=Lugrasimo&family=Noto+Serif:ital,wght@0,100..900;1,100..900&family=UnifrakturCook:wght@700&display=swap"
        rel="stylesheet">
    <link href="public/styles/home-logged.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/2a849d8267.js" crossorigin="anonymous"></script>
    <script src="public/scripts/home.js" defer></script>
    <title>Home</title>
</head>

<body id="home">

    <nav class="container-space-between-row nav-top">

        <ul class="container-center-center-row logo-home">
            <a href="/home-logged">
                <li>
                    <img src="/images/logo_alpa_event_black_circle_big.svg" class="AlpaEvent-logo">
                </li>
                <li class="logo-text">
                    AlpaEvent
                </li>
            </a>
        </ul>

        <ul class="container-center-center-row tekst-home desktop-icons">
            <a href="/user-events">
                <li class="nav-tekst">
                    EVENTS
                </li>
            </a>
            <a href="/user-rooms">
                <li class="nav-tekst">
                    ROOMS
                </li>
            </a>
            <a href="/forum">
                <li class="nav-tekst">
                    FORUM
                </li>
            </a>
        </ul>
        <ul class="login-register-home">
            <a href="/user-profile">
            <div class="username-letters" data-username="<?php echo $_SESSION['user']['username'];?>"></div>
                <div class="container-center-center-row user-panel">
                    <i class="fa-solid fa-user"></i>
                </div>
            </a>
        </ul>
        <ul class="mobile-icons">
            <li id="hamburger-menu">
                <i class="fa-solid fa-bars"></i>
            </li>

        </ul>

    </nav>
    <main>
        <aside id="mobile-menu" class="container-center-center-column">
            <ul class="container-space-around-column">
                <a href="/user-events">
                    <li class="nav-tekst">
                        EVENTS
                    </li>
                </a>
                <a href="/user-rooms">
                    <li class="nav-tekst">
                        ROOMS
                    </li>
                </a>
                <a href="/forum">
                    <li class="nav-tekst">
                        FORUM
                    </li>
                </a>
                <li>
                    <a href="/user-profile">
                        <div class="container-center-center-row user-panel">
                            <i class="fa-solid fa-user"></i>
                        </div>
                    </a>
                </li>
            </ul>
        </aside>

        <section class="container-center-center-row">

            <div id="search-bar-home">
                <i class="fa-solid fa-magnifying-glass"></i>
                <input class="search-bar" type="text" placeholder="Search for event">
            </div>

        </section>
        <section class="container-space-around-row" id="home-options">


            <div class="container-center-center-column">
                <div class="box-tekst">Create Event</div>
                <a href="/create-event">
                    <div id="home-box-1">
                    </div>
                </a>

            </div>

            <div class="container-center-center-column">
                <div class="box-tekst">Create Room</div>
                <a href="/user-events">
                    <div id="home-box-2">
                    </div>
                </a>

            </div>

            <div class="container-center-center-column">
                <div class="box-tekst">Invite friends</div>
                <a href="/user-profile-friends">
                    <div id="home-box-3">
                    </div>
                </a>

            </div>
        </section>
        <section id="recent-events-panel">

            <p id="re-tekst">Your recent events</p>
            <hr>
            
            <div class="container-space-around-row" id="rev-block">
                <?php foreach ($variables as $event):?>
                <div class="container-center-center-column">
                <p class="box-tekst"><?= $event["event_name"]?></p>
                <div class="recent-event-block" style="background-image: url('<?="/".$event["photo"]?>');"></div>
                </div>
                <?php endforeach;?>
            </div>

        </section>
    </main>
</body>

</html>