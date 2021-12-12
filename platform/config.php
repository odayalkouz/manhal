<?php
/**
 * Created by Dar Almanhal - Hussam Abu Khadijeh .
 * User: Hussam Abu Khadijeh
 * Date: 1/4/2016
 * Time: 1:14 PM
 */

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "books";


define('WEBSITE_URL',"http://localhost/");
define('BooksPerPage',12);
define('PagesOfPagination',9);

define("SITE_URL","http://localhost/Manhal/");//aaaaaaaaaaaaaaaaaa

define("FACEBOOK_APPID","139847473035370");
define("TWITTER_APPID","A7kNJwxvlDJYUuMcSu5dHbJBx");
define("TWITTER_SECRET","hkP6k779dM23q6EbKrZE9aTT96wlR5snb90m0aAbDvZWqiqArp");
define("TWITTER_callBack","http://www.manhal.com/twitter/callBack.php");//aaaaaaaaaaaaaaaaaa
define("WEBMASTER_EMAIL","webmaster@manhal.com");

define("CONTACT_EMAIL","webmaster@manhal.com");
define("SERVER_IP","162.144.51.202");
define("API_SECRET","asdjh787AJH23djHFGB6672399GUJHGBnkjgh123fghgasd67HJKV8asbqlga345Fyhasd2343");


define("COOKIE_EXPIRE",31104000);


//payfort
//define("Payfort_Access_Code","4yosctTk1BwEN9WMXObm");//sandbox
define("Payfort_Access_Code","1tzTa4679zfC5hWZiUzD");//live
//define("Payfort_SHA_Request","dgdgd4564");//sandbox
define("Payfort_SHA_Request","truyrew3465qq");//live
//define("Payfort_SHA_Response","ggj567");//sandbox
define("Payfort_SHA_Response","uunjhgdf92375");//live
//define("Payfort_Identifire","OjXrZdgn");//sandbox
define("Payfort_Identifire","MQPyMigf");//live
define("Payfort_Token_Name","Pay852Tok22Man8574utyrt00TYFv247F54");
define("Payfort_Return_URL",SITE_URL."en/payment");
define("Payfort_Auth_URL","https://sbcheckout.payfort.com/");
//define("Payfort_token_URL","https://sbcheckout.PayFort.com/FortAPI/paymentPage");//sandbox
define("Payfort_token_URL","https://checkout.PayFort.com/FortAPI/paymentPage");//live
//define("Payfort_Pay_URL","https://sbpaymentservices.payfort.com/FortAPI/paymentApi");//Sandbox
define("Payfort_Pay_URL","https://paymentservices.payfort.com/FortAPI/paymentApi");//live
//https://checkout.payfort.com/FortAPI/paymentPage



///paypal
define("CURRENCY","USD");
define("TAX",0);
define("BaseURL","http://localhost/Manhal/");

//DHL APIs
define("DHL_PRICES",serialize(array(
    "0.5"=>6.22,
    "1.0"=>9.39,
    "1.5"=>12.43,
    "2.0"=>15.47,
    "2.5"=>18.50,
    "3.0"=>21.54,
    "3.5"=>25.25,
    "4.0"=>28.28,
    "4.5"=>31.32,
    "5.0"=>34.82,
    "5.5"=>35.82,
    "6.0"=>37.27,
    "6.5"=>38.59,
    "7.0"=>39.90,
    "7.5"=>41.22,
    "8.0"=>42.54,
    "8.5"=>43.85,
    "9.0"=>45.12,
    "9.5"=>46.48,
    "10"=>47.80,
    "11"=>53.09,
    "12"=>58.37,
    "13"=>63.65,
    "14"=>68.94,
    "15"=>74.22,
    "16"=>79.50,
    "17"=>84.79,
    "18"=>90.07,
    "19"=>95.36,
    "20"=>100.64,
    "21"=>105.92,
    "22"=>111.21,
    "23"=>116.49,
    "24"=>121.78,
    "25"=>127.06,
    "26"=>132.34,
    "27"=>137.63,
    "28"=>142.91,
    "29"=>148.20,
    "30"=>153.476,
    "40"=>206.32,
    "50"=>259.16,
    "60"=>301.96,
    "70"=>344.76,
    "71"=>2.7 //Adder rate per 0.5 KG for additional
)));

//ARAMEX
define("Aramex_AccountEntity","AMM");
define("Aramex_UserName","hussam.ib.88@gmail.com");
define("Aramex_Password","ASF$45@#f1a1");
define("Aramex_account_number","12975");
define("Aramex_pin_number","543543");
define("Aramex_City","Amman");
define("Aramex_Address","S.Nabulsi Str. Al- Abdali");
define("Aramex_Country_Code","Jo");
define("Aramex_Contact_name","Ashraf Khalaf");
define("Aramex_Contact_comany","Dar Al-Manhal");
define("Aramex_Contact_phone","5698308");
define("Aramex_Contact_ext","130");
define("Aramex_Contact_cellphone","0787000442");
//define("Aramex_Contact_email","A.khalaf@manhal.com");


// Create connection
$con = new mysqli($servername, $username, $password, $dbname);
$con->set_charset("utf8");
// Check connection
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}
//'Open Sans', sans-serif
$fonts=array("Open-Sans"=>"Open Sans, sans-serif","Amiri"=>"Amiri","Kufi"=>"Droid Arabic Kufi","Naskh"=>"Droid Arabic Naskh","Lateef"=>"Lateef","Scheherazade"=>"Scheherazade","Thabit"=>"Thabit","Ruqaa"=>"Ruqaa");


// configuration for LMS creation
define("CLOUD_WHM_URL","https://cloud.manhal.com");
define("Manhal_Cpanel_URL","https://www.manhal.com");
define("Manhal_WHM_URL","https://www.manhal.com");
define("LMS_MainDomain","manhal.com");
define("LMS_SERVER_IP","35.196.144.75");
define("CLOUD_WHM_Token","BHVT2QT8ODI1QYU3CSVKRPSFFBT7HLFF");
define("Manhal_WHM_Token","U83ZFU43Y0AD3SC6BXJ64PRJU28BF4MJ");
define("MANHAL_SSL_CER","-----BEGIN CERTIFICATE-----
MIIGUzCCBTugAwIBAgIRAOvhgb0TdTxsbWw4btR5woMwDQYJKoZIhvcNAQELBQAw
gZAxCzAJBgNVBAYTAkdCMRswGQYDVQQIExJHcmVhdGVyIE1hbmNoZXN0ZXIxEDAO
BgNVBAcTB1NhbGZvcmQxGjAYBgNVBAoTEUNPTU9ETyBDQSBMaW1pdGVkMTYwNAYD
VQQDEy1DT01PRE8gUlNBIERvbWFpbiBWYWxpZGF0aW9uIFNlY3VyZSBTZXJ2ZXIg
Q0EwHhcNMTgxMTA0MDAwMDAwWhcNMTkxMjE0MjM1OTU5WjBZMSEwHwYDVQQLExhE
b21haW4gQ29udHJvbCBWYWxpZGF0ZWQxHTAbBgNVBAsTFFBvc2l0aXZlU1NMIFdp
bGRjYXJkMRUwEwYDVQQDDAwqLm1hbmhhbC5jb20wggEiMA0GCSqGSIb3DQEBAQUA
A4IBDwAwggEKAoIBAQDO0+Q5RWa6KcSQiKcUtIK+ri4ip86AErz1nk4r2mUqkv7A
OFc2wG9KU+d/wB9dtIp4QJjUHlUlxDbZ0LOMmvgsaAtMUE2SCXdz0Jv7U0i93y44
47xllZOUYMpuZ8CwrUhSfjVRQ9nG2jWWl5/AA0Fp1RqyYDtipbIllcCaQhTc7Ch2
UWTzaC3nx38AeKkKTkZdBM0Kq2HWntEfxgL7h3KSqNCTesM4dnbt0KuTuteGJYyS
pjvbLifDTC3u/kgw/yNMzKIPhf03IKCVNExJGOaWiN4iGkmnqafLxdGAGbwefyxi
UxNZ50IFCfaamSu+8dgfq6KLwTAtR837s9/3D09HAgMBAAGjggLcMIIC2DAfBgNV
HSMEGDAWgBSQr2o6lFoL2JDqElZz30O0Oija5zAdBgNVHQ4EFgQUrvDhxgbi7i6N
hx4UrjMAM7wFBuYwDgYDVR0PAQH/BAQDAgWgMAwGA1UdEwEB/wQCMAAwHQYDVR0l
BBYwFAYIKwYBBQUHAwEGCCsGAQUFBwMCME8GA1UdIARIMEYwOgYLKwYBBAGyMQEC
AgcwKzApBggrBgEFBQcCARYdaHR0cHM6Ly9zZWN1cmUuY29tb2RvLmNvbS9DUFMw
CAYGZ4EMAQIBMFQGA1UdHwRNMEswSaBHoEWGQ2h0dHA6Ly9jcmwuY29tb2RvY2Eu
Y29tL0NPTU9ET1JTQURvbWFpblZhbGlkYXRpb25TZWN1cmVTZXJ2ZXJDQS5jcmww
gYUGCCsGAQUFBwEBBHkwdzBPBggrBgEFBQcwAoZDaHR0cDovL2NydC5jb21vZG9j
YS5jb20vQ09NT0RPUlNBRG9tYWluVmFsaWRhdGlvblNlY3VyZVNlcnZlckNBLmNy
dDAkBggrBgEFBQcwAYYYaHR0cDovL29jc3AuY29tb2RvY2EuY29tMCMGA1UdEQQc
MBqCDCoubWFuaGFsLmNvbYIKbWFuaGFsLmNvbTCCAQMGCisGAQQB1nkCBAIEgfQE
gfEA7wB2AO5Lvbd1zmC64UJpH6vhnmajD35fsHLYgwDEe4l6qP3LAAABZt9wdHMA
AAQDAEcwRQIhAKKDnhO6VbpiwLUy+veJEcXAaiYQEMoePNX8DWYlGaCsAiB7cBDB
M3FBEKo43yN9C6pagaL3OZNGRdXnMgLZWiIoXQB1AHR+2oMxrTMQkSGcziVPQnDC
v/1eQiAIxjc1eeYQe8xWAAABZt9wdKAAAAQDAEYwRAIgLBY13MHSYGDDfWrYO4LY
eTWypSIczfZGC0ovNN7+UXUCIA33dwvaaKFp2xNUqmeZJdkbY4fJnpI9BRWaW+bH
Lhc6MA0GCSqGSIb3DQEBCwUAA4IBAQB2uKjTBwJSns6N9u2fb5oWquboSE3shPEE
JrxlcZikk/8lZQOVt8UxFZ4ACWFOZ9VLpBHRprWekDs5vCCLQFnGR4FcWRpxxALB
x0d8o4l/olVovj5TDkseZDegIDf/UIxLJfS3SL+OCpbYG73Iyf8lxPQxwM1z4uMM
ABfTH+XKRC9Gtbx0IPOo4d7aJ9Qq8tdfa2gIyFDH1VJta2Tn5WcTMI5qfgId+Lqp
Na+wtfBjCPt+o5F223q516UDwQd6YI+/bgWYZ74DkdLfeyvkj1WYmF6P1X5DPg88
krLmvK7pXkxbEa8qaJoDTTKyBdfmR1cc9cTMlVJmO+LCVgiuIly+
-----END CERTIFICATE-----");
define("MANHAL_SSL_KEY","-----BEGIN RSA PRIVATE KEY-----
MIIEpQIBAAKCAQEAztPkOUVmuinEkIinFLSCvq4uIqfOgBK89Z5OK9plKpL+wDhX
NsBvSlPnf8AfXbSKeECY1B5VJcQ22dCzjJr4LGgLTFBNkgl3c9Cb+1NIvd8uOOO8
ZZWTlGDKbmfAsK1IUn41UUPZxto1lpefwANBadUasmA7YqWyJZXAmkIU3OwodlFk
82gt58d/AHipCk5GXQTNCqth1p7RH8YC+4dykqjQk3rDOHZ27dCrk7rXhiWMkqY7
2y4nw0wt7v5IMP8jTMyiD4X9NyCglTRMSRjmlojeIhpJp6mny8XRgBm8Hn8sYlMT
WedCBQn2mpkrvvHYH6uii8EwLUfN+7Pf9w9PRwIDAQABAoIBAQCDGvAVmbenlGhk
kisPRemHA5R9JVASAU7Eh4fX5oWweiOAJ3apX0xsmkkpwthfJt2Loq797whce0el
xNS78VQVmhJnWpQBWXzd7kOiCcYXjcyYBUxcPHejW8OWPrB3jjBFEnmrvM3kblf/
0LdUGPwzIQHeRn/+ZThK+OVxIyhkbS7wtDtt6uXGpQRA7SZEhaedyWbWvgpCUgo+
xD9vxCEt0F0775qLu9UzhLaeXMHgHTEmqS5KLRa++0Z7+hxSn6Rdi6Jjz8v4dRP7
T/MU+0WfDGX4IODA4wf3uz/r3zO8RvZmhBFoInrj0hqKsu9bIQQgKVceClISYyQS
vFh0c5IZAoGBAOgfRGFKlaytohZEW3yl+m4DtlSIdlFvzSYRcK6xFsamMaQEyFOi
XXxPLmMcLM5wzPJ6KO4LwrDFvqoWarNVhduHcst8L9Cj+6I+4dW9s7Ec8VNWlALn
/DsKlH7cvvfIb17Voe0mKbjTLv1O2yIqE1JXfTSA886wbLkxMlCLNYclAoGBAOQa
hIGlhGyfjdX+GObYqOJEdZqEdQ83XINvBEAyCkXtArgDq6xCFbHj4U3QvthzjgVs
189O/Tpj2lM5Vtmqxf0VMhqo8MGp5Teek0zc+1yXWXtMvhUxbBySiWC+Knm59E14
N81JAdOFvh6nI3MsBZC2d9PBLb76RPcKTtAHKjb7AoGBAKVwk5YcSK14W8wvEF25
FtKOhsedM2c7niYBzCRWR3tyPHNAjV8+nA7biJ5PGIhS0WAJPV7ctvizF/+2VnpW
/D7JPUJW0uWL2u96jg9/U7FqhX32eSvRGG8kTU5WGy4Th306Gl0iFB6NNjKIn5qs
DnVjsfNX7W1lRTiBHfFWJuKZAoGBAJZmlbAWPraQjajnneu4N8LZeOGlLLoXurw+
2wKo+/UXTY+fe/ZcrIlaxBfW5784khApsDJU1stFQ5NUX1uuKlWxQBQsCHLpXuXJ
fT5VBrgKY0nVVBANQkekp0hOmxsf7WGXPtPwq2+Y4766Xbl28UR1y5Sn703ZHtf0
x/qKft85AoGAUExEPbQlb4NYaZpiMnLhEnsNMnv7RkVlsq7ZiEWVDLPF7fVM5As5
0NrhUVbX7oSzx1BOvMB9gUNc5bPVcGCbZMu31javeiPzLShA8LJtXBeF8lW7NNDQ
lnxFkBHgbgZgyJireuSSY+BWmkwI1UvJpGpwMJqaVrsS/8SL8bJn1XQ=
-----END RSA PRIVATE KEY-----");
define("MANHAL_SSL_BUNDLE","-----BEGIN CERTIFICATE-----
MIIGCDCCA/CgAwIBAgIQKy5u6tl1NmwUim7bo3yMBzANBgkqhkiG9w0BAQwFADCBhTELMAkGA1UE
BhMCR0IxGzAZBgNVBAgTEkdyZWF0ZXIgTWFuY2hlc3RlcjEQMA4GA1UEBxMHU2FsZm9yZDEaMBgG
A1UEChMRQ09NT0RPIENBIExpbWl0ZWQxKzApBgNVBAMTIkNPTU9ETyBSU0EgQ2VydGlmaWNhdGlv
biBBdXRob3JpdHkwHhcNMTQwMjEyMDAwMDAwWhcNMjkwMjExMjM1OTU5WjCBkDELMAkGA1UEBhMC
R0IxGzAZBgNVBAgTEkdyZWF0ZXIgTWFuY2hlc3RlcjEQMA4GA1UEBxMHU2FsZm9yZDEaMBgGA1UE
ChMRQ09NT0RPIENBIExpbWl0ZWQxNjA0BgNVBAMTLUNPTU9ETyBSU0EgRG9tYWluIFZhbGlkYXRp
b24gU2VjdXJlIFNlcnZlciBDQTCCASIwDQYJKoZIhvcNAQEBBQADggEPADCCAQoCggEBAI7CAhnh
oFmk6zg1jSz9AdDTScBkxwtiBUUWOqigwAwCfx3M28ShbXcDow+G+eMGnD4LgYqbSRutA776S9uM
IO3Vzl5ljj4Nr0zCsLdFXlIvNN5IJGS0Qa4Al/e+Z96e0HqnU4A7fK31llVvl0cKfIWLIpeNs4Tg
llfQcBhglo/uLQeTnaG6ytHNe+nEKpooIZFNb5JPJaXyejXdJtxGpdCsWTWM/06RQ1A/WZMebFEh
7lgUq/51UHg+TLAchhP6a5i84DuUHoVS3AOTJBhuyydRReZw3iVDpA3hSqXttn7IzW3uLh0nc13c
RTCAquOyQQuvvUSH2rnlG51/ruWFgqUCAwEAAaOCAWUwggFhMB8GA1UdIwQYMBaAFLuvfgI9+qbx
PISOre44mOzZMjLUMB0GA1UdDgQWBBSQr2o6lFoL2JDqElZz30O0Oija5zAOBgNVHQ8BAf8EBAMC
AYYwEgYDVR0TAQH/BAgwBgEB/wIBADAdBgNVHSUEFjAUBggrBgEFBQcDAQYIKwYBBQUHAwIwGwYD
VR0gBBQwEjAGBgRVHSAAMAgGBmeBDAECATBMBgNVHR8ERTBDMEGgP6A9hjtodHRwOi8vY3JsLmNv
bW9kb2NhLmNvbS9DT01PRE9SU0FDZXJ0aWZpY2F0aW9uQXV0aG9yaXR5LmNybDBxBggrBgEFBQcB
AQRlMGMwOwYIKwYBBQUHMAKGL2h0dHA6Ly9jcnQuY29tb2RvY2EuY29tL0NPTU9ET1JTQUFkZFRy
dXN0Q0EuY3J0MCQGCCsGAQUFBzABhhhodHRwOi8vb2NzcC5jb21vZG9jYS5jb20wDQYJKoZIhvcN
AQEMBQADggIBAE4rdk+SHGI2ibp3wScF9BzWRJ2pmj6q1WZmAT7qSeaiNbz69t2Vjpk1mA42GHWx
3d1Qcnyu3HeIzg/3kCDKo2cuH1Z/e+FE6kKVxF0NAVBGFfKBiVlsit2M8RKhjTpCipj4SzR7JzsI
tG8kO3KdY3RYPBpsP0/HEZrIqPW1N+8QRcZs2eBelSaz662jue5/DJpmNXMyYE7l3YphLG5SEXdo
ltMYdVEVABt0iN3hxzgEQyjpFv3ZBdRdRydg1vs4O2xyopT4Qhrf7W8GjEXCBgCq5Ojc2bXhc3js
9iPc0d1sjhqPpepUfJa3w/5Vjo1JXvxku88+vZbrac2/4EjxYoIQ5QxGV/Iz2tDIY+3GH5QFlkoa
kdH368+PUq4NCNk+qKBR6cGHdNXJ93SrLlP7u3r7l+L4HyaPs9Kg4DdbKDsx5Q5XLVq4rXmsXiBm
GqW5prU5wfWYQ//u+aen/e7KJD2AFsQXj4rBYKEMrltDR5FL1ZoXX/nUh8HCjLfn4g8wGTeGrODc
QgPmlKidrv0PJFGUzpII0fxQ8ANAe4hZ7Q7drNJ3gjTcBpUC2JD5Leo31Rpg0Gcg19hCC0Wvgmje
3WYkN5AplBlGGSW4gNfL1IYoakRwJiNiqZ+Gb7+6kHDSVneFeO/qJakXzlByjAA6quPbYzSf+AZx
AeKCINT+b72x
-----END CERTIFICATE-----
-----BEGIN CERTIFICATE-----
MIIFdDCCBFygAwIBAgIQJ2buVutJ846r13Ci/ITeIjANBgkqhkiG9w0BAQwFADBvMQswCQYDVQQG
EwJTRTEUMBIGA1UEChMLQWRkVHJ1c3QgQUIxJjAkBgNVBAsTHUFkZFRydXN0IEV4dGVybmFsIFRU
UCBOZXR3b3JrMSIwIAYDVQQDExlBZGRUcnVzdCBFeHRlcm5hbCBDQSBSb290MB4XDTAwMDUzMDEw
NDgzOFoXDTIwMDUzMDEwNDgzOFowgYUxCzAJBgNVBAYTAkdCMRswGQYDVQQIExJHcmVhdGVyIE1h
bmNoZXN0ZXIxEDAOBgNVBAcTB1NhbGZvcmQxGjAYBgNVBAoTEUNPTU9ETyBDQSBMaW1pdGVkMSsw
KQYDVQQDEyJDT01PRE8gUlNBIENlcnRpZmljYXRpb24gQXV0aG9yaXR5MIICIjANBgkqhkiG9w0B
AQEFAAOCAg8AMIICCgKCAgEAkehUktIKVrGsDSTdxc9EZ3SZKzejfSNwAHG8U9/E+ioSj0t/EFa9
n3Byt2F/yUsPF6c947AEYe7/EZfH9IY+Cvo+XPmT5jR62RRr55yzhaCCenavcZDX7P0N+pxs+t+w
gvQUfvm+xKYvT3+Zf7X8Z0NyvQwA1onrayzT7Y+YHBSrfuXjbvzYqOSSJNpDa2K4Vf3qwbxstovz
Do2a5JtsaZn4eEgwRdWt4Q08RWD8MpZRJ7xnw8outmvqRsfHIKCxH2XeSAi6pE6p8oNGN4Tr6MyB
SENnTnIqm1y9TBsoilwie7SrmNnu4FGDwwlGTm0+mfqVF9p8M1dBPI1R7Qu2XK8sYxrfV8g/vOld
xJuvRZnio1oktLqpVj3Pb6r/SVi+8Kj/9Lit6Tf7urj0Czr56ENCHonYhMsT8dm74YlguIwoVqwU
HZwK53Hrzw7dPamWoUi9PPevtQ0iTMARgexWO/bTouJbt7IEIlKVgJNp6I5MZfGRAy1wdALqi2cV
KWlSArvX31BqVUa/oKMoYX9w0MOiqiwhqkfOKJwGRXa/ghgntNWutMtQ5mv0TIZxMOmm3xaG4Nj/
QN370EKIf6MzOi5cHkERgWPOGHFrK+ymircxXDpqR+DDeVnWIBqv8mqYqnK8V0rSS527EPywTEHl
7R09XiidnMy/s1Hap0flhFMCAwEAAaOB9DCB8TAfBgNVHSMEGDAWgBStvZh6NLQm9/rEJlTvA73g
JMtUGjAdBgNVHQ4EFgQUu69+Aj36pvE8hI6t7jiY7NkyMtQwDgYDVR0PAQH/BAQDAgGGMA8GA1Ud
EwEB/wQFMAMBAf8wEQYDVR0gBAowCDAGBgRVHSAAMEQGA1UdHwQ9MDswOaA3oDWGM2h0dHA6Ly9j
cmwudXNlcnRydXN0LmNvbS9BZGRUcnVzdEV4dGVybmFsQ0FSb290LmNybDA1BggrBgEFBQcBAQQp
MCcwJQYIKwYBBQUHMAGGGWh0dHA6Ly9vY3NwLnVzZXJ0cnVzdC5jb20wDQYJKoZIhvcNAQEMBQAD
ggEBAGS/g/FfmoXQzbihKVcN6Fr30ek+8nYEbvFScLsePP9NDXRqzIGCJdPDoCpdTPW6i6FtxFQJ
dcfjJw5dhHk3QBN39bSsHNA7qxcS1u80GH4r6XnTq1dFDK8o+tDb5VCViLvfhVdpfZLYUspzgb8c
8+a4bmYRBbMelC1/kZWSWfFMzqORcUx8Rww7Cxn2obFshj5cqsQugsv5B5a6SE2Q8pTIqXOi6wZ7
I53eovNNVZ96YUWYGGjHXkBrI/V5eu+MtWuLt29G9HvxPUsE2JOAWVrgQSQdso8VYFhH2+9uRv0V
9dlfmrPb2LjkQLPNlzmuhbsdjrzch5vRpu/xO28QOG8=
-----END CERTIFICATE-----");


?>
