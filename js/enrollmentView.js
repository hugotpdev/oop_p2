import Common from "./common.js";

document.addEventListener('DOMContentLoaded', () => {
    Common.getListEnrollment( '','',enrollments => {
            if(enrollments.length == 0)
                return;
            createTable(enrollments);

            
    });
});

function createTable(enrollments){
    
    let contentTable = `
            <div class="thead">
                <div class="th">Alumno</div>
                <div class="th">Asginatura</div>
                <div class="th">Fecha</div>
                <div class="th">Gestión</div>
            </div>
        `;

        const subjectIds = enrollments.map( enroll => enroll['subject_id'] );
        const studentIds = enrollments.map( enroll => enroll['student_id'] );

        Common.getListSubject( 'id',subjectIds, subjects => {
            
            const subjectsDictionary = subjects.reduce((acc, subject) => {
                acc[subject.id] = subject;
                return acc;
            }, {});

            Common.getListStudent( 'id' ,studentIds, students => {

                const studentDictionary = students.reduce((acc, student) => {
                    acc[student.id] = student;
                    return acc;
                }, {});
            
                const userIds = students.map( student => student['user_id'] );

                Common.getListUser( 'id', userIds, users => {
                    
                    const userDictionary = users.reduce((acc, user) => {
                        acc[user.id] = user;
                        return acc;
                    }, {});

                    document.querySelector('.table').innerHTML = contentTable;

                    enrollments.forEach( enrollment => {
            
                        contentTable += `
                            <div class="tr">
                                <div class="td">
                                    <p>${userDictionary[studentDictionary[enrollment['student_id']]['user_id']]['first_name']}</p>
                                </div>
                                <div class="td">
                                    <p>${subjectsDictionary[enrollment['subject_id']]['name']}</p>
                                </div>
                                <div class="td"><p>${obtenerAño(enrollment['enrollment_date'])}</p></div>
                                <div class="td">
                                    <button class="btn--action">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-pencil"><path d="M21.174 6.812a1 1 0 0 0-3.986-3.987L3.842 16.174a2 2 0 0 0-.5.83l-1.321 4.352a.5.5 0 0 0 .623.622l4.353-1.32a2 2 0 0 0 .83-.497z"/><path d="m15 5 4 4"/></svg>
                                    </button>
                                    <button class="btn--action delete-btn" id="${enrollment["id"]}">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trash-2"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/><line x1="10" x2="10" y1="11" y2="17"/><line x1="14" x2="14" y1="11" y2="17"/></svg>
                                    </button>
                                </div>
                            </div>    
                        `;
                    });
            
                    document.querySelector('.table').innerHTML = contentTable;
                   
                    const btns = document.querySelectorAll('.delete-btn'); 

            
                    btns.forEach( btn => {
                        btn.addEventListener('click', e => {
                    
                        const id = e.target.closest('.delete-btn').id;
                        deleteEnrollment(id);
                    });
                });   
            });

                
        });
            
    });

}

function deleteEnrollment(id){
        Common.deleteEnrollment(id, () => {
            Common.getListEnrollment( '','',enrollments => {
                if(enrollments.length == 0){
                    document.querySelector('.table').innerHTML = '';
                    return;
                }
                        
                createTable(enrollments);  
            });
        }); 
}      

function obtenerAño(fechaHora) {
    const fecha = new Date(fechaHora);
    return fecha.getFullYear();
}