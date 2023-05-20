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

    $('body').on('click','.deleteBtn',function(e){
        Swal.fire({
            title: 'vous aller suprimer l\'examen numero ' +this.dataset.id+'?',
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

       $('body').on('click','.editBtn',function (e){
        e.preventDefault();
        $.ajax({
            url:'process.php',
            type:'post',
            data:{workingId:this.dataset.id},
            success: function(response){
              console.log(response)
               let billInfo = JSON.parse(response);
               $('#bill_id').val(billInfo.exemen_id)
               $('#exemen_dateUpdate').val(billInfo.exemen_date);
               $('#exemen_lieuUpdate').val(billInfo.exemen_lieu);
               $('#exemen_typeUpdate').val(billInfo.exemen_type);
               $('#exemen_resultatUpdate').val(billInfo.exemen_resultat);
               $('#candidat_nomUpdate').val(billInfo.candidat_nom);
               $('#candidat_prenomUpdate').val(billInfo.candidat_prenom);
               $('#typePermis_nomUpdate').val(billInfo.typePermis_nom);
               $('#moniteur_nomUpdate').val(billInfo.moniteur_nom);
               $('#moniteur_prenomUpdate').val(billInfo.moniteur_prenom);
               $('#planning_idUpdate').val(billInfo.planning_id);
      
            }
        })
    })
    $('#update').on('click', function(e) {
        e.preventDefault();
        formOrder = $('#formUpdateOrder');
        
       if (formOrder[0].checkValidity()) {
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
        console.log("edouuuuuuuu")
        e.preventDefault();
        $.ajax({
            url:'process.php',
            type:'post',
            data:{informationId:this.dataset.id},
            success: function(response){
                console.log(response);
                let informations=JSON.parse(response);
                Swal.fire({
                    title: `<strong>Informations de l'examen N° ${informations.exemen_id}</strong>`,
                    icon: 'info',
                    html:
                    `Date de l'examen: <b>${informations.exemen_date}</b> <br> 
                     Lieu de l'examen  : <b>${informations.exemen_lieu} </b> <br>
                     Type de l'examen : <b>${informations.exemen_type} </b> <br> 
                    Résultat de l'examen  : <b>${informations.exemen_resultat} </b> <br>
                    Nom du candidat : <b>${informations.candidat_nom} </b> <br> 
                    Prenom du candidat : <b>${informations.candidat_prenom} </b> <br> 
                    Type du permis : <b>${informations.typePermis_nom} </b> <br>
                    Nom du moniteur : <b>${informations.moniteur_nom} </b> <br> 
                    Prenom du moniteur : <b>${informations.moniteur_nom} </b> <br> 
                    Numero du planning: <b>${informations.planning_id} </b> <br>`,
                    showCloseButton: true,
                    
                    confirmButtonText:
                      '<i class="fa fa-thumbs-up"></i> Super!',
                    confirmButtonAriaLabel: 'Thumbs up, great!',
                   
                  })
            }
        })
    
    })

})