<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Porfolio</title>
</head>
<body>
    <header>
        <h1>Manejador de Porfolios</h1>
        <p>Bienvenido a la aplicación de manejo de porfolios, <?php echo $data["usuario"]; ?></p>
    </header>
    <nav>
        <ul>
            <li><a href="#">Home</a></li>
            <li><a href="#">Log Out</a></li>
        </ul>
    </nav>
    <main>
        <h2>Porfolio</h2>
        <?php
        echo "<h3>{$data['porfolio']['titulo']}</h3>";

        echo "<div>";
            echo "<h4>Experiencia de trabajo</h4>";
            echo "<a href='/agregar/trabajo'>Añadir</a>";
            foreach ($data["porfolio"]["trabajos"] as $trabajo) {
                echo "<div>";
                    echo "<h5>{$trabajo['titulo']}</h5>";
                    echo "<p>{$trabajo['descripcion']}</p>";
                    echo "<p>{$trabajo['fecha_inicio']} - {$trabajo['fecha_fin']}</p>";
                    echo "<p>Logros: " . $trabajo['logo'] . "</p>";
                    echo "<a href='/edit/trabajo/{$trabajo['id']}'>Editar</a>";
                    echo "<a href='/delete/trabajo/{$trabajo['id']}'>Eliminar</a>";
                echo "</div>";
            }
        echo "</div>";
        echo "<div>";
            echo "<h4>Proyectos</h4>";
            echo "<a href='/agregar/proyecto'>Añadir</a>";
            foreach ($data["porfolio"]["proyectos"] as $proyecto) {
                echo "<div>";
                    echo "<h5>{$proyecto['titulo']}</h5>";
                    echo "<p>{$proyecto['descripcion']}</p>";
                    echo "<p>{$proyecto['tecnologias']}</p>";
                    echo "<a href='/edit/proyecto/{$proyecto['id']}'>Editar</a>";
                    echo "<a href='/delete/proyecto/{$proyecto['id']}'>Eliminar</a>";
                echo "</div>";
            }
        echo "</div>";
        echo "<div>";
            echo "<h4>Skills</h4>";
            echo "<a href='/agregar/skill'>Añadir</a>";
            foreach ($data["porfolio"]["skills"] as $skill) {
                echo "<div>";
                    echo "<h5>{$skill['nombre']}</h5>";
                    echo "<a href='/edit/skill/{$skill['id']}'>Editar</a>";
                    echo "<a href='/delete/skill/{$skill['id']}'>Eliminar</a>";
                echo "</div>";
            }
        echo "</div>";
        echo "<div>";
            echo "<h4>Redes Sociales</h4>";
            echo "<a href='/agregar/redesSociales'>Añadir</a>";
            foreach ($data["porfolio"]["redes"] as $red) {
                echo "<div>";
                    echo "<h5>{$red['nombre']}</h5>";
                    echo "<a href='/edit/redesSociales/{$red['id']}'>Editar</a>";
                    echo "<a href='/delete/redesSociales/{$red['id']}'>Eliminar</a>";
                echo "</div>";
            }
        echo "</div>";
        ?>
    </main>
</body>
</html>