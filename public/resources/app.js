/// <reference path="F:/jquery-3.6.0.min.js" />
$.ajaxSetup({
    accepts: "application/json",
    type: "POST",
});

$(() => {
    // SECTION Configure slick slider
    $(".slick-front").slick({
        infinite: true,
        slidesToShow: 3,
        slidesToScroll: 2,
        autoplay: true,
        autoplaySpeed: 3000,

        responsive: [
            {
                breakpoint: 992,
                settings: {
                    infinite: true,
                    slidesToShow: 2,
                    slidesToScroll: 1,
                    autoplay: true,
                    autoplaySpeed: 3000,
                },
            },
            {
                breakpoint: 768,
                settings: {
                    infinite: true,
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    autoplay: true,
                    autoplaySpeed: 3000,
                },
            },
            {
                breakpoint: 600,
                settings: {
                    infinite: true,
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    arrows: false,
                    autoplay: true,
                    autoplaySpeed: 3000,
                },
            },
        ],
    });

    $(".slick-testimonials").slick({
        infinite: true,
        slidesToShow: 4,
        slidesToScroll: 3,
        autoplay: true,
        autoplaySpeed: 5000,

        responsive: [
            {
                breakpoint: 1200,
                settings: {
                    infinite: true,
                    slidesToShow: 3,
                    slidesToScroll: 2,
                    autoplay: true,
                    autoplaySpeed: 4500,
                },
            },
            {
                breakpoint: 992,
                settings: {
                    infinite: true,
                    slidesToShow: 2,
                    slidesToScroll: 1,
                    autoplay: true,
                    autoplaySpeed: 3000,
                },
            },
            {
                breakpoint: 768,
                settings: {
                    infinite: true,
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    autoplay: true,
                    autoplaySpeed: 2000,
                },
            },
            {
                breakpoint: 600,
                settings: {
                    infinite: true,
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    arrows: false,
                    autoplay: true,
                    autoplaySpeed: 2000,
                },
            },
        ],
    });
    // !SECTION Configure slick slider

    // Activating Website-wide tooltip
    var tooltipTriggerList = [].slice.call(
        document.querySelectorAll('[data-bs-toggle="tooltip"]')
    );
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });

    // SECTION Profile editing
    var gl_editedField;
    var gl_isPassword = false;
    // ==> Handling click on profile
    $(".acc-profile-edit").on("click", (event) => {
        event.preventDefault();
        var linkElement = event.currentTarget;
        var editedField = $(linkElement).attr("data-kp-fieldname");
        gl_editedField = editedField;
        var oldValue = $(linkElement).find(".item-value").text();
        var modalTitle = $("#profile-edit-modal .modal-title");
        var inputInput = $("#profile-edit-modal #modal-input-group input");
        var inputLabel = $("#profile-edit-modal #modal-input-group label");

        var modal = new bootstrap.Modal($("#profile-edit-modal"), {
            keyboard: false,
            backdrop: "static",
        });
        modalTitle.text("Menu Edit " + editedField);
        inputLabel.text(editedField);
        inputLabel.attr("for", editedField.toLowerCase());
        inputInput.attr("id", editedField.toLowerCase());
        inputInput.attr("name", editedField.toLowerCase());
        inputInput.val(oldValue);
        if (editedField == "Password Baru") {
            gl_isPassword = true;
            $("#profile-edit-modal #modal-input-group .input-group")
                .removeClass("d-none")
                .find("input")
                .val("");
            $("#profile-edit-modal #modal-input-group .main-input").addClass(
                "d-none"
            );
        } else {
            gl_isPassword = false;
            $("#profile-edit-modal #modal-input-group .input-group").addClass(
                "d-none"
            );
            $("#profile-edit-modal #modal-input-group .main-input").removeClass(
                "d-none"
            );
        }
        modal.show();
    });
    var alertObject = $("#profile-edit-modal .alert");
    var alertHeader = $(alertObject).find("#alert-header");
    var alertBody = $(alertObject).find("#alert-body");
    var haveChange = false;
    // ==> Handling submit button
    $("#modal-submit-button").on("click", () => {
        if (gl_isPassword == true) {
            var attributeField = $(
                "#profile-edit-modal #modal-input-group .input-group input"
            );
        } else {
            var attributeField = $(
                "#profile-edit-modal #modal-input-group .main-input"
            );
        }
        var passwordField = $("#profile-edit-modal #modal-pass-input input");
        var buttonSpinner = $("#profile-edit-modal #button-spinner");
        var attributeError = $(
            "#profile-edit-modal #modal-input-group .modal-error-custom"
        );
        var passwordError = $(
            "#profile-edit-modal #modal-pass-input .modal-error"
        );

        if (!attributeField.val() || !passwordField.val()) {
            if (!attributeField.val()) {
                attributeError.removeClass("d-none");
            } else {
                attributeError.addClass("d-none");
            }

            if (!passwordField.val()) {
                passwordError.removeClass("d-none");
            } else {
                passwordError.addClass("d-none");
            }
        } else {
            passwordError.addClass("d-none");
            attributeError.addClass("d-none");

            var parsedProfileType = parseProfileType(gl_editedField);
            const requestData = {
                token: apiToken,
                attributeGroup: parseProfileGroup(parsedProfileType),
                attributeType: parsedProfileType,
                attribute: attributeField.val(),
                password: passwordField.val(),
            };

            console.log(requestData);

            $.ajax({
                url: "/api/editprofile",
                data: requestData,
                beforeSend: () => {
                    buttonSpinner.removeClass("d-none");
                },
                success: (response) => {
                    console.log(response);
                    alertObject.removeClass("d-none");
                    alertObject.removeClass("alert-danger");
                    alertObject.addClass("alert-success");
                    alertHeader.text(`${gl_editedField} berhasil diperbarui`);
                    alertBody.text("");
                    haveChange = true;
                },
                error: (jqx, status, thrown) => {
                    console.log(jqx.responseJSON.message);
                    alertObject.removeClass("d-none");
                    alertObject.removeClass("alert-success");
                    alertObject.addClass("alert-danger");
                    alertHeader.text("Terjadi kesalahan");
                    alertBody.text(jqx.responseJSON.message);
                },
                complete: () => {
                    buttonSpinner.addClass("d-none");
                },
                timeout: 10000,
            });
        }
    });
    // ==> Handling cancel button form reset
    $("#modal-dismiss-button").on("click", (event) => {
        $("#profile-edit-modal #modal-pass-input input").val("");
        $("#profile-edit-modal .modal-error").addClass("d-none");
        alertObject.addClass("d-none");
        if (haveChange == true) {
            location.reload();
        }
        haveChange = false;
    });
    // !SECTION Profile editing

    // SECTION Handling more password peek
    $("#passwordPeek").on("touchstart", mousedownPasswordPeek(this));
    $("#passwordPeek").on("touchend", mousedownPasswordPeek(this));
    // !SECTION Handling more password peek
});

// SECTION Handling password peek
function mousedownPasswordPeek(that) {
    let input_elem = $(that).siblings(".form-control");
    input_elem.attr("type", "text");
    $(that).find("i").removeClass("bi-eye-fill");
    $(that).find("i").addClass("bi-eye-slash-fill");
}
function mouseupPasswordPeek(that) {
    let input_elem = $(that).siblings(".form-control");
    input_elem.attr("type", "password");
    $(that).find("i").removeClass("bi-eye-slash-fill");
    $(that).find("i").addClass("bi-eye-fill");
}
// !SECTION Handling password peek

// SECTION Location Picker Handler
function selectProvinceChange() {
    var regencySelectValue = $("select#provinsi_id").val();
    var citySelectOptions = $("select#kota_id");
    var isFirstEntry = true;

    citySelectOptions.empty();
    for (const prop in list_kota) {
        if (list_kota[prop].provinsi_id == regencySelectValue) {
            var namaKota = list_kota[prop].name;
            if (list_kota[prop].is_city == 1) {
                namaKota = "Kota " + namaKota;
            } else {
                namaKota = "Kab. " + namaKota;
            }
            if (isFirstEntry) {
                citySelectOptions.append(
                    `<option value="${list_kota[prop].id}" selected>${namaKota}</option>`
                );
                isFirstEntry = false;
            } else {
                citySelectOptions.append(
                    `<option value="${list_kota[prop].id}">${namaKota}</option>`
                );
            }
        }
    }
}
// !SECTION Location Picker Handler

// SECTION Reservation Doctor Picker Handler
function selectDoctorChange() {
    var poliSelectValue = $(".form-select#id_poli_bagian").val();
    var doctorSelectOptions = $(".form-select#id_dokter");
    var isFirstEntry = true;

    doctorSelectOptions.empty();
    for (const item in list_dokter) {
        if (list_dokter[item].poli_bagian_id == poliSelectValue) {
            var objectDokter = list_dokter[item];
            if (isFirstEntry) {
                doctorSelectOptions.append(
                    `<option value="${objectDokter.id}" selected>${objectDokter.fullname}</option>`
                );
                isFirstEntry = false;
            } else {
                doctorSelectOptions.append(
                    `<option value="${objectDokter.id}">${objectDokter.fullname}</option>`
                );
            }
        }
    }
}
// !SECTION Reservation Doctor Picker Handler

// SECTION Helper Functions
const profileTypeParseRules = {
    nama: "fullname",
    "password baru": "password",
};
function parseProfileType(type) {
    var newType = type.toLowerCase();
    for (const prop in profileTypeParseRules) {
        if (newType == prop) {
            newType = profileTypeParseRules[prop];
            break;
        }
    }
    return newType;
}
const profileGroupParseRules = {
    account: ["fullname", "username", "email", "password"],
    patient: ["test00", "test01", "test02"],
    doctor: ["test10", "test11", "test12"],
};
function parseProfileGroup(type) {
    var group = "";
    for (const prop in profileGroupParseRules) {
        for (const groupMember of profileGroupParseRules[prop]) {
            if (type == groupMember) {
                group = prop;
                break;
            }
        }
    }
    if (group === "") {
        group = undefined;
    }
    return group;
}
// !SECTION Helper Functions
