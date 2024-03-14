<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Payfast Payment Processor | Online Payments in South Africa</title>
    <script src="https://kit.fontawesome.com/90ebafaa2a.js" crossorigin="anonymous"></script>
    <style>
        /* Fonts */
        @font-face {
            font-family: "RocGrotesk";
            font-weight: 300;
            font-style: normal;
            src: url(/../eng/fonts/RocGroteskLight.eot);
            src: local('RocGrotesk Light'), local('RocGrotesk-Light'), url(/../eng/fonts/RocGroteskLight.eot?#iefix) format('embedded-opentype'), url(/../eng/fonts/RocGroteskLight.woff2) format('woff2'), url(/../eng/fonts/RocGroteskLight.woff) format('woff'), url(/../eng/fonts/RocGroteskLight.ttf) format('truetype'), url(/../eng/fonts/RocGroteskLight.svg#RocGrotesk) format('svg');
        }

        @font-face {
            font-family: "RocGrotesk";
            font-weight: 400;
            font-style: normal;
            src: url(/../eng/fonts/RocGroteskRegular.eot);
            src: local('RocGrotesk Regular'), local('RocGrotesk-Regular'), url(/../eng/fonts/RocGroteskRegular.eot?#iefix) format('embedded-opentype'), url(/../eng/fonts/RocGroteskRegular.woff2) format('woff2'), url(/../eng/fonts/RocGroteskRegular.woff) format('woff'), url(/../eng/fonts/RocGroteskRegular.ttf) format('truetype'), url(/../eng/fonts/RocGroteskRegular.svg#RocGrotesk) format('svg');
        }

        @font-face {
            font-family: "RocGrotesk";
            font-weight: 500;
            font-style: normal;
            src: url(/../eng/fonts/GroteskMedium.eot);
            src: local('RocGrotesk Medium'), local('RocGrotesk-Medium'), url(/../eng/fonts/RocGroteskMedium.eot?#iefix) format('embedded-opentype'), url(/../eng/fonts/RocGroteskMedium.woff2) format('woff2'), url(/../eng/fonts/RocGroteskMedium.woff) format('woff'), url(/../eng/fonts/RocGroteskMedium.ttf) format('truetype'), url(/../eng/fonts/RocGroteskMedium.svg#RocGrotesk) format('svg');
        }

        @font-face {
            font-family: "RocGrotesk";
            font-weight: 600;
            font-style: normal;
            src: url(/../eng/fonts/RocGroteskBold.eot);
            src: local('RocGrotesk Bold'), local('RocGrotesk-Bold'), url(/../eng/fonts/RocGroteskBold.eot?#iefix) format('embedded-opentype'), url(/../eng/fonts/RocGroteskBold.woff2) format('woff2'), url(/../eng/fonts/RocGroteskBold.woff) format('woff'), url(/../eng/fonts/RocGroteskBold.ttf) format('truetype'), url(/../eng/fonts/RocGroteskBold.svg#RocGrotesk) format('svg');
        }

        @font-face {
            font-family: "RocGrotesk";
            font-weight: 700;
            font-style: normal;
            src: url(/../eng/fonts/RocGroteskExtraBold.eot);
            src: local('RocGrotesk ExtraBold'), local('RocGrotesk-ExtraBold'), url(/../eng/fonts/RocGroteskExtraBold.eot?#iefix) format('embedded-opentype'), url(/../eng/fonts/RocGroteskExtraBold.woff2) format('woff2'), url(/../eng/fonts/RocGroteskExtraBold.woff) format('woff'), url(/../eng/fonts/RocGroteskExtraBold.ttf) format('truetype'), url(/../eng/fonts/RocGroteskExtraBold.svg#RocGrotesk) format('svg');
        }

        @font-face {
            font-family: "FoundersGrotesk";
            font-weight: 400;
            font-style: normal;
            src: url(/../eng/fonts/FoundersGroteskRegular.eot);
            src: local('FoundersGrotesk Regular'), local('FoundersGrotesk-Regular'), url(/../eng/fonts/FoundersGroteskRegular.eot?#iefix) format('embedded-opentype'), url(/../eng/fonts/FoundersGroteskRegular.woff2) format('woff2'), url(/../eng/fonts/FoundersGroteskRegular.woff) format('woff'), url(/../eng/fonts/FoundersGroteskRegular.ttf) format('truetype'), url(/../eng/fonts/FoundersGroteskRegular.svg#FoundersGrotesk) format('svg');
        }

        @font-face {
            font-family: "FoundersGrotesk";
            font-weight: 600;
            font-style: normal;
            src: url(/../eng/fonts/FoundersGroteskSemibold.eot);
            src: local('FoundersGrotesk Semibold'), local('FoundersGrotesk-Semibold'), url(/../eng/fonts/FoundersGroteskSemibold.eot?#iefix) format('embedded-opentype'), url(/../eng/fonts/FoundersGroteskSemibold.woff2) format('woff2'), url(/../eng/fonts/FoundersGroteskSemibold.woff) format('woff'), url(/../eng/fonts/FoundersGroteskSemibold.ttf) format('truetype'), url(/../eng/fonts/FoundersGroteskSemibold.svg#FoundersGrotesk) format('svg');
        }

        /* Normalisation */
        html,
        body {
            height: 100%;
        }

        body {
            margin: 0;
            background-image: url(https://content.payfast.co.za/assets/images/error-pages/background-1.png), url(https://content.payfast.co.za/assets/images/error-pages/background-2.png), url(https://content.payfast.co.za/assets/images/error-pages/background-3.png), url(https://content.payfast.co.za/assets/images/error-pages/background-4.png), url(https://content.payfast.co.za/assets/images/error-pages/background-5.png), url(https://content.payfast.co.za/assets/images/error-pages/background-6.png), url(https://content.payfast.co.za/assets/images/error-pages/background-7.png), url(https://content.payfast.co.za/assets/images/error-pages/background-8.png), url(https://content.payfast.co.za/assets/images/error-pages/background-9.png), url(https://content.payfast.co.za/assets/images/error-pages/background-10.png), url(https://content.payfast.co.za/assets/images/error-pages/background-11.png);
            background-position: right 80px bottom 260px, left 300px top 160px, left 296px bottom, left 75px bottom, right 284px bottom, left bottom 148px, right 134px bottom, right 237px bottom 150px, right top 336px, left 210px top 450px, right bottom 120px;
            background-repeat: no-repeat;
            background-color: white;
        }

        /* Responsiveness */
        @media only screen and (max-width: 1500px) {
            body {
                background-position: right 40px bottom 145px, left 240px top 170px, left 180px bottom, left 70px bottom, right 132px bottom, left bottom 75px, right 58px bottom, right 110px bottom 74px, right bottom 211px, left 160px top 420px, right bottom 75px;
                background-size: 88px 75px, 98px 75px, 123px 95px, 113px 77px, 125px 82px, 129px 91px, 88px 115px, 114px 118px, 76px 125px, 74px 75px, 75px 75px;
            }
        }

        @media only screen and (max-width: 1100px) {
            body {
                background-position: right 40px bottom 145px, left 150px top 170px, left 180px bottom, left 70px bottom, right 132px bottom, left bottom 75px, right 58px bottom, right 110px bottom 74px, right bottom 211px, left 70px top 420px, right bottom 75px;
                background-size: 88px 75px, 98px 75px, 123px 95px, 113px 77px, 125px 82px, 129px 91px, 88px 115px, 114px 118px, 76px 125px, 74px 75px, 75px 75px;
            }

            .error-block__number {
                font-size: 160px !important;
            }

            .error-block__text {
                font-size: 28px !important;
            }

            .error-block__message {
                font-size: 20px !important;
            }
        }

        @media only screen and (max-width: 800px) {
            body {
                background-position: right 40px bottom 145px, left 80px top 170px, left 180px bottom, left 70px bottom, right 132px bottom, left bottom 75px, right 58px bottom, right 110px bottom 74px, right bottom 211px, left 20px top 420px, right bottom 75px;
                background-size: 88px 75px, 98px 75px, 123px 95px, 113px 77px, 125px 82px, 129px 91px, 88px 115px, 114px 118px, 76px 125px, 74px 75px, 75px 75px;
            }

            .error-block__number {
                font-size: 120px !important;
            }

            .error-block__text {
                font-size: 24px !important;
            }

            .error-block__message {
                font-size: 18px !important;
            }
        }

        @media only screen and (max-width: 650px) {
            #header-contact__link {
                display: flex;
                justify-content: center;
                align-items: center;
                border: 1px solid #022D2D;
                height: 42px;
                width: 42px;
                border-radius: 50%;
            }

            #header-contact__link span {
                display: none;
            }

            #header-contact__link i {
                margin-right: 0 !important;
            }

            body {
                background-image: none;
            }
        }

        @media only screen and (max-height: 650px) {
            .error-block__button {
                margin-top: 48px !important;
            }

            .error-block__text {
                margin-top: 24px !important;
            }
        }

        @media only screen and (max-height: 550px) {
            .error-block__button {
                margin-top: 36px !important;
            }

            .error-block__message {
                margin-top: 0 !important;
            }

            body {
                background-image: none;
            }
        }

        @media only screen and (max-height: 500px) {
            .error-block__button {
                margin-top: 24px !important;
            }

            .error-block__message {
                margin-top: 0 !important;
                max-width: 100% !important;
            }

            .error-block__number {
                line-height: 80% !important;
            }

            .error-block__text {
                margin-bottom: 12px !important
            }

            .error-block {
                padding-top: 24px !important;
            }
        }

        @media only screen and (max-height: 450px) {
            .error-block__button {
                margin-top: 12px !important
            }

            .error-block__number {
                line-height: 70% !important;
            }

            .error-block__text {
                margin-bottom: 0 !important;
            }

            .error-block {
                padding-top: 48px !important;
            }
        }

        @media only screen and (max-height: 400px) {
            .error-block__number {
                line-height: 60% !important
            }
        }

        /* Header Styling */
        #header_bar {
            position: fixed;
            width: 100%;
            display: flex;
            justify-content: space-between;
            min-width: 320px;
            padding: 16px 0;
        }

        #payfast_logo {
            width: 152px;
            height: 62px;
            padding-left: 32px;
        }

        #header_contact {
            margin: 24px 32px 0 0;
            display: flex;
            justify-content: space-between;
        }

        #header-contact__link {
            font-family: "RocGrotesk", serif;
            color: #022D2D;
            font-size: 16px;
            margin-left: 36px;
            text-decoration: none;
        }

        #header-contact__link i {
            color: #022D2D;
            margin-right: 12px;
        }

        /* General Styling */
        .error-block {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            height: 100%;
            color: #022D2D;
            font-family: 'RocGrotesk', serif;
        }

        .error-block__number {
            font-weight: 600;
            font-size: 200px;
            line-height: 100%;
        }

        .error-block__text {
            font-weight: 500;
            font-size: 38px;
            margin-bottom: 42px;
        }

        .error-block__message {
            font-weight: 300;
            font-size: 28px;
            text-align: center;
            margin-top: 6px;
            max-width: 600px;
        }

        .error-block__button {
            background-color: #dee965;
            border: 1px solid #dee965;
            color: #022d2d;
            padding: 8px 40px;
            border-radius: 80px;
            white-space: nowrap;
            font-size: 16px;
            font-family: 'FoundersGrotesk', serif;
            line-height: 24px;
            font-weight: 600;
            margin-top: 96px;
        }
    </style>
</head>

<body>
    <div id="header_bar"> <a href="https://payfast.io" target="_blank" rel="noopener">
            <div id="payfast_logo"> <img src="https://content.payfast.io/assets/images/logos/ni_payfast_logo.png"
                    srcset="https://content.payfast.io/assets/images/logos/ni_payfast_logo@2.png 2x" alt="payfast_logo">
            </div>
        </a>
        <div id="header_contact"> <a id="header-contact__link" href="tel:+27 21 300 4455" target="_blank"> <i
                    class="fas fa-phone"></i> <span>+27 (021) 300 4455</span> </a> <a id="header-contact__link"
                href="mailto: sales@payfast.help" target="_blank"> <i class="fas fa-envelope"></i>
                <span>sales@payfast.help</span> </a> </div>
    </div>
    <div class="error-block">
        <div class="error-block__number">400</div>
        <div class="error-block__text">Bad Request</div>
        <div class="error-block__message"> 1. The email address field is required.</br> </div>
        <form> <input type="button" value="Return to home page" onclick="history.back()" class="error-block__button">
        </form>
    </div>
</body>

</html>