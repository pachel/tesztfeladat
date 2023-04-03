<!--[layout:layout.php]-->
<!--[name:content]-->
<?php if(!isset($_eredmenyek) || empty($_eredmenyek)):?>
    Nincs adat
<?php else:?>
<table class="table table-striped">
    <?php foreach ($_eredmenyek AS $eredmeny){
       echo "<tr>";
       echo "<td>".$eredmeny->datum." <b>".$eredmeny->eredmeny."%</b><table class='table'>";
        foreach ($eredmeny->sorok AS $sor){
            echo "<tr>";
            echo "<td class='text-right col-6'>".$sor->nev."</td>";
            echo "<td>".$sor->eredmeny."%</td>";
            echo "</tr>";
        }
       echo "</table></td>";
       echo "</tr>";
    }?>
</table>
<?php endif;