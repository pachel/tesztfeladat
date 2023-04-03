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
        var root = this;
        console.log(this.tbody.find("tr").length);
        var prioritas = [];
        this.tbody.find("tr").each(function (){
            var index = $(this).find(".prioritas input").val();
            if(typeof prioritas[index] == "undefined"){
                prioritas[index] = 1;
            }
            else {
                prioritas[index]++;
            }
        });
        /*
        var prio_1_limit = this.container.find("select[name=\"prioritas\"] option[value=\"1\"]").attr("data-max");
        var prio_2_limit = this.container.find("select[name=\"prioritas\"] option[value=\"2\"]").attr("data-max");
        var prio_3_limit = this.container.find("select[name=\"prioritas\"] option[value=\"3\"]").attr("data-max");
*/
        var esz = counter/100;
        this.container.find("select[name=\"prioritas\"] option").each(function (){
            var index = parseInt($(this).val());
            if(index>=0){
                if(typeof prioritas[index] != "undefined"){
                    var max = parseInt($(this).attr("data-max"));

                    if(prioritas[index]+1>(((counter+1)/100)*max) && max!==100){
                        $(this).attr("disabled",true);
                    }
                    else{
                        $(this).attr("disabled",false);
                    }
                }
            }
        });
        if(counter>=this.max_ct){
            this.container.find("tfoot").fadeOut();
        }
        else{
            this.container.find("tfoot").fadeIn();
        }
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
    add_button_event(){
        var root = this;
        this.addButton.on("click",function (){
            root.addRow();
        });
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
                if(data.status === 1){
                    
                    myModal.show();
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
    addRow(){
        var modal = $("#dolgozoModal");

        var prioritas = parseInt(modal.find("[name=\"prioritas\"] option:selected").val());
        var prioritas_szoveg = modal.find("[name=\"prioritas\"] option:selected").text();
        if (prioritas === -1){
            alert("A prioritást ki kell választani!");
            return;
        }
        else{

        }
        var cel = parseInt(modal.find("[name=\"cel\"] option:selected").val());
        var cel_szoveg = modal.find("[name=\"cel\"] option:selected").text();

        if (cel === -1){
            alert("A célt ki kell választani!");
            return;
        }
        else{
            modal.find("[name=\"cel\"] option:selected").attr("disabled",true);
        }
        var ertek = parseInt(modal.find("[name=\"ertek\"] option:selected").val());
        var ertek_szoveg = modal.find("[name=\"ertek\"] option:selected").text();

        if (ertek === -1){
            alert("Az érkékelést meg kell adni!");
            return;
        }

        var copy = this.container.find(".proto").clone(true);
        copy.removeClass("proto");
        copy.find(".cel").append(cel_szoveg);
        copy.find(".cel input").val(cel);
        copy.find(".prioritas").append(prioritas_szoveg);
        copy.find(".prioritas input").val(prioritas);
        copy.find(".ertek").append(ertek_szoveg);
        copy.find(".ertek input").val(ertek);
        this.container.append(copy);
        document.getElementById("addForm").reset();
        this.check();
    }
    run(){
        this.mod_button_event();
        this.save_button_event();
        this.add_button_event();
        this.check();

    }
}
jQuery.fn.ertekeles = function (){
    ertekelo  = new Ertekeles(this);
    ertekelo.run();
}