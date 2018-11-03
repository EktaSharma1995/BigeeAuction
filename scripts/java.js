window.onload = function () {
    	//Setting onClick
        //document.getElementById('register').onclick = validate;
        //document.getElementById('btn_insert').onclick = insertForm();
        
    var optiontype = getUrlVars()["option"];
    console.log(optiontype);

    if(optiontype == "insert"){
        document.getElementById("auction_id").disabled = true;
    }
    
}



function getUrlVars() {
    var vars = {};
    var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
        vars[key] = value;
    });
    return vars;
}
