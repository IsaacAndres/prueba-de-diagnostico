<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de votación</title>

    <link rel="stylesheet" href="src/css/style.css">
</head>
<body>
    <h1>FORMULARIO DE VOTACIÓN</h1>
    <form id="votar-form">
        <fieldset>
            <label for="nombre">Nombre y Apellido</label>
            <input type="text" name="nombre" id="nombre" required>
        </fieldset>
        <fieldset>
            <label for="alias">Alias</label>
            <input type="text" name="alias" id="alias" required>
        </fieldset>
        <fieldset>
            <label for="rut">RUT</label>
            <input type="text" name="rut" id="rut" required>
        </fieldset>
        <fieldset>
            <label for="email">Email</label>
            <input type="email" name="email" id="email" required>
        </fieldset>
        <fieldset>
            <label for="region">Región</label>
            <select name="region" id="region" required>
                <option value="">- Seleccione -</option>
                <?php foreach ($regiones as $region): ?>
                    <option value="<?= $region['id'] ?>">
                        <?= $region['nombre'] ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </fieldset>
        <fieldset>
            <label for="comuna">Comuna</label>
            <select name="comuna" id="comuna" required>
                <option value="">- Seleccione -</option>
            </select>
        </fieldset>
        <fieldset>
            <label for="candidato">Candidato</label>
            <select name="candidato" id="candidato" required>
                <option value="">- Seleccione -</option>
                <?php foreach ($candidatos as $candidato): ?>
                    <option value="<?= $candidato['id'] ?>">
                        <?= $candidato['nombre'] ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </fieldset>
        <fieldset>
            <label for="como">Como se enteró de Nosotros</label>
            <input type="checkbox" name="como[]" value="Web"> Web
            <input type="checkbox" name="como[]" value="TV"> TV
            <input type="checkbox" name="como[]" value="Redes Sociales"> Redes Sociales
            <input type="checkbox" name="como[]" value="Amigo"> Amigo
        </fieldset>
        <fieldset>
            <button type="submit">Votar</button>
        </fieldset>
    </form>
    <script src="/src/js/scripts.js"></script>
</body>
</html>