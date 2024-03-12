function save_model() {
    $.ajax({
        type: "POST",
        url: base_url + "admin/Model/add_model",

        data: {model_name: $('#model_name').val(),
            model_collection_id: $('#model_collection_id').val()},
        datatype: "json",
    }).done(function (data) {
        var ndata = JSON.parse(data);
        var html = '<option value="' + ndata.model_id + '" selected>' + ndata.model_name + '</option>';
        
        $("#inventory_model_id").append(html);
        $('#model_name').val("");
        $("#inventory_model_model").modal("toggle");
    });
}

    