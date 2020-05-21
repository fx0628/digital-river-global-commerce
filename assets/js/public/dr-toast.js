// Reference: https://www.w3schools.com/howto/howto_js_snackbar.asp
const drToast = (($) => {
  return {
    displayMessage: (msg, type = '') => {
      let offsetLeft = 0;
      let $toast = $(`<div class="dr-toast">${msg}</div>`);

      $('body').append($toast);
      offsetLeft = ($('body').width() - $toast.innerWidth()) / 2;
      $toast.css('left', offsetLeft).addClass(`show ${type}`);

      setTimeout(() => {
        $toast.removeClass('show').remove();
      }, 8000);
    }
  };
})(jQuery);

export default drToast;
