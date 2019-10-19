var DatatablesDataSourceHtml = function() {

	var initTable1 = function() {
		var table = $('#tbl_users');

		// begin first table
		let oTable=table.DataTable({
            responsive: true,
            searching: false,
            lengthChange: false,
			columnDefs: [
				{
					targets: -1,
					title: 'actions',
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
			],
        });

        table.on( 'click', 'tr', function (e) {
            $("#m_frm").trigger("reset");
            $(".modal-title").text('Edit Feature');

            $("#edit_id").val(oTable.row( this ).data().DT_RowId)
            
            var row_data = oTable.row( this ).data();
            console.log(row_data)
            $("#feature_name").val(row_data[1])
            $("#feature_description").val(row_data[2])
            $("#feature_tag").val(row_data[3])
        });

        table.on('click', '.delete', function(e) {
            e.preventDefault();

            if (confirm("Are you sure to delete this row ?") == false) {
                return false;
            }
            let nRow = $(this).parents('tr')[0];
            let id=nRow.getAttribute("id")

            if (id) {
                $.ajax({
                    type: "POST",
                    url: base_url + 'admin/features/deleteFeature',
                    data: {id:id},
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
    $("#tbl_users_filter").attr("align","right");
    $("#tbl_users_filter label").css("text-align","left");

    $("#m_frm").validate({
        // define validation rules
        rules: {
            feature_name: {
                required: true,
            },
        },
        
        //display error alert on form submit  
        invalidHandler: function(event, validator) {     
            var alert = $('#m_frm_msg');
            alert.removeClass('m--hide').show();
            mUtil.scrollTop();
        },

        submitHandler: function (form) {
            let data={
                id:$("#edit_id").val(),
                name:$("#feature_name").val(),
                description:$("#feature_description").val(),
                tag:$("#feature_tag").val(),
            }

            $.ajax({
                type: "POST",
                url: base_url + 'admin/features/saveData',
                data: data,
                async: false,
                dataType: "json",
                success: function(response) {
                    if (response) {
                        document.location.reload(true);
                    }
                },
                error: function() {}
            });

            return false;
        }
    });
    $("#m_frm_submit").click(function(){
        $( "#m_frm" ).submit()
    });
    $("#new_feature").click(function(){
        $(".modal-title").text('Add Feature');
        $("#m_frm").trigger("reset");
    })
});