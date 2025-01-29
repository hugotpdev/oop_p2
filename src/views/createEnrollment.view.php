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
                <h1 class="tlt">Nueva Inscripcion</h1>
            </header>
            <form action=""> 
                <div class="divInput">
                    <p>Estudiantes<span class="mandatory">*</span></p>
                    <select name="student_id" id="student_id">
                        <option value=""></option>
                    </select>
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
    <script type="module" src="../../js/createEnrollmentView.js"></script>
</body>

</html>