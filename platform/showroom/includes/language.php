<?php
trait store_language
{

    public function getlang($var)
    {
        /*if(isset($_SESSION["lang"]) && $_SESSION["lang"]!=''){
            $session_lang=$_SESSION["lang"];
        }else{
            $session_lang='En';
        }
        if($session_lang=='' || $session_lang==''){
            $session_lang='En';
        }*/
        $session_lang=$_SESSION["lang"];
        switch ($var) {
            case 'lang':
                $result = array("En" => 'English', "Ar" => 'عربي');
                break;
            case 'title_heder':
                $result = array("En" => 'Dar Al Manhal Bookstore', "Ar" => 'مكتبة دار المنهل');
                break;
            case 'Username':
                $result = array("En" => 'Username', "Ar" => 'اسم المستخدم');
                break;
            case 'UserId':
                $result = array("En" => 'User Id', "Ar" => 'رقم المستخدم');
                break;
            case 'UserPhone':
                $result = array("En" => 'Phone ', "Ar" => 'رقم الهاتف');
                break;
                case 'Usercountry':
                $result = array("En" => 'Country ', "Ar" => 'الدولة');
                break;
            case 'Password':
                $result = array("En" => 'Password', "Ar" => 'كلمة المرور');
                break;
            case 'Email':
                $result = array("En" => 'E-mail', "Ar" => 'البريد الإلكتروني');
                break;
            case 'Remember_me':
                $result = array("En" => 'Remember me', "Ar" => 'تذكرني');
                break;
            case 'Login_to_your_account':
                $result = array("En" => 'Login to your account', "Ar" => 'ادخل إلى حسابك');
                break;
            case 'LOGIN':
                $result = array("En" => 'Sign In', "Ar" => 'تسجيل الدخول');
                break;
            case 'ReadMore':
                $result = array("En" => 'Read More', "Ar" => 'اقرأ المزيد');
                break;
            case 'TotalCustomers':
                $result = array("En" => 'Customers', "Ar" => 'العملاء');
                break;
            case 'TotalBookingscompleted':
                $result = array("En" => 'Completed Orders', "Ar" => 'الطلبات المكتملة');
                break;
            case 'TotalOrdersinprogress':
                $result = array("En" => 'Orders in Progress', "Ar" => 'الطلبات قيد التجهيز');
                break;
            case 'totalsales':
                $result = array("En" => 'Sales', "Ar" => 'المبيعات');
                break;
            case 'Numberofcanceledrequests':
                $result = array("En" => 'Canceled Orders', "Ar" => 'الطلبات الملغاة');
                break;
            case 'TotalsalesCurrentWeek':
                $result = array("En" => "Current week's sales", "Ar" => 'مبيعات الأسبوع الحالي');
                break;
            case 'TotalsalesCurrenMonth':
                $result = array("En" =>  "Current month's sales", "Ar" => 'مبيعات الشهر الحالي');
                break;
            case 'TotalsalesCurrenToday':
                $result = array("En" =>  "Current day sales", "Ar" => 'مبيعات اليوم الحالي');
                break;
            case 'Thenumberofdrivers':
                $result = array("En" =>  "Drivers", "Ar" => 'السائقون');
                break;
            case 'Numberofdriversavailable':
                $result = array("En" =>  "Available Drivers ", "Ar" => 'السائقون المتاحون');
                break;
            case 'Dashboard':
                $result = array("En" =>  "Dashboard", "Ar" => 'لوحة التحكم');
                break;
            case 'MoreDetailsDetails':
                $result = array("En" =>  "Order Info.", "Ar" => 'معلومات الطلب');
                break;
            case 'Store':
                $result = array("En" =>  "Store", "Ar" => 'المتجر');
                break;
            case 'Copyrite':
                $result = array("En" =>  "All Rights Reserved for Dar Al-Manhal Publishers", "Ar" => 'جميع الحقوق محفوظة لدار المنهل ناشرون © 2020');
                break;
            case 'privacyPolicy':
                $result = array("En" =>  "Privacy Policy", "Ar" => 'سياسة الخصوصية');
                break;
            case 'TermsConditions':
                $result = array("En" =>  "Terms and Conditions", "Ar" => 'الشروط والأحكام');
                break;
            case 'CompletedOrders':
                $result = array("En" =>  "Completed Orders", "Ar" => 'الطلبات المكتملة');
                break;
            case 'CancelledOrders':
                $result = array("En" =>  "Canceled Orders", "Ar" => 'الطلبات الملغاة');
                break;
            case 'Previous':
                $result = array("En" =>  "Previous", "Ar" => 'السابق');
                break;
            case 'Next':
                $result = array("En" =>  "Next", "Ar" => 'التالي');
                break;
            case 'OrderID':
                $result = array("En" =>  "Order ID", "Ar" => 'رقم الطلب');
                break;
            case 'Custumer':
                $result = array("En" =>  "Custumer", "Ar" => 'العميل');
                break;
            case 'destination':
                $result = array("En" =>  "Shipping to", "Ar" => 'الشحن إلى');
                break;
            case 'Amount':
                $result = array("En" =>  "Amount", "Ar" => 'الكمية');
                break;
            case 'company':
                $result = array("En" =>  "Company", "Ar" => 'الشركة');
                break;
            case 'Driver':
                $result = array("En" =>  "Driver", "Ar" => 'السائق');
                break;
            case 'drivercash':
                $result = array("En" =>  "Driver cash", "Ar" => ' Driver cash');
                break;
            case 'Status':
                $result = array("En" =>  "Order Status", "Ar" => 'حالة الطلب');
                break;
            case 'iscashcollection':
                $result = array("En" =>  "Is cash collection", "Ar" => ' Is cash collection ');
                break;
            case 'Action':
                $result = array("En" =>  "Actions", "Ar" => 'العمليات');
                break;
            case 'Pending':
                $result = array("En" =>  "Pending", "Ar" => 'مؤجل');
                break;
            case 'Delete':
                $result = array("En" =>  "Delete", "Ar" => 'حذف');
                break;
            case 'notcollect':
                $result = array("En" =>  "Not Collect", "Ar" => ' Not Collect ');
                break;
            case 'collect':
                $result = array("En" =>  "Collect", "Ar" => ' Collect');
                break;
            case 'MoreDetails':
                $result = array("En" =>  "Order Info.", "Ar" => 'معلومات الطلب');
                break;
            case 'ShippingPrice':
                $result = array("En" =>  "Shipping Price", "Ar" => 'تكلفة الشحن');
                break;
            case 'orderdate':
                $result = array("En" =>  "Order Date", "Ar" => 'تاريخ الطلب');
                break;
            case 'Fare':
                $result = array("En" =>  "Fare", "Ar" => ' Fare ');
                break;
            case 'Address':
                $result = array("En" =>  "Address", "Ar" => 'العنوان');
                break;
            case 'Mobile':
                $result = array("En" =>  "Mobile", "Ar" => 'رقم الهاتف');
                break;
            case 'billing_mobile':
                $result = array("En" =>  "Mobile", "Ar" => ' رقم الهاتف');
                break;
            case 'shipping':
                $result = array("En" =>  "Shipping", "Ar" => 'الشحن');
                break;
            case 'TotalPrice':
                $result = array("En" =>  "Total Price", "Ar" => 'السعر الكلي');
                break;
            case 'price':
                $result = array("En" =>  " Price", "Ar" => 'السعر ');
                break;
            case 'PostCode':
                $result = array("En" =>  "Post Code", "Ar" => 'الرمز البريدي');
                break;
            case 'inprogressorders':
                $result = array("En" =>  "Orders in Progress", "Ar" => 'الطلبات قيد التجهيز');
                break;
                case 'inprogress':
                $result = array("En" =>  "In progress", "Ar" => 'جاري التجهيز');
                break;
            case 'Completed':
                $result = array("En" =>  "Completed", "Ar" => 'مكتمل');
                break;
            case 'Cancelled':
                $result = array("En" =>  "Cancelled", "Ar" => 'ملغي');
                break;
            case 'City':
                $result = array("En" =>  "City", "Ar" => 'المدينة');
                break;
            case 'Country':
                $result = array("En" =>  "Country", "Ar" => 'الدولة');
                break;
            case 'shipping_close_date':
                $result = array("En" =>  "Shipping Close Date", "Ar" => 'تاريخ التسليم');
                break;
            case 'confirmed_by':
                $result = array("En" =>  "Confirmed by", "Ar" => 'Confirmed_by');
                break;
            case 'RecieverCompany':
                $result = array("En" =>  "Reciever", "Ar" => 'المستلم');
                break;
            case 'Refrence':
                $result = array("En" =>  "Reference", "Ar" => 'الرقم المرجعي');
                break;
            case 'Contents':
                $result = array("En" =>  "Contents", "Ar" => 'المحتويات');
                break;
            case 'DeclaredValue':
                $result = array("En" =>  "Grand Total", "Ar" => 'المبلغ الإجمالي');
                break;
            case 'Weight':
                $result = array("En" =>  "Weight", "Ar" => 'الوزن');
                break;
            case 'Productcode':
                $result = array("En" =>  "Product Code", "Ar" => 'رمز المنتج');
                break;
            case 'Countrycode':
                $result = array("En" =>  "Country Code", "Ar" => 'رمز الدولة');
                break;
            case 'fax':
                $result = array("En" =>  "Fax", "Ar" => 'فاكس');
                break;
            case 'billing_fullname':
                $result = array("En" =>  "Full Name", "Ar" => 'الاسم الكامل');
                break;
            case 'billing_email':
                $result = array("En" =>  "E-mail", "Ar" => 'البريد الإلكتروني');
                break;
            case 'billing_fax':
                $result = array("En" =>  "Fax", "Ar" => 'فاكس');
                break;
            case 'billing_country':
                $result = array("En" =>  "Country", "Ar" => 'الدولة');
                break;
            case 'billing_city':
                $result = array("En" =>  "City", "Ar" => 'المدينة');
                break;
            case 'billing_state':
                $result = array("En" =>  "State", "Ar" => 'الولاية');
                break;
            case 'billing_zipcode':
                $result = array("En" =>  "Zip Code", "Ar" => 'الرمز البريدي');
                break;
            case 'billing_address1':
                $result = array("En" =>  "Address", "Ar" => 'العنوان');
                break;
                case 'Tax':
                $result = array("En" =>  "Tax", "Ar" => 'الضريبة');
                break;
            case 'Code':
                $result = array("En" =>  "Code", "Ar" => 'الرمز');
                break;
            case 'Print':
                $result = array("En" =>  "Print", "Ar" => 'طباعة');
                break;
                case 'PrintInvoice':
                $result = array("En" =>  "Print", "Ar" => 'طباعة');
                break;
            case 'Inshipping':
                $result = array("En" =>  "In shipping", "Ar" => 'جاري الشحن');
                break;
            case 'Inshippingorders':
                $result = array("En" =>  "In Shipping Orders", "Ar" => 'الطلبات قيد الشحن');
                break;
            case 'ShippingOrder':
                $result = array("En" =>  "Shipping Co.", "Ar" => 'شركة الشحن');
                break;
            case 'Date':
                $result = array("En" =>  "Date", "Ar" => 'التاريخ');
                break;
            case 'StartDate':
                $result = array("En" =>  "Start Date", "Ar" => 'تاريخ البدء');
                break;
            case 'EndDate':
                $result = array("En" =>  "End Date", "Ar" => 'تاريخ الانتهاء');
                break;
            case 'Manhal':
                $result = array("En" =>  "Manhal", "Ar" => 'Manhal');
                break;
            case 'DHL':
                $result = array("En" =>  "DHL", "Ar" => 'DHL');
                break;
            case 'Aramex':
                $result = array("En" =>  "Aramex", "Ar" => 'Aramex');
                break;
            case 'All':
                $result = array("En" =>  "All", "Ar" => 'الجميع');
                break;
            case 'Order_information':
                $result = array("En" =>  "Order Information", "Ar" => 'معلومات الطلب');
                break;
            case 'Billing_address':
                $result = array("En" =>  "Address", "Ar" => 'العنوان');
                break;
                case 'Shipping_address':
                $result = array("En" =>  "Address", "Ar" => 'العنوان');
                break;
            case 'manhal_ref':
                $result = array("En" =>  "Manhal Reference", "Ar" => 'معرف دار المنهل');
                break;
            case 'Number_of_sales_by_type_of_shipment':
                $result = array("En" =>  "Number of sales by type of shipment", "Ar" => 'Number of sales by type of shipment');
                break;
            case 'Number_of_sales_by_country':
                $result = array("En" =>  "Number of sales by country", "Ar" => 'Number of sales by country');
                break;
            case 'Number_of_purchases':
                $result = array("En" =>  "No. of Purchases", "Ar" => 'عدد المشتريات');
                break;
            case 'totalsubscriptions':
                $result = array("En" =>  "Subscriptions Details", "Ar" => 'تفاصيل الاشتراكات');
                break;
            case 'subscriptions':
                $result = array("En" =>  "Subscriptions", "Ar" => 'الاشتراكات');
                break;
            case 'subscriptions1':
                $result = array("En" =>  "Subscriptions Types", "Ar" => 'انواع الاشتراكات');
                break;
            case 'Family':
                $result = array("En" =>  "Family", "Ar" => 'الأهل');
                break;
            case 'Schools':
                 $result = array("En" =>  "Schools", "Ar" => 'المدارس');
                 break;
            case 'monthlysubscriptions':
                $result = array("En" =>  "Monthly Subscriptions", "Ar" => 'الاشتراك الشهري');
                break;
            case 'Yearlysubscriptions':
                $result = array("En" =>  "Yearly Subscriptions", "Ar" => 'الاشتراك السنوي');
                break;
            case 'settings':
                $result = array("En" =>  "settings", "Ar" => ' ألأعدادات ');
                break;
            case 'Save':
                $result = array("En" =>  "Save", "Ar" => ' حفظ ');
                break;
            case 'Stack':
                $result = array("En" =>  "Stock", "Ar" => 'Stock');
                break;
            case 'OutOfStack':
                $result = array("En" =>  "Out Of Stock", "Ar" => 'Out Of Stock');
                break;
            case 'books':
                $result = array("En" =>  "Books", "Ar" => 'Books');
                break;
            case 'stories':
                $result = array("En" =>  "Stories", "Ar" => 'Stories');
                break;
            case 'otherproducts':
                $result = array("En" =>  "Other products", "Ar" => 'Other products');
                break;
            case 'bookname':
                $result = array("En" =>  "Book Name", "Ar" => 'Book Name');
                break;
            case 'ISBN':
                $result = array("En" =>  "ISBN", "Ar" => 'ISBN');
                break;
            case 'noofpages':
                $result = array("En" =>  "No. of Pages :", "Ar" => 'No. of Pages :');
                break;
            case 'category':
                $result = array("En" =>  "Category", "Ar" => 'Category');
                break;
            case 'language':
                $result = array("En" =>  "Language", "Ar" => 'Language');
                break;
            case 'height':
                $result = array("En" =>  "Height", "Ar" => 'Height');
                break;
            case 'quantity':
                $result = array("En" =>  "Quantity", "Ar" => 'Quantity');
                break;
            case 'sales by Shipping Co.':
                $result = array("En" =>  "sales by Shipping Co.", "Ar" => 'sales by Shipping Co.');
                break;
            case 'salesbyShippingCo':
                $result = array("En" =>  "Sales by Shipping Co.", "Ar" => 'Sales by Shipping Co.');
                break;
            case 'weight':
                $result = array("En" =>  "Weight", "Ar" => 'Weight');
                break;
            case 'storyname':
                $result = array("En" =>  "Story Name", "Ar" => 'Story Name');
                break;
            case 'disable':
                $result = array("En" =>  "Disable", "Ar" => 'Disable');
                break;
            case 'thumb':
                $result = array("En" =>  "Thumb", "Ar" => 'Thumb');
                break;
            case 'book':
                $result = array("En" =>  "Book", "Ar" => 'Book');
                break;
            case 'privacyPolicy1':
                $result = array("En" => 'Dar Al-Manhal Publishers respects your privacy and values the relationship we have with you. This privacy policy describes the types of information we may collect from you, how we use the information, with whom we share it, and the choices available to you regarding our use of the information. We also describe the measures we take to protect the security of the information and how users of this website and our customers can contact us about our privacy practices. This privacy policy applies to personal and other information that may be collected when you interact with Dar Al-Manhal website.', "Ar" => 'تحترم دار المنهل ناشرون خصوصيتك وتقدر العلاقة التي تربطنا بك. تصف سياسة الخصوصية هذه أنواع المعلومات التي قد نأخذها منك، وكيف نستخدم المعلومات، ومن هم الذين نشاركهم بها، والخيارات المتاحة لك فيما يخص استخدامنا لهذه المعلومات. نحن أيضاً نصف التدابير التي نتخذها لحماية أمن مستخدمي المعلومات وكيف يمكن لمستخدمي هذا الموقع الالكتروني وعملائنا الاتصال بنا حول ممارسات الخصوصية.تطبق سياسة الخصوصية على المعلومات الشخصية وغيرها من التي قد يتم الحصول عليها عندما تتفاعل مع الموقع الالكتروني لدار المنهل. ');
                break;
            case 'Whatinformationwecollectaboutyou':
                $result = array("En" => 'What information we collect about you', "Ar" => 'ما هي المعلومات التي نجمعها عنك');
                break;
            case 'privacyPolicy2':
                $result = array("En" => 'We collect two basic types of information from you in conjunction with your use of our website: (1) Personally Identifiable Information (PII), which is any information that individually identifies you (e.g., your name, email address, telephone number, postal address, credit card information) and (2) Non-Personally Identifiable Information (NPII), which is information that does not personally identify you but may include information about your interests, demographics (e.g., age, gender, 5-digit zip code) and use of the website.', "Ar" => 'بالتزامن مع استخدامك لموقعنا على الانترنت، نحن نقوم بالحصول على نوعين أساسيين من المعلومات منك: (1) معلومات تعريف شخصية، وهي جميع المعلومات التي تعرف عنك بشكل فردي (على سبيل المثال، اسمك وعنوانك بريدك الإلكتروني ورقم هاتفك وعنوانك البريدي ومعلومات بطاقتك الائتمانية) و (2) معلومات تعريف غير شخصية، وهي جميع المعلومات التي لا تعرف عنك شخصيا ولكن قد تتضمن معلومات عن اهتماماتك والعوامل الديموغرافية (على سبيل المثال، العمر والجنس والرمز البريدي المتكون من خمس أرقام) واستخدام الموقع الالكتروني.');
                break;
            case 'privacyPolicy3':
                $result = array("En" => 'We collect, retain and use only the information about our customers that is required in registration page, or other pages in Dar Al-Manhal. We are committed to maintaining the privacy and security of your information. This information is limited to your email address, username, country, phone number, credit card and payment information. All these information are important to activate our service and clients. Your password is stored securely; all transmitted credit card information is also handled securely. We do not share this data unless with competent governmental authorities in the case of a binding court order, otherwise, all the data is kept in the strictest confidence.', "Ar" => 'نحن نحصل على معلومات عملائنا ونحتفظ بها ونستخدمها فقط لما هو مطلوب في صفحة التسجيل، أو صفحات أخرى في دار المنهل. ونحن ملتزمون بالحفاظ على سرية وأمن المعلومات الخاصة بك. تقتصر هذه المعلومات على عنوان بريدك الإلكتروني، واسم المستخدم الخاص بك، وبلدك، ورقم هاتفك، ومعلومات بطاقة الائتمان الخاصة بك ومعلومات الدفع. تعد جميع هذه المعلومات مهمة لتفعيل خدماتنا وعملائنا. يتم تخزين كلمة المرور الخاصة بك بشكل آمن. يتم التعامل مع جميع معلومات بطاقة الائتمان المحولة بشكل آمن. نحن لا نشارك هذه البيانات إلا مع السلطات الحكومية المختصة وفي حالة وجود أمر قضائي ملزم، وإلا، يتم الاحتفاظ بكافة البيانات في سرية تامة.');
                break;
            case 'privacyPolicy4':
                $result = array("En" => 'The email in the client account is the basic identity for him, in the case of client account password changes, the change will be confirmed via email for his account only.', "Ar" => 'إن البريد الإلكتروني في حساب العميل هو الهوية الأساسية بالنسبة له، في حالة تغيير كلمة مرور حساب العميل، سيتم تأكيد التغيير عبر البريد الإلكتروني لحسابه فقط. ');
                break;
            case 'privacyPolicy5':
                $result = array("En" => 'If authorized by you, we may also access profile and other information from services like Facebook, Google or Twitter.', "Ar" => 'قد ندخل إلى صفحتك الشخصية وغيرها من المعلومات من خدمات مثل الفيسبوك أو جوجل أو تويتر إذا سمحت بذلك.');
                break;
            case 'Sharingwiththirdparties':
                $result = array("En" => 'Sharing with third parties', "Ar" => 'مشاركة المعلومات مع أطراف ثالثة');
                break;
            case 'privacyPolicy6':
                $result = array("En" => 'All personally identifiable data provided by individuals is maintained in confidence by Dar Al-Manhal. There are instances, however, in which personally identifiable and non-personally identifiable information is shared with third parties, as described below.', "Ar" => 'يتم الحفاظ بجميع بيانات التعريف الشخصية المقدمة من قبل الافراد من قبل دار المنهل. ولكن هناك حالات يتم مشاركة معلومات التعريف الشخصية وغير الشخصية مع أطراف ثالثة، كما هو موضح أدناه.');
                break;
            case 'privacyPolicy7':
                $result = array("En" => 'With respect to personally identifiable information provided to Dar Al-Manhal, we may, from time to time, provide information to certain third-party for efficiency purposes in providing administrative services such as billing, delivery and pay-outs, or for other related services. Third parties are required to keep confidential the information received, and may not use it for any purpose other than to carry out the services they perform on our behalf.', "Ar" => 'فيما يتعلق بمعلومات التعريف الشخصية المقدمه لدار المنهل، يجوز لنا ومن وقت لآخر تقديم المعلومات لطرف ثالث لأغراض الكفاءة فيما يخص توفير خدمات إدارية كالفواتير والتسليم والدفع وتسليم دفعات، أو غيرها من الخدمات ذات العلاقة. ويلتزم الأطراف ثالثة بالحفاظ على سرية المعلومات التي وردت، ولا يجوز استخدامها لأي غرض آخر سوى تنفيذ الخدمات التي يقومون بها نيابة عنا.');
                break;
            case 'privacyPolicLI1':
                $result = array("En" => 'Google Analytics; their privacy policy can be found', "Ar" => 'تحليلات جوجل، ويمكن الاطلاع على سياسة الخصوصية الخاصة بها هن');
                break;
            case 'here':
                $result = array("En" => 'here', "Ar" => 'هنا');
                break;
            case 'privacyPolicLI2':
                $result = array("En" => 'PayPal; their privacy policy can be found', "Ar" => 'باي بال Paypal، ويمكن الاطلاع على سياسة الخصوصية الخاصة به هنا');
                break;
            case 'Dataretentionpolicy':
                $result = array("En" => 'Data retention policy', "Ar" => 'سياسة الاحتفاظ بالبيانات');
                break;
            case 'privacyPolicy9':
                $result = array("En" => 'We will retain your information for as long as your account is active or as needed to provide you with services. We will retain and use your information as necessary to comply with our legal obligations, resolve disputes, and enforce our agreements.', "Ar" => 'سنحتفظ بمعلوماتك طالما كان حسابك مفعل أو حسب الحاجة لتزويدك بالخدمات. سوف نستخدم ونحتفظ بالمعلومات الخاصة بك التي قد نحتاج إليها امتثالا لالتزاماتنا القانونية وحل النزاعات وإنفاذ اتفاقاتنا.');
                break;
            case 'DataSecurity':
                $result = array("En" => 'Data Security', "Ar" => 'حماية البيانات');
                break;
            case 'privacyPolicy10':
                $result = array("En" => 'Our website incorporates physical, electronic, and administrative procedures to safeguard the confidentiality of your personal information. We protect your personal information online, and we also take several steps to protect your personal information in our facilities.', "Ar" => '    يشمل موقعنا الالكتروني إجراءات مادية وإلكترونية وإدارية للحفاظ على سرية معلوماتك الشخصية. نحن نحمي معلوماتك الشخصية على الانترنت، ونقوم بالعديد من الخطوات لحماية معلوماتك الشخصية في مرافقنا.');
                break;
            case 'privacyPolicy11':
                $result = array("En" => 'While we use industry-standard precautions to safeguard your personal information, due to the nature of the Internet, we cannot guarantee complete security.', "Ar" => '    لا يمكن أن نضمن الأمن الكامل لحماية معلوماتك الشخصية على الرغم من أننا نستخدم احتياطات معايير ');
                break;
            case 'Changestothisprivacypolicy':
                $result = array("En" => 'Changes to this privacy policy', "Ar" => 'تغييرات على سياسة الخصوصية');
                break;
            case 'privacyPolicy12':
                $result = array("En" => 'We may add new services and features to this website. In the event that these additions affect our privacy policy, or if other changes in our privacy practices or applicable laws necessitate changes to the privacy policy, this document will be updated accordingly. If we make a material change in the way we use your personal information, we will provide prominent notice of the change on this website.', "Ar" => 'قد نضيف خدمات جديدة وميزات لهذا الموقع. سيتم تحديث هذه الوثيقة في حال أثرت تلك الإضافات على سياسة الخصوصية الخاصة بك، أو إذا كانت التغييرات الأخرى في ممارسات الخصوصية الخاصة بنا أو القوانين المعمول بها تتطلب تغييرات على سياسة الخصوصية. إذا قمنا بعمل تغيير جوهري في الطريقة التي نستخدم بها معلوماتك الشخصية، سنقوم بإصدار إشعار بارز فيما يخص هذا التغيير على هذا الموقع الإلكتروني.');
                break;
            case 'ContectUs':
                $result = array("En" => 'Contact Us', "Ar" => 'تواصل معنا');
                break;
            case 'privacyPolicy13':
                $result = array("En" => 'If you have any questions about this privacy statement, the practices of this website, or your dealings with it, you can contact Dar Al-Manhal at the address below.', "Ar" => 'إذا كان لديك أي أسئلة حول بيان الخصوصية هذا، والممارسات حول هذا الموقع الالكتروني أو تعاملك معه، يمكنك الاتصال بدار المنهل على العنوان الموضح أدناه.');
                break;
            case 'DarAlManhalPublishers':
                $result = array("En" => 'Dar Al-Manhal Publishers', "Ar" => 'دار المنهل ناشرون');
                break;
            case 'TitleOne':
                $result = array("En" => 'Al -Taiseer Bldg No. (75), S. Nabulsi Str. Al – Abdali', "Ar" => 'دار المنهل ناشرون');
                break;
            case 'Titletwo':
                $result = array("En" => 'P.O.Box: 926428 – Amman 11190 Jordan', "Ar" => 'بناية تيسير رقم (75)، شارع س. النابلسي، العبدلي');
                break;
            case 'Titlethree':
                $result = array("En" => 'Tel: +962 (6) 5698308 Fax: +962 (6) 5639185', "Ar" => 'ص.ب: 926428، عمان 11190 الأردن');
                break;
            case 'Titlefour':
                $result = array("En" => 'E-mail: info@manhal.com', "Ar" => '    البريد الإلكتروني: info@manhal.com ');
                break;

            case 'TermsConditionsp1':
                $result = array("En" => 'This website is owned and operated by Dar Al-ManhalPublishers, and is made available on the following terms and conditions. Please read these terms of use carefully because, by using our website, you confirm that you accept these terms of use and that you agree to comply with them.', "Ar" => 'تعود ملكية هذا الموقع الالكتروني وإدارتة لشركة دار المنهل ناشرون ، وقد تمت إتاحته وفقاً للشروط والأحكام التالية. يرجى قراءة شروط الاستخدام هذه بعناية لأنه بدخولك موقعنا، تكون قد أكدت قبول شروط الاستخدام هذه، وأنك وافقت على الالتزام بها.');
                break;
             case 'Copyrightandownership':
                $result = array("En" => 'Copyright and ownership', "Ar" => '');
                break;
                 case 'TermsConditionsp2':
                $result = array("En" => 'All of the content featured, displayed or offered for sale on the website, including, but not limited to, text, graphics, photographs, images, moving images, sound, illustrations, software and any other content (collectively, the “Content”), is owned by Dar Al-Manhal, its licensors, vendors and/or its content providers. All elements of the website, including but not limited to the general design and the content, are protected by trade dress, copyright, moral rights, trademark and other laws relating to intellectual property rights. You may not modify any of the materials and you may not copy, distribute, transmit, display, perform, reproduce, publish, license, create derivative works from, transfer or sell any information or work contained on the website. Except as permitted under applicable copyright laws, you are responsible for obtaining permission before re-using any copyrighted material that is available on the website. For purposes of these terms, the use of any such material on any other website or networked computer environment is prohibited. You shall comply with all applicable domestic and international laws, statutes, ordinances and regulations regarding your use of the website. The website, the content and all related rights shall remain the exclusive property of <b>Dar Al-Manhal</b> Publishers unless otherwise expressly agreed in writing. You will not remove any copyright, trademark or other proprietary notices from material found on this website.', "Ar" => '');
                break;
                 case 'Siteaccesslicense':
                $result = array("En" => 'Site access license', "Ar" => '');
                break;
                 case 'TermsConditionsp3':
                $result = array("En" => 'Dar Al-Manhal grants you a limited, revocable, non-exclusive, non-transferable license to access and make personal, noncommercial use of the website or its content and not to download (other than page caching or unless otherwise allowed by <b>Dar Al-Manhal</b> or permitted by law) or modify all or any portion of the website and its content. This license does not include any re-sale or commercial use of the website and its content; any collection and use of any product listings, descriptions, or prices; any derivative use of the website and its content; any downloading or copying of account information for the benefit of another merchant; or any use of data mining, robots, or similar data gathering and extraction tools. The website and/or any portion of the website or its content may not be reproduced, duplicated, copied, sold, resold, visited or otherwise exploited for any commercial purpose without <b>Dar Al-Manhal’</b>s express prior written consent. You shall not frame or utilize framing techniques to enclose any trademark, logo or other proprietary information (including images, text, page layout or form) of Dar Al-Manhal, its content providers or its affiliates without express prior written consent. You shall not use any meta tags or any other “hidden text” utilizing our name or trademarks without our express prior written consent. Additionally, you agree that you will not: (i) take any action that imposes, or may impose in our sole discretion an unreasonable or disproportionately large load on our infrastructure; (ii) interfere or attempt to interfere with the proper working of the website or any activities conducted on the website; or (iii) bypass any measures we may use to prevent or restrict access to the website. Any unauthorized use automatically terminates the permissions and/or licenses granted by us to you.', "Ar" => '');
                break;
            case 'Corporateidentificationtrademarks':
                $result = array("En" => 'Corporate identification &amp; trademarks', "Ar" => '');
                break;
                 case 'TermsConditionsp4':
                $result = array("En" => 'All of our trademarks, service marks and trade names used herein (including but not limited to the corporate names and logos of Dar Al-Manhal and its publishing divisions and imprints, names and designs of the website, and any logos) are trademarks or registered trademarks of<b>Dar Al-Manhal</b> or its affiliates and partners. You may not use, copy, reproduce, republish, upload, post, transmit, distribute, or modify such trademarks in any way, including in advertising or publicity pertaining to distribution of materials on the website, without Dar Al-Manhal’s express prior written consent. The use of our trademarks on any other website or network computer environment is not allowed. You are granted a limited, revocable, non-exclusive, non-transferable right to create a link to any page of the website so long as the link does not portray us, our content providers, our licensors, our affiliates, or our products or services in a false, misleading, derogatory or otherwise offensive manner. You may not use any <b>Dar Al-Manhal</b> logo or other proprietary graphic or trademark as part of the link without express written permission. Except as expressly stated herein, no rights or licenses are granted hereunder.', "Ar" => '');
                break;
                 case 'Linkstothirdpartiesnoendorsement':
                $result = array("En" => 'Links to third parties &amp; no endorsement', "Ar" => '');
                break;
                 case 'TermsConditionsp5':
                $result = array("En" => ' The website contains links to other websites controlled by third parties. These links are provided solely as a convenience to you and do not imply endorsement by <b>Dar Al-Manhal</b> of, or any affiliation with, or endorsement by, the owner of the linked website. Dar Al-Manhal is not responsible for the contents or use of any linked website, or any consequence of making the link. The websites may also include a tool that allows you to sign in or register using information from your account with a third party service (e.g., Facebook, Twitter). These third party services are unrelated to the websites, and your use of such third party services is subject to the terms and policies of those services. You shall not use <b>Dar Al-Manhal</b>’s name or any language, pictures or symbols which could, in <b>Dar Al-Manhal</b>’s judgment, imply <b>Dar Al-Manhal</b>’s endorsement in any (i) written or oral advertising or presentation, or (ii) brochure, newsletter, book, or other written material of whatever nature, without prior written consent.', "Ar" => '');
                break;
                 case 'Fees':
                $result = array("En" => 'Fees', "Ar" => 'Fees');
                break;
                 case 'TermsConditionsp6':
                $result = array("En" => 'For all charges for any products and services sold on the website, Dar Al-Manhal or its vendors or agents will bill your credit card or an alternative payment method. When you provide credit card information to us or our vendors, you represent to us that you are the authorized user of the credit card that is used to pay for the products and services. In the event legal action is necessary to collect on balances due, you agree to reimburse <b>Dar Al-Manhal</b> and its vendors or agents for all expenses incurred to recover sums due, including attorney’s fees and other legal expenses. You are responsible for purchase of, and payment of charges for, all Internet access services and telecommunications services needed for use of the websites.', "Ar" => '');
                break;
                 case 'TermsConditionsp7':
                $result = array("En" => 'Data collection and use, including data collection and use of personal information is governed by Dar Al-Manhal’s Privacy Policy which is incorporated into and is a part of this agreement. ', "Ar" => '');
                break;
                 case 'Usersubmissions':
                $result = array("En" => 'User Submissions', "Ar" => '');
                break;
                 case 'TermsConditionsp8':
                $result = array("En" => 'Where we have specifically invited or requested user submitted content of any kind, we encourage members of the public to submit such content (e.g., user generated content, comments on content) to <b>Dar Al-Manhal</b> that they have created for consideration in connection with the website and any related programs (“User Submissions”). User Submissions remain the intellectual property of the individual user. By posting your content on the website, you expressly grant Dar Al-Manhal a non-exclusive, perpetual, irrevocable, royalty-free, fully paid-up worldwide, fully sub-licensable right to use, reproduce, modify, adapt, publish, translate, create derivative works from, distribute, transmit, perform and display such content and your name, voice, and/or likeness as contained in your user submission, in whole or in part, and in any form throughout the world in any media or technology, whether now known or hereafter discovered, including all promotion, advertising, marketing, merchandising, publicity and any other ancillary uses thereof, and including the unfettered right to sublicense such rights, in perpetuity throughout the universe. We may refuse or remove user submissions for any reason and without notice. All user submissions are deemed non-confidential and <b>Dar Al-Manhal</b> shall be under no obligation to maintain the confidentiality of any information, in whatever form, contained in any user submission. ', "Ar" => '');
                break;
                 case 'TermsConditionsp9':
                $result = array("En" => 'By submitting any user submissions, you consent to the following rules:', "Ar" => '');
                break;
                 case 'TermsConditionsp10':
                $result = array("En" => 'User submissions must not infringe on the copyright, trademark, patent or other intellectual property right of any third party. If your user submission is not your original work, you must obtain all necessary permissions from any persons who contributed to or otherwise may control rights in all or part of the user submission to submit the user submission in accordance with these terms.', "Ar" => '');
                break;
                 case 'TermsConditionsp11':
                $result = array("En" => 'User submissions must not violate a third party’s right to privacy or publicity. You must obtain all necessary permissions from any individuals identified in or implicated by your User submission, including those shown in photographic content, and, in the case of minors, also from their parents or legal guardians, as appropriate. ', "Ar" => '');
                break;
                 case 'TermsConditionsp12':
                $result = array("En" => 'User submissions must be respectful of others. Epithets or other language or material intended to intimidate or to incite violence are strictly prohibited. Your user submission may not include any negative comments that are connected to race, national origin, gender, sexual orientation or physical handicap or that are defamatory, slanderous, indecent, obscene, pornographic or sexually explicit. ', "Ar" => '');
                break;
                 case 'TermsConditionsp13':
                $result = array("En" => 'User submissions may not contain any commercial material. You may not solicit funds, promote commercial entities or otherwise engage in commercial activity through your user submission.', "Ar" => '');
                break;
                 case 'TermsConditionsp14':
                $result = array("En" => 'Soliciting other users to join or become members of any commercial online service or other organization is expressly prohibited.', "Ar" => '');
                break;
                 case 'TermsConditionsp15':
                $result = array("En" => 'Do not impersonate any other person or entity or falsely state or otherwise misrepresent your affiliation with any person or entity.', "Ar" => '');
                break;
                 case 'TermsConditionsp16':
                $result = array("En" => 'Remember that forums and other areas of the website are public. Do not post personal information (e.g., full name, password, phone number, address, email address or other personally identifiable information or contact information) in these areas.', "Ar" => '');
                break;
                 case 'TermsConditionsp17':
                $result = array("En" => 'All user submissions must comply with these rules and any additional guidelines posted on the website, as applicable. User submissions do not represent the views of <b>Dar Al-Manhal</b> or any individual associated with <b>Dar Al-Manhal</b>, and we do not control this content. In no event shall you represent or suggest, directly or indirectly, <b>Dar Al-Manhal</b>’s endorsement of user submissions. <b>Dar Al-Manhal</b> does not vouch for the accuracy or credibility of any user submissions, and does not take any responsibility or assume any liability for any actions you may take as a result of reading user submissions on the website. Through your use of the website, you may be exposed to content and user submissions that you may find offensive, objectionable, harmful, inaccurate or deceptive. There may also be risks of dealing with underage persons, people acting under false pretense, international trade issues and foreign nationals. By using the website, you assume all associated risks.', "Ar" => '');
                break;
            case 'TermsConditionsp18':
                $result = array("En" => 'We will not monitor, edit, or disclose the contents of a user’s email unless required in the course of normal maintenance of the website and its systems or unless required to do so by law or in the good-faith belief that such action is necessary to: (1) comply with the law or comply with legal process served on <b>Dar Al-Manhal</b>; (2) protect and defend the rights or property of <b>Dar Al-Manhal</b>, the website, or the users of <b>Dar Al-Manhal</b>; or (3) act in an emergency to protect the personal safety of our guests, the website, or the public. Users shall remain solely responsible for the content of their messages and <b>Dar Al-Manhal</b> shall have no obligation to pre-screen any such content. However, we shall have the right in our sole discretion to edit, refuse to post or remove any material submitted to or posted on the website. Without limiting the foregoing, we shall have the right to remove any material that we find to be in violation of the provisions hereof or otherwise objectionable, and the additional right to deny any user who fails to conform to any provision of these terms access to the website.', "Ar" => '');
                break;
            case 'TermsConditionsp19':
                $result = array("En" => 'If you decide to register as a member of a website, you may receive or establish one or more user names, passwords and accounts. In consideration of use of your registration, you will: (a) provide true, accurate, current and complete information about yourself as prompted by the applicable registration form (such information being the “Registration Data”) and (b) maintain and promptly update the Registration Data to keep it true, accurate, current and complete. If you provide any information that is untrue, inaccurate, not current or incomplete, or <b>Dar Al-Manhal</b> has grounds to suspect that such information is untrue, inaccurate, not current or incomplete, <b>Dar Al-Manhal</b> has the right to suspend or terminate your account and refuse any and all current or future use of the website (or any portion thereof). You are entirely responsible for the security and confidentiality of your password and account. Furthermore, you are entirely responsible for any and all activities that occur under your account. You agree to immediately notify us of any unauthorized use of your account or any other breach of security of which you become aware. You are responsible for taking precautions and providing security measures best suited for your situation and intended use of the registration and website. We have the right to provide user billing, account, content or user records, and related information under certain circumstances (such as in response to legal responsibility, lawful process, orders, subpoenas, or warrants, or to protect our rights, customers or business) to third parties.', "Ar" => '');
                break;
            case 'TermsConditionsp20':
                $result = array("En" => 'Dar Al-Manhal may suspend or terminate any user’s access to all or any part of the website including any account thereon, without notice, for any reason in Dar Al-Manhal’s sole discretion, including without limitation Dar Al-Manhal’s belief that such access would violate any applicable law or would be harmful to the interests of <b>Dar Al-Manhal</b> or another user. Upon termination, you will lose access to the website and all content thereon. The obligations that you have to Dar Al-Manhal under these terms will continue even after we suspend or terminate your access to the website.', "Ar" => '');
                break;
            case 'TermsConditionsp21':
                $result = array("En" => 'Neither Dar Al-Manhal nor you shall be responsible for damages or for delays or failures in performance resulting from acts or occurrences beyond their respective reasonable control, including, without limitation: fire, lightning, explosion, power surge or failure, water, war, revolution, civil commotion or acts of civil or military authorities or public enemies: any law, order, regulation, ordinance, or requirement of any government or legal body or any representative of any such government or legal body; or labor unrest, including without limitation, strikes, slowdowns, picketing, or boycotts; inability to secure raw materials, transportation facilities, fuel or energy shortages, or acts or omissions of other common carriers.', "Ar" => '');
                break;
            case 'TermsConditionsp22':
                $result = array("En" => 'This agreement is the entire agreement between the user and <b>Dar Al-Manhal</b> and supersedes any prior understandings or agreements (written or oral).', "Ar" => '');
                break;
            case 'Removalofusersubmissions':
                $result = array("En" => 'Removal of user submissions', "Ar" => '');
                break;
            case 'Accountregistrationandsecurity':
                $result = array("En" => 'Account registration and security', "Ar" => '');
                break;
            case 'Termination':
                $result = array("En" => 'Termination', "Ar" => '');
                break;
            case 'Forcemajeure':
                $result = array("En" => 'Force majeure', "Ar" => '');
                break;
            case 'Entire agreement':
                $result = array("En" => 'Entireagreement', "Ar" => '');
                break;
            case 'publishers':
                $result = array("En" =>  "Publishers", "Ar" => 'الناشرون');
                break;
            case 'codenumber':
                $result = array("En" =>  "Code Number", "Ar" => 'Code Number');
                break;
            case 'publishernamear':
                $result = array("En" =>  "Publisher Name (Arabic)", "Ar" => 'Publisher Name (Arabic)');
                break;
            case 'publishernameen':
                $result = array("En" =>  "Publisher Name (English)", "Ar" => 'Publisher Name (English)');
                break;















            case 'groups':
                $result = array("En" =>  "Groups", "Ar" => 'Groups');
                break;


            case 'salesbyShippingCo':
                $result = array("En" =>  "Sales by Shipping Co.", "Ar" => 'Sales by Shipping Co.');
                break;
            case 'productname':
                $result = array("En" =>  "Product Name", "Ar" => 'Product Name');
                break;
            case 'groupnamear':
                $result = array("En" =>  "Group Name (Arabic)", "Ar" => 'Group Name (Arabic)');
                break;
            case 'groupnameen':
                $result = array("En" =>  "Group Name (English)", "Ar" => 'Group Name (English)');
                break;
            case 'ordersreport':
                $result = array("En" =>  "Orders Report", "Ar" => 'Orders Report');
                break;
            case 'salesreport':
                $result = array("En" =>  "Sales Report", "Ar" => 'Sales Report');
                break;

            case 'msgjavascript':
                $result = array(
                    "En" => ["Login_failed" => ["Title" => "Login failed", "Des" => "Invalid username or password"],
                        "changeOfStatusRequest" => ["Title" => "change", "Des" => "Are you sure you want to change it ?"]

                    ],
                    "Ar" =>
                        [ "Login_failed" => ["Title" => "فشل عملية الدخول", "Des" => "خطأ في اسم المستخدم أو كلمة مرور"]
                            ,
                            "changeOfStatusRequest" => ["Title" => "change", "Des" => "Are you sure you want to change it ?"]

                    ]
                );
                return json_encode($result[$session_lang]);
                break;
        }

        return str_replace('"', "", json_encode($result[$session_lang], JSON_UNESCAPED_UNICODE));
    }

    public function Sessionlang()
    {
        if(isset($_SESSION["lang"]) && $_SESSION["lang"]!=''){
            $session_lang = $_SESSION["lang"];
        }else{
            $session_lang ='En';
        }

        return strtolower($session_lang);
    }
}
