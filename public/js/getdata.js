/**
 * Author Umar Riaz 
*/

$(function () {
    $(".backToSum").hide();
    $(document).ready(function () {
      $("#Ar-range").slider({
        range: true,
        min: 0,
        max: 100,
        values: [0, 100],
        slide: function (event, ui) {
          $("#Ar-value").val(ui.values[0] + " - " + ui.values[1]);
        },
      });
      $("#Ar-value").val(
        $("#Ar-range").slider("values", 0) +
          " - " +
          $("#Ar-range").slider("values", 1)
      );
    });
  
    $("#addpublication").click(function () {

      let p = 0;
      let pn =  $("#publications").children().length;
      p = (pn === 0) ? 0 : pn;
   

      console.log(p);

      
      $("#publications").append(
        `<div class="shadow-sm pubgroup" id="pub${p}">
    <div class="closebtn row"><div class="couter closebtn removePub float-right" id="removePub"> <div class="cinner"><label>Remove</label></div></div></div>
    <div class="row">
        <div class="form-group col-md-6 ">
            <label class="nl" for="p_title">Publication Title: <small class="text-danger"><i class="bi bi-asterisk"></i></small> </label>
            <input type="text" class="form-control pubt" name="pub[${p}][title]" placeholder="Enter title of publication.">
            <em class="help_block error text-danger" id="pub-${p}-title-error"></em>
        </div>
        <div class="form-group col-md-6 ">
            <label class="nl" for="p_venue">Journal Name: <small class="text-danger"><i class="bi bi-asterisk"></i></small> </label>
            <input type="text" class="form-control pubv" name="pub[${p}][p_venue]" placeholder="Enter name of Journal.">
            <em class="help_block error text-danger" id="pub-${p}-p_venue-error"></em>
        </div>
    </div>
    <div class="row">
        <div class="form-group col-md-4 ">
            <label class="nl" for="p_afname">First Author: <small class="text-danger"><i class="bi bi-asterisk"></i></small> </label>
            <input type="text" name="pub[${p}][afname]" class="form-control pubAn" placeholder="Enter Initial(s).Surname. of first author.">
            <em class="help_block error text-danger" id="pub-${p}-afname-error"></em>
        </div>
        <div class="form-group col-md-4 ">
            <label class="nl" for="p_date">Publication Year: <small class="text-danger"><i class="bi bi-asterisk"></i></small> </label>
            <input type="number" name="pub[${p}][p_date]" placeholder="YYYY" class="pubd form-control">
            <em class="help_block error text-danger" id="pub-${p}-p_date-error"></em>
        </div>
        <div class="form-group col-md-4 ">
            <label class="nl" for="p_odi">DOI: </label>
            <input type="text" name="pub[${p}][p_odi]" class="form-control pubdoi" placeholder="Enter publication DOI.">
            <em class="help_block error text-danger" id="pub-${p}-p_odi-error"></em>
        </div>
    </div>
</div>`
      );
    
      // var dt = new Date();
      // var Year = dt.getFullYear();
      // $(".pubd").rules("add", {
      //   : true,
      //   min: 1950,
      //   max: Year,
      // });
    });
  
    $("#addperson").click(function () {
      let r = 0;
      let rn =  $("#persons").children().length;
      r = (rn === 0) ? 0 : rn;
      console.log(r);

      $("#persons").append(
              `<div class="shadow-sm persongroup mt-3" id="per${r}">
          <div class="closebtn row">
              <div class="couter closebtn removePerson float-right" id="removePerson">
                  <div class="cinner"><label>Remove</label></div>
              </div>
          </div>
          <div class="row">
              <div class="form-group col-md-6 col-12 col-sm-6">
                  <label class="nl" for="per_title">Title:</label>
                  <span class="input-group">
                      <select name="researcher[${r}][title]" id="per_title[]" class="form-control per_title" style="height: 100%">
                          <option></option>
                      </select>
                  </span>
                  <em class="help_block error text-danger" id="researcher-${r}-title-error"></em>
              </div>
              <div class="form-group col-md-6 col-6 col-sm-6">
                  <label class="nl" for="per_email">Email: <small class="text-danger"><i class="bi bi-asterisk"></i></small></label>
                  <input class="form-control" type="email" name="researcher[${r}][email]" placeholder="Email of person">
                  <em class="help_block error text-danger" id="researcher-${r}-email-error"></em>
              </div>
          </div>
          <div class="row">
              <div class="form-group col-md-6 col-12 col-sm-6">
                  <label class="nl" for="per_forename">Forename: <small class="text-danger"><i class="bi bi-asterisk"></i></small></label>
                  <input type="text" name="researcher[${r}][forename]" class="form-control" placeholder="Enter forename">
                  <em class="help_block error text-danger" id="researcher-${r}-forename-error"></em>
              </div>
              <div class="form-group col-md-6 col-12 col-sm-6">
                  <label class="nl" for="per_surname">Surname: <small class="text-danger"><i class="bi bi-asterisk"></i></small></label>
                  <input type="text" name="researcher[${r}][surname]" class="form-control" placeholder="Enter surname">
                  <em class="help_block error text-danger" id="researcher-${r}-surname-error"></em>
              </div>
          </div>
          <div class="row">
              <div class="form-group col-md-12 col-sm-12 col-12">
                  <label class="nl" for="p_affiliation">Affiliations: <small class="text-danger"><i class="bi bi-asterisk"></i></small></label>
                  <span id="affiliations" class="input-group">
                      <select type="text" name="per_affiliation[]" class="form-control per_affiliation" multiple="multiple">
                          <option></option>
                      </select>
                  </span>
                  <input type="text" class="backvalue per_affiliationvalue" name="researcher[${r}][affiliations]">
                  <em class="help_block error text-danger" id="researcher-${r}-affiliations-error"></em>
              </div>
          </div>
      </div>
      `
      );
  
      var per_title = document.getElementsByClassName("per_title");
      if (typeof per_title != undefined && per_title != null) {
        $(".per_title").select2({
          placeholder: "Select title of the person.",
          data: ["Mr", "MS", "Miss", "Mrs", "Prof", "Dr"],
          allowClear: true,
          theme: "bootstrap-5",
          width: "100%",
        });
      }
      var per_issenior = document.getElementsByClassName("per_issenior");
  
      if (typeof per_issenior != undefined && per_title != null) {
        $(".per_issenior").select2({
          theme: "bootstrap-5",
          placeholder: "Please select",
          data: ["Yes", "No"],
          allowClear: true,
          width: "100%",
        });
      }
  
      var per_contactable = document.getElementsByClassName("per_contactable");
  
      if (typeof per_contactable != undefined && per_title != null) {
        $(".per_contactable").select2({
          placeholder: "Please select",
          data: ["Yes", "No"],
          allowClear: true,
          theme: "bootstrap-5",
          width: "100%",
        });
      }
  
      $(".per_affiliation").select2({
        placeholder: "Please enter organisation name and press enter",
        tags: true,
        tokenSeparators: [",", ";"],
        theme: "bootstrap-5",
        width: '100%'
    
      });
  
      $(".per_affiliation").on("change", function () {
        var sel = $(this);
  
        var value = "";
        var arr = sel.val();
  
        $.each(arr, function (e) {
          value += arr[e] + " ; ";
        });
  
        value = value.slice(0, -2);
  
        sel.parent().next('.per_affiliationvalue').val(value);
  
        
        if($(this).parent().find('.error').length!==0){
          if($(this).parent().find('.per_affiliationvalue').val()!=''){
            $(this).parent().find('.error').hide();
          }else{
            $(this).parent().find('.error').show();
          }
        }
        console.log( sel.parent().next('.per_affiliationvalue').val());
      });
  
     
    });
  
    $(".per_affiliation").on("change", function () {
      var sel = $(this);
  
      var value = "";
      var arr = sel.val();
  
      $.each(arr, function (e) {
        value += arr[e] + " ; ";
      });
  
      value = value.slice(0, -2);
  
   
  
      // per_affiliationvalue[]-error
  
      if($(this).parent().find('.error').length!==0){
        if($(this).parent().find('.per_affiliationvalue').val()!=''){
          $(this).parent().find('.error').hide();
        }else{
          $(this).parent().find('.error').show();
        }
      }
      // $("#d_fundervalue").val(value);
  
      // console.log($("#d_fundervalue").val());
    });
  
    $(".per_affiliation").select2({
      placeholder: "Please enter organisation name and press enter",
      tags: true,
      tokenSeparators: [",", ";"],
      theme: "bootstrap",
      width: '100%'
  
    });
    var per_title = document.getElementsByClassName("per_title");
    if (typeof per_title != undefined && per_title != null) {
      $(".per_title").select2({
        placeholder: "Select title of the person.",
        data: ["Mr", "MS", "Miss", "Mrs", "Prof", "Dr"],
        allowClear: true,
        theme: "bootstrap",
        width: "100%",
      });
    }
  
    var per_issenior = document.getElementsByClassName("per_issenior");
  
    if (typeof per_issenior != undefined && per_title != null) {
      $(".per_issenior").select2({
        theme: "bootstrap",
        placeholder: "Please select",
        data: ["Yes", "No"],
        allowClear: true,
        width: "100%",
      });
    }
  
    var per_contactable = document.getElementsByClassName("per_contactable");
  
    if (typeof per_contactable != undefined && per_title != null) {
      $(".per_contactable").select2({
        placeholder: "Please select",
        data: ["Yes", "No"],
        allowClear: true,
        theme: "bootstrap",
        width: "100%",
        min:1,
      });
    }
  
    $(document).on("click", ".removePub", function () {
      $(this).closest(".pubgroup").remove();
    });
  
    $(document).on("click", ".removeorg", function () {
      $(this).closest(".per_orggroup").remove();
    });
    $(document).on("click", ".removePerson", function () {
      $(this).closest(".persongroup").remove();
    });
  
    /// remaing text
  
    $(document).on("click", ".addorganisation", function () {
    
      var s =  $(this).closest(".per_org").attr('id');
      var n  = s[s.length -1];
      
      $(this).closest(".per_org").append(`
       
        <div class="per_orggroup mb-2">
        <div class="form-row">
          <input type="number" name="org_id${n}[]"  class="backvalue">
          <div class="col-md-4 col-sm-5 col-12"><input type="text" class="form-control org_name" placeholder="Organisation name" name="org_name${n}[]"></div>
          <div class="col-md-4 col-sm-5 col-10"><input type="text" class="form-control org_dept" placeholder="Department name" name="org_department${n}[]"></div>
          <div class="col-md-2 col-sm-2 col-2"><button type="button" id="removeorg" class="btn btn-small removeorg btn-danger"><i class="fas fa-minus"></i></button></div>
        </div>
      </div>
      
      `);
    });
  
    $(document).ready(function () {
      $("#d_title").keyup(function () {
        if (this.value.length > 200) {
          return false;
        }
        if (this.value.length < 1) {
          $("#d_titlerem").html(200 - this.value.length + " characters maximum.");
        } else {
          $("#d_titlerem").html(200 - this.value.length + " character left.");
        }
      });
  
      $("#d_abstract").keyup(function () {
        if (this.value.length > 500) {
          return false;
        }
        if (this.value.length < 1) {
          $("#d_abstractrem").html(500 + " characters maximum.");
        } else {
          $("#d_abstractrem").html(500 - this.value.length + " character left.");
        }
      });
  
      $("#d_controler").keyup(function () {
        if (this.value.length > 500) {
          return false;
        }
        if (this.value.length < 1) {
          $("#d_controlerrem").html(200 + " characters maximum.");
        } else {
          $("#d_controlerrem").html(200 - this.value.length + " character left.");
        }
      });
  
      $("#d_titlerem").html(200 + " characters maximum.");
      $("#d_abstractrem").html(500 + " characters maximum.");
      $("#d_controlerrem").html(200 + " characters maximum.");
      $("#d_datatypes").on("change", function () {
        var opts = [];
  
        var sel = $(this);
  
        var value = "";
        var arr = sel.val();
  
        $.each(arr, function (e) {
          value += arr[e] + " ; ";
        });
  
        value = value.trim().slice(0, -2);
  
        $("#d_datatypevalue").val(value);
  
        if($('#d_datatypevalue-error').length!==0){
          if($("#d_datatypevalue").val()!=''){
            $('#d_datatypevalue-error').hide();
          }else{
            $('#d_datatypevalue-error').show();
          }
        }
  
        console.log($("#d_datatypevalue").val());
      });
  
      $("#d_keyword").on("change", function () {
        var sel = $(this);
        var value = "";
        var arr = sel.val();
        $.each(arr, function (e) {
          value += arr[e] + " ; ";
        });
        value = value.slice(0, -2);
        $("#d_keywordvalue").val(value);
  
        if($('#d_keywordvalue-error').length!==0){
          if($("#d_keywordvalue").val()!=''){
            $('#d_keywordvalue-error').hide();
          }else{
            $('#d_keywordvalue-error').show();
          }
        }
  
        console.log($("#d_keywordvalue").val());
      });
  
      //d_legaljurisdition
  
      $("#d_legaljurisdiction").on("change", function () {
        var sel = $(this);
  
        var value = "";
        var arr = sel.val();
  
        $.each(arr, function (e) {
          value += arr[e] + " ; ";
        });
  
        value = value.slice(0, -2);
  
        $("#d_legaljurisdictionvalue").val(value);
  
        if($('#d_legaljurisdictionvalue-error').length!==0){
          if($("#d_legaljurisdictionvalue").val()!=''){
            $('#d_legaljurisdictionvalue-error').hide();
          }else{
            $('#d_legaljurisdictionvalue-error').show();
          }
        }
  
        console.log($("#d_legaljurisdiction").val());
      });
  
      // Contact Pointn  per_iscontactalue
  
      $(".per_contactable").on("change", function () {
        var sel = $(this);
  
        var value = "";
  
        value = sel.val();
  
        $(this)
          .closest(".perc")
          .find("input[name='per_iscontactvalue']")
          .val(value);
  
        // sel.closest(".per_iscontactvalue").val(value);
      });
  
      // d_funders
  
      $("#d_funders").on("change", function () {
        var sel = $(this);
  
        var value = "";
        var arr = sel.val();
  
        $.each(arr, function (e) {
          value += arr[e] + " ; ";
        });
  
        value = value.slice(0, -2);
        $("#d_fundervalue").val(value);
  
        if(sel.parent().find('.error').length!==0){
          if($("#d_fundervalue").val()!=''){
            sel.parent().find('.error').hide();
          }else{
            sel.parent().find('.error').show();
          }
        }
        console.log($("#d_fundervalue").val());
      });

  
      $("#d_ethnicity").on("change", function () {
        var sel = $(this);
  
        var value = "";
        var arr = sel.val();
  
        $.each(arr, function (e) {
          value += arr[e] + " ; ";
        });
  
        value = value.slice(0, -2);
  
        $("#d_ethnicityvalue").val(value);
  
        console.log($("#d_ethnicityvalue").val());
      });
  
      // d_geography
  
      $("#d_geography").on("change", function () {
        var sel = $(this);
  
        var value = "";
        var arr = sel.val();
  
        $.each(arr, function (e) {
          value += arr[e] + " ; ";
        });
  
        value = value.slice(0, -2);
  
        $("#d_geographyvalue").val(value);
  
        console.log($("#d_geographyvalue").val());
      });
 
      $("#d_hdrconsent").on("change",function(){
        var sel = $(this);
        var value = sel.val();
        console.log(value);
        $("#d_hdrconsentvalue").val(value);
        console.log($("#d_hdrconsentvalue").val());

      })

  
      $(document).on("#Submit", "click", function (event) {

        event.preventDefault();
        Swal.fire("SweetAlert2 is working!");
      });
    });
  });
  