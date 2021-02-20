/*****************************************************************/
//Contact page form behaviour and validation
/*****************************************************************/

    /*Form popups and validation*/
    /*----------------------------------------------------------*/
    //Establish variables from the DOM
    var $name = $("input#name");
    var $email = $("input#email");
    var $message = $("textarea#message")
    var $submitButton = $("input#submit");
    //Find popups in DOM (Always cone right before <input></input>)
    var $namePopup = $name.prev();
    var $emailPopup = $email.prev();
    var $messagePopup = $message.prev();

    //Initially hide popups
    $namePopup.hide();
    $emailPopup.hide();
    $messagePopup.hide();

    //Set up functions to check if input fields are valid
    function isNameValid(){
        return $name.val().length > 0;
    }
    function isEmailValid(){
        var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return re.test($email.val());
    }
    function isMessageValid(){
        return $message.val().length > 0;
    }

    //Set up function to check if all inputs are valid
    function allAreValid(){
        return (isNameValid() && isEmailValid() && isMessageValid());
    }

    //Set up "controler funcitons" that when called will determine whether or not
    //to show a popup next to a particular input field
    function namePopupControler(){
        if (isNameValid()){
            $namePopup.fadeOut("slow");
        } else {
            $namePopup.fadeIn("slow");
            $name.addClass("popupActivated");
        }
    }
    function emailPopupControler(){
        if (isEmailValid()){
            $emailPopup.fadeOut("slow");
        } else {
            $emailPopup.fadeIn("slow");
            $email.addClass("popupActivated");
        }
    }
    function messagePopupControler(){
        if (isMessageValid()){
            $messagePopup.fadeOut("slow");
        } else {
            $messagePopup.fadeIn("slow");
            $message.addClass("popupActivated");
        }
    }
    function allPopupController(){
        namePopupControler();
        emailPopupControler();
        messagePopupControler();
    }

    //Set up the different events that we want the form to react to
    var $buttonHasBeenPressed = false; //Special variable to determine whether or not the submit button has been pressed
    var $valueReturnedFromForm = -1; // -1=No  0=Yes(Error)  1=Yes(No Error - sent)
    //blur = when leaving an input field
    $name.blur(namePopupControler);
    $email.blur(emailPopupControler);
    $message.blur(messagePopupControler);
    
    $submitButton.click(function(){
        $buttonHasBeenPressed = true;
        event.preventDefault();
        if (!allAreValid()){
            allPopupController();
            $submitButton.css("background-color", "#FFA9AD");
            $submitButton.css("color", "white");
            $submitButton.val("Please check your details");
        } else {
            $url = $('form').attr('action');
            $data = $('form').serialize();

            //Remove the value in the submitButton and generate a spinner
            $submitButton.val("");
            var opts = {
              lines: 10, // The number of lines to draw
              length: 0, // The length of each line
              width: 4, // The line thickness
              radius: 15, // The radius of the inner circle
              corners: 1, // Corner roundness (0..1)
              rotate: 0, // The rotation offset
              direction: 1, // 1: clockwise, -1: counterclockwise
              color: '#000', // #rgb or #rrggbb or array of colors
              speed: 1, // Rounds per second
              trail: 54, // Afterglow percentage
              shadow: false, // Whether to render a shadow
              hwaccel: false, // Whether to use hardware acceleration
              className: 'spinner', // The CSS class to assign to the spinner
              zIndex: 2e9, // The z-index (defaults to 2000000000)
              top: '50%', // Top position relative to parent
              left: '50%' // Left position relative to parent
            };
            var target = $('div#submitButtonContainer');
            var spinner = new Spinner(opts).spin();
            $submitButton.after(spinner.el);
            
            //Function that will be called when when a response is received from the server or a connection error occurs
            callback = function (isSent) {
                $valueReturnedFromForm = isSent.responseText; // Store the variable to be used for later;
                console.log(isSent);
                if ($valueReturnedFromForm === "1"){
                    $submitButton.css("background-color", "#8DFFC9");
                    $submitButton.css("color", "");
                    $submitButton.val("We got your email, thanks!");
                    $name.val("");
                    $email.val("");
                    $message.val("");
                } else {
                    $submitButton.css("background-color", "#FFA9AD");
                    $submitButton.css("color", "white");
                    $submitButton.val("Something went wrong, please try again.");
                }
                spinner.stop();
            };

            //Ajax request
            $.ajax($url, {
                data: $data,
                type: "POST",
                complete: callback,
                error: function(){
                    callback("0");
                },
                timeout: 10000
            });
        }
    });

    //Function that determines what the color and value of the button should be
    function activateButton(){
        if (allAreValid()){
            $submitButton.val("Send");
            $submitButton.css("color", "");
            $submitButton.css("background-color", "#8DFFC9");
        } else if($buttonHasBeenPressed) {
            $submitButton.css("background-color", "#FFA9AD");
            $submitButton.css("color", "white");
            $submitButton.val("Please check your details");
        }
    }

    //React to keyup after a popup box has been shown to the user already
    $name.keyup(function(){
        if($name.hasClass("popupActivated")){
            namePopupControler();
        }
        activateButton();//Recheck what the color of the button should be
    });
    $email.keyup(function(){
        if($email.hasClass("popupActivated")){
            emailPopupControler();
        }
        activateButton();
    });
    $message.keyup(function(){
        if($message.hasClass("popupActivated")){
            messagePopupControler();
        }
        activateButton();
    });
    
    //Special funciton to be executed after submitting a form.
    //When a field of the form is clicked the form will return to normal.
    function returnToNormal(){
        if ($valueReturnedFromForm != -1){
            $("form").removeClass("sent error");
            $submitButton.css("background-color", "");
            $submitButton.css("color", "");
            $submitButton.val("Send");
            $valueReturnedFromForm = -1;//Reset the value returned from the server
            $buttonHasBeenPressed = false;
        }
    }
    //Click events for the above function
    $name.click(returnToNormal);
    $email.click(returnToNormal);
    $message.click(returnToNormal);




