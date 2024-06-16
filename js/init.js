(function ($) {
  $(function () {

    $('.sidenav').sidenav();
    $('.parallax').parallax();

  }); // end of document ready
})(jQuery); // end of jQuery name space


document.getElementById('form-contacto').addEventListener('submit', function(event) {
  event.preventDefault();

  let recaptchaResponse = grecaptcha.getResponse();
  if (!recaptchaResponse) {
      alert('Por favor, complete el reCAPTCHA.');
      return;
  }

  let formData = new FormData(this);
  formData.append('g-recaptcha-response', recaptchaResponse);

  fetch('php/process_form.php', {
      method: 'POST',
      body: formData
  }).then(response => response.json())
    .then(data => {
      if (data.success) {
          alert('Formulario enviado exitosamente.');
          // Opcional: limpiar el formulario
          this.reset();
          grecaptcha.reset();  // Resetea el reCAPTCHA
      } else {
          alert('Hubo un problema al enviar el formulario. Inténtelo de nuevo.');
      }
  }).catch(error => {
      console.error('Error:', error);
      alert('Hubo un error al enviar el formulario. Inténtelo de nuevo.');
  });
});
