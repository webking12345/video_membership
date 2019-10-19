var DatatablesDataSourceHtml = function() {

	var initTable1 = function() {
		var table = $('#tbl_users');

		// begin first table
		let oTable=table.DataTable({
			responsive: true,
			columnDefs: [
				{
					targets: -1,
					title: 'actions',
					orderable: false,
					render: function(data, type, full, meta) {
						return `
                        <a href="#" class="edit btn m-btn m-btn--hover-brand m-btn--icon m-btn--icon-only m-btn--pill" data-toggle="modal"  data-target="#m_modal_user" aria-expanded="true" title="Edit">
                            <i class="la la-edit"></i>
                        </a>
                        <a href="#" class="delete m-portlet__nav-link btn m-btn m-btn--hover-brand m-btn--icon m-btn--icon-only m-btn--pill" title="Delete">
                          <i class="la la-remove"></i>
                        </a>`;
					},
                },
                {
					targets: 3,
					render: function(data, type, full, meta) {
						var status = {
							1: {'title': 'Admin', 'class': 'm-badge--warning'},
							2: {'title': 'User', 'class': ' m-badge--info'},
						};
						if (typeof status[data] === 'undefined') {
							return data;
						}
						return '<span class="m-badge ' + status[data].class + ' m-badge--wide">' + status[data].title + '</span>';
					},
                },
                {
					targets: 4,
					render: function(data, type, full, meta) {
                        let i=0;
                        let classes=['m-badge--info','m-badge--primary','m-badge--success','m-badge--warning']
                        membership_levels.map(level=>{
                            level['id']==data?data=i:'';
                            i++;
                        })
                        
						if (typeof classes[data] === 'undefined') {
							return data;
                        }
						return '<span class="m-badge ' + classes[data] + ' m-badge--wide">' + membership_levels[data]['level_name'] + '</span>';
					},
				},
				{
					targets: 5,
					render: function(data, type, full, meta) {
						var status = {
							0: {'title': 'Not Allowed', 'class': 'm-badge--danger'},
							1: {'title': 'Allowed', 'class': ' m-badge--success'},
						};
						if (typeof status[data] === 'undefined') {
							return data;
						}
						return '<span class="m-badge ' + status[data].class + ' m-badge--wide">' + status[data].title + '</span>';
					},
				},
			],
        });

        table.on( 'click', 'tr', function (e) {
            $("#m_frm_user").trigger("reset");
            $("#edit_user_id").val(oTable.row( this ).data().DT_RowId)
            
            var row_data = oTable.row( this ).data();
            $("#name").val(row_data[1])
            $("#email").val(row_data[2])
            $("#role").val(row_data[3])
            $("#membership").val(row_data[4])

            if(row_data[5]>0)
                $("#allow").prop('checked',true)
            else
                $("#allow").prop('checked',false)

        });

        table.on('click', '.delete', function(e) {
            e.preventDefault();

            if (confirm("Are you sure to delete this row ?") == false) {
                return false;
            }
            let nRow = $(this).parents('tr')[0];
            let userId=nRow.getAttribute("id")

            if (userId) {
                $.ajax({
                    type: "POST",
                    url: base_url + 'admin/users/user_del',
                    data: {id:userId},
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

    $("#m_frm_user").validate({
        // define validation rules
        rules: {
            name: {
                required: true,
            },
            email: {
                required: true,
                email: true
            },
            password: {
                minlength:6
            },
            confirm_password: {
                equalTo: "#password"
            },
            role: {
                required: true
            },
        },
        
        //display error alert on form submit  
        invalidHandler: function(event, validator) {     
            var alert = $('#m_frm_user_msg');
            alert.removeClass('m--hide').show();
            mUtil.scrollTop();
        },

        submitHandler: function (form) {
            let data={
                id:$("#edit_user_id").val(),
                name:$("#name").val(),
                email:$("#email").val(),
                password:$("#password").val(),
                role:$("#role").val(),
                membership:$("#membership").val(),
                allow:$('#allow').is(":checked")?1:0
            }

            $.ajax({
                type: "POST",
                url: base_url + 'admin/users/update_user',
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
    $("#m_frm_user_submit").click(function(){
        $( "#m_frm_user" ).submit()
    });
});