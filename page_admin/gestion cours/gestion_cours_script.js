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
                    title: `<strong>Informations du cour N° ${informations.cours_id}</strong>`,
                    icon: 'info',
                    html:
                    `Type du cour : <b>${informations.cours_typeCours}</b> <br> 
                    Date du cour : <b>${informations.cours_date} </b> <br>
                    Heure de début : <b>${informations.cours_heure_debut} </b> <br> 
                    Heure de fin  : <b>${informations.cours_heure_fin} </b> <br>
                    Nom du moniteur : <b>${informations.moniteur_nom} </b> <br> 
                    Prenom du moniteur : <b>${informations.moniteur_nom} </b> <br> 
                    Type du permis : <b>${informations.typePermis_nom} </b> <br>
                    Numero du planning: <b>${informations.planning_id} </b> <br>`,
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
            title: 'vous aller suprimer le cour numero ' +this.dataset.id+'?',
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
               $('#bill_id').val(billInfo.cours_id)
               $('#cours_typeCoursUpdate').val(billInfo.cours_typeCours);
               $('#cours_dateUpdate').val(billInfo.cours_date);
               $('#cours_heure_debutUpdate').val(billInfo.cours_heure_debut);
               $('#cours_heure_finUpdate').val(billInfo.cours_heure_fin);
               $('#moniteur_nomUpdate').val(billInfo.moniteur_nom);
               $('#moniteur_prenomUpdate').val(billInfo.moniteur_prenom);
               $('#typePermis_nomUpdate').val(billInfo.typePermis_nom);
               $('#planning_idUpdate').val(billInfo.planning_id);
      
            }
        })
    })
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
})