document.addEventListener("DOMContentLoaded", function () {
  const tiempoRestanteElemento = document.getElementById("tiempo-restante");
  if (tiempoRestanteElemento) {
    let tiempoRestante = parseInt(tiempoRestanteElemento.textContent);

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
});
