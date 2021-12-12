var storyArray = [{desc: []}]


storyArrayTmp = [{}]




function CurrentStory() {


    storyArray.length = 0;
    console.log(storyArrayTmp[0])

    storyArray = storyArrayTmp.slice();
    localStorage['selectStory'] = storyArray[0].index
    localStorage['applicationPath'] = applicationPath
    localStorage['folderName'] = storyArray[0].desc.folderName
    localStorage['pageRangeFirst'] = storyArray[0].desc.pageRange.first
    localStorage['pageRangeEnd'] = storyArray[0].desc.pageRange.end
    StoryPages.length = 0;


    if (localStorage['readMode'] == 'nightRead') {

        $.getScript(applicationPath + storyArray[0].desc.folderName + "/js/data.js")
            .done(function (script, textStatus) {


                night_mode()
            })
            .fail(function (jqxhr, settings, exception) {
                $("div.log").text("Triggered ajaxError handler.");
            });
    } else {

        $.getScript(applicationPath + storyArray[0].desc.folderName + "/js/data.js")
            .done(function (script, textStatus) {

                $('.close-card').click()
                $('#close-btnSeries').click()

                startStory()
            })
            .fail(function (jqxhr, settings, exception) {
                $("div.log").text("Triggered ajaxError handler.");
            });
    }


    return storyArray[0].desc

}


arrayStoryDesc = [
    {
        charge: "free",
        folderName: "st1",
        storyName: "مَوْسِمِ الْحَصادِ",
        storyType: "الذكاء الجسديِ",
        gamesPath: {
            game1: {
                folderName: "filling",
                name: "لوّن معنا",

            },
            game2: {
                folderName: "sort",
                name: "رتب القصه",
            },
            game3: {
                folderName: "puzzle",
                name: "تركيب الصورة",
            },
        },


        Parent: {
            text: [{text: "الذكاء الجسدي", type: "Title"},
                {
                    text: "هذه السّلسلةُ من الكتبِ المُصوّرةِ تعرضُ حكاياتٍ عن الأرنبِ رنوش تمكِّنك وطفلَك من مشاركةِ متعةِ النُّموِّ معهُ، حيث تَعرضُ عِدَّةَ جوانبَ للمعرفةِ، وما عليكَ إلاّ أن تدعَ طفلكَ يستمتعُ ويحسِّنُ قدراتِهِ من خلالِها.",
                    type: "p"
                },
                {
                    text: "الذكاءُ هو ما يضبطُ حياةَ الفردِ، ومقدرتَهُ على حلِّ المشكلاتِ أو ابتكارِ أشياءَ جديدةٍ. ولدى كلِّ فردٍ ذكاءاتٌ متعدِّدةٌ ذاتُ تركيبةٍ فريدةٍ ومتميِّزةٍ. يحتاجُ الطِّفلُ إلى اهتمامٍ خاصٍّ لتنميةِ قدراتِهِ الطَّبيعيةِ وذكاءاتِهِ المتعدِّدةِ لينموَ نموَّاً متوازناً.",
                    type: "p"
                },
                {
                    text: "الذَّكاءُ الْجَسَدِيُّ: يَعْني القدرةَ على التّعبيرِ عن الأفكارِ والمشاعرِ من خلالِ حركاتِ الجسمِ وصُنْعِ أشياءَ جديدةٍ. ويضمُّ هذا النَّوعُ من الذَّكاءِ مهاراتٍ كالتَّوازنِ والتَّعاونِ والقوةِ والمرونةِ والسّرعةِ، والتّنسيقِ بينَ حركةِ اليدِ والعينِ والتَّفكيرِ، وَتُنَشِّطُ الجسمَ والعقلَ معاً، ويتمّ تدريبُ الطِّفلِ عليها تحت إشرافٍ مناسبٍ.",
                    type: "p"
                },
                {text: "هَلْ يُحبُّ طفلُكَ المشاركةَ في النّشاطاتِ الرّياضيَّةِ؟ هل لديْهِ توازنٌ جيِّدٌ؟", type: "p"},
                {
                    text: "أعزائي المربِّيين، عليكم تَنْمِيَةُ قدراتِ أطفالِكم، فَهُم عُلماءُ الْمُسْتَقْبَلِ.",
                    type: "p"
                }],
            sound: "02.mp3"
        },
        pageRange: {
            first: 3,
            end: 11
        },
        titleSound: "01.mp3",
        lock: false,
        downloading: false

    },


    //******st2******************************
    {
        charge: "free",
        folderName: "st2",
        storyName: "منزل قوس قزح",
        storyType: "الذكاء المكانيِ",

        gamesPath: {
            game1: {
                folderName: "filling",
                name: "لوّن معنا",
            },
            game2: {
                folderName: "sort",
                name: "املا الفراغ",
            },
            game3: {
                folderName: "puzzle",
                name: "تركيب الصورة",
            },
        },


        Parent: {
            text: [{text: "الذَّكاءُ المكاني", type: "Title"},
                {
                    text: "هذه السّلسلةُ من الكتبِ المُصوّرةِ تعرضُ حكاياتٍ عن الأرنبِ رنوش تمكِّنك وطفلَك من مشاركةِ متعةِ النُّموِّ معهُ، حيث تَعرضُ عِدَّةَ جوانبَ للمعرفةِ، وما عليكَ إلاّ أن تدعَ طفلكَ يستمتعُ ويحسِّنُ قدراتِهِ من خلالِها.",
                    type: "p"
                },
                {
                    text: "الذكاءُ هو ما يضبطُ حياةَ الفردِ، ومقدرتَهُ على حلِّ المشكلاتِ أو ابتكارِ أشياءَ جديدةٍ. ولدى كلِّ فردٍ ذكاءاتٌ متعدِّدةٌ ذاتُ تركيبةٍ فريدةٍ ومتميِّزةٍ. يحتاجُ الطِّفلُ إلى اهتمامٍ خاصٍّ لتنميةِ قدراتِهِ الطَّبيعيةِ وذكاءاتِهِ المتعدِّدةِ لينموَ نموَّاً متوازناً.",
                    type: "p"
                },
                {
                    text: "الذَّكاءُ الْمَكانِيُّ: يعني القدرةَ عَلى التقييمِ الصّحيحِ لخصائصِ الأشياءِ واسْتخدامِها. ويَتضمَّنُ تمييزَ الألوانِ والخُطوطِ والأشكالِ والأحجامِ وعلاقاتِها ببعضِها.",
                    type: "p"
                },
                {text: "هل لدى طفلِكَ ميولٌ تجاه الألوانِ والأشكالِ؟", type: "p"},
                {text: "هل يعرفُ طفلُكَ كيفَ يمزِجُ الألوانَ؟ ", type: "p"},
                {
                    text: "أعزائي المربِّيين، عليكم تَنْمِيَةُ قدراتِ أطفالِكم، فَهُم عُلماءُ الْمُسْتَقْبَلِ.",
                    type: "p"
                }],
            sound: "02.mp3"
        },
        pageRange: {
            first: 1,
            end: 15
        },
        titleSound: "01.mp3",
        lock: false,
        downloading: false

    },
    //******st3******************************
    {
        charge: "charge",
        folderName: "st3",
        storyType: "الذكاء العاطفيِ",

        storyName: "المنزل العجيب",
        gamesPath: {
            game1: {
                folderName: "filling",
                name: "لوّن معنا",
            },
            game2: {
                folderName: "sort",
                name: "املا الفراغ",
            },
            game3: {
                folderName: "puzzle",
                name: "تركيب الصورة",
            },
        },


        Parent: {
            text: [{text: "الذَّكاءُ العاطفي", type: "Title"},
                {
                    text: "هذه السّلسلةُ من الكتبِ المُصوّرةِ تعرضُ حكاياتٍ عن الأرنبِ رنوش تمكِّنك وطفلَك من مشاركةِ متعةِ النُّموِّ معهُ، حيث تَعرضُ عِدَّةَ جوانبَ للمعرفةِ، وما عليكَ إلاّ أن تدعَ طفلكَ يستمتعُ ويحسِّنُ قدراتِهِ من خلالِها.",
                    type: "p"
                },
                {
                    text: "الذكاءُ هو ما يضبطُ حياةَ الفردِ، ومقدرتَهُ على حلِّ المشكلاتِ أو ابتكارِ أشياءَ جديدةٍ. ولدى كلِّ فردٍ ذكاءاتٌ متعدِّدةٌ ذاتُ تركيبةٍ فريدةٍ ومتميِّزةٍ. يحتاجُ الطِّفلُ إلى اهتمامٍ خاصٍّ لتنميةِ قدراتِهِ الطَّبيعيةِ وذكاءاتِهِ المتعدِّدةِ لينموَ نموَّاً متوازناً.",
                    type: "p"
                },
                {
                    text: "الذَّكاءُ العاطفيُّ: يعني القدرةَ على التَّعاطفِ والتَّفاعلِ مَعَ الآخرينَ، وفهمِ ميولِهِم وانفعالاتِهِم. وهذا يتضمَّنُ تعابيرَ الوجهِ والتَّعابيرَ اللَّفظيَّةَ والتَّصرُّفاتِ، والقدرةَ على فهم إِشاراتِ الآخرينَ والاستجابةِ لَها بالطَّريقةِ المناسبةِ. تُساعدُ مراقبةُ مهاراتِ الطِّفلِ في التَّعاملِ مَعَ الآخرينَ على فهمِ التَّغيُّرِ في عواطفهِ وانفعالاتهِ، والتَّحقُّقِ من استجابتهِ بالشَّكلِ المناسبِ للمحيطينَ مِنْ حولهِ.",
                    type: "p"
                },
                {text: "هل لطفلِكَ صديقٌ؟كيفَ يستجيبُ طفلُكَ للأشخاصِ من حولهِ؟", type: "p"},
                {
                    text: "أعزائي المربِّيين، عليكم تَنْمِيَةُ قدراتِ أطفالِكم، فَهُم عُلماءُ الْمُسْتَقْبَلِ.",
                    type: "p"
                }],
            sound: "02.mp3"
        },
        pageRange: {
            first: 1,
            end: 16
        },
        titleSound: "01.mp3",
        lock: true,
        downloading: false

    },

    //******st4******************************
    {
        charge: "charge",
        folderName: "st4",
        storyName: "المفاجأه السعيده",
        storyType: "الذكاء اللغويِ",

        gamesPath: {
            game1: {
                folderName: "filling",
                name: "لوّن معنا",
            },
            game2: {
                folderName: "sort",
                name: "املا الفراغ",
            },
            game3: {
                folderName: "puzzle",
                name: "تركيب الصورة",
            },
        },


        Parent: {
            text: [{text: "الذَّكاءُ اللُّغوي", type: "Title"},
                {
                    text: "هذه السّلسلةُ من الكتبِ المُصوّرةِ تعرضُ حكاياتٍ عن الأرنبِ رنوش تمكِّنك وطفلَك من مشاركةِ متعةِ النُّموِّ معهُ، حيث تَعرضُ عِدَّةَ جوانبَ للمعرفةِ، وما عليكَ إلاّ أن تدعَ طفلكَ يستمتعُ ويحسِّنُ قدراتِهِ من خلالِها.",
                    type: "p"
                },
                {
                    text: "الذكاءُ هو ما يضبطُ حياةَ الفردِ، ومقدرتَهُ على حلِّ المشكلاتِ أو ابتكارِ أشياءَ جديدةٍ. ولدى كلِّ فردٍ ذكاءاتٌ متعدِّدةٌ ذاتُ تركيبةٍ فريدةٍ ومتميِّزةٍ. يحتاجُ الطِّفلُ إلى اهتمامٍ خاصٍّ لتنميةِ قدراتِهِ الطَّبيعيةِ وذكاءاتِهِ المتعدِّدةِ لينموَ نموَّاً متوازناً.",
                    type: "p"
                },
                {
                    text: "الذّكاءُ اللّغوي: يعني المهارةَ في استخدامِ اللّغةِ والنّصوصِ بفاعليّة، وهذا النّوعُ من الذكاءِ يشملُ فهمَ اللّغةِ والمفرداتِ والتراكيب اللّغوية.",
                    type: "p"
                },
                {
                    text: "اللّغةُ هي أساسُ تعليمِ الطِّفلِ، فهي تمكنّهُ من التّعبيرِ عنْ حاجاتهِ وأحاسيسهِ. إن التَّأخُّرَ اللّغويَّ عندَ الطِّفل يعيقُ تقدّمهُ وتطوُّرَهُ في مجالاتٍ متعدِّدةٍ.",
                    type: "p"
                },
                {text: "هل يستطيعُ طفلُكَ تكوينَ جملٍ بسيطةٍ؟ هَلْ هُوَ متحمِّسٌ لتعلُّمِ الأسماءِ؟", type: "p"},
                {
                    text: "أَعِزَّائي الْمُرَبِّين، عَلَيْكُمْ بِتَنْمِيَةِ الاسْتِعْدادِ اللُّغوي لدى أطفالِكم لِيَكونوا أُدباءَ الْمُسْتَقْبَلِ.",
                    type: "p"
                }],
            sound: "02.mp3"
        }, pageRange: {
        first: 1,
        end: 15
    },
        titleSound: "01.mp3",
        lock: true,
        downloading: false
    },

    //******st5******************************
    {
        charge: "charge",
        folderName: "st5",
        storyName: "مغامرة في النهر",
        storyType: "الذكاء الطبيعيِ",

        gamesPath: {
            game1: {
                folderName: "filling",
                name: "لوّن معنا",
            },
            game2: {
                folderName: "sort",
                name: "املا الفراغ",
            },
            game3: {
                folderName: "puzzle",
                name: "تركيب الصورة",
            },
        },


        Parent: {
            text: [{text: "الذَّكاءُ الطَّبيعي", type: "Title"},
                {
                    text: "هذه السّلسلةُ من الكتبِ المُصوّرةِ تعرضُ حكاياتٍ عن الأرنبِ رنوش تمكِّنك وطفلَك من مشاركةِ متعةِ النُّموِّ معهُ، حيث تَعرضُ عِدَّةَ جوانبَ للمعرفةِ، وما عليكَ إلاّ أن تدعَ طفلكَ يستمتعُ ويحسِّنُ قدراتِهِ من خلالِها.",
                    type: "p"
                },
                {
                    text: "الذكاءُ هو ما يضبطُ حياةَ الفردِ، ومقدرتَهُ على حلِّ المشكلاتِ أو ابتكارِ أشياءَ جديدةٍ. ولدى كلِّ فردٍ ذكاءاتٌ متعدِّدةٌ ذاتُ تركيبةٍ فريدةٍ ومتميِّزةٍ. يحتاجُ الطِّفلُ إلى اهتمامٍ خاصٍّ لتنميةِ قدراتِهِ الطَّبيعيةِ وذكاءاتِهِ المتعدِّدةِ لينموَ نموَّاً متوازناً.",
                    type: "p"
                },
                {
                    text: "الذّكاءُ الطّبيعيّ يعني قدرةَ الفردِ على ملاحظةِ وفهمِ الطّبيعةِ حولَهُ وما يحدثُ فيها من تغيُّراتٍ ليَعيَ أهمِّيتَها في حياتِهِ.",
                    type: "p"
                },
                {
                    text: "الذّكاءُ الطّبيعيّ: يَعني الاهتمامَ بالطَّبيعةِ والظّواهرِ التي تحدثُ على الأرضِ، لهذا لا بُدَّ لِلْمُرَبّينَ من تشجيعِ أطفالِهم على الاستمتاعِ بجمالِ الطَّبيعة، وحثّهم على كيفيّةِ المحافظة عليها.",
                    type: "p"
                },
                {
                    text: "هَلْ يَعْرِفُ أَوْ يُراقِبُ طِفْلُكَ أَسْرابَ النَّملِ؟ هل يحبُّ طفلُك فصلَ الشِّتاءِ أو الرّبيعِ؟",
                    type: "p"
                },
                {
                    text: "أعزائي المربِّيين، عليكم تَنْمِيَةُ قدراتِ أطفالِكم، فَهُم عُلماءُ الْمُسْتَقْبَلِ.",
                    type: "p"
                }],
            sound: "02.mp3"
        }, pageRange: {
        first: 1,
        end: 15
    },
        titleSound: "01.mp3",
        lock: true,
        downloading: false
    },    //******st6******************************
    {
        charge: "charge",
        folderName: "st6",
        storyName: "المرآه السحرية",
        storyType: "الذكاء الذاتيِ",

        gamesPath: {
            game1: {
                folderName: "filling",
                name: "لوّن معنا",
            },
            game2: {
                folderName: "sort",
                name: "املا الفراغ",
            },
            game3: {
                folderName: "puzzle",
                name: "تركيب الصورة",
            },
        },
        pageRange: {
            first: 1,
            end: 15
        },


        Parent: {
            text: [{text: "الذَّكاءُ الذَّاتي", type: "Title"},
                {
                    text: "هذه السّلسلةُ من الكتبِ المُصوّرةِ تعرضُ حكاياتٍ عن الأرنبِ رنوش تمكِّنك وطفلَك من مشاركةِ متعةِ النُّموِّ معهُ، حيث تَعرضُ عِدَّةَ جوانبَ للمعرفةِ، وما عليكَ إلاّ أن تدعَ طفلكَ يستمتعُ ويحسِّنُ قدراتِهِ من خلالِها.",
                    type: "p"
                },
                {
                    text: "الذكاءُ هو ما يضبطُ حياةَ الفردِ، ومقدرتَهُ على حلِّ المشكلاتِ أو ابتكارِ أشياءَ جديدةٍ. ولدى كلِّ فردٍ ذكاءاتٌ متعدِّدةٌ ذاتُ تركيبةٍ فريدةٍ ومتميِّزةٍ. يحتاجُ الطِّفلُ إلى اهتمامٍ خاصٍّ لتنميةِ قدراتِهِ الطَّبيعيةِ وذكاءاتِهِ المتعدِّدةِ لينموَ نموَّاً متوازناً.",
                    type: "p"
                },
                {
                    text: "الذكاءُ الذَّاتِيُّ: يَعْني معرفةُ الفردِ بذاتهِ وتقييمَ معرفتهِ وقدراتهِ الأدائيّةِ، وهو يشملُ القدرةَ على فهمِ واحْترامِ الذّاتِ والمشاعرِ والتّوجُّهاتِ، وتساعدُ البيئةُ المحيطةُ الطّفل على تطويرِ الإدراكِ لديهِ.",
                    type: "p"
                },
                {
                    text: "هل طفلُكَ قادرٌ على ملاحظةِ التّغييراتِ الّتي تطرأُ عليهِ؟ هَلْ هو قادرٌ على التَّحكُّمِ بِمزاجيّتهِ وعواطفِهِ؟",
                    type: "p"
                },
                {
                    text: "أَعِزَّائي الْمُرَبِّين عليكم بِتَنميةِ قُدُراتِ أطفالِكم، فَهُمْ عُلَماءُ المستقبلِ.",
                    type: "p"
                }],
            sound: "02.mp3"
        },
        titleSound: "01.mp3",
        lock: true,
        downloading: false
    },    //******st7******************************
    {
        charge: "charge",
        folderName: "st7",
        storyName: "الطعام اللذيذ",
        storyType: "الذكاء الرياضيِ",

        gamesPath: {
            game1: {
                folderName: "filling",
                name: "لوّن معنا",
            },
            game2: {
                folderName: "sort",
                name: "املا الفراغ",
            },
            game3: {
                folderName: "puzzle",
                name: "تركيب الصورة",
            },
        },
        pageRange: {
            first: 1,
            end: 14
        },


        Parent: {
            text: [{text: "الذَّكاءُ الرِّياضي", type: "Title"},
                {
                    text: "هذه السّلسلةُ من الكتبِ المُصوّرةِ تعرضُ حكاياتٍ عن الأرنبِ رنوش تمكِّنك وطفلَك من مشاركةِ متعةِ النُّموِّ معهُ، حيث تَعرضُ عِدَّةَ جوانبَ للمعرفةِ، وما عليكَ إلاّ أن تدعَ طفلكَ يستمتعُ ويحسِّنُ قدراتِهِ من خلالِها.",
                    type: "p"
                },
                {
                    text: "الذكاءُ هو ما يضبطُ حياةَ الفردِ، ومقدرتَهُ على حلِّ المشكلاتِ أو ابتكارِ أشياءَ جديدةٍ. ولدى كلِّ فردٍ ذكاءاتٌ متعدِّدةٌ ذاتُ تركيبةٍ فريدةٍ ومتميِّزةٍ. يحتاجُ الطِّفلُ إلى اهتمامٍ خاصٍّ لتنميةِ قدراتِهِ الطَّبيعيةِ وذكاءاتِهِ المتعدِّدةِ لينموَ نموَّاً متوازناً.",
                    type: "p"
                },
                {
                    text: "الذّكاءُ الرِّياضي: يعني قدرةَ الفردِ على استخدامِ الأرقامِ والاسْتدلالِ المنطقي إضافةً لاستيعابِ الأساليبِ المنطقيّةِ ونواتِجها. يظهرُ هذا النوعُ من الذكاءِ في استخدامِ الأرقامِ وتقديرِ المساحاتِ وتمييزِ الاتجّاهاتِ، ويتم تنميتُهُ في مرحلةِ الطّفولةِ المبكرّةِ.",
                    type: "p"
                },
                {text: "هل يعرفُ طفلُكَ الأَرْقامَ؟ هل يميّزُ الاتّجاهاتِ؟", type: "p"},
                {
                    text: "أَعِزَّائي الْمُرَبِّين عليكم بِتَنميةِ قُدُراتِ أطفالِكم، فَهُمْ عُلَماءُ المستقبلِ.",
                    type: "p"
                }],
            sound: "02.mp3"
        },
        titleSound: "01.mp3",
        lock: true,
        downloading: false
    },
    //******st8******************************
    {
        charge: "charge",
        folderName: "st8",
        storyName: "أحلام رنوش",
        storyType: "الذكاء الموسيقيِ",

        gamesPath: {
            game1: {
                folderName: "filling",
                name: "لوّن معنا",
            },
            game2: {
                folderName: "sort",
                name: "املا الفراغ",
            },
            game3: {
                folderName: "puzzle",
                name: "تركيب الصورة",
            },
        },
        pageRange: {
            first: 1,
            end: 15
        },


        Parent: {
            text: [{text: "الذَّكاءُ الموسيقي", type: "Title"},
                {
                    text: "هذه السّلسلةُ من الكتبِ المُصوّرةِ تعرضُ حكاياتٍ عن الأرنبِ رنوش تمكِّنك وطفلَك من مشاركةِ متعةِ النُّموِّ معهُ، حيث تَعرضُ عِدَّةَ جوانبَ للمعرفةِ، وما عليكَ إلاّ أن تدعَ طفلكَ يستمتعُ ويحسِّنُ قدراتِهِ من خلالِها.",
                    type: "p"
                },
                {
                    text: "الذكاءُ هو ما يضبطُ حياةَ الفردِ، ومقدرتَهُ على حلِّ المشكلاتِ أو ابتكارِ أشياءَ جديدةٍ. ولدى كلِّ فردٍ ذكاءاتٌ متعدِّدةٌ ذاتُ تركيبةٍ فريدةٍ ومتميِّزةٍ. يحتاجُ الطِّفلُ إلى اهتمامٍ خاصٍّ لتنميةِ قدراتِهِ الطَّبيعيةِ وذكاءاتِهِ المتعدِّدةِ لينموَ نموَّاً متوازناً.",
                    type: "p"
                },
                {
                    text: "الذّكاءُ الموسيقي: هو القدرةُ على تمييزِ الأصواتِ المختلفةِ. ويَضمُّ هذا النوعُ من الذّكاءِ القدرةَ على تمييزِ الإيقاعِ واللّحنِ والأنغامِ.",
                    type: "p"
                },
                {
                    text: "هل يمكنُ لِطفلِكَ تقليدُ الأصواتِ الّتي يسمعُها؟ هل يستطيعُ الاستجابةَ لها حركيّاً؟",
                    type: "p"
                },
                {
                    text: "أَعِزَّائي الْمُرَبِّين عليكم بِتَنميةِ قُدُراتِ أطفالِكم، فَهُمْ عُلَماءُ المستقبلِ.",
                    type: "p"
                }],
            sound: "02.mp3"
        },
        titleSound: "01.mp3",
        lock: true,
        downloading: false
    },
]


storyArray[0].desc = arrayStoryDesc[0]


function lockFunction() {

    for (i = 0; i < arrayStoryDesc.length; i++) {


        if (arrayStoryDesc[i].lock) {
//alert('#lockSt' + eval(i +1))

            $('#lockSt' + eval(i + 1)).show().css({
                height:"100%"
            })
            obj = $('#lockSt' + eval(i + 1)).find('.lock-container')
            obj.css({
                background: "url(images/book.svg) no-repeat center",
                'background-size': '30%'
            })
        }
        else {


            $('#lockSt' + eval(i + 1)).hide()

        }

    }
    $( ".thumb" ).each(function() {
        if($(this).attr("downloading")=="YES"){


            obj= $(this).find('.lock-container');
            obj.css({
                background:"url()",

            })
        }
    });
}


function writeJsonControlFile() {
    lockFunction()
    if (checkIFPc()) {
        lockFunction()

    }
    else {

        var fileSource = applicationPathRoot + "files/files/data.json"


        window.resolveLocalFileSystemURL(fileSource, fileExists, fileDoesNotExist);
        function fileExists(fileEntry) {


            fileEntry.file(function (file) {
                var reader = new FileReader();

                reader.onloadend = function (e) {
                    arrayStoryDesc.length = 0
                    arrayStoryDesc = JSON.parse(this.result)


                    lockFunction()

                }

                reader.readAsText(file);
            });


        }

        function fileDoesNotExist() {


            fileJsonWrite()
        }


    }


}


function fileJsonWrite() {
    window.requestFileSystem(LocalFileSystem.PERSISTENT, 0, gotFS, fail);
    function gotFS(fileSystem) {
        var directoryEntry = fileSystem.root; // to get root path of directory
        directoryEntry.nativeURL = applicationPathRoot
        directoryEntry.getFile("data.json", {create: true, exclusive: false}, gotFileEntry, fail);
    }

    function gotFileEntry(fileEntry) {

        fileEntry.createWriter(gotFileWriter, fail);

    }

    function gotFileWriter(writer) {
        writer.onwriteend = function (evt) {
            writeJsonControlFile()

        };
        writer.write(JSON.stringify(arrayStoryDesc));
    }

    function fail(error) {
        console.log(error.code);
    }
}





