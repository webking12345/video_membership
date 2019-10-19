let categories_node='';

var Treeview = function () {
    var categoryTree = function() {
        function loadData(){
            $.ajax({
                async: false,
                type: "GET",
                url: base_url + 'admin/category/getAllCategories',
                dataType: "json",
                success: function (json) {
                    categories_node=json
                },
    
                error: function (xhr, ajaxOptions, thrownError) {
                    alert(xhr.status);
                    alert(thrownError);
                }
            });
        }
        loadData()
        
        $("#m_tree_category").jstree({
            "core" : {
                "themes" : {
                    "responsive": false
                }, 
                // so that create works
                "check_callback" : true,
                'data' : categories_node,
                "strings" : {
                    'New node': 'New Category'
                }
            },
            "types" : {
                "default" : {
                    "icon" : "fa fa-file m--font-success"
                },
                "file" : {
                    "icon" : "fa fa-file  m--font-success"
                }
            },
            "state" : { "key" : "state_category_node" },
            "plugins" : [ "dnd","contextmenu", "state", "types" ],
            "contextmenu": {
                "items" : function(node) {
                    var tmp = $.jstree.defaults.contextmenu.items();
                    tmp.ccp = false;
                    return tmp;
                }
            }
            
        }).on('loaded.jstree', function() {
            $("#m_tree_category").jstree('open_all');
        }).on('delete_node.jstree', function (e, data) {
            if(confirm("Are you sure?"))
            {
                $.ajax({
                    type: "POST",
                    url: base_url + 'admin/category/deleteCategory',
                    data: {class:data.node.id, parent:data.node.parent},
                    async: false,
                    dataType: "json",
                    success: function(response) {
                    },
                    error: function() {}
                });
                loadData()
                $('#m_tree_category').jstree(true).settings.core.data = categories_node;
                $('#m_tree_category').jstree(true).refresh();
            }
        }).on('create_node.jstree', function (e, data) {
            $.ajax({
                type: "POST",
                url: base_url + 'admin/category/createCategory',
                data: {name:data.node.text, parent:data.node.parent},
                async: false,
                dataType: "json",
                success: function(response) {
                },
                error: function() {}
            });
            loadData()
            $('#m_tree_category').jstree(true).settings.core.data = categories_node;
            $('#m_tree_category').jstree(true).refresh();
        }).on("move_node.jstree", function (event, data) {
            console.log(data.node);
            if(((data.node.id).substr(0,(data.node.id).length-6)==data.node.parent)||((data.node.id).length==5 && (data.node.parent=="root"||data.node.parent=="#")))
                return true;

            $.ajax({
                type: "POST",
                url: base_url + 'admin/category/moveCategory',
                data: {class:data.node.id, parent:data.node.parent},
                async: false,
                dataType: "json",
                success: function(response) {
                },
                error: function() {}
            });
            loadData()
            $('#m_tree_category').jstree(true).settings.core.data = categories_node;
            $('#m_tree_category').jstree(true).refresh();
        }).on("rename_node.jstree", function (event, data) {
            $.ajax({
                type: "POST",
                url: base_url + 'admin/category/renameCategory',
                data: {name:data.node.text, class:data.node.id},
                async: false,
                dataType: "json",
                success: function(response) {
                },
                error: function() {}
            });
        })
    }

    return {
        //main function to initiate the module
        init: function () {
            categoryTree();
        }
    };
}();

jQuery(document).ready(function($) {
    Treeview.init();
    $("#category_save").click(function(){
        var nodes = $('#m_tree_category').jstree(true).get_json('root', {flat:true})
        var nodesObj = JSON.parse(JSON.stringify(nodes));
        let nodesArr=Object.assign({}, nodesObj);
        deleted_nodes={deleted_nodes:deleted_nodes}

        nodesArr=Object.assign(nodesArr, deleted_nodes);
        $.ajax({
            type: "POST",
            url: base_url + 'admin/saveCategories',
            data: nodesArr,
            async: false,
            dataType: "json",
            success: function(response) {
                if (response) {
                    document.location.reload(true);
                }
            },
            error: function() {}
        });
    })
});