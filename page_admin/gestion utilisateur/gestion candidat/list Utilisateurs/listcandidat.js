const inputs = document.querySelectorAll('.form-control');

inputs.forEach(input => {
  input.addEventListener('blur', function() {
    if (input.checkValidity()) {
      input.classList.add('is-valid');
      input.classList.remove('is-invalid');
    } else {
      input.classList.add('is-invalid');
      input.classList.remove('is-valid');
    }
  });
});

// Récupère tous les inputs de votre formulaire
var lesinputs = document.querySelectorAll('input');

// Boucle sur tous les inputs pour ajouter l'événement "blur"
for (var i = 0; i < lesinputs.length; i++) {
  lesinputs[i].addEventListener('blur', function(event) {
    // Vérifie la validité de la valeur saisie
    if (!this.checkValidity()) {
      // Si la valeur n'est pas valide, ajoute la classe "is-invalid"
      this.classList.add('is-invalid');
    } else {
      // Si la valeur est valide, supprime la classe "is-invalid"
      this.classList.remove('is-invalid');
    }
  });
}

function motPASS_Affichage(){
  var motPass =document.getElementById("password");
  var eye =document.getElementById("hide1");
  var eyeSlash=document.getElementById("hide2");

if (motPass.type ==='password') {
  motPass.type = 'text'
  eye.style.display = "block" ;
   eyeSlash.style.display = "none";
  
} else {
  motPass.type = 'password';
  eye.style.display = "none" ;
  eyeSlash.style.display = "block";
  
}



}
function motPASS_confirme(){
  //  pour deuxième champ de mot passe
  var confirmPassword=document.getElementById("password-confirm");
  var eye3 =document.getElementById("hide3");
  var eyeSlash4=document.getElementById("hide4");

  if (confirmPassword.type ==='password') {
      confirmPassword.type = 'text'
      eye3.style.display = "block" ;
       eyeSlash4.style.display = "none";
      
    } else {
      confirmPassword.type = 'password';
      eye3.style.display = "none" ;
      eyeSlash4.style.display = "block";
      
    }
}


function checkpassword(){
  var motPasse =document.getElementById("password");
  var confirmPassword=document.getElementById("password-confirm");
  var message =document.getElementById("message-confirm");
  var submitButton = document.getElementById("submit-button");

if (motPasse.length != 0) {
  if (motPasse.value === confirmPassword.value) {
     message.textContent ="les mots passe correspondent" 
  //    message.style.backgroundColor="#3ae374"
     message.className ="alert alert-success"
     submitButton.disabled = false;
     submitButton.style.backgroundColor = "";
  } else{
      message.textContent ="mots passe non identiques"  
      message.className ="alert alert-warning " 
      // message.style.backgroundColor="#ff4d4d"
      submitButton.disabled = true;
      submitButton.className="btn btn-secondary";
  } 
   // Ajoutez un écouteur d'événement "click" pour le bouton de soumission
   confirmPassword.addEventListener("click", function() {
      message.textContent =""  
      message.className ="" 
      // message.style.backgroundColor="#ff4d4d"
      submitButton.disabled = false;
      submitButton.className="btn btn-primary";
      
    });
    
}else{
  alert("mot de passe ne peut pas etre vide ")
  message.textContent ="mots passe non identiques" 
}
  
}
var image_added = false;

function display_image(file) {
    var img = document.querySelector(".js-image");
    img.src = URL.createObjectURL(file);

    image_added = true;
}