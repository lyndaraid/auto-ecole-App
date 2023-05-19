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
// Vérifier si le paramètre 'success' est présent dans l'URL
if (isset($_GET['success'])) {
  // Récupérer la valeur du paramètre 'success'
  $successMessage = $_GET['success'];
  // Échapper les caractères spéciaux pour éviter les problèmes de sécurité
  $successMessage = htmlspecialchars($successMessage);
?>