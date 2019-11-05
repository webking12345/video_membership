var DatatablesDataSourceHtml = function() {

	var initTable1 = function() {
		var table = $('#tbl_levels');

		// begin first table
		let oTable=table.DataTable({
            responsive: true,
            searching: false,
            lengthChange: false,
            info: false,
            paging: false,
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
            $(".modal-title").text('Edit Level');

            $("#edit_id").val(oTable.row( this ).data().DT_RowId)
            
            var row_data = oTable.row( this ).data();
            $("#name").val(row_data[1])
            $("#timeline").val(row_data[2])
            $("#price").val(row_data[3])
            $("#description").val(row_data[4])
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
                    url: base_url + 'admin/membership/deleteLevel',
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
    
    var initTable2 = function() {
		var table = $('#tbl_membership');

        let columnDefs=[];
        for(i=1;i<=features.length;i++)
        {
            columnDefs.push({
                targets: i,
                render: function(data, type, full, meta) {
                    var status = {
                        0: "",
                        1: "checked",
                    };
                    if (typeof status[data] === 'undefined') {
                        return data;
                    }
                    return '<label class="check m-checkbox m-checkbox--single m-checkbox--solid m-checkbox--success"><input type="checkbox" value="" ' + status[data] + ' class="m-checkable"><span></span></label>';
                },
            })
        }

		// begin first table
		let oTable=table.DataTable({
            responsive: true,
            searching: false,
            info: false,
            sort : false,
            paging: false,
            lengthChange: false,
			columnDefs: columnDefs
        });

        table.on( 'click', 'tr', function (e) {
        });

        table.on('click', '.check', function(e) {
            e.preventDefault();
            let cell = $(this).parents('td')[0];
            let id=cell.getAttribute("id")

            //set checkbox
            let checkbox=$($(cell).children().children()[0]);
            if(typeof(checkbox.attr("checked"))==="undefined")
                checkbox.attr("checked","checked");
            else
                checkbox.removeAttr("checked");

            if (id!='') {
                $.ajax({
                    type: "POST",
                    url: base_url + 'admin/membership/updateMembership',
                    data: {id:id},
                    async: true,
                    dataType: "json",
                    success: function(response) {
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
            initTable2();
		},

	};
}();

jQuery(document).ready(function($) {
    DatatablesDataSourceHtml.init();

    $("#m_frm").validate({
        // define validation rules
        rules: {
            name: {
                required: true,
            },
            timeline: {
                required: true,
                number: true,
            },
            price: {
                number:true
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
                name:$("#name").val(),
                timeline:$("#timeline").val(),
                price:$("#price").val(),
                description:$("#description").val(),
            }

            $.ajax({
                type: "POST",
                url: base_url + 'admin/membership/saveLevel',
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
    
    $("#new_level").click(function(){
        $(".modal-title").text('Add Level');
        $("#edit_id").val(0)
        $("#m_frm").trigger("reset");
    })
});