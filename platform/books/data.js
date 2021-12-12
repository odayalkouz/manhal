    window.xDoc = '#daralmanhal_xml_data#';
    window.pageID = 1;
    window.xmlDoc = $.parseXML(xDoc);
    window.$xml = $(xmlDoc);
    window.SITE_URL = "https://www.manhal.com/";
    window.Lang = {
        "SignUp": "Sign Up",
        "InvalidEmail": "Invalid Email",
        "PassTooShort": "Password is too short",
        "PassNotMatch": "Password is not match",
        "InvalidActCode": "Activation code is invalid",
        "EmailExisit": "Email address already exist, please use another email or click on forget password if you don't rememeber your password",
        "Unexpected": "Unexpected error occured",
        "LogIn": "Login",
        "InvalidUserOrPass": "Invalid email address or password",
        "InvalidPermession": "you don't have permession to access this book, please subscribe <a target='_blank' href='https://www.manhal.com/ar/subscribe'>here</a> to access all Dar Al-Manhal books",
        "error": "error",
        "password": "Password",
        "msgSent": "Reset password info has been sent to your email , please check your mail to reset your password",
        "cannotSendMsg": "Unexpected error occured , cannot send message",
        "emailNotRegi": "invalid email address, this email not match any account",
        "ZoomIn": "Zoom In",
        "ZoomOut": "Zoom Out",
        "Activation": "Activation"
    };

    window.lastPage = $xml.find("pagesearch").length + 1;
    window.bookid = $xml.find("bookid").first().text();
    window.BookTitle = $xml.find("booktitle").text();
    window.pageWidth = $xml.find("width").text();
    window.pageHeight = $xml.find("height").text();

