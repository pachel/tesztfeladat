const myModal = new bootstrap.Modal(document.getElementById('dolgozoModal'), {
    keyboard: false
});
const myModalEl = document.getElementById("dolgozoModal");
myModalEl.addEventListener('hidden.bs.modal', function (event) {
    dt.ajax.reload();
});
myModalEl.addEventListener('show.bs.modal', function (event) {
    mentheto = true;
});


var title = $("#dolgozoModal").find(".modal-title").text();
function reset() {
    $("#form")[0].reset();
    $("#dolgozoModal").find(".modal-title").text(title);
}
var dt = $('#dolgozok').DataTable({
    ajax: {
        dataSrc: "data",
        url: "ajax/dolgozolista",
    },
    drawCallback: function (){
        Ertekeles.checkSum();
    },
    columns: [
        {data: "nev"},
        {data: "munkakor"},
        {data: "torzsszam"},
        {data: "kitoltve"},
        {data: "pont"},
        {data: "buttons2"}
    ],
    createdRow: function (row, data, index) {
        if (data.kitoltve >=min_ && data.kitoltve<=max_ && !data.hibas) {
            $( row).addClass('bg-lightgreen');
        }
        else{
            mentheto = false;
        }
    }
});
dt.on( 'xhr', function () {
    var json = dt.ajax.json();
    if(json.eredmeny<25){
        $("#eredmeny").attr("class","badge bg-danger");
    }
    else if(json.eredmeny<50){
        $("#eredmeny").attr("class","badge bg-warning");
    }
    else if(json.eredmeny<75){
        $("#eredmeny").attr("class","badge bg-info");
    }
    else{
        $("#eredmeny").attr("class","badge bg-success");
    }

    $("#eredmeny").text(json.eredmeny+"%");
} );
$(document).ready(function () {
    $("#ertekeles").ertekeles();
});

