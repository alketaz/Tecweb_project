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

function validateForm(){
  title = document.getElementById("titolo_art");
  desc = document.getElementById("descr_art");
  text = document.getElementById("testo_art");

  title.reportValidity();
  desc.reportValidity();
  text.reportValidity();

  if(title.validity.valueMissing){
    title.setCustomValidity('Inserisci un titolo');
    title.reportValidity();
    desc.reportValidity();
    text.reportValidity();
  }

  else if(desc.validity.valueMissing){
    desc.setCustomValidity('Inserisci una descrizione');
    title.reportValidity();
    desc.reportValidity();
    text.reportValidity();
  }

  else if(text.validity.valueMissing){
    text.setCustomValidity('Inserisci il testo');
    title.reportValidity();
    desc.reportValidity();
    text.reportValidity();
  }
  
}

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
