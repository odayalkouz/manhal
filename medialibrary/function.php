<?php
/**
 * Created by PhpStorm.
 * User: khalid
 * Date: 15/06/2020
 * Time: 03:34 م
 */
include_once "api.php";

trait language
{

    public function lang($var)
    {
        switch ($var) {
            case 'lang':
                $result = array("En" => 'English', "Ar" => 'عربي');
                break;
            case 'title_heder':
                $result = array("En" => 'Dar Al-Manhal Media Library', "Ar" => 'مكتبة دار المنهل للوسائط');
                break;
                case 'Username':
                $result = array("En" => 'Username', "Ar" => 'إسم المستخدم');
                break;
                case 'Password':
                $result = array("En" => 'Password', "Ar" => 'كلمة المرور');
                break;
                case 'Email':
                $result = array("En" => 'email', "Ar" => 'البريد الالكتورني');
                break;
                case 'Remember_me':
                $result = array("En" => 'Remember me', "Ar" => 'تذكرني');
                break;
                case 'Login_to_your_account':
                $result = array("En" => 'Login to your account', "Ar" => 'ادخل الى حسابك');
                break;
                case 'LOGIN':
                $result = array("En" => 'LOGIN', "Ar" => 'تسجيل الدخول');
                break;
                case 'Title_ar':
                $result = array("En" => 'Title (Ar)', "Ar" => 'العنوان عربي');
                break;
            case 'Title_en':
                $result = array("En" => 'Title (En)', "Ar" => 'العنوان إنجليزي');
                break;
            case 'Action':
                $result = array("En" => 'Action', "Ar" => 'الإجراء');
                break;
            case 'home':
                $result = array("En" => 'Home', "Ar" => 'الرئيسة');
                break;
            case 'media':
                $result = array("En" => 'Media', "Ar" => 'الوسائط');
                break;
            case 'categories':
                $result = array("En" => 'Categories', "Ar" => 'التصنيفات');
                break;
            case 'add':
                $result = array("En" => 'Add', "Ar" => 'إضافة');
                break;
                case 'save':
                $result = array("En" => 'Save', "Ar" => 'حفظ');
                break;
            case 'name':
                $result = array("En" => 'Name', "Ar" => 'الإسم');
                break;
                case 'Directory':
                $result = array("En" => 'Directory', "Ar" => 'الموثع');
                break;
                case 'Extention':
                $result = array("En" => 'Extention', "Ar" => 'الإمتداد');
                break;
            case 'edit':
                $result = array("En" => 'Edit', "Ar" => 'تعديل');
                break;
                case 'Type':
                $result = array("En" => 'Type', "Ar" => 'النوع');
                break;
                case 'Edit_Type':
                $result = array("En" => 'Edit Type', "Ar" => 'تعديل النوع');
                break;
            case 'delete':
                $result = array("En" => 'Delete', "Ar" => 'حذف');
                break;
            case 'ClearAll':
                $result = array("En" => 'Clear all', "Ar" => ' إزالة الجميع ');
                break;
            case 'Clear':
                $result = array("En" => 'Clear ', "Ar" => ' إزالة');
                break;
            case 'Filters':
                $result = array("En" => 'Filters ', "Ar" => ' فلاتر');
                break;
            case 'Tags':
                $result = array("En" => 'Tags ', "Ar" => ' العلامات');
                break;
            case 'Previous':
                $result = array("En" => 'Previous', "Ar" => 'السابق');
                break;
            case 'Next':
                $result = array("En" => 'Next', "Ar" => 'التالي');
                break;
            case 'Colors':
                $result = array("En" => 'Colors ', "Ar" => ' الالوان');
                break;
            case 'Category':
                $result = array("En" => 'Category ', "Ar" => ' التصنيفات');
                break;
                case 'Edit_Category':
                $result = array("En" => 'Edit Category ', "Ar" => ' تعديل التصنيف');
                break;
                case 'Upload_media':
                $result = array("En" => 'Upload media ', "Ar" => 'تحميل الميديا');
                break;
                case 'Edit_Media':
                $result = array("En" => 'Edit Media ', "Ar" => 'تعديل الوسائط');
                break;
                case 'Sort_Category':
                $result = array("En" => 'Sort Category ', "Ar" => ' ترتيب التصنيف');
                break;
            case 'All':
                $result = array("En" => 'All ', "Ar" => ' الكل');
                break;
            case 'privacy_policy':
                $result = array("En" => 'Privacy Policy', "Ar" => 'سياسة الخصوصية');
                break;
            case 'terms_conditions':
                $result = array("En" => 'Terms & Conditions', "Ar" => 'البنود والشروط');
                break;
            case 'privacyPolicy1':
                $result = array("En" => 'Dar Al-Manhal Publishers respects your privacy and values the relationship we have with you. This privacy policy describes the types of information we may collect from you, how we use the information, with whom we share it, and the choices available to you regarding our use of the information. We also describe the measures we take to protect the security of the information and how users of this website and our customers can contact us about our privacy practices. This privacy policy applies to personal and other information that may be collected when you interact with Dar Al-Manhal website.', "Ar" => 'تحترم دار المنهل ناشرون خصوصيتك وتقدر العلاقة التي تربطنا بك. تصف سياسة الخصوصية هذه أنواع المعلومات التي قد نأخذها منك، وكيف نستخدم المعلومات، ومن هم الذين نشاركهم بها، والخيارات المتاحة لك فيما يخص استخدامنا لهذه المعلومات. نحن أيضاً نصف التدابير التي نتخذها لحماية أمن مستخدمي المعلومات وكيف يمكن لمستخدمي هذا الموقع الالكتروني وعملائنا الاتصال بنا حول ممارسات الخصوصية.تطبق سياسة الخصوصية على المعلومات الشخصية وغيرها من التي قد يتم الحصول عليها عندما تتفاعل مع الموقع الالكتروني لدار المنهل. ');
                break;
            case 'Whatinformationwecollectaboutyou':
                $result = array("En" => 'What information we collect about you', "Ar" => 'ما هي المعلومات التي نجمعها عنك');
                break;
            case 'paragraph1':
                $result=array("En" => 'We collect two basic types of information from you in conjunction with your use of our website: (1) Personally Identifiable Information (PII), which is any information that individually identifies you (e.g., your name, email address, telephone number, postal address, credit card information) and (2) Non-Personally Identifiable Information (NPII), which is information that does not personally identify you but may include information about your interests, demographics (e.g., age, gender, 5-digit zip code) and use of the website. ',"Ar" => 'بالتزامن مع استخدامك لموقعنا على الانترنت، نحن نقوم بالحصول على نوعين أساسيين من المعلومات منك: (1) معلومات تعريف شخصية، وهي جميع المعلومات التي تعرف عنك بشكل فردي (على سبيل المثال، اسمك وعنوانك بريدك الإلكتروني ورقم هاتفك وعنوانك البريدي ومعلومات بطاقتك الائتمانية) و (2) معلومات تعريف غير شخصية، وهي جميع المعلومات التي لا تعرف عنك شخصيا ولكن قد تتضمن معلومات عن اهتماماتك والعوامل الديموغرافية (على سبيل المثال، العمر والجنس والرمز البريدي المتكون من خمس أرقام) واستخدام الموقع الالكتروني. ');
                break;
            case 'paragraph2':
                $result=array("En" => 'We collect, retain and use only the information about our customers that is required in registration page, or other pages in Dar Al-Manhal. We are committed to maintaining the privacy and security of your information. This information is limited to your email address, username, country, phone number, credit card and payment information. All these information are important to activate our service and clients. Your password is stored securely; all transmitted credit card information is also handled securely. We do not share this data unless with competent governmental authorities in the case of a binding court order, otherwise, all the data is kept in the strictest confidence. ',"Ar" => 'نحن نحصل على معلومات عملائنا ونحتفظ بها ونستخدمها فقط لما هو مطلوب في صفحة التسجيل، أو صفحات أخرى في دار المنهل. ونحن ملتزمون بالحفاظ على سرية وأمن المعلومات الخاصة بك. تقتصر هذه المعلومات على عنوان بريدك الإلكتروني، واسم المستخدم الخاص بك، وبلدك، ورقم هاتفك، ومعلومات بطاقة الائتمان الخاصة بك ومعلومات الدفع. تعد جميع هذه المعلومات مهمة لتفعيل خدماتنا وعملائنا. يتم تخزين كلمة المرور الخاصة بك بشكل آمن. يتم التعامل مع جميع معلومات بطاقة الائتمان المحولة بشكل آمن. نحن لا نشارك هذه البيانات إلا مع السلطات الحكومية المختصة وفي حالة وجود أمر قضائي ملزم، وإلا، يتم الاحتفاظ بكافة البيانات في سرية تامة. ');
                break;
            case 'paragraph3':
                $result=array("En" => 'The email in the client account is the basic identity for him, in the case of client account password changes, the change will be confirmed via email for his account only. ',"Ar" => 'إن البريد الإلكتروني في حساب العميل هو الهوية الأساسية بالنسبة له، في حالة تغيير كلمة مرور حساب العميل، سيتم تأكيد التغيير عبر البريد الإلكتروني لحسابه فقط. ');
                break;
            case 'paragraph4':
                $result=array("En" => 'If authorized by you, we may also access profile and other information from services like Facebook, Google or Twitter. ',"Ar" => 'قد ندخل إلى صفحتك الشخصية وغيرها من المعلومات من خدمات مثل الفيسبوك أو جوجل أو تويتر إذا سمحت بذلك. ');
                break;
            case 'titleB':
                $result=array("En" => 'Sharing with third parties ',"Ar" => 'مشاركة المعلومات مع أطراف ثالثة ');
                break;
            case 'paragraph5':
                $result=array("En" => 'All personally identifiable data provided by individuals is maintained in confidence by Dar Al-Manhal. There are instances, however, in which personally identifiable and non-personally identifiable information is shared with third parties, as described below. ',"Ar" => 'يتم الحفاظ بجميع بيانات التعريف الشخصية المقدمة من قبل الافراد من قبل دار المنهل. ولكن هناك حالات يتم مشاركة معلومات التعريف الشخصية وغير الشخصية مع أطراف ثالثة، كما هو موضح أدناه. ');
                break;
            case 'titleC':
                $result=array("En" => 'Third party sites ',"Ar" => 'المواقع الالكترونية للطرف الثالث ');
                break;
            case 'paragraph6':
                $result=array("En" => 'Google Analytics; their privacy policy can be found Here',"Ar" => 'تحليلات جوجل، ويمكن الاطلاع على سياسة الخصوصية الخاصة بها هنا');
                break;
            case 'paragraph7':
                $result=array("En" => 'PayPal; their privacy policy can be found Here',"Ar" => 'باي بال Paypal، ويمكن الاطلاع على سياسة الخصوصية الخاصة به هنا');
                break;
            case 'titleD':
                $result=array("En" => 'Data retention policy ',"Ar" => 'سياسة الاحتفاظ بالبيانات ');
                break;
            case 'paragraph8':$result=array("En" => 'We will retain your information for as long as your account is active or as needed to provide you with services. We will retain and use your information as necessary to comply with our legal obligations, resolve disputes, and enforce our agreements. ',"Ar" => 'سنحتفظ بمعلوماتك طالما كان حسابك مفعل أو حسب الحاجة لتزويدك بالخدمات. سوف نستخدم ونحتفظ بالمعلومات الخاصة بك التي قد نحتاج إليها امتثالا لالتزاماتنا القانونية وحل النزاعات وإنفاذ اتفاقاتنا. ');
                break;
            case 'titleE':
                $result=array("En" => 'Data Security ',"Ar" => 'حماية البيانات ');
                break;
            case 'paragraph9':
                $result=array("En" => 'Our website incorporates physical, electronic, and administrative procedures to safeguard the confidentiality of your personal information. We protect your personal information online, and we also take several steps to protect your personal information in our facilities. ',"Ar" => 'يشمل موقعنا الالكتروني إجراءات مادية وإلكترونية وإدارية للحفاظ على سرية معلوماتك الشخصية. نحن نحمي معلوماتك الشخصية على الانترنت، ونقوم بالعديد من الخطوات لحماية معلوماتك الشخصية في مرافقنا. ');
                break;
            case 'paragraph10':
                $result=array("En" => 'While we use industry-standard precautions to safeguard your personal information, due to the nature of the Internet, we cannot guarantee complete security. ',"Ar" => 'لا يمكن أن نضمن الأمن الكامل لحماية معلوماتك الشخصية على الرغم من أننا نستخدم احتياطات معايير الصناعة وذلك لطبيعة الإنترنت. ');
                break;
            case 'titleF':
                $result=array("En" => 'Changes to this privacy policy ',"Ar" => 'تغييرات على سياسة الخصوصية ');
                break;
            case 'paragraph11':
                $result=array("En" => 'We may add new services and features to this website. In the event that these additions affect our privacy policy, or if other changes in our privacy practices or applicable laws necessitate changes to the privacy policy, this document will be updated accordingly. If we make a material change in the way we use your personal information, we will provide prominent notice of the change on this website. ',"Ar" => 'قد نضيف خدمات جديدة وميزات لهذا الموقع. سيتم تحديث هذه الوثيقة في حال أثرت تلك الإضافات على سياسة الخصوصية الخاصة بك، أو إذا كانت التغييرات الأخرى في ممارسات الخصوصية الخاصة بنا أو القوانين المعمول بها تتطلب تغييرات على سياسة الخصوصية. إذا قمنا بعمل تغيير جوهري في الطريقة التي نستخدم بها معلوماتك الشخصية، سنقوم بإصدار إشعار بارز فيما يخص هذا التغيير على هذا الموقع الإلكتروني. ');
                break;
            case 'titleG':
                $result=array("En" => 'Contact Us ',"Ar" => 'اتصل بنا');
                break;
            case 'paragraph12':
                $result=array("En" => 'If you have any questions about this privacy statement, the practices of this website, or your dealings with it, you can contact Dar Al-Manhal at the address below. ',"Ar" => 'إذا كان لديك أي أسئلة حول بيان الخصوصية هذا، والممارسات حول هذا الموقع الالكتروني أو تعاملك معه، يمكنك الاتصال بدار المنهل على العنوان الموضح أدناه. ');
                break;
            case 'paragraphterms':
                $result=array("En" => 'This website is owned and operated by Dar Al-ManhalPublishers, and is made available on the following terms and conditions. Please read these terms of use carefully because, by using our website, you confirm that you accept these terms of use and that you agree to comply with them. ',"Ar" => 'تعود ملكية هذا الموقع الالكتروني وإدارتة لشركة دار المنهل ناشرون ، وقد تمت إتاحته وفقاً للشروط والأحكام التالية. يرجى قراءة شروط الاستخدام هذه بعناية لأنه بدخولك موقعنا، تكون قد أكدت قبول شروط الاستخدام هذه، وأنك وافقت على الالتزام بها. ');
                break;
            case 'titleterms1':
                $result=array("En" => 'Copyright and ownership ',"Ar" => 'حقوق التأليف والنشر والملكية الفكرية ');
                break;
            case 'paragraphterms1':$result=array("En" => 'All of the content featured, displayed or offered for sale on the website, including, but not limited to, text, graphics, photographs, images, moving images, sound, illustrations, software and any other content (collectively, the “Content”), is owned by Dar Al-Manhal, its licensors, vendors and/or its content providers. All elements of the website, including but not limited to the general design and the content, are protected by trade dress, copyright, moral rights, trademark and other laws relating to intellectual property rights. You may not modify any of the materials and you may not copy, distribute, transmit, display, perform, reproduce, publish, license, create derivative works from, transfer or sell any information or work contained on the website. Except as permitted under applicable copyright laws, you are responsible for obtaining permission before re-using any copyrighted material that is available on the website. For purposes of these terms, the use of any such material on any other website or networked computer environment is prohibited. You shall comply with all applicable domestic and international laws, statutes, ordinances and regulations regarding your use of the website. The website, the content and all related rights shall remain the exclusive property of Dar Al-Manhal Publishers unless otherwise expressly agreed in writing. You will not remove any copyright, trademark or other proprietary notices from material found on this website. ',"Ar" => 'جميع المحتوى المعروض علناً أو المعروض للبيع على الموقع، بما في ذلك، على سبيل الذكر لا الحصر، النصوص، والرسومات، والصور، والصور المتحركة، والصوت، والرسوم التوضيحية، والبرمجيات وأي محتوى آخر (إجمالاً، "المحتوى") هو مملوك من قبل دار المنهل وهم المرخصين له، والبائعين و / أو مقدمي محتواه. جميع عناصر الموقع، على سبيل الذكر لا الحصر، من التصميم العام والمحتوى، محمية من خلال المظهر التجاري وحقوق المؤلف والحقوق الأخلاقية والعلامات التجارية وغيرها من القوانين المتعلقة بحقوق الملكية الفكرية. لا يجوز تعديل أي من المواد ولا يجوز نسخ أو توزيع أو نقل أو عرض أو تنفيذ أو إعادة إنتاج أو نشر أو ترخيص أو إنشاء عمل مشتق أو نقل أو بيع أية معلومات أو العمل المحتوى في هذا الموقع. باستثناء ما هو مسموح به بموجب قوانين حقوق النشر المعمول بها. انت مسؤول تجاه الحصول على إذن قبل استخدام أي مواد حقوق طبع ونشر متوفرة على الموقع. بناءً على هذه الشروط، يحظر استخدام أي من هذه المواد على أي موقع إلكتروني آخر أو أي شبكة حاسوبية. يجب عليك الامتثال لجميع القوانين والأنظمة والتشريعات واللوائح المحلية والدولية المعمول بها فيما يتعلق باستخدامك لهذا الموقع. يجب أن يبقى هذا الموقع، ومحتواه وجميع الحقوق المتعلقة ملكية حصرية لدار المنهل ناشرون ناشرون ما لم يتم الاتفاق على خلاف ذلك صراحةً وخطياً. لا يجوز ان تزيل حقوق التأليف والنشر والعلامات التجارية أو غيرها من إشعارات الملكية من المواد المنشورة على هذا الموقع. ');
                break;
            case 'titleterms2':
                $result=array("En" => 'Site access license ',"Ar" => 'ترخيص دخول الموقع ');
                break;
            case 'paragraphterms2':$result=array("En" => 'Dar Al-Manhal grants you a limited, revocable, non-exclusive, non-transferable license to access and make personal, noncommercial use of the website or its content and not to download (other than page caching or unless otherwise allowed by Dar Al-Manhal or permitted by law) or modify all or any portion of the website and its content. This license does not include any re-sale or commercial use of the website and its content; any collection and use of any product listings, descriptions, or prices; any derivative use of the website and its content; any downloading or copying of account information for the benefit of another merchant; or any use of data mining, robots, or similar data gathering and extraction tools. The website and/or any portion of the website or its content may not be reproduced, duplicated, copied, sold, resold, visited or otherwise exploited for any commercial purpose without Dar Al-Manhal’s express prior written consent. You shall not frame or utilize framing techniques to enclose any trademark, logo or other proprietary information (including images, text, page layout or form) of Dar Al-Manhal, its content providers or its affiliates without express prior written consent. You shall not use any meta tags or any other “hidden text” utilizing our name or trademarks without our express prior written consent. Additionally, you agree that you will not: (i) take any action that imposes, or may impose in our sole discretion an unreasonable or disproportionately large load on our infrastructure; (ii) interfere or attempt to interfere with the proper working of the website or any activities conducted on the website; or (iii) bypass any measures we may use to prevent or restrict access to the website. Any unauthorized use automatically terminates the permissions and/or licenses granted by us to you. ',"Ar" => 'تمنحك دار المنهل ترخيصا محدوداً رجعياً غير حصرياً وغير قابل للتحويل لدخول الموقع الالكتروني أو محتواه للاستخدام الشخصي وغير التجاري على أن لا يتم تحميل (عدا صفحة التخزين المؤقت إلا إذا سمح بذلك من قبل دار المنهل أو من قبل القانون) أو تعديل كل أو أي جزء من الموقع ومحتواه. لا يتضمن هذا الترخيص أي إعادة بيع أو استخدام تجاري للموقع ومحتواه، وأي أخذ واستخدام لأي قوائم للمنتجات، أو أوصاف، أو أسعار، وأي استخدام مشتق من الموقع ومحتواه، وأي تحميل أو نسخ لمعلومات الحساب لصالح تاجر آخر، أو أي استخدام من قبل التنقيب في البيانات، والروبوتات، أو أي أدوات جمع واستخراج بيانات مماثلة. لا يجوز ان يتم إعادة إنتاج أو تكرار أو نسخ بيع أو إعادة بيع الموقع الالكتروني و / أو أي جزء من هذا الموقع الالكتروني أو محتواه، أو خلاف ذلك، استغلاله لأي غرض تجاري دون الحصول على موافقة خطية مسبقة من دار المنهل . لا يجوز التحايل أو استخدام تقنيات التحايل لتضمين أي علامة تجارية أو شعار أو غيرها من المعلومات السرية (بما في ذلك الصور والنصوص وتخطيط الصفحة أو النموذج) من دار المنهل ، أو مقدمي محتوى موقعها أو الشركات التابعة لها دون الحصول على موافقة خطية مسبقة. لا يجوز استخدام أي من الرموز التشفيرية أو أي "نص مخفي" يستخدم اسمنا أو علاماتنا التجارية دون الحصول على موافقتنا الخطية المسبقة. بالإضافة إلى ذلك، فإنك توافق على أنك لن: (1) تتخذ أي إجراء يفرض، أو قد يفرض في تقديرناعبئا غير معقول أو كبير على بنيتنا التحتية. (2) تتدخل أو تحاول التدخل في سير عمل الموقع أو أي أنشطة أجريت على الموقع، أو (3) تتجاوز أية تدابير قد نستخدمها لمنع أو تقييد الوصول إلى الموقع. أي استخدام غير مصرح به ينهي تلقائيا الأذونات و / أو التراخيص التي منحت لك من قبلنا. ');
                break;
            case 'titleterms3':
                $result=array("En" => 'Corporate identification & trademarks ',"Ar" => 'تحديد الشركات والعلامات التجارية ');
                break;
            case 'paragraphterms3':$result=array("En" => 'All of our trademarks, service marks and trade names used herein (including but not limited to the corporate names and logos of Dar Al-Manhal and its publishing divisions and imprints, names and designs of the website, and any logos) are trademarks or registered trademarks ofDar Al-Manhal or its affiliates and partners. You may not use, copy, reproduce, republish, upload, post, transmit, distribute, or modify such trademarks in any way, including in advertising or publicity pertaining to distribution of materials on the website, without Dar Al-Manhal’s express prior written consent. The use of our trademarks on any other website or network computer environment is not allowed. You are granted a limited, revocable, non-exclusive, non-transferable right to create a link to any page of the website so long as the link does not portray us, our content providers, our licensors, our affiliates, or our products or services in a false, misleading, derogatory or otherwise offensive manner. You may not use any Dar Al-Manhal logo or other proprietary graphic or trademark as part of the link without express written permission. Except as expressly stated herein, no rights or licenses are granted hereunder. ',"Ar" => 'جميع علاماتنا التجارية وعلامات خدمتنا وأسماؤنا التجارية المستخدمة هنا (على سبيل الذكر لا الحصر أسماء الشركات وشعارات دار المنهل ودور النشر التابعه لها ومعلومات الناشر والأسماء وتصاميم الموقع وأي شعارات) أو علامات مسجلة هي علامات تجارية لدار المنهل أو الشركات التابعة لها وشركائها. لا يجوز لك استخدام أو نسخ أو إعادة إنتاج أو نشر أو تحميل أو نشر أو نقل أو توزيع أو تعديل هذه العلامات التجارية بأي شكل من الأشكال، بما في ذلك الإعلان أو الدعاية الذي يخص توزيع المواد على الموقع، من دون الحصول على موافقة خطية مسبقة من دار المنهل . لا يجوز استخدام علاماتنا التجارية في أي موقع آخر أو أي شبكة حاسوبية. تمنحك دار المنهل حقاً محدوداً رجعياً غير حصرياً وغير قابل للتحويل لإنشاء رابط لأي صفحة من صفحات الموقع طالما أن الرابط لا يمثلنا، أو يمثل موفري المحتوى لدينا، أو المرخصين لدينا، أو الشركات التابعة لنا، أو منتجاتنا أو خدماتنا بطريقة خاطئة أو مضللة، أو مهينة، أو مسيئة. لا يجوز لك استخدام أي شعار كجزء من الرابط أو غيره من رسم يعود لملكية أو العلامة التجارية لدار المنهل دون الحصول على إذن خطي. باستثناء ما هو منصوص عليه صراحة في هذه الوثيقة، ويمنح أي حقوق أو تراخيص أدناه. ');
                break;
            case 'titleterms4':
                $result=array("En" => 'Links to third parties & no endorsement ',"Ar" => 'الروابط للمواقع الاخرى ');break;
            case 'paragraphterms4':
                $result=array("En" => 'The website contains links to other websites controlled by third parties. These links are provided solely as a convenience to you and do not imply endorsement by Dar Al-Manhal of, or any affiliation with, or endorsement by, the owner of the linked website. Dar Al-Manhal is not responsible for the contents or use of any linked website, or any consequence of making the link. The websites may also include a tool that allows you to sign in or register using information from your account with a third party service (e.g., Facebook, Twitter). These third party services are unrelated to the websites, and your use of such third party services is subject to the terms and policies of those services. You shall not use Dar Al-Manhal’s name or any language, pictures or symbols which could, in Dar Al-Manhal’s judgment, imply Dar Al-Manhal’s endorsement in any (i) written or oral advertising or presentation, or (ii) brochure, newsletter, book, or other written material of whatever nature, without prior written consent. ',"Ar" => 'يحتوي الموقع الالكتروني على روابط لمواقع أخرى يسيطر عليها من قبل أطراف ثالثة. يتم توفير هذه الروابط فقط لتلائم احتياجاتك ولا تعني تأييد لها أو وجود شراكة بينها وبين دار المنهل ، أو وجود تأييد من قبل صاحب الموقع الالكتروني المرتبط. دار المنهل ليست مسؤولة عن محتويات أو استخدام أي موقع الكتروني مرتبط، أو أي نتيجة لوجود الارتباط. ممكن أن تشمل المواقع أيضا أداة تسمح لك بتسجيل الدخول أو التسجيل باستخدام معلومات من حسابك بخدمة طرف ثالث (مثل، الفيسبوك أوالتويتر). لا علاقة هذه المواقع بخدمات الطرف ثالث هذه، واستخدامك لخدمات الطرف الثالث هذه يخضع لشروط وسياسات تلك الخدمات. لا يجوز لك استخدام اسم دار المنهل أو أي لغة أو صورة أو رمز الذي من الممكن، في حكم دار المنهل ، أن يعني تأييد دار المنهل وذلك في أي (1) إعلان مكتوب أو محكي أو في أي عرض، أو في أي (ب) كتيب، نشرة إخبارية، كتاب، أو غيرها من المواد المكتوبة مهما كانت طبيعتها، دون الحصول على موافقة خطية مسبقة. ');
                break;
            case 'titleterms5':
                $result=array("En" => 'Fees',"Ar" => 'الرسوم');
                break;
            case 'paragraphterms5':
                $result=array("En" => 'For all charges for any products and services sold on the website, Dar Al-Manhal or its vendors or agents will bill your credit card or an alternative payment method. When you provide credit card information to us or our vendors, you represent to us that you are the authorized user of the credit card that is used to pay for the products and services. In the event legal action is necessary to collect on balances due, you agree to reimburse Dar Al-Manhal and its vendors or agents for all expenses incurred to recover sums due, including attorney’s fees and other legal expenses. You are responsible for purchase of, and payment of charges for, all Internet access services and telecommunications services needed for use of the websites. ',"Ar" => 'ستدرج دار المنهل أو البائعين لديها أو وكلائها أي أثمان لأي من المنتجات والخدمات التي تباع على الموقع الالكتروني في بطاقة إئتمانك أو بأي طريقة دفع بديلة. عند تقديم معلومات بطاقة ائتمانك لنا أو للبائعين لدينا، فإنك تقر لنا أنك مخول باستخدام بطاقة الائتمان المستخدمة لدفع ثمن المنتجات والخدمات. في حال كان من الضروري الحصول على الرصيد المستحق بسبب الإجراءات القانونية، فإنك توافق على أن تسدد دار المنهل والبائعين لديها، أو وكلائها جميع النفقات المتكبدة لاسترداد المبالغ المستحقة، بما في ذلك أتعاب المحاماة والمصاريف القانونية الأخرى. أنت مسؤول عن شراء، ودفع رسوم، جميع خدمات الإنترنت وخدمات الاتصالات اللازمة لاستخدام المواقع الالكترونية. ');
                break;
            case 'titleterms6':
                $result=array("En" => 'Privacy Policy ',"Ar" => 'سياسة الخصوصية ');
                break;
            case 'paragraphterms6':
                $result=array("En" => 'Data collection and use, including data collection and use of personal information is governed by Dar Al-Manhal’s Privacy Policy which is incorporated into and is a part of this agreement. ',"Ar" => 'يخضع جمع البيانات واستخدامها، بما في ذلك جمع البيانات واستخدام المعلومات الشخصية، لسياسة خصوصية دار المنهل والتي تم تضمينها في هذا الاتفاق والتي تشكل جزءا منه. ');
                break;
            case 'profile':
                $result=array("En" => 'My Profile',"Ar" => 'الملف الشخصي');
                break;
            case 'sign_out':
                $result=array("En" => 'Sign Out',"Ar" => 'تسجيل الخروج');
                break;
                case 'Informations':
                $result=array("En" => 'Informations',"Ar" => 'المعلومات');
                break;
                case 'Title':
                $result=array("En" => 'Title',"Ar" => 'العنوان');
                break;
                case 'Type':
                $result=array("En" => 'Type',"Ar" => 'النوع');
                break;
                case 'Extension':
                $result=array("En" => 'Extension',"Ar" => 'الإمتداد');
                break;
                case 'Description':
                $result=array("En" => 'Description',"Ar" => 'الوصف');
                break;
            case 'msgjavascript':
                $result = array(
                    "En" => ["deleteFile" => ["Title" => "Alert Delete File", "Des" => "Are you sure you want to delete this File?"]
                        , "DeleteContract" => ["Title" => "Alert Delete Contract", "Des" => "Are you sure you want to delete this Contract?"]
                        , "update" => ["Title" => "success", "Des" => "The update was successful"]
                        , "error" => ["Title" => "error", "Des" => "The update don't was successful"]
                        , "DeleteCategory" => ["Title" => "Alert Delete Category", "Des" => "Are you sure you want to delete this Category?"],
                        "ClearAll" => ["Title" => "ClearAll", "Des" => ""]
                    ],
                    "Ar" => ["deleteFile" => ["Title" => "حذف ملف ", "Des" => "هل أنت متأكد أنك تريد حذف هذا الملف؟"]

                        , "DeleteContract" => ["Title" => "Alert Delete Contract", "Des" => "Are you sure you want to delete this Contract?"]
                        , "update" => ["Title" => "نجاح", "Des" => "تم التحديث بنجاح"]
                        , "error" => ["Title" => "خطأ", "Des" => "لم يتم التحديث"]
                        , "DeleteCategory" => ["Title" => "حذف التصنيف", "Des" => "هل أنت متأكد أنك تريد حذف هذا التصنيف؟"]
                        ,"ClearAll" => ["Title" => "حذف الكل ", "Des" => ""]

                    ]

                );
                return json_encode($result[$_SESSION["lang"]]);
                break;
        }

        return str_replace('"', "", json_encode($result[$_SESSION["lang"]], JSON_UNESCAPED_UNICODE));
    }

    public function Sessionlang()
    {
        $session_lang = $_SESSION["lang"];
        return strtolower($session_lang);
    }
}

class Pr_fun extends medialibrary
{
    use language;
    private static $classObj = NULL;

    public function __construct()
    {
        $this->Page=0;
        parent::__construct();
    }

    public static function getObj()
    {
        if (!self::$classObj)
            self::$classObj = new self();

        return self::$classObj;
    }

    public function Data_Type()
    {
        $DataTypes = json_decode($this->Types(), true);
        $this->Types_st = '';
        for ($i = 0; $i < count($DataTypes['data']); $i++) {
            $this->Types_st .= '<li><a att="' . $DataTypes['data'][$i]['id'] . '" href="javascript:calltype()">' . $DataTypes['data'][$i]['name_' . strtolower($_SESSION["lang"])] . '</a></li>';
        }
        return $this->Types_st;
    }

    public function UserName()
    {
        return $_SESSION['username'];
    }

    private function DrowMedia($Path,$extension,$MediaType,$MediaId,$MediaTitel,$MediaThumb,$MediaDescraption,$Categories,$types,$path){


        $data='';
        $typeclass='';
        $data='';
        switch($MediaType){
            case '1':
                //sound
                $data.='<div att="'.$MediaId.'" title_ar="'.$MediaTitel.'"  descraption="'.$MediaDescraption.'" category="'.$Categories.'" types="'.$types.'" path="'.$path.'" extension="'.$extension.'"    class="item-container col-lg-12 col-md-12 col-sm-12 col-xs-12" title='.$MediaTitel.'>';
                $data.='<a>';
                $data.='<div class="audio-player jq_player">';
                $data.='<div id="play-btn" class="play-button"></div>';
                $data.='<div class="audio-wrapper" id="player-container" href="javascript:;">';
                $data.='<audio id="player" ontimeupdate="initProgressBar(this)">';
                $data.='<source src="'.$Path.'" type="audio/'.$extension.'">';
                $data.='</audio>';
                $data.='</div>';
                $data.='<div class="player-controls scrubber">';
                $data.='<span id="seekObjContainer">';
                $data.=' <progress id="seekObj" class="seekObj" value="0" max="1" style=""></progress>';
                $data.='</span><br>';
                $data.='<small style="float: left; position: relative; left: 15px;color: #00ad68;" class="start-time"></small>';
                $data.='<small style="float: right; position: relative; right: 20px;color: #00ad68;" class="end-time"></small>';
                $data.='</div>';
                $data.='<div class="album-image"><div class="numbers pull-right"><i>'.$MediaId.'</i></div><p class="title pull-right"> '.$MediaTitel.'</p></div>';
                $data.='</div>';
                break;
            case '2':
                // image
                $data.='<div att="'.$MediaId.'" class="item-container" title_ar="'.$MediaTitel.'"  descraption="'.$MediaDescraption.'" category="'.$Categories.'" types="'.$types.'"  path="'.$path.'" extension="'.$extension.'">';
                $data.='<a href="'.$Path.'" data-fancybox="gallery" class="fancybox-media" data-caption='.$MediaTitel.'>';
                $data.='<div class="mediatitle"> '.$MediaTitel.'</div>';
                $data.='<img src="'.$MediaThumb.'" class="single-image">';
                break;
            case '4':
                // video
                $data.='<div att="'.$MediaId.'" class="item-container" title_ar="'.$MediaTitel.'"  descraption="'.$MediaDescraption.'" category="'.$Categories.'" types="'.$types.'"  path="'.$path.'" extension="'.$extension.'">';
                $data.='<a href="'.$Path.'" data-fancybox="gallery" class="fancybox-media" data-caption='.$MediaTitel.'>';
                $data.='<div class="typeandtime"><i class="lnr lnr-camera-video pull-left"></i><span class="pull-left"></span></div>';
                $data.='<div class="mediatitle-video">'.$MediaTitel.'</div>';
                $data.='<video data-play="hover" muted="muted" class="video-time" id="attr'.$MediaId.'"><source src="'.$Path.'" type="video/'.$extension.'"></video>';
                break;
            case '5':
                // document
                $data.='';
                break;
        }
            $data.='<div class="hover-menu">';
        if($this->CanEdit()=='true'){
            $data.='<a href="editmedia.php" class="anchor-container edit"><i class="lnr lnr-pencil"></i></a>';
            $data.='<a class="anchor-container delete"><i class="lnr lnr-trash"></i></a>';
        }
            $data.='<a class="anchor-container information"><i class="lnr lnr-question-circle"></i></a>';
            $data.='<a href="'.$Path.'"  target="_blank" class="anchor-container download" title="download" download><i class="lnr lnr-download"></i></a>';
            $data.='</div></a></div>';

        return $data;
    }

    public function GetMedia(){




        $DataTypes = json_decode($this->Media($this->GetIdType(),$this->GetIdCategory(),$this->GetKeywords(), $this->GetID(), $this->GetLan(), $this->GetPage(),$this->GetColor()), true);
        $String = '';
        $String = '<div class="gallery  type'.$this->GetIdType().'">';


        $this->Page=0;
        if($DataTypes['result']==1){
            $this->Page=$DataTypes['number'];
        }

        $String = '<div class="gallery  type'.$this->GetIdType().'">';
        for ($i = 0; $i < count($DataTypes['data']); $i++) {
            $String .= $this->DrowMedia($DataTypes['data'][$i]['Path'],$DataTypes['data'][$i]['extension'],$DataTypes['data'][$i]['MediaType'],$DataTypes['data'][$i]['MediaId'],$DataTypes['data'][$i]['MediaTitel_'. strtolower($_SESSION["lang"])],$DataTypes['data'][$i]['MediaThumb'],$DataTypes['data'][$i]['MediaDescraption_'. strtolower($_SESSION["lang"])],$DataTypes['data'][$i]['Categories_'. strtolower($_SESSION["lang"])],$DataTypes['data'][$i]['Type_'. strtolower($_SESSION["lang"])],$DataTypes['data'][$i]['Path'],$DataTypes['data'][$i]['extension']);
        }
        $String .='</div>';
        return $String;

    }
    public function DataSearch_Type()
    {
        $DataTypes = json_decode($this->Types(), true);
        $this->Types_st = '';
        for ($i = 0; $i < count($DataTypes['data']); $i++) {
            $selected='';
            if($DataTypes['data'][$i]['id'] ==$this->GetIdType()){
                $selected='selected';
            }
            $this->Types_st .= '<option '.$selected.'    att="' . $DataTypes['data'][$i]['id'] . '">' . $DataTypes['data'][$i]['name_' . strtolower($_SESSION["lang"])] . '</option>';
        }
        return $this->Types_st;
    }


    public function Pagination()
    {

        $data = '';
        if ($this->Page > 1) {

             if($this->GetPages() >0){
                 $data = '<li class="page-item"><a href="javascript:GotoPage('  . ($this->GetPages()) . ','.$this->Page. ','.($this->GetPages() - $this->pagination). ');" class="page-link" aria-label="Previous"><span aria-hidden="true">«</span><span class="sr-only">' . $this->lang('Previous') . '</span></a></li>';
             }
            for ($i = $this->GetPages(); $i < $this->Page && $i<$this->GetPages()+$this->pagination; $i++) {
                 $selected='';

                 if($this->GetPage()==$i){
                     $selected='active';
                 }
                $data .= '<li class="page-item '.$selected.'"><a href="javascript:GotoPage(' . $i . ','.($this->Page). ','.$this->GetPages(). ');" class="page-link">' . ($i + 1) . '</a></li>';
            }
            if((int)$this->GetPages()+$this->pagination <(int)$this->Page){
                $data .= '<li class="page-item"><a href="javascript:GotoPage(' . $i . ','.$this->Page. ','.($this->GetPages() + $this->pagination).');" class="page-link" aria-label="Next"><span aria-hidden="true">»</span><span class="sr-only">' . $this->lang('Next') . '</span></a></li>';
            }
        }
        return $data;
    }
    public function GetCatFilterDrow(){

        return $this->DataFilter;


    }
    public function DataCategories()
    {

        $DataTypes = json_decode($this->Category(''), true);
        $this->Types_st = '';
        $data_filter =[];
        if($this->GetIdCategory()!='all'){
            $data_filter=explode(",",$this->GetIdCategory());
        }
        $this->DataFilter='';
        for ($i = 0; $i < count($DataTypes['data']); $i++) {
            $selected='';
            if($this->GetIdCategory()=='all'){
                $selected='checked';
                $this->DataFilter.='<a  class="nav-link"><span>' . $DataTypes['data'][$i]['name_' . strtolower($_SESSION["lang"])] .'</span><i  att="' .$DataTypes['data'][$i]['id'].'" filtertype="categories" onclick="ClearFilter(this)" class="lnr lnr-cross"></i></a>';
            }else{
                for ($j = 0; $j < count($data_filter); $j++) {
                    if ($DataTypes['data'][$i]['id']==$data_filter[$j]) {
                        $selected='checked';
                        $this->DataFilter.='<a  class="nav-link"><span>' . $DataTypes['data'][$i]['name_' . strtolower($_SESSION["lang"])] .'</span><i att="' .$DataTypes['data'][$i]['id'].'" filtertype="categories" onclick="ClearFilter(this)" class="lnr lnr-cross"></i></a>';
                    }
                }
            }
            $this->Types_st .= '<li class="los"><label class="fancy-checkbox" for="Level'.$DataTypes['data'][$i]['id'].'"><input att="'.$DataTypes['data'][$i]['id'].'"  '.$selected.' type="checkbox" id="Level'.$DataTypes['data'][$i]['id'].'"><span>'.$DataTypes['data'][$i]['name_' . strtolower($_SESSION["lang"])].'</span></label></li>';
        }

        if($this->GetColor()!=''){
            $this->DataFilter.='<a  class="nav-link"><span>' . $this->GetColor() .'</span><i att="' .$this->GetColor().'" filtertype="categories" onclick="ClearColor()" class="lnr lnr-cross"></i></a>';
        }
        if (count($data_filter) > 1 || $this->GetIdCategory()=='all') {
            $this->DataFilter.= '<a  onclick="ClearAllFilter()" class="nav-link clear-all">' . $this->lang('ClearAll') . '</a>';
        }

        return $this->Types_st;
    }
    public function GetPage()
    {


        $page = 0;
        if (isset($_GET["page"]) && $_GET["page"] != "") {
            $page = $_GET["page"];
        }
        if($page<0){
            $page = 0;
        }
        if($page>$this->Page*$this->PerPage){
           // $page=$this->Page*$this->pagination;
        }

        return $page;
    }
    public function GetPages()
    {
        $page = 0;
        if (isset($_GET["pages"]) && $_GET["pages"] != "") {
            $page = $_GET["pages"];
        }

        if($page>$this->Page){
            $page=$this->Page;
        }
        if($page<0){
            $page = 0;
        }
        return $page;
    }
    public function GetIdCategory()
    {
        $cat = '';
        if (isset($_GET["filter_cat"]) && $_GET["filter_cat"] != "") {
            $cat = $_GET["filter_cat"];
        }
        return $cat;
    }
    public function GetColor()
    {
        $color = '';
        if (isset($_GET["filter_color"]) && $_GET["filter_color"] != "") {
            $color = $_GET["filter_color"];
        }
        return $color;
    }



    public function GetIdType()
    {
        $type = 1;
        if (isset($_GET["filter_type"]) && $_GET["filter_type"] != "") {
            $type = $_GET["filter_type"];
        }
        return $type;
    }
    public function GetID()
    {
        $Id = '';
        if (isset($_GET["id"]) && $_GET["id"] != "") {
            $Id = $_GET["id"];
        }
        return $Id;
    }
    public function GetLan()
    {
        $Lan = '';
        if (isset($_GET["filter_lan"]) && $_GET["filter_lan"] != "") {

            if($_GET["filter_lan"]=='ar'){
                $Lan  =0;
            }else if($_GET["filter_lan"]=='en'){
                $Lan  =1;
            }
        }
        return $Lan;
    }

    public function GetKeywords()
    {
        $keyword = '';
        if (isset($_GET["filter_keyword"]) && $_GET["filter_keyword"] != "") {
            $keyword = $_GET["filter_keyword"];
        }
        return $keyword;
    }
    public function GetOpenFilter()
    {
        $filter_open = 'active';
        if (isset($_GET["filter_open"]) && $_GET["filter_open"] != "") {
            $filter_open = $_GET["filter_open"];
        }
        return $filter_open;
    }


}

$prosses = Pr_fun::getObj();

?>


