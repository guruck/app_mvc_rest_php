(function(){
  
  const menuToggle = document.querySelector('.menu-toggle');
  menuToggle.onclick = function (e){
    const body = document.querySelector('body');
    getClassHiden = document.cookie;
    body.classList.toggle('hide-sidebar');
    //body.append("<p>"+getClassHiden+"</p>");
    isHiden = body.classList.value;
    createCookie('menuHide',isHiden,1);
    //sessionStorage.setItem('menuHide', isHiden);
  }

})();

let getClassHiden = sessionStorage.getItem('menuHide');
function createCookie (name, value, days) {
  var expires;
  if (days) {
      var date = new Date();
      date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
      expires = "; expires=" + date.toGMTString();
  }
  else {
      expires = "";
  }
  document.cookie = name + "=" + value + expires + "; path=/; samesite=strict";
  
}

function getCookie(c_name) {
  if (document.cookie.length > 0) {
      c_start = document.cookie.indexOf(c_name + "=");
      if (c_start != -1) {
          c_start = c_start + c_name.length + 1;
          c_end = document.cookie.indexOf(";", c_start);
          if (c_end == -1) {
              c_end = document.cookie.length;
          }
          return unescape(document.cookie.substring(c_start, c_end));
      }
  }
  return "";
}

function activateClock(){
  const activeClock = document.querySelector('[active-clock]');
  if(!activeClock) return;
  
  function addOneSecond(hours, minutes, seconds){
    const d = new Date();
    d.setHours(parseInt(hours));
    d.setMinutes(parseInt(minutes));
    d.setSeconds(parseInt(seconds) + 1);
    const hour = `${d.getHours()}`.padStart(2,0);
    const minute = `${d.getMinutes()}`.padStart(2,0);
    const second = `${d.getSeconds()}`.padStart(2,0);
    return `${hour}:${minute}:${second}`;
  }

  setInterval(function(){
    const parts = activeClock.innerHTML.split(':');
    activeClock.innerHTML = addOneSecond(...parts);
  },1000);

}

activateClock();