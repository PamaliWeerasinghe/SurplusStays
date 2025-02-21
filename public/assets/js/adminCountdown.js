function countDown(exp_date, index) {
  var countDownDate = new Date(exp_date).getTime();
  var x = setInterval(function () {
    var now = new Date().getTime();
    
    var distance = countDownDate - now;
    if(distance>0){
    var days = Math.floor(distance / (1000 * 60 * 60 * 24));
    var hours = Math.floor(
      (distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60)
    );
    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    var seconds = Math.floor((distance % (1000 * 60)) / 1000);

    document.getElementById("days" + index).innerHTML = days;
    document.getElementById("hours" + index).innerHTML = hours;
    document.getElementById("minutes" + index).innerHTML = minutes;
    document.getElementById("seconds" + index).innerHTML = seconds;
    }
  }, 1000);
}
