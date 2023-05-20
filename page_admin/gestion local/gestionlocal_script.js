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
               $('#bill_id').val(billInfo.local_id)
               $('#local_nomUpdate').val(billInfo.local_nom);
               $('#local_adresseUpdate').val(billInfo.local_adresse);
               $('#local_capaciteUpdate').val(billInfo.local_capacite);
               $('#local_typeUpdate').val(billInfo.local_type);

            }
        })

    })
//     //updateun type permis
    $('#update').on('click', function(e) {
        e.preventDefault();
        console.log("edouuuuu")
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
                title: `<strong>Informations du local N° ${informations.local_id}</strong>`,
                icon: 'info',
                html:
                `Nom du local : <b>${informations.local_nom}</b> <br> 
                Adresse du local : <b>${informations.local_adresse} </b> <br>
                Capacite du local : <b>${informations.local_capacite} </b> <br>
                Type  du local : <b>${informations.local_type} </b> <br> `,
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
        title: 'vous aller suprimer le local numero : ' +this.dataset.id+'?',
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