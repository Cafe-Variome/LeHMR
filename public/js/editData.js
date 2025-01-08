$(function () {
  // Handle form submissions
  const dataTypes = [
    "Demographics",
    "Phenotype",
    // Omics
    "Genomics",
    "Transcriptomics",
    "Epigenomics",
    "Metabolomics",
    "Microbiomics",
    "Proteomics",
    "Biochemical data",
    // Imaging
    "CT",
    "X-ray",
    "Ultrasound",
    "Echocardiogram",
    "Bone density imaging",
    "Myelogram",
    "Arthrogram",
  ];
  const countries = [
    // Europe
    "United Kingdom (UK)",
    "Albania",
    "Andorra",
    "Armenia",
    "Austria",
    "Azerbaijan",
    "Belarus",
    "Belgium",
    "Bosnia and Herzegovina",
    "Bulgaria",
    "Croatia",
    "Cyprus",
    "Czech Republic",
    "Denmark",
    "Estonia",
    "Finland",
    "France",
    "Georgia",
    "Germany",
    "Greece",
    "Hungary",
    "Iceland",
    "Ireland",
    "Italy",
    "Kosovo",
    "Latvia",
    "Liechtenstein",
    "Lithuania",
    "Luxembourg",
    "Macedonia",
    "Malta",
    "Moldova",
    "Monaco",
    "Montenegro",
    "Netherlands",
    "Norway",
    "Poland",
    "Portugal",
    "Romania",
    "San Marino",
    "Serbia",
    "Slovakia",
    "Slovenia",
    "Spain",
    "Sweden",
    "Switzerland",
    "Ukraine",
    "Vatican City (Holy See)",
    // Africa
    "Algeria",
    "Angola",
    "Benin",
    "Botswana",
    "Burkina Faso",
    "Burundi",
    "Cabo Verde",
    "Cameroon",
    "Cape Verde",
    "Central African Republic",
    "Chad",
    "Comoros",
    "Congo",
    "Cote d'Ivoire",
    "Djibouti",
    "Egypt",
    "Equatorial Guinea",
    "Eritrea",
    "Ethiopia",
    "Gabon",
    "Gambia",
    "Ghana",
    "Guinea",
    "Guinea-Bissau",
    "Ivory Coast",
    "Kenya",
    "Lesotho",
    "Liberia",
    "Libya",
    "Madagascar",
    "Malawi",
    "Mali",
    "Mauritania",
    "Mauritius",
    "Morocco",
    "Mozambique",
    "Namibia",
    "Niger",
    "Nigeria",
    "Rwanda",
    "Sao Tome and Principe",
    "Senegal",
    "Seychelles",
    "Sierra Leone",
    "Somalia",
    "South Africa",
    "South Sudan",
    "Sudan",
    "Swaziland",
    "Tanzania",
    "Togo",
    "Tunisia",
    "Uganda",
    "Zambia",
    "Zimbabwe",
    // Asia
    "Afghanistan",
    "Bahrain",
    "Bangladesh",
    "Bhutan",
    "Brunei",
    "Cambodia",
    "China",
    "Timor-Leste",
    "India",
    "Indonesia",
    "Iran",
    "Iraq",
    "Israel",
    "Japan",
    "Jordan",
    "Kazakhstan",
    "North Korea",
    "Kuwait",
    "Kyrgyzstan",
    "Laos",
    "Lebanon",
    "Malaysia",
    "Maldives",
    "Mongolia",
    "Myanmar (Burma)",
    "Nepal",
    "Oman",
    "Pakistan",
    "Palestine",
    "Philippines",
    "Qatar",
    "Russia",
    "Saudi Arabia",
    "Singapore",
    "South Korea",
    "Sri Lanka",
    "Syria",
    "Taiwan",
    "Tajikistan",
    "Thailand",
    "Turkey",
    "Turkmenistan",
    "United Arab Emirates",
    "dot Emirates",
    "Uzbekistan",
    "Vietnam",
    "Yemen",
    // North America
    "Antigua and Barbuda",
    "Bahamas",
    "Barbados",
    "Belize",
    "Canada",
    "Costa Rica",
    "Cuba",
    "Dominica",
    "Dominican Republic",
    "El Salvador",
    "Grenada",
    "Guatemala",
    "Haiti",
    "Honduras",
    "Jamaica",
    "Mexico",
    "Nicaragua",
    "Panama",
    "St. Kitts and Nevis",
    "St. Lucia",
    "St. Vincent and The Grenadines",
    "Trinidad and Tobago",
    "United States of America (USA)",
    // Oceania
    "Australia",
    "Fiji",
    "Kiribati",
    "Marshall Islands",
    "Micronesia",
    "Nauru",
    "New Zealand",
    "Palau",
    "Papua New Guinea",
    "Samoa",
    "Solomon Islands",
    "Tonga",
    "Tuvalu",
    "Vanuatu",
    // South America
    "Argentina",
    "Bolivia",
    "Brazil",
    "Chile",
    "Colombia",
    "Ecuador",
    "Guyana",
    "Paraguay",
    "Peru",
    "Suriname",
    "Uruguay",
    "Venezuela",
  ];

  $("#editDatasetModal").on("shown.bs.modal", function () {
    // Initialize selectpicker within the modal when it is shown
    // $("#d_geography").select2({
    //     placeholder: "Please state geographical coverage",
    //     tags: true,
    //     tokenSeparators: [",", ";"],
    //     theme: "bootstrap-5",
    //     width: '100%'

    //   });
    $("#d_datatheme").select2({
      theme: "bootstrap-5",
      width: "100%",
      placeholder: "Please enter theme or department",
      allowClear: true,
      tags: true,
    });
    $("#d_hdrconsent").select2({
      placeholder: "Please select your consent",
      theme: "bootstrap-5",
      allowClear: true,
      tags: true,
      width: "100%",
    });
    $("#d_keyword").select2({
      placeholder: "Please enter keyword",
      tags: true,
      tokenSeparators: [",", ";"],
      maximumSelectionLength: 10,
      theme: "bootstrap-5",
      width: "100%",
    });

    $("#d_datatypes").select2({
      placeholder: "Please enter datatypes",
      tags: true,
      tokenSeparators: [",", ";"],
      theme: "bootstrap-5",
      minimumSelectionLength: 1,
      data: dataTypes,
      width: "100%",
    });
    $("#d_legaljurisdiction").select2({
      placeholder: "Please select or enter allowed country name",
      tags: true,
      tokenSeparators: [",", ";"],
      theme: "bootstrap-5",
      data: countries,
      minimumSelectionLength: 1,
      width: "100%",
    });
    var data_agerange = $("#d_agerange").val().trim().split("-");
    //console.logdata_agerange);
    var values = [data_agerange[0], data_agerange[1]];
    // var values = [18, 45]
    $("#Ar-urange").slider({
      range: true,
      min: 0,
      max: 100,
      values: values,
      slide: function (event, ui) {
        $("#Ar-uvalue").val(ui.values[0] + "-" + ui.values[1]);
        $("#d_agerange").val(ui.values[0] + "-" + ui.values[1]);
      },
    });
    $("#Ar-uvalue").val(
      $("#Ar-urange").slider("values", 0) +
        " - " +
        $("#Ar-urange").slider("values", 1)
    );
  });

  // Handle dynamic adding of researcher fields
  function addResearcherField() {
    // Implement the logic for adding researcher fields dynamically
  }

  // Handle dynamic adding of publication fields
  function addPublicationField() {
    // Implement the logic for adding publication fields dynamically
  }

  // Toggle sections in the modal
  function toggleSection(sectionId) {
    $(`#${sectionId}`).on("click", function () {
      $(this).next().toggleClass("collapse");
    });
  }

  // Initialize toggle for sections
  function initializeToggleSections() {
    toggleSection("researchersSection");
    toggleSection("publicationsSection");
    toggleSection("conditionsSection");
  }

  // Handle back button

  $("#backButton").on("click", function () {
    window.history.back();
  });

  $("#updateDataset").on("click", function (event) {
    event.preventDefault(); // Prevent default form submission
    const section = "dataset";
    submitDatasetUpdate(section);
  });

  function submitDatasetUpdate(section) {
      Swal.fire({
        title: 'Updating...',
        text: 'Please wait while the data is being updated.',
        icon: 'info',
        allowOutsideClick: false,
        showConfirmButton: false,
        didOpen: () => {
            Swal.showLoading(); // Show a loading spinner
        }
    });
    const formData = gatherFormData(section);

    $.ajax({
      url: base_url + "modify/" + formData.encrypted_id,
      type: "POST",
      data: formData,
      success: function (response) {
        //console.logresponse)
        if (response.success) {
          // Show success message with Swal
          Swal.fire({
            title: "Success!",
            text: response.message,
            icon: "success",
            confirmButtonText: "OK",
          }).then(() => {
            // Optionally refresh or redirect the page
            location.reload();
          });
        } else {
          // Show validation errors
          let errorList = '<ul style="list-style: none; padding-left: 0; color: red;">';
          if(response.message != undefined){
            errorList += `<li>${response.message}</li>`
          }
          for (const [field, error] of Object.entries(response.errors)) {
              errorList += `<li>${error}</li>`;
          }
          errorList += '</ul>';
          Swal.fire({
            title: "Error!",
            html: errorList,
            icon: "error",
            confirmButtonText: "OK",
          });
          displayValidationErrors(response.errors);
        }
      },
      error: function (jqXHR, textStatus, errorThrown) {

        //console.logerrorThrown);
        //console.logtextStatus);
        //console.logjqXHR);
        Swal.fire({
          title: "Error!",
          text: errorThrown,
          icon: "error",
          confirmButtonText: "OK",
        });
      },
    });
  }

  // Gather form data based on section
  function gatherFormData(section) {
    let formData = {};

    switch (section) {
      case "dataset":
        formData = {
          encrypted_id: $("#encrypted_id").val(),
          section: section,
          d_title: $("#d_title").val(),
          d_abstract: $("#d_abstract").val(),
          d_datatheme: formatArrayAsString($("#d_datatheme").val()),
          d_funders: formatArrayAsString($("#d_funders").val()),
          d_ethnicity: formatArrayAsString($("#d_ethnicity").val()),
          d_datatypes: formatArrayAsString($("#d_datatypes").val()),
          d_keywords: formatArrayAsString($("#d_keyword").val()),
          d_researchstudy: $("#d_researchstudy").val(),
          d_geography: formatArrayAsString($("#d_geography").val()),
          d_studysize: $("#d_studysize").val(),
          d_agerange: $("#d_agerange").val(),
          d_arights: $("#d_arights").val(),
          d_organisation: $("#d_organisation").val(),
          d_conpoint: $("#d_conpoint").val(),
          d_controler: $("#d_controler").val(),
          d_legaljurisdiction: formatArrayAsString(
            $("#d_legaljurisdiction").val()
          ),
          d_hdrconsent: $("#d_hdrconsent").val(),
        };
        break;
      case "researchers":
        formData = {
          encrypted_id: $("#encrypted_id").val(),
          section: section,
          researcher: gatherResearchersData(),
        };
        break;
      case "publications":
        formData = {
          encrypted_id: $("#encrypted_id").val(),
          section: section,
          pub: gatherPublicationsData(),
        };
        break;
      case "conditions":
        formData = {
          encrypted_id: $("#encrypted_id").val(),
          section: section,
          condition: gatherConditionsData(),
        };
        break;
    }

    return formData;
  }

  // Display validation errors
  function displayValidationErrors(errors) {

    //console.logerrors)
    // Clear previous errors
    $(".error").html("");

    // Display new errors
    $.each(errors, function (field, errorMessage) {
      //console.logfield , errorMessage)
      $("#" + field + "-error").html(errorMessage);
    });
  }

  // Helper function to convert array to a semicolon-separated string
  function formatArrayAsString(value) {
    if (Array.isArray(value) && value.length > 0) {
      return value.join(";");
    }
    return value;
  }
  // Collect researcher data (if applicable)
  function gatherResearchersData() {
    let researchers = [];
    $(".persongroup").each(function (index) {
      const researcher = {
        title: $(this).find('.per_title').val(),
        firstname: $(this).find(`[name="researcher[${index}][forename]"]`).val(),
        surname: $(this).find(`[name="researcher[${index}][surname]"]`).val(),
        email:$(this).find(`[name="researcher[${index}][email]"]`).val(),
        affiliations: formatArrayAsString($(this).find(`[name="researcher[${index}][affiliations]`).val()),
      };
      researchers.push(researcher);
    });
    const arr = {};
    arr["researcher"] = researchers;
    //console.logarr)
    return arr;
  }
  // Collect publication data (if applicable)
  function gatherPublicationsData() {
    let publications = [];
    $(".pubgroup").each(function (index) {
      const publication = {
        title: $(this).find(`[name="pub[${index}][title]"]`).val(),
        p_venue: $(this).find(`[name="pub[${index}][p_venue]"]`).val(),
        afname: $(this).find(`[name="pub[${index}][afname]"]`).val(),
        p_date: $(this).find(`[name="pub[${index}][p_date]"]`).val(),
        p_odi: $(this).find(`[name="pub[${index}][p_odi]"]`).val(),
      };
      publications.push(publication);
    });
    const arr = {};
    arr["pubs"] = publications;

    //console.logarr);
    return arr;
  }
  // Collect condition data (if applicable)
  function gatherConditionsData() {
    return {
      // c_allowedcountries
      c_allowedcountries: formatArrayAsString($("#c_allowedcountries").val()),
      c_profituse: $("#c_profituse").val(),
      c_bru: formatArrayAsString($("#c_bru").val()),
      c_sru: formatArrayAsString($("#c_sru").val()),
      c_recontact: $("#c_contact").val(),
    };
  }


    // Researchers editResearchersModal

    $("#editResearchersModal").on("shown.bs.modal", function () {
        $(".per_title").select2({
            theme: "bootstrap-5",
            width: "100%",
            placeholder: "Please Select Title",
            allowClear: true,
            tags: true,
        });
        $(".per_affiliation").select2({
            theme: "bootstrap-5",
            width: "100%",
            allowClear: true,
            tags: true,
        });
    })

    $("#updateReseacher").on("click", function (event) {
      event.preventDefault(); // Prevent default form submission
      const section = "researchers";
      submitDatasetUpdate(section);
    });


    $("#UpdatePubs").on("click", function (event) {
      event.preventDefault(); // Prevent default form submission
      const section = "publications";
      submitDatasetUpdate(section);
    });

    // UpdateConditions

    $("#UpdateConditions").on("click", function (event) {
      event.preventDefault(); // Prevent default form submission
      const section = "conditions";
      submitDatasetUpdate(section);
    });

});
