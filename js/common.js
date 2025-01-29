export default class Common {

    /* STUDENT */
    static getStudent(field, value, cb) {
        fetch(`/getStudent?field=${field}&value=${value}`, {
            method: 'GET',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
        })
        .then(response => response.json())
        .then(data => {
            cb && cb(data);
        })
        .catch(error => {
            console.error('Error:', error);
        });
    }

    static getListStudent(field, value,cb) {
        fetch(`/getListStudent?field=${field}&value=${value}`, {
            method: 'GET',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
        })
        .then(response => response.json())
        .then(data => {
            cb && cb(data);
        })
        .catch(error => {
            console.error('Error:', error);
        });
    }

    static setStudent(newStudent, cb) {
        fetch('/setStudent', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: new URLSearchParams(newStudent).toString()
        })
        .then(response => response.json())
        .then(data => {
            cb && cb(data);
        })
        .catch(error => {
            console.error('Error:', error);
        });
    }

    static deleteStudent(id, cb) {
        fetch(`/deleteStudent?id=${id}`, {
            method: 'DELETE',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
        })
        .then(response => response.json())
        .then(data => {
            cb && cb(data);
        })
        .catch(error => {
            console.error('Error:', error);
        });
    }

    /* USER */
    static getUser(field, value, cb) {
        fetch(`/getUser?field=${field}&value=${value}`, {
            method: 'GET',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
        })
        .then(response => response.json())
        .then(data => {
            cb && cb(data);
        })
        .catch(error => {
            console.error('Error:', error);
        });
    }

    static getListUser(field, value, cb) {
        fetch(`/getListUser?field=${field}&value=${value}`, {
            method: 'GET',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
        })
        .then(response => response.json())
        .then(data => {
            cb && cb(data);
        })
        .catch(error => {
            console.error('Error:', error);
        });
    }

    /* DREGREE*/

    static getListDegree(field, value,cb) {
        fetch(`/getListDegree?field=${field}&value=${value}`, {
            method: 'GET',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
        })
        .then(response => response.json())
        .then(data => {
            cb && cb(data);
        })
        .catch(error => {
            console.error('Error:', error);
        });
    }

    static setDegree(newDegree, cb) {
        fetch('/setDegree', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: new URLSearchParams(newDegree).toString()
        })
        .then(response => response.json())
        .then(data => {
            cb && cb(data);
        })
        .catch(error => {
            console.error('Error:', error);
        });
    }

    static deleteDegree(id, cb) {
        fetch(`/deleteDegree?id=${id}`, {
            method: 'DELETE',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
        })
        .then(response => response.json())
        .then(data => {
            cb && cb(data);
        })
        .catch(error => {
            console.error('Error:', error);
        });
    }

    /* ENROLLMENT */

    static getEnrollment(field, value, cb) {
        fetch(`/getEnrollment?field=${field}&value=${value}`, {
            method: 'GET',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
        })
        .then(response => response.json())
        .then(data => {
            cb && cb(data);
        })
        .catch(error => {
            console.error('Error:', error);
        });
    }


    static getListEnrollment(field, value, cb) {
        fetch(`/getListEnrollment?field=${field}&value=${value}`, {
            method: 'GET',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
        })
        .then(response => response.json())
        .then(data => {
            cb && cb(data);
        })
        .catch(error => {
            console.error('Error:', error);
        });
    }

    static setEnrollment(newEnrollment, cb) {
        fetch('/setEnrollment', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: new URLSearchParams(newEnrollment).toString()
        })
        .then(response => response.json())
        .then(data => {
            cb && cb(data);
        })
        .catch(error => {
            console.error('Hola:', error);
        });
    }

    static deleteEnrollment(id, cb) {
        fetch(`/deleteEnrollment?id=${id}`, {
            method: 'DELETE',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
        })
        .then(response => response.json())
        .then(data => {
            cb && cb(data);
        })
        .catch(error => {
            console.error('Error:', error);
        });
    }

    /* SUBJECT */

    static getListSubject(field, value, cb) {
        fetch(`/getListSubject?field=${field}&value=${value}`, {
            method: 'GET',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
        })
        .then(response => response.json())
        .then(data => {
            cb && cb(data);
        })
        .catch(error => {
            console.error('Error:', error);
        });
    }

    static setSubject(newSubject, cb) {
        fetch('/setSubject', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: new URLSearchParams(newSubject).toString()
        })
        .then(response => response.json())
        .then(data => {
            cb && cb(data);
        })
        .catch(error => {
            console.error('Error:', error);
        });
    }

    static deleteSubject(id, cb) {
        fetch(`/deleteSubject?id=${id}`, {
            method: 'DELETE',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
        })
        .then(response => response.json())
        .then(data => {
            cb && cb(data);
        })
        .catch(error => {
            console.error('Error:', error);
        });
    }


/* COURSES */

    static getListCourse(field, value, cb) {
        fetch(`/getListCourse?field=${field}&value=${value}`, {
            method: 'GET',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
        })
        .then(response => response.json())
        .then(data => {
            cb && cb(data);
        })
        .catch(error => {
            console.error('Error:', error);
        });
    }

    static setCourse(newCourse, cb) {
        fetch('/setCourse', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: new URLSearchParams(newCourse).toString()
        })
        .then(response => response.json())
        .then(data => {
            cb && cb(data);
        })
        .catch(error => {
            console.error('Error:', error);
        });
    }

    static deleteCourse(id, cb) {
        fetch(`/deleteCourse?id=${id}`, {
            method: 'DELETE',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
        })
        .then(response => response.json())
        .then(data => {
            cb && cb(data);
        })
        .catch(error => {
            console.error('Error:', error);
        });
    }


    /* DEPARTMENTS */

    static getListDepartment(field, value, cb) {
        fetch(`/getListDepartment?field=${field}&value=${value}`, {
            method: 'GET',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
        })
        .then(response => response.json())
        .then(data => {
            cb && cb(data);
        })
        .catch(error => {
            console.error('Error:', error);
        });
    }

    static setDepartment(newDepartment, cb) {
        fetch('/setDepartment', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: new URLSearchParams(newDepartment).toString()
        })
        .then(response => response.json())
        .then(data => {
            cb && cb(data);
        })
        .catch(error => {
            console.error('Error:', error);
        });
    }

    static deleteDepartment(id, cb) {
        fetch(`/deleteDepartment?id=${id}`, {
            method: 'DELETE',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
        })
        .then(response => response.json())
        .then(data => {
            cb && cb(data);
        })
        .catch(error => {
            console.error('Error:', error);
        });
    }

    /* TEACHERS */

    static getListTeacher(field, value, cb) {
        fetch(`/getListTeacher?field=${field}&value=${value}`, {
            method: 'GET',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
        })
        .then(response => response.json())
        .then(data => {
            cb && cb(data);
        })
        .catch(error => {
            console.error('Error:', error);
        });
    }

    static setTeacher(newTeacher, cb) {
        fetch('/setTeacher', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: new URLSearchParams(newTeacher).toString()
        })
        .then(response => response.json())
        .then(data => {
            cb && cb(data);
        })
        .catch(error => {
            console.error('Error:', error);
        });
    }

    static deleteTeacher(id, cb) {
        fetch(`/deleteTeacher?id=${id}`, {
            method: 'DELETE',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
        })
        .then(response => response.json())
        .then(data => {
            cb && cb(data);
        })
        .catch(error => {
            console.error('Error:', error);
        });
    }

    /* EXAM */
    static getExam(field, value, cb) {
        fetch(`/getExam?field=${field}&value=${value}`, {
            method: 'GET',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
        })
        .then(response => response.json())
        .then(data => {
            cb && cb(data);
        })
        .catch(error => {
            console.error('Error:', error);
        });
    }

    static getListExam(field, value,cb) {
        fetch(`/getListExam?field=${field}&value=${value}`, {
            method: 'GET',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
        })
        .then(response => response.json())
        .then(data => {
            cb && cb(data);
        })
        .catch(error => {
            console.error('Error:', error);
        });
    }

    static setExam(newExam, cb) {
        fetch('/setExam', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: new URLSearchParams(newExam).toString()
        })
        .then(response => response.json())
        .then(data => {
            cb && cb(data);
        })
        .catch(error => {
            console.error('Error:', error);
        });
    }

    static deleteExam(id, cb) {
        fetch(`/deleteExam?id=${id}`, {
            method: 'DELETE',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
        })
        .then(response => response.json())
        .then(data => {
            cb && cb(data);
        })
        .catch(error => {
            console.error('Error:', error);
        });
    }
}

