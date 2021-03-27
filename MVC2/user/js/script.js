/* =====================================
        Show/Hide Password
======================================== */
function showPassword(controlID) {
    if ($("#" + controlID).attr("type") === "password") {
        $("#" + controlID).attr("type", "text")
    } else {
        $("#" + controlID).attr("type", "password")
    }
}

/* =====================================
            ASCE/DES
======================================== */

//jQuery(document).ready(function(){
//
//    jQuery(".showImg").click(function(){
//        $('.table thead th').removeClass('.ascending');
//        $(this).addClass('.descending');
//    });
//});

/* =====================================
            Navigation
======================================== */

function sticky_header() {
    var header_height = jQuery('.site-header').innerHeight() / 2;
    var scrollTop = jQuery(window).scrollTop();;
    if (scrollTop > header_height) {
        jQuery('body').addClass('sticky-header');

        //Show White logo
        $(".site-header .header-wrapper .logo-wrapper a img").attr("src", "images/logo_pur/top-logo.png")

    } else {
        jQuery('body').removeClass('sticky-header');

        //Show logo
        $(".site-header .header-wrapper .logo-wrapper a img").attr("src", "images/login/top-logo.png")
    }
}
jQuery(document).ready(function () {
    var bodyId = $('body').attr('id');

    if (bodyId == "bodyForStickyHeader")
        sticky_header();


});
jQuery(window).scroll(function () {
    var bodyId = $('body').attr('id');

    if (bodyId == "bodyForStickyHeader")
        sticky_header();
});
jQuery(window).resize(function () {
    var bodyId = $('body').attr('id');

    if (bodyId == "bodyForStickyHeader")
        sticky_header();
});

/* =====================================
                Mobile Menu
======================================== */
$(function () {
    //Show mobile nav
    $("#mobile-nav-open-btn").click(function () {
        $("#mobile-nav").css("height", "100%");
    });

    //Hide mobile nav
    $("#mobile-nav-close-btn").click(function () {
        $("#mobile-nav").css("height", "0%");
    });
});

/* =====================================
            Popup
======================================== */

$('#myModal').on('shown.bs.modal', function () {
    $('#myModal').trigger('focus')
});

/* =====================================
            Dropdown
======================================== */
$('.dropdown-toggle').dropdown();

$('#myDropdown').click(function () {
    $("sub_dropdown_header").show();
});

/* =====================================
            star
======================================== */
$(document).ready(function () {
    for (i = 1; i < 9; i++) {
        for (j = 5; j >= 1; j--) {
            $('.rate' + i + ' .rate').append('<input type="radio" id="s_' + i + '_' + j + '" name="rate' + i + '" value="5" /><label for="s_' + i + '_' + j + '" title="text">5 stars</label>');
        }
    }
});


/* =====================================
            Sign-up validation
======================================== */

reOnlyAlphabet = /^[A-Za-z]+$/;
reForEmail = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
reForPassword = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[#$@!%&*?])[A-Za-z\d#$@!%&*?]{6,24}$/;

function validateFirstName() {

    isValidFname = false;

    if ($("#fname").val() == "" || $("#fname").val() == null || $("#fname").val().trim().length == 0) {
        $("#fname").focusin();
        $("#fname").addClass("borderHighlight");
        $("#fnameVal").css("visibility", "visible");
        $("#fnameVal").html("Please fill out this field.");
        isValidFname = false;
    } else if (!reOnlyAlphabet.test($("#fname").val())) {
        $("#fname").focusin();
        $("#fname").addClass("borderHighlight");
        $("#fnameVal").css("visibility", "visible");
        $("#fnameVal").html("Please enter only alphabets.");
        isValidFname = false;
    } else {
        $("#fname").removeClass("borderHighlight");
        $("#fnameVal").css("visibility", "hidden");
        isValidFname = true;
    }

    return isValidFname;

}

function validateLastName() {

    isValidLname = false;

    if ($("#lname").val() == "" || $("#lname").val() == null || $("#lname").val().trim().length == 0) {
        $("#lname").focusin();
        $("#lname").addClass("borderHighlight");
        $("#lnameVal").css("visibility", "visible");
        $("#lnameVal").html("Please fill out this field.");
        isValidLname = false;
    } else if (!reOnlyAlphabet.test($("#lname").val())) {
        $("#lname").focusin();
        $("#lname").addClass("borderHighlight");
        $("#lnameVal").css("visibility", "visible");
        $("#lnameVal").html("Please enter only alphabets.");
        isValidLname = false;
    } else {
        $("#lname").removeClass("borderHighlight");
        $("#lnameVal").css("visibility", "hidden");
        isValidLname = true;
    }

    return isValidLname;

}

function validateEmail() {

    isValidEmail = false;

    if ($("#email").val() == "" || $("#email").val() == null || $("#email").val().trim().length == 0) {
        $("#email").focusin();
        $("#email").addClass("borderHighlight");
        $("#emailVal").css("visibility", "visible");
        $("#emailVal").html("Please fill out this field.");
        isValidEmail = false;
    } else if (!reForEmail.test($("#email").val())) {
        $("#email").focusin();
        $("#email").addClass("borderHighlight");
        $("#emailVal").css("visibility", "visible");
        $("#emailVal").html("Please enter valid email.");
        isValidEmail = false;
    } else {
        $("#email").removeClass("borderHighlight");
        $("#emailVal").css("visibility", "hidden");
        isValidEmail = true;
    }

    return isValidEmail;

}

function validatePassword() {

    isValidPassword = false;

    if ($("#password").val() == "" || $("#password").val() == null || $("#password").val().trim().length == 0) {
        $("#password").focusin();
        $("#password").addClass("borderHighlight");
        $("#passwordVal").css("visibility", "visible");
        $("#passwordVal").html("Please fill out this field.");
        isValidPassword = false;
    } else if (!reForPassword.test($("#password").val())) {
        $("#password").focusin();
        $("#password").addClass("borderHighlight");
        $("#passwordVal").css("visibility", "visible");
        $("#passwordVal").html("Please enter valid password.");
        isValidPassword = false;
    } else {
        $("#password").removeClass("borderHighlight");
        $("#passwordVal").css("visibility", "hidden");
        isValidPassword = true;
    }

    return isValidPassword;
}


function validateConPassword() {

    isValidConPassword = false;

    if ($("#conPassword").val() == "" || $("#conPassword").val() == null || $("#conPassword").val().trim().length == 0) {
        $("#conPassword").focusin();
        $("#conPassword").addClass("borderHighlight");
        $("#conPasswordVal").css("visibility", "visible");
        $("#conPasswordVal").html("Please fill out this field.");
        isValidConPassword = false;
    } else if (!reForPassword.test($("#conPassword").val())) {
        $("#conPassword").focusin();
        $("#conPassword").addClass("borderHighlight");
        $("#conPasswordVal").css("visibility", "visible");
        $("#conPasswordVal").html("Please enter valid confirm password");
        isValidConPassword = false;
    } else if ($('#password').val() != $('#conPassword').val()) {
        $("#conPassword").focusin();
        $("#conPassword").addClass("borderHighlight");
        $("#conPasswordVal").css("visibility", "visible");
        $("#conPasswordVal").html("Password and Confirm Password don't match.");
        isValidConPassword = false;
    } else {
        $("#conPassword").removeClass("borderHighlight");
        $("#conPasswordVal").css("visibility", "hidden");
        isValidConPassword = true;
    }

    return isValidConPassword;
}

function validateForm() {

    isValidForm = false;

    isValidFname = validateFirstName();
    isValidLname = validateLastName();
    isValidEmail = validateEmail();
    isValidPassword = validatePassword();
    isValidConPassword = validateConPassword();

    if (isValidFname && isValidLname && isValidEmail && isValidPassword && isValidConPassword) {
        isValidForm = true;
    }

    return isValidForm;

}


/* =====================================
            Login validation
======================================== */
function loginValidateEmail() {

    isLoginValidEmail = false;

    if ($("#email").val() == "" || $("#email").val() == null || $("#email").val().trim().length == 0) {
        $("#email").focusin();
        $("#email").addClass("borderHighlight");
        $("#emailVal").css("visibility", "visible");
        $("#emailVal").html("Please fill out this field.");
        isLoginValidEmail = false;
    } else {
        $("#email").removeClass("borderHighlight");
        $("#emailVal").css("visibility", "hidden");
        isLoginValidEmail = true;
    }

    return isLoginValidEmail;

}

function loginValidatePassword() {

    isLoginValidPassword = false;

    if ($("#password").val() == "" || $("#password").val() == null || $("#password").val().trim().length == 0) {
        $("#password").focusin();
        $("#password").addClass("borderHighlight");
        $("#passwordVal").css("visibility", "visible");
        $("#passwordVal").html("Please fill out this field.");
        isLoginValidPassword = false;
    } else {
        $("#password").removeClass("borderHighlight");
        $("#passwordVal").css("visibility", "hidden");
        isLoginValidPassword = true;
    }

    return isLoginValidPassword;
}

function loginValidateForm() {

    isLoginValidateForm = false;

    isLoginValidEmail = loginValidateEmail();
    isLoginValidPassword = loginValidatePassword();

    if (isLoginValidEmail && isLoginValidPassword) {
        isLoginValidateForm = true;
    }

    return isLoginValidateForm;

}

/* =====================================
            Forgot Password validation
======================================== */
function forgotValidateEmail() {

    isForgotValidEmail = false;

    if ($("#email").val() == "" || $("#email").val() == null || $("#email").val().trim().length == 0) {
        $("#email").focusin();
        $("#email").addClass("borderHighlight");
        $("#emailVal").css("visibility", "visible");
        $("#emailVal").html("Please fill out this field.");
        isForgotValidEmail = false;
    } else {
        $("#email").removeClass("borderHighlight");
        $("#emailVal").css("visibility", "hidden");
        isForgotValidEmail = true;
    }

    return isForgotValidEmail;

}

function forgotValidateForm() {

    isForgotValidateForm = false;

    isForgotValidEmail = forgotValidateEmail();

    if (isForgotValidEmail) {
        isForgotValidateForm = true;
    }

    return isForgotValidateForm;

}

/* =====================================
            Contact Us
======================================== */
function validateContactFirstName() {

    isValidContactFname = false;

    if ($("#fname").val() == "" || $("#fname").val() == null || $("#fname").val().trim().length == 0) {
        $("#fname").focusin();
        $("#fname").addClass("borderHighlight");
        $("#fnameVal").css("visibility", "visible");
        $("#fnameVal").html("Please fill the firstname.");
        isValidContactFname = false;
    } else if (!reOnlyAlphabet.test($("#fname").val())) {
        $("#fname").focusin();
        $("#fname").addClass("borderHighlight");
        $("#fnameVal").css("visibility", "visible");
        $("#fnameVal").html("Please enter only alphabets.");
        isValidContactFname = false;
    } else {
        $("#fname").removeClass("borderHighlight");
        $("#fnameVal").css("visibility", "hidden");
        isValidContactFname = true;
    }

    return isValidContactFname;

}

function validateContactEmail() {

    isValidContactEmail = false;

    if ($("#email").val() == "" || $("#email").val() == null || $("#email").val().trim().length == 0) {
        $("#email").focusin();
        $("#email").addClass("borderHighlight");
        $("#emailVal").css("visibility", "visible");
        $("#emailVal").html("Please fill the email.");
        isValidContactEmail = false;
    } else if (!reForEmail.test($("#email").val())) {
        $("#email").focusin();
        $("#email").addClass("borderHighlight");
        $("#emailVal").css("visibility", "visible");
        $("#emailVal").html("Please enter valid email.");
        isValidContactEmail = false;
    } else {
        $("#email").removeClass("borderHighlight");
        $("#emailVal").css("visibility", "hidden");
        isValidContactEmail = true;
    }

    return isValidContactEmail;

}

function validateContactSubject() {

    isValidContactSubject = false;

    if ($("#subject").val() == "" || $("#subject").val() == null || $("#subject").val().trim().length == 0) {
        $("#subject").focusin();
        $("#subject").addClass("borderHighlight");
        $("#subjectVal").css("visibility", "visible");
        $("#subjectVal").html("Please fill the subject.");
        isValidContactSubject = false;
    } else {
        $("#subject").removeClass("borderHighlight");
        $("#subjectVal").css("visibility", "hidden");
        isValidContactSubject = true;
    }

    return isValidContactSubject;

}

function validateContactComment() {

    isValidContactComment = false;

    if ($("#comment_contact").val() == "" || $("#comment_contact").val() == null || $("#comment_contact").val().trim().length == 0) {
        $("#comment_contact").focusin();
        $("#comment_contact").addClass("borderHighlight");
        $("#comment_contactVal").css("visibility", "visible");
        $("#comment_contactVal").html("Please fill out this field.");
        isValidContactComment = false;
    } else {
        $("#comment_contact").removeClass("borderHighlight");
        $("#comment_contactVal").css("visibility", "hidden");
        isValidContactComment = true;
    }

    return isValidContactComment;

}

function validateContactForm() {

    isValidateContactForm = false;

    isValidContactFname = validateContactFirstName();
    isValidContactEmail = validateContactEmail();
    isValidContactSubject = validateContactSubject();
    isValidContactComment = validateContactComment();

    if (isValidContactFname && isValidContactEmail && isValidContactSubject && isValidContactComment) {
        isValidateContactForm = true;
    }

    return isValidateContactForm;

}

/* =====================================
            Add Notes
======================================== */
function validateTitle() {

    isValidTitle = false;

    if ($("#title").val() == "" || $("#title").val() == null) {
        $("#title").focusin();
        $("#title").addClass("borderHighlight");
        $("#titleVal").css("visibility", "visible");
        $("#titleVal").html("Please fill out this field.");
        isValidTitle = false;
    } else {
        $("#title").removeClass("borderHighlight");
        $("#titleVal").css("visibility", "hidden");
        isValidTitle = true;
    }

    return isValidTitle;

}

function validateCatType() {

    isValidCatType = false;

    if ($("#catType").val() == 0) {
        $("#catType").focusin();
        $("#catType").addClass("borderHighlight");
        $("#catTypeVal").css("visibility", "visible");
        $("#catTypeVal").html("Please select anyone.");
        isValidCatType = false;
    } else {
        $("#catType").removeClass("borderHighlight");
        $("#catTypeVal").css("visibility", "hidden");
        isValidCatType = true;
    }

    return isValidCatType;

}

function validateDisplayPicture() {

    isValidDisplayPicture = false;

    if ($("#hdnDisplayPicPath").val() == "") {
        if ($("#displayPicture")[0].files.length != 0) {
            var ext = $('#displayPicture').val().split('.').pop().toLowerCase();
            if ($.inArray(ext, ['png', 'jpg', 'jpeg']) == -1) {
                $("#displayPicture").addClass("borderHighlight");
                $("#displayPictureVal").css("visibility", "visible");
                $("#displayPictureVal").html("Please upload jpg, jpeg, png files.");
                isValidDisplayPicture = false;
            } else {
                $("#displayPicture").removeClass("borderHighlight");
                $("#displayPictureVal").css("visibility", "hidden");
                isValidDisplayPicture = true;
            }
        } else {
            $("#displayPicture").removeClass("borderHighlight");
            $("#displayPictureVal").css("visibility", "hidden");
            isValidDisplayPicture = true;
        }
    } else {
        $("#displayPicture").removeClass("borderHighlight");
        $("#displayPictureVal").css("visibility", "hidden");
        isValidDisplayPicture = true;
    }
    return isValidDisplayPicture;
}

function validateNotes() {

    isValidNotes = false;
    var ext = $('#uploadNote').val().split('.').pop().toLowerCase();

    if ($("#hdnUploadNotePath").val() == "") {
        if ($("#uploadNote")[0].files.length == 0) {
            //$("#uploadNote").focusin();
            $("#uploadNote").addClass("borderHighlight");
            $("#uploadNoteVal").css("visibility", "visible");
            $("#uploadNoteVal").html("Please upload files.");
            isValidNotes = false;
        } else if ($.inArray(ext, ['pdf']) == -1) {
            $("#uploadNote").addClass("borderHighlight");
            $("#uploadNoteVal").css("visibility", "visible");
            $("#uploadNoteVal").html("Please upload pdf files.");
            isValidNotes = false;
        } else {
            $("#uploadNote").removeClass("borderHighlight");
            $("#uploadNoteVal").css("visibility", "hidden");
            isValidNotes = true;
        }
    } else {
        $("#uploadNote").removeClass("borderHighlight");
        $("#uploadNoteVal").css("visibility", "hidden");
        isValidNotes = true;
    }
    return isValidNotes;

}

function validateDescription() {

    isValidDescription = false;

    if ($("#description").val() == "" || $("#description").val() == null) {
        $("#description").focusin();
        $("#description").addClass("borderHighlight");
        $("#descriptionVal").css("visibility", "visible");
        $("#descriptionVal").html("Please fill the description field.");
        isValidDescription = false;
    } else {
        $("#description").removeClass("borderHighlight");
        $("#descriptionVal").css("visibility", "hidden");
        isValidDescription = true;
    }

    return isValidDescription;

}

function validateSellPrice() {

    isValidSellPrice = false;

    if ($("#sellPrice").val() == "" || $("#sellPrice").val() == null) {
        $("#sellPrice").focusin();
        $("#sellPrice").addClass("borderHighlight");
        $("#sellPriceVal").css("visibility", "visible");
        $("#sellPriceVal").html("Please fill the sell price.");
        isValidSellPrice = false;
    } else {
        $("#sellPrice").removeClass("borderHighlight");
        $("#sellPriceVal").css("visibility", "hidden");
        isValidSellPrice = true;
    }

    return isValidSellPrice;

}

function validateAddNoteForm() {

    isvalidAddNoteForm = false;

    isValidTitle = validateTitle();
    isValidCatType = validateCatType();
    isValidDisplayPicture = validateDisplayPicture();
    isValidNotes = validateNotes();
    isValidDescription = validateDescription();
    isValidSellPrice = validateSellPrice();
    //isValidNotePreview = validateNotePreview();

    if (isValidTitle && isValidCatType && isValidDisplayPicture && isValidNotes && isValidDescription && isValidSellPrice) {
        isvalidAddNoteForm = true;
    }

    return isvalidAddNoteForm;

}

/* =====================================
            Download Notes
======================================== */
    function downloadNoteFromTable(downloadNoteID,noteID = 0) {
        $.ajax({
            type: "POST",
            url: "download_note_from_table.php",
            data: {
                downloadNoteID: downloadNoteID,
                noteID: noteID
            },
            success: function (data) {
                window.location = data;
            }
        });
    }