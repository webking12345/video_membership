let contents = '';

function loadData() {
    $.ajax({
        async: false,
        type: "GET",
        url: base_url + 'admin/contents/getAllContents',
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
                { "data": "type" },
                { "data": "category" },
                { "data": "title" },
                { "data": "description" },
                { "data": "description2" },
                { "data": "duration" },
                { "data": "price" },
                { "data": "size" },
                { "data": "date" },
                { "data": "source_url", "visible": false },
                { "data": "thumb_url", "visible": false },
                { "data": "actions" },
            ],
            columnDefs: [{
                    targets: -1,
                    orderable: false,
                    render: function(data, type, full, meta) {
                        return `
                        <a href="#" class="edit btn m-btn m-btn--hover-brand m-btn--icon m-btn--icon-only m-btn--pill" data-toggle="modal"  data-target="#m_modal" aria-expanded="true" title="Edit">
                            <i class="la la-edit"></i>
                        </a>
                        <a href="#" class="delete m-portlet__nav-link btn m-btn m-btn--hover-brand m-btn--icon m-btn--icon-only m-btn--pill" title="Delete">
                          <i class="la la-remove"></i>
                        </a>`;
                    },
                },
                {
                    targets: 1,
                    render: function(data, type, full, meta) {
                        var status = {
                            1: { 'title': 'Video', 'class': 'm-badge--info' },
                            2: { 'title': 'PDF', 'class': ' m-badge--warning' },
                        };
                        if (typeof status[data] === 'undefined') {
                            return data;
                        }
                        return '<span class="m-badge ' + status[data].class + ' m-badge--wide">' + status[data].title + '</span>';
                    },
                },
                {
                    targets: 2,
                    render: function(data, type, full, meta) {
                        Object.keys(categories).map(function(cate) {
                            cate['id'] == data ? data = cate['id'] : '';
                        });

                        if (typeof categories[data] === 'undefined') {
                            return data;
                        }
                        return categories[data]['name'];
                    },
                },
                {
                    targets: 7,
                    render: function(data, type, full, meta) {
                        return "$ " + data;
                    },
                },
            ],
        });

        table.on('click', 'tr', function(e) {
            if (oTable.row(this).data()) {
                $("#m_frm").trigger("reset");
                $(".modal-title").text('Edit Content');

                $("#edit_id").val(oTable.row(this).data().DT_RowId);

                var row_data = oTable.row(this).data();
                $("#title").val(row_data.title);
                $("#type").val(row_data.type);

                if (row_data.type == 1)
                    $("#source_file").attr("accept", "video/*");
                else
                    $("#source_file").attr("accept", "application/pdf");

                $("#url_row").css("display", "flex");
                $("#file_row").css("display", "none");

                $("#category").val(row_data.category);
                $("#description").val(row_data.description);
                $("#description2").val(row_data.description2);
                $("#price").val(row_data.price);
                $("#source_url").val(row_data.source_url);
                $("#thumb_url").val(row_data.thumb_url);
                $("#duration").val(row_data.duration);
                $("#size").val(parseInt(row_data.size));
            }
        });

        table.on('click', '.delete', function(e) {
            e.preventDefault();

            if (confirm("Are you sure to delete this row ?") == false) {
                return false;
            }
            let nRow = $(this).parents('tr')[0];

            if (nRow.classList.contains("child"))
                nRow = nRow.previousSibling

            let id = nRow.getAttribute("id")
            if (id) {
                $.ajax({
                    type: "POST",
                    url: base_url + 'admin/contents/deleteData',
                    data: { id: id },
                    async: false,
                    dataType: "json",
                    success: function(response) {
                        if (response) {
                            document.location.reload(true);
                        }
                    },
                    error: function() {}
                });
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
            title: {
                required: true,
            },
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
            },
            category: {
                required: true,
            },
            price: {
                required: true,
                number: true
            },
            size: {
                number: true
            },
        },

        //display error alert on form submit  
        invalidHandler: function(event, validator) {
            var alert = $('#m_frm_msg');
            alert.removeClass('m--hide').show();
            mUtil.scrollTop();
        },

        submitHandler: function(form) {
            let formData = new FormData(form)
            $.ajax({
                type: "POST",
                url: base_url + 'admin/contents/saveData',
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