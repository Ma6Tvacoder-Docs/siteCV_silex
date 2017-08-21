class SkillModel{
  //this.categories = [];
  constructor ( dataTab ){
    // this.datas = dataTab
    this.categories = [];
    this.skills = []
    console.log(dataTab)

    // PRemier tri des infos pour recup les categories
    for (var index in dataTab) {
      // console.log(dataTab[ index ].categorie);
      var check = $.inArray( dataTab[ index ].categorie, this.categories )
      if( this.categories.length !== 0 && check == -1){
          console.log('CAT : ' + dataTab[ index ].categorie)
          console.log('return : '+check)
          this.categories.push( dataTab[ index ].categorie )
      } else if ( this.categories.length == 0 ){
        this.categories.push( dataTab[ index ].categorie )
      } else {}
    }
    for (var i = 0; i < this.categories.length; i++) {
      this.skills.push({
        header : this.categories[i],
        captions : [],
        values : []
      })
    }
    for (var index in dataTab) {
      for (var j = 0; j < this.skills.length; j++) {
        console.log(this.skills[j])
        if(this.skills[j].header == dataTab[index].categorie){
          this.skills[j].captions.push(dataTab[index].nom)
          this.skills[j].values.push(dataTab[index].valeur)
          console.log('hell')
        }
      }
    }
  }
}


// Récuperation des competences Via ApiController
$(function() {

    $.get('/MicroCMS/web/api/competence', function( data) {

      var datas = {};
      $.each( data, function( key, val ){
        datas[ key ] = val;
      })

      var competences = new SkillModel( datas )
      console.log( competences.skills )
      //process de skill graph pour rendre Autant de graph qu'i y a de champs competences
      for (var i = 0; i < competences.skills.length; i++) {
        var domaine = "#skillGraph" + i;
        var couleur = '#61EDB3'
        // console.log(domaine)
        skillGraph([competences.skills[i]], domaine, couleur)
      }
      // skillGraph([competences.skills[0]], "#competences")
      // skillGraph([competences.skills[1]], "#competences")


    });

});

//
// // console.log( cats )
// console.log('hello')
