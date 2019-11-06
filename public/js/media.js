$(window).on('load', function () {
    $(".player-container").css("visibility","visible")
});
// document.addEventListener('contextmenu', event => event.preventDefault());

document.addEventListener('keydown', function() {
    if (event.keyCode == 123) {
      location.href="https://www.google.com/";
      return false;
    } else if (event.ctrlKey && event.shiftKey && event.keyCode == 73) {
      location.href="https://www.google.com/";
      return false;
    } else if (event.ctrlKey && event.keyCode == 85) {
      location.href="https://www.google.com/";
      return false;
    }
  }, false);
  
  if (document.addEventListener) {
    document.addEventListener('contextmenu', function(e) {
      e.preventDefault();
    }, false);
  } else {
    document.attachEvent('oncontextmenu', function() {
      window.event.returnValue = false;
    });
}