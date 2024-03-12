function save_brand() {

    $.ajax({
        type: "POST",
        url: base_url + "admin/brand/add_brand",

        data: {brand_name: $('#brand_name').val()},
        datatype: "json"
    }).done(function (data) {
        var ndata = JSON.parse(data);
        var html = '<option value="' + ndata.brand_id + '" selected>' + ndata.brand_name + '</option>';

        $("#brand_id").append(html);
        $("#collection_brand_id").append(html);
        $("#model_brand_id").append(html);
        $('#brand_name').val("");
        $("#myModal").modal("toggle");
    });
}