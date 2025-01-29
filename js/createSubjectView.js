import Common from "./common.js";

const btnCancel = document.querySelector('#btnCancel');
const btnSave = document.querySelector('#btnSave');
const course_id = document.querySelector('#course_id');
const inputs = document.querySelectorAll('input');

btnCancel.addEventListener('click', () => window.location.href = '/subject');

document.addEventListener('DOMContentLoaded', () => {
    Common.getListCourse( '','',courses => {
        courses.forEach( course => {
            const option = document.createElement('OPTION');
            option.textContent = course['name'];
            option.value = course['id'];
            course_id.appendChild(option);
        })
    })
})

btnSave.addEventListener('click', () => {
    
    const data = {};

    inputs.forEach(input => {
        const name = input.name;
        if (!regularExp[name].test(input.value.trim())) 
            input.classList.add('input-error');
        else
            data[name] = input.value;

    });

    if(course_id.value == '')
        course_id.classList.add('input-error');
    else
        data['course_id'] = course_id.value;

    if(document.querySelector('.input-error'))
        return;

    Common.setSubject(data, () => {
        window.location.href = '/subject';
    });
});

inputs.forEach( input => {
    input.addEventListener('input', e => {
        let name = e.target.name;
        if(regularExp[name].test(e.target.value.trim()))
            e.target.classList.remove('input-error');
        else
            e.target.classList.add('input-error');
    })
});

course_id.addEventListener('change', e => {
    if(course_id.value != '')
        course_id.classList.remove('input-error');
    else
    course_id.classList.add('input-error');
})

const regularExp = {
    name: /^[A-Za-zÁÉÍÓÚÑáéíóúñü\s]{1,50}$/, // Nombre: admite letras (mayúsculas o minúsculas), espacios, y caracteres especiales como tildes y ñ.
};
    