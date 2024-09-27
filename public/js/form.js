$(function () {
  var current_fs, next_fs, previous_fs; //fieldsets
  var left, opacity, scale; //fieldset properties which we will animate
  var animating = false; //flag to prevent quick multi-click glitches
  var kids = $(".msform").children();
  $(".backToSum").hide(); //hide back to summary button

  // Go Next
  $(".next").on("click", async function (e) {
    e.preventDefault(); // Prevent the form from submitting the traditional way
    current_fs = $(this).parent();
    let id = $(this).attr("id");

    let goodTogo = await SanitizeAndValidate(current_fs);
    // console.log(goodTogo);
    goodTogo = true;
    if (goodTogo) {
      if (animating) return false;
      animating = true;

      let id = $(this).attr("id");
      next_fs = $(this).parent().next();

      // $("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");;
      $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");

      //show the next fieldset
      next_fs.show();
      //hide the current fieldset with style
      current_fs.animate(
        {
          opacity: 0,
        },
        {
          step: function (now, mx) {
            //as the opacity of current_fs reduces to 0 - stored in "now"
            //1. scale current_fs down to 80%
            scale = 1 - (1 - now) * 0.2;
            //2. bring next_fs from the right(50%)
            left = now * 50 + "%";
            //3. increase opacity of next_fs to 1 as it moves in
            opacity = 1 - now;
            current_fs.css({
              transform: "scale(" + scale + ")",
              // position: "absolute"
            });
            next_fs.css({
              left: left,
              opacity: opacity,
            });
          },
          duration: 200,
          complete: function () {
            current_fs.hide();
            animating = false;
          },
          //this comes from the custom easing plugin
          easing: "easeInOutBack",
        }
      );
      addToSummary(id);
    }
  });

  // Go Back

  $(".previous").on("click", function () {
    if (animating) return false;
    animating = true;
    let id = $(this).attr("id");
    current_fs = $(this).parent();
    previous_fs = $(this).parent().prev();

    //de-activate current step on progressbar
    $("#progressbar li")
      .eq($("fieldset").index(current_fs))
      .removeClass("active");
    //show the previous fieldset
    previous_fs.show();
    // current_fs.hide();
    // hide current with style
    current_fs.animate(
      {
        opacity: 0,
      },
      {
        step: function (now, mx) {
          //as the opacity of current_fs reduces to 0 - stored in "now"
          //1. scale previous_fs from 80% to 100%
          scale = 0.8 + (1 - now) * 0.2;
          //2. take current_fs to the right(50%) - from 0%
          left = (1 - now) * 50 + "%";
          //3. increase opacity of previous_fs to 1 as it moves in
          opacity = 1 - now;
          current_fs.css({
            left: left,
          });
          previous_fs.css({
            transform: "scale(" + scale + ")",
            opacity: opacity,
          });
        },
        duration: 800,
        complete: function () {
          current_fs.hide();
          animating = false;
        },
        //this comes from the custom easing plugin
        easing: "easeInOutBack",
      }
    );

    $("html, body").animate(
      {
        scrollTop: 0,
      },
      300
    );
  });

  // SummaryToForm

  $(".edit").on("click", function () {
    let id = $(this).attr("id");

    switch (id) {
      case "edituserinfo":
        previous_fs = $("#userinfofield");
        infoNumber = 0;
        break;
      case "editdatasetinfo":
        previous_fs = $("#datasetfield");
        infoNumber = 1;
        break;
      case "editpersoninfo":
        previous_fs = $("#personinfo");
        infoNumber = 2;
        break;
      case "editpersoninfo":
        previous_fs = $("#personinfo");
        infoNumber = 3;
        break;
      case "editconinfo":
        previous_fs = $("#conditioninfo");
        infoNumber = 4;
        break;
      case "editpubinfo":
        previous_fs = $("#publicationinfo");
        infoNumber = 5;
        break;

      default:
        break;
    }

    BackToInfo(infoNumber, previous_fs);
  });

  // FormToSummary
  $(".backToSum").on("click", async function () {
    let id = $(this).attr("id");
    var infoNumber = 0;
    switch (id) {
      case "userToSum":
        current_fs = $("#userinfofield");
        infoNumber = 1;
        break;
      case "dataToSum":
        current_fs = $("#datasetfield");
        infoNumber = 2;
        break;
      case "personToSum":
        current_fs = $("#personinfo");
        infoNumber = 3;
        break;
      case "conToSum":
        current_fs = $("#conditioninfo");
        infoNumber = 4;
        break;
      case "pubInfo":
        current_fs = $("#publicationinfo");
        infoNumber = 5;
        break;
    }
    let goodTogo = await SanitizeAndValidate(current_fs);
    goodTogo = true;
    if (goodTogo) {
      BackToR(infoNumber, current_fs);
      addToSummary(id);
    }
  });

  var BackToInfo = function (infoNumber, previous_fs) {
    if (animating) return false;
    animating = true;
    current_fs = $("#summaryField");
    for (var i = infoNumber + 1; i <= 6; i++) {
      if (
        $("#progressbar li").eq($("fieldset").index(kids[i])).hasClass("active")
      ) {
        $("#progressbar li")
          .eq($("fieldset").index(kids[i]))
          .removeClass("active");
      }
    }

    previous_fs.show();
    goBack(current_fs);
    $(".backToSum").show();
  };

  // go Back

  var goBack = function (current_fs) {
    current_fs.animate(
      {
        opacity: 0,
      },
      {
        step: function (now, mx) {
          //as the opacity of current_fs reduces to 0 - stored in "now"
          //1. scale previous_fs from 80% to 100%
          scale = 0.8 + (1 - now) * 0.2;
          //2. take current_fs to the right(50%) - from 0%
          left = (1 - now) * 50 + "%";
          //3. increase opacity of previous_fs to 1 as it moves in
          opacity = 1 - now;
          current_fs.css({
            left: left,
          });
          previous_fs.css({
            transform: "scale(" + scale + ")",
            opacity: opacity,
          });
        },
        duration: 800,
        complete: function () {
          current_fs.hide();
          animating = false;
        },
        //this comes from the custom easing plugin
        easing: "easeInOutBack",
      }
    );
  };

  // go Next

  var goNext = function (current_fs) {
    current_fs.animate(
      {
        opacity: 0,
      },
      {
        step: function (now, mx) {
          //as the opacity of current_fs reduces to 0 - stored in "now"
          //1. scale current_fs down to 80%
          scale = 1 - (1 - now) * 0.2;
          //2. bring next_fs from the right(50%)
          left = now * 50 + "%";
          //3. increase opacity of next_fs to 1 as it moves in
          opacity = 1 - now;
          current_fs.css({
            transform: "scale(" + scale + ")",
            // position: "absolute"
          });
          next_fs.css({
            left: left,
            opacity: opacity,
          });
        },
        duration: 800,
        complete: function () {
          current_fs.hide();
          animating = false;
        },
        //this comes from the custom easing plugin
        easing: "easeInOutBack",
      }
    );
  };

  var BackToR = function (infoNumber, current_fs) {
    if (animating) return false;
    animating = true;
    next_fs = $("#summaryField");

    for (var i = infoNumber; i <= 6; i++) {
      if (
        !$("#progressbar li")
          .eq($("fieldset").index(kids[i]))
          .hasClass("active")
      ) {
        $("#progressbar li")
          .eq($("fieldset").index(kids[i]))
          .addClass("active");
      }
    }

    next_fs.show();

    goNext(current_fs);
    $(".backToSum").hide();
  };

  var SanitizeAndValidate = async (current_fs) => {
    var formData = current_fs.find("input, select, textarea").serialize();
    console.log(current_fs);
    console.log(formData);

    // Check if formData only contains the step value
    if (formData === "step=three" || formData === "step=five") {
      return true; // Skip validation and return true
    }

    try {
      let response = await $.ajax({
        url: base_url + "form/validateStep",
        method: "POST",
        data: formData,
      });

      $(".error").text(""); // Clear all error messages
      console.log(response); // Log the entire response for debugging
      if (response.success) {
        return true;
      } else {
        $.each(response.errors, function (key, value) {
          console.log(key, value); // Log each key-value pair for debugging
          $("#" + key + "-error").text(value);
        });
        return false;
      }
    } catch (error) {
      console.error("Validation failed:", error);
      return false;
    }
  };

  $(document).ready(function () {
    const url = window.location.href;
    console.log(url);
    let names = url.split("/");
    let router = names[4];
    console.log(router);
    let me = $('ul li a');
    switch (router) {
      case "Getdata":
        $("#adddata").parent().addClass("active");
        break;
        case "editdata":
        case "viewdata":
        case "update":
        $("#editdata").parent().addClass("active");
        break;
      case "developing":
        $("#explore").parent().addClass("active");
        break;
    
      default:
        $("#home").parent().addClass("active");
        break;
    }
  });
});
