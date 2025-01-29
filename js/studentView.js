import Common from "./common.js";

document.addEventListener('DOMContentLoaded', () => {
    Common.getListStudent( '','',students => {
        if(students.length == 0)
            return;
        const studentIds = students.map( student => student['user_id'] );
       
        
        Common.getListUser('id', studentIds, users => {
            const usersDictionary = users.reduce((acc, user) => {
                acc[user.id] = user;
                return acc;
            }, {});
            
            createTable(students, usersDictionary);

            const btns = document.querySelectorAll('.delete-btn'); 
            const allBtnEnroll = document.querySelectorAll('.id-enrollment');
            
            btns.forEach( btn => {
                btn.addEventListener('click', e => {
                    const id = e.target.closest('.delete-btn').id;
                    deleteStudent(id);
                });
            });

            allBtnEnroll.forEach( btn => {
                btn.addEventListener('click', e => {
                    createModal(e.target.closest('button').id);
                })
            })
        });      
    })
});

function createTable(students, users){
    let contentTable = `
            <div class="thead">
                <div class="th">Alumno</div>
                <div class="th">Inscripción</div>
                <div class="th">Asignaturas</div>
                <div class="th">Gestión</div>
            </div>
        `;

        document.querySelector('.table').innerHTML = contentTable;
        
        students.forEach( student => {
            const user_id = student['user_id']; 
            contentTable += `
                <div class="tr">
                    <div class="td">
                        <p>${users[user_id]["last_name"]}, ${users[user_id]["first_name"]}</p>
                    </div>
                    <div class="td">${obtenerAño(users[user_id]["created_at"])}</div>
                    <div class="td">
                        <button class="btn--action id-enrollment" id="${student["id"]}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-book"><path d="M4 19.5v-15A2.5 2.5 0 0 1 6.5 2H19a1 1 0 0 1 1 1v18a1 1 0 0 1-1 1H6.5a1 1 0 0 1 0-5H20"/></svg>
                        </button>
                    </div>
                    <div class="td">
                        <button class="btn--action">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-pencil"><path d="M21.174 6.812a1 1 0 0 0-3.986-3.987L3.842 16.174a2 2 0 0 0-.5.83l-1.321 4.352a.5.5 0 0 0 .623.622l4.353-1.32a2 2 0 0 0 .83-.497z"/><path d="m15 5 4 4"/></svg>
                        </button>
                        <button class="btn--action delete-btn" id="${student["id"]}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trash-2"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/><line x1="10" x2="10" y1="11" y2="17"/><line x1="14" x2="14" y1="11" y2="17"/></svg>
                        </button>
                    </div>
                </div>    
            `;
        });

        document.querySelector('.table').innerHTML = contentTable;
}

function deleteStudent(id){
        Common.deleteStudent(id, () => {
            Common.getListStudent( '', '',students => {
                if(students.length == 0){
                    document.querySelector('.table').innerHTML = '';
                    return;
                }
                const studentIds = students.map( student => student['user_id'] );
               
                Common.getListUser('id', studentIds, users => {
                    const usersDictionary = users.reduce((acc, user) => {
                        acc[user.id] = user;
                        return acc;
                    }, {});
                    
                    createTable(students, usersDictionary);
        
                    const btns = document.querySelectorAll('.delete-btn'); 
                    const allBtnEnroll = document.querySelectorAll('.id-enrollment');
                    
                    btns.forEach( btn => {
                        btn.addEventListener('click', e => {
                            const id = e.target.closest('.delete-btn').id;
                            deleteStudent(id);
                        });
                    });
        
                    allBtnEnroll.forEach( btn => {
                        btn.addEventListener('click', e => {
                            createModal(e.target.closest('button').id);
                        })
                    })
                });      
            })
        }); 
}      
       
     
        function createModal(id){
            const fondo = document.createElement('DIV');
            fondo.classList.add('fondoModal');

            Common.getListEnrollment('student_id',id, enrollments => {
                
                if(enrollments.length == 0)
                    return;
                // Decir que no tiene ninguna asignatura
                
                const enrollmentsIds = enrollments.map( enroll => enroll['subject_id'] );
                
                Common.getListSubject('id', enrollmentsIds, subjects => {
                    
                    let content = '';
  
                    subjects.forEach( subject => {
                        content += `
                        <li>
                            ${subject['name']}
                        </li>
                    `;
                    });

                    fondo.innerHTML = `
                        <div class="modal">
                            <h1>Asignaturas</h1>
                            <ul>
                                ${content}
                            </ul>
                            <div>
                                <button id="btnCloseModal">Cerrar</button>
                            </div>
                        </div>
                    `;
                    

                    const btn = fondo.querySelector('#btnCloseModal');
                    btn.addEventListener('click', () => {
                        fondo.remove()
                    });

                    document.body.appendChild(fondo);
                })
            });
        }

        function obtenerAño(fechaHora) {
            const fecha = new Date(fechaHora);
            return fecha.getFullYear();
        }