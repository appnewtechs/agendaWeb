$(document).ready(function() {
  function clock() {
    var time = new Date();
    var hours = time.getHours();
    var minutes = time.getMinutes();

    document.querySelectorAll('.clock')[0].innerHTML = harold(hours) + ":" + harold(minutes);

      function harold(standIn) {
        if (standIn < 10) {
          standIn = '0' + standIn
        }
        return standIn;
      }
  }

  setInterval(clock, 1000);
});