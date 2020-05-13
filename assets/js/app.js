/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

require('bootstrap');


// any CSS you import will output into a single css file (app.css in this case)
import '../css/app.scss';

// Need jQuery? Install it with "yarn add jquery", then uncomment to import it.
import $ from 'jquery';



// console.log('Hello Webpack Encore! Edit me in assets/js/app.js');



document.addEventListener("DOMContentLoaded", function () {
  "use strict";
 
  var button = document.querySelector("button.validation");
  
  button.addEventListener("click", function (event) {
    var forms = document.getElementsByClassName('needs-validation');

    $('.choixMultiple').each(function(){
      var ok = false;
      $(this).find('input').each(function(){
        if($(this).is(':checked')){
          ok = true;            
        }
      })

      $(this).find('input').each(function(){        
        if(ok === false){          
          $(this).attr("required", true);
        }
        else{
          $(this).attr("required", false);
        }        
      })

    });

    //Loop over them and prevent submission
    var validation = Array.prototype.filter.call(forms, function(form) {        
        if (form.checkValidity() === false) {
          event.preventDefault();
          event.stopPropagation();
          form.classList.add('was-validated');        
        }        
        else
        {
          // if (confirm("Confirmez-vous l'envoi de vos réponses ?"))
          // {      
          //   formulaire.submit();      
          // };
          $('#modalConfirmation').modal('show');      
        }          
    });    
  });

  $("#btnConfirmation").click(function(){
    formulaire.submit();
    $('#modalConfirmation').modal('hide');      
  })
});