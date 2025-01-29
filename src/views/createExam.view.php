<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/index.css">
</head>
<body>
    <header class="header">

    </header>
    <main>
        <?php include 'partials/menu.view.php'; ?>
        <section class="content__create">
            <header>
                <h1 class="tlt">Nuevo examen</h1>
            </header>
            <form action=""> 
                <div class="divInput">
                    <p>Descripcion<span class="mandatory">*</span></p>
                    <input type="text" placeholder="Descripcion" name="description">
                </div>
                <div class="divInput">
                    <p>Fecha y Hora<span class="mandatory">*</span></p>
                    <input type="datetime-local" name="exam_date" required>
                </div>
                <div class="divInput">
                    <p>Cursos<span class="mandatory">*</span></p>
                    <select name="course_id" id="course_id">
                        <option value=""></option>
                    </select>
                </div>
                <div class="divInput">
                    <p>Asignaturas<span class="mandatory">*</span></p>
                    <select name="subject_id" id="subject_id">
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
    <script type="module" src="../../js/createExamView.js"></script>
</body>

</html>