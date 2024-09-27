/*
 tags.js Handling all the select and options.
 Author: Umar Riaz

*/ 
$(function () {
  $(document).ready(function () {

    autosize(document.querySelector('#d_title'));
    autosize(document.querySelector('#d_abstract'));
    autosize(document.querySelector('#d_controler'));

    
    var countries = [
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

    var ethinicity = [
      "English", 
      "Welsh", 
      "Scottish",
      "Northern Irish",
      "Irish",
      "Gypsy or Irish Traveller",
      "Any other White background",
      //Mixed 
      "White and Black Caribbean",
      "White and Black African",
      "White and Asian",
      "Any other Mixed or Multiple ethnic background",
      // Asian or Asian British
      "Indian",
      "Pakistani",
      "Bangladeshi",
      "Chinese",
      "Any other Asian background",
      //Black, African, Caribbean or Black British
      "African",
      "Caribbean",
      "Any other Black, African or Caribbean background",
      // Other ethnic group
      "Arab",
      "Any other ethnic group"
    ];

    $("#d_ethnicity").select2({
      placeholder: "Please select or enter ethinicity and press enter",
      tags: true,
      tokenSeparators: [",", ";"],
      theme: "bootstrap-5",
      data: ethinicity,
      width: '100%'

    });
    $("#mytest").select2({
    placeholder:"Please select or enter allowed country name",
    dropdownAutoWidth: true,
    multiple: true,
    tags: true,
    tokenSeparators: [",", ";"],
    theme: "bootstrap-5",
    data: countries,
    width: '100%'
    });

    //d_legaljurisdition
    $(".d_legaljurisdiction").select2({
      placeholder: "Please select or enter allowed country name",
      tags: true,
      tokenSeparators: [",", ";"],
      theme: "bootstrap-5",
      data: countries,
      minimumSelectionLength: 1,
      width: '100%'
    });

    $(".c_allowedcountries").select2({
      placeholder: "Please select or enter allowed country name",
      tags: true,
      tokenSeparators: [",", ";"],
      theme: "bootstrap-5",
      data: countries,
      width: '100%'
    });
    $(".c_bru").select2({
      placeholder: "Please select or enter broad research uses",
      tags: true,
      tokenSeparators: [",", ";"],
      theme: "bootstrap-5",
      data: ["Method development","Reference or Control material","Research on Population","Research on ancestry","Biomedical Research"]
    });
    $(".c_sru").select2({
      placeholder: "Please select or enter specific research uses",
      tags: true,
      tokenSeparators: [",", ";"],
      theme: "bootstrap-5",
      data: ["Research on fundamental biology","Research on genetics","Research on drug development","Research on age categories","Research on gender categories"]
    });
    $("#d_funders").select2({
      placeholder: "Please enter funder name and press enter",
      tags: true,
      tokenSeparators: [",", ";"],
      theme: "bootstrap-5",
      width: '100%'

    });

    $("#d_geography").select2({
      placeholder: "Please state geographical coverage",
      tags: true,
      tokenSeparators: [",", ";"],
      theme: "bootstrap-5",
      width: '100%'

    });

    $("#c_profituse").select2({
      placeholder: "Can dataset be used for profit.",
      data: ["Yes", "No"],
      allowClear: true,
      theme: "bootstrap-5",
      width: '100%'

    });
    $("#c_contact").select2({
      placeholder: "Can research participants be recontacted.",
      data: ["Yes", "No"],
      allowClear: true,
      theme: "bootstrap-5",
      width: '100%'
    });

    $("#d_keyword").select2({
      placeholder: "Please enter keyword name and press enter",
      tags: true,
      tokenSeparators: [",", ";"],
      maximumSelectionLength: 10,
      theme: "bootstrap-5",
      width: '100%'
    });
    // $("#d_datatheme").select2({
    //   placeholder:"Please select or enter theme or department related to dataset",
    //   theme:"bootstrap-5",
    //   allowClear: true,
    //   tags: true,
    //   width: '100%',
    // });

    $( '#d_datatheme' ).select2( {
      theme: "bootstrap-5",
      width: '100%',
      placeholder: "Please select or enter theme or department related to dataset",
      allowClear: true,
      tags: true,
  } );

    $("#d_hdrconsent").select2({
      placeholder:"Please select your consent",
      theme:"bootstrap-5",
      allowClear: true,
      tags: true,
      width: '100%'

    });
    let dataType = [
      "Genetics",
      "Expression data", 
      "Epigenetics",
      "Biochemical data",
      "Phenotype",
      "Demographics",
      "Genomics",
      "Transcriptomics",
      "Epigenomics",
      "Microbiomics",
      "Metabolomics",
      "MRI", "CT" , "Ultrasound", "X-rays", "Mammography", "Bone density imaging", "Myelogram", "Arthrogram"
    ]
    let dataTypes =[
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
      "Arthrogram"
    ]
    $(".d_datatypes").select2({
      placeholder: "Please select or enter datatype and press enter",
      tags: true,
      tokenSeparators: [",", ";"],
      theme: "bootstrap-5",
      minimumSelectionLength: 1,
      data:dataTypes,
      width: '100%'
    });
  });
});
