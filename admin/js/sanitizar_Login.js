document.addEventListener("DOMContentLoaded", function () {
  const tiempoRestanteElemento = document.getElementById("tiempo-restante");
  if (tiempoRestanteElemento) {
    // Sanitizar el contenido inicial del cronómetro
    let tiempoRestante = parseInt(tiempoRestanteElemento.textContent, 10);
    if (isNaN(tiempoRestante) || tiempoRestante < 0) {
      tiempoRestante = 0; // Si no es un número válido, establece el tiempo en 0
    }

    const intervalo = setInterval(() => {
      if (tiempoRestante > 0) {
        tiempoRestante--;
        const minutos = Math.floor(tiempoRestante / 60);
        const segundos = tiempoRestante % 60;
        tiempoRestanteElemento.textContent = `${minutos}:${
          segundos < 10 ? "0" : ""
        }${segundos}`;
      } else {
        clearInterval(intervalo);
        document.getElementById("cronometro").innerHTML =
          '<small class="text-success">Ya puedes intentar nuevamente.</small>';
      }
    }, 1000);
  }

  const form = document.querySelector("form");
  const usuarioInput = document.querySelector("input[name='usuario']");
  const passwordInput = document.querySelector("input[name='password']");

  form.addEventListener("submit", function (event) {
    // Sanitizar el campo de usuario
    usuarioInput.value = usuarioInput.value.replace(/[^a-zA-Z0-9]/g, "");

    // Sanitizar el campo de contraseña (opcional, ya que es sensible)
    passwordInput.value = passwordInput.value.trim();

    // Validar que los campos no estén vacíos
    if (!usuarioInput.value || !passwordInput.value) {
      event.preventDefault();
      alert("Por favor, completa todos los campos correctamente.");
    }
  });
});
