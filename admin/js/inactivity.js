let timeout;

document.onload = resetTimer;
document.onmousemove = resetTimer;
document.onkeypress = resetTimer;

function resetTimer() {
  clearTimeout(timeout);
  timeout = setTimeout(() => {
    const continuar = confirm(
      "Estás a punto de ser desconectado por inactividad. ¿Deseas continuar?"
    );
    if (continuar) {
      resetTimer(); // Reinicia el temporizador si el usuario confirma
    } else {
      // Enviar solicitud al servidor para destruir la sesión
      fetch("logout.php", { method: "POST" })
        .then(() => {
          alert("Sesión expirada por inactividad.");
          window.location.href = "../admin/login.php";
        })
        .catch((error) => console.error("Error al cerrar sesión:", error));
    }
  }, 300000); // 5 minutos
}
