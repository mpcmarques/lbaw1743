$(window).on('load',function(){
        $('#signin-admin-modal').modal('show');
    });

window.onclick = function(event) {
  var loginModal = document.getElementById('signin-admin-modal');
    if (event.target == loginModal) {
      window.location.href = '../';
    }
}
