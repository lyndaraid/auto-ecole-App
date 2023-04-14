function motPASS_Affichage(){
    var x =document.getElementById("password");
    var y =document.getElementById("hide1");
    var z=document.getElementById("hide2");
  if (x.type ==='password') {
    x.type = 'text'
    y.style.display = "block" ;
     z.style.display = "none";
    
  } else {
    x.type = 'password';
    y.style.display = "none" ;
    z.style.display = "block";
    
  }

}
 function remembre_fonction(){
    var e =document.getElementById("email").value;
    var   p=document.getElementById("password").value;
document.cookie="myusername="+e+";paath=http://localhost/web6pm/";

 }
