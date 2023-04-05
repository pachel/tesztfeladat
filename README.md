# Segítség a telepítéshez
## 1. Forrás letöltése, install
A forrásállományok letöltése a github.com-ról
> A forrás innen letölthető: https://github.com/pachel/tesztfeladat.git

Ha tesztfeladat mappájában kiadjuk a "composer install" parancsot

## 2. Adatbázis létrehozása
A feladatnak létre kell hozni egy adatbázist, amibe be kell importálni a feladat **sqldump.sql** állományát
## 3. Config beállítása
A config mappában létre kell hozni egy **dev_app.php** állományt az app.php alapján, vagy át kell írni az **app.php** megfelelő paramétereit!

# Paraméterezhetőség
## 1. legkisebb és legynagyobb célszám személyenként
Ezt a két értéket a config/app.php-ban vagy a config/dev_app.php-ban lehet beállítani: 
> *//A minimum kitöltendő értékelések száma*
>
> "min_ct"=>3,
> 
> *//A kitölthető célok maximális száma*
> 
> "max_ct"=>10
> 
 
## 2. Prioritások
A prioritások az adatbázisban a "prioritasok" táblában vannak tárolva, szabadon módosítható, de nem az oldalon keresztül!

A táblában a maximum mező azt a százalékos értéket jelöli, ami felett nem fordulhat elő az adott prioritás az összes felvitt cél számához képest, egy felhasználó értékelésénél!
> A prioritások törléséhez a "deleted" mezőnek 1-es értéket kellfelvennie, a törlés nem érinti a már elmentett végeredmények értékét

## 3. Értékek
A dolgozó értékelésénél megadható "Értékelések" az "ertekek" táblában vannak rögzítve 
>A törlés itt is úgy működik, mint a prioritásoknál, viszont az értékek átírása nem okoz problémát a mentett végeredményeknél, illetve a már felvitt értékeléseknél, mert a pontszám van rögzítve az értékeléskor nem pedig az érték azonosítója.

# Weboldal
Az oldalra mindíg vezetőként jelentkeztet be a rendszer, ha van több vezető a dolgozói adatbázisban, akkor azt ki tudjuk választani a "Bejelentkezve: XY" lenyílópanelján
## Célok
A "Célok" menüpontban tetszés szerinti mennyiségő célt tudunk felvinni, a törlés nincs hatással a már mentett eredményekre!

## Dolgozók
A dolgozók menüpontban lehet hozzáadni/módosítani/törölni dolgozót, kivéve az "1"-est! Ez azért van, hogy a bejelentkeztetés mindig működjön! *- Nem a legszebb megoldás, de nem akartam bonyolítani!*

A dolgozó lehet beosztott vagy vezető, attól függően, hogy a "Vezető" mezőnél lévő lenyílómenüből mit választunk ki! *Értelem szerűen, ha a listából a "--- Vezető ---" értéket választom, akkor az egy vezető lesz, ha pedig valameliyk vezetőt, akkor annak beosztotta*

## Dolgozók értékelése
A megjelenő listában csak azok a dolgozók vannak, akik a bejelentkezett vezetőhöz vannak beosztva.
A dolgozókat értékelni a sor végén tallható "Értékelés" linkre kattintva lehet megtenni!

Az eredményeket véglegesíteni csak egyszerre lehet, ha a lap alján lévő "Az értékelés véglegesítése" gombra kattintunk!

> Ez a gomb mindaddig inaktív állapotban van, amíg a dolgozók értékelései meg nem felelnek a megadott paramétereknek!

## Végeredmény
A listában megjelenik az összes eddig elmentett értékelés, itt is csak az, ami a bejelentkezett vezetőhöz tartozik
> A dolgozók vezetőinek módosítása ezt a listát nem érinti, mert az alapján vannak lekérdezve, hogy az értékelést ki véglegesítette
