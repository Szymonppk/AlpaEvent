<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="public/styles/user-profile.css" rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Cairo:wght@200..1000&family=Lugrasimo&family=Noto+Serif:ital,wght@0,100..900;1,100..900&family=UnifrakturCook:wght@700&display=swap"
        rel="stylesheet">
    <script src="https://kit.fontawesome.com/2a849d8267.js" crossorigin="anonymous"></script>
    <script src="public/scripts/rooms-events.js" defer></script>
    <script src="public/scripts/user-profile.js" defer></script>
    <title>Profile</title>
</head>

<body id="user-profile-bg" class="container-center-center-column">
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
        <a href="/user-profile">
            <div class="container-center-center-row login-register-home user-panel">
                <i class="fa-solid fa-user"></i>
            </div>
        </a>
        <ul class="mobile-icons">
            <li id="hamburger-menu">
                <i class="fa-solid fa-bars"></i>
            </li>

        </ul>

    </nav>
    <!-- Check sizing of main on zoom-->
    <main class="container-center-center-column">
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
        <p class="main-text">Profile</p>

        <div class="main-content container-start-center-row">
            <div id="user-options" class="container-center-center-column">
                <ul class="container-center-center-column profile-options">
                    <li class="profile-option container-center-center-row">
                        <a href="/user-profile-friends">
                            <i class="fa-solid fa-people-group"></i><span class="option-text">Friends</span>
                        </a>
                    </li>
                    <li class="profile-option container-center-center-row" id="logout">
                        <a>
                            <i class="fa-solid fa-arrow-right-from-bracket"></i><span class="option-text">Log out</span>
                        </a>
                    </li>
                </ul>

            </div>
            <div id="user-data-box" class="container-start-center-row">
                <div id="user-data" class="container-center-center-column">
                    <form id="data-form" method="POST" action="/update-user">
                        <input name="username" placeholder="username" type="text" class="input">
                        <input name="email" placeholder="email" type="email" class="input">
                        <input name="password" placeholder="password" type="password" class="input">
                        <button type="submit" class="button-submit">Change</button>
                    </form>
                    <form method="POST" action="/delete-user" id="delete-form" class="container-center-center-column" onsubmit="return confirm('Are you sure you want to delete your account?')">
                        <button type="submit" class="button-delete">Delete account</button>
                    </form>

                </div>
                <div id="user-image-box" class="container-center-center-row">
                    <div class="container-center-center-row user-image">
                        <i class="fa-solid fa-user" id="fa-image"></i>
                    </div>

                </div>

            </div>
        </div>
    </main>

</body>

</html>