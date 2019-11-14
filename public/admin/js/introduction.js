let contents = '';

function loadData() {
    $.ajax({
        async: false,
        type: "GET",
        url: base_url + 'admin/introduction/getAllContents',
        dataType: "json",
        success: function(json) {
            contents = json
        },

        error: function(xhr, ajaxOptions, thrownError) {
            alert(xhr.status);
            alert(thrownError);
        }
    });
}

var DatatablesDataSourceHtml = function() {

    var initTable1 = function() {
        var table = $('#tbl_contents');
        loadData()


        // begin first table
        let oTable = table.DataTable({
            responsive: true,
            data: contents,
            columns: [
                { "data": "no" },
                { "data": "category" },
                { "data": "source_url" },
                { "data": "thumb_url" },
                { "data": "actions" },
            ],
            columnDefs: [{
                    targets: -1,
                    orderable: false,
                    render: function(data, type, full, meta) {
                        return `
                        <a href="#" class="edit btn m-btn m-btn--hover-brand m-btn--icon m-btn--icon-only m-btn--pill" data-toggle="modal"  data-target="#m_modal" aria-expanded="true" title="Edit">
                            <i class="la la-edit"></i>
                        </a>`;
                    },
                },
                {
                    targets: 1,
                    render: function(data, type, full, meta) {
                        if (data == 0) {
                            return 'Home';
                        } else {
                            let i = 0;
                            categories.map(cate => {
                                cate['id'] == data ? data = i : '';
                                i++;
                            });
                            if (typeof categories[data] === 'undefined') {
                                return data;
                            }
                            return categories[data]['name'];

                        }
                    },
                }
            ],
        });

        table.on('click', 'tr', function(e) {
            if (oTable.row(this).data()) {
                $("#m_frm").trigger("reset");
                $(".modal-title").text('Edit Content');

                $("#edit_id").val(oTable.row(this).data().DT_RowId);

                var row_data = oTable.row(this).data();
                $("#source_file").attr("accept", "video/*");
                $("#url_row").css("display", "flex");
                $("#file_row").css("display", "none");

                $("#category").val(row_data.category);
                $("#category_id").val(row_data.category);
                $("#source_url").val(row_data.source_url);
                $("#thumb_url").val(row_data.thumb_url);
            }
        });
    };

    return {
        //main function to initiate the module
        init: function() {
            initTable1();
        },

    };
}();

jQuery(document).ready(function($) {
    DatatablesDataSourceHtml.init();

    $("#m_tree_category").jstree({
        "core": {
            "themes": {
                "responsive": false
            },
            // so that create works
            "check_callback": true,
            'data': categories,
        },
        "types": {
            "default": {
                "icon": "fa fa-file m--font-success"
            },
            "file": {
                "icon": "fa fa-file  m--font-success"
            }
        },
        "state": { "key": "state_category_node" },
        "plugins": ["state", "checkbox", "types"],
    })

    $("input[name='source']").click(function() {

        if ($(this).val() == 1) {
            $(".url_row").css("display", "flex")
            $(".file_row").css("display", "none")
        } else {
            $(".url_row").css("display", "none")
            $(".file_row").css("display", "flex")
        }
    })

    $("#btn_source_file").click(function() {
        $("#source_file").click()
    })

    $("#btn_thumb_file").click(function() {
        $("#thumb_file").click()
    })

    $("#type").change(function() {
        if ($(this).val() == 1)
            $("#source_file").attr("accept", "video/*")
        else
            $("#source_file").attr("accept", "application/pdf")
    })

    $("#m_frm").validate({
        // define validation rules
        rules: {
            source_url: {
                required: function(element) {
                    if ($("input[name='source']:checked").val() == 1)
                        return true;
                    else
                        return false;
                },
            },
            source_file: {
                required: function(element) {
                    if ($("input[name='source']:checked").val() == 2)
                        return true;
                    else
                        return false;
                }
            }
        },

        //display error alert on form submit  
        invalidHandler: function(event, validator) {
            var alert = $('#m_frm_msg');
            alert.removeClass('m--hide').show();
            mUtil.scrollTop();
        },

        submitHandler: function(form) {
            let formData = new FormData(form);
            $.ajax({
                type: "POST",
                url: base_url + 'admin/introduction/saveData',
                data: formData,
                async: false,
                processData: false,
                contentType: false,
                dataType: "json",
                success: function(response) {
                    if (response) {
                        document.location.reload(true);
                    }
                },
                error: function(error) {
                    console.log(error);
                }
            });
            return false;
        }
    });
    $("#m_frm_submit").click(function() {
        $("#m_frm").submit()
    });

    $("#upload_content").click(function() {
        $(".modal-title").text('Upload Content');
        $("#m_frm").trigger("reset");
    })
});