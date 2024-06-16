

(function ($) {
  $(function () {

    $('.sidenav').sidenav();
    $('.parallax').parallax();

  }); // end of document ready
})(jQuery); // end of jQuery name space


document.getElementById('form-contacto').addEventListener('submit', function (event) {
  event.preventDefault();

  let recaptchaResponse = grecaptcha.getResponse();
  if (!recaptchaResponse) {
    alert('Por favor, complete el reCAPTCHA.');
    return;
  }

  let formData = new FormData(this);
  formData.append('g-recaptcha-response', recaptchaResponse);

  let timerInterval;
  Swal.fire({
    title: "Enviando formulario...",
    html: "Por favor, espere...",
    timerProgressBar: true,
    didOpen: () => {
      Swal.showLoading();
    },
    willClose: () => {
      clearInterval(timerInterval);
    }
  });

  fetch('php/process_form.php', {
    method: 'POST',
    body: formData
  }).then(response => response.json())
    .then(data => {
      Swal.close();
      if (data.success) {
        // console log a json
        console.log(data);

        // Opcional: limpiar el formulario
        this.reset();
        grecaptcha.reset();  // Resetea el reCAPTCHA
        let container_video = document.querySelector('#video-container');
        // #video-container quitar hide
        container_video.classList.remove('hide');
        // #form-contacto agregar hide
        document.querySelector('#form-contacto').classList.add('hide');
        // agregar <iframe width="853" height="480" src="https://www.youtube.com/embed/7X8II6J-6mU?si=_T3wKWCbvMcZNEuf" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
        container_video.innerHTML = '<iframe width="853" height="480" src="https://www.youtube.com/embed/7X8II6J-6mU?si=_T3wKWCbvMcZNEuf" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>';

      } else {
        Swal.fire({
          icon: 'error',
          title: 'Error',
          text: data.message
        });
      }
    }).catch(error => {
      Swal.close();
      console.error('Error:', error);
      Swal.fire({
        icon: 'error',
        title: 'Error',
        text: 'Ocurrió un error al enviar el formulario. Por favor, intente nuevamente.'
      });
    });
});