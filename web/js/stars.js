/* ----- les fonctions randoms ----- */
function getRandomArbitrary(min, max) {
  return Math.random() * (max - min) + min;
}

/* ----- fonction de creation des etoiles ----- */
function appendStars(){
  var blur = "filter: blur("+getRandomArbitrary(0,2)+"px);";
  var size = getRandomArbitrary(0, 15)+'px';
  var $etoile = $('<div></div>');
  var topPosition = getRandomArbitrary(0, 100);

  /* processing */
  $etoile = $etoile.addClass("star").append( $("<div></div><div></div>") );

  $etoile.attr("style", "left:  "+getRandomArbitrary(0, 100)+"%;top:"+getRandomArbitrary(0, 100)+"%;width:"+size+";height:"+size+";"+blur);
  $('#etoiles').append( $etoile );
}

/*init Stars*/
function initStars(entier){
  for(var i =0; i< entier ; i++){
  appendStars();
  }
}
initStars(250);
