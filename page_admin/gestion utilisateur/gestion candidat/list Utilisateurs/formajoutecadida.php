<div class="modal fade" id="usermodal" data-bs-backdrop="static" data-bs-keyboard="false" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fs-5" id="usermodal">Ajouter candidat</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" id="addform" method="post" enctype="multipart/form-data">

                    <div class="row col-lg-12 mx-auto">
                        <div class="col-md-12 text-center mb-2   mx-3">
                            <img src="images/no-image.jpg" class="js-image img-fluid rounded-5 " style=" border-radius :50% !important;;width: 180px;height:180px;object-fit: cover;">
                            <div>
                                <div class="mb-3">
                                    <label for="formFile" class="form-label">Cliquez ici pour choisir une image</label>
                                    <input onchange="display_image(this.files[0])" class="js-image-input form-control" type="file" id="formFile" name="photo">
                                </div>
                                <div><small class="js-error js-error-image text-danger"></small></div>
                            </div>
                        </div>


                        <div class="row ">
                            <div class="form_group col-md  mb-2  mt-2  mx-3 ">
                                <label for="nom"> NOM</label>
                                <div class="input-group mb-3">
                                    <span class="input-group-text">
                                        <i class="fas fa-user-circle"></i>
                                    </span>
                                    <input type="text" name="nom" id="nom" placeholder="Entre le nom" class="form-control" required>


                                </div>
                            </div>

                            <div class="form_group col-md mb-3 mt-2  mx-3">
                                <label for="prenom"> Prénom</label>
                                <div class="input-group mb-3">
                                    <span class="input-group-text">
                                        <i class="fas fa-user"></i>
                                    </span>
                                    <input type="text" name="prenom" id="prenom" placeholder="Entre le Prenom" class="form-control" required>

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form_group  col-md mb-3  mt-3  mx-3">
                                <label for="email"> Email</label>
                                <div class="input-group mb-3">
                                    <span class="input-group-text">
                                        <i class="fas fa-envelope"></i>
                                    </span>
                                    <input type="email" name="email" id="email" placeholder="Entrer l'email" class="form-control" required>
                                </div>
                            </div>
                            <div class="form_group col-md mb-3 mt-3  mx-3">
                                <label for="telephone"> Telephone</label>
                                <div class="input-group mb-2">
                                    <span class="input-group-text">
                                        <i class="fas fa-phone"></i>
                                    </span>
                                    <input type="text" name="telephone" id="telephone" placeholder="Entrer le telephone" class="form-control" required>
                                </div>
                            </div>


                        </div>
                        <div class="row">
                            <div class="form_group col-md mb-3  mt-3  mx-3">
                                <label for="password">Mot de passe</label>
                                <div class="input-group mb-2">
                                    <span class="input-group-text">
                                        <i class="fas fa-key"></i>
                                    </span>
                                    <input type="password" name="password" id="password" placeholder="Entre votre mot de passe" class="form-control" required>
                                    <span class="input-group-text" onclick="motPASS_Affichage()">
                                        <i class="fas fa-eye" id="hide1"></i>
                                        <i class="fas fa-eye-slash" id="hide2"></i>
                                    </span>

                                </div>
                            </div>

                            <div class="form_group col-md mb-3 mt-3  mx-3">
                                <label for="password-confirm">confirmer mot de passe</label>
                                <div class="input-group mb-2">
                                    <span class="input-group-text">
                                        <i class="fas fa-key"></i>
                                    </span>
                                    <input type="password" id="password-confirm" name="re_password" placeholder="confirmer votre mot de passe" class="form-control" required>
                                    <span class="input-group-text" onclick="motPASS_confirme()">
                                        <i class="fas fa-eye" id="hide3"></i>
                                        <i class="fas fa-eye-slash" id="hide4"></i>
                                    </span>
                                </div>

                                <div class="" id="message-confirm" role="alert">

                                </div>

                            </div>

                        </div>

                        <div class="row">
                            <div class="form_group col-md mb-3 mt-3  mx-3">
                                <label for="">Date naissance</label>
                                <input type="date" name="birthday" class="form-control">
                            </div>

                            <div class="form_group col-md mb-3 mt-3  mx-3">
                                <label for="">ville</label>
                                <div class="input-group mb-2">
                                    <span class="input-group-text">
                                        <i class="fa-sharp fa-solid fa-location-dot"></i>
                                    </span>
                                    <input type="text" name="ville" placeholder="Entrer la ville" class="form-control" required>

                                </div>
                            </div>

                        </div>




                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="submit-button" onclick="checkpassword()">Save</button>

                        <!-- fields 2 input firstfor adding and next for updating, deletening or viewing profile -->
                        <input type="hidden" name="action" value="adduser">
                        <input type="hidden" name="userId" id="userId" value="">

                    </div>


            </div>

            </form>
        </div>
    </div>
</div>
</div>