$(function() {
    
    //creer un type permis
    $('#create').on('click', function(e) {
       
         formOrder = $('#formOrder')
        
        if (formOrder[0].checkValidity()) {
            e.preventDefault();
            $.ajax({
                url: 'process.php',
                type: 'post',
                data: formOrder.serialize() + '&action=create',
                success: function(response) {
                    console.log(response)
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
    //récuperer type permis
    getBills();
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

    $('body').on('click','.editBtn',function (e){
        e.preventDefault();
        
        $.ajax({
            url:'process.php',
            type:'post',
            data:{workingId:this.dataset.id},
            success: function(response){
               let billInfo = JSON.parse(response);
               $('#bill_id').val(billInfo.typePermis_id)
               $('#typePermis_nomUpdate').val(billInfo.typePermis_nom);
               $('#typePermis_descriptionUpdate').val(billInfo.typePermis_description);
               $('#typePermis_prixBaseUpdate').val(billInfo.typePermis_prixBase);
            }
        })

    })
    //updateun type permis
    $('#update').on('click', function(e) {
        e.preventDefault();
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
            let informations=JSON.parse(response);
            Swal.fire({
                title: `<strong>Informations du type de permis N° ${informations.typePermis_id}</strong>`,
                icon: 'info',
                html:
                `Nom du type permis : <b>${informations.typePermis_nom}</b> <br> 
                Descripion du type de permis : <b>${informations.typePermis_description} </b> <br>
                Prix de base du type de permis : <b>${informations.typePermis_prixBase} </b> <br> `,
                showCloseButton: true,
                
                confirmButtonText:
                  '<i class="fa fa-thumbs-up"></i> Super!',
                confirmButtonAriaLabel: 'Thumbs up, great!',
               
              })
        }
    })

   })

   $('body').on('click','.deleteBtn',function(e){
    e.preventDefault();
    Swal.fire({
        title: 'vous aller suprimer le type permis numero ' +this.dataset.id+'?',
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
                getBills();
              }
            })
         
        }
      })
   
   })

})



