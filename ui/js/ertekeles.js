class Ertekeles{
    container;
    tbody;
    addButton;

    max_ct = 2;
    min_ct = 1;
    userid = 0;

    constructor(parent) {
        this.container = parent;
        this.addButton = $(parent).find(".add");
        this.tbody = $(parent).find("tbody");

    }
    countRows(){
        var counter = this.tbody.find("tr").length;

        if(counter>=this.min_ct){
            $("#save").attr("disabled",false);
        }
        else{
            $("#save").attr("disabled",true);
        }
    }
    check(){
        this.countRows();
    }
    delete_button_event(){
        var root = this;
        $(document).on("click",".ertTorol",function (){
            var parent = $(this).parents("tr");
            $.ajax({
                type: "GET",
                url: "ajax/ertekeles/torol?id="+parent.find("input").val(),
                dataType: "json",
            }).done(function (data){
                if(data.status === 1){
                    parent.remove();
                    root.hibasak(data.hibasak);
                }
                else{
                    alert(data.message);
                }
            }).fail(function () {
               // console.error("HIBA");
            });
        });
    }
    add_button_event(){
        var root = this;
        this.addButton.on("click",function (){
            var formData = {
                cel : root.container.find(".cel option:selected").val(),
                prioritas : root.container.find(".prioritas option:selected").val(),
                ertek : root.container.find(".ertek option:selected").val()
            };
            $.ajax({
                type: "POST",
                url: "ajax/ertekeles/ment?id="+root.userid,
                dataType: "json",
                data: formData,
            }).done(function (data){
                if(data.status === 1){
                    if(typeof data.data !== "undefined") {
                        root.addRow(data.data);
                        root.hibasak(data.hibasak);
                    }
                    else{
                        alert("HIBA");
                    }

                }
                else{
                    alert(data.message);
                }
            }).fail(function () {
                console.error("HIBA");
            });
        });
    }
    hibasak(lista){
        this.tbody.find("tr").removeClass("bg-danger");
        if(lista.length===0){
            return;
        }
        for(var x=0;x<lista.length;x++){
            var szulo = this.tbody.find("input[value="+lista[x]+"]").parents("tr");
            if(!szulo.hasClass("bg-danger")){
                szulo.addClass("bg-danger");
            }
        }

    }
    save_button_event(){
        var root = this;
        $("#save").on("click",function (){

        });
    }
    mod_button_event(){
        var root = this;
        $(document).on("click",".mod", function () {
            root.userid = $(this).attr("href");
            $.ajax({
                type: "GET",
                url: "ajax/dolgozo?id="+root.userid,
                dataType: "json",
            }).done(function (data){
                root.tbody.text("");
                if(data.status === 1){
                    for(var x=0;x<data.data.length;x++){
                        root.addRow(data.data[x]);
                    }
                    myModal.show();
                    root.hibasak(data.hibasak);
                }
                else{
                    root.userid = 0;
                }
            }).fail(function () {
                root.userid = 0;
                console.error("HIBA");
            });
            return false;
        });
    }
    addRow(data){
        var copy = this.container.find(".proto").clone(true);
        copy.removeClass("proto");
        copy.find(".cel").append(data.cel);
        copy.find(".cel input").val(data.id);
        copy.find(".prioritas").append(data.prioritas);
        copy.find(".ertek").append(data.ertek);
        this.container.append(copy);
        document.getElementById("addForm").reset();
       // this.check();
    }

    run(){
        this.mod_button_event();
        this.save_button_event();
        this.add_button_event();
        this.delete_button_event();
        this.veglegesit_button_event();
      //  this.check();

    }
    veglegesit_button_event(){
        var root = this;
        $("#veglegesit").on("click",function (){
            root.userid = $(this).attr("href");
            $.ajax({
                type: "GET",
                url: "ajax/eredmeny/ment",
                dataType: "json",
            }).done(function (data){
                if(data.status === 1){
                    dt.ajax.reload();
                    alert("Az értékelést sikeresen mentette! Megnézheti az eredmények menüpontban!");
                }
                else{

                }
            }).fail(function () {
                console.error("HIBA");
            });
            return false;
        });
    }
    static checkSum(){
        if(mentheto){
            $("#veglegesit").attr("disabled",false);
        }
        else{
            $("#veglegesit").attr("disabled",true);
        }
    }
}
jQuery.fn.ertekeles = function (){
    ertekelo  = new Ertekeles(this);
    ertekelo.run();
}