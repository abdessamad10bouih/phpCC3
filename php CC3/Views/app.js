$(function () {
    $.ajax({
        url: 'http://localhost/php%20CC3/allEquipments',
        method: "GET",
        dataType: 'JSON',
        success: function (data) {
            data.forEach(element => {
                $('#RefEquipement').append(`<option value="${element.Libelle}">${element.Libelle}</option>`);
            });
        },
    });

$('#btnAjouter').on('submit', function (e) {
    e.preventDefault();

    const NcinClient = $('#NcinClient').val();
    const RefEquipement = $('#RefEquipement').val();
    const DateLoc = $('#DateLoc').val();

    $.ajax({
        url: 'http://localhost/php%20CC3/add',
        method: "POST",
        data: {
            NcinClient: NcinClient,
            RefEquipement: RefEquipement,
            DateLoc: DateLoc,
        },
        success: function (response) {
            console.log('Data added successfully:', response);
        }
    });
});
});