document.addEventListener("DOMContentLoaded", () => {
  const loadCourses = () => {
    fetch("../admin/api/get_courses.php") // Cambia la ruta aquí si es necesario
      .then((response) => response.json())
      .then((data) => {
        const tableBody = document.getElementById("courses-table");
        tableBody.innerHTML = ""; // Limpia la tabla antes de agregar nuevos datos

        if (data.error) {
          tableBody.innerHTML = `<tr><td colspan="7">${data.error}</td></tr>`;
          return;
        }

        data.forEach((course) => {
          const row = `
                        <tr>
                            <td>${course.nombre}</td>
                            <td>${course.docente}</td>
                            <td>${course.horas} hrs.</td>
                            <td>${course.horario}</td>
                            <td>${course.dias}</td>
                            <td>${course.objetivo}</td>
                            <td>
                                <a href="../landing/inscripcion.php?curso_id=${course.id}" class="btn btn-dark">Inscribirse</a>
                            </td>
                        </tr>
                    `;
          tableBody.innerHTML += row;
        });
      })
      .catch((error) => {
        console.error("Error al cargar los cursos:", error);
      });
  };

  // Cargar los cursos al cargar la página
  loadCourses();

  // Recargar los datos cada 3 segundos
  setInterval(loadCourses, 3000);
});
