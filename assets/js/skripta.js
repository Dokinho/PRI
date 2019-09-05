let editCount = 0;

function promjeniEmail() {
    //Polja za unos
    var email = document.getElementById("email");
    var emailConf = document.getElementById("mailconf");

    //Ikonice
    var emailEdit = document.getElementById("email-edit");
    var emailUnedit = document.getElementById("email-unedit");

    //Grupe forme
    var emailConfGroup = document.getElementById("mail-conf-group");

    //Skriveno kontrolno polje
    var mailChange = document.getElementById("mail-change");
    
    email.removeAttribute("disabled");
    email.value = "";
    emailConf.value = "";

    emailEdit.style.display = "none";
    emailUnedit.style.display = "inline";

    emailConfGroup.style.display = "block";

    mailChange.value = "value";

    editCount++;
    hideShowGumb();
}

function unPromjeniEmail() {
    //Polja za unos
    var email = document.getElementById("email");
    var emailConf = document.getElementById("mailconf");

    //Ikonice
    var emailEdit = document.getElementById("email-edit");
    var emailUnedit = document.getElementById("email-unedit");

    //Grupe forme
    var emailConfGroup = document.getElementById("mail-conf-group");

    //Skriveno kontrolno polje
    var mailChange = document.getElementById("mail-change");

    var stariEmail = document.getElementById("emailvar").textContent;

    email.setAttribute("disabled", "");
    email.value = stariEmail;
    emailConf.value = "";

    emailEdit.style.display = "inline";
    emailUnedit.style.display = "none";

    emailConfGroup.style.display = "none";

    mailChange.value = "";

    editCount--;
    hideShowGumb();
}

function promjeniLozinku () {
    //Polja za unos
    var pass = document.getElementById("lozinka");
    var passConf = document.getElementById("passconf");
    var oldPass = document.getElementById("oldlozinka");

    //Ikonice
    var passEdit = document.getElementById("pass-edit");
    var passUnedit = document.getElementById("pass-unedit");

    //Grupe forme
    var passGroup = document.getElementById("lozinka-group");
    var passConfGroup = document.getElementById("pass-conf-group");
    var oldPassGroup = document.getElementById("old-lozinka-group");

    //Skriveno kontrolno polje
    var passChange = document.getElementById("pass-change");
    
    pass.removeAttribute("disabled");
    pass.value = "";
    passConf.value = "";
    oldPass.value = "";

    passEdit.style.display = "none";
    passUnedit.style.display = "inline";

    passGroup.childNodes[1].setAttribute("class", "form-text");
    passConfGroup.style.display = "block";
    oldPassGroup.style.display = "block";

    passChange.value = "value";

    editCount++;
    hideShowGumb();
}

function unPromjeniLozinku () {
    //Polja za unos
    var pass = document.getElementById("lozinka");
    var passConf = document.getElementById("passconf");
    var oldPass = document.getElementById("oldlozinka");
 
    //Ikonice
    var passEdit = document.getElementById("pass-edit");
    var passUnedit = document.getElementById("pass-unedit");

    //Grupe forme
    var passGroup = document.getElementById("lozinka-group");
    var passConfGroup = document.getElementById("pass-conf-group");
    var oldPassGroup = document.getElementById("old-lozinka-group");
    
    //Skriveno kontrolno polje
    var passChange = document.getElementById("pass-change");

    pass.setAttribute("disabled", "");
    pass.value = "**********";
    passConf.value = "";
    oldPass.value = "";

    passEdit.style.display = "inline";
    passUnedit.style.display = "none";

    passGroup.childNodes[1].setAttribute("class","form-text recenter");
    passConfGroup.style.display = "none";
    oldPassGroup.style.display = "none";

    passChange.value = "";

    editCount--;
    hideShowGumb();
}

function hideShowGumb () {
    var gumb = document.getElementById("promjeni");

    if (editCount > 0) gumb.style.display = "block";
    else gumb.style.display = "none";
}

function promjeniAdresu(id) {
    //Ikonice
    var adrEdit = document.getElementById("adr-edit-" + id);
    var adrUnedit = document.getElementById("adr-unedit-" + id);

    //Forma
    var forma = document.getElementById("adr" + id);

    adrEdit.style.display = "none";
    adrUnedit.style.display = "inline";

    forma.style.display = "flex";
}

function unPromjeniAdresu(id) {
    //Ikonice
    var adrEdit = document.getElementById("adr-edit-" + id);
    var adrUnedit = document.getElementById("adr-unedit-" + id);

    //Forma
    var forma = document.getElementById("adr" + id);

    adrEdit.style.display = "inline";
    adrUnedit.style.display = "none";

    forma.style.display = "none";
}

function novaAdresa() {
    //Ikonice
    var adrAdd = document.getElementById("adr-add");
    var adrUnadd = document.getElementById("adr-unadd");

    //Forma
    var newAdr = document.getElementById("adr-new");

    adrAdd.style.display = "none";
    adrUnadd.style.display = "inline";

    newAdr.style.display = "flex";
}

function unNovaAdresa() {
    //Ikonice
    var adrAdd = document.getElementById("adr-add");
    var adrUnadd = document.getElementById("adr-unadd");

    //Forma
    var newAdr = document.getElementById("adr-new");

    adrAdd.style.display = "inline";
    adrUnadd.style.display = "none";

    newAdr.style.display = "none";
}

function oznaciAdresu() {
    var adresa = document.getElementById("adr-input-0");
    adresa.checked = "checked";
}