jQuery(function() {

    // THE CODE JS SAQ-FOI ET JOIE HAITI

    // BY Jimmy SINOUS, Analyste-programmeur

    $("#form_add_evaluate").submit(function(e) {

        e.preventDefault();

        $("#TextBoxContainer").html("");

        $("input[class$='_error']").html("");

        var _this = $(this);

        var button = $(this).find('button:last');

        var text = $(button).text();

        var data = new FormData($(this)[0]);

        var postData = $(this).serializeArray();

        var beforeSend = $(button).addClass("beforesend-button mdi mdi-loading mdi-spin").text('Partientez...').prop('disabled', 'true');

        var action = $(this).attr('action');

        console.log(postData);

        $.ajax({

            type: "POST",

            url: action,

            data: data,

            dataType: "json",

            contentType: false,

            processData: false,

            beforeSend: function() {

                beforeSend

            },

            // timeout: queryTimeout,

            success: function(data) {

                console.log(data.status);

                if (!data.error) {

                    setTimeout(function() {

                        window.location.href = $(_this).attr('data-return');

                    }, 2500);

                    Snackbar.show({ text: data.message, pos: 'bottom-right' });

                } else {

                    var message = "";

                    $.each(data.error, function(index, value) {

                        message += value;   
                        Snackbar.show({
                            text: message,
                            pos: 'bottom-right',
                            actionTextColor: '#fff',
                            backgroundColor: '#e7515a'
                        });

                    })
                }
            },

            error: function(err) {

                console.log(err);

                // Snackbar.show({text: $(_this).attr('data-return'),pos: 'bottom-right'});

            },

            complete: function(x) {

                setTimeout(function() {

                    $(button).removeClass('beforesend-button mdi mdi-loading mdi-spin').text('Enregistrer').removeAttr('disabled');

                }, 700);

            }

        });



    });


    $('#id_departement').on('change', function(e) {

        e.preventDefault();

        let id_departement = $(this).val();

        if (id_departement != "") {

            $('#id_commune').html("");

            var div_data = '<option selected="selected" disabled="disabled">Choisir Commune</option>';

            $.ajax({

                type: "GET",

                url: "admin/staff/getCommune/",

                data: { 'id_departement': id_departement },

                dataType: "json",

                success: function(response) {

                    if (response.length > 0) {

                        $.each(response, function(y, z) {

                            let sel = "";

                            if (id_commune == z.id_commune) {

                                sel = "selected";

                            }

                            div_data += "<option value=" + z.id_commune + " " + sel + ">" + z.nom + "</option>";

                        });

                        $('#id_commune').prop('disabled', false).html(div_data);

                    } else {

                        $('#id_commune').prop('disabled', true).html(div_data);

                    }
                }
            });
        }
    });

    $('#id_departement_edit').on('change', function(e) {
        e.preventDefault();
        let id_departement = $(this).val();

        if (id_departement != "") {
            $.ajax({
                type: "GET",
                url: "admin/staff/getCommune/",
                data: { "id_departement": id_departement },
                dataType: "json",
                success: function(response) {
                    $('#id_commune_edit').html("");
                    var div_data = '<option selected="selected" disabled="disabled">Choisir Commune</option>';
                    if (response.length > 0) {
                        $.each(response, function(y, z) {
                            let sel = "";
                            if (id_commune == z.id_commune) {
                                sel = "selected";
                            }
                            div_data += "<option value=" + z.id_commune + " " + sel + ">" + z.nom + "</option>";
                        });
                        $('#id_commune').prop('disabled', false).html(div_data);
                    } else {
                        $('#id_commune').prop('disabled', true).html(div_data);
                    }
                },
                error: function(deer) {
                    // console.log(deer);
                }
            });
        }
    });

    $('#id_choosen_course').on('change', function(e) {
        e.preventDefault();
        let id_course = $(this).val();
        if (id_course != "") {
            $('#evaltablelist').html("");
            var div_data = '';
            $.ajax({
                type: "GET",
                url: "admin/staff/getCoursesAndEvaluationWithStudent/",
                data: { 'id_course': id_course },
                dataType: "json",

                success: function(response) {
                    div_data += "<div class='col-xl-12 col-lg-12 col-sm-12  layout-spacing table-responsive'>";
                    div_data += "<div class='widget-content widget-content-area br-6'>";
                    if (response.length > 0) {
                        var nb = 0;
                        div_data += "<table id='html5-extension' class='table table-hover non-hoverS' style='width:100%'>";
                        div_data += "<thead>";
                        div_data += "<tr>";
                        div_data += "<th>#</th>";
                        div_data += "<th>NOM</th>";
                        div_data += "<th>PRENOM</th>";
                        // div_data += "<th>COURS</th>";
                        div_data += "<th>NOTE OBTENUE</th>";
                        div_data += "<th>DATE</th>";
                        div_data += "</tr>";
                        div_data += "</thead>";
                        div_data += "<tbody>";

                        $.each(response, function(y, z) {
                            nb++;
                            div_data += "<tr>";
                            div_data += "<td>" + nb + "</td>";
                            div_data += "<td>" + z.nom + "</td>";
                            div_data += "<td>" + z.prenom + "</td>";
                            // div_data += "<td>" + z.titre_cours + "</td>";
                            div_data += "<td>" + z.resultat + "</td>";
                            div_data += "<td>" + z.date + "</td>";
                            div_data += "</tr>";
                        });
                        div_data += "</tbody >";
                        div_data += "</table>";

                    } else {
                        div_data += "<p><h4 class='text-center text-warning'>Aucun resultat encore disponible pour ce cours !</h4></p>";
                    }
                    div_data += "</div>";
                    div_data += "</div>";
                    $('#evaltablelist').html(div_data);
                }
            });
        }
    });


    $('#id_commune').on('change', function(e) {

        e.preventDefault();

        let id_commune = $(this).val();

        if (id_commune != "") {

            $('#section').html("");

            var div_data = '<option selected="selected" disabled="disabled">Choisir Section Communale</option>';

            $.ajax({

                type: "GET",

                url: "admin/staff/getSectionCommunal/",

                data: { 'id_commune': id_commune },

                dataType: "json",

                success: function(response) {

                    if (response.length > 0) {

                        $.each(response, function(y, z) {

                            let sel = "";

                            if (section == z.section) {

                                sel = "selected";

                            }

                            div_data += "<option value=" + z.section + " " + sel + ">" + z.nom + "</option>";

                        });

                        $('#section').prop('disabled', false).html(div_data);

                    } else {

                        $('#section').prop('disabled', true).html(div_data);

                    }

                }

            });

        }

    });



    // ADD USER

    $('#form_add_user').on('submit', function(xy) {

        xy.preventDefault();

        var _this = $(this);

        var button = $(this).find('button:last');

        var text = $(button).text();

        var data = new FormData($(this)[0]);

        var beforeSend = $(button).addClass("beforesend-button mdi mdi-loading mdi-spin").text('Partientez...').prop('disabled', 'true');

        var action = $(this).attr('action');

        // Snackbar.show({text:data,pos: 'bottom-right'});

        $.ajax({

            type: "POST",

            url: action,

            data: data,

            dataType: "json",

            contentType: false,

            processData: false,

            beforeSend: function() {

                beforeSend

            },

            // timeout: queryTimeout,

            success: function(data) {

                console.log(data.status);

                if (!data.error) {

                    setTimeout(function() {

                        window.location.href = $(_this).attr('data-return');

                    }, 2500);

                    // Snackbar.show({text: data.message,pos: 'bottom-right'});

                    const toast = swal.mixin({

                        toast: true,

                        position: 'top-end',

                        showConfirmButton: false,

                        timer: 3000,

                        padding: '2em'

                    });

                    toast({

                        type: 'success',

                        title: data.message,

                        padding: '2em',

                    });

                } else {

                    var message = "";

                    $.each(data.error, function(index, value) {

                        message += value;

                    });

                       
                    Snackbar.show({
                        text: message,
                        pos: 'bottom-right',
                        actionTextColor: '#fff',

                        backgroundColor: '#e7515a'
                    });



                }

            },

            error: function(err) {

                console.log(err);

                // Snackbar.show({text: $(_this).attr('data-return'),pos: 'bottom-right'});

            },

            complete: function(x) {

                setTimeout(function() {

                    $(button).removeClass('beforesend-button mdi mdi-loading mdi-spin').text('Enregistrer').removeAttr('disabled');

                }, 700);

            }

        });

    });



    $("#form_add_ressources").submit(function(e) {

        e.preventDefault();

        var _this = $(this);

        var button = $(this).find('button:last');

        var text = $(button).text();

        var data = new FormData($(this)[0]);

        var files = $('#file')[0].files[0];

        data.append('file', files);

        var beforeSend = $(button).addClass("beforesend-button mdi mdi-loading mdi-spin").text('Traitement en cours...').prop('disabled', 'true');

        var action = $(this).attr('action');

        // console.log(data);

        $.ajax({

            type: "POST",

            url: action,

            data: data,

            dataType: "json",

            contentType: false,

            processData: false,

            beforeSend: function() {

                beforeSend

            },

            // timeout: queryTimeout,

            success: function(data) {

                console.log(data.status);

                if (!data.error) {

                    setTimeout(function() {

                        window.location.href = $(_this).attr('data-return');

                    }, 2500);

                    Snackbar.show({ text: data.message, pos: 'bottom-right' });

                } else {

                    var message = "";

                    $.each(data.error, function(index, value) {

                        message += value;

                    });

                       
                    Snackbar.show({
                        text: message,
                        pos: 'bottom-right',
                        actionTextColor: '#fff',

                        backgroundColor: '#e7515a'
                    });

                }

            },

            error: function(err) {

                console.log(err);

                // Snackbar.show({text: $(_this).attr('data-return'),pos: 'bottom-right'});

            },

            complete: function(x) {

                setTimeout(function() {

                    $(button).removeClass('beforesend-button mdi mdi-loading mdi-spin').text('Enregistrer').removeAttr('disabled');

                }, 700);

            }

        });

    });



    $(document).on("click", "#addnewliine", function() {

        var lenght_div = $('#TextBoxContainer .app').length;

        var div = GetDynamicTextBox(lenght_div);

        $("#TextBoxContainer").append(div);

        $('.save_button').show();

        var values = "";

        $("input[name=DynamicTextBox]").each(function() {

            values += $(this).val() + "\n";

        });

    });



    $(document).on('click', '#btnRemove', function() {

        $(this).parents('.form-row').remove();

    });



    // $(document).on('change', '#section_id', function (e) {

    // resetForm();

    // });

    let value = $('#TextBoxContainer .app').length;

    if (value == 0) { $('.save_button').hide(); }





    $(document).on('click', '#deletecourse', function(e) {

        e.preventDefault();

        var id = $(this).attr('data-iddelete');

        var returnurl = $(this).attr('data-return');

        swal({

            title: 'Voulez-vous vraiment effectuer la Suppression ?',

            text: "Si, Oui! Cliquez sur SUPPRIMER",

            type: 'warning',

            showCancelButton: true,

            confirmButtonText: 'Supprimer',

            padding: '2em'

        }).then(function(result) {

            if (result.value) {

                $.ajax({

                    type: "GET",

                    url: 'homework/deletecourse/' + id,

                    data: { 'id': id },

                    dataType: "json",

                    success: function(data) {

                        console.log(data);

                        if (data.status === 'success') {

                            setTimeout(function() {

                                window.location.href = returnurl;

                            }, 3000);

                            swal('Suppression !', data.message, 'success')

                        }

                    }

                });

            }

        });

    });





    // traitement evaluation cours

    $('#form_add_rep_evaluate').on('submit', function(xy) {

        xy.preventDefault();

        var _this = $(this);

        var return_url = $(this).attr('data-return');

        var button = $(this).find('button:last');

        var text = $(button).text();

        var data = new FormData($(this)[0]);

        var beforeSend = $(button).text('Traitement en cours...').prop('disabled', 'true');

        var action = $(this).attr('action');

        swal({

            title: 'Avez-vous repondu toutes les question??',

            text: "Si, Oui! Cliquez sur SOUMETTRE",

            type: 'success',

            showCancelButton: true,

            confirmButtonText: 'SOUMETTRE',

            padding: '2em'

        }).then(function(result) {

            if (result.value) {

                console.log(data);

                $.ajax({

                    type: "POST",

                    url: action,

                    data: data,

                    dataType: "json",

                    contentType: false,

                    processData: false,

                    beforeSend: function() {

                        beforeSend

                    },

                    // timeout: queryTimeout,

                    success: function(data) {

                        console.log(data.status);

                        if (!data.error) {

                            setTimeout(function() {

                                window.location.href = return_url;

                            }, 2500);

                            swal('Félicitations !!!', data.message, 'success')


                        }

                    },

                    error: function(err) {

                        console.log(err);

                    },

                    complete: function(x) {

                        setTimeout(function() {

                            $(button).text('Soumettre').removeAttr('disabled');

                        }, 700);

                    }

                });

            } else {

                $(button).text('Soumettre').removeAttr('disabled');

            }

        });

    });









}); //End jQuery callback



function go_back() {

    window.history.back();

}



function GetDynamicTextBox(value) {

    var row = "";

    row += '<div class="form-row app">';

    row += '<input type="hidden" name="i[]" value="' + value + '"/>';

    row += '<input type="hidden" name="row_id_' + value + '" value="' + value + '"/>';



    row += '<div class="">';

    row += '<span>&nbsp</span>';

    row += '<span> ' + (value + 1) + '</span>';

    row += '<span>&nbsp</span>';

    row += '.</div>';

    // Label

    // row += '<div class="col-md-3 mb-3">';

    // row += '<label for="label'+ value + '">Titre Question</label>';

    // row += '<input type="text"  id="label_' + value + '" name="label_' + value + '" class="form-control"  placeholder="Entrer titre question" required />';

    // row += '</div>';

    // question

    row += '<div class="col-md-5 mb-5">';

    row += '<label for="question_' + value + '">Entrer la question</label>';

    row += '<input type="text"  id="question_' + value + '" name="question_' + value + '" class="form-control" placeholder="Entrer question" required />';

    // row += '</br>';

    row += '<div class="col-md-12 row">';

    row += '<input type="text"  id="choix1_' + value + '" name="choix1_' + value + '" class="form-control col-md-6" placeholder="Entrer choix reponse 1" required />';

    row += '<input type="text"  id="choix2_' + value + '" name="choix2_' + value + '" class="form-control col-md-6" placeholder="Entrer choix reponse 2" required />';

    row += '</div>';

    row += '<div class="col-md-12 row">';

    row += '<input type="text"  id="choix3_' + value + '" name="choix3_' + value + '" class="form-control col-md-6" placeholder="Entrer choix reponse 3" required />';

    row += '<input type="text"  id="choix4_' + value + '" name="choix4_' + value + '" class="form-control col-md-6" placeholder="Entrer choix reponse 4" required />';

    row += '</div>';

    row += '</div>';



    // reponse

    row += '<div class="col-md-5 mb-5">';

    row += '<label for="reponse_' + value + '">Réponse à cette question</label>';

    row += '<input type="text"  id="reponse_' + value + '" name="reponse_' + value + '" class="form-control" placeholder="Reponse à cette question" required />';

    row += '<div class="col-md-12 row">';

    row += '<input type="text"  id="reponse1_' + value + '" name="reponse1_' + value + '" class="form-control col-md-6" placeholder="Entrer reponse 1"  />';

    row += '<input type="text"  id="reponse2_' + value + '" name="reponse2_' + value + '" class="form-control col-md-6" placeholder="Entrer reponse 2"  />';

    row += '</div>';

    row += '<div class="col-md-12 row">';

    row += '<input type="text"  id="reponse3_' + value + '" name="reponse3_' + value + '" class="form-control col-md-6" placeholder="Entrer reponse 3"  />';

    row += '<input type="text"  id="reponse4_' + value + '" name="reponse4_' + value + '" class="form-control col-md-6" placeholder="Entrer reponse 4"  />';

    row += '</div>';

    row += '</div>';



    // 

    row += '<div class="col-md-1 mb-1"><button id="btnRemove" style="" title="Supprimer" class="btn btn-sm btn-danger form-control" type="button"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#ffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg></button></div>';

    row += '</div>';

    return row;

}





setInterval(function() {

    let t = function() {

        if (!navigator.onLine) {

            let dom = $('body');

            if ($('#offline-status').length === 0) {

                dom.append('<span id="offline-status"><i class="mdi mdi-wifi-off" style="margin-right: 20px;vertical-align: middle"></i>Vous êtes hors connexion. Merci de vous connecter à internet.</span>');

            }

        } else {

            $('#offline-status').fadeOut('slow', function() {

                $('#offline-status').remove();

            });

        }

    }();

}, 1200);