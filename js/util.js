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
<<<<<<< HEAD
=======

//Get the button:
mybutton = document.getElementById("myBtn");

// When the user scrolls down 20px from the top of the document, show the button
window.onscroll = function() {scrollFunction()};

function scrollFunction() {
  if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
    mybutton.style.display = "block";
  } else {
    mybutton.style.display = "none";
  }
}

// When the user clicks on the button, scroll to the top of the document
function topFunction() {
  document.body.scrollTop = 0; // For Safari
  document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
}
>>>>>>> 8a35190051594b70729e2e45d2f077c6c04a3019
