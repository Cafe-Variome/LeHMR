var addToSummary = function(id){
    switch(id){
        case "userInfo":
        case "userToSum":
            addToReview("userinformation",$("#userinfobody"));
            break;
        case "dataInfo":
        case "dataToSum":
            addToReview("dataset",$("#datainfobody"));
            break;
        case "perInfo":
        case "personToSum":
            AddResToReview("persons",$("#personbody"));
            break;
        case "conInfo":
        case "conToSum":
            addToReview("condition",$("#conditionbody"));
            break;
        case "pubInfo":
            AddPubToReview("publications",$("#publicationbody"));
            break;

        default:
            break;
    }

}
var addToReview = function(Fid,tbid){
    var McInfo =[];
    McInfo.splice(0, McInfo.length);
    tbid.empty();
    var divElem = document.getElementById(Fid);
    var inputElements = divElem.querySelectorAll("input, select, textarea");
    $.each(inputElements, function () {
        var input = $(this);
        var emElement = $(input).closest('div').find('em').first();
        var name = input.parent().find(".nl").text().slice(0, -1);
        var value = sanitizeInput(input.val());
        value = value
        if (name && value !="") {
            if (Array.isArray(value)) {
                McInfo.push({ "Name": name, "Value": value.filter(v => v !== undefined).join(";") });
            } else {
                McInfo.push({ "Name": name, "Value": value });
                
            }
        }else if(emElement.length > 0 && emElement.text().trim() !== ""&&name){
            tbid.append(`
                <tr class="table-danger">
                    <td class="text-start"><b>${name}</b></td>
                    <td colspan="4" class="text-start" style="white-space:wordwrap !important; width:100%;">${emElement.text().trim()}</td>
                </tr>
            `);
        }
    });
    McInfo = McInfo.filter(function(e) {
        const excludedValues = ["0 - 100", "one", "two", "three", "four" ,"five"];
        return !excludedValues.includes(e.Value);
    });
    
    const seenNames = new Set();

    McInfo = McInfo.filter(function(e) {
        if (seenNames.has(e.Name)) {
            return false; // Skip this item if the name has already been seen
        } else {
            seenNames.add(e.Name); // Add the name to the set
            return true; // Keep this item
        }
    });

    McInfo.forEach(function (e) {
        //console.loge);
        tbid.append(`
            <tr>
                <td class="text-start "><b>${e.Name}</b></td>
                <td colspan ="4"  class="text-start" style="white-space:wordwrap !imortant; width:100%;">${e.Value}</td>
            </tr>
        `);
    });
  

}
var AddPubToReview = function(Fid,tbid){
   let Publications = [];
   Publications.splice(0, Publications.length);
   tbid.empty();
   var pubgroups = document.getElementsByClassName("pubgroup");
   $.each(pubgroups,function(x){
        var valid = [];
        var invalid = [];
        let pub = pubgroups[x].querySelectorAll("input");
        var entry =[];
        $.each(pub,function(){
            var vitem ={} ; var initem = {};
            var input = $(this);
            var emElement = $(input).closest('div').find('em').first();
            var name = input.parent().find(".nl").text().trim().slice(0, -1);
            var value = sanitizeInput(input.val());
            if (name && value !== "") {
                vitem["Name"] = name; vitem["Value"] = value; valid.push(vitem);
            }
        })
        entry.push(valid); entry.push(invalid);
        Publications.push(entry);
   })
   if(Publications.length>0){
    var i = 1;
    Publications.forEach(function(e){
        let valid = e[0]; let invalid = e[1];
        if(valid.length>0){
            valid.forEach(e => {
               
                if(e.Name == "Publication Title"){
                    $("#publicationbody").append(`<tr><td class=" text-center" colspan="2"><b>${i}: ${e.Value} </b> </td></tr>`);
                }else{
                    $("#publicationbody").append(`<tr><td><b>${e.Name}</b></td><td class="text-left">${e.Value}</td></tr>`)
                }
            });
        }
        if(invalid.length>0){
            invalid.forEach(e=>{
                if(e.Name == "Publication Title"){
                    $("#publicationbody").append(`<tr><td class=" table-danger text-center" colspan="2"><b>${i}: ${e.Value} </b> </td></tr>`);
                }else{
                    $("#publicationbody").append(`<tr class="table-danger" ><td><b>${e.Name}</b></td><td class="text-left">${e.Value}</td></tr>`);
                }

            })
        }
        i++;
    })
   }


}
var AddResToReview = function(Fid,tbid){
    const PersonInfo = [];
    $("#personbody").empty();
    const inputElements = document.querySelectorAll(".persongroup");
    inputElements.forEach((element, index) => {
        const allInputs = element.querySelectorAll("input, select");
        const Name = [];
        const Info = [];
        const invalid = [];
        allInputs.forEach(inputElement => {
            const input = $(inputElement);
            const name = input.parent().find(".nl").text().trim().slice(0, -1);
            const value = sanitizeInput(input.val());
            if (name && value) {
                if (name === "Person Title" || name === "Forename" || name === "Surname") {
                    Name.push({ [name.slice(0, 2).toLowerCase()]: value });
                } else if(name === "Affiliations" || name === "Email"){
                    if (name === "Email" && !validateEmail(value)) {
                        invalid.push({ "Name": "Email", "Value": "Please enter a valid email." });
                    } else {
                        Info.push({ "Name": name, "Value": value });
                    }

                }
            }
        })
        PersonInfo.push([Name, Info, invalid]);

    });

    if (PersonInfo.length > 0) {
        PersonInfo.forEach((person, i) => {
            let nameStr = `${i + 1}: `;
            person[0].forEach(nameObj => {
                nameStr += `${Object.values(nameObj)} `;
            });
            if (nameStr.trim() !== `${i + 1}:`) {
                $("#personbody").append(`
                    <tr>
                        <td class="text-center" colspan="2"><b>${nameStr.trim()}</b></td>
                    </tr>
                `);
            }
            person[1].forEach(info => {
                $("#personbody").append(`
                    <tr>
                        <td><b>${info.Name}</b></td>
                        <td class="text-left">${info.Value}</td>
                    </tr>
                `);
            });
            person[2].forEach(error => {
                $("#personbody").append(`
                    <tr class="table-danger">
                        <td><b>${error.Name}</b></td>
                        <td class="text-left">${error.Value}</td>
                    </tr>
                `);
            });
        });
    }

}

function sanitizeInput(value) {
    if (Array.isArray(value)) {
        return value
            .filter(v => v !== undefined && v !== null) // Filter out undefined and null values
            .map(v => sanitizeSingleValue(v));           // Sanitize each value in the array
    } else {
        return sanitizeSingleValue(value);
    }
}

function sanitizeSingleValue(value) {
    if (typeof value !== 'string') return '';           // Ensure value is a string
    return value
        .replace(/<script.*?>.*?<\/script>/gi, '')      // Remove script tags
        .replace(/['"]/g, '')                           // Remove single and double quotes
        .replace(/;--/g, '')                            // Remove SQL comments
        .replace(/<|>/g, '');                           // Remove angle brackets
}
const validateEmail = (email) => {
    const emailReg = /^[\w-.]+@([\w-]+\.)+[\w-]{2,4}$/;
    return emailReg.test(email);
};

const isUrl = (str) => {
    const regexp = /^(?:(?:https?|ftp):\/\/)?(?:\S+(?::\S*)?@)?(?:(?!10|127)(?:\.\d{1,3}){3})(?!(?:169\.254|192\.168)(?:\.\d{1,3}){2})(?!172\.(?:1[6-9]|2\d|3[0-1])(?:\.\d{1,3}){2})(?:[1-9]\d?|1\d\d|2[01]\d|22[0-3])(?:\.(?:1?\d{1,2}|2[0-4]\d|25[0-5])){2}(?:\.(?:1?\d{1,2}|2[0-4]\d|25[0-4]))|(?:(?:[a-z\u00a1-\uffff0-9]-*)*[a-z\u00a1-\uffff0-9]+)(?:\.(?:[a-z\u00a1-\uffff0-9]-*)*[a-z\u00a1-\uffff0-9]+)*(?:\.(?:[a-z\u00a1-\uffff]{2,}))(?::\d{2,5})?(?:\/\S*)?$/i;
    return regexp.test(str);
};