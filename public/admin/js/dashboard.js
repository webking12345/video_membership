let contents='';
function loadData(){
    $.ajax({
        async: false,
        type: "GET",
        url: base_url + 'admin/dashboard/getBalance',
        dataType: "json",
        success: function (json) {
            contents=json
        },

        error: function (xhr, ajaxOptions, thrownError) {
            alert(xhr.status);
            alert(thrownError);
        }
    });
}

var DatatablesDataSourceHtml = function() {

	var initTable1 = function() {
		var table = $('#tbl_balance');
        loadData()

		// begin first table
		let oTable=table.DataTable({
            responsive: true,
            data: contents,
            columns: [
                { "data": "no" },
                { "data": "name" },
                { "data": "email" },
                { "data": "amount" },
                { "data": "description" },
                { "data": "date" },
            ],
            columnDefs: [
                {
					targets: 3,
					render: function(data, type, full, meta) {
                        console.log(data);
                        if(data*1 >= 0)
                            return '<span class="m-badge m-badge--success m-badge--wide">$' + Math.abs(data) + '</span>';
                        else
                            return '<span class="m-badge m-badge--danger m-badge--wide">$' + Math.abs(data) + '</span>';
					},
                }
			],
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
});