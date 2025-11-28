<?php
session_start();

if (!isset($_SESSION["Correo"])) {
    header("Location: index.php");
    exit();
}

$nombre = $_SESSION["Nombre"];
$apellido = $_SESSION["Apellido"];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MindShare - Carreras UTCJ</title>

    <style>
      
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', sans-serif;
        }
        :root {
            --bg-color: #f5f5f5;
            --text-color: #121212;
            --border-color: #ddd;
            --hover: rgba(255,255,255,0.15);

            --blue-1: #007bff;
            --blue-2: #00c6ff;

            --post-bg: #fff;
            --post-text: #222;
            --post-date: #777;
        }

@media (prefers-color-scheme: dark) {
    :root {
        --bg-color: #121212;
        --text-color: #fff;
        --border-color: #333;
        --hover: rgba(0,0,0,0.3);

        --post-bg: #1a1a1a;
        --post-text: #eee;
        --post-date: #aaa;
    }
}

        body {
            background: var(--bg-color);
            color: var(--text-color);
        }

        header {
            width: 100%;
            background: linear-gradient(to right, var(--blue-1), var(--blue-2));
            padding: 15px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            color: var(--text-color);
            box-shadow: 0 2px 14px rgba(0, 0, 0, 0.2);
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        header .logo a {
           color: var(--text-color);
            font-size: 1.6em;
            font-weight: bold;
            text-decoration: none;
        }

        nav a {
           color: var(--text-color);
            text-decoration: none;
            margin-left: 20px;
            font-size: 1em;
            transition: 0.2s;
        }

        nav a:hover {
            opacity: 0.7;
        }

        .cta {
             background: var(--bg-color);
            color: var(--text-color);
            padding: 6px 14px;
            border-radius: 8px;
            font-weight: bold;
        }

       
        .container {
            max-width: 1100px;
            margin: 40px auto;
            padding: 0 20px;
        }

        .title {
            font-size: 2.4em;
            font-weight: bold;
            text-align: center;
            margin-bottom: 10px;
        }

        .subtitle {
            text-align: center;
            font-size: 1.15em;
           color: var(--text-color);
            margin-bottom: 40px;
        }

 
        .section-title {
            font-size: 1.9em;
            margin-bottom: 15px;
            color: #00c6ff;
        }

        .section-subtitle {
            color: #555;
            margin-bottom: 25px;
        }

       
        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 25px;
        }

        .card {
            background: var(--bg-color);
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(136, 134, 134, 0.12);
            transition: 0.25s;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 18px rgba(0,0,0,0.2);
        }

        .card-img {
            width: 100%;
            height: 185px;
            object-fit: cover;
        }

        .card-body {
            padding: 18px;
        }

        .card-title {
            font-size: 1.25em;
            margin-bottom: 8px;
        }

        .card-text {
            color: var(--text-color);
            margin-bottom: 10px;
        }

        .details {
            margin-left: 18px;
            margin-bottom: 15px;
           color: var(--text-color);
        }

        .btn-info {
            display: inline-block;
            background: #8b5cf6;
            color: white;
            padding: 8px 15px;
            border-radius: 8px;
            text-decoration: none;
            transition: 0.2s;
        }

        .btn-info:hover {
            background: #6f3ee8;
        }

       
        footer {
            background: linear-gradient(to right, var(--blue-1), var(--blue-2));
           color: var(--text-color);
            padding: 18px;
            text-align: center;
            margin-top: 40px;
        }
    </style>
</head>

<body>

    <header>
        <div class="logo">
            <a href="principal.php">MindShare</a>
        </div>
        <nav>
            <a href="../HTML/mindshare.php">Inicio</a>
            <a href="carreras.php" class="cta">Carreras</a>
            <a href="../../Controlador/PHP/cerrar.php" class="cta">Cerrar sesión</a>
        </nav>
    </header>

    <div class="container">

        <h1 class="title">Oferta Académica de la UTCJ</h1>
        <p class="subtitle">Descubre las Ingenierías, Licenciaturas y TSU que ofrece la universidad.</p>

       
        <section>
            <h2 class="section-title">Ingenierías y Licenciaturas (4 Cuatrimestres)</h2>

            <div class="grid">

                <div class="card">
                    <img src="../src/images/iti_utcj.jpg" class="card-img" alt="Software">
                    <div class="card-body">
                        <h3 class="card-title">Ing. en Desarrollo y Gestión de Software</h3>
                        <p class="card-text">Desarrollo web, móvil, bases de datos y sistemas empresariales.</p>
                        <ul class="details">
                            <li>TSU asociado: Tecnologías de la Información</li>
                            <li>Duración: 4 Cuatrimestres</li>
                        </ul>
                        <a href="https://www.utcj.edu.mx/ingenieria-en-tecnologias-de-la-informacion-e-innovacion-digital/" class="btn-info">Detalles</a>
                    </div>
                </div>

                <div class="card">
                    <img src="../src/images/mantenimiento.jpg" class="card-img" alt="Mantenimiento">
                    <div class="card-body">
                        <h3 class="card-title">Ing. en Mantenimiento Industrial</h3>
                        <p class="card-text">Gestión de mantenimiento preventivo y procesos industriales.</p>
                        <ul class="details">
                            <li>TSU asociado: Mantenimiento</li>
                            <li>Duración: 4 Cuatrimestres</li>
                        </ul>
                        <a href="https://www.utcj.edu.mx/ingenieria-enmantenimiento-industrialinge/" class="btn-info">Detalles</a>
                    </div>
                </div>

                <div class="card">
                    <img src="../src/images/mecatronica.jpg" class="card-img" alt="Mecatrónica">
                    <div class="card-body">
                        <h3 class="card-title">Ing. Mecatrónica</h3>
                        <p class="card-text">Robótica, automatización y sistemas de control.</p>
                        <ul class="details">
                            <li>TSU asociado: Mecatrónica</li>
                            <li>Duración: 4 Cuatrimestres</li>
                        </ul>
                        <a href="https://www.utcj.edu.mx/ingenieria-en-mecatronica/" class="btn-info">Detalles</a>
                    </div>
                </div>

                <div class="card">
                    <img src="../src/images/nanotecnologia.jpg" class="card-img" alt="Nanotecnología">
                    <div class="card-body">
                        <h3 class="card-title">Ing. en Nanotecnología</h3>
                        <p class="card-text">Aplicación de materiales y procesos a nanoescala.</p>
                        <ul class="details">
                            <li>TSU asociado: Nanotecnología</li>
                            <li>Duración: 4 Cuatrimestres</li>
                        </ul>
                        <a href="https://www.utcj.edu.mx/ingenieria-en-nanotecnologia/" class="btn-info">Detalles</a>
                    </div>
                </div>

            </div>
        </section>


        <section style="margin-top: 50px;">
            <h2 class="section-title">Técnico Superior Universitario (TSU - 6 Cuatrimestres)</h2>

            <div class="grid">

                <div class="card">
                    <img src="../src/images/tsu_software.jpg" class="card-img" alt="TSU Software">
                    <div class="card-body">
                        <h3 class="card-title">TSU en Desarrollo de Software Multiplataforma</h3>
                        <p class="card-text">Programación web, móvil, bases de datos y arquitectura básica.</p>
                        <ul class="details">
                            <li>Duración: 6 Cuatrimestres</li>
                            <li>Campo laboral: Programador Junior</li>
                        </ul>
                        <a href="https://www.utcj.edu.mx/ingenieria-en-tecnologias-de-la-informacion-e-innovacion-digital/#ver-tsu" class="btn-info">Detalles</a>
                    </div>
                </div>

                <div class="card">
                    <img src="../src/images/tsu_contaduria.jpg" class="card-img" alt="TSU Contaduría">
                    <div class="card-body">
                        <h3 class="card-title">TSU en Contaduría</h3>
                        <p class="card-text">Registros fiscales, contables y elaboración de estados financieros.</p>
                        <ul class="details">
                            <li>Duración: 6 Cuatrimestres</li>
                            <li>Campo laboral: Auxiliar contable</li>
                        </ul>
                        <a href="https://www.utcj.edu.mx/licenciatura-en-contaduria/#ver-tsu" class="btn-info">Detalles</a>
                    </div>
                </div>

            </div>
        </section>

    </div>

    <footer>
        &copy; 2025 MindShare | Información Académica de la UTCJ
    </footer>

</body>
</html>
