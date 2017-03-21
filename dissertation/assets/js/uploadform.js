$( "#upload" ).on("click", function() {
    $( ".uploadpopup" ).css( "display", "block" );
    $( ".maincontainer" ).css( "display", "none");
});

$( "#uploadclose" ).on("click", function() {
    $( ".uploadpopup" ).css( "display", "none" );
    $( ".maincontainer" ).css( "display", "block");
});

$("#ITselection").change(function() {
    if($("#Jselected").is(":selected") || $("#TSelected").is(":selected")) {
        $("#tSize").css({"display":"block"});
    }
    else {
        $("#tSize").css({"display":"none"});
    }
    if($("#Bselected").is(":selected")) {
        $("#bSize").css({"display":"block"});
    }
    else {
        $("#bSize").css({"display":"none"});
    }
    if($("#Sselected").is(":selected")) {
        $("#sSize").css({"display":"block"});
    }
    else {
        $("#sSize").css({"display":"none"});
    }
    if($("#Aselected").is(":selected")) {
        $("#Fselection").css({"display":"none"});
    }
    else {
    }
});