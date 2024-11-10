<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/menu.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.3/css/font-awesome.min.css"> <!-- FontAwesome -->
    <title>Menu Responsivo</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>

    <ul class="menu">
        <li title="home"><a href="../php/index.php" class="menu-button home">Menu</a></li>
        <li title="search"><a href="../php/pesquisa.php" class="search">Search</a></li>
        <!--<li title="pencil"><a href="#" class="pencil">Pencil</a></li>-->
        <li title="about"><a href="../php/perfil.php" class="active about">Profile</a></li>
        <li title="archive"><a href="#" class="archive">Archive</a></li>
        <li title="contact"><a href="#" class="contact">Contact</a></li>
        <li title="contact"><a href="../api/api_logout.php" class="fa fa-sign-out">Sair</a></li>
    </ul>

    <!-- <ul class="menu-bar">
        <li><a href="../php/index.php" class="menu-button">Menu</a></li>
        <li><a href="../php/index.php">Home</a></li>
        <li><a href="../php/perfil.php">Profile</a></li>
        <li><a href="#">Editorial</a></li>
        <li><a href="#">About</a></li>
    </ul> -->

    <script>
        $(document).ready(function() {
            $(".menu-button").click(function() {
                $(".menu-bar").toggleClass("open");
            });
        });
    </script>
</body>
</html>
