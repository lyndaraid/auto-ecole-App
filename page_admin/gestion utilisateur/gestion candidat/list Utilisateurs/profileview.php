<div class="modal fade" id="userViewModal" data-bs-backdrop="static" data-bs-keyboard="false" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fs-5" id="usermodal"> <i class="fas fa-user-alt"></i> Profile candidat </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container" id="profile">
                    <h4 class="text-center">Toutes les données utilisateur seront affichées ici</h4>

                    <div class="row col-lg-12 mx-auto">
                        <div class="col-md-12 text-center mb-2   mx-3">
                            <img src="images/no-image.jpg" class="js-image img-fluid rounded-5 "
                                style=" border-radius :50% !important;;width: 180px;height:180px;object-fit: cover;">
                            <div>
                                <div class="mb-3">
                                    <label for="formFile" class="form-label">Cliquez ici pour choisir une image</label>
                                    <input onchange="display_image(this.files[0])" class="js-image-input form-control"
                                        type="file" id="formFile">
                                </div>
                                <div><small class="js-error js-error-image text-danger"></small></div>
                            </div>
                        </div>



                    </div>




                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">fermer</button>

                </div>


            </div>


        </div>
    </div>
</div>