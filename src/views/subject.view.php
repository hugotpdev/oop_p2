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
        <section class="content">
            <header>
                <h1 class="tlt">Listado de asignaturas</h1>
                <a href="createSubject" class="header__btn">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-user-plus"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><line x1="19" x2="19" y1="8" y2="14"/><line x1="22" x2="16" y1="11" y2="11"/></svg>
                    <p>Nueva asignatura</p>
                </a>
            </header>
            <div class="table">          
            </div>
        </section>
    </main>
    <script type="module" src="../../js/subjectView.js"></script>
</body>
</html>