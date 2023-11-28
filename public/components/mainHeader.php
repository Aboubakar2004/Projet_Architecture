<header class="flex flex-col gap-4 bg-white text-black w-full px-8 py-3">
    <nav class="flex justify-between items-center">
        <div class="flex md:hidden">
            <ion-icon class="cursor-pointer" name="menu-outline"></ion-icon>
        </div>
        <div class="cursor-pointer">
        BORUSSIA DORTMUND
        </div>

        <div class="flex items-center gap-2">
    <?php
    session_start();

    // Check if the user is logged in
    if (isset($_SESSION['user_name'])) {
        $userName = $_SESSION['user_name'];
        // Display the user's name as a link to the personalization page
        echo '<a href="http://localhost/Projet_Architecture/public/php/personalisation_du_profil.php"" class="cursor-pointer hidden md:flex">' . $userName . '</a>';
    } else {
        // User is not logged in, display login link
        echo '<div class="cursor-pointer hidden md:flex">se connecter</div>';
    }
    ?>
            <div>
                <img class="w-10 h-10 object-cover rounded-full cursor-pointer" src="https://www.shutterstock.com/image-vector/default-avatar-profile-icon-social-600nw-1677509740.jpg" alt="#">
            </div>
        </div>
    </nav>
    <nav class="menu">
        <ul class="hidden md:flex justify-between items-center">
            <li class="cursor-pointer">Débat</li>
            <li class="cursor-pointer">Photographie</li>
            <li class="cursor-pointer">Cinéma</li>
            <li class="cursor-pointer active">Musique</li>
            <li class="cursor-pointer">Littérature</li>
            <li class="cursor-pointer">Peinture</li>
            <li class="cursor-pointer">Wargamming</li>
        </ul>
    </nav>
</header>

