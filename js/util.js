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