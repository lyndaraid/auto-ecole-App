$(document).ready(function(){
alert("js");
// adding users 
$(document).on("submit","#addform",function(e) {
   e.preventDefault();
   // ajax 
   $.ajax({
    url: "/auto_école_App/page_admin/gestion%20utilisateur/gestion%20candidat/list%20Utilisateurs/ajax.php", 
    type:"POST",
    dataType:"json",
    data: new FormData(this),
    processData:false,
    contentType:false,
    beforeSend:function () {
        console.log("Waiting.. data is loading");
        
    },
    sucess:function(response){
        console.log(response);
    },
    error:function (request,error) {
        console.log(arguments);
        console.log("error"+ error);
        
    }
   }) 
})






})