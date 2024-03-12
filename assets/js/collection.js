function save_collection() {
 
    $.ajax({
        type: "POST",
        url: base_url + "admin/collection/add_collection",

        data: {collection_name: $('#collection_name').val(),
            collection_brand_id: $('#collection_brand_id').val()},
        datatype: "json",
    }).done(function (data) {

        var ndata = JSON.parse(data);

        var html = '<option value="' + ndata.collection_id + '" selected>' + ndata.collection_name + '</option>';

        $("#collection_id").append(html);
        $("#model_collection_id").append(html);
        $('#collection_name').val("");
        $("#collection_model").modal("toggle");
    });
}

    