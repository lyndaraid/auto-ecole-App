$(function() {
  
    $('table').DataTable();

    function getBills(){
      $.ajax({
          url:'process.php',
          type:'post',
          data:{action:'fetch'},
          success: function(response){
              $('#orderTable').html(response);
              $('table').DataTable();
          }
      })
  }
  getBills();

    $('#create').on('click', function(e) {
       
        formOrder = $('#formOrder')
        
       if (formOrder[0].checkValidity()) {
           
           e.preventDefault();
           $.ajax({
               url: 'process.php',
               type: 'post',
               data: formOrder.serialize() + '&action=createFacturee',
               success: function(response) {
                console.log(response);
                 $('#createModal').modal('hide');
                  Swal.fire({
                   icon: 'success',
                   title: 'Succès',
                   })
                 formOrder[0].reset();
                 getBills()
           }
       })
      } 
   })
 
   $('#create').on('click', function(e) {
       
    formOrder = $('#formOrder')
    
   if (formOrder[0].checkValidity()) {
       
       e.preventDefault();
       $.ajax({
           url: 'process.php',
           type: 'post',
           data: formOrder.serialize() + '&action=addPaiment',
           success: function(response) {
            console.log(response);
             $('#createModal').modal('hide');
              Swal.fire({
               icon: 'success',
               title: 'Succès',
               })
             formOrder[0].reset();
             getBills()
       }
   })
  } 
})

$('body').on('click','.editBtn',function (e){
  e.preventDefault();
  console.log('body click btn')
  $.ajax({
      url:'process.php',
      type:'post',
      data:{workingId:this.dataset.id},
      success: function(response){
        console.log(response)
         let billInfo = JSON.parse(response);
         $('#bill_id').val(billInfo.paiemnt_id)
         $('#facture_montant_payeUpdate').val(billInfo.facture_montant_paye);
         $('#candidat_nomUpdate').val(billInfo.candidat_nom);
         $('#facture_montant_totalUpdate').val(billInfo.facture_montant_total);
         $('#facture_statusUpdate').val(billInfo.facture_status);
         $('#candidat_prenomUpdate').val(billInfo.candidat_prenom);
         $('#facture_emissionUpdate').val(billInfo.facture_montant_paye);
         $('#typePermis_nomUpdate').val(billInfo.typePermis_nom);
         $('#modePaiement_nomUpdate').val(billInfo.modePaiement_nom);

      }
  })

})
//updateun type permis
$('#update').on('click', function(e) {
  e.preventDefault();
  console.log("update click")
  formOrder = $('#formUpdateOrder');
  
 if (formOrder[0].checkValidity()) {
     console.log('aaaaaaaaaaa');
     e.preventDefault();
     $.ajax({
         url: 'process.php',
         type: 'post',
         data: formOrder.serialize() + '&action=update',
         success: function(response) {
          console.log(response)
         $('#updateModal').modal('hide');
             Swal.fire({
             icon: 'success',
             title: 'Succès',
           })
           formOrder[0].reset();
           getBills()
     }
 })
}
 
})
  $('body').on('click','.infoBtn',function(e){
    e.preventDefault();
    $.ajax({
        url:'process.php',
        type:'post',
        data:{informationId:this.dataset.id},
        success: function(response){
            console.log(response);
            let informations=JSON.parse(response);
            Swal.fire({
                title: `<strong>Informations du paiment  N° ${informations.paiemnt_id}</strong>`,
                icon: 'info',
                html:
                `Nom du candidat : <b>${informations.candidat_nom}</b> <br> 
                Prénom du candidat : <b>${informations.candidat_prenom} </b> <br>
                Mode de paiement choisis : <b>${informations.modePaiemnt_nom} </b> <br> 
                Type du permis : <b>${informations.typePermis_nom} </b> <br>
                Montant total : <b>${informations.facture_montant_total} </b> <br> 
                Montant payee : <b>${informations.facture_montant_paye} </b> <br> 
                Etat du paiement : <b>${informations.facture_status} </b> <br>`,
                showCloseButton: true,
                
                confirmButtonText:
                  '<i class="fa fa-thumbs-up"></i> Super!',
                confirmButtonAriaLabel: 'Thumbs up, great!',
               
              })
        }
    })

   })

  $('body').on('click','.deleteBtn',function(e){
    Swal.fire({
        title: 'vous aller suprimer le paiment numero ' +this.dataset.id+'?',
        text: "Cette action est irreversible",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#30885d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'oui ,j\'en suis sûr!'
      }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
              url:'process.php',
              type:'post',
              data:{deletionId:this.dataset.id},
              success:function(response){
                console.log(response)
                if(response === 1){
                    Swal.fire(
                        'Supression!',
                        'Opperation réussie',
                        'success'
                      )
                      
                }
                getBills()
              }
            })
         
        }
      })
   
   })
})


   
