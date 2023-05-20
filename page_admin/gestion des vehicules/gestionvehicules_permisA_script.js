$(function() {
    $('table').DataTable();
    //creer un type permis
    $('#create').on('click', function(e) {
       
         formOrder = $('#formOrder')
        if (formOrder[0].checkValidity()) {
            console.log('aaaaaaaaaaa');
            e.preventDefault();
            $.ajax({
                url: 'process.php',
                type: 'post',
                data: formOrder.serialize() + '&action=create',
                success: function(response) {
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
    function getBills() {
        $.ajax({
            url: 'process.php',
            type: 'post',
            data: { action: 'fetch'},
            success: function (response) {
                $('#orderTable').html(response);
                $('table').DataTable({
                    order : [0, 'desc'],
                });
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
                console.log(response)
                
               let billInfo = JSON.parse(response);
               $('#bill_id').val(billInfo.vehicule_id)
               $('#vehicule_marqueUpdate').val(billInfo.vehicule_marque);
               $('#vehicule_modeleUpdate').val(billInfo.vehicule_modele);
               $('#vehicule_anneeUpdate').val(billInfo.vehicule_annee);
               $('#vehicule_permisUpdate').val(billInfo.vehicule_permis);
               
            }
        })

    })
    //updateun type permis
    $('#update').on('click', function(e) {
        let formOrder = $('#formUpdateOrder')
        if (formOrder[0].checkValidity()) {
            
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
                title: `<strong>Informations du vehicule N° ${informations.vehicule_id}</strong>`,
                icon: 'info',
                html:
                `Marque du vehicule : <b>${informations.vehicule_marque}</b> <br> 
                Modele du vehicule : <b>${informations.vehicule_modele} </b> <br>
                Année du vehicule : <b>${informations.vehicule_annee} </b> <br>
                Permis associé au véhicule : <b>${informations.vehicule_permis} </b> <br> `,
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
        title: 'vous aller suprimer le vehicule numero ' +this.dataset.id+'?',
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
                      getBills();
                }
              }
            })
         
        }
      })
   
   })

})