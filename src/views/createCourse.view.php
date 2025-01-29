<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../../css/index.css">
</head>
<body>
    <header class="header">

    </header>
    <main>
        <?php include 'partials/menu.view.php'; ?>
        <section class="content__create">
            <header>
                <h1 class="tlt">Nuevo Curso</h1>
            </header>
            <form> 
                <div class="divInput">
                    <p>Nombre<span class="mandatory">*</span></p>
                    <input type="text" placeholder="Nombre" name="name">
                </div>
                <div class="divInput">
                    <p>Grado<span class="mandatory">*</span></p>
                    <select name="degree_id" id="degree_id">
                        <option value=""></option>
                    </select>
                </div>
            </form>
            <div class="form__divBtn">
                <button type="submit" class="secondaryBtn" id="btnCancel">Cancelar</button>
                <button type="submit" class="primaryBtn" id="btnSave">Guardar</button>  
            </div>
        </section>
    </main>
    <script type="module" src="../../js/createCourseView.js"></script>
</body>

</html>