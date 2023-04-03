SELECT ROUND(SUM(d.pont*d.prioritas)/SUM(d.prioritas)) eredmeny,c.nev FROM dolgozok_ertekelesei d,celok c WHERE d.deleted=0 AND d.id_lezart_ertekelesek=@lezart AND c.id=d.id_celok
GROUP BY d.id_celok ORDER BY eredmeny DESC
