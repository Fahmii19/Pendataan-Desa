// ckeditor
// Don't forget to add CSS for your custom styles.
// CKEDITOR.addCss(
//     'figure[class*=easyimage-gradient]::before { content: ""; position: absolute; top: 0; bottom: 0; left: 0; right: 0; }' +
//         "figure[class*=easyimage-gradient] figcaption { position: relative; z-index: 2; }" +
//         ".easyimage-gradient-1::before { background-image: linear-gradient( 135deg, rgba( 115, 110, 254, 0 ) 0%, rgba( 66, 174, 234, .72 ) 100% ); }" +
//         ".easyimage-gradient-2::before { background-image: linear-gradient( 135deg, rgba( 115, 110, 254, 0 ) 0%, rgba( 228, 66, 234, .72 ) 100% ); }"
// );

// CKEDITOR.replace("article", {
//     extraPlugins: "easyimage",
//     removePlugins: "image",
//     removeDialogTabs: "link:advanced",
//     height: 630,
//     cloudServices_uploadUrl: "https://33333.cke-cs.com/easyimage/upload/",
//     // Note: this is a token endpoint to be used for CKEditor 4 samples only. Images uploaded using this token may be deleted automatically at any moment.
//     // To create your own token URL please visit https://ckeditor.com/ckeditor-cloud-services/.
//     cloudServices_tokenUrl:
//         "https://33333.cke-cs.com/token/dev/ijrDsqFix838Gh3wGO3F77FSW94BwcLXprJ4APSp3XQ26xsUHTi0jcb1hoBt",
//     easyimage_styles: {
//         gradient1: {
//             group: "easyimage-gradients",
//             attributes: {
//                 class: "easyimage-gradient-1",
//             },
//             label: "Blue Gradient",
//             icon: "https://ckeditor.com/docs/ckeditor4/4.19.1/examples/assets/easyimage/icons/gradient1.png",
//             iconHiDpi:
//                 "https://ckeditor.com/docs/ckeditor4/4.19.1/examples/assets/easyimage/icons/hidpi/gradient1.png",
//         },
//         gradient2: {
//             group: "easyimage-gradients",
//             attributes: {
//                 class: "easyimage-gradient-2",
//             },
//             label: "Pink Gradient",
//             icon: "https://ckeditor.com/docs/ckeditor4/4.19.1/examples/assets/easyimage/icons/gradient2.png",
//             iconHiDpi:
//                 "https://ckeditor.com/docs/ckeditor4/4.19.1/examples/assets/easyimage/icons/hidpi/gradient2.png",
//         },
//         noGradient: {
//             group: "easyimage-gradients",
//             attributes: {
//                 class: "easyimage-no-gradient",
//             },
//             label: "No Gradient",
//             icon: "https://ckeditor.com/docs/ckeditor4/4.19.1/examples/assets/easyimage/icons/nogradient.png",
//             iconHiDpi:
//                 "https://ckeditor.com/docs/ckeditor4/4.19.1/examples/assets/easyimage/icons/hidpi/nogradient.png",
//         },
//     },
//     easyimage_toolbar: [
//         "EasyImageFull",
//         "EasyImageSide",
//         "EasyImageGradient1",
//         "EasyImageGradient2",
//         "EasyImageNoGradient",
//         "EasyImageAlt",
//     ],
//     removeButtons: "PasteFromWord",
// });

// CKEDITOR.replace("article", {
//     customConfig: "",
//     extraPlugins: "autoembed,embedsemantic,image2,uploadimage,uploadfile",
//     filebrowserUploadUrl: "/panduan/upload-file-panduan",
//     filebrowserUploadMethod: "form",
//     removePlugins: "image",
//     image2_disableResizer: false,
//     height: 600,
//     contentsCss: ["https://cdn.ckeditor.com/4.8.0/standard-all/contents.css"],
//     bodyClass: "article-editor",
//     format_tags: "p;h1;h2;h3;pre",
//     tabSpaces: 4,

//     stylesSet: [
//         { name: "Marker", element: "span", attributes: { class: "marker" } },
//         { name: "Cited Work", element: "cite" },
//         { name: "Inline Quotation", element: "q" },
//         {
//             name: "Special Container",
//             element: "div",
//             styles: {
//                 padding: "5px 10px",
//                 background: "#eee",
//                 border: "1px solid #ccc",
//             },
//         },
//         {
//             name: "Compact table",
//             element: "table",
//             attributes: {
//                 cellpadding: "5",
//                 cellspacing: "0",
//                 border: "1",
//                 bordercolor: "#ccc",
//             },
//             styles: {
//                 "border-collapse": "collapse",
//             },
//         },
//         {
//             name: "Borderless Table",
//             element: "table",
//             styles: { "border-style": "hidden", "background-color": "#E6E6FA" },
//         },
//         {
//             name: "Square Bulleted List",
//             element: "ul",
//             styles: { "list-style-type": "square" },
//         },

//         /* Widget Styles */
//         // We use this one to style the brownie picture.
//         {
//             name: "Illustration",
//             type: "widget",
//             widget: "image",
//             attributes: { class: "image-illustration" },
//         },
//         // Media embed
//         {
//             name: "240p",
//             type: "widget",
//             widget: "embedSemantic",
//             attributes: { class: "embed-240p" },
//         },
//         {
//             name: "360p",
//             type: "widget",
//             widget: "embedSemantic",
//             attributes: { class: "embed-360p" },
//         },
//         {
//             name: "480p",
//             type: "widget",
//             widget: "embedSemantic",
//             attributes: { class: "embed-480p" },
//         },
//         {
//             name: "720p",
//             type: "widget",
//             widget: "embedSemantic",
//             attributes: { class: "embed-720p" },
//         },
//         {
//             name: "1080p",
//             type: "widget",
//             widget: "embedSemantic",
//             attributes: { class: "embed-1080p" },
//         },
//     ],
// });

CKEDITOR.on("instanceReady", function (ev) {
    ev.editor.dataProcessor.htmlFilter.addRules({
        elements: {
            img: function (el) {
                // Add bootstrap "img-responsive" class to each inserted image
                el.addClass("img-fluid");

                // Remove inline "height" and "width" styles and
                // replace them with their attribute counterparts.
                // This ensures that the 'img-responsive' class works
                var style = el.attributes.style;

                if (style) {
                    // Get the width from the style.
                    var match = /(?:^|\s)width\s*:\s*(\d+)px/i.exec(style),
                        width = match && match[1];

                    // Get the height from the style.
                    match = /(?:^|\s)height\s*:\s*(\d+)px/i.exec(style);
                    var height = match && match[1];

                    // Replace the width
                    if (width) {
                        el.attributes.style = el.attributes.style.replace(
                            /(?:^|\s)width\s*:\s*(\d+)px;?/i,
                            ""
                        );
                        el.attributes.width = width;
                    }

                    // Replace the height
                    if (height) {
                        el.attributes.style = el.attributes.style.replace(
                            /(?:^|\s)height\s*:\s*(\d+)px;?/i,
                            ""
                        );
                        el.attributes.height = height;
                    }
                }

                // Remove the style tag if it is empty
                if (!el.attributes.style) delete el.attributes.style;
            },
        },
    });
});

CKEDITOR.on("dialogDefinition", function (ev) {
    var dialogName = ev.data.name;
    var dialogDefinition = ev.data.definition;
    if (dialogName == "image2") {
        var infoTab = dialogDefinition.getContents("info");

        infoTab.get("width").validate = function () {
            return true; //more advanced validation rule should be used here
        };

        infoTab.get("height").validate = function () {
            return true; //more advanced validation rule should be used here
        };
    }
});

//----- PreLoader -----//
let preloader = `
<div class="rounded-md p-4 w-full mx-auto">
<div class="animate-pulse flex space-x-4">
    <div class="flex-1 space-y-6 py-1">
        <div class="grid grid-cols-3 gap-4">
            <div class="h-2 bg-slate-300 rounded col-span-2"></div>
            <div class="h-2 bg-slate-300 rounded col-span-1"></div>
        </div>
        <div class="h-2 bg-slate-300 rounded"></div>
    </div>
</div>
<div class="animate-pulse flex space-x-4 pt-4">
    <div class="flex-1 space-y-6">
        <div class="grid grid-cols-3 gap-4">
            <div class="h-2 bg-slate-300 rounded col-span-2"></div>
            <div class="h-2 bg-slate-300 rounded col-span-1"></div>
        </div>
        <div class="h-2 bg-slate-300 rounded"></div>
    </div>
</div>
<div class="animate-pulse flex space-x-4 pt-4">

    <div class="h-[15rem] w-[25rem] bg-slate-300"></div>


    <div class="flex-1 space-y-6">
        <div class="grid grid-cols-3 gap-4">
            <div class="h-2 bg-slate-300 rounded col-span-2"></div>
            <div class="h-2 bg-slate-300 rounded col-span-1"></div>
        </div>
        <div class="grid grid-cols-3 gap-4">
            <div class="h-2 bg-slate-300 rounded col-span-2"></div>
            <div class="h-2 bg-slate-300 rounded col-span-1"></div>
        </div>
        <div class="grid grid-cols-3 gap-4">
            <div class="h-2 bg-slate-300 rounded col-span-2"></div>
            <div class="h-2 bg-slate-300 rounded col-span-1"></div>
        </div>
        <div class="grid grid-cols-3 gap-4">
            <div class="h-2 bg-slate-300 rounded col-span-2"></div>
            <div class="h-2 bg-slate-300 rounded col-span-1"></div>
        </div>
        <div class="h-2 bg-slate-300 rounded"></div>
        <div class="h-2 bg-slate-300 rounded"></div>
        <div class="h-2 bg-slate-300 rounded"></div>
        <div class="h-2 bg-slate-300 rounded"></div>
        <div class="h-2 bg-slate-300 rounded"></div>
    </div>
</div>
<div class="animate-pulse flex space-x-4 pt-4">
    <div class="flex-1 space-y-6">
        <div class="grid grid-cols-3 gap-4">
            <div class="h-2 bg-slate-300 rounded col-span-2"></div>
            <div class="h-2 bg-slate-300 rounded col-span-1"></div>
        </div>
        <div class="h-2 bg-slate-300 rounded"></div>
    </div>
</div>
<div class="animate-pulse flex space-x-4 pt-4">
    <div class="flex-1 space-y-6">
        <div class="grid grid-cols-3 gap-4">
            <div class="h-2 bg-slate-300 rounded col-span-2"></div>
            <div class="h-2 bg-slate-300 rounded col-span-1"></div>
        </div>
        <div class="h-2 bg-slate-300 rounded"></div>
    </div>
</div>


</div>
`;

//----- Edit Content -----//
const editKomponen = () => {
    $("#content").hide();
    $("#content-editor").show();
    $("#edit-content").hide();
    $("#save-editor").show();
    $("#cancel-editor").show();

    let content = localStorage.getItem("content");
    CKEDITOR.instances.article.setData(atob(content));
};

//----- Cancel Edit Content -----//
const cancelEditKomponen = () => {
    $("#content-editor").hide();
    $("#content").show();
    $("#edit-content").show();
    $("#save-editor").hide();
    $("#cancel-editor").hide();
};

//----- Save Edit Content -----//
const saveEditKomponen = () => {
    let id = localStorage.getItem("id_content");
    // let category = localStorage.getItem("part");

    // console.log(id);

    let content = CKEDITOR.instances.article.getData();

    $.ajax({
        url: `/panduan/${id}`,
        type: "PUT",
        data: {
            content: content,
        },
        dataType: "json",
        success: (res) => {
            $("#content-editor").hide();
            $("#content").show();
            $("#edit-content").show();
            $("#save-editor").hide();
            $("#cancel-editor").hide();

            // set content
            localStorage.setItem("content", btoa(res.content));
            $("#content").html(res.content);

            // console.log(res.content);
        },
    });
};

//----- Pattern Regex -----//
// Highlight Text

const getHighlightedText = (pharse, keyword) => {
    const keywordsString = keyword;
    const keywords = keywordsString.split(/\s/);

    // equivalent to: /(cake|pie|cookies)/g
    const pattern = new RegExp(`(${keywords.join("|")})`, "gim");

    const phrase = pharse;

    // console.log(phrase);

    const result = phrase.replace(pattern, (match) => `<b>${match}</b>`);

    return result;
};

//Regex Replace html tags
let regexTag = new RegExp("<[^>]*>", "gim");

//----- Get Content -----//
// const choosePart = (id, category) => {
//     // $("#content").html(preloader);
//     $.ajax({
//         url: `/panduan/${id}/${category}`,
//         type: "POST",
//         dataType: "json",
//         success: (res) => {
//             localStorage.setItem("part", category);
//             localStorage.setItem("id_content", id);
//             localStorage.setItem("content", btoa(res.content));
//             $("#container-result-search").hide();
//             let keyword = localStorage.getItem("search_panduan");

//             // console.log(keyword);

//             if (keyword == undefined) {
//                 $("#content").html(res.content);
//             } else {
//                 $("#content").html(getHighlightedText(res.content, keyword));
//             }
//         },
//     });
// };

const chooseSubJudul = (id) => {
    $.ajax({
        url: `/panduan/sub-judul/${id}`,
        type: "get",
        dataType: "json",
        success: (res) => {
            // console.log(res);
            // localStorage.setItem("part", "sub-judul");

            // $("#container-result-search").hide();
            // let keyword = localStorage.getItem("search_panduan");

            // if (keyword == undefined) {
            //     $("#content").html(res.content);
            // } else {
            //     $("#content").html(getHighlightedText(res.content, keyword));
            // }

            // foreach res
            res.forEach((element) => {
                localStorage.setItem("id_content", element.id);
                localStorage.setItem("content", btoa(element.content));

                $("#content").html(element.content);
            });
        },
    });
};

//----- Search Content -----//
$("#search").bindWithDelay(
    "keyup",
    (e) => {
        let search = $(e.target).val();

        localStorage.setItem("search_panduan", search);

        $("#cancel-search").hide();
        $("#process-search").show();

        $.ajax({
            url: `/panduan/search/${search}`,
            type: "GET",
            dataType: "json",
            success: (res) => {
                $("#cancel-search").show();
                $("#process-search").hide();

                $("#container-result-search").show();

                let html = "";

                if (res.length == 0) {
                    html = `
                                <div class="mb-1 py-3 cursor-pointer border-dotted border-b-2 border-gray-500">
                                    <p class="font-bold text-[13pt] text-gray-500">Tidak ada hasil</p>
                                </div>
                    `;
                } else {
                    res.forEach(({ id, title, content, type }) => {
                        let contentSearch = getHighlightedText(
                            content.replaceAll(regexTag, ""),
                            search
                        );
                        html += `
                        <div class="mb-1 p-3 cursor-pointer hover:bg-gray-300 rounded" onclick="choosePart(${id}, '${type}');">
                        <p class="font-bold text-[13pt]">${title}</p>
                            ${getHighlightedText(contentSearch, search)}
                        </div>
                        `;
                    });
                }

                $("#result-search").html(html);
            },
            error: (err) => {
                $("#cancel-search").show();
                $("#process-search").hide();

                $("#container-result-search").hide();
            },
        });
    },
    1000
);

// ----- Cancel Search -----//
const cancelSearch = () => {
    $("#search").val("");
    $("#container-result-search").hide();
    $("#cancel-search").hide();

    // localStorage.removeItem("search_panduan");
};

// Button hide show search
const btn_hideshowSearch = () => {
    $("#hideshowsearch").toggle();
};

// delete keypress
$("#search").keyup(function (e) {
    var len = $(this).val().length;
    if (len == 0) {
        $("#cancel-search").hide();
    } else {
        $("#cancel-search").show();
    }
});

window.onload = () => {
    // choosePart(7, "bagian");
    // chooseSubJudul(142);
};

// add class on click event to active menu list group panduan
// $(".active_menu").addClass("text-indigo-600");

// $(".list-group-item").click(function () {
//     $(".list-group-item").removeClass("text-indigo-600");
//     $(".active_menu").removeClass("text-indigo-600");
//     $(this).addClass("text-indigo-600");
// });

// add input dynamic

const addInput = () => {
    let maxfield = 3;
    let konten = $(".container1");
    let addButton = $(".add_form_field");
    let x = 1;

    addButton.click(function (e) {
        e.preventDefault();
        if (x < maxfield) {
            x++;
            $(konten).append(
                `
                    <div class="grid grid-cols-10 remove_container mb-6">
                    <div class="grid col-span-9">
                        <label class="block mb-2 text-sm font-medium text-black">Sub Judul</label>
                        <input type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" name="mytext[]" placeholder="Sub Judul">
                    </div>
                    <div class="grid delete">
                        <div
                            class="add_form_field cursor-pointer place-self-center rounded-full bg-gray-400 text-white mt-6">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </div>
                    </div>

                </div>
                `
            );
        } else {
            alert("You Reached the limits");
        }
    });

    $(konten).on("click", ".delete", function (e) {
        e.preventDefault();
        $(".delete").parent("div").remove();
        x--;
    });
};
addInput();

// create new panduan

const createPanduan = () => {
    $("#pilihan").change(function () {
        let pilihan = $(this).val();
        if (pilihan == "sub1") {
            $(".subjudul").append(
                `
                    <div class="mb-6 hapus_subjudul">

                        <div class="flex flex-row">
                            <div class="basis-[90vw]">
                                <label class="block mb-2 text-sm font-medium text-black">Sub Judul 1</label>
                                <input type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Ketik disini" name="subjudul[]">
                                <input class="hidden" type="text" name="ordered[]" value="1.">
                            </div>
                        <div class="basis-[10vw] flex items-center justify-center mt-7 cursor-pointer hidden">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15 12H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                        </div>

                    </div>
                `
            );
        } else if (pilihan == "sub2") {
            $(".subjudul").append(
                `
                    <div class="mb-6">

                        <div class="flex flex-row">
                            <div class="basis-[90vw]">
                                <label class="block mb-2 text-sm font-medium text-black">Sub Judul 2</label>
                                <input type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Ketik disini" name="subjudul[]">
                                <input class="hidden" type="text" name="ordered[]" value="1.1.">
                            </div>
                        <div class="basis-[10vw] flex items-center justify-center mt-7 cursor-pointer hidden">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15 12H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                        </div>

                    </div>
                `
            );
        } else if (pilihan == "sub3") {
            $(".subjudul").append(
                `
                    <div class="mb-6">

                        <div class="flex flex-row">
                            <div class="basis-[90vw]">
                                <label class="block mb-2 text-sm font-medium text-black">Sub Judul 3</label>
                                <input type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Ketik disini" name="subjudul[]">
                                <input class="hidden" type="text" name="ordered[]" value="1.1.1.">
                            </div>
                        <div class="basis-[10vw] flex items-center justify-center mt-7 cursor-pointer hidden">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15 12H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                        </div>

                    </div>
                `
            );
        }
    });
};
createPanduan();

function add_modal() {
    $.ajax({
        type: "post",
        url: "{{ url('panduan/created-panduan') }}",
        dataType: "json",
        success: function (data) {
            // console.log(data);
        },
    });
}

// box konten button
// $(`#trigger_judul-141`).find(`#trigger_action_sub-141`).hide();

const boxKonten = (id) => {
    $(`#trigger_judul-${id}`).hover(
        function () {
            $(`#trigger_action_sub-${id}`).show();
        },
        function () {
            $(`#trigger_judul-${id}`).find(`#trigger_action_sub-${id}`).hide();
        }
    );
};
// boxKonten();

// box action konten

const boxActionKonten = (id) => {
    const trigerJudul = $(`#trigger_judul-${id}`);
    const triggerActionSub = $(`#trigger_action_sub-${id}`);

    // Tambahkan event listener untuk saat mouse masuk ke triger-judul-panduan
    trigerJudul.on("mouseenter", () => {
        // Ambil tinggi dari triger-judul-panduan
        const trigerJudulHeight = trigerJudul.height();

        // Set tinggi dari trigger_action_sub-141 sesuai dengan tinggi triger-judul-panduan
        triggerActionSub.css("height", trigerJudulHeight + "px");
    });
};
// boxActionKonten();

// menhapus data panduan
const deleteMenuPanduan = (id) => {
    let token = $("meta[name='csrf-token']").attr("content");

    $.ajax({
        url: "/panduan/delete-panduan/" + id,
        type: "delete",
        data: {
            id: id,
            _token: token,
        },
        success: function (data) {
            document.location.reload(true);
        },
    });
};

// const updateMenuPanduan = (id) => {

//     let data = {

//     };

//     $.ajax({
//         url: "/panduan/update-panduan/" + id,
//         type: "get",
//         success: function (data) {},
//     });
// };

const editMenuPanduan = (id) => {
    $.ajax({
        url: `/panduan/edit-panduan/` + id,
        type: "get",
        dataType: "json",
        success: function (res) {
            // console.log(res);
            $("#edit_nama_judul").val(res.title);
            $("#edit_kategori").val(res.category);
            $("#edit_penomoran").val(res.ordered);
            $("#edit_id").val(res.id);
        },
    });
};

$("#formUpdatePanduan").submit((e) => {
    // console.log("test");
    e.preventDefault();
    let id = $("#edit_id").val();
    let data = $("#formUpdatePanduan").serialize();
    $.ajax({
        url: `/panduan/update-panduan/` + id,
        type: "put",
        data: data,
        success: function (res) {
            document.location.reload(true);
        },
    });
});

// toggle hide show judul panduan

const toggleJudul = (bagan) => {
    $(`.triger-judul-panduan-${bagan}`).on("click", function () {
        $(`.sub-showing-panduan-${bagan}`).toggleClass("hidden block");
        $(this)
            .find(".triger-arrow-up, .triger-arrow-down")
            .toggleClass("hidden");
        $(`.sub-showing-panduan-${bagan}`).stop().slideToggle(500);
    });
};

// toggleJudul();

const subJudul = () => {
    $(".triger-sub-panduan").on("click", function () {
        $(this)
            .toggleClass("block")
            .next(".subs-showing-panduan")
            .stop()
            .slideToggle(500);

        $(this).find(".subs-plus").toggleClass("hidden");
        $(this).find(".subs-minus").toggleClass("hidden");
    });
};
subJudul();

const subSubJudul = () => {
    const trigerJudul = $(`.triger-sub-sub-panduan`);

    trigerJudul.on("click", () => {
        $(".sub-sub-showing-panduan")
            .toggleClass("block")
            .stop()
            .slideToggle(500);
    });
};

subSubJudul();

$(".video_jakpintas video").each(function () {
    this.pause();
});

$("#konten_login").hide();
$("#konten_layer").hide();
$("#konten_icon").hide();
$("#konten_form").hide();
$("#konten_chip").hide();
$("#konten_pustaka").hide();
$("#konten_navigasi").hide();
$("#konten_video").hide();

// Function untuk menampilkan menu panduan DIHIDE
const ActiveMenuPanduan = (param) => {
    //     // Menu Jakpintas
    //     if (param == 1) {
    //         // Set warna aktif pada title
    //         $("#active_title_jakpintas").addClass("text-blue-500");
    //         // Set menghapus warna aktif pada title
    //         $("#active_title_login").removeClass("text-blue-500");
    //         $("#active_title_layer").removeClass("text-blue-500");
    //         $("#active_title_icon").removeClass("text-blue-500");
    //         $("#active_title_form").removeClass("text-blue-500");
    //         $("#active_title_chip").removeClass("text-blue-500");
    //         $("#active_title_pustaka").removeClass("text-blue-500");
    //         $("#active_title_navigasi").removeClass("text-blue-500");
    //         $("#active_title_video").removeClass("text-blue-500");
    //         // Set menghapus warna aktif pada sub menu
    //         $(".sub_login").removeClass("text-blue-500");
    //         $(".sub_layer").removeClass("text-blue-500");
    //         $(".sub_icon").removeClass("text-blue-500");
    //         $(".sub_form").removeClass("text-blue-500");
    //         $(".sub_chip").removeClass("text-blue-500");
    //         $(".sub_pustaka").removeClass("text-blue-500");
    //         $(".sub_navigasi").removeClass("text-blue-500");
    //         $(".sub_video").removeClass("text-blue-500");
    //         // Konten yang akan ditampilkan
    //         $("#konten_jakpintas").show();
    //         $("#konten_login").hide();
    //         $("#konten_layer").hide();
    //         $("#konten_icon").hide();
    //         $("#konten_form").hide();
    //         $("#konten_chip").hide();
    //         $("#konten_pustaka").hide();
    //         $("#konten_navigasi").hide();
    //         $("#konten_video").hide();
    //         // Set warna aktif pada sub menu
    //         $(".active_jakpintas").addClass("text-blue-500");
    //         $("#sub_active_jakpintas").on("click", ".sub_jakpintas", function () {
    //             $("#sub_active_jakpintas .sub_jakpintas.text-blue-500").removeClass(
    //                 "text-blue-500"
    //             );
    //             $("#sub_active_jakpintas .sub_jakpintas").removeClass(
    //                 "active_jakpintas"
    //             );
    //             $(this).addClass("text-blue-500");
    //         });
    //         // Memutar video
    //         $(".video_jakpintas video").each(function () {
    //             this.pause();
    //         });
    //         // menampilkan konten panduan jakpintas
    //         $(".hide_show_panduan_jakpintas").removeClass("hidden");
    //         const button = $("#accordion-flush-heading-1 span");
    //         if (!button.attr("data-clicked")) {
    //             button.attr("data-clicked", true);
    //             button.click(function () {
    //                 $("#accordion-flush-body-1").toggle();
    //                 const isExpanded =
    //                     button.attr("aria-expanded") === "true" || false;
    //                 button.attr("aria-expanded", !isExpanded);
    //             });
    //         }
    //     }
    //     // Menu Login
    //     else if (param == 2) {
    //         // Set warna aktif pada title
    //         $("#active_title_login").addClass("text-blue-500");
    //         // Set menghapus warna aktif pada title
    //         $("#active_title_jakpintas").removeClass("text-blue-500");
    //         $("#active_title_layer").removeClass("text-blue-500");
    //         $("#active_title_icon").removeClass("text-blue-500");
    //         $("#active_title_form").removeClass("text-blue-500");
    //         $("#active_title_chip").removeClass("text-blue-500");
    //         $("#active_title_pustaka").removeClass("text-blue-500");
    //         $("#active_title_navigasi").removeClass("text-blue-500");
    //         $("#active_title_video").removeClass("text-blue-500");
    //         // Set menghapus warna aktif pada sub menu
    //         $(".sub_jakpintas").removeClass("text-blue-500");
    //         $(".sub_layer").removeClass("text-blue-500");
    //         $(".sub_icon").removeClass("text-blue-500");
    //         $(".sub_form").removeClass("text-blue-500");
    //         $(".sub_chip").removeClass("text-blue-500");
    //         $(".sub_pustaka").removeClass("text-blue-500");
    //         $(".sub_navigasi").removeClass("text-blue-500");
    //         $(".sub_video").removeClass("text-blue-500");
    //         // Konten yang akan ditampilkan
    //         $("#konten_login").show();
    //         $("#konten_jakpintas").hide();
    //         $("#konten_layer").hide();
    //         $("#konten_icon").hide();
    //         $("#konten_form").hide();
    //         $("#konten_chip").hide();
    //         $("#konten_pustaka").hide();
    //         $("#konten_navigasi").hide();
    //         $("#konten_video").hide();
    //         // Set warna aktif pada sub menu
    //         $(".active_login").addClass("text-blue-500");
    //         $("#sub_active_login").on("click", ".sub_login", function () {
    //             $("#sub_active_login .sub_login.text-blue-500").removeClass(
    //                 "text-blue-500"
    //             );
    //             $("#sub_active_login .sub_login").removeClass("active_login");
    //             $(this).addClass("text-blue-500");
    //         });
    //         // Memutar video
    //         $(".video_jakpintas video").each(function () {
    //             this.pause();
    //         });
    //         // menampilkan konten panduan login
    //         $(".hide_show_panduan_login").removeClass("hidden");
    //         const button = $("#accordion-flush-heading-2 span");
    //         if (!button.attr("data-clicked")) {
    //             button.attr("data-clicked", true);
    //             button.click(function () {
    //                 $("#accordion-flush-body-2").toggle();
    //                 const isExpanded =
    //                     button.attr("aria-expanded") === "true" || false;
    //                 button.attr("aria-expanded", !isExpanded);
    //             });
    //         }
    //     }
    //     // Menu Layer
    //     else if (param == 3) {
    //         // Set warna aktif pada title
    //         $("#active_title_layer").addClass("text-blue-500");
    //         // Set menghapus warna aktif pada title
    //         $("#active_title_jakpintas").removeClass("text-blue-500");
    //         $("#active_title_login").removeClass("text-blue-500");
    //         $("#active_title_icon").removeClass("text-blue-500");
    //         $("#active_title_form").removeClass("text-blue-500");
    //         $("#active_title_chip").removeClass("text-blue-500");
    //         $("#active_title_pustaka").removeClass("text-blue-500");
    //         $("#active_title_navigasi").removeClass("text-blue-500");
    //         $("#active_title_video").removeClass("text-blue-500");
    //         // Set menghapus warna aktif pada sub menu
    //         $(".sub_jakpintas").removeClass("text-blue-500");
    //         $(".sub_login").removeClass("text-blue-500");
    //         $(".sub_icon").removeClass("text-blue-500");
    //         $(".sub_form").removeClass("text-blue-500");
    //         $(".sub_chip").removeClass("text-blue-500");
    //         $(".sub_pustaka").removeClass("text-blue-500");
    //         $(".sub_navigasi").removeClass("text-blue-500");
    //         $(".sub_video").removeClass("text-blue-500");
    //         // Konten yang akan ditampilkan
    //         $("#konten_layer").show();
    //         $("#konten_jakpintas").hide();
    //         $("#konten_login").hide();
    //         $("#konten_icon").hide();
    //         $("#konten_form").hide();
    //         $("#konten_chip").hide();
    //         $("#konten_pustaka").hide();
    //         $("#konten_navigasi").hide();
    //         $("#konten_video").hide();
    //         // Set warna aktif pada sub menu
    //         $(".active_layer").addClass("text-blue-500");
    //         $("#sub_active_layer").on("click", ".sub_layer", function () {
    //             $("#sub_active_layer .sub_layer.text-blue-500").removeClass(
    //                 "text-blue-500"
    //             );
    //             $("#sub_active_layer .sub_layer").removeClass("active_layer");
    //             $(this).addClass("text-blue-500");
    //         });
    //         // Memutar video
    //         $(".video_jakpintas video").each(function () {
    //             this.pause();
    //         });
    //         menampilkan konten panduan layer
    //         $(".hide_show_panduan_layer").removeClass("hidden");
    //         const button = $("#accordion-flush-heading-3 span");
    //         if (!button.attr("data-clicked")) {
    //             button.attr("data-clicked", true);
    //             button.click(function () {
    //                 $("#accordion-flush-body-3").toggle();
    //                 const isExpanded =
    //                     button.attr("aria-expanded") === "true" || false;
    //                 button.attr("aria-expanded", !isExpanded);
    //             });
    //         }
    //     }
    //     // Menu Icon
    //     else if (param == 4) {
    //         // Set warna aktif pada title
    //         $("#active_title_icon").addClass("text-blue-500");
    //         // Set menghapus warna aktif pada title
    //         $("#active_title_jakpintas").removeClass("text-blue-500");
    //         $("#active_title_login").removeClass("text-blue-500");
    //         $("#active_title_layer").removeClass("text-blue-500");
    //         $("#active_title_form").removeClass("text-blue-500");
    //         $("#active_title_chip").removeClass("text-blue-500");
    //         $("#active_title_pustaka").removeClass("text-blue-500");
    //         $("#active_title_navigasi").removeClass("text-blue-500");
    //         $("#active_title_video").removeClass("text-blue-500");
    //         // Set menghapus warna aktif pada sub menu
    //         $(".sub_jakpintas").removeClass("text-blue-500");
    //         $(".sub_login").removeClass("text-blue-500");
    //         $(".sub_layer").removeClass("text-blue-500");
    //         $(".sub_form").removeClass("text-blue-500");
    //         $(".sub_chip").removeClass("text-blue-500");
    //         $(".sub_pustaka").removeClass("text-blue-500");
    //         $(".sub_navigasi").removeClass("text-blue-500");
    //         $(".sub_video").removeClass("text-blue-500");
    //         // Konten yang akan ditampilkan
    //         $("#konten_icon").show();
    //         $("#konten_jakpintas").hide();
    //         $("#konten_login").hide();
    //         $("#konten_layer").hide();
    //         $("#konten_form").hide();
    //         $("#konten_chip").hide();
    //         $("#konten_pustaka").hide();
    //         $("#konten_navigasi").hide();
    //         $("#konten_video").hide();
    //         // Set warna aktif pada sub menu
    //         $(".active_icon").addClass("text-blue-500");
    //         $("#sub_active_icon").on("click", ".sub_icon", function () {
    //             $("#sub_active_icon .sub_icon.text-blue-500").removeClass(
    //                 "text-blue-500"
    //             );
    //             $("#sub_active_icon .sub_icon").removeClass("active_icon");
    //             $(this).addClass("text-blue-500");
    //         });
    //         // Memutar video
    //         $(".video_jakpintas video").each(function () {
    //             this.pause();
    //         });
    //         // menampilkan konten panduan icon
    //         $(".hide_show_panduan_icon").removeClass("hidden");
    //         const button = $("#accordion-flush-heading-4 span");
    //         if (!button.attr("data-clicked")) {
    //             button.attr("data-clicked", true);
    //             button.click(function () {
    //                 $("#accordion-flush-body-4").toggle();
    //                 const isExpanded =
    //                     button.attr("aria-expanded") === "true" || false;
    //                 button.attr("aria-expanded", !isExpanded);
    //             });
    //         }
    //     }
    //     // Menu Form
    //     else if (param == 5) {
    //         // Set warna aktif pada title
    //         $("#active_title_form").addClass("text-blue-500");
    //         // Set menghapus warna aktif pada title
    //         $("#active_title_jakpintas").removeClass("text-blue-500");
    //         $("#active_title_login").removeClass("text-blue-500");
    //         $("#active_title_layer").removeClass("text-blue-500");
    //         $("#active_title_icon").removeClass("text-blue-500");
    //         $("#active_title_chip").removeClass("text-blue-500");
    //         $("#active_title_pustaka").removeClass("text-blue-500");
    //         $("#active_title_navigasi").removeClass("text-blue-500");
    //         $("#active_title_video").removeClass("text-blue-500");
    //         // Set menghapus warna aktif pada sub menu
    //         $(".sub_jakpintas").removeClass("text-blue-500");
    //         $(".sub_login").removeClass("text-blue-500");
    //         $(".sub_layer").removeClass("text-blue-500");
    //         $(".sub_icon").removeClass("text-blue-500");
    //         $(".sub_chip").removeClass("text-blue-500");
    //         $(".sub_pustaka").removeClass("text-blue-500");
    //         $(".sub_navigasi").removeClass("text-blue-500");
    //         $(".sub_video").removeClass("text-blue-500");
    //         // Konten yang akan ditampilkan
    //         $("#konten_form").show();
    //         $("#konten_jakpintas").hide();
    //         $("#konten_login").hide();
    //         $("#konten_layer").hide();
    //         $("#konten_icon").hide();
    //         $("#konten_chip").hide();
    //         $("#konten_pustaka").hide();
    //         $("#konten_navigasi").hide();
    //         $("#konten_video").hide();
    //         // Set warna aktif pada sub menu
    //         $(".active_form").addClass("text-blue-500");
    //         $("#sub_active_form").on("click", ".sub_form", function () {
    //             $("#sub_active_form .sub_form.text-blue-500").removeClass(
    //                 "text-blue-500"
    //             );
    //             $("#sub_active_form .sub_form").removeClass("active_form");
    //             $(this).addClass("text-blue-500");
    //         });
    //         // Memutar video
    //         $(".video_jakpintas video").each(function () {
    //             this.pause();
    //         });
    //         // menampilkan konten panduan form
    //         $(".hide_show_panduan_form").removeClass("hidden");
    //         const button = $("#accordion-flush-heading-5 span");
    //         if (!button.attr("data-clicked")) {
    //             button.attr("data-clicked", true);
    //             button.click(function () {
    //                 $("#accordion-flush-body-5").toggle();
    //                 const isExpanded =
    //                     button.attr("aria-expanded") === "true" || false;
    //                 button.attr("aria-expanded", !isExpanded);
    //             });
    //         }
    //     }
    //     // Menu Chip
    //     else if (param == 6) {
    //         // Set warna aktif pada title
    //         $("#active_title_chip").addClass("text-blue-500");
    //         // Set menghapus warna aktif pada title
    //         $("#active_title_jakpintas").removeClass("text-blue-500");
    //         $("#active_title_login").removeClass("text-blue-500");
    //         $("#active_title_layer").removeClass("text-blue-500");
    //         $("#active_title_icon").removeClass("text-blue-500");
    //         $("#active_title_form").removeClass("text-blue-500");
    //         $("#active_title_pustaka").removeClass("text-blue-500");
    //         $("#active_title_navigasi").removeClass("text-blue-500");
    //         $("#active_title_video").removeClass("text-blue-500");
    //         // Set menghapus warna aktif pada sub menu
    //         $(".sub_jakpintas").removeClass("text-blue-500");
    //         $(".sub_login").removeClass("text-blue-500");
    //         $(".sub_layer").removeClass("text-blue-500");
    //         $(".sub_icon").removeClass("text-blue-500");
    //         $(".sub_form").removeClass("text-blue-500");
    //         $(".sub_pustaka").removeClass("text-blue-500");
    //         $(".sub_navigasi").removeClass("text-blue-500");
    //         $(".sub_video").removeClass("text-blue-500");
    //         // Konten yang akan ditampilkan
    //         $("#konten_chip").show();
    //         $("#konten_jakpintas").hide();
    //         $("#konten_login").hide();
    //         $("#konten_layer").hide();
    //         $("#konten_icon").hide();
    //         $("#konten_form").hide();
    //         $("#konten_pustaka").hide();
    //         $("#konten_navigasi").hide();
    //         $("#konten_video").hide();
    //         // Set warna aktif pada sub menu
    //         $(".active_chip").addClass("text-blue-500");
    //         $("#sub_active_chip").on("click", ".sub_chip", function () {
    //             $("#sub_active_chip .sub_chip.text-blue-500").removeClass(
    //                 "text-blue-500"
    //             );
    //             $("#sub_active_chip .sub_chip").removeClass("active_chip");
    //             $(this).addClass("text-blue-500");
    //         });
    //         // Memutar video
    //         $(".video_jakpintas video").each(function () {
    //             this.pause();
    //         });
    //         // menampilkan konten panduan form
    //         $(".hide_show_panduan_chip").removeClass("hidden");
    //         const button = $("#accordion-flush-heading-6 span");
    //         if (!button.attr("data-clicked")) {
    //             button.attr("data-clicked", true);
    //             button.click(function () {
    //                 $("#accordion-flush-body-6").toggle();
    //                 const isExpanded =
    //                     button.attr("aria-expanded") === "true" || false;
    //                 button.attr("aria-expanded", !isExpanded);
    //             });
    //         }
    //     }
    //     // Menu Pustaka
    //     else if (param == 7) {
    //         // Set warna aktif pada title
    //         $("#active_title_pustaka").addClass("text-blue-500");
    //         // // Set menghapus warna aktif pada title
    //         $("#active_title_jakpintas").removeClass("text-blue-500");
    //         $("#active_title_login").removeClass("text-blue-500");
    //         $("#active_title_layer").removeClass("text-blue-500");
    //         $("#active_title_icon").removeClass("text-blue-500");
    //         $("#active_title_form").removeClass("text-blue-500");
    //         $("#active_title_chip").removeClass("text-blue-500");
    //         $("#active_title_navigasi").removeClass("text-blue-500");
    //         $("#active_title_video").removeClass("text-blue-500");
    //         // Set menghapus warna aktif pada sub menu
    //         $(".sub_jakpintas").removeClass("text-blue-500");
    //         $(".sub_login").removeClass("text-blue-500");
    //         $(".sub_layer").removeClass("text-blue-500");
    //         $(".sub_icon").removeClass("text-blue-500");
    //         $(".sub_form").removeClass("text-blue-500");
    //         $(".sub_chip").removeClass("text-blue-500");
    //         $(".sub_navigasi").removeClass("text-blue-500");
    //         $(".sub_video").removeClass("text-blue-500");
    //         // Konten yang akan ditampilkan
    //         $("#konten_pustaka").show();
    //         $("#konten_jakpintas").hide();
    //         $("#konten_login").hide();
    //         $("#konten_layer").hide();
    //         $("#konten_icon").hide();
    //         $("#konten_form").hide();
    //         $("#konten_chip").hide();
    //         $("#konten_navigasi").hide();
    //         $("#konten_video").hide();
    //         // Set warna aktif pada sub menu
    //         $(".active_pustaka").addClass("text-blue-500");
    //         $("#sub_active_pustaka").on("click", ".sub_pustaka", function () {
    //             $("#sub_active_pustaka .sub_pustaka.text-blue-500").removeClass(
    //                 "text-blue-500"
    //             );
    //             $("#sub_active_pustaka .sub_pustaka").removeClass("active_pustaka");
    //             $(this).addClass("text-blue-500");
    //         });
    //         // Memutar video
    //         $(".video_jakpintas video").each(function () {
    //             this.pause();
    //         });
    //         // menampilkan konten panduan form
    //         $(".hide_show_panduan_pustaka").removeClass("hidden");
    //         const button = $("#accordion-flush-heading-7 span");
    //         if (!button.attr("data-clicked")) {
    //             button.attr("data-clicked", true);
    //             button.click(function () {
    //                 $("#accordion-flush-body-7").toggle();
    //                 const isExpanded =
    //                     button.attr("aria-expanded") === "true" || false;
    //                 button.attr("aria-expanded", !isExpanded);
    //             });
    //         }
    //     }
    //     // Menu Navigasi
    //     else if (param == 8) {
    //         // Set warna aktif pada title
    //         $("#active_title_navigasi").addClass("text-blue-500");
    //         // Set menghapus warna aktif pada title
    //         $("#active_title_jakpintas").removeClass("text-blue-500");
    //         $("#active_title_login").removeClass("text-blue-500");
    //         $("#active_title_layer").removeClass("text-blue-500");
    //         $("#active_title_icon").removeClass("text-blue-500");
    //         $("#active_title_form").removeClass("text-blue-500");
    //         $("#active_title_chip").removeClass("text-blue-500");
    //         $("#active_title_pustaka").removeClass("text-blue-500");
    //         $("#active_title_video").removeClass("text-blue-500");
    //         // Set menghapus warna aktif pada sub menu
    //         $(".sub_jakpintas").removeClass("text-blue-500");
    //         $(".sub_login").removeClass("text-blue-500");
    //         $(".sub_layer").removeClass("text-blue-500");
    //         $(".sub_icon").removeClass("text-blue-500");
    //         $(".sub_form").removeClass("text-blue-500");
    //         $(".sub_chip").removeClass("text-blue-500");
    //         $(".sub_pustaka").removeClass("text-blue-500");
    //         $(".sub_video").removeClass("text-blue-500");
    //         // Konten yang akan ditampilkan
    //         $("#konten_navigasi").show();
    //         $("#konten_jakpintas").hide();
    //         $("#konten_login").hide();
    //         $("#konten_layer").hide();
    //         $("#konten_icon").hide();
    //         $("#konten_form").hide();
    //         $("#konten_chip").hide();
    //         $("#konten_pustaka").hide();
    //         $("#konten_video").hide();
    //         // Set warna aktif pada sub menu
    //         $(".active_navigasi").addClass("text-blue-500");
    //         $("#sub_active_navigasi").on("click", ".sub_navigasi", function () {
    //             $("#sub_active_navigasi .sub_navigasi.text-blue-500").removeClass(
    //                 "text-blue-500"
    //             );
    //             $("#sub_active_navigasi .sub_navigasi").removeClass(
    //                 "active_navigasi"
    //             );
    //             $(this).addClass("text-blue-500");
    //         });
    //         // Memutar video
    //         $(".video_jakpintas video").each(function () {
    //             this.pause();
    //         });
    //         // menampilkan konten panduan form
    //         $(".hide_show_panduan_navigasi").removeClass("hidden");
    //         const button = $("#accordion-flush-heading-8 span");
    //         if (!button.attr("data-clicked")) {
    //             button.attr("data-clicked", true);
    //             button.click(function () {
    //                 $("#accordion-flush-body-8").toggle();
    //                 const isExpanded =
    //                     button.attr("aria-expanded") === "true" || false;
    //                 button.attr("aria-expanded", !isExpanded);
    //             });
    //         }
    //     }
    //     // Video
    //     else if (param == 9) {
    //         // Set warna aktif pada title
    //         $("#active_title_video").addClass("text-blue-500");
    //         // // Set menghapus warna aktif pada title
    //         $("#active_title_jakpintas").removeClass("text-blue-500");
    //         $("#active_title_login").removeClass("text-blue-500");
    //         $("#active_title_layer").removeClass("text-blue-500");
    //         $("#active_title_icon").removeClass("text-blue-500");
    //         $("#active_title_form").removeClass("text-blue-500");
    //         $("#active_title_chip").removeClass("text-blue-500");
    //         $("#active_title_pustaka").removeClass("text-blue-500");
    //         $("#active_title_navigasi").removeClass("text-blue-500");
    //         // Set menghapus warna aktif pada sub menu
    //         $(".sub_jakpintas").removeClass("text-blue-500");
    //         $(".sub_login").removeClass("text-blue-500");
    //         $(".sub_layer").removeClass("text-blue-500");
    //         $(".sub_icon").removeClass("text-blue-500");
    //         $(".sub_form").removeClass("text-blue-500");
    //         $(".sub_chip").removeClass("text-blue-500");
    //         $(".sub_pustaka").removeClass("text-blue-500");
    //         $(".sub_navigasi").removeClass("text-blue-500");
    //         $(".sub_video").removeClass("text-blue-500");
    //         // Konten yang akan ditampilkan
    //         $("#konten_video").show();
    //         $("#konten_jakpintas").hide();
    //         $("#konten_login").hide();
    //         $("#konten_layer").hide();
    //         $("#konten_icon").hide();
    //         $("#konten_form").hide();
    //         $("#konten_chip").hide();
    //         $("#konten_pustaka").hide();
    //         $("#konten_navigasi").hide();
    //         // Set warna aktif pada sub menu
    //         $(".active_video").addClass("text-blue-500");
    //         $("#sub_active_video").on("click", ".sub_video", function () {
    //             $("#sub_active_video .sub_video.text-blue-500").removeClass(
    //                 "text-blue-500"
    //             );
    //             $("#sub_active_video .sub_video").removeClass("active_video");
    //             $(this).addClass("text-blue-500");
    //         });
    //         // Memutar video
    //         $(".video_jakpintas video").each(function () {
    //             this.play();
    //         });
    //         // menampilkan konten panduan form
    //         $(".hide_show_panduan_video").removeClass("hidden");
    //         const button = $("#accordion-flush-heading-9 span");
    //         if (!button.attr("data-clicked")) {
    //             button.attr("data-clicked", true);
    //             button.click(function () {
    //                 $("#accordion-flush-body-9").toggle();
    //                 const isExpanded =
    //                     button.attr("aria-expanded") === "true" || false;
    //                 button.attr("aria-expanded", !isExpanded);
    //             });
    //         }
    //     }
};

// ActiveMenuPanduan(1);

// Fungsi Collapse Arrow DIHIDE
// $("#active_title_jakpintas").on("click", "#arrow_jakpintas", function () {
//     $(".rotasi_open_jakpintas").toggleClass("rotate-180");
// });

// $("#active_title_login").on("click", "#arrow_login", function () {
//     $(".rotasi_open_login").toggleClass("rotate-180");
// });

// $("#active_title_layer").on("click", "#arrow_layer", function () {
//     $(".rotasi_open_layer").toggleClass("rotate-180");
// });

// $("#active_title_icon").on("click", "#arrow_icon", function () {
//     $(".rotasi_open_icon").toggleClass("rotate-180");
// });

// $("#active_title_form").on("click", "#arrow_form", function () {
//     $(".rotasi_open_form").toggleClass("rotate-180");
// });

// $("#active_title_chip").on("click", "#arrow_chip", function () {
//     $(".rotasi_open_chip").toggleClass("rotate-180");
// });

// $("#active_title_pustaka").on("click", "#arrow_pustaka", function () {
//     $(".rotasi_open_pustaka").toggleClass("rotate-180");
// });

// $("#active_title_navigasi").on("click", "#arrow_navigasi", function () {
//     $(".rotasi_open_navigasi").toggleClass("rotate-180");
// });

// $("#active_title_video").on("click", "#arrow_video", function () {
//     $(".rotasi_open_video").toggleClass("rotate-180");
// });

const ArrowActiveMenuPanduan = (param) => {
    // Menu Jakpintas
    if (param == 1) {
        $(".active_jakpintas").addClass("text-blue-500");

        // Set warna aktif pada sub menu
        $("#sub_active_jakpintas").on("click", ".sub_jakpintas", function () {
            $("#sub_active_jakpintas .sub_jakpintas.text-blue-500").removeClass(
                "text-blue-500"
            );
            $("#sub_active_jakpintas .sub_jakpintas").removeClass(
                "active_jakpintas"
            );
            $(this).addClass("text-blue-500");

            // Set menghapus warna aktif pada sub menu
            $(".sub_login").removeClass("text-blue-500");
            $(".sub_layer").removeClass("text-blue-500");
            $(".sub_icon").removeClass("text-blue-500");
            $(".sub_form").removeClass("text-blue-500");
            $(".sub_chip").removeClass("text-blue-500");
            $(".sub_pustaka").removeClass("text-blue-500");
            $(".sub_navigasi").removeClass("text-blue-500");
            $(".sub_video").removeClass("text-blue-500");

            // Konten yang akan ditampilkan
            $("#konten_jakpintas").show();
            $("#konten_login").hide();
            $("#konten_layer").hide();
            $("#konten_icon").hide();
            $("#konten_form").hide();
            $("#konten_chip").hide();
            $("#konten_pustaka").hide();
            $("#konten_navigasi").hide();
            $("#konten_video").hide();

            // Memutar video
            $(".video_jakpintas video").each(function () {
                this.pause();
            });
        });

        // Fungsi Button Collapse
        $(".hide_show_panduan_jakpintas").removeClass("hidden");
        $(".rotasi_open_jakpintas").toggleClass("rotate-180");
        const button = $("#accordion-1");
        if (!button.attr("data-clicked")) {
            button.attr("data-clicked", true);
            button.click(function () {
                $("#accordion-flush-body-1").toggle();

                const isExpanded =
                    button.attr("aria-expanded") === "true" || false;
                button.attr("aria-expanded", !isExpanded);
            });
        }
    }
    // Menu Login
    else if (param == 2) {
        // Set warna aktif pada sub menu
        // $(".active_login").addClass("text-blue-500");

        $("#sub_active_login").on("click", ".sub_login", function () {
            $("#sub_active_login .sub_login.text-blue-500").removeClass(
                "text-blue-500"
            );
            $("#sub_active_login .sub_login").removeClass("active_login");
            $(this).addClass("text-blue-500");

            // Set menghapus warna aktif pada sub menu
            $(".sub_jakpintas").removeClass("text-blue-500");
            $(".sub_layer").removeClass("text-blue-500");
            $(".sub_icon").removeClass("text-blue-500");
            $(".sub_form").removeClass("text-blue-500");
            $(".sub_chip").removeClass("text-blue-500");
            $(".sub_pustaka").removeClass("text-blue-500");
            $(".sub_navigasi").removeClass("text-blue-500");
            $(".sub_video").removeClass("text-blue-500");

            $("#sub_active_jakpintas .sub_jakpintas.text-blue-500").removeClass(
                "text-blue-500"
            );
            $("#sub_active_layer .sub_layer.text-blue-500").removeClass(
                "text-blue-500"
            );
            $("#sub_active_icon .sub_icon.text-blue-500").removeClass(
                "text-blue-500"
            );
            $("#sub_active_form .sub_form.text-blue-500").removeClass(
                "text-blue-500"
            );
            $("#sub_active_chip .sub_chip.text-blue-500").removeClass(
                "text-blue-500"
            );
            $("#sub_active_pustaka .sub_pustaka.text-blue-500").removeClass(
                "text-blue-500"
            );
            $("#sub_active_navigasi .sub_navigasi.text-blue-500").removeClass(
                "text-blue-500"
            );
            $("#sub_active_video .sub_video.text-blue-500").removeClass(
                "text-blue-500"
            );

            // Set warna aktif pada sub menu
            $("#active_title_jakpintas").removeClass("text-blue-500");
            $("#active_title_layer").removeClass("text-blue-500");
            $("#active_title_icon").removeClass("text-blue-500");
            $("#active_title_form").removeClass("text-blue-500");
            $("#active_title_chip").removeClass("text-blue-500");
            $("#active_title_pustaka").removeClass("text-blue-500");
            $("#active_title_navigasi").removeClass("text-blue-500");
            $("#active_title_video").removeClass("text-blue-500");

            // Konten yang akan ditampilkan
            $("#konten_login").show();
            $("#konten_jakpintas").hide();
            $("#konten_layer").hide();
            $("#konten_icon").hide();
            $("#konten_form").hide();
            $("#konten_chip").hide();
            $("#konten_pustaka").hide();
            $("#konten_navigasi").hide();
            $("#konten_video").hide();

            // Memutar video
            $(".video_jakpintas video").each(function () {
                this.pause();
            });
        });

        $(".hide_show_panduan_login").removeClass("hidden");
        $(".rotasi_open_login").toggleClass("rotate-180");
        const button = $("#accordion-2");
        if (!button.attr("data-clicked")) {
            button.attr("data-clicked", true);
            button.click(function () {
                $("#accordion-flush-body-2").toggle();

                const isExpanded =
                    button.attr("aria-expanded") === "true" || false;
                button.attr("aria-expanded", !isExpanded);
            });
        }
    }
    // Menu Layer
    else if (param == 3) {
        // Set warna aktif pada sub menu
        // $(".active_layer").addClass("text-blue-500");

        $("#sub_active_layer").on("click", ".sub_layer", function () {
            $("#sub_active_layer .sub_layer.text-blue-500").removeClass(
                "text-blue-500"
            );
            $("#sub_active_layer .sub_layer").removeClass("active_layer");
            $(this).addClass("text-blue-500");

            // Set menghapus warna aktif pada sub menu
            $(".sub_jakpintas").removeClass("text-blue-500");
            $(".sub_login").removeClass("text-blue-500");
            $(".sub_icon").removeClass("text-blue-500");
            $(".sub_form").removeClass("text-blue-500");
            $(".sub_chip").removeClass("text-blue-500");
            $(".sub_pustaka").removeClass("text-blue-500");
            $(".sub_navigasi").removeClass("text-blue-500");
            $(".sub_video").removeClass("text-blue-500");

            $("#sub_active_jakpintas .sub_jakpintas").removeClass(
                "text-blue-500"
            );
            $("#sub_active_login .sub_login").removeClass("text-blue-500");
            $("#sub_active_icon .sub_icon").removeClass("text-blue-500");
            $("#sub_active_form .sub_form").removeClass("text-blue-500");
            $("#sub_active_chip .sub_chip").removeClass("text-blue-500");
            $("#sub_active_pustaka .sub_pustaka").removeClass("text-blue-500");
            $("#sub_active_navigasi .sub_navigasi").removeClass(
                "text-blue-500"
            );
            $("#sub_active_video .sub_video").removeClass("text-blue-500");

            // Set menghapus warna aktif pada title
            $("#active_title_jakpintas").removeClass("text-blue-500");
            $("#active_title_login").removeClass("text-blue-500");
            $("#active_title_icon").removeClass("text-blue-500");
            $("#active_title_form").removeClass("text-blue-500");
            $("#active_title_chip").removeClass("text-blue-500");
            $("#active_title_pustaka").removeClass("text-blue-500");
            $("#active_title_navigasi").removeClass("text-blue-500");
            $("#active_title_video").removeClass("text-blue-500");

            // Konten yang akan ditampilkan
            $("#konten_layer").show();
            $("#konten_jakpintas").hide();
            $("#konten_login").hide();
            $("#konten_icon").hide();
            $("#konten_form").hide();
            $("#konten_chip").hide();
            $("#konten_pustaka").hide();
            $("#konten_navigasi").hide();
            $("#konten_video").hide();

            // Memutar video
            $(".video_jakpintas video").each(function () {
                this.pause();
            });
        });

        $(".hide_show_panduan_layer").removeClass("hidden");
        $(".rotasi_open_layer").toggleClass("rotate-180");
        const button = $("#accordion-3");
        if (!button.attr("data-clicked")) {
            button.attr("data-clicked", true);
            button.click(function () {
                $("#accordion-flush-body-3").toggle();

                const isExpanded =
                    button.attr("aria-expanded") === "true" || false;
                button.attr("aria-expanded", !isExpanded);
            });
        }
    }
    // Menu Icon
    else if (param == 4) {
        // Set warna aktif pada sub menu
        // $(".active_icon").addClass("text-blue-500");
        $("#sub_active_icon").on("click", ".sub_icon", function () {
            $("#sub_active_icon .sub_icon.text-blue-500").removeClass(
                "text-blue-500"
            );
            $("#sub_active_icon .sub_icon").removeClass("active_icon");
            $(this).addClass("text-blue-500");

            // Set menghapus warna aktif pada sub menu
            $(".sub_jakpintas").removeClass("text-blue-500");
            $(".sub_login").removeClass("text-blue-500");
            $(".sub_layer").removeClass("text-blue-500");
            $(".sub_form").removeClass("text-blue-500");
            $(".sub_chip").removeClass("text-blue-500");
            $(".sub_pustaka").removeClass("text-blue-500");
            $(".sub_navigasi").removeClass("text-blue-500");
            $(".sub_video").removeClass("text-blue-500");

            $("#sub_active_jakpintas .sub_jakpintas").removeClass(
                "text-blue-500"
            );
            $("#sub_active_login .sub_login").removeClass("text-blue-500");
            $("#sub_active_layer .sub_layer.text-blue-500").removeClass(
                "text-blue-500"
            );
            $("#sub_active_form .sub_form").removeClass("text-blue-500");
            $("#sub_active_chip .sub_chip").removeClass("text-blue-500");
            $("#sub_active_pustaka .sub_pustaka").removeClass("text-blue-500");
            $("#sub_active_navigasi .sub_navigasi").removeClass(
                "text-blue-500"
            );
            $("#sub_active_video .sub_video").removeClass("text-blue-500");

            // Set menghapus warna aktif pada title
            $("#active_title_jakpintas").removeClass("text-blue-500");
            $("#active_title_login").removeClass("text-blue-500");
            $("#active_title_layer").removeClass("text-blue-500");
            $("#active_title_form").removeClass("text-blue-500");
            $("#active_title_chip").removeClass("text-blue-500");
            $("#active_title_pustaka").removeClass("text-blue-500");
            $("#active_title_navigasi").removeClass("text-blue-500");
            $("#active_title_video").removeClass("text-blue-500");

            // Konten yang akan ditampilkan
            $("#konten_icon").show();
            $("#konten_jakpintas").hide();
            $("#konten_login").hide();
            $("#konten_layer").hide();
            $("#konten_form").hide();
            $("#konten_chip").hide();
            $("#konten_pustaka").hide();
            $("#konten_navigasi").hide();
            $("#konten_video").hide();

            // Memutar video
            $(".video_jakpintas video").each(function () {
                this.pause();
            });
        });

        $(".hide_show_panduan_icon").removeClass("hidden");
        $(".rotasi_open_icon").toggleClass("rotate-180");

        const button = $("#accordion-4");
        if (!button.attr("data-clicked")) {
            button.attr("data-clicked", true);
            button.click(function () {
                $("#accordion-flush-body-4").toggle();

                const isExpanded =
                    button.attr("aria-expanded") === "true" || false;
                button.attr("aria-expanded", !isExpanded);
            });
        }
    }
    // Menu Form
    else if (param == 5) {
        // Set warna aktif pada sub menu
        // $(".active_form").addClass("text-blue-500");

        $("#sub_active_form").on("click", ".sub_form", function () {
            $("#sub_active_form .sub_form.text-blue-500").removeClass(
                "text-blue-500"
            );
            $("#sub_active_form .sub_form").removeClass("active_form");
            $(this).addClass("text-blue-500");

            // Set menghapus warna aktif pada sub menu
            $(".sub_jakpintas").removeClass("text-blue-500");
            $(".sub_login").removeClass("text-blue-500");
            $(".sub_layer").removeClass("text-blue-500");
            $(".sub_icon").removeClass("text-blue-500");
            $(".sub_chip").removeClass("text-blue-500");
            $(".sub_pustaka").removeClass("text-blue-500");
            $(".sub_navigasi").removeClass("text-blue-500");
            $(".sub_video").removeClass("text-blue-500");

            $("#sub_active_jakpintas .sub_jakpintas").removeClass(
                "text-blue-500"
            );
            $("#sub_active_login .sub_login").removeClass("text-blue-500");
            $("#sub_active_layer .sub_layer.text-blue-500").removeClass(
                "text-blue-500"
            );
            $("#sub_active_icon .sub_icon").removeClass("text-blue-500");
            $("#sub_active_chip .sub_chip").removeClass("text-blue-500");
            $("#sub_active_pustaka .sub_pustaka").removeClass("text-blue-500");
            $("#sub_active_navigasi .sub_navigasi").removeClass(
                "text-blue-500"
            );
            $("#sub_active_video .sub_video").removeClass("text-blue-500");

            // Set menghapus warna aktif pada title
            $("#active_title_jakpintas").removeClass("text-blue-500");
            $("#active_title_login").removeClass("text-blue-500");
            $("#active_title_layer").removeClass("text-blue-500");
            $("#active_title_icon").removeClass("text-blue-500");
            $("#active_title_chip").removeClass("text-blue-500");
            $("#active_title_pustaka").removeClass("text-blue-500");
            $("#active_title_navigasi").removeClass("text-blue-500");
            $("#active_title_video").removeClass("text-blue-500");

            // Konten yang akan ditampilkan
            $("#konten_form").show();
            $("#konten_jakpintas").hide();
            $("#konten_login").hide();
            $("#konten_layer").hide();
            $("#konten_icon").hide();
            $("#konten_chip").hide();
            $("#konten_pustaka").hide();
            $("#konten_navigasi").hide();
            $("#konten_video").hide();

            // Memutar video
            $(".video_jakpintas video").each(function () {
                this.pause();
            });
        });

        $(".hide_show_panduan_form").removeClass("hidden");
        $(".rotasi_open_form").toggleClass("rotate-180");

        const button = $("#accordion-5");
        if (!button.attr("data-clicked")) {
            button.attr("data-clicked", true);
            button.click(function () {
                $("#accordion-flush-body-5").toggle();

                const isExpanded =
                    button.attr("aria-expanded") === "true" || false;
                button.attr("aria-expanded", !isExpanded);
            });
        }
    }
    // Menu Chip
    else if (param == 6) {
        // Set warna aktif pada sub menu
        // $(".active_chip").addClass("text-blue-500");

        $("#sub_active_chip").on("click", ".sub_chip", function () {
            $("#sub_active_chip .sub_chip.text-blue-500").removeClass(
                "text-blue-500"
            );
            $("#sub_active_chip .sub_chip").removeClass("active_chip");
            $(this).addClass("text-blue-500");

            // Set menghapus warna aktif pada sub menu
            $(".sub_jakpintas").removeClass("text-blue-500");
            $(".sub_login").removeClass("text-blue-500");
            $(".sub_layer").removeClass("text-blue-500");
            $(".sub_icon").removeClass("text-blue-500");
            $(".sub_form").removeClass("text-blue-500");
            $(".sub_pustaka").removeClass("text-blue-500");
            $(".sub_navigasi").removeClass("text-blue-500");
            $(".sub_video").removeClass("text-blue-500");

            $("#sub_active_jakpintas .sub_jakpintas.text-blue-500").removeClass(
                "text-blue-500"
            );
            $("#sub_active_login .sub_login.text-blue-500").removeClass(
                "text-blue-500"
            );
            $("#sub_active_layer .sub_layer.text-blue-500").removeClass(
                "text-blue-500"
            );
            $("#sub_active_icon .sub_icon.text-blue-500").removeClass(
                "text-blue-500"
            );
            $("#sub_active_form .sub_form.text-blue-500").removeClass(
                "text-blue-500"
            );
            $("#sub_active_pustaka .sub_pustaka.text-blue-500").removeClass(
                "text-blue-500"
            );
            $("#sub_active_navigasi .sub_navigasi.text-blue-500").removeClass(
                "text-blue-500"
            );
            $("#sub_active_video .sub_video.text-blue-500").removeClass(
                "text-blue-500"
            );

            // Set menghapus warna aktif pada title
            $("#active_title_jakpintas").removeClass("text-blue-500");
            $("#active_title_login").removeClass("text-blue-500");
            $("#active_title_layer").removeClass("text-blue-500");
            $("#active_title_icon").removeClass("text-blue-500");
            $("#active_title_form").removeClass("text-blue-500");
            $("#active_title_pustaka").removeClass("text-blue-500");
            $("#active_title_navigasi").removeClass("text-blue-500");
            $("#active_title_video").removeClass("text-blue-500");

            // Konten yang akan ditampilkan
            $("#konten_chip").show();
            $("#konten_jakpintas").hide();
            $("#konten_login").hide();
            $("#konten_layer").hide();
            $("#konten_icon").hide();
            $("#konten_form").hide();
            $("#konten_pustaka").hide();
            $("#konten_navigasi").hide();
            $("#konten_video").hide();

            // Memutar video
            $(".video_jakpintas video").each(function () {
                this.pause();
            });
        });

        $(".hide_show_panduan_chip").removeClass("hidden");
        $(".rotasi_open_chip").toggleClass("rotate-180");
        const button = $("#accordion-6");
        if (!button.attr("data-clicked")) {
            button.attr("data-clicked", true);
            button.click(function () {
                $("#accordion-flush-body-6").toggle();

                const isExpanded =
                    button.attr("aria-expanded") === "true" || false;
                button.attr("aria-expanded", !isExpanded);
            });
        }
    }
    // Menu Pustaka
    else if (param == 7) {
        // Set warna aktif pada sub menu
        // $(".active_pustaka").addClass("text-blue-500");
        $("#sub_active_pustaka").on("click", ".sub_pustaka", function () {
            $("#sub_active_pustaka .sub_pustaka.text-blue-500").removeClass(
                "text-blue-500"
            );
            $("#sub_active_pustaka .sub_pustaka").removeClass("active_pustaka");
            $(this).addClass("text-blue-500");

            // Set menghapus warna aktif pada sub menu
            $(".sub_jakpintas").removeClass("text-blue-500");
            $(".sub_login").removeClass("text-blue-500");
            $(".sub_layer").removeClass("text-blue-500");
            $(".sub_icon").removeClass("text-blue-500");
            $(".sub_form").removeClass("text-blue-500");
            $(".sub_chip").removeClass("text-blue-500");
            $(".sub_navigasi").removeClass("text-blue-500");
            $(".sub_video").removeClass("text-blue-500");

            $("#sub_active_jakpintas .sub_jakpintas").removeClass(
                "text-blue-500"
            );
            $("#sub_active_login .sub_login").removeClass("text-blue-500");
            $("#sub_active_layer .sub_layer.text-blue-500").removeClass(
                "text-blue-500"
            );
            $("#sub_active_icon .sub_icon").removeClass("text-blue-500");
            $("#sub_active_form .sub_form").removeClass("text-blue-500");
            $("#sub_active_chip .sub_chip").removeClass("text-blue-500");
            $("#sub_active_navigasi .sub_navigasi").removeClass(
                "text-blue-500"
            );
            $("#sub_active_video .sub_video").removeClass("text-blue-500");

            // // Set menghapus warna aktif pada title
            $("#active_title_jakpintas").removeClass("text-blue-500");
            $("#active_title_login").removeClass("text-blue-500");
            $("#active_title_layer").removeClass("text-blue-500");
            $("#active_title_icon").removeClass("text-blue-500");
            $("#active_title_form").removeClass("text-blue-500");
            $("#active_title_chip").removeClass("text-blue-500");
            $("#active_title_navigasi").removeClass("text-blue-500");
            $("#active_title_video").removeClass("text-blue-500");

            // Konten yang akan ditampilkan
            $("#konten_pustaka").show();
            $("#konten_jakpintas").hide();
            $("#konten_login").hide();
            $("#konten_layer").hide();
            $("#konten_icon").hide();
            $("#konten_form").hide();
            $("#konten_chip").hide();
            $("#konten_navigasi").hide();
            $("#konten_video").hide();

            // Memutar video
            $(".video_jakpintas video").each(function () {
                this.pause();
            });
        });

        $(".hide_show_panduan_pustaka").removeClass("hidden");
        $(".rotasi_open_pustaka").toggleClass("rotate-180");

        const button = $("#accordion-7");
        if (!button.attr("data-clicked")) {
            button.attr("data-clicked", true);
            button.click(function () {
                $("#accordion-flush-body-7").toggle();

                const isExpanded =
                    button.attr("aria-expanded") === "true" || false;
                button.attr("aria-expanded", !isExpanded);
            });
        }
    }
    // Menu Navigasi
    else if (param == 8) {
        // Set warna aktif pada sub menu
        // $(".active_navigasi").addClass("text-blue-500");

        $("#sub_active_navigasi").on("click", ".sub_navigasi", function () {
            $("#sub_active_navigasi .sub_navigasi.text-blue-500").removeClass(
                "text-blue-500"
            );
            $("#sub_active_navigasi .sub_navigasi").removeClass(
                "active_navigasi"
            );
            $(this).addClass("text-blue-500");

            // Set menghapus warna aktif pada sub menu
            $(".sub_jakpintas").removeClass("text-blue-500");
            $(".sub_login").removeClass("text-blue-500");
            $(".sub_layer").removeClass("text-blue-500");
            $(".sub_icon").removeClass("text-blue-500");
            $(".sub_form").removeClass("text-blue-500");
            $(".sub_chip").removeClass("text-blue-500");
            $(".sub_pustaka").removeClass("text-blue-500");
            $(".sub_video").removeClass("text-blue-500");

            $("#sub_active_jakpintas .sub_jakpintas").removeClass(
                "text-blue-500"
            );
            $("#sub_active_login .sub_login").removeClass("text-blue-500");
            $("#sub_active_layer .sub_layer.text-blue-500").removeClass(
                "text-blue-500"
            );
            $("#sub_active_icon .sub_icon").removeClass("text-blue-500");
            $("#sub_active_form .sub_form").removeClass("text-blue-500");
            $("#sub_active_chip .sub_chip").removeClass("text-blue-500");
            $("#sub_active_pustaka .sub_pustaka").removeClass("text-blue-500");
            $("#sub_active_video .sub_video").removeClass("text-blue-500");

            // Set menghapus warna aktif pada title
            $("#active_title_jakpintas").removeClass("text-blue-500");
            $("#active_title_login").removeClass("text-blue-500");
            $("#active_title_layer").removeClass("text-blue-500");
            $("#active_title_icon").removeClass("text-blue-500");
            $("#active_title_form").removeClass("text-blue-500");
            $("#active_title_chip").removeClass("text-blue-500");
            $("#active_title_pustaka").removeClass("text-blue-500");
            $("#active_title_video").removeClass("text-blue-500");

            // Konten yang akan ditampilkan
            $("#konten_navigasi").show();
            $("#konten_jakpintas").hide();
            $("#konten_login").hide();
            $("#konten_layer").hide();
            $("#konten_icon").hide();
            $("#konten_form").hide();
            $("#konten_chip").hide();
            $("#konten_pustaka").hide();
            $("#konten_video").hide();

            // Memutar video
            $(".video_jakpintas video").each(function () {
                this.pause();
            });
        });

        $(".hide_show_panduan_navigasi").removeClass("hidden");
        $(".rotasi_open_navigasi").toggleClass("rotate-180");

        const button = $("#accordion-8");
        if (!button.attr("data-clicked")) {
            button.attr("data-clicked", true);
            button.click(function () {
                $("#accordion-flush-body-8").toggle();

                const isExpanded =
                    button.attr("aria-expanded") === "true" || false;
                button.attr("aria-expanded", !isExpanded);
            });
        }
    }
    // Video
    else if (param == 9) {
        // Set warna aktif pada sub menu
        // $(".active_video").addClass("text-blue-500");

        $("#sub_active_video").on("click", ".sub_video", function () {
            $("#sub_active_video .sub_video.text-blue-500").removeClass(
                "text-blue-500"
            );
            $("#sub_active_video .sub_video").removeClass("active_video");
            $(this).addClass("text-blue-500");

            // Set menghapus warna aktif pada sub menu
            $(".sub_jakpintas").removeClass("text-blue-500");
            $(".sub_login").removeClass("text-blue-500");
            $(".sub_layer").removeClass("text-blue-500");
            $(".sub_icon").removeClass("text-blue-500");
            $(".sub_form").removeClass("text-blue-500");
            $(".sub_chip").removeClass("text-blue-500");
            $(".sub_pustaka").removeClass("text-blue-500");
            $(".sub_navigasi").removeClass("text-blue-500");
            // $(".sub_video").removeClass("text-blue-500");

            $("#sub_active_jakpintas .sub_jakpintas").removeClass(
                "text-blue-500"
            );
            $("#sub_active_login .sub_login").removeClass("text-blue-500");
            $("#sub_active_layer .sub_layer.text-blue-500").removeClass(
                "text-blue-500"
            );
            $("#sub_active_icon .sub_icon").removeClass("text-blue-500");
            $("#sub_active_form .sub_form").removeClass("text-blue-500");
            $("#sub_active_chip .sub_chip").removeClass("text-blue-500");
            $("#sub_active_pustaka .sub_pustaka").removeClass("text-blue-500");
            $("#sub_active_navigasi .sub_navigasi").removeClass(
                "text-blue-500"
            );

            // Set menghapus warna aktif pada title
            $("#active_title_jakpintas").removeClass("text-blue-500");
            $("#active_title_login").removeClass("text-blue-500");
            $("#active_title_layer").removeClass("text-blue-500");
            $("#active_title_icon").removeClass("text-blue-500");
            $("#active_title_form").removeClass("text-blue-500");
            $("#active_title_chip").removeClass("text-blue-500");
            $("#active_title_pustaka").removeClass("text-blue-500");
            $("#active_title_navigasi").removeClass("text-blue-500");

            // Konten yang akan ditampilkan
            $("#konten_video").show();
            $("#konten_jakpintas").hide();
            $("#konten_login").hide();
            $("#konten_layer").hide();
            $("#konten_icon").hide();
            $("#konten_form").hide();
            $("#konten_chip").hide();
            $("#konten_pustaka").hide();
            $("#konten_navigasi").hide();

            // Memutar video
            // $("#Video1 video")[0].addEventListener("ended", function () {
            //     $("#Video2 video")[0].play();
            // });
            // $("#Video2 video")[0].addEventListener("ended", function () {
            //     $("#Video3 video")[0].play();
            // });
            // $("#Video1 video")[0].play();

            $(".video_jakpintas video").each(function () {
                this.pause();
            });
        });

        $(".hide_show_panduan_video").removeClass("hidden");
        $(".rotasi_open_video").toggleClass("rotate-180");

        const button = $("#accordion-9");
        if (!button.attr("data-clicked")) {
            button.attr("data-clicked", true);
            button.click(function () {
                $("#accordion-flush-body-9").toggle();

                const isExpanded =
                    button.attr("aria-expanded") === "true" || false;
                button.attr("aria-expanded", !isExpanded);
            });
        }
    }
};
