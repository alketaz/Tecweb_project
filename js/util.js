// mostra menu da mobile
function menuToggle() {
  var x = document.getElementById("hd");
  if (x.className === "mob_nav") {
    x.className += " responsive";
  } else {
    x.className = "mob_nav";
  }
}

// mostra barra di ricerca da mobile
function searchToggle() {
  var x = document.getElementById("search_mobile");
  if (x.className === "mob_srch"){
    x.className += " resp_srch";
  } else {
    x.className = "mob_srch";
  }
}

// funzioni estetiche, se JS non funziona gli elementi interessati funzionano comunque come si deve
window.onload = function() {hideBtn()};
window.onscroll = function() {scrollFunction()};

function scrollFunction() {
  mybutton = document.getElementById("myBtn");
  if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
    mybutton.style.display = "block";
  } else {
    mybutton.style.display = "none";
  }
}

function hideBtn(){
  document.getElementById("myBtn").style.display = "none";
}

function topFunction() {
  document.body.scrollTop = 0; // For Safari
  document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
}
