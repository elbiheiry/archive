(function () {
//console.log('ajax');
    /***************************************************************************
     * AJAX Setup for processing
     ***************************************************************************/
    //var baseUrl = '/tourism';
    var csrf = new FormData($('#csrf')[0]);
    var loading = $('#loading').html();

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });

    //select type
    $('#select-type').on('change' ,function () {
       if ($(this).val() == 'senior' || $(this).val() == 'user'){
           $('#select-category').removeClass('hidden');
       }
    });

    //file status date
    $('#file-status').on('change' ,function () {
       if ($(this).val() == 'يحتاج الي متابعه'){
           $('#file-status-date').removeClass('hidden');
       }else{
           $('#file-status-date').addClass('hidden');
       }
    });


    /***************************************************************************
     * Common Ajax Delete Section
     **************************************************************************/

    $(document).on('click', ".ajax-delete", function (e) {
        e.preventDefault();
        var $this = $(this);
        var url = $this.data('url');
        var originalHtml = $this.html();
        var altText = loading;
        var notification = 'm';
        if ($this.data('loading') !== undefined) {
            altText = $this.data('loading');
        }
        $this.prop('disabled', true).html(altText);
        request(url, csrf, function (result) {
            // notify(result.status, result.title, result.msg, notification);
            $this.prop('disabled', false).html(originalHtml);
            $this.closest('.ajax-target').remove();

        }, function () {
            alert('Internal Server Error.');
        });
    });


// --------------------------Trigger File upload browsing Section ---------------------------
    $(document).on('click', '.btn-product-image', function () {
        var btn = $(this);
        var uploadInp = btn.next('input[type=file]');
        uploadInp.change(function () {
            if (validateImgFile(this)) {
                btn.html('');
                previewURL(btn, this);
            }
        }).click();
    });

    function previewURL(btn, input) {
        if (input.files && input.files[0]) {
            // collecting the file source
            var file = input.files[0];
            // preview the image
            var reader = new FileReader();
            reader.onload = function (e) {
                var src = e.target.result;
                btn.attr('src', src);
            };
            reader.readAsDataURL(file);
        }
    }
    //validating the file
    function validateImgFile(input) {
        if (input.files && input.files[0]) {
            // collecting the file source
            var file = input.files[0];
            // validating the image name
            if (file.name.length < 1) {
                alert("The file name couldn't be empty");
                return false;
            }
            // validating the image size
            else if (file.size > 20000000) {
                alert("The file is too big");
                return false;
            }

            return true;
        }
    }

    /***************************************************************************
     * Modal View Modal
     **************************************************************************/

    $(document).on('click', '.btn-modal-view', function () {
        var $this = $(this);
        var url = $this.data('url');
        var data_lang = "lang=" + $this.data('lang');
        if ($this.find('.tiny-editor').length) {
            for (var i = 0; i < tinymce.editors.length; i++) {
                formData.append('editor' + (i + 1), tinymce.editors[i].getContent());
            }
        }

        var originalHtml = $this.html();
        //$this.prop('disabled', true).html('loading...');
        request(url, data_lang, function (data) {
            $this.prop('disabled', false).html(originalHtml);
            $('#common-modal').html(data).modal('toggle');
        }, function () {
            alert('Error');
        }, 'get');
    });

    //////////////////////////////////
    /***************************************************************************
     * Custom logging function
     * @param mixed data
     * @returns void
     **************************************************************************/
    function _(data) {
        console.log(data);
    }

    var AddModalBtn = $('.addBTN');

    AddModalBtn.on('click', function () {
        var AddModalForm = $(this).closest('form');
        var formData = new FormData(AddModalForm[0]);

        AddModalForm.addClass('disabled');
        $('.fa-spin').css('display' , 'inline-block');

        if (typeof tinymce !== "undefined" && tinymce.editors.length) {
            for (var i = 0; i < tinymce.editors.length; i++) {
                formData.append('desc' + (i + 1), tinymce.editors[i].getContent());
            }
        }

        request(AddModalForm.attr('action'), formData,
        // on request success handler
            function (result) {
                AddModalForm.removeClass('disabled');
                $('.fa-spin').css('display' , 'none');
                if (result.status === 'success') {
                    swal({title: "نجاح", text: result.data, type: "success"}, function () {
                        location.reload(true);
                    });
                } else {
                    swal('خطا', result.data, 'error');
                }
            },

            // on request failure handler
                    function () {
                        AddModalForm.removeClass('disabled');
                        $('.fa-spin').css('display' , 'none');
                        alert('Internal Server Error.');
                    }, function (e) {

                var videoProgress = $('.progress-bar');

                var progress = Math.round(e.loaded / e.total * 100);
                videoProgress.css('width', progress + '%');
            });
        });

        $('.btndelet').click(function (e) {

            var txt = $('#template-modal').html();
            var url = $(this).attr('data-url');
            txt = txt.replace(new RegExp('{url}', 'g'), url);
            $('#delete-modal .modal-dialog').html(txt);
            $('#delete-modal').modal('show');
            e.preventDefault()
        });

        /***************************************************************************
         * Search input events for filtered table
         **************************************************************************/
        var tableData = $('#ajax-table');
        $(document).on('click', '#ajax-table .pagination a', function (e) {
            var $this = $(this);
            tableData.html(loading);
            $.ajax({
                url: $this.attr('href'),
            }).done(function (data) {
                tableData.html(data);
            }).fail(function () {
                alert('Internal Server Error.');
            });
            e.preventDefault();
        });
        var inputSearch = $('#input-search');
        $(document).on('click', '.btn-search', function () {
            var form = $(this).closest('form');
            var search = (inputSearch.val().length) ? "/" + inputSearch.val() : "";
            tableData.html(loading);
            request(form.attr('action') + "/search" + search, null, function (data) {
                tableData.html(data);
            }, function () {
                alert('Internal Server Error');
            }, 'get');
        });
        /**************************************************************************
         * Actions Of Filters Buttons
         ***************************************************************************/

        $(document).on('change', '.btn-filter', function () {
            var $this = $(this);
            var filter = $this.data('filter');
            tableData.html(loading);
            var form = $this.closest('form');
            request(form.attr('action') + "/filter/" + filter, null, function (data) {
                tableData.html(data);
            }, function () {
                alert('Internal Server Error.');
            }, 'get');
        });
        /**************************************************************************
         * Events Action Buttons for the tables
         **************************************************************************/

        $(document).on('click', '.btn-action', function (e) {
            var $this = $(this);
            var action = $this.data('action');
            var form = $this.closest('form');
            request(form.attr('action') + "/action/" + action, new FormData(form[0]), function (data) {
                if (data.status === 'success') {
                    notify(data.status, data.title, data.msg, function () {
                        $('input[data-filter=all]').change();
                    });
                } else {
                    notify(data.status, data.title, data.msg);
                }
            }, function () {
                alert('Internal Server Error.');
            });
            e.preventDefault();
        });

        /***************************************************************************
         * Check ALL Button For Table Rows
         ***************************************************************************/

        $(document).on('click', '#chk-all', function () {
            $('.chk-box').prop('checked', this.checked);
        });

        ///////////////////////////////////// End Admin Panel Ajax  ////////////////////////////////////////

        //////////////////////////////////////// Site Ajax  //////////////////////////////////////////////////


        /***************************************************************************
         * Custom Ajax request function
         * @param string url
         * @param mixed|FormData data
         * @param callable(data) completeHandler
         * @param callable errorHandler
         * @param callable progressHandler
         * @returns void
         **************************************************************************/
        function _(data) {
            console.log(data);
        }


        function request(url, data, completeHandler, errorHandler, progressHandler) {
            if (typeof progressHandler === 'string' || progressHandler instanceof String) {
                method = progressHandler;
            } else {
                method = "POST"
            }

            $.ajax({
                url: url, //server script to process data
                type: method,
                xhr: function () {  // custom xhr
                    myXhr = $.ajaxSettings.xhr();
                    if (myXhr.upload && $.isFunction(progressHandler)) { // if upload property exists
                        myXhr.upload.addEventListener('progress', progressHandler, false); // progressbar
                    }
//                                console.log(myXhr);
                    return myXhr;
                },
                // Ajax events
                success: completeHandler,
                error: errorHandler,
                // Form data
                data: data,
                // Options to tell jQuery not to process data or worry about the content-type
                cache: false,
                contentType: false,
                processData: false
            }, 'json');
        }

        /***************************************************************************
         * identify Tinymce
         **************************************************************************/
        if (typeof tinymce !== "undefined") {
            /*Text area Editors
             =========================*/

            tinymce.init({
                selector: '.tiny-editor',
                height: 350,
                theme: 'modern',
                menubar: 'tools',
                plugins: [
                    'advlist autolink lists link image charmap print preview anchor',
                    'searchreplace visualblocks code fullscreen',
                    'insertdatetime media table contextmenu paste code',
                    'code'
                ],
                fontsize_formats: "8pt 10pt 12pt 14pt 18pt 24pt 36pt",
                toolbar: 'undo redo | code | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image |sizeselect | bold italic | fontselect |  fontsizeselect',
                // enable title field in the Image dialog
                image_title: true,
                // enable automatic uploads of images represented by blob or data URIs
                automatic_uploads: true,
                // here we add custom filepicker only to Image dialog
                file_picker_types: 'image',
                file_picker_callback: function(cb, value, meta) {
                    var input = document.createElement('input');
                    input.setAttribute('type', 'file');
                    input.setAttribute('accept', 'image/*');

                    // Note: In modern browsers input[type="file"] is functional without
                    // even adding it to the DOM, but that might not be the case in some older
                    // or quirky browsers like IE, so you might want to add it to the DOM
                    // just in case, and visually hide it. And do not forget do remove it
                    // once you do not need it anymore.

                    input.onchange = function() {
                        var file = this.files[0];

                        var reader = new FileReader();
                        reader.onload = function () {
                            // Note: Now we need to register the blob in TinyMCEs image blob
                            // registry. In the next release this part hopefully won't be
                            // necessary, as we are looking to handle it internally.
                            var id = 'blobid' + (new Date()).getTime();
                            var blobCache =  tinymce.activeEditor.editorUpload.blobCache;
                            var base64 = reader.result.split(',')[1];
                            var blobInfo = blobCache.create(id, file, base64);
                            blobCache.add(blobInfo);

                            // call the callback and populate the Title field with the file name
                            cb(blobInfo.blobUri(), { title: file.name });
                        };
                        reader.readAsDataURL(file);
                    };

                    input.click();
                },
                content_css: '//www.tinymce.com/css/codepen.min.css'
            });


        }
    })();

