<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #40558B;">
    <div class="container-fluid">
        <a class="navbar-brand" href="admin.php">Admin</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="user.php">Utilisateurs</a>
                </li>
                <?php
                if (isset($_SESSION['isAdmin'])) {
                ?>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../session.php">Page d'Accueil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../logout.php">Déconnexion</a>
                    </li>
                <?php
                }
                ?>
            </ul>
        </div>
    </div>
</nav>